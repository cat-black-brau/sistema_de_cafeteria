<?php
include("../controlador/ClassUsuariop.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $email = $_POST['email'] ?? null;
    $pass  = $_POST['password'] ?? null;
  
    $user= new UsuarioP( $email, $pass);
    $user-> login();
}


?>
