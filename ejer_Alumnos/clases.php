<?php
namespace Institucion
{

    use Institucion\Alumno as InstitucionAlumno;

    class Alumno
    {
        public int $legajo;
        public string $foto;
        public string $apellido;
        public string $nombre;

        public function __construct(int $legajo, string $apellido, string $nombre, string $path)
        {
            $this->legajo = $legajo;
            $this->apellido = $apellido;
            $this->nombre = $nombre;
            $this->foto = $path;        
        }

        //Creada de ante mano por si es necesario pasar el legajo como string
        public function lToString():string
        {
            return (string)$this->legajo;
        }
        //Creada de ante mano por si es necesario re convertir el legajo como int
        public function ParseL(string $num):int
        {
            return (int)$num;
        }



        public static function agregar(Alumno $obj) : bool 
        {

            $retorno = false;
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "a");
    
            //ESCRIBO EN EL ARCHIVO 
            $cant = fwrite($ar, "{$obj->legajo}-{$obj->apellido}-{$obj->nombre}-{$obj->foto}\r\n");
    
            if($cant > 0)
            {
                $retorno = true;			
            }

            //CIERRO EL ARCHIVO
            fclose($ar);
    
            return $retorno;
        }

        public static function listar() : string {

            $retorno = "";
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "r");
    
            //LEO LINEA X LINEA DEL ARCHIVO 
            while(!feof($ar))
            {
                $retorno .= fgets($ar);		
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            return $retorno;
        }

        public static function verificar(int $legajo) : string {

            $retorno ="No se encontro el alumno con el legajo {$legajo}";
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "r");
    
            //LEO LINEA X LINEA DEL ARCHIVO 
            while(!feof($ar))
            {
                $linea = fgets($ar);
                $array_linea = explode("-", $linea);
                $array_linea[0] = trim($array_linea[0]);
                if($array_linea[0] != ""){
                    //RECUPERO LOS CAMPOS
                    $legajo_archivo = trim($array_linea[0]);
                    $apellido_archivo = trim($array_linea[1]);
                    $nombre_archivo = trim($array_linea[2]);
                    $foto_archivo = trim($array_linea[3]);
                    if($legajo_archivo == $legajo)
                    {
                        $retorno = "El alumno con legajo {$legajo} se encuentra en el listado";
                        break;
                    }
                }		
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            return $retorno;
        }

        public static function modificar(Alumno $obj) : bool {

            $retorno = false;
    
            $alumnos = array();
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "r");
    
            //LEO LINEA X LINEA DEL ARCHIVO 
            while(!feof($ar))
            {
                $linea = fgets($ar);
                //http://www.w3schools.com/php/func_string_explode.asp
                $array_linea = explode("-", $linea);
    
                $array_linea[0] = trim($array_linea[0]);
    
                if($array_linea[0] != ""){
                    //RECUPERO LOS CAMPOS
                    $legajo_archivo = trim($array_linea[0]);
                    $apellido_archivo = trim($array_linea[1]);
                    $nombre_archivo = trim($array_linea[2]);
                    $foto_archivo = trim($array_linea[3]);
    
                    if ($legajo_archivo == $obj->legajo) 
                    { 
                        array_push($alumnos, "{$legajo_archivo}-{$obj->apellido}-{$obj->nombre}-{$obj->foto}\r\n");
                    }
                    else
                    {
                        array_push($alumnos, "{$legajo_archivo}-{$apellido_archivo}-{$nombre_archivo}-{$foto_archivo}\r\n");
                    }
                }
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "w");
    
            $cant = 0;
            
            //ESCRIBO EN EL ARCHIVO
            foreach($alumnos AS $item){
    
                $cant = fwrite($ar, $item);
            }
    
            if($cant > 0)
            {
                $retorno = true;			
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            return $retorno;
        }

        public static function borrar(int $legajo) : bool {

            $retorno = false;
    
            $alumnos = array();
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "r");
    
            //LEO LINEA X LINEA DEL ARCHIVO 
            while(!feof($ar))
            {
                $linea = fgets($ar);
                //http://www.w3schools.com/php/func_string_explode.asp
                $array_linea = explode("-", $linea);
    
                $array_linea[0] = trim($array_linea[0]);
    
                if($array_linea[0] != ""){
    
                    //RECUPERO LOS CAMPOS
                    $legajo_archivo = trim($array_linea[0]);
                    $apellido_archivo = trim($array_linea[1]);
                    $nombre_archivo = trim($array_linea[2]);
                    $foto_archivo = trim($array_linea[3]);
                    if ($legajo_archivo == $legajo) {
                        
                        continue;
                    }
    
                    array_push($alumnos, "{$legajo_archivo}-{$apellido_archivo}-{$nombre_archivo}-{$foto_archivo}\r\n");
                }
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            $cant = 0;
    
            //ABRO EL ARCHIVO
            $ar = fopen("./archivos/alumnos_foto.txt", "w");
    
            //ESCRIBO EN EL ARCHIVO
            foreach($alumnos AS $item){
    
                $cant = fwrite($ar, $item);
            }
    
            if($cant > 0)
            {
                $retorno = true;			
            }
    
            //CIERRO EL ARCHIVO
            fclose($ar);
    
            return $retorno;
        }
        public static function Obtener(int $legajo):Alumno
        {
            $alumno = new Alumno($legajo,"","","");

            $ar = fopen("./archivos/alumnos_foto.txt", "r");           
            while(!feof($ar))
            {
                $linea = fgets($ar);
                $array_linea = explode("-", $linea);
                $array_linea[0] = trim($array_linea[0]);
                if($array_linea[0] != ""){
                    //RECUPERO LOS CAMPOS
                    $legajo_archivo = trim($array_linea[0]);
                    $apellido_archivo = trim($array_linea[1]);
                    $nombre_archivo = trim($array_linea[2]);
                    $foto_archivo = trim($array_linea[3]);
                    if($legajo_archivo == $legajo)
                    {
                        $alumno->apellido = $apellido_archivo;
                        $alumno->nombre = $nombre_archivo;
                        $alumno->foto = $foto_archivo;
                        break;
                    }
                }		
           }
           fclose($ar);
           return $alumno;
       }
    }
}  

?>