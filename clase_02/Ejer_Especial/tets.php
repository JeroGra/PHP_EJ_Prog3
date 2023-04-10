<?php

require_once "./clases/Mascotas.php";
require_once "./clases/Guarderia.php";

use Animalitos\Mascota;
use Negocios\Guarderia;

$m1 = new Mascota("Pocha","Demon",3);
$m2 = new Mascota("Pocha","Perro",);

if(!Mascota::equals($m1,$m2))
{
   echo "Nombre  Tipo   Edad  </br>";
   echo Mascota::mostrar($m1);
    if($m2->tipo == "Perro")
    {
        echo $m2->toString();
        $m3 = new Mascota("Pocha","Demon",5);
        if(Mascota::equals($m3,$m1))
        {
            echo "Son Iguales </br>";
            echo $m1->toString();
            echo Mascota::mostrar($m3);
        }
        else
        {
            echo "Son distintas";
        }
    }

    echo "</br>"."</br>";

    $gr = new Guarderia("La guarderia de Pancho");
    $gr->add($m1);
    $gr->add($m2);
    $gr->add($m3);

    echo $gr->toString();
}

?>