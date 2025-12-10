<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f6fb;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: #6C63FF;
        }

        .navbar-brand, .nav-link, .navbar-text {
            color: #fff !important;
            font-weight: 500;
        }

        .container-box {
            margin-top: 80px;
        }

        .welcome-card {
            padding: 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 18px rgba(0,0,0,0.1);
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-purple {
            background: #6C63FF;
            color: #fff;
            border-radius: 8px;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background: #574ee0;
        }
    </style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4">
  <a class="navbar-brand" href="#">Mi Aplicación</a>

  <div class="ms-auto d-flex align-items-center">
    <span class="navbar-text me-3">
        Hola, <strong><?php echo $_SESSION['nombre']  ?></strong>
    </span>
    <a href="./logout.php" class="btn btn-sm btn-light">Cerrar sesión</a>
  </div>
</nav>


<!-- CONTENIDO -->
<div class="container container-box">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="welcome-card text-center">
                <h2 class="mb-3">Bienvenido a tu panel de control</h2>
                <p class="mb-4">
                    Desde aquí puedes gestionar tu aplicación, acceder a tus módulos o realizar operaciones del CRUD.
                </p>

                <a href="#" class="btn btn-purple me-2">Ir al CRUD</a>
                <a href="#" class="btn btn-outline-secondary">Ver perfil</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>