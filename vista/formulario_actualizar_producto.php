<?php
include('../modelo/conexiondb.php');
$con = conection();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: menuadmin.php');
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM productos WHERE id_producto = $id";
$query = mysqli_query($con, $sql);
$producto = mysqli_fetch_assoc($query);

if (!$producto) {
    echo "<script>alert('Producto no encontrado'); window.location='menuadmin.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Cafetería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <br>
    <br>
    <h2 style="text-align: center; color: #6f4e37;">☕ Editar Producto (ID: <?= $producto['id_producto'] ?>)</h2>
    <br>

    <div style="max-width: 45%; margin:0 auto;">
        <div class="card">
            <form class="form" style="padding:4%" method="POST" action="../modelo/modelo_prod_actualizar.php">
                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

                <label class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required /><br>

                <label class="form-label">Categoría</label>
                <select name="categoria" class="form-control" required>
                    <?php
                    $categorias = ['Bebidas Calientes', 'Bebidas Frías', 'Postres', 'Panadería', 'Desayunos', 'Snacks'];
                    foreach ($categorias as $cat) {
                        $selected = ($producto['categoria'] === $cat) ? 'selected' : '';
                        echo "<option value=\"$cat\" $selected>$cat</option>";
                    }
                    ?>
                </select><br>

                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3" required><?= htmlspecialchars($producto['descripcion']) ?></textarea><br>

                <label class="form-label">Precio ($ MXN)</label>
                <input type="number" step="0.50" min="0" class="form-control" name="precio" value="<?= $producto['precio'] ?>" required /><br>

                <button class="btn-solid theme-secondary" type="submit">Guardar Cambios</button>
                <a onclick="return confirm('¿Deseas cancelar la edición?')" href="menuadmin.php" class="btn-solid theme-danger" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>
