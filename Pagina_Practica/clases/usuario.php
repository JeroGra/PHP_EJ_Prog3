<?php
use Poo\AccesoDatos;
use PDO;
 class Usuario
{
    public int $id;
    public string $nickname;
    public string $contrasenia;
    public string $drogaFavorita;
    public int $nivel;
    public string $pathFoto;

   /* public function __construct(int $id = 0,string $nickname, string $contrasenia, string $drogaFavorita, int $nivel = 0, string $path)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->contrasenia = $contrasenia;
        $this->drogaFavorita = $drogaFavorita;
        $this->nivel = $nivel;
        $this->pathFoto = $path;
    }*/

    public function GetId():int
    {
        return $this->id;
    }

    public function GetLvl():int
    {
        return $this->nivel;
    }
    
    public function LevelUp(int $niveles = 1)
    {
        $this->nivel += $niveles;
    }


/// C.R.U.D Archivo TXT

    public static function agregar(Usuario $obj) : bool 
    {

        $retorno = false;

        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "a");

        $cant = fwrite($ar, "{$obj->id}-{$obj->nickname}-{$obj->contrasenia}-{$obj->drogaFavorita}-{$obj->nivel}-{$obj->pathFoto}\r\n");

        if($cant > 0)
        {
            $retorno = true;			
        }

        fclose($ar);

        return $retorno;
    }

    public static function listar() : string 
    {

        $retorno = "";

        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "r");

        while(!feof($ar))
        {
            $retorno .= fgets($ar);		
        }

        fclose($ar);

        return $retorno;
    }

    public static function verificar(int $id) : string 
    {

        $retorno ="No se encontro el Usuarios con el id {$id}";


        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "r");

      
        while(!feof($ar))
        {
            $linea = fgets($ar);
            $array_linea = explode("-", $linea);
            $array_linea[0] = trim($array_linea[0]);
            if($array_linea[0] != ""){
               
                $id_archivo = trim($array_linea[0]);
                $nickname_archivo = trim($array_linea[1]);
                $contrasenia_archivo = trim($array_linea[2]);
                $dorga_archivo = trim($array_linea[3]);
                $nivel_archivo = trim($array_linea[4]);
                $pathFoto_archivo = trim($array_linea[5]);
                if($id_archivo == $id)
                {
                    $retorno = "El Usuario con el ID {$id} se encuentra en el listado";
                    break;
                }
            }		
        }

        fclose($ar);

        return $retorno;
    }

    public static function verificarPorNombreContrasenia(string $name, string $contra) : bool 
    {

        $retorno = false;


        $ar = fopen(".../archivos/usuario.txt", "r");

      
        while(!feof($ar))
        {
            $linea = fgets($ar);
            $array_linea = explode("-", $linea);
            $array_linea[0] = trim($array_linea[0]);
            if($array_linea[0] != ""){
               
                $id_archivo = trim($array_linea[0]);
                $nickname_archivo = trim($array_linea[1]);
                $contrasenia_archivo = trim($array_linea[2]);
                $dorga_archivo = trim($array_linea[3]);
                $nivel_archivo = trim($array_linea[4]);
                $pathFoto_archivo = trim($array_linea[5]);
                if(($nickname_archivo ==  $name)&&($contrasenia_archivo == $contra))
                {
                    $retorno = true;
                    break;
                }
            }		
        }
        fclose($ar);

        return $retorno;
    }



    public static function modificar(Usuario $obj) : bool 
    {

        $retorno = false;

        $usuario = array();

        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "r");

        while(!feof($ar))
        {
            $linea = fgets($ar);
            $array_linea = explode("-", $linea);

            $array_linea[0] = trim($array_linea[0]);

            if($array_linea[0] != ""){

                $id_archivo = trim($array_linea[0]);
                $nickname_archivo = trim($array_linea[1]);
                $contrasenia_archivo = trim($array_linea[2]);
                $dorga_archivo = trim($array_linea[3]);
                $nivel_archivo = trim($array_linea[4]);
                $pathFoto_archivo = trim($array_linea[5]);

                if ($id_archivo == $obj->id) 
                { 
                    array_push($usuario, "{$id_archivo}-{$obj->nickname}-{$obj->contrasenia}-{$obj->drogaFavorita}-{$nivel_archivo}-{$obj->pathFoto}\r\n");
                }
                else
                {
                    array_push($usuario, "{$id_archivo}-{ $nickname_archivo}-{ $contrasenia_archivo}-{$dorga_archivo}-{$nivel_archivo}-{$pathFoto_archivo}\r\n");
                }
            }
        }

        fclose($ar);

        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "w");

        $cant = 0;
        
        foreach($usuario AS $item){

            $cant = fwrite($ar, $item);
        }

        if($cant > 0)
        {
            $retorno = true;			
        }

        fclose($ar);

        return $retorno;
    }

    public static function borrar(int $id) : bool 
    {

        $retorno = false;

        $usuario = array();


        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "r");


        while(!feof($ar))
        {
            $linea = fgets($ar);

            $array_linea = explode("-", $linea);

            $array_linea[0] = trim($array_linea[0]);

            if($array_linea[0] != ""){

 
                $id_archivo = trim($array_linea[0]);
                $nickname_archivo = trim($array_linea[1]);
                $contrasenia_archivo = trim($array_linea[2]);
                $dorga_archivo = trim($array_linea[3]);
                $nivel_archivo = trim($array_linea[4]);
                $pathFoto_archivo = trim($array_linea[5]);
                if ( $id_archivo == $id) {
                    
                    continue;
                }

                array_push($usuario, "{$id_archivo}-{ $nickname_archivo}-{ $contrasenia_archivo}-{$dorga_archivo}-{$nivel_archivo}-{$pathFoto_archivo}\r\n");
            }
        }


        fclose($ar);

        $cant = 0;


        $ar = fopen("./Pagina_Practica/archivos/usuario.txt", "w");

 
        foreach($usuario AS $item){

            $cant = fwrite($ar, $item);
        }

        if($cant > 0)
        {
            $retorno = true;			
        }


        fclose($ar);

        return $retorno;
    }

    /// C.R.U.D Base De Datos
