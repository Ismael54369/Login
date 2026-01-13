<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Arcade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .arcade-container {
            border: 4px solid #00ff00;
            padding: 30px;
            box-shadow: 0 0 20px #00ff00, inset 0 0 20px #00ff00;
            background: #000;
            max-width: 400px;
            width: 100%;
            position: relative;
        }
        h3 { font-family: 'Press Start 2P', cursive; color: #ff00ff; text-shadow: 2px 2px #00ff00; margin-bottom: 30px; line-height: 1.5; }
        .form-control { background: #111 !important; border: 2px solid #00ff00; color: #00ff00 !important; font-family: 'Courier New', monospace; }
        .btn-game { background: #00ff00; color: #000; font-family: 'Press Start 2P', cursive; font-size: 12px; border: none; padding: 15px; width: 100%; margin-top: 20px; cursor: pointer; }
        .btn-game:hover { background: #ff00ff; color: #fff; box-shadow: 0 0 15px #ff00ff; }
        .alert-retro { border: 1px solid red; color: red; padding: 10px; margin-bottom: 20px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="arcade-container">
        <h3 class="text-center">JUGADOR 1<br>LOGIN</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-retro text-center">
                GAME ERROR:<br>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?c=auth&m=autenticar" id="loginForm">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="mb-4">
                <label>> USUARIO_</label>
                <input type="text" name="identificador" id="userInput" class="form-control" placeholder="...">
                <div id="userError" class="text-danger small mt-2" style="display:none;"></div>
            </div>

            <div class="mb-4">
                <label>> CONTRASEÑA_</label>
                <input type="password" name="password" id="passInput" class="form-control" placeholder="***">
                <div id="passError" class="text-danger small mt-2" style="display:none;"></div>
            </div>

            <button type="submit" class="btn-game">INICIAR PARTIDA</button>
        </form>
    </div>
    <script src="validacion.js"></script> 
</body>
</html>