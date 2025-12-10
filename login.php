<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #87CEFA, #6C63FF);
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            width: 380px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 18px;
            backdrop-filter: blur(14px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-title {
            font-weight: 600;
            font-size: 26px;
            color: #fff;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: none;
            padding-left: 15px;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }

        .form-control::placeholder {
            color: #f0f0f0;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: #fff;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            background: #ffffff;
            color: #6C63FF;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #f1f1f1;
            transform: translateY(-2px);
        }

        .info-text {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #fff;
        }

        a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="login-title">
        <i class="fa-solid fa-circle-user"></i> Iniciar Sesión
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger text-center">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form method="POST" action="./autenticacion.php">

        <div class="mb-3">
            <input type="text" name="identificador" class="form-control" placeholder="Usuario">
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
        </div>

        <button type="submit" class="btn-login">Entrar</button>

    </form>

    <p class="info-text">
        ¿Olvidaste tu contraseña?  
        <a href="#">Recupérala aquí</a>
    </p>

</div>

</body>
</html>
