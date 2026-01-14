<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editor de Cartucho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #2b002b; 
            color: #0f0; 
            font-family: 'Courier New', monospace; 
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .form-box { 
            border: 4px solid #0f0; 
            padding: 30px; 
            background: #000; 
            box-shadow: 0 0 20px #0f0; 
            width: 100%;
            max-width: 600px;
            position: relative;
        }
        /* Efecto Scanlines */
        .form-box::before {
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

        h2 { font-family: 'Press Start 2P'; color: #ff00ff; font-size: 18px; text-align: center; margin-bottom: 30px; text-shadow: 2px 2px #0f0; }
        
        label { font-weight: bold; color: #ff00ff; margin-bottom: 5px; font-family: 'Press Start 2P'; font-size: 10px; }
        
        .form-control { 
            background: #111; 
            border: 2px solid #0f0; 
            color: #fff; 
            font-family: 'Courier New', monospace; 
            margin-bottom: 20px;
        }
        .form-control:focus { background: #222; color: #fff; border-color: #fff; box-shadow: 0 0 10px #0f0; }
        
        .btn-save { background: #0f0; color: #000; font-family: 'Press Start 2P'; font-size: 12px; border: none; padding: 15px; width: 100%; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: #fff; box-shadow: 0 0 15px #fff; }
        
        .btn-cancel { display: block; text-align: center; margin-top: 15px; color: #f00; text-decoration: none; font-family: 'Press Start 2P'; font-size: 10px; }
        .btn-cancel:hover { color: #fff; }
    </style>
</head>
<body>

    <div class="form-box">
        <h2><?php echo isset($juego) ? "EDITAR CARTUCHO" : "NUEVO JUEGO"; ?></h2>

        <form action="index.php?c=game&m=guardar" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($juego) ? $juego->id : ''; ?>">

            <div class="mb-3">
                <label>> TÍTULO_</label>
                <input type="text" name="titulo" class="form-control" 
                       value="<?php echo isset($juego) ? htmlspecialchars($juego->titulo) : ''; ?>" 
                       required placeholder="Inserta nombre del juego...">
            </div>

            <div class="mb-3">
                <label>> URL IMAGEN (PORTADA)_</label>
                <input type="text" name="imagen" class="form-control" 
                       value="<?php echo isset($juego) ? htmlspecialchars($juego->imagen) : ''; ?>" 
                       placeholder="https://...">
                <small style="color: #666; font-size: 10px;">* Copia la dirección de imagen de Google/Steam</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>> GÉNERO_</label>
                    <input type="text" name="genero" class="form-control" 
                           value="<?php echo isset($juego) ? htmlspecialchars($juego->genero) : ''; ?>" 
                           placeholder="RPG, Shooter...">
                </div>

                <div class="col-md-6 mb-3">
                    <label>> METASCORE (0-100)_</label>
                    <input type="number" name="metascore" min="0" max="100" class="form-control" 
                           value="<?php echo isset($juego) ? $juego->metascore : ''; ?>" 
                           placeholder="95">
                </div>
            </div>

            <div class="mb-3">
                <label>> RESEÑA / ANÁLISIS_</label>
                <textarea name="resena" class="form-control" rows="4" placeholder="Escribe tu opinión..."><?php echo isset($juego) ? htmlspecialchars($juego->resena) : ''; ?></textarea>
            </div>

            <button type="submit" class="btn-save">>> GUARDAR PROGRESO <<</button>
            
            <a href="index.php?c=game&m=index" class="btn-cancel">[ CANCELAR MISIÓN ]</a>
        </form>
    </div>

</body>
</html>