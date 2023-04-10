<?php

$contNumeros = 0;
$suma = 1;
$numX;

for($i=1;$suma < 1000;$i++)
{
    $numX = $suma;
    $suma += $i;
    if($suma < 1000)
    {
        echo $i . " + " . $numX . " = " . $suma;
        echo "</br>";
        $contNumeros += 2;
    }
    else
    {
        break;
    }
}

echo "</br> Se sumaron " . $contNumeros ." Numeros";

?>