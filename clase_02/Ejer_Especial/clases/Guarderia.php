<?php
namespace Negocios
{

    require_once "Mascotas.php";
    use Animalitos\Mascota;
    use Exception;
    class Guarderia
    {
        public string $nombre;
        public $mascotas = []; 

        public function __construct(string $nombre)
        {
            $this->nombre = $nombre;
        }

        public function equals(Guarderia $g1, Mascota $m1):bool
        {
            try
            {
                $exist = false;
                foreach($g1->mascotas as $mascota)
                {
                    if(Mascota::equals($m1,$mascota))
                    {
                        $exist = true;
                        break;
                    }
                }
                return $exist;

            }
            catch(Exception)
            {
                return false;
            }
        }
 
        public function add(Mascota $m1):bool
        {
            $added = false;
            if(!$this->equals($this,$m1))
            {
                array_push($this->mascotas,$m1);
                $added = true;
            }
            return $added;
        }

        public function toString():string
        {
            $str = $this->nombre."</br>"."Mascotas </br>"."</br>";

            for($i = 0;$i<count($this->mascotas);$i++)
            {
                $str = $str.$this->mascotas[$i]->toString();
            }

            $str = $str."</br> Promedio de vida 20 años";

            return $str;
        }

    }
}

?>