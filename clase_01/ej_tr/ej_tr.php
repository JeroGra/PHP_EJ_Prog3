<?php

$lineas = 100;
$aster = "*";

/*for($i=0;$i<10;$i++)
{
    echo $aster."</br>";
    $aster = $aster."*";
}*/

$space = "&nbsp";
for($i=0;$i<$lineas;$i++)
{
    for($x=$lineas;$x>$i;$x--)
    {
        $space = $space."&nbsp";
    }
    echo $space.$aster."</br>";
    $aster = $aster."*";
    $space = "&nbsp";
}

?>