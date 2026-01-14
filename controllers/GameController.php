<?php
require_once 'models/Videojuego.php';

class GameController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Videojuego();
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Seguridad: Si no hay usuario logueado, lo mandamos al login
        if (!isset($_SESSION['nombre'])) { 
            header("Location: index.php?c=auth&m=login"); 
            exit(); 
        }
    }

    public function index() {
        $juegos = $this->modelo->listarTodo();
        require_once 'views/game/index.php';
    }

    public function create() {
        require_once 'views/game/form.php';
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $juego = $this->modelo->getById($_GET['id']);
            require_once 'views/game/form.php';
        }
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Recogemos los datos del formulario
            $id = $_POST['id'] ?? null;
            $t = $_POST['titulo'];
            $img = $_POST['imagen'];
            $g = $_POST['genero'];
            
            // Truco: Recogemos el valor ya sea que el input se llame 'metascore' o 'nota'
            $m = $_POST['metascore'] ?? $_POST['nota']; 
            
            $r = $_POST['resena'];

            if ($id) {
                // ACTUALIZAR: El orden aquí coincide con el del modelo ($id primero)
                $this->modelo->update($id, $t, $img, $g, $m, $r);
            } else {
                // CREAR: Sin ID
                $this->modelo->create($t, $img, $g, $m, $r);
            }
            
            header("Location: index.php?c=game&m=index");
            exit();
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->modelo->delete($_GET['id']);
            header("Location: index.php?c=game&m=index");
            exit();
        }
    }
}
?>