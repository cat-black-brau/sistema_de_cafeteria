<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reservacion = intval($_POST['id_reservacion'] ?? 0);
    $id_user = intval($_POST['id_user'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $hora = trim($_POST['hora'] ?? '');
    $personas = intval($_POST['personas'] ?? 2);
    $area = trim($_POST['area'] ?? 'Interior');
    $estado = trim($_POST['estado'] ?? 'Confirmada');
    $notas = trim($_POST['notas'] ?? '');

    if ($id_reservacion <= 0 || $id_user <= 0 || empty($nombre) || empty($fecha) || empty($hora)) {
        echo "<script>
            alert('Datos inválidos o incompletos.');
            window.location='../vista/reservacionesadmin.php';
        </script>";
        exit();
    }

    $con = conection();
    $nombre_esc = mysqli_real_escape_string($con, $nombre);
    $area_esc = mysqli_real_escape_string($con, $area);
    $estado_esc = mysqli_real_escape_string($con, $estado);
    $notas_esc = mysqli_real_escape_string($con, $notas);

    $sql = "UPDATE reservaciones 
            SET id_user = $id_user,
                nombre = '$nombre_esc',
                fecha = '$fecha',
                hora = '$hora',
                personas = $personas,
                area = '$area_esc',
                estado = '$estado_esc',
                notas = '$notas_esc'
            WHERE id_reservacion = $id_reservacion";

    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Reservación actualizada con éxito');
            window.location='../vista/reservacionesadmin.php';
        </script>";
    } else {
        echo "Error al actualizar reservación: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
