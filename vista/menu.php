<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nombre_comensal = $_SESSION['nombre'] ?? 'Comensal';
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservar'])) {
    $nombre = $_POST['nombre'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $personas = $_POST['personas'] ?? '';
    $area = $_POST['area'] ?? '';
    $mensaje = "¡Mesa reservada con exito para $nombre el dia $fecha a las $hora en el area $area!";
}
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
  <li class="nav-item">
     <a href="../vista/reservas.php" class="btn-solid btn-styled theme-inverse">Reservar mesa </a>
  </li>
  <li class="nav-item">
    <a href="../vista/verreservas.php" class="btn-solid btn-styled theme-inverse">Ver mis reservaciones</a>
  </li>

  <li class="nav-item">
    <a href="../index.php" class="btn-solid btn-styled theme-danger">Cerrar Sesion</a>
</ul>

   
    <br>

    <!-- TABLA DEL MENU -->
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
        <!-- Cafe Caliente -->
        <tr>
            <td style="text-align: center; font-weight: bold;">Cafe Americano</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Cafe negro clasico de granos seleccionados</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$35.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Espresso Doble</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Extraccion pura e intensa de cafe recien molido</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$38.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Cappuccino Italiano</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Espresso con leche vaporizada y abundante espuma con canela</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$50.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Latte Vainilla</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Cafe suave con leche cremosa y jarabe de vainilla</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$55.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Caramel Macchiato</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Leche manchada con espresso, vainilla y caramelo artesanal</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$58.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Moka Caliente</td>
            <td style="text-align: center;">Cafe Caliente</td>
            <td style="text-align: center;">Mezcla de espresso, chocolate semiamargo y leche cremosa</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$56.00</td>
        </tr>

        <!-- Cafe Frio -->
        <tr>
            <td style="text-align: center; font-weight: bold;">Cold Brew</td>
            <td style="text-align: center;">Cafe Frio</td>
            <td style="text-align: center;">Cafe infusionado en frio por 16 horas, suave y refrescante</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$52.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Iced Latte</td>
            <td style="text-align: center;">Cafe Frio</td>
            <td style="text-align: center;">Doble carga de espresso con leche fria sobre hielo</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$54.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Frappe Moka</td>
            <td style="text-align: center;">Cafe Frio</td>
            <td style="text-align: center;">Cafe batido con chocolate, hielo y crema chantilly</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$65.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Frappe Caramelo</td>
            <td style="text-align: center;">Cafe Frio</td>
            <td style="text-align: center;">Bebida helada de cafe con dulce de leche y crema batida</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$65.00</td>
        </tr>

        <!-- Bebidas sin Cafe -->
        <tr>
            <td style="text-align: center; font-weight: bold;">Chai Latte</td>
            <td style="text-align: center;">Bebida Especial</td>
            <td style="text-align: center;">Te negro especiado con cardamomo, canela y leche vaporizada</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$58.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Matcha Latte</td>
            <td style="text-align: center;">Bebida Especial</td>
            <td style="text-align: center;">Te verde japones ceremonial batido con leche cremosa</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$62.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Chocolate Artesanal</td>
            <td style="text-align: center;">Bebida Caliente</td>
            <td style="text-align: center;">Cacao mexicano tradicional preparado en leche caliente</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$48.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Tisana Frutal</td>
            <td style="text-align: center;">Infusion</td>
            <td style="text-align: center;">Infusion natural de frutos deshidratados y flor de jamaica</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$45.00</td>
        </tr>

        <!-- Panaderia y Salado -->
        <tr>
            <td style="text-align: center; font-weight: bold;">Croissant de Mantequilla</td>
            <td style="text-align: center;">Panaderia</td>
            <td style="text-align: center;">Hojaldre frances crujiente horneado en el dia</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$40.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Chocolatin</td>
            <td style="text-align: center;">Panaderia</td>
            <td style="text-align: center;">Pan de hojaldre relleno de barras de chocolate oscuro</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$45.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Panini Pavo y Queso</td>
            <td style="text-align: center;">Alimentos</td>
            <td style="text-align: center;">Pan ciabatta tostado con pechuga de pavo, queso gouda y pesto</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$75.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Bagel de Queso Crema</td>
            <td style="text-align: center;">Alimentos</td>
            <td style="text-align: center;">Pan artesanal tostado con queso crema y toque de finas hierbas</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$55.00</td>
        </tr>

        <!-- Postres -->
        <tr>
            <td style="text-align: center; font-weight: bold;">Cheesecake de Frutos Rojos</td>
            <td style="text-align: center;">Postre</td>
            <td style="text-align: center;">Pastel de queso artesanal con mermelada de moras y fresas</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$70.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Brownie de Chocolate</td>
            <td style="text-align: center;">Postre</td>
            <td style="text-align: center;">Bizcocho humedo de cacao intenso con nuez tostada</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$48.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Rol de Canela</td>
            <td style="text-align: center;">Postre</td>
            <td style="text-align: center;">Pan suave enrollado con canela y glaseado de queso crema</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$50.00</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold;">Galleta Chispas de Chocolate</td>
            <td style="text-align: center;">Postre</td>
            <td style="text-align: center;">Galleta artesanal crujiente por fuera y suave por dentro</td>
            <td style="text-align: center; font-weight: bold; color: #6f4e37;">$32.00</td>
        </tr>
    </tbody>
</table>
<br>
<br>
<br>


</html>
