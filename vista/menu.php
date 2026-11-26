<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../modelo/conexiondb.php');
$con = conection();

$nombre_comensal = $_SESSION['nombre'] ?? 'Comensal';
$tipo_usuario = $_SESSION['tipo_usuario'] ?? 2;

// Consultar los productos del menu directamente desde la base de datos
$sql_prod = "SELECT * FROM productos ORDER BY id_producto ASC";
$query_prod = mysqli_query($con, $sql_prod);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menu de la Cafeteria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>
   
    <h1 style="text-align: center; color: #6f4e37; margin-top: 20px;">☕ Menu de Little Bean Coffee </h1>
    
    <p style="text-align: center; color: #555;">Bienvenido comensal <strong><?= htmlspecialchars($nombre_comensal) ?></strong>, consulta nuestra carta de especialidades y aparta tu mesa.</p>

<br>    

     <ul class="nav justify-content-center">
  <?php if ($tipo_usuario == 1) { ?>
  <li class="nav-item">
     <a href="dasboar.php" class="btn-solid theme-primary" style="margin-right: 10px;">← Regresar al Dashboard</a>
  </li>
  <?php } ?>
  <li class="nav-item">
     <a href="../vista/reservas.php" class="btn-solid btn-styled theme-inverse">Reservar mesa </a>
  </li>
  <li class="nav-item">
    <a href="../vista/Verreservas.php" class="btn-solid btn-styled theme-inverse">Ver mis reservaciones</a>
  </li>

  <li class="nav-item">
    <a href="../index.php" class="btn-solid btn-styled theme-danger">Cerrar Sesion</a>
  </li>
</ul>

   
    <br>

    <!-- TABLA DEL MENU DESDE LA BASE DE DATOS -->
    <div style="max-width: 70%; margin: 0 auto;">
        <h2 class="fs-3xl" style="color: #6f4e37;">Nuestros Cafes y Alimentos</h2>
        <br>
        <table class="table table-bordered border-primary">
            <thead>
                <tr>
                    <th style="text-align: center;">Producto</th>
                    <th style="text-align: center;">Categoria</th>
                    <th style="text-align: center;">Descripcion</th>
                    <th style="text-align: center;">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query_prod)) { ?>
                    <tr>
                        <td style="text-align: center; font-weight: bold;"><?= htmlspecialchars($row['nombre']) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['categoria']) ?></td>
                        <td style="text-align: center;"><?= htmlspecialchars($row['descripcion']) ?></td>
                        <td style="text-align: center; font-weight: bold; color: #6f4e37;">$<?= number_format($row['precio'], 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>
    </div>

</body>
</html>
