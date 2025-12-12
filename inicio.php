<?php
// CONFIGURACIÓN SESIÓN
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');
session_set_cookie_params(['lifetime' => 7200, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict']);
session_start();

// Validaciones de seguridad
if (!isset($_SESSION['nombre'])) { header("Location: login.php"); exit(); }
if (time() - $_SESSION['CREATED'] > 1800) { session_regenerate_id(true); $_SESSION['CREATED'] = time(); }
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 7200)) { header("Location: logout.php"); exit(); }
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mission Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #2b002b; /* Fondo morado oscuro */
            font-family: 'Press Start 2P', cursive;
            color: #fff;
        }

        /* BARRA SUPERIOR (HUD) */
        .hud-bar {
            background-color: #000;
            border-bottom: 4px solid #0f0;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .player-info {
            color: #0f0;
            font-size: 12px;
        }

        .hp-bar {
            width: 100px;
            height: 10px;
            background-color: #333;
            border: 2px solid #fff;
            display: inline-block;
            margin-left: 10px;
        }
        .hp-fill {
            width: 80%; /* Vida simulada */
            height: 100%;
            background-color: #0f0;
        }

        .btn-exit {
            background-color: #f00;
            color: #fff;
            border: 2px solid #fff;
            padding: 10px 20px;
            font-family: 'Press Start 2P';
            font-size: 10px;
            text-decoration: none;
            text-transform: uppercase;
        }
        .btn-exit:hover {
            background-color: #fff;
            color: #f00;
        }

        /* CONTENIDO PRINCIPAL */
        .mission-box {
            border: 4px solid #ff00de;
            background-color: rgba(0, 0, 0, 0.8);
            margin-top: 50px;
            padding: 30px;
            box-shadow: 10px 10px 0 #500050;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }

        .stat-item {
            background: #000;
            border: 2px solid #0f0;
            padding: 15px;
            font-size: 10px;
            color: #0f0;
        }

        h1 {
            color: #ff00de;
            text-shadow: 2px 2px #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="hud-bar">
        <div class="player-info">
            PLAYER: <span style="color: #fff;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <br>
            HP: <div class="hp-bar"><div class="hp-fill"></div></div>
        </div>
        <div>
            <span style="font-size: 10px; color: yellow; margin-right: 20px;">SCORE: 99999</span>
            <a href="logout.php" class="btn-exit">EXIT GAME</a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mission-box">
                <h1 class="text-center">MISSION START</h1>
                
                <p class="text-center" style="line-height: 2;">
                    Bienvenido a la zona segura, agente 
                    <span style="color: yellow;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>.
                    <br>
                    Los sistemas de seguridad están activos.
                </p>

                <div class="stats-grid">
                    <div class="stat-item">
                        > SECURITY: <span style="float:right; color: #fff;">MAX</span>
                    </div>
                    <div class="stat-item">
                        > TOKEN CSRF: <span style="float:right; color: #fff;">ACTIVE</span>
                    </div>
                    <div class="stat-item">
                        > DB CONNECT: <span style="float:right; color: #fff;">PDO</span>
                    </div>
                    <div class="stat-item">
                        > SESSION: <span style="float:right; color: #fff;">SECURE</span>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p style="font-size: 8px; color: #888;">PRESS 'EXIT GAME' TO SAVE PROGRESS AND QUIT.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>