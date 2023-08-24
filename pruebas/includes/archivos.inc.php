<?php
//Creador: Enrique Ramírez
//Descripcion: Sube archivos
//Fecha: 04-06-2019
////////////////////////////////////////////////////////

require_once("conexion.php");

class Archivos
{
	//
	public $conexion;
	
	function __construct() 
	{
		////
		$this->conexion = new Conexion;
	   	$this->linker = $this->conexion->conectar();
   	}
	
	
	function sube_archivo($datos, $tipo_archivo=null)
	{

		$i = 0;
		foreach($datos as $var=>$valor)
		{
			$dato[$i] = $valor;
			$i += 1;
		}
		
		///inserta en tabla
		$qry = "insert into Archivos values($tipo_archivo,$dato[0],'$dato[1]','$dato[2]',$dato[3],getdate(),null)";
		//echo $qry;
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;

		return $resp;
	}


	function max_archivo($anio, $id_tipo)	///maximo id insertado de este tipo de archivo
	{
		$qry = "select top 1 id id_archivo, archivo from Archivos where anio=$anio and id_tipo=$id_tipo order by 1 desc";
		$sql = mssql_query($qry, $this->linker);
		$rs = mssql_fetch_assoc($sql);
		if($rs)
			$archivo = $rs["archivo"];
		else
			$archivo = 0;

		//echo $archivo;
		
		return $archivo;
	}

	function borra_pagos($anio)
	{
		///borra tabla
		$qry = "delete Pagos where anio=$anio";
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
		
		return $resp;
	}


	function registro_batch_pagos($datos, $anio)
	{
		$i = 0;
		foreach($datos as $var=>$valor)
		{
			$dato[$i] = utf8_decode($valor);
			$dato[$i] = trim($dato[$i]);
			$i += 1;
		}

		//buscamos el id_proveedor
		$id_proveedor = 0;
		$qryP = "select a.id_proveedor from Sindicatos a, Divisiones b where a.cod_division=b.cod_division and a.sindicato='$dato[2]' and b.division='$dato[1]'";
		//echo $qryP.'<br>';
		$sqlP = mssql_query($qryP, $this->linker);
		$rsp = mssql_fetch_assoc($sqlP);
		if($rsp)
		{	$id_proveedor = $rsp["id_proveedor"];
			//echo '<br>Entro: '.$id_proveedor;
		}
		else
		{
			///si no lo encontro en sidicatos lo busca solo en Proveedores
			$qryP2 = "select id id_proveedor from Proveedores where proveedor='$dato[2]'";
			$sqlP2 = mssql_query($qryP2, $this->linker);
			$rsp2 = mssql_fetch_assoc($sqlP2);
			if($rsp2)
				$id_proveedor = $rsp2["id_proveedor"];

			//echo '<br>'.$dato[2].' Es: '.$id_proveedor;
		}

		if($dato[5] == 'Enero') $mes = '01';
		if($dato[5] == 'Febrero') $mes = '02';
		if($dato[5] == 'Marzo') $mes = '03';
		if($dato[5] == 'Abril') $mes = '04';
		if($dato[5] == 'Mayo') $mes = '05';
		if($dato[5] == 'Junio') $mes = '06';
		if($dato[5] == 'Julio') $mes = '07';
		if($dato[5] == 'Agosto') $mes = '08';
		if($dato[5] == 'Septiembre') $mes = '09';
		if($dato[5] == 'Octubre') $mes = '10';
		if($dato[5] == 'Noviembre') $mes = '11';
		if($dato[5] == 'Diciembre') $mes = '12';

		$fecha_ven = $anio.'-'.$mes.'-15';

		///inserta en tabla
		if($id_proveedor > 0)
		{	$qry = "insert into Pagos values($id_proveedor, '$dato[0]', $dato[3], '$dato[4]','$fecha_ven',null,null,null)";
			//echo $qry.'<br>';
			/*mssql_query($qry, $this->linker);
			if (mssql_rows_affected($this->linker) > 0)*/
				$resp = true;
			/*else
				$resp = false;*/
		}
		else
			$resp = false;

		return $resp;
	}


	function divisiones()
	{	
		$result = array();

		$qry = "select *from Divisiones where pais in ('Mexico', 'Argentina') and estatus='A' order by pais desc, division";
		$sql = mssql_query($qry, $this->linker);
		while($rs = mssql_fetch_object($sql))
		{
			$result[] = $rs;
		}
		
		return $result;
	}

	function borra_plantilla($anio, $cod_division)
	{
		///borra tabla
		$qry = "delete PlantillaValuacion where anio=$anio and cod_division='$cod_division'";
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
		
		return $resp;
	}


