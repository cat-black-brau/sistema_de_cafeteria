<?php
include("../controlador/ClassUsuariop.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recibimos los datos de los inputs del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $tipo_usuario=$_POST['tipousuario'];

    // Verificamos que no vengan vacíos
    if (empty($nombre) || empty($apellido) || empty($correo) || empty($contrasenia)|| empty($tipo_usuario)){
        echo 'Campos vacios';
    } else {
        $user = new UsuarioP("","");
        
        $user->agregar($nombre, $apellido, $correo, $contrasenia, $tipo_usuario);

    }
}
?>
