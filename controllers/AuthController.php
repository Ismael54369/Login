<?php
// controllers/AuthController.php

require_once 'config/db.php';
require_once 'models/Usuario.php'; // Lo necesitamos para validar quién entra

class AuthController {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
        
        // Configuramos la sesión con los parámetros de seguridad que tenías originalmente
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_samesite', 'Strict');
            session_set_cookie_params([
                'lifetime' => 7200, 
                'path' => '/', 
                'httponly' => true, 
                'samesite' => 'Strict'
            ]);
            session_start();
        }
    }

    /**
     * Muestra la pantalla de Login (JUGADOR 1)
     */
    public function login() {
        // Si ya está logueado, lo mandamos directo a los juegos
        if (isset($_SESSION['nombre'])) {
            header("Location: index.php?c=game&m=index");
            exit();
        }

        // Generamos el Token CSRF para el formulario si no existe
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        require_once 'views/auth/login.php';
    }

    /**
     * Procesa el intento de entrada
     */
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // 1. Validar Token CSRF (Seguridad ante todo)
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("SECURITY VIOLATION: Invalid Token");
            }

            $userInput = $_POST['identificador'] ?? '';
            $passInput = $_POST['password'] ?? '';

            // 2. Verificar si el usuario está bloqueado por intentos fallidos
            $stmt = $this->pdo->prepare("SELECT attempts, blocked_until FROM login_attempts WHERE username = :u");
            $stmt->execute(['u' => $userInput]);
            $bloqueo = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($bloqueo && $bloqueo['blocked_until']) {
                $ahora = new DateTime();
                $hasta = new DateTime($bloqueo['blocked_until']);
                if ($ahora < $hasta) {
                    $_SESSION['error'] = "SYSTEM LOCKED. TRY AGAIN LATER.";
                    header("Location: index.php?c=auth&m=login");
                    exit();
                }
            }

            // 3. Buscar al usuario en la BD usando el modelo
            $userModel = new Usuario();
            $userData = $userModel->buscarPorUser($userInput);

            // 4. Comprobar contraseña (usando el hash que arreglamos antes)
            if ($userData && password_verify($passInput, $userData['password'])) {
                
                // --- LOGIN EXITOSO ---
                session_regenerate_id(true); 
                $_SESSION['nombre'] = $userData['nombre'];
                $_SESSION['id_usuario_real'] = $userData['id']; // Guardamos su ID por si acaso
                $_SESSION['CREATED'] = time();

                // Limpiamos el historial de intentos fallidos
                $this->pdo->prepare("DELETE FROM login_attempts WHERE username = :u")
                         ->execute(['u' => $userInput]);

                // CAMBIO CLAVE: Redirigimos al CRUD de Videojuegos
                header("Location: index.php?c=game&m=index");
                exit();

            } else {
                // --- LOGIN FALLIDO ---
                // Registramos el fallo para el sistema de bloqueo
                $sql = "INSERT INTO login_attempts (username, attempts, last_attempt) 
                        VALUES (:u, 1, NOW())
                        ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt = NOW()";
                $this->pdo->prepare($sql)->execute(['u' => $userInput]);

                // Bloquear si llega a 5 intentos
                if ($bloqueo && ($bloqueo['attempts'] + 1) >= 5) {
                    $timeLimit = (new DateTime())->modify('+15 minutes')->format('Y-m-d H:i:s');
                    $this->pdo->prepare("UPDATE login_attempts SET blocked_until = :t WHERE username = :u")
                             ->execute(['t' => $timeLimit, 'u' => $userInput]);
                }

                $_SESSION['error'] = "ACCESS DENIED: Check your credentials.";
                header("Location: index.php?c=auth&m=login");
                exit();
            }
        }
    }

    /**
     * Cierra la sesión y limpia cookies
     */
    public function logout() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: index.php?c=auth&m=login");
        exit();
    }
}