<?php
// 1. CONFIGURACIÓN DE SEGURIDAD (punto 2 y 5)
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');
session_set_cookie_params(['lifetime' => 7200, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict']);
session_start();

// 2. TOKEN CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Arcade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <style>
        /* ESTILOS VIDEOJUEGO RETRO */
        body {
            background-color: #1a1a1a;
            background-image: linear-gradient(rgba(0, 255, 0, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 255, 0, 0.03) 1px, transparent 1px);
            background-size: 20px 20px; /* Efecto cuadrícula */
            font-family: 'Press Start 2P', cursive; /* Fuente pixelada */
            color: #0f0; /* Verde terminal */
        }

        .game-container {
            border: 4px solid #0f0;
            background-color: #000;
            box-shadow: 10px 10px 0px #004400; /* Sombra sólida */
            image-rendering: pixelated;
        }

        h3 {
            text-shadow: 2px 2px #ff00de; /* Sombra rosa neón */
            color: #fff;
            margin-bottom: 30px;
            font-size: 20px;
            line-height: 1.5;
        }

        label {
            color: #ff00de; /* Rosa neón */
            font-size: 10px;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            background-color: #000;
            border: 2px solid #555;
            color: #0f0;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border-radius: 0; /* Bordes cuadrados */
        }

        .form-control:focus {
            background-color: #111;
            color: #0f0;
            border-color: #0f0;
            box-shadow: none;
        }

        .btn-game {
            background-color: #ff00de;
            border: none;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            padding: 15px;
            text-transform: uppercase;
            border: 4px solid #fff;
            width: 100%;
            cursor: pointer;
            transition: transform 0.1s;
        }

        .btn-game:hover {
            background-color: #fff;
            color: #ff00de;
            transform: translateY(2px);
        }

        .btn-game:active {
            transform: translateY(4px);
        }

        .alert-retro {
            background-color: #500;
            color: #fff;
            border: 2px solid #f00;
            font-size: 10px;
            margin-bottom: 20px;
            padding: 10px;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% { opacity: 0.7; }
        }

        .scanline {
            width: 100%;
            height: 100px;
            background: linear-gradient(0deg, rgba(0,0,0,0) 50%, rgba(0,255,0,0.1) 50%);
            background-size: 100% 4px;
            position: fixed;
            top: 0;
            pointer-events: none;
            height: 100vh;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="scanline"></div> <div class="game-container p-5" style="width: 450px;">
        <div class="text-center mb-4">
            <span style="color: yellow; font-size: 10px;">INSERT COIN</span>
        </div>
        
        <h3 class="text-center">PLAYER 1<br>LOGIN</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-retro text-center">
                GAME ERROR:<br>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="autenticacion.php" id="loginForm">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="mb-4">
                <label>> USERNAME_</label>
                <input type="text" name="identificador" id="userInput" class="form-control" placeholder="...">
                <div id="userError" class="text-danger small mt-2" style="font-size: 8px; display:none;"></div>
            </div>

            <div class="mb-4">
                <label>> PASSWORD_</label>
                <input type="password" name="password" id="passInput" class="form-control" placeholder="***">
                <div id="passError" class="text-danger small mt-2" style="font-size: 8px; display:none;"></div>
            </div>

            <button type="submit" class="btn-game">PRESS START</button>
        </form>
        
        <div class="text-center mt-3" style="font-size: 8px; color: #555;">
            v.1.0 © 2025 SECURE SYSTEM
        </div>
    </div>

    <script src="validacion.js"></script>
</body>
</html>