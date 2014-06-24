<?php
include_once ("clases/clase.php");// incluyo las clases a ser usadas

switch ($_REQUEST['cod'])
{
    case 1:
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
break;   
    case 2:
$conexion=mysql_connect("localhost","root","lbdt14") or
  die("Problemas en la conexion");
mysql_select_db("abm",$conexion) or
  die("Problemas en la selección de la base de datos");
$registros=mysql_query("SELECT idTable, Nombre, CantPersonas
                       from tables", $conexion) or
  die("Problemas en el select:".mysql_error());
  echo '<div class="bar">
    <button id="new" class="btn btn-primary btn-lg">
  Nueva Mesa
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel"></h3>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
</div>';
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
  echo '<a id="edit" href="#">Editar</a>';
   echo '</td>';
   echo '<td>';
  echo '<a id="delete" href="#"?>Borrar</a>';
   echo '</td>';
 echo '</tr>';
}
echo '</table>';
mysql_close($conexion);
break;
    case 3:
        $view->clientes=Cliente::getClientes();
        $view->contentTemplate="templates/clientesGrid.php"; // seteo el template que se va a mostrar
        break;
    case 4:
        // limpio todos los valores antes de guardarlos
        // por ls dudas venga algo raro
        $id=intval($_POST['id']);
        $nombre=cleanString($_POST['nombre']);
        $apellido=cleanString($_POST['apellido']);
        $fecha=cleanString($_POST['fecha']);
        $peso=cleanString($_POST['peso']);
        $cliente=new Cliente($id);
        $cliente->setNombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setFecha($fecha);
        $cliente->setPeso($peso);
        $cliente->save();
        break;
    case 5:
        $view->client=new Cliente();
        $view->disableLayout=true;
        $view->contentTemplate="templates/clientForm.php"; // seteo el template que se va a mostrar
        break;
    case 'editClient':
        $editId=intval($_POST['id']);
        $view->client=new Cliente($editId);
        $view->disableLayout=true;
        $view->contentTemplate="templates/clientForm.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteClient':
        $id=intval($_POST['id']);
        $view->client=new Cliente($id);
        $view->disableLayout=true;
        $view->contentTemplate="templates/deleteForm.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteClientPost':
        $id=intval($_POST['id']);
        $client=new Cliente($id);
        $client->delete();
        break;
    default :
}