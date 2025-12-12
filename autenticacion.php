<?php
// 1. CONFIGURACIÓN SESIÓN SEGURA (Repetimos código al no haber conexion.php)
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');
session_set_cookie_params(['lifetime' => 7200, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict']);
session_start();

// 2. CONEXIÓN PDO DIRECTA
try {
    $pdo = new PDO("mysql:host=localhost;dbname=usuarios;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error BD: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 3. VALIDAR TOKEN CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Error de Seguridad: Token inválido");
    }

    $user = $_POST['identificador'];
    $pass = $_POST['password'];

    // 4. VERIFICAR SI EL USUARIO ESTÁ BLOQUEADO (Punto 8)
    $stmt = $pdo->prepare("SELECT attempts, blocked_until FROM login_attempts WHERE username = :u");
    $stmt->execute(['u' => $user]);
    $bloqueo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($bloqueo && $bloqueo['blocked_until']) {
        if (new DateTime($bloqueo['blocked_until']) > new DateTime()) {
            $_SESSION['error'] = "Usuario bloqueado. Espera 15 minutos.";
            header("Location: login.php");
            exit();
        }
    }

    // 5. BUSCAR USUARIO Y VERIFICAR PASSWORD
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE idusuario = :u");
    $stmt->execute(['u' => $user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($pass, $row['password'])) {
        // --- ÉXITO ---
        session_regenerate_id(true); // Punto 7
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellidos'] = $row['apellidos'];
        $_SESSION['CREATED'] = time();

        // Limpiar intentos fallidos
        $pdo->prepare("DELETE FROM login_attempts WHERE username = :u")->execute(['u' => $user]);

        header("Location: inicio.php");
        exit();

    } else {
        // --- FALLO ---
        // Registrar intento
        $sql = "INSERT INTO login_attempts (username, attempts, last_attempt) VALUES (:u, 1, NOW())
                ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt = NOW()";
        $pdo->prepare($sql)->execute(['u' => $user]);

        // Bloquear si llega a 5
        if ($bloqueo && ($bloqueo['attempts'] + 1) >= 5) {
            $time = (new DateTime())->modify('+15 minutes')->format('Y-m-d H:i:s');
            $pdo->prepare("UPDATE login_attempts SET blocked_until = :t WHERE username = :u")
                ->execute(['t' => $time, 'u' => $user]);
            $_SESSION['error'] = "Has fallado 5 veces. Bloqueado 15 mins.";
        } else {
            $_SESSION['error'] = "Datos incorrectos.";
        }
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
}
?>