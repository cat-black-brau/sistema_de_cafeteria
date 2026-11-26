<!DOCTYPE html>
<html lang="en">

<head> <!-- Aqui es la cabesa --> <!-- aqui inicia el de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL"
        crossorigin="anonymous"></script>
    <!-- aqui aqui termina el de bootstrap, esta forma es con internet -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria</title> <!-- este es el titulo de la pagina, pero de parte de arriba-->
    <Link rel="stylesheet" href="src/css/styles.css">
</head>
<!-- Este es el cuerpo del html y para la pagina web -->

<body>
    <!-- el h1 es para el titulo de la pagina -->
    <h1 id="titulo" style="color: #6f4e37; text-align: center;">
        ☕ Bienvenido a la Cafeteria
    </h1><!-- aqui termina, se abre con <h1> y se cierra con </h1> -->

    <div class="card" id="contenedorform"> <!-- el div es un contenedor, para decir que al algo adentro de -->
        <!-- el div inicia aqui-->
        <div class="card-body">
            <form method="POST" action="modelo/modeloUser.php"> <!-- este es para decir que es un formulario -->
                <label class="form-label">Email</label>

                <input class="form-control" name="email" placeholder="admin@admin.com" type="Email" required/>
                <!-- este es el input para ingresar la informacion-->
                <label class="form-label" required>password</label>

                <input class="form-control" name="password" placeholder="*******" type="password" required/>
                <div class="text-center mt-3" style=" margin-top:2%;" >
                    <button type="submit" class="btn-solid theme-primary"> Login </button>
                    <!-- este es el boton y le sale al usuario -->
                    <button type="reset" class="btn-solid theme-primary"> Cancelar </button> <br>
                    
                </div>
            </form><!-- aqui termina el formulario -->
        </div>
    </div> <!-- el div termina aqui, inica con <div> y termima con </div> -->

</body>
<footer><!-- este es el pie de la pagina -->
</footer>

</html>
