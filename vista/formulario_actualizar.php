<?php
include("../controlador/ClassUsuariop.php");
include("../modelo/conexiondb.php"); // Agregamos la conexión
$con = conection();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {

    $id_user = $_GET['id'];

    if (empty($id_user)) {
        echo 'Campos vacios';
    } else {
        //Buscamos al usuario en la base de datos con la id
        $sql = "SELECT * FROM usuario WHERE id_user = '$id_user'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($query);

        // Llenamos las variables con los datos de la base de datos para el HTML
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $correo = $row['email'];
        $contrasenia = $row['password'];
        $tipo_usuario = $row['tipo_user'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de editar </title>
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
    <br>
    <h2 style="text-align: center; color: #6f4e37;">☕ EDITAR DATOS DEL USUARIO CON ID <?= $id_user ?></h2>
    <br>

    <div style=" max-width: 40%; margin:0 auto;">
        <div class="card">
            <form style="padding:2%" method="POST" action="../modelo/modelo_us_actualizar.php">
                <label class="form-label">ID del usuario</label>
                <br>
                <input readonly class="form-control" name="id_user" value="<?= $id_user ?>">
                <br>
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $nombre ?>" /> <br>
                <label class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="<?= $apellido ?>" /><br>
                <label class="form-label">Correo electronico</label>
                <input type="email" class="form-control" name="correo" value="<?= $correo ?>" /> <br>
                <label class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="contrasenia" value="<?= $contrasenia ?>" /><br>
                <label class="form-label">Tipo de usuario</label>
                <select name="tipousuario" class="form-control">
                    <option value="1" <?= $tipo_usuario == 1 ? 'selected' : '' ?>>1 - ADMIN (Nivel 1)</option>
                    <option value="2" <?= $tipo_usuario == 2 ? 'selected' : '' ?>>2 - COMENSAL (Nivel 2)</option>
                </select><br>
                <button onclick="return confirm('Deseas actualizar los datos?')" class="btn-solid theme-secondary"
                    type="submit"> Actualizar</button>
                <a onclick="return confirm('Deseas cancelar la operacion?')" href="dasboar.php" class="btn-solid theme-danger">Cancelar</a>
            </form>
        </div>
    </div>

</body>


</html>
