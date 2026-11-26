<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Seguridad: solo acceso para admin
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 1) {
    header("Location: menu.php");
    exit();
}

include('../modelo/conexiondb.php');

$con = conection();
$sql = "SELECT * FROM productos ORDER BY id_producto ASC";
$query = mysqli_query($con, $sql);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Administración de Productos - Cafetería</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <h1 style="text-align: center; color: #6f4e37; margin-top: 20px;">☕ Gestión de Menú y Productos (Admin)</h1>
    <br>
    <div style="max-width: 85%; margin: 0 auto;">
        <h2 class="fs-3xl">Lista de Productos</h2>
        <br>
        <h3 class="bg-inverse fg-contrast-inverse" style="max-width: 25%">Total de productos: <?= $total ?></h3>
        <br>
        <a href="dasboar.php" class="btn-solid theme-primary"><-- Regresar al Dashboard</a>
        <a href="formulario_producto.php" class="btn-solid theme-success" style="margin-left: 10px;">+ Agregar Producto</a>
        <br>
        <br>
        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Categoría</th>
                    <th style="text-align: center;">Descripción</th>
                    <th style="text-align: center;">Precio</th>
                    <th style="text-align: center;">Acción</th>
                    <th style="text-align: center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td style="text-align: center;"><?= $row['id_producto'] ?></td>
                        <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($row['nombre']) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['categoria']) ?></td>
                        <td style="text-align: left;"><?= htmlspecialchars($row['descripcion']) ?></td>
                        <td style="text-align: center; font-weight: bold; color: #6f4e37;">$<?= number_format($row['precio'], 2) ?></td>
                        <td style="text-align: center;">
                            <a onclick="return confirm('¿Deseas eliminar este producto?')"
                                href="../modelo/modelo_prod_eliminar.php?id=<?= $row['id_producto'] ?>"
                                class="btn-solid theme-danger">Eliminar</a>
                        </td>
                        <td style="text-align: center;">
                            <a onclick="return confirm('¿Deseas editar este producto?')"
                                href="formulario_actualizar_producto.php?id=<?= $row['id_producto'] ?>"
                                class="btn-solid theme-secondary">Editar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>
    </div>
</body>

</html>
