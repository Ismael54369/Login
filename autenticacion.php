<?php
    session_start(); // pendiente de hacer segura

    if (isset($_POST['identificador'])) {
        
        // inicialización de parámetros de conexión
        $host = 'localhost';
        $usuario = 'root';          // inseguro
        $password = '';             // inseguro
        $baseDatos = 'usuarios';

        // establecimiento de conexión
        $mysqli = new mysqli($host, $usuario, $password, $baseDatos);

        if ($mysqli->connect_error) {
            $_SESSION['error'] = "No se puede comprobar usuario en estos momentos. Vuelva a intentarlo en unos minutos.";
            header('Location: ./login.php');
            // die('Error de conexión: ' . $mysqli->connect_errno); // deja de ejecutar codigo
        }

        // habria que comprobar si hubo un intento  de XSS y contestar con un mensaje de error reprobatorio
        $usuario = htmlspecialchars($_POST['identificador']);
        $password = htmlspecialchars($_POST['password']);

        // nos queda: hacer la query 
        // redireccionar a index si no está o la contraseña es errónea
        // redireccionar a inicio.php si todo es correcto

        $querySQL = "SELECT * FROM usuario WHERE idusuario = '" . $usuario . "'";
        $resultado = $mysqli->query($querySQL);

        if ($resultado->num_rows == 0) {
            $_SESSION['error'] = "Usuario incorrecto.";
            header("Location: ./login.php");
        } else { // usuario encontrado 
            $row = mysqli_fetch_object($resultado); // El objecto $row es stdClass
    
            if ($row->password == $password) {
                // cojo todos los datos de este usuario y los paso como 
                // variables de sesion
                $_SESSION['nombre'] = $row->nombre;
                $_SESSION['apellidos'] = $row->apellidos;
                header("Location: ./inicio.php"); // Entra en la aplicación
            } else {
                $_SESSION['error'] = "Contraseña incorrecta.";
                header("Location: ./login.php");
                exit();
            }
            
            $mysqli->close();
        }
    // --- VERIFICACIÓN DE CONTRASEÑA SEGURA ---
    } else {
    // Si intentan entrar sin enviar el formulario
    $_SESSION["error"] = "Debes iniciar sesión para acceder.";
    header('Location: ./login.php');
    exit(); // Siempre salir después de una redirección
}