<?php
class UsuarioP
{
    private $id_user;
    private $nombre;
    private $apellido;
    private $gmail;
    private $password;
    private $tipo_usuario;
    public function __construct($gmail, $password, $nombre = null, $apellido = null, $id_user = null, $tipo_usuario = null)
    {
        $this->id_user = $id_user;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->gmail = $gmail;
        $this->password = $password;
        $this->tipo_usuario = $tipo_usuario;
    }
    public function login()
    {
        include('../modelo/conexiondb.php');
        $con = conection();

        $email = mysqli_real_escape_string($con, $this->gmail);
        $password = mysqli_real_escape_string($con, $this->password);

        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
        $query = mysqli_query($con, $sql);

        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            // Iniciar sesion y guardar la informacion del usuario
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

            mysqli_close($con);

            if ($row['tipo_usuario'] == 1) {
                header("Location: ../vista/dasboar.php");
            } else if ($row['tipo_usuario'] == 2) {
                header("Location: ../vista/menu.php");
            } else {
                header("Location: ../vista/dasboar.php");
            }
            exit();
        } else {
            mysqli_close($con);
            echo "
            <script>
                alert('Datos incorrectos');
                window.location='../index.php';
            </script>";
        }
    }
    public function eliminar($id_user)
    {
        include('../modelo/conexiondb.php');
        $con = conection();
        $sql = "DELETE FROM usuarios WHERE id_user =$id_user";
        $query = mysqli_query($con, $sql);
        if ($query) {
            if (mysqli_affected_rows($con) > 0) {
                echo "
                <script>
               alert('Dato eliminado con exito');
                 window.location='../vista/dasboar.php';
                </script> ";
            } else {
                echo 'Error al eliminar' . mysqli_error($con);
            }
        } else {
            echo 'Error eliminar' . mysqli_error($con);

        }
        mysqli_close($con);
    }

    public function agregar($nombre, $apellido, $email, $password, $tipo_usuario)
    {
        include('../modelo/conexiondb.php');
        $con = conection();

        $sql = "INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) 
                VALUES ('$nombre', '$apellido', '$email', '$password', '$tipo_usuario')";

        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "<script>
                alert('Usuario agregado con exito');
                window.location='../vista/dasboar.php';
                </script>";
        } else {
            echo "Error al agregar: " . mysqli_error($con);
        }

        mysqli_close($con);
    }

    public function actualizar($id_user, $nombre, $apellido, $email, $password, $tipo_usuario)
    {
        include('../modelo/conexiondb.php');
        $con = conection();

        $sql = "UPDATE usuarios 
                SET nombre = '$nombre', 
                    apellido = '$apellido', 
                    email = '$email', 
                    password = '$password', 
                    tipo_usuario = '$tipo_usuario' 
                WHERE id_user = '$id_user'";

        $query = mysqli_query($con, $sql);

        if ($query) {
            echo "<script>
                alert('Usuario actualizado con exito');
                window.location='../vista/dasboar.php';
                </script>";
        } else {
            echo "Error al actualizar: " . mysqli_error($con);
        }

        mysqli_close($con);
    }

}
?>
