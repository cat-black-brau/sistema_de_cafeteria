<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    if ($id_producto <= 0) {
        echo "<script>alert('ID de producto inválido'); window.location='../vista/menuadmin.php';</script>";
        exit();
    }

    $con = conection();
    $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Producto eliminado con éxito');
            window.location='../vista/menuadmin.php';
        </script>";
    } else {
        echo "Error al eliminar producto: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    header('Location: ../vista/menuadmin.php');
    exit();
}
?>
