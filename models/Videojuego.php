<?php
require_once 'config/db.php';

class Videojuego {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM videojuegos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM videojuegos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($titulo, $genero, $nota, $resena) {
        $sql = "INSERT INTO videojuegos (titulo, genero, nota, resena) VALUES (?, ?, ?, ?)";
        return $this->pdo->prepare($sql)->execute([$titulo, $genero, $nota, $resena]);
    }

    public function update($id, $titulo, $genero, $nota, $resena) {
        $sql = "UPDATE videojuegos SET titulo=?, genero=?, nota=?, resena=? WHERE id=?";
        return $this->pdo->prepare($sql)->execute([$titulo, $genero, $nota, $resena, $id]);
    }

    public function delete($id) {
        return $this->pdo->prepare("DELETE FROM videojuegos WHERE id = ?")->execute([$id]);
    }
}