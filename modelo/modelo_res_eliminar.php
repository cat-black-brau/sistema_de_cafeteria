<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_reservacion = intval($_GET['id']);

    if ($id_reservacion <= 0) {
        echo "<script>alert('ID de reservación inválido'); window.location='../vista/reservacionesadmin.php';</script>";
        exit();
    }

    $con = conection();
    $sql = "DELETE FROM reservaciones WHERE id_reservacion = $id_reservacion";
    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Reservación eliminada con éxito');
            window.location='../vista/reservacionesadmin.php';
        </script>";
    } else {
        echo "Error al eliminar reservación: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    header('Location: ../vista/reservacionesadmin.php');
    exit();
}
?>
