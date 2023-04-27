<?php
  require_once ("./clases/usuario.php");

  use Poo\AccesoDatos;
  use Usuario;

  $nombre = isset($_POST["nickName"]) ? $_POST["nickName"]:NULL;
  $contra = isset($_POST["contrasenia"]) ? $_POST["contrasenia"]:NULL;

  if(Usuario::verificarPorNombreContrasenia($nombre,$contra))
  {
    echo "<p> Bienvenidx".($nombre)."</p>";
    header("location: ../perfil.php");
  }
  else
  {
    echo "Usuario Inexistente";
    header("location: ../index.html");
  }

?>