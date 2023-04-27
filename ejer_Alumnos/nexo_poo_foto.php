<?php 
require_once "./clases.php";

use Institucion\Alumno;

session_unset();

function AgregarImagen():string
{
	$destino = "./archivos/fotos/" . $_FILES["archivo"]["name"];

$uploadOk = TRUE;

//PATHINFO RETORNA UN ARRAY CON INFORMACION DEL PATH
//RETORNA : NOMBRE DEL DIRECTORIO; NOMBRE DEL ARCHIVO; EXTENSION DEL ARCHIVO

//PATHINFO_DIRNAME - retorna solo nombre del directorio
//PATHINFO_BASENAME - retorna solo el nombre del archivo (con la extension)
//PATHINFO_EXTENSION - retorna solo extension
//PATHINFO_FILENAME - retorna solo el nombre del archivo (sin la extension)

var_dump(pathinfo($destino));

$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);
echo $tipoArchivo;

//VERIFICO QUE EL ARCHIVO NO EXISTA
if (file_exists($destino)) {
    echo "El archivo ya existe. Verifique!!!";
    $uploadOk = FALSE;
}
//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
if ($_FILES["archivo"]["size"] > 500000 ) {
    echo "El archivo es demasiado grande. Verifique!!!";
    $uploadOk = FALSE;
}

//VERIFICO SI ES UNA IMAGEN O NO
var_dump(getimagesize($_FILES["archivo"]["tmp_name"]));

//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
//IMAGEN, RETORNA FALSE
$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);

if($esImagen === FALSE) {//NO ES UNA IMAGEN

	//SOLO PERMITO CIERTAS EXTENSIONES
	if($tipoArchivo != "doc" && $tipoArchivo != "txt" && $tipoArchivo != "rar") {
		echo "Solo son permitidos archivos con extension DOC, TXT o RAR.";
		$uploadOk = FALSE;
	}
}
else {// ES UNA IMAGEN

	//SOLO PERMITO CIERTAS EXTENSIONES
	if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
		&& $tipoArchivo != "png") {
		echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
		$uploadOk = FALSE;
	}

}

//VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
if ($uploadOk === FALSE) {

    echo "<br/>NO SE PUDO SUBIR EL ARCHIVO.";

} 
else {
	//MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) {
        echo "<br/>El archivo ". basename( $_FILES["archivo"]["name"]). " ha sido subido exitosamente.";
    } else {
        echo "<br/>Lamentablemente ocurri&oacute; un error y no se pudo subir el archivo.";
    }
}

return $destino;

}





//RECUPERO TODOS LOS VALORES (POST)
$tipoEjemplo = isset($_POST["tipoEjemplo"]) ? $_POST["tipoEjemplo"] : 0;
$legajo = isset($_POST["legajo"]) ? (int) $_POST["legajo"] : 0;
$apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : NULL;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;

//$archivo = isset($_POST["archivo"]) ? $_POST["archivo"] : NULL;



//CRUD - SOBRE ARCHIVOS


switch($tipoEjemplo)
{
	case "agregar"://Create (Alta)

		$path = AgregarImagen();

		$obj = new Alumno($legajo, $apellido, $nombre, $path);

		if(Alumno::agregar($obj)){

			echo "<h2> registro AGREGADO </h2><br/>";	
		}

		break;

	case "listar"://Read (listar)

		echo Alumno::listar();

		break;

    case "obtener":

        echo Alumno::verificar($legajo);
		var_dump(Alumno::verificar($legajo));

        break;

	case "modificar"://Update (Modificar)
		$path = AgregarImagen();

		$obj = new Alumno($legajo, $apellido, $nombre, $path);

		if(Alumno::modificar($obj))
		{
			echo "<h2> registro MODIFICADO </h2><br/>";			
		}

		break;

	case "eliminar"://Delete (Borrar)

		if(Alumno::borrar($legajo))
		{
			echo "<h2> registro BORRADO </h2><br/>";			
		}

		break;
	case "redirigir":
		$respuesta = Alumno::verificar($legajo);
		if($respuesta == "El alumno con legajo {$legajo} se encuentra en el listado")
		{
			$alum = new Alumno(0,"","","");
			$alum = Alumno::Obtener($legajo);
			session_start();
			$_SESSION["legajo"] = $legajo;
			$_SESSION["apellido"] = $alum->apellido;
			$_SESSION["nombre"] = $alum->nombre;
			$_SESSION["foto"] = $alum->foto;
			header('Location: http://localhost/Prog_3/ejer_Alumnos/principal.php');
			$hora = date("Y-m-d H:i:s");
			setcookie("Ingreso del alumno legajo $legajo, a las $hora)");
		}
		else
		{
			echo $respuesta;
			header('Location: http://localhost/Prog_3/ejer_Alumnos/index.html');
		}
		break;	
				
	default:
		echo "<h2> Sin ejemplo </h2>";
	
}

echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo" <a href=http://localhost/Prog_3/ejer_Alumnos/index.html>Volver a Inicio</a>";
?>