	function registro_batch_plantilla($datos, $anio, $cod_division)
	{
		$i = 0;
		foreach($datos as $var=>$valor)
		{
			$dato[$i] = utf8_decode($valor);
			$dato[$i] = trim($dato[$i]);
			if($dato[$i] == '' || $dato[$i] == '#N/D' || $dato[$i] == '#N/A') $dato[$i] = 'NULL';
			$i += 1;
		}

		//porcentajes
		$dato[19] = $dato[19]*100;
		$dato[21] = $dato[21]*100;

		///inserta en tabla
		$qry = "insert into PlantillaValuacion values(null, null, '$dato[0]', null, '$dato[1]', '$dato[2]', '$dato[3]', '$dato[4]', '$dato[5]', '$dato[6]', '$dato[7]', '$dato[8]', '$dato[9]', '$dato[10]', '$dato[11]', '$dato[12]', '$dato[13]', '$dato[14]', '$dato[15]', null, '$dato[16]', '$dato[17]', null, null, $dato[18], $dato[19], $dato[20], $dato[21], $dato[22], $dato[23], $dato[24], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $dato[25], null, null, null, null, null, null, null, $dato[26], null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $dato[27], $anio, '$cod_division')";
		//echo $qry.'<br>';
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
	
	return $resp;
	}


	function borra_tabulador($anio)
	{
		///borra tabla
		$qry = "delete Tabuladores where anio=$anio";
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
		
		return $resp;
	}


	function registro_batch_tabulador($datos, $anio)
	{
		$i = 0;
		foreach($datos as $var=>$valor)
		{
			$dato[$i] = utf8_decode($valor);
			$dato[$i] = trim($dato[$i]);
			if($dato[$i] == '') $dato[$i] = null;
			$i += 1;
		}

		if($dato[4] == '' || !is_numeric($dato[4])) $dato[4] = 'NULL';

		///inserta en tabla
		$qry = "insert into Tabuladores values($anio, '$dato[0]', '$dato[1]', '$dato[2]', $dato[3], $dato[4])";
		//echo $qry.'<br>';
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
	
		return $resp;
	}





	function borra_negociaciones($anio)
	{
		///primero BitacoraNegociacion
		$qryB = "select id from Negociaciones where anio=$anio";
		$sqlB = mssql_query($qryB, $this->linker);
		while($rsb = mssql_fetch_assoc($sqlB))
		{
			$id_negociacion = $rsb["id"];

			$qryBN = "delete BitacoraNegociacion where id_negociacion=$id_negociacion";
			mssql_query($qryBN, $this->linker);
		}
		
		///ahora borra tabla
		$qry = "delete Negociaciones where anio=$anio";
		mssql_query($qry, $this->linker);
		if (mssql_rows_affected($this->linker) > 0)
			$resp = true;
		else
			$resp = false;
		
		return $resp;
	}


	function registro_batch_negociaciones($datos, $anio)
	{
		$i = 0;
		foreach($datos as $var=>$valor)
		{
			$dato[$i] = utf8_decode($valor);
			//$dato[$i] = $valor;
			$dato[$i] = trim($dato[$i]);
			$i += 1;
		}

		//buscamos el id_sindicato por nombre y division
		$id_sindicato = 0;
		$qryP = "select a.id from Sindicatos a, Divisiones b where a.cod_division=b.cod_division and a.sindicato='$dato[3]' and b.division='$dato[1]'";
		echo $qryP.'<br>';
		$sqlP = mssql_query($qryP, $this->linker);
		$rsp = mssql_fetch_assoc($sqlP);
		if($rsp)
		{	$id_sindicato = $rsp["id"];
			//echo '<br>Entro: '.$id_sindicato;
		}
		
		///inserta en tabla
		if($id_sindicato > 0)
		{	$qry = "insert into Negociaciones values($id_sindicato, '$dato[0]', '$dato[4]','$dato[5]','$dato[6]','$dato[7]','$dato[10]','$dato[9]',null)";
			echo $qry.'<br>';
			/*mssql_query($qry, $this->linker);
			if (mssql_rows_affected($this->linker) > 0)*/
			{	
				$qry1 = "select max(id) id from Negociaciones where anio=2021 and id_sindicato=$id_sindicato";
				$sql1 = mssql_query($qry1, $this->linker);
				$rs1 = mssql_fetch_assoc($sql1);
				if($rs1)
					$id_negociacion = $rs1["id"];
				else
					$id_negociacion = 0;

				if($id_negociacion>0)
				{
					///si todo bien, ahora en BitacoraNegociacion
					$qry2 = "insert into BitacoraNegociacion values($id_negociacion, '$dato[5]', '$dato[8]',1,null)";
					echo $qry2.'<br>';
					//mssql_query($qry2, $this->linker);
				}
				$resp = true;
			}
			/*else
				$resp = false;*/
		}
		else
			$resp = false;

		return $resp;
	}

}
?>