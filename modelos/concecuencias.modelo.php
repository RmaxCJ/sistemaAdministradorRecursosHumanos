<?php
	require_once "conexion.php";
	class ModeloConsecuencias{

        static public function mdlIngresarAddConsecuencias($tabla,$datos)
        {
			
			conexion::conectar();

			$query = "insert into ".$tabla." (pais,amonestacion)values('".$datos['pais']."','".$datos['amonestacion']."')";

			if(mssql_query($query)){
				return "ok";
			}else{
				return "error";
			}
		}
	}