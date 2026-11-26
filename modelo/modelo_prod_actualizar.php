<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_producto = intval($_POST['id_producto'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);

    if ($id_producto <= 0 || empty($nombre) || empty($categoria) || $precio <= 0) {
        echo "<script>
            alert('Datos inválidos o incompletos.');
            window.location='../vista/menuadmin.php';
        </script>";
        exit();
    }

    $con = conection();
    $nombre_esc = mysqli_real_escape_string($con, $nombre);
    $categoria_esc = mysqli_real_escape_string($con, $categoria);
    $descripcion_esc = mysqli_real_escape_string($con, $descripcion);

    $sql = "UPDATE productos 
            SET nombre = '$nombre_esc', 
                categoria = '$categoria_esc', 
                descripcion = '$descripcion_esc', 
                precio = $precio 
            WHERE id_producto = $id_producto";

    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Producto actualizado con éxito');
            window.location='../vista/menuadmin.php';
        </script>";
    } else {
        echo "Error al actualizar producto: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
