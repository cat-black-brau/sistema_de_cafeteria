<?php
include("../controlador/ClassUsuariop.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset( $_GET['id'])) {
    
    $id_user = $_GET['id'];

    if (empty($id_user)){
        echo 'Campos vacios';
    }else{
        $user = new UsuarioP("","");
        $user->eliminar($id_user);
    }
}
?>
