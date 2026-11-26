<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Seguridad: Si no es admin (tipo 1), redirigir al menú comensal
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 1) {
    header("Location: menu.php");
    exit();
}

include('../modelo/conexiondb.php');

$con = conection();
$sql = 'SELECT * FROM usuarios';
$query = mysqli_query($con, $sql);

$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>dasboar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
    <h1 style="text-align: center; color: #6f4e37; margin-top: 20px;">☕ Bienvenido al panel de control de la Cafeteria</h1>
    <br>
    <div style="max-width: 70%; margin: 0 auto;">
        <h2 class="fs-3xl">Usuarios de la Cafeteria</h2>
        <br>
        <h3 class="bg-inverse fg-contrast-inverse" style="max-width: 19%">total de usuarios: <?= $total ?> </h3>
        <br>
        <a href="Formulario_usuario.php" class="btn-solid theme-success">Agregar Usuario</a>
        <a href="../vista/menu.php" class="btn-solid theme-primary" style="margin-left: 10px;">Ver Menu Comensal</a>
        <a href="menuadmin.php" class="btn-solid theme-secondary" style="margin-left: 10px;">Ver tabla de productos</a>
        <a href="reservacionesadmin.php" class="btn-solid theme-secondary" style="margin-left: 10px;">Ver tabla de reservaciones</a>
        <a href="../index.php" class="btn-solid btn-styled theme-danger" style="margin-left: 10px;">Cerrar sesion</a>
        <br>
        <br>
        <table class="table table-bordered border-primary">
            <th style="text-align: center;">ID_User</th>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Apellido</th>
            <th style="text-align: center;">Email</th>
            <th style="text-align: center;">password</th>
            <th style="text-align: center;">Tipo de usuario</th>
            <th style="text-align: center;">Accion</th>
            <th style="text-align: center;">Accion</th>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td style="text-align: center;"><?= $row['id_user'] ?></td>
                        <td style="text-align: center;"><?= $row['nombre'] ?></td>
                        <td style="text-align: center;"><?= $row['apellido'] ?></td>
                        <Td style="text-align: center;"><?= $row['email'] ?></Td>
                        <td style="text-align: center;"><?= $row['password'] ?></td>
                        <td style="text-align: center;"><?php
                        
                        
                       $tipo= $row['tipo_usuario'] ;


                        switch ($tipo) {
                            case 1:
                               echo 'Admin (Nivel 1)';
                                break;
                            case 2:
                               echo 'Comensal (Nivel 2)';
                                break;
                            case 3:
                               echo 'Admin';
                                break;
                            
                            default:
                                echo 'Usuario';
                                break;
                        }

                        
                        ?></td>
                        <td style="text-align: center;"><a onclick="return confirm('Deseas eliminar este usuario?')"
                                href="../modelo/modelo_us_eliminar.php?id=<?= $row['id_user'] ?>"
                                class="btn-solid theme-danger">Eliminar</a></td>    
                        <td style="text-align: center;"><a onclick="return confirm('Deseas editar este usuario?')"
                                href="../vista/formulario_actualizar.php?id=<?= $row['id_user'] ?>"
                                class="btn-solid theme-secondary">Editar</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
    </div>
</body>

</html>
