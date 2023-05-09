<?php

require_once ("accesoDatos.php");
require_once ("alumnos.php");

use pooA\AccesoDatos;
use pdoA\Alumno;

$op = isset($_POST['op']) ? $_POST['op'] : NULL;

switch ($op) {
    case 'accesoDatos':

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->retornarConsulta("select id, legajo AS legajo, apellido AS apellido, nombre AS nombre, "
                                                        . "foto AS foto "
                                                        . "FROM alumnos");
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new Alumno);
        
        foreach ($consulta as $a) {
        
            print_r($a->mostrarDatos());
            print("\n");
        }

        break;
 
    case 'mostrarTodos':

        $as = Alumno::traerTodosLosAlumnos();
        
        foreach ($as as $a) {
            
            print_r($a->mostrarDatos());
            print("\n");
        }
    
        break;

    case 'insertarAlum':
    
        $miA = new Alumno();
        $miA->id = 100;
        $miA->legajo = 12930;
        $miA->apellido = "Granadillo" ;
        $miA->nombre = "Jeronimo";
        $miA->foto = "./archivos/fotos_alumnos/macaco.png";
        
        $miA->insertarElAlumno();

        echo "ok";
        
        break;

    case 'modificarAlum':
    
        $id = $_POST['id'];        
        $legajo = $_POST['legajo'];
        $apellido = $_POST['apellido'];
        $nombre = $_POST['nombre'];
        $foto = $_POST['foto'];
    
        echo Alumno::modificarAlumno($id, $legajo, $apellido, $nombre, $foto);
            
        break;

    case 'modificarAlum_json':
    
        $obj = json_decode($_POST['obj_json']);
        $id = $obj->id;        
        $legajo = $obj->legajo;
        $apellido = $obj->apellido;
        $nombre = $obj->nombre;
        $foto = $obj->foto;
 
        //var_dump($obj);  
         
        echo Alumno::modificarAlumno($id, $legajo, $apellido, $nombre, $foto);
            
        break;
    
    case 'eliminarAlum':
    
        $miA = new Alumno();
        $miA->id = 55;
        
        echo $miA::eliminarAlumno($miA);
        break;
        
    default:
        echo ":(";
        break;
}
