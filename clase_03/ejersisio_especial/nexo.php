<?php 
require_once "./clases.php";

use Institucion\Alumno;

//RECUPERO TODOS LOS VALORES (POST)
$tipoEjemplo = isset($_POST["tipoEjemplo"]) ? $_POST["tipoEjemplo"] : 0;
$legajo = isset($_POST["legajo"]) ? (int) $_POST["legajo"] : 0;
$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : NULL;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;

//RECUPERO VALORES POR (GET)
$listarGet = isset($_GET["listarGet"]) ? $_GET["listarGet"] : 0;
if($listarGet = "listarGet")
{
    $tipoEjemplo = "listar";
}

//****************************************** */
//CRUD - SOBRE ARCHIVOS
//****************************************** */

switch($tipoEjemplo)
{
	case "agregar"://Create (Alta)

		$obj = new Alumno($legajo, $apellido, $nombre);

		if(Alumno::agregar($obj)){

			echo "<h2> registro AGREGADO </h2><br/>";	
		}

		break;

	case "listar"://Read (listar)

		echo Alumno::listar();

		break;

    case "verificar":

        echo Alumno::verificar($legajo);

        break;

	case "modificar"://Update (Modificar)

		$obj = new Alumno($legajo, $apellido, $nombre);

		if(Alumno::modificar($obj))
		{
			echo "<h2> registro MODIFICADO </h2><br/>";			
		}

		break;

	case "borrar"://Delete (Borrar)

		if(Alumno::borrar($legajo))
		{
			echo "<h2> registro BORRADO </h2><br/>";			
		}

		break;
				
	default:
		echo "<h2> Sin ejemplo </h2>";
}


?>