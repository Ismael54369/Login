<?php
require_once 'models/Videojuego.php';

class GameController {
    private $model;

    public function __construct() {
        $this->model = new Videojuego();
        if (session_status() === PHP_SESSION_NONE) session_start();
        // Seguridad: si no hay login, al pozo
        if (!isset($_SESSION['nombre'])) { header("Location: index.php"); exit(); }
    }

    public function index() {
        $juegos = $this->model->getAll();
        require_once 'views/game/index.php';
    }

    public function create() {
        require_once 'views/game/form.php';
    }

    public function editar() {
        $juego = $this->model->getById($_GET['id']);
        require_once 'views/game/form.php';
    }

    public function guardar() {
        $id = $_POST['id'] ?? null;
        $t = $_POST['titulo'];
        $g = $_POST['genero'];
        $n = $_POST['nota'];
        $r = $_POST['resena'];

        if ($id) {
            $this->model->update($id, $t, $g, $n, $r);
        } else {
            $this->model->create($t, $g, $n, $r);
        }
        header("Location: index.php?c=game&m=index");
    }

    public function eliminar() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?c=game&m=index");
    }
}