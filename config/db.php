<?php
class Database {
    public static function conectar() {
        $host = 'localhost';
        $db = 'usuarios';
        $user = 'root';
        $pass = ''; 
        $charset = 'utf8mb4';

        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ];
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("SYSTEM FAILURE - DB ERROR: " . $e->getMessage());
        }
    }
}
?>