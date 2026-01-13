<!DOCTYPE html>
<html lang="es">
<head>
    <title>Game Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #1a1a2e; color: #0f0; font-family: 'Courier New', monospace; }
        .form-box { border: 2px solid #ff00ff; background: #000; padding: 30px; margin-top: 50px; }
        .form-control { background: #111; border: 1px solid #0f0; color: #fff; }
        .btn-save { background: #ff00ff; color: #fff; border: none; padding: 10px 20px; width: 100%; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-box">
                <h2 class="text-center" style="color:#ff00ff">REGISTRO DE VIDEOJUEGO</h2>
                <form action="index.php?c=game&m=guardar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $juego->id ?? ''; ?>">
                    
                    <div class="mb-3">
                        <label>TÍTULO DEL JUEGO</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $juego->titulo ?? ''; ?>" placeholder="Ej: Zelda, Metroid..." required>
                    </div>

                    <div class="mb-3">
                        <label>GÉNERO</label>
                        <input type="text" name="genero" class="form-control" value="<?php echo $juego->genero ?? ''; ?>" placeholder="Aventura, RPG, Shooter...">
                    </div>

                    <div class="mb-3">
                        <label>PUNTUACIÓN (1-10)</label>
                        <input type="number" name="nota" min="1" max="10" class="form-control" value="<?php echo $juego->nota ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label>RESEÑA / NOTAS PERSONALES</label>
                        <textarea name="resena" class="form-control" rows="4" placeholder="¿Qué te pareció el juego?"><?php echo $juego->resena ?? ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn-save">EJECUTAR GUARDADO</button>
                    <a href="index.php?c=game&m=index" class="d-block text-center mt-3" style="color: #888; text-decoration:none;">[ CANCELAR ]</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>