<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);

    if (empty($nombre) || empty($categoria) || $precio <= 0) {
        echo "<script>
            alert('Por favor completa todos los campos requeridos y un precio válido.');
            window.location='../vista/formulario_producto.php';
        </script>";
        exit();
    }

    $con = conection();
    $nombre_esc = mysqli_real_escape_string($con, $nombre);
    $categoria_esc = mysqli_real_escape_string($con, $categoria);
    $descripcion_esc = mysqli_real_escape_string($con, $descripcion);

    $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio, disponible) 
            VALUES ('$nombre_esc', '$categoria_esc', '$descripcion_esc', $precio, 1)";

    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Producto agregado con éxito');
            window.location='../vista/menuadmin.php';
        </script>";
    } else {
        echo "Error al agregar producto: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
