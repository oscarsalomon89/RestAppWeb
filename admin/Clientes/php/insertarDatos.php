<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$nom ="$_POST[nombre]";
$conexion=mysql_connect("localhost","root","lbdt14") or
  die("Problemas en la conexion");
mysql_select_db("paises",$conexion) or
  die("Problemas en la selección de la base de datos");
mysql_query("INSERT into pais (Nombre) values 
   ('$nom')", 
   $conexion) or die("Problemas en el select".mysql_error());
mysql_close($conexion);
echo "El pais fue dado de alta.";
?>