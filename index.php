<?php
// index.php
// Configuración global
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Enrutador
$controller = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'AuthController';
$method = isset($_GET['m']) ? $_GET['m'] : 'login';

// Cargar controlador
$controllerFile = "controllers/$controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $object = new $controller();
    
    if (method_exists($object, $method)) {
        $object->$method();
    } else {
        die("GAME OVER: Method '$method' not found.");
    }
} else {
    // Si el controlador no existe, mandamos al login por seguridad
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->login();
}
?>