public static function TraerUsuarios()
{    
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    
    $consulta = $objetoAccesoDato->retornarConsulta("SELECT id, nickname AS nickname, "
                                                   . "contrasenia AS contrasenia, drogaFavorita AS drogaFavorita, "  
                                                   . "nivel AS nivel, pathFoto AS pathFoto FROM usuarios");        
    $consulta->execute();
    
    $consulta->setFetchMode(PDO::FETCH_INTO, new Usuario);                                                

    return $consulta; 
}

public function insertarElUsuario()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    
    $consulta =$objetoAccesoDato->retornarConsulta("INSERT INTO usuarios (id, nickname, contrasenia, drogaFavorita, nivel, pathFoto)"
                                                . "VALUES(:id, :nickname, :contrasenia, :drogaFavorita, :nivel, :pathFoto)");
    
    $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
    $consulta->bindValue(':nickname', $this->nickname, PDO::PARAM_STR);
    $consulta->bindValue(':contrasenia', $this->contrasenia, PDO::PARAM_INT);
    $consulta->bindValue(':drogaFavorita', $this->drogaFavorita, PDO::PARAM_STR);
    $consulta->bindValue(':nivel', $this->nivel, PDO::PARAM_INT);
    $consulta->bindValue(':pathFoto', $this->pathFoto, PDO::PARAM_INT);

    $consulta->execute();   
}

/* public static function modificarCD(int $id, string $titulo, int $anio, string $cantante)
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    
    $consulta =$objetoAccesoDato->retornarConsulta("UPDATE cds SET titel = :titulo, interpret = :cantante, 
                                                    jahr = :anio WHERE id = :id");
    
    $consulta->bindValue(':id', $id, PDO::PARAM_INT);
    $consulta->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);
    $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);

    return $consulta->execute();
}

public static function eliminarCD(Cd $cd)
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    
    $consulta =$objetoAccesoDato->retornarConsulta("DELETE FROM cds WHERE id = :id");
    
    $consulta->bindValue(':id', $cd->id, PDO::PARAM_INT);

    return $consulta->execute();
}*/

}

?>