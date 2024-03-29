﻿<?php
class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']="root";         //  usuario
		$conection['pass']="lbdt14";             //password
		$conection['base']="abm";           //base de datos
		
		// crea la conexion pasandole el servidor , usuario y clave
		$conect= mysql_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) // si la conexion fue exitosa , selecciona la base
		{
			mysql_select_db($conection['base']);			
			$this->con=$conect;
		}
	}
	function getConexion() // devuelve la conexion
	{
		return $this->con;
	}
	function Close()  // cierra la conexion
	{
		mysql_close($this->con);
	}	

}
class sQuery   // se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	var $coneccion;
	var $consulta;
	var $resultados;
	function sQuery()  // constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->coneccion= new Conexion();
	}
	function executeQuery($cons)  // metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
	{
		$this->consulta= mysql_query($cons,$this->coneccion->getConexion());
		return $this->consulta;
	}	
	function getResults()   // retorna la consulta en forma de result.
	{return $this->consulta;}
	
	function Close()		// cierra la conexion
	{$this->coneccion->Close();}	
	
	function Clean() // libera la consulta
	{mysql_free_result($this->consulta);}
	
	function getResultados() // debuelve la cantidad de registros encontrados
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}
	
	function getAffect() // devuelve las cantidad de filas afectadas
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}

    function fetchAll()
    {
        $rows=array();
		if ($this->consulta)
		{
			while($row=  mysql_fetch_array($this->consulta))
			{
				$rows[]=$row;
			}
		}
        return $rows;
    }
}


//Clase Cliente

class Cliente
{
	var $nombre;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $apellido;
	var $fecha;
	Var $peso;
	Var $id;

    public static function getClientes() 
		{
			$obj_cliente=new sQuery();
			$obj_cliente->executeQuery("select * from clientes"); // ejecuta la consulta para traer al cliente

			return $obj_cliente->fetchAll(); // retorna todos los clientes
		}

	function Cliente($nro=0) // declara el constructor, si trae el numero de cliente lo busca , si no, trae todos los clientes
	{
		if ($nro!=0)
		{
			$obj_cliente=new sQuery();
			$result=$obj_cliente->executeQuery("select * from clientes where id = $nro"); // ejecuta la consulta para traer al cliente 
			$row=mysql_fetch_array($result);
			$this->id=$row['id'];
			$this->nombre=$row['nombre'];
			$this->apellido=$row['apellido'];
			$this->fecha=$row['fecha_nac'];
			$this->peso=$row['peso'];
		}
	}
		
		// metodos que devuelven valores
	function getID()
	 { return $this->id;}
	function getNombre()
	 { return $this->nombre;}
	function getApellido()
	 { return $this->apellido;}
	function getFecha()
	 { return $this->fecha;}
	function getPeso()
	 { return $this->peso;}
	 
		// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setApellido($val)
	 {  $this->apellido=$val;}
	function setFecha($val)
	 {  $this->fecha=$val;}
	function setPeso($val)
	 {  $this->peso=$val;}

    function save()
    {
        if($this->id)
        {$this->updateCliente();}
        else
        {$this->insertCliente();}
    }
	private function updateCliente()	// actualiza el cliente cargado en los atributos
	{
			$obj_cliente=new sQuery();
			$query="update clientes set nombre='$this->nombre', apellido='$this->apellido',fecha_nac='$this->fecha',peso='$this->peso' where id = $this->id";
			$obj_cliente->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	
	}
	private function insertCliente()	// inserta el cliente cargado en los atributos
	{
			$obj_cliente=new sQuery();
			$query="insert into clientes( nombre, apellido, fecha_nac,peso)values('$this->nombre', '$this->apellido','$this->fecha','$this->peso')";
			
			$obj_cliente->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	
	}	

	function delete()	// elimina el cliente
	{
			$obj_cliente=new sQuery();
			$query="delete from clientes where id=$this->id";
			$obj_cliente->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	}	
	
}

//Clase Table

class Table
{
	Var $id;
	var $nombre;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $cantPersons;

    public static function getTables() 
		{
			$obj_table=new sQuery();
			$obj_table->executeQuery("select * from tables"); // ejecuta la consulta para traer al cliente

			return $obj_table->fetchAll(); // retorna todos los clientes
		}

	function Table($nro=0) // declara el constructor, si trae el numero de cliente lo busca , si no, trae todos los clientes
	{
		if ($nro!=0)
		{
			$obj_table=new sQuery();
			$result=$obj_table->executeQuery("select * from tables where idTable = $nro"); // ejecuta la consulta para traer al cliente 
			$row=mysql_fetch_array($result);
			$this->id=$row['idTable'];
			$this->nombre=$row['Nombre'];
			$this->cantPersons=$row['CantPersonas'];
		}
	}
		
		// metodos que devuelven valores
	function getID()
	 { return $this->id;}
	function getNombre()
	 { return $this->nombre;}
	function getCantPersons()
	 { return $this->cantPersons;}
	 
		// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=$val;}
	function setCantPersons($val)
	 {  $this->cantPersons=$val;}

    function save()
    {
        if($this->id)
        {$this->updateTable();}
        else
        {$this->insertTable();}
    }
	private function updateTable()	// actualiza el cliente cargado en los atributos
	{
			$obj_table=new sQuery();
			$query="update tables set Nombre='$this->nombre', CantPersonas='$this->cantPersons' where idTable = $this->id";
			$obj_table->executeQuery($query); // ejecuta la consulta para traer la mesa 
			return $obj_table->getAffect(); // retorna todos los registros afectados
	
	}
	private function insertTable()	// inserta el cliente cargado en los atributos
	{
			$obj_table=new sQuery();
			$query="insert into tables( Nombre, CantPersonas)values('$this->nombre', '$this->cantPersons')";
			
			$obj_table->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_table->getAffect(); // retorna todos los registros afectados
	
	}	

	function delete()	// elimina el cliente
	{
			$obj_table=new sQuery();
			$query="delete from tables where idTable=$this->id";
			$obj_table->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_table->getAffect(); // retorna todos los registros afectados
	}	
	
}

function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);
	
    return $string;
}