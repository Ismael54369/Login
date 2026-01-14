<!DOCTYPE html>
<html lang="es">
<head>
    <title>Biblioteca de Juegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* --- ESTILOS GENERALES RETRO --- */
        body { background-color: #2b002b; font-family: 'Courier New', monospace; color: #0f0; }
        
        /* Contenedor principal con efecto CRT */
        .mission-box { 
            border: 4px solid #0f0; 
            padding: 20px; 
            margin-top: 30px; 
            background: rgba(0,0,0,0.9); 
            box-shadow: 0 0 20px #0f0; 
            position: relative;
            overflow: hidden;
        }

        /* Efecto Scanlines (Rayas de TV vieja) */
        .mission-box::before {
            content: " ";
            display: block;
            position: absolute;
            top: 0; left: 0; bottom: 0; right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), 
                        linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06));
            z-index: 2;
            background-size: 100% 4px, 3px 100%;
            pointer-events: none;
        }

        h1 { font-family: 'Press Start 2P'; color: #ff00ff; text-align: center; margin-bottom: 30px; text-shadow: 4px 4px #000; font-size: 24px; }
        
        /* --- BOTONES --- */
        .btn-game { background: #0f0; color: #000; font-family: 'Press Start 2P'; font-size: 12px; border: none; padding: 15px; text-decoration: none; display: inline-block; margin-bottom: 20px; }
        .btn-game:hover { background: #fff; color: #000; box-shadow: 0 0 10px #fff; }
        
        .btn-action { padding: 5px 10px; text-decoration: none; border: 2px solid #fff; font-size: 10px; display: inline-block; font-weight: bold; margin-bottom: 5px; }
        .btn-edit { color: yellow; border-color: yellow; }
        .btn-edit:hover { background: yellow; color: black; }
        .btn-del { color: red; border-color: red; }
        .btn-del:hover { background: red; color: white; }

        /* --- TABLA --- */
        .arcade-table { width: 100%; margin-top: 10px; font-size: 14px; position: relative; z-index: 3; }
        .arcade-table th { background: #004400; color: #fff; padding: 15px; text-align: left; border-bottom: 4px solid #0f0; font-family: 'Press Start 2P'; font-size: 10px; }
        .arcade-table td { border-bottom: 1px solid #333; padding: 10px; color: #0f0; vertical-align: middle; }
        
        /* --- PORTADAS --- */
        .game-cover {
            width: 60px;
            height: 85px;
            object-fit: cover;
            border: 2px solid #0f0;
            box-shadow: 0 0 5px #0f0;
            transition: transform 0.2s;
        }
        .game-cover:hover { transform: scale(1.5); z-index: 10; position: relative; border-color: #ff00ff; }

        /* --- METASCORE BADGES --- */
        .metascore-badge {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            color: #fff;
            font-family: Arial, sans-serif;
            text-shadow: 1px 1px 2px black;
        }
        .score-high { background-color: #66cc33; } /* Verde */
        .score-mid { background-color: #ffcc33; color: #000; } /* Amarillo */
        .score-low { background-color: #ff0000; } /* Rojo */

        /* --- RESEÑA SCROLL --- */
        .resena-box {
            max-width: 250px;
            max-height: 80px;
            overflow-y: auto;
            font-size: 12px;
            font-style: italic;
            color: #ccc;
            scrollbar-width: thin;
            scrollbar-color: #0f0 #000;
        }

        .hud-bar { background: #000; border-bottom: 2px solid #0f0; padding: 10px; display: flex; justify-content: space-between; align-items: center; color: #fff; font-family: 'Press Start 2P'; font-size: 10px; }
    </style>
</head>
<body>

    <div class="hud-bar">
        <div>PLAYER: <?php echo htmlspecialchars($_SESSION['nombre']); ?></div>
        <a href="index.php?c=auth&m=logout" class="btn-action btn-del">LOGOUT</a>
    </div>

    <div class="container-fluid" style="max-width: 1400px;">
        <div class="row justify-content-center">
            <div class="col-md-12 mission-box">
                <h1>BIBLIOTECA_GAMER.DB</h1>
                
                <a href="index.php?c=game&m=create" class="btn-game">INSERT COIN (NUEVO JUEGO)</a>

                <div class="table-responsive">
                    <table class="arcade-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 10%">PORTADA</th>
                                <th style="width: 20%">TÍTULO</th>
                                <th style="width: 15%">GÉNERO</th>
                                <th style="width: 10%">SCORE</th>
                                <th style="width: 25%">RESEÑA</th>
                                <th style="width: 15%">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($juegos as $j): ?>
                            <tr>
                                <td>#<?php echo $j->id; ?></td>

                                <td>
                                    <?php if (!empty($j->imagen)): ?>
                                        <img src="<?php echo htmlspecialchars($j->imagen); ?>" 
                                             class="game-cover"
                                             alt="Cover"
                                             onerror="this.onerror=null;this.src='https://via.placeholder.com/60x85?text=NO+IMG';">
                                    <?php else: ?>
                                        <div style="width:60px; height:85px; background:#222; border:1px solid #0f0; display:flex; align-items:center; justify-content:center; font-size:9px;">
                                            NO IMG
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td><strong style="font-size: 1.1em; color: #fff;"><?php echo htmlspecialchars($j->titulo); ?></strong></td>

                                <td><?php echo htmlspecialchars($j->genero); ?></td>

                                <td>
                                    <?php 
                                    $m = $j->metascore;
                                    // Lógica de colores estilo Metacritic
                                    if ($m >= 75) { $class = 'score-high'; }
                                    elseif ($m >= 50) { $class = 'score-mid'; }
                                    else { $class = 'score-low'; }
                                    ?>
                                    <div class="metascore-badge <?php echo $class; ?>">
                                        <?php echo $m; ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="resena-box">
                                        > <?php echo htmlspecialchars($j->resena); ?>
                                    </div>
                                </td>

                                <td>
                                    <a href="index.php?c=game&m=editar&id=<?php echo $j->id; ?>" class="btn-action btn-edit">EDIT</a>
                                    <a href="index.php?c=game&m=eliminar&id=<?php echo $j->id; ?>" 
                                       class="btn-action btn-del"
                                       onclick="return confirm('¿GAME OVER para este juego?');">DEL</a>
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