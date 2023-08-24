<?php
session_start();

/*if(!isset($_SESSION["id_usuario"])) 
{
	header("Location: index.php");
    exit;
}

if($_SESSION["id_perfil"] != 1) {
    header("Location: inicio.php");
    exit;
}*/
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rotoplas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<script language="JavaScript">
	<!--
	function validar()
	{
		if(document.forma.archivo.value == '')
			alert('No ha seleccionado archivo');
		else
		{	document.forma.action="subir_archivo_pagos.php?accion=guardar";
			document.forma.submit();
		}
	}
	-->
	</script>
</head>

<body>
<?php
require_once("includes/archivos.inc.php");

$obj_archivo = new Archivos;

$accion = trim($_REQUEST["accion"]);

$id_usuario = 1;
$success = 0;
?>
<p>Subir Archivo de Pagos</p>

<?php
if($accion == 'guardar')
{
	$archivo = $_FILES["archivo"];
	$anio = $_REQUEST["anio"];
			
	$nb_archivo = '';
	//$path = getcwd();
	$path = '/var/www/html/relaciones/';
	//echo $path;
	$dir = "vistas/archivos/pagos";
			
	$nombre_archivo = 'archivo_pagos';
	$nb_ori = $archivo['name'];
	if ($archivo['name'] != "")
	{	$ext = explode('.',$archivo['name']);

		//verifica tamaño (no mayor a 10 Mega
		if ($archivo['size'] < 10000001)
		{	
			$dia = date('d').date('s');
			$nombre_archivo = $nombre_archivo.$dia;
			$nombre_archivo = md5($nombre_archivo).'.'.$ext[1];

			$archivo_destino = $dir."/".$nombre_archivo;

			//reemplazamos comillas simples por nada
			$reemplazar = "'";
			$cadenaNueva = "";
			$archivo_destino = ereg_replace($reemplazar,$cadenaNueva,$archivo_destino);

			if($ext[1]=='xls' || $ext[1]=='xlsx')
			{
				//copia archivo
				if (copy($archivo['tmp_name'], $path.$archivo_destino))
				{	chmod($path.$archivo_destino, 0644 );
					$nb_archivo = $archivo_destino;

					$datos = array(anio=>$anio, nb_archivo=>$nb_ori, archivo=>$nb_archivo, id_usuario=>$id_usuario);

					if($obj_archivo->sube_archivo($datos))
					{	
						$leyenda = 'Todo Bien';
						$success = 1;
						$accion = 'envia';
								
					}
					else
					{	$leyenda = 'Si subio archivo, no registro en la BD';
					}
				}
				else
				{	$leyenda = 'No sube archivo';
				}
			}
			else
			{	$leyenda = 'No es extensión xls o xlsx';
			}
		}
		else
		{	$leyenda = 'Pesa mas de 10Mb';
		}
	}
	else
	{	$leyenda = 'No ha seleccionado archivo';
	}
}


if($accion == 'envia')
{
	///ultimo archivo insertado
	$archivo = $obj_archivo->max_archivo($anio, 31);
	//$archivo = '../'.$dir.'/'.$archivo;	///coloca la dirección completa
	$archivo = $path.$archivo;

	require_once 'Classes/PHPExcel/IOFactory.php';
	$XLFileType = PHPExcel_IOFactory::identify($archivo);  
	$objReader = PHPExcel_IOFactory::createReader($XLFileType);
	$objPHPExcel = $objReader->load($archivo);

	$colinit = 0;
	$rowinit = 2;
	$rows=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn());
	$cols=$objPHPExcel->getActiveSheet()->getHighestRow();

	$rows = 6;	///numero de columnas

	///primero borra la tabla Pagos del año seleccionado
	//$obj_archivo->borra_pagos($anio);

	echo '<table border=1>';
	for($i=$rowinit;$i<=$cols;$i++) 
	{
		$datos = array();
		echo '<tr>';

		$pasa = 'N';
		for($j=$colinit;$j<=$rows;$j++) 
		{
		   	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, $i)->getValue();
		    echo "<td>$cell</td>";
			array_push($datos, $cell);
		}
	    echo '</tr>';

	    $paso = 0;
		if($obj_archivo->registro_batch_pagos($datos, $anio))
			$paso = 1;
				
		unset($datos);
	}
	echo '</table>';
}

echo '<br>'.$leyenda;
?>

<form method="post" name="forma" enctype="multipart/form-data">
<table width="80%">
	<tr><th>Año</th>
	<td><select name="anio" id="anio">
		<option value="2020">2020</option>
		<option value="2021">2021</option>
	</select>
	</td>
	<th>Archivo</th>
	<td><input type="file" name="archivo" /></td>
	<td><input type="button" value="Subir" onclick="javascript:validar();"></td>
	</tr>
</table>
</form>

</body>
</html>