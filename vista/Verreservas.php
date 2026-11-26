<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../modelo/conexiondb.php');
$con = conection();

// Obtener los datos del usuario en la sesion actual
$id_user = $_SESSION['id_user'] ?? 0;
$nombre_user = $_SESSION['nombre'] ?? '';
$tipo_usuario = $_SESSION['tipo_usuario'] ?? 2;

// Si es Admin (tipo 1), puede ver todas las reservaciones
// Si es Comensal (tipo 2), SOLO ve sus propias reservaciones usando su id_user
if ($tipo_usuario == 1) {
    $sql = "SELECT r.*, u.nombre AS usuario_nombre, u.apellido AS usuario_apellido, u.email 
            FROM reservaciones r 
            INNER JOIN usuarios u ON r.id_user = u.id_user 
            ORDER BY r.id_reservacion DESC";
} else {
    $sql = "SELECT r.*, u.nombre AS usuario_nombre, u.apellido AS usuario_apellido, u.email 
            FROM reservaciones r 
            INNER JOIN usuarios u ON r.id_user = u.id_user 
            WHERE r.id_user = '$id_user' 
            ORDER BY r.id_reservacion DESC";
}

$query = mysqli_query($con, $sql);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mis Reservaciones - Cafeteria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <br><br>

    <div style="max-width: 75%; margin: 0 auto; margin-bottom: 50px;">
        <h2 class="fs-3xl" style="text-align: center; color: #6f4e37;">
            🪑 <?= $tipo_usuario == 1 ? 'Todas las Reservaciones (Admin)' : 'Mis Reservaciones (' . htmlspecialchars($nombre_user) . ')' ?>
        </h2>
        <br>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="menu.php" class="btn-solid theme-primary"> <-- Volver al Menu </a>
                <?php if ($tipo_usuario == 1) { ?>
                    <a href="dasboar.php" class="btn-solid theme-secondary" style="margin-left: 10px;"> Regresar al Dashboard </a>
                <?php } ?>
            </div>
            <a href="reservas.php" class="btn-solid theme-success"> + Nueva Reservacion </a>
        </div>
        <br>
        <h3 class="bg-inverse fg-contrast-inverse" style="max-width: 30%">
            <?= $tipo_usuario == 1 ? 'Total reservas:' : 'Mis reservas:' ?> <?= $total ?>
        </h3>
        <br>

        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th style="text-align: center;">ID Reserva</th>
                    <th style="text-align: center;">ID Usuario (FK)</th>
                    <th style="text-align: center;">Comensal</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Hora</th>
                    <th style="text-align: center;">Personas</th>
                    <th style="text-align: center;">Area</th>
                    <th style="text-align: center;">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) { 
                        $nombre_mostrar = !empty($row['nombre']) ? $row['nombre'] : ($row['usuario_nombre'] . ' ' . $row['usuario_apellido']);
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $row['id_reservacion'] ?></td>
                            <td style="text-align: center; font-weight: bold; color: #0d6efd;"><?= $row['id_user'] ?></td>
                            <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($nombre_mostrar) ?></td>
                            <td style="text-align: center;"><?= $row['fecha'] ?></td>
                            <td style="text-align: center;"><?= $row['hora'] ?></td>
                            <td style="text-align: center;"><?= $row['personas'] ?> personas</td>
                            <td style="text-align: center;"><?= $row['area'] ?></td>
                            <td style="text-align: center; color: green; font-weight: bold;"><?= $row['estado'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: gray;">No tienes reservaciones registradas todavia.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>
