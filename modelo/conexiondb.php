<?php
function conection(){
$host = "localhost";
$port = 3306;
$user="root";
$pass="";
$db="db_cafeteria";

$conec= mysqli_connect($host,$user,$pass,$db,$port);

//verificar conexion
if(!$conec){
    die("Error de conexion: ".mysqli_connect_error());
}
//configurar caracteres que sea utf8
//echo"conexion exitosa a mi MySQL";
mysqli_set_charset($conec,"utf8");
return $conec;

}
//conection();  

?>
