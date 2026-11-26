<?php
include("../controlador/ClassUsuariop.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recibimos los datos de los inputs del formulario
    $id_user =$_POST['id_user'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $tipo_usuario=$_POST['tipousuario'];

    // Verificamos que no vengan vacíos
    if (empty($id_user)||empty($nombre) || empty($apellido) || empty($correo) || empty($contrasenia)|| empty($tipo_usuario)){
        echo 'Campos vacios';
    } else {
        $user = new UsuarioP("","");
        
        $user->actualizar($id_user,$nombre, $apellido, $correo, $contrasenia, $tipo_usuario);

    }
}
?>
