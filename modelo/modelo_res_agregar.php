<?php
include("conexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = intval($_POST['id_user'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $hora = trim($_POST['hora'] ?? '');
    $personas = intval($_POST['personas'] ?? 2);
    $area = trim($_POST['area'] ?? 'Interior');
    $estado = trim($_POST['estado'] ?? 'Confirmada');
    $notas = trim($_POST['notas'] ?? '');

    if ($id_user <= 0 || empty($nombre) || empty($fecha) || empty($hora)) {
        echo "<script>
            alert('Por favor completa todos los campos requeridos.');
            window.location='../vista/formulario_reservacion.php';
        </script>";
        exit();
    }

    $con = conection();
    $nombre_esc = mysqli_real_escape_string($con, $nombre);
    $area_esc = mysqli_real_escape_string($con, $area);
    $estado_esc = mysqli_real_escape_string($con, $estado);
    $notas_esc = mysqli_real_escape_string($con, $notas);

    $sql = "INSERT INTO reservaciones (id_user, nombre, fecha, hora, personas, area, estado, notas) 
            VALUES ($id_user, '$nombre_esc', '$fecha', '$hora', $personas, '$area_esc', '$estado_esc', '$notas_esc')";

    $query = mysqli_query($con, $sql);

    if ($query) {
        echo "<script>
            alert('Reservación creada con éxito');
            window.location='../vista/reservacionesadmin.php';
        </script>";
    } else {
        echo "Error al crear reservación: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
