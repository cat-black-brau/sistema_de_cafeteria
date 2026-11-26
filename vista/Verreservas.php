<?php
include('../modelo/conexiondb.php');
$con = conection();

// Crea la tabla automaticamente si no existe
$sql_tabla = "CREATE TABLE IF NOT EXISTS reservaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    fecha DATE,
    hora TIME,
    personas INT,
    area VARCHAR(50),
    estado VARCHAR(50) DEFAULT 'Confirmada'
)";
mysqli_query($con, $sql_tabla);

// Consultar todas las reservaciones
$sql = 'SELECT * FROM reservaciones ORDER BY id DESC';
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

    <div style="max-width: 70%; margin: 0 auto; margin-bottom: 50px;">
        <h2 class="fs-3xl" style="text-align: center; color: #6f4e37;">🪑 Mis Reservaciones</h2>
        <br>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="menu.php" class="btn-solid theme-primary"> <-- Volver al Menu </a>
            <a href="reservas.php" class="btn-solid theme-success"> + Nueva Reservacion </a>
        </div>
        <br>
        <h3 class="bg-inverse fg-contrast-inverse" style="max-width: 25%">Total de reservas: <?= $total ?> </h3>
        <br>

        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Hora</th>
                    <th style="text-align: center;">Personas</th>
                    <th style="text-align: center;">Area</th>
                    <th style="text-align: center;">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td style="text-align: center;"><?= $row['id'] ?></td>
                            <td style="text-align: center; font-weight: bold;"><?= $row['nombre'] ?></td>
                            <td style="text-align: center;"><?= $row['fecha'] ?></td>
                            <td style="text-align: center;"><?= $row['hora'] ?></td>
                            <td style="text-align: center;"><?= $row['personas'] ?> personas</td>
                            <td style="text-align: center;"><?= $row['area'] ?></td>
                            <td style="text-align: center; color: green; font-weight: bold;"><?= $row['estado'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: gray;">No hay reservaciones registradas todavia.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>
