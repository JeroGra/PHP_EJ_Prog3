<?php
namespace Funciones
{
    function GenerarId():int
    {
        $nuevoId = "";
        $error = false;

        $ar = fopen("./Pagina_Practica/archivos/ultimoId.txt", "r");

        $nuevoId .= fgets($ar);

        fclose($ar);

        (int)$nuevoId ++;

        $ar = fopen("./Pagina_Practica/archivos/ultimoId.txt", "w");

        $error = fwrite($ar,$nuevoId);

        fclose($ar);

        if($error)
        {
            $nuevoId = -1;
        }

        return $nuevoId;
    }
}


?>