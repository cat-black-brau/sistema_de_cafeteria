<?php
include('../modelo/conexiondb.php');
$con = conection();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: reservacionesadmin.php');
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM reservaciones WHERE id_reservacion = $id";
$query = mysqli_query($con, $sql);
$reserva = mysqli_fetch_assoc($query);

if (!$reserva) {
    echo "<script>alert('Reservación no encontrada'); window.location='reservacionesadmin.php';</script>";
    exit();
}

$sql_users = "SELECT id_user, nombre, apellido FROM usuarios ORDER BY id_user ASC";
$query_users = mysqli_query($con, $sql_users);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reservación - Cafetería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <br>
    <br>
    <h2 style="text-align: center; color: #6f4e37;">🪑 Editar Reservación (ID: <?= $reserva['id_reservacion'] ?>)</h2>
    <br>

    <div style="max-width: 50%; margin:0 auto; margin-bottom: 50px;">
        <div class="card">
            <form class="form" style="padding:4%" method="POST" action="../modelo/modelo_res_actualizar.php">
                <input type="hidden" name="id_reservacion" value="<?= $reserva['id_reservacion'] ?>">

                <label class="form-label">Asignada a Usuario (ID User)</label>
                <select name="id_user" class="form-control" required>
                    <?php while ($u = mysqli_fetch_assoc($query_users)) { 
                        $selected = ($u['id_user'] == $reserva['id_user']) ? 'selected' : '';
                    ?>
                        <option value="<?= $u['id_user'] ?>" <?= $selected ?>>
                            ID: <?= $u['id_user'] ?> - <?= htmlspecialchars($u['nombre'] . ' ' . $u['apellido']) ?>
                        </option>
                    <?php } ?>
                </select><br>

                <label class="form-label">Nombre del Titular de la Mesa</label>
                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($reserva['nombre']) ?>" required /><br>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="<?= $reserva['fecha'] ?>" required /><br>
                    </div>
                    <div class="col">
                        <label class="form-label">Hora</label>
                        <input type="time" class="form-control" name="hora" value="<?= $reserva['hora'] ?>" required /><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Número de Personas</label>
                        <select name="personas" class="form-control" required>
                            <?php 
                            $opciones = [1, 2, 3, 4, 5, 6, 8];
                            foreach ($opciones as $op) {
                                $sel = ($reserva['personas'] == $op) ? 'selected' : '';
                                echo "<option value=\"$op\" $sel>$op personas</option>";
                            }
                            ?>
                        </select><br>
                    </div>
                    <div class="col">
                        <label class="form-label">Área</label>
                        <select name="area" class="form-control" required>
                            <?php
                            $areas = ['Interior', 'Terraza', 'Barra', 'Privado'];
                            foreach ($areas as $ar) {
                                $sel = ($reserva['area'] === $ar) ? 'selected' : '';
                                echo "<option value=\"$ar\" $sel>$ar</option>";
                            }
                            ?>
                        </select><br>
                    </div>
                </div>

                <label class="form-label">Estado de la Reservación</label>
                <select name="estado" class="form-control" required>
                    <option value="Confirmada" <?= ($reserva['estado'] == 'Confirmada') ? 'selected' : '' ?>>Confirmada</option>
                    <option value="Pendiente" <?= ($reserva['estado'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                    <option value="Cancelada" <?= ($reserva['estado'] == 'Cancelada') ? 'selected' : '' ?>>Cancelada</option>
                </select><br>

                <label class="form-label">Notas o Peticiones Especiales</label>
                <textarea class="form-control" name="notas" rows="2"><?= htmlspecialchars($reserva['notas'] ?? '') ?></textarea><br>

                <button class="btn-solid theme-secondary" type="submit">Guardar Cambios</button>
                <a onclick="return confirm('¿Deseas cancelar la edición?')" href="reservacionesadmin.php" class="btn-solid theme-danger" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>
