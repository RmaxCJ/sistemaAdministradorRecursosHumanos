<?php
//Creador: Enrique Ramirez
//Descripcion: Clase Validar Usuarios..
//Fecha: 15-11-18
////////////////////////////////////////////////////////

require_once("conexion.inc.php");

class Validar
{
	//
	public $conexion;
	
	function __construct() 
	{
		////
		$this->conexion = new Conexion;
	   	$this->linker = $this->conexion->conectar();
   	}
	
	
	function active($usuario)
	{
		$qry = "select active, contrasena from Usuarios where usuario='$usuario' and activo='A'";
		$sql = mssql_query($qry, $this->linker);
		$rs = mssql_fetch_assoc($sql);
		if($rs)
			$active = $rs["active"];
		else
			$active = 'N';
		
		return $active;
	}
	
	function login($usuario, $contra)
	{
		$result = array();
		
		$qry = "validar 'VALIDAR','$usuario','$contra'";
		//echo 'entro - '.$qry;
		$sql = mssql_query($qry, $this->linker);
		while($rs = mssql_fetch_object($sql))
		{
			$result[] = $rs;
		}
		
		return $result;
	}
	
	
	function datos_usuario($usuario)
	{
		$result = array();
		
		$qry = "select * from Usuarios where usuario='$usuario' and activo='A'";
		$sql = mssql_query($qry, $this->linker);
		while($rs = mssql_fetch_object($sql))
		{
			$result[] = $rs;
		}
		
		return $result;
	}

	function registra_acceso($id_usuario)
	{
		//$result = array();
		$ip = $_SERVER['REMOTE_ADDR'];

		if(!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
           
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		
			$qry = "insert into Accesos values($id_usuario,'$ip',getdate(),null)";
		mssql_query($qry, $this->linker);
		// echo $qry;
	}
}
?>