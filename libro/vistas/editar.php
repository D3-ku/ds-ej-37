<?php require_once '../../modelo/libro.php';
$id = $_GET['id'] ?? null;
$libro = $id ? Libro::obtenerPorId($id) : null;
$titulo = $libro ? 'Editar Libro' : 'Agregar Libro';
$accion = $libro ? 'editar' : 'agregar';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <form method="POST" action="../acciones.php">
                    <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                    <?php if ($libro): ?>
                        <input type="hidden" name="Id" value="<?php echo $libro->Id; ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" name="Titulo" value="<?php echo $libro ? $libro->Titulo : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input type="text" class="form-control" name="Autor" value="<?php echo $libro ? $libro->Autor : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Año de Publicación</label>
                        <input type="text" class="form-control" name="AnioPublicacion" value="<?php echo $libro ? $libro->AnioPublicacion : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cantidad de Páginas</label>
                        <input type="number" class="form-control" name="CantidadPaginas" value="<?php echo $libro ? $libro->CantidadPaginas : ''; ?>" required>
                    </div>
                    <div class="d-grid gap-2 d-sm-flex">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>