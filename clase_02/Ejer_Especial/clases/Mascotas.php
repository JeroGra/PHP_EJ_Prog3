<?php
namespace Animalitos
{

    class Mascota
    {
        //Atributos Publicos
        public string $nombre;
        public string $tipo;
        public int $edad;
        
        //Metodos Publicos
        public function __construct(string $nombre, string $tipo ,int $edad = 0)
        {
            $this->nombre = $nombre;
            $this->tipo = $tipo;
            $this->edad = $edad;
        }

        public function toString():string
        {
            return $this->nombre.", ".$this->tipo.", ".$this->edad."</br>";  
        }
        
        public static function mostrar(Mascota $mascota):string
        {
            return $mascota->toString();

        }
        
        public static function equals(Mascota $m1, Mascota $m2):bool
        {
            try
            {
                return ($m1->nombre == $m2->nombre)&&($m1->tipo == $m2->tipo);
            }
            catch(\Exception)
            {
                return false;
            }
        }

    }
}
?>