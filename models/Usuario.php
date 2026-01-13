<?php
require_once 'config/db.php';

class Usuario {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    // 1. LOGIN: Buscamos por la columna 'idusuario' (que es tu nombre de login)
    public function buscarPorUser($user) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = :u");
        $stmt->execute([':u' => $user]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    // 2. LEER TODOS: El ID numérico es 'id'
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. LEER UNO: Usamos 'id' para buscar
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // 4. CREAR: Usamos 'idusuario' como login
    public function create($nombre, $apellidos, $identificador, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // Columnas exactas de tu BD:
        $sql = "INSERT INTO usuario (nombre, apellidos, idusuario, password) 
                VALUES (:nom, :ape, :user, :pass)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $nombre, 
            ':ape' => $apellidos, 
            ':user' => $identificador, // Aquí guardamos el nombre de usuario
            ':pass' => $hash
        ]);
    }

    // 5. EDITAR: Usamos 'id' para el WHERE
    public function update($id, $nombre, $apellidos, $identificador, $password = null) {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET nombre=:n, apellidos=:a, idusuario=:i, password=:p WHERE id=:id";
            $params = [':n'=>$nombre, ':a'=>$apellidos, ':i'=>$identificador, ':p'=>$hash, ':id'=>$id];
        } else {
            $sql = "UPDATE usuario SET nombre=:n, apellidos=:a, idusuario=:i WHERE id=:id";
            $params = [':n'=>$nombre, ':a'=>$apellidos, ':i'=>$identificador, ':id'=>$id];
        }
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // 6. BORRAR: Usamos 'id'
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuario WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>