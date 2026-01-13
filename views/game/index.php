<!DOCTYPE html>
<html lang="es">
<head>
    <title>Biblioteca de Juegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { background-color: #2b002b; font-family: 'Courier New', monospace; color: #0f0; }
        .mission-box { border: 4px solid #0f0; padding: 20px; margin-top: 50px; background: rgba(0,0,0,0.9); box-shadow: 0 0 20px #0f0; }
        h1 { font-family: 'Press Start 2P'; color: #ff00ff; text-align: center; margin-bottom: 30px; text-shadow: 2px 2px #000; font-size: 20px; }
        .btn-game { background: #0f0; color: #000; font-family: 'Press Start 2P'; font-size: 10px; border: none; padding: 10px; text-decoration: none; display: inline-block; margin-bottom: 15px; }
        .btn-game:hover { background: #fff; color: #000; }
        
        /* Tabla Retro Ajustada */
        .arcade-table { width: 100%; border: 2px solid #0f0; margin-top: 20px; font-size: 12px; }
        .arcade-table th { background: #004400; color: #fff; padding: 10px; text-align: left; border-bottom: 2px solid #0f0; }
        .arcade-table td { border: 1px solid #333; padding: 10px; color: #0f0; vertical-align: top; }
        
        .btn-action { padding: 5px; text-decoration: none; border: 1px solid #fff; margin-right: 5px; font-size: 10px; display: inline-block; margin-top: 5px; }
        .btn-edit { color: yellow; border-color: yellow; }
        .btn-del { color: red; border-color: red; }
        .hud-bar { background: #000; border-bottom: 2px solid #0f0; padding: 10px; display: flex; justify-content: space-between; align-items: center; }
        
        /* Estilo para la reseña */
        .resena-text { font-style: italic; color: #aaa; font-size: 11px; display: block; max-width: 300px; }
    </style>
</head>
<body>

    <div class="hud-bar">
        <div>AGENTE: <?php echo htmlspecialchars($_SESSION['nombre']); ?></div>
        <a href="index.php?c=auth&m=logout" class="btn-action btn-del">SALIR (LOGOUT)</a>
    </div>

    <div class="container-fluid px-5"> <div class="row justify-content-center">
            <div class="col-md-12 mission-box">
                <h1>BIBLIOTECA_GAMER.DB</h1>
                
                <a href="index.php?c=game&m=create" class="btn-game">+ AÑADIR NUEVO JUEGO</a>

                <div class="table-responsive">
                    <table class="arcade-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">TÍTULO</th>
                                <th style="width: 15%">GÉNERO</th>
                                <th style="width: 10%">NOTA</th>
                                <th style="width: 35%">RESEÑA</th> <th style="width: 15%">ACCIONES</th>
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
                                    <span class="resena-text">
                                        "<?php echo nl2br(htmlspecialchars($j->resena)); ?>"
                                    </span>
                                </td>
                                
                                <td>
                                    <a href="index.php?c=game&m=editar&id=<?php echo $j->id; ?>" class="btn-action btn-edit">EDITAR</a>
                                    <a href="index.php?c=game&m=eliminar&id=<?php echo $j->id; ?>" 
                                       class="btn-action btn-del"
                                       onclick="return confirm('¿BORRAR ESTE JUEGO?');">BORRAR</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>