<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../modelo/conexiondb.php');
$con = conection();

// Obtener el ID del usuario logueado en la sesion
$id_user = $_SESSION['id_user'] ?? 1;
$nombre_comensal = $_SESSION['nombre'] ?? '';
$tipo_usuario = $_SESSION['tipo_usuario'] ?? 2;

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    $id_usuario = !empty($_POST['id_user']) ? $_POST['id_user'] : $id_user;
    $nombre = $_POST['nombre'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $personas = $_POST['personas'] ?? '';
    $area = $_POST['area'] ?? '';

    $sql_insert = "INSERT INTO reservaciones (id_user, nombre, fecha, hora, personas, area, estado) 
                   VALUES ('$id_usuario', '$nombre', '$fecha', '$hora', '$personas', '$area', 'Confirmada')";
    $res = mysqli_query($con, $sql_insert);

    if ($res) {
        $mensaje = "¡Mesa reservada con exito para $nombre el dia $fecha a las $hora en el area $area!";
    } else {
        $mensaje = "Error al guardar la reservacion: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reservar Mesa - Cafeteria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <br><br>

    <!-- APARTADO DE RESERVACION DE MESAS -->
    <div style="max-width: 50%; margin: 0 auto; margin-bottom: 50px;">
        <h2 class="fs-3xl" style="text-align: center; color: #6f4e37;">🪑 Apartado de Reservacion de Mesas</h2>
        <br>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="menu.php" class="btn-solid theme-primary"> <-- Volver al Menu </a>
                <?php if ($tipo_usuario == 1) { ?>
                    <a href="dasboar.php" class="btn-solid theme-secondary" style="margin-left: 10px;"> Regresar al Dashboard </a>
                <?php } ?>
            </div>
            <a href="Verreservas.php" class="btn-solid theme-inverse"> Ver mis reservaciones --> </a>
        </div>
        <br>
        
        <?php if (!empty($mensaje)) { ?>
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
                <strong><?= $mensaje ?></strong>
                <br><br>
                <a href="Verreservas.php" class="btn-solid theme-success">Ver en la lista de reservaciones</a>
            </div>
        <?php } ?>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="reservas.php">
                    <input type="hidden" name="reservar" value="1">
                    <!-- ID del usuario se manda automaticamente como llave foranea -->
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    
                    <label class="form-label">Nombre del Comensal</label>
                    <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($nombre_comensal) ?>" placeholder="Tu nombre completo" required/><br>

                    <label class="form-label">Fecha de Visita</label>
                    <input type="date" class="form-control" name="fecha" value="<?= date('Y-m-d') ?>" required/><br>

                    <label class="form-label">Hora</label>
                    <input type="time" class="form-control" name="hora" value="16:00" required/><br>

                    <label class="form-label">Numero de Personas</label>
                    <input type="number" min="1" max="12" class="form-control" name="personas" value="2" required/><br>

                    <label class="form-label">Area de la Cafeteria</label>
                    <select name="area" class="form-control">
                        <option value="Interior (Climatizado)">Interior (Climatizado)</option>
                        <option value="Terraza (Al aire libre)">Terraza (Al aire libre)</option>
                        <option value="Barra de Cafe">Barra de Cafe</option>
                        <option value="Zona Lounge (Sillones)">Zona Lounge (Sillones)</option>
                    </select><br>

                    <div class="text-center">
                        <button type="submit" class="btn-solid theme-primary"> Confirmar Reservacion </button>
                        <button type="reset" class="btn-solid theme-secondary"> Limpiar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
