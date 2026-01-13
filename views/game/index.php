<!DOCTYPE html>
<html lang="es">
<head>
    <title>Game Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { background: #1a1a2e; color: #0f0; font-family: 'Courier New', monospace; }
        .arcade-card { border: 3px solid #0f0; background: #000; padding: 20px; box-shadow: 0 0 15px #0f0; margin-top: 50px; }
        h1 { font-family: 'Press Start 2P'; color: #ff00ff; text-shadow: 3px 3px #000; font-size: 20px; }
        .table { color: #0f0; border-color: #444; }
        .btn-retro { background: #0f0; color: #000; font-family: 'Press Start 2P'; font-size: 10px; padding: 10px; text-decoration: none; }
        .btn-retro:hover { background: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="arcade-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>BIBLIOTECA_GAMER.DB</h1>
                <a href="index.php?c=auth&m=logout" style="color:red; font-size:10px;">[CERRAR_SESIÓN]</a>
            </div>

            <p>Bienvenido, agente <span style="color:yellow;"><?php echo $_SESSION['nombre']; ?></span></p>
            <a href="index.php?c=game&m=create" class="btn-retro">+ AÑADIR NUEVO JUEGO</a>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÍTULO</th>
                        <th>GÉNERO</th>
                        <th>PUNTUACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($juegos as $j): ?>
                    <tr>
                        <td>#<?php echo $j->id; ?></td>
                        <td><strong><?php echo htmlspecialchars($j->titulo); ?></strong></td>
                        <td><?php echo htmlspecialchars($j->genero); ?></td>
                        <td style="color: gold;"><?php echo $j->nota; ?>/10</td>
                        <td>
                            <a href="index.php?c=game&m=editar&id=<?php echo $j->id; ?>" style="color:yellow;">[EDITAR]</a>
                            <a href="index.php?c=game&m=eliminar&id=<?php echo $j->id; ?>" style="color:red;" onclick="return confirm('¿BORRAR DATOS DEL JUEGO?');">[BORRAR]</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>