<?php
header('Content-Type: text/html; charset=ISO-8859-1');
if ($_REQUEST['cod']==1)
{
$conexion=mysql_connect("localhost","root","lbdt14") or
  die("Problemas en la conexion");
mysql_select_db("paises",$conexion) or
  die("Problemas en la selección de la base de datos");
$registros=mysql_query("SELECT PaisId as Numero,Nombre
                       from pais", $conexion) or
  die("Problemas en el select:".mysql_error());
  echo '<table class="table table-hover">';
  echo '<tr>';
      echo '<th width="150">Numero</th>';
      echo '<th width="150">Pais</th>';
    echo '</tr>';
while ($reg=mysql_fetch_array($registros))
{
  echo '<tr>';
  echo '<td>';
  echo $reg['Numero']."<br>";
  echo '</td>';
  echo '<td>';
  echo $reg['Nombre']."<br>";
   echo '</td>';
   echo '<td>';
  echo '<a id="edit" href="javascript:void(0);">Editar</a>';
   echo '</td>';
   echo '<td>';
  echo '<a id="delete" href="javascript:void(0);"?>Borrar</a>';
   echo '</td>';
 echo '</tr>';
}
echo '</table>';
mysql_close($conexion);
}
if ($_REQUEST['cod']==2)
{
$conexion=mysql_connect("localhost","root","lbdt14") or
  die("Problemas en la conexion");
mysql_select_db("abm",$conexion) or
  die("Problemas en la selección de la base de datos");
$registros=mysql_query("SELECT idTable, Nombre, CantPersonas
                       from tables", $conexion) or
  die("Problemas en el select:".mysql_error());
  echo '<table class="table table-hover">';
  echo '<tr>';
      echo '<th width="150">Id</th>';
      echo '<th width="150">Nombre</th>';
      echo '<th width="150">Tamaño</th>';
    echo '</tr>';
while ($reg=mysql_fetch_array($registros))
{
  echo '<tr>';
  echo '<td>';
  echo $reg['idTable']."<br>";
  echo '</td>';
  echo '<td>';
  echo $reg['Nombre']."<br>";
   echo '</td>';
   echo '<td>';
  echo $reg['CantPersonas']."<br>";
   echo '</td>';
   echo '<td>';
  echo '<a id="edit" href="javascript:void(0);">Editar</a>';
   echo '</td>';
   echo '<td>';
  echo '<a id="delete" href="javascript:void(0);"?>Borrar</a>';
   echo '</td>';
 echo '</tr>';
}
echo '</table>';
mysql_close($conexion);
}
if ($_REQUEST['cod']==3)
  echo "<strong>Géminis:</strong> Los asuntos de hoy tienen 
  que ver con las amistades, reuniones, actividades con ellos. Día esperanzado, 
  ilusiones. Mucha energía sexual y fuerza emocional. Deseos difíciles 
  de controlar.";
if ($_REQUEST['cod']==4)
  echo "<strong>Cancer:</strong> Este día la profesión 
  y las relaciones con superiores y con tu madre serán de importancia. Actividad 
  en relación a estos temas. Momentos positivos con compañeros de 
  trabajo. Actividad laboral agradable.";
if ($_REQUEST['cod']==5)
  echo "<strong>Leo:</strong> Este día los estudios, los 
  viajes, el extranjero y la espiritualidad serán lo importante. Pensamientos, 
  religión y filosofía también. Vivencias kármicas de 
  la época te vuelven responsable tomando decisiones.";
?>