<?php
session_start();
echo "<h1> PAGINA PRINCIPAL </h1>";
echo "<h1>".$_SESSION["legajo"]."</h1>";
echo "<h2>".$_SESSION["apellido"]." ".$_SESSION["nombre"]."</h1>";
echo "<img src=".$_SESSION["foto"]." />";
echo "<table><tr><td>".$_SESSION["legajo"]."</td><td>".$_SESSION["apellido"]." ".$_SESSION["nombre"]."</td><td>".$_SESSION["foto"]."</td></tr></table>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo" <a href=http://localhost/Prog_3/ejer_Alumnos/index.html>Volver a Inicio</a>";
?>