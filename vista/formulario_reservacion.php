<?php
include('../modelo/conexiondb.php');
$con = conection();

// Obtener lista de usuarios para asignar la reservación
$sql_users = "SELECT id_user, nombre, apellido, email FROM usuarios ORDER BY id_user ASC";
$query_users = mysqli_query($con, $sql_users);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Reservación - Cafetería</title>
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
    <h2 style="text-align: center; color: #6f4e37;">🪑 Registrar Nueva Reservación (Admin)</h2>
    <br>

    <div style="max-width: 50%; margin:0 auto; margin-bottom: 50px;">
        <div class="card">
            <form class="form" style="padding:4%" method="POST" action="../modelo/modelo_res_agregar.php">
                <label class="form-label">Asignar a Usuario (Comensal)</label>
                <select name="id_user" class="form-control" required>
                    <option value="">-- Seleccionar Comensal --</option>
                    <?php while ($u = mysqli_fetch_assoc($query_users)) { ?>
                        <option value="<?= $u['id_user'] ?>">ID: <?= $u['id_user'] ?> - <?= htmlspecialchars($u['nombre'] . ' ' . $u['apellido']) ?> (<?= htmlspecialchars($u['email']) ?>)</option>
                    <?php } ?>
                </select><br>

                <label class="form-label">Nombre del Titular de la Mesa</label>
                <input type="text" class="form-control" placeholder="Ej: Juan Pérez" name="nombre" required /><br>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" required /><br>
                    </div>
                    <div class="col">
                        <label class="form-label">Hora</label>
                        <input type="time" class="form-control" name="hora" required /><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Número de Personas</label>
                        <select name="personas" class="form-control" required>
                            <option value="1">1 persona</option>
                            <option value="2" selected>2 personas</option>
                            <option value="3">3 personas</option>
                            <option value="4">4 personas</option>
                            <option value="5">5 personas</option>
                            <option value="6">6 personas</option>
                            <option value="8">8 personas o más</option>
                        </select><br>
                    </div>
                    <div class="col">
                        <label class="form-label">Área</label>
                        <select name="area" class="form-control" required>
                            <option value="Interior">Interior (Climatizada)</option>
                            <option value="Terraza">Terraza (Al aire libre)</option>
                            <option value="Barra">Barra Principal</option>
                            <option value="Privado">Salón Privado</option>
                        </select><br>
                    </div>
                </div>

                <label class="form-label">Estado de la Reservación</label>
                <select name="estado" class="form-control" required>
                    <option value="Confirmada" selected>Confirmada</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Cancelada">Cancelada</option>
                </select><br>

                <label class="form-label">Notas o Peticiones Especiales (Opcional)</label>
                <textarea class="form-control" name="notas" rows="2" placeholder="Ej: Mesa cerca de la ventana..."></textarea><br>

                <button class="btn-solid theme-success" type="submit">Guardar Reservación</button>
                <a onclick="return confirm('¿Deseas cancelar la operación?')" href="reservacionesadmin.php" class="btn-solid theme-danger" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>
