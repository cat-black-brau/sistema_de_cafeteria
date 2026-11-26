<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de usuario - Cafeteria</title>
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
    <h2 style="text-align: center; color: #6f4e37;">☕ Registrar usuario de Cafeteria</h2>
    <br>

    <div style=" max-width: 40%; margin:0 auto;">
        <div class="card">
        <form class="form" style="padding:2%" method="POST" action="../modelo/modelo_us_agregar.php">
            <label class="form-label" >Nombre</label>
            <input type="text" class="form-control" placeholder="Carlos" name="nombre" required/> <br>
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control" placeholder="Perez" name="apellido" required/><br>
            <label class="form-label">Correo electronico</label>
            <input type="email" class="form-control" placeholder="carlos@cafeteria.com" name="correo" required/> <br>
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" placeholder="12345" name="contrasenia" required/><br>
            <label class="form-label">Confirmar contraseña </label>
            <input type="password" class="form-control" placeholder="12345" name="con_contrasenia"/><br>
            <label class="form-label">Tipo de usuario</label>
            <select name="tipousuario" class="form-control">
                <option value="1">1 - ADMIN (Nivel 1)</option>
                <option value="2">2 - COMENSAL (Nivel 2)</option>
            </select><br>
            <button class="btn-solid theme-secondary" type="submit"> Registrar</button>
            <a onclick="return confirm('Deseas cancelar la operacion?')" href="dasboar.php" class="btn-solid theme-danger">Cancelar</a>
        </form>
        </div>
    </div>

</body>


</html>
