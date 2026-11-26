<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Cafetería</title>
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
    <h2 style="text-align: center; color: #6f4e37;">☕ Registrar Nuevo Producto</h2>
    <br>

    <div style="max-width: 45%; margin:0 auto;">
        <div class="card">
            <form class="form" style="padding:4%" method="POST" action="../modelo/modelo_prod_agregar.php">
                <label class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" placeholder="Ej: Capuchino Vainilla" name="nombre" required /><br>

                <label class="form-label">Categoría</label>
                <select name="categoria" class="form-control" required>
                    <option value="Bebidas Calientes">Bebidas Calientes</option>
                    <option value="Bebidas Frías">Bebidas Frías</option>
                    <option value="Postres">Postres</option>
                    <option value="Panadería">Panadería</option>
                    <option value="Desayunos">Desayunos</option>
                    <option value="Snacks">Snacks</option>
                </select><br>

                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3" placeholder="Descripción breve del producto..." required></textarea><br>

                <label class="form-label">Precio ($ MXN)</label>
                <input type="number" step="0.50" min="0" class="form-control" placeholder="Ej: 55.00" name="precio" required /><br>

                <button class="btn-solid theme-success" type="submit">Guardar Producto</button>
                <a onclick="return confirm('¿Deseas cancelar la operación?')" href="menuadmin.php" class="btn-solid theme-danger" style="margin-left: 10px;">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>
