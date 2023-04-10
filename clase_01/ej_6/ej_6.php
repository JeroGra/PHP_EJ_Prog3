<?php
$operador;
$op1;
$op2;
///Suponemos que se seleccionan los numeros y la operacion:

$op1 = 1;
$op2 = 1;
$operador = "*";
$resultado = 0;

switch($operador)
{
    case "+":
        $resultado = $op1 + $op2;
        break;
    case "-":
        $resultado = $op1 - $op2;
        break;
    case "*":
        $resultado = $op1 * $op2;
        break;
    case "/":
        $resultado = $op1 / $op2;
    break;
}

echo $op1." ". $operador." " . $op2 . " = " . $resultado;

?>

