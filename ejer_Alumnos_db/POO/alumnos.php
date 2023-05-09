<?php
namespace pdoA
{
    use PooA\AccesoDatos;
    use pdo;

    class Alumno
    {
        public int $id;
        public int $legajo;
        public string $foto;
        public string $apellido;
        public string $nombre;
    
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


        public function mostrarDatos() : string
    {
        return $this->id . " - " . $this->legajo . " - " . $this->apellido . " - " . $this->nombre . " - " . $this->foto;
    }
    
    public static function traerTodosLosAlumnos()
    {    
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta = $objetoAccesoDato->retornarConsulta("SELECT id, legajo AS legajo, apellido AS apellido, nombre AS nombre, foto AS foto "
                                                        . "FROM alumnos");        
        
        $consulta->execute();
        
        $consulta->setFetchMode(PDO::FETCH_INTO, new Alumno);                                                

        return $consulta; 
    }
    
    public function insertarElAlumno()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->retornarConsulta("INSERT INTO alumnos (id, legajo, apellido, nombre, foto)"
                                                    . "VALUES(:id, :legajo, :apellido, :nombre, :foto)");
        
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

        $consulta->execute();   
    }
    
    public static function modificarAlumno(int $id, int $legajo, string $apellido, string $nombre, string $foto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->retornarConsulta("UPDATE alumnos SET legajo = :legajo, apellido = :apellido, nombre = :nombre, 
                                                        foto = :foto WHERE id = :id");
        
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);
        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $foto, PDO::PARAM_STR);


        return $consulta->execute();
    }

    public static function eliminarAlumno(Alumno $a)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        
        $consulta =$objetoAccesoDato->retornarConsulta("DELETE FROM alumnos WHERE id = :id");
        
        $consulta->bindValue(':id', $a->id, PDO::PARAM_INT);

        return $consulta->execute();
    }
    
    }

}


?>