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
$sql = "SELECT r.*, u.nombre AS user_nombre, u.apellido AS user_apellido, u.email AS user_email 
        FROM reservaciones r 
        LEFT JOIN usuarios u ON r.id_user = u.id_user 
        ORDER BY r.id_reservacion DESC";
$query = mysqli_query($con, $sql);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Administración de Reservaciones - Cafetería</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <h1 style="text-align: center; color: #6f4e37; margin-top: 20px;">🪑 Gestión de Reservaciones (Admin)</h1>
    <br>
    <div style="max-width: 90%; margin: 0 auto;">
        <h2 class="fs-3xl">Todas las Reservaciones</h2>
        <br>
        <h3 class="bg-inverse fg-contrast-inverse" style="max-width: 28%">Total de reservaciones: <?= $total ?></h3>
        <br>
        <a href="dasboar.php" class="btn-solid theme-primary"><-- Regresar al Dashboard</a>
        <a href="formulario_reservacion.php" class="btn-solid theme-success" style="margin-left: 10px;">+ Agregar Reservación</a>
        <br>
        <br>
        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th style="text-align: center;">ID Reserva</th>
                    <th style="text-align: center;">ID User</th>
                    <th style="text-align: center;">Comensal / Titular</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Hora</th>
                    <th style="text-align: center;">Personas</th>
                    <th style="text-align: center;">Área</th>
                    <th style="text-align: center;">Estado</th>
                    <th style="text-align: center;">Acción</th>
                    <th style="text-align: center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { 
                    $nombre_mostrar = !empty($row['nombre']) ? $row['nombre'] : ($row['user_nombre'] . ' ' . $row['user_apellido']);
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $row['id_reservacion'] ?></td>
                        <td style="text-align: center;"><?= $row['id_user'] ?></td>
                        <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($nombre_mostrar) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['fecha']) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['hora']) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['personas']) ?> personas</td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['area']) ?></td>
                        <td style="text-align: center;">
                            <?php
                            $estado = $row['estado'];
                            if ($estado == 'Confirmada') {
                                echo '<span style="color: #28a745; font-weight: bold;">✔ Confirmada</span>';
                            } else if ($estado == 'Cancelada') {
                                echo '<span style="color: #dc3545; font-weight: bold;">✖ Cancelada</span>';
                            } else {
                                echo '<span style="color: #ffc107; font-weight: bold;">⏳ Pendiente</span>';
                            }
                            ?>
                        </td>
                        <td style="text-align: center;">
                            <a onclick="return confirm('¿Deseas eliminar esta reservación?')"
                                href="../modelo/modelo_res_eliminar.php?id=<?= $row['id_reservacion'] ?>"
                                class="btn-solid theme-danger">Eliminar</a>
                        </td>
                        <td style="text-align: center;">
                            <a onclick="return confirm('¿Deseas editar esta reservación?')"
                                href="formulario_actualizar_reservacion.php?id=<?= $row['id_reservacion'] ?>"
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
