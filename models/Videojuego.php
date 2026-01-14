<?php
require_once 'config/db.php';

class Videojuego {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    public function listarTodo() {
        $stmt = $this->pdo->prepare("SELECT * FROM videojuegos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM videojuegos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // CREATE: Recibe 5 datos (sin ID, porque es automático)
    public function create($titulo, $imagen, $genero, $metascore, $resena) {
        $sql = "INSERT INTO videojuegos (titulo, imagen, genero, metascore, resena) VALUES (?, ?, ?, ?, ?)";
        return $this->pdo->prepare($sql)->execute([$titulo, $imagen, $genero, $metascore, $resena]);
    }

    // UPDATE: Recibe 6 datos (El ID es obligatorio y va PRIMERO en los argumentos)
    public function update($id, $titulo, $imagen, $genero, $metascore, $resena) {
        $sql = "UPDATE videojuegos SET titulo=?, imagen=?, genero=?, metascore=?, resena=? WHERE id=?";
        // En el execute, el orden debe seguir los signos '?' de la SQL.
        // Como 'WHERE id=?' está al final, el $id va al final del array.
        return $this->pdo->prepare($sql)->execute([$titulo, $imagen, $genero, $metascore, $resena, $id]);
    }

    public function delete($id) {
        return $this->pdo->prepare("DELETE FROM videojuegos WHERE id = ?")->execute([$id]);
    }
}
?>