<?php

	class ControladorConsecuencias{

		static public function ctrCrearAddConsecuencias($datos)
        {
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['amonestacion']))
				{
					$tabla = "TiposAmonestacion";
					$respuesta  = ModeloConsecuencias::mdlIngresarAddConsecuencias($tabla, $datos);
					$id = $respuesta[0]->id;
						if($datos['arregloConsecuencia']!=''){
							if($id!='' AND $id!='error'){
								$tabla2 = "AmonestacionConsecuencia";
								$respuesta  = ModeloConsecuencias::mdlIngresarAmonestacionConsecuencia($tabla2,$id,$datos);
								return $respuesta;
							}
						}else{
							return 'ok';
						}
							
					
				}//pragmatch
			}// isset
		}
		static public function ctrEditarAddConsecuencias($datos)
        {
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['amonestacion']))
				{
					$id=$datos['id'];
					$tabla = "TiposAmonestacion";
					$tabla2 = "AmonestacionConsecuencia";
					$respuesta  = ModeloConsecuencias::mdlEditarAddConsecuencias($tabla, $datos);
					if ($respuesta=='ok'){

							if($datos['arregloConsecuencia']!='') 
							{
							$respuesta  = ModeloConsecuencias::mdlIngresarAmonestacionConsecuencia($tabla2,$id,$datos);
							}
							if($datos['arraycondel']!='')
							{
							$respuesta  = ModeloConsecuencias::mdlEliminarAmonestacionConsecuencia($tabla2,$id,$datos);
							}

							// return $respuesta;
					}

					return $respuesta;
				}//pragmatch
			}// isset
		}

		static public function ctrEliminarAddConsecuencias($datos)
        {
            if(isset($datos))
            {
                $tabla = "TiposAmonestacion";
				$tabla2 = "AmonestacionConsecuencia";
                $respuesta = ModeloConsecuencias::mdlEliminarAddConsecuencias($tabla,$datos,$tabla2);
                return $respuesta;

            }
        }

		static public function ctrMostrarTiposConsecuencias()
        {
			 $tabla="TiposAmonestacion";
			$respuesta  = ModeloConsecuencias::mdlMostrarTiposConsecuencias($tabla);
			return $respuesta;
		}

		static public function ctrMostrarTiposConsecuenciasxPais($pais)
        {
			 $tabla="TiposAmonestacion";
			$respuesta  = ModeloConsecuencias::mdlMostrarTiposConsecuenciasxPais($tabla,$pais);
			return $respuesta;
		}

		static public function ctrMostrarConsecuenciasAmonestaciones($id)
        {
			 $tabla="AmonestacionConsecuencia";
			$respuesta  = ModeloConsecuencias::mdlMostrarAmonestacionConsecuencia($tabla,$id);
			return $respuesta;
		}
		static public function ctrAgregarConsecuencia($datos,$archivos)
        {
			if(isset($datos))
            {
                $tabla = "Consecuencias";  
                $respuesta1  = ModeloConsecuencias::mdlIngresarConsecuencia($tabla, $datos);
                 $id_consecuencia = $respuesta1[0]->id;
						if($id_consecuencia!='' AND $id_consecuencia!='error'){
							$nombreArchivo2=$archivos["file2"]['name'];//para el archivo 1
							$nameArray = explode(".", $nombreArchivo);
							if($nombreArchivo2!=''){
								$ruta="/var/www/html/relaciones/vistas/archivos/consecuencias";
								$nombreArchivo2=$archivos["file2"]['name'];
								$nameArray = explode(".", $nombreArchivo2);
	
								$tipoArchivo=$archivos["file2"]['type'];
								$temporal=$archivos["file2"]['tmp_name'];
								$tamañoArchivo=$archivos["file2"]['size'];
								$idInico=uniqid();
								$fechaActual=date('Y-m-d H:i:s');
								$nombreCifrado=md5($nombreArchivo2);
								$nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
								$temporal;
								move_uploaded_file($temporal, "$ruta/$nombreCompleto");
	
								$datos2=array("id_tipo"=>28, "anio"=>date('Y'), "nombre"=>$nombreArchivo2, "archivo"=>$nombreCompleto, "id_usuario"=>$datos["id_usuario"], "fecha_alta"=>date('Y-m-d H:i:s'),
								);
								// print_r($datos2);
								$tabla2 = "Archivos";
								$resIngArchivo  = ModeloConsecuencias::mdlIngresarArchivos($tabla2,$datos2);
								 $idArchivo = $resIngArchivo[0]->id;
								if ($idArchivo!='' AND $idArchivo!='error')
								{
									$tabla3 = "ArchivosConsecuencias";
									$respuesta3  = ModeloConsecuencias::mdlIngresarArchivosConsecuencia($tabla3,$id_consecuencia,$idArchivo);
									// return $respuesta3;
									$ok2='ok';
								}
							}
							if($ok2=='ok'){	return "ok";}else{return "ok";}
						}

					// return $respuesta;      
			}// isset
		}

		static public function ctrActualizarConsecuencia($datos,$archivos)
        {
			if(isset($datos))
            {
				// echo $datos["comentarios"];
                $tabla = "Consecuencias";  
                $respuesta1  = ModeloConsecuencias::mdlActualizarConsecuencia($tabla, $datos);
                //  $id_consecuencia = $respuesta1[0]->id;
						if($respuesta1=='ok'){
							
							$nombreArchivo2=$archivos["file2"]['name'];//para el archivo 1
							$nameArray = explode(".", $nombreArchivo);
							if($nombreArchivo2!=''){
								$ruta="/var/www/html/relaciones/vistas/archivos/consecuencias";
								$nombreArchivo2=$archivos["file2"]['name'];
								$nameArray = explode(".", $nombreArchivo2);
	
								$tipoArchivo=$archivos["file2"]['type'];
								$temporal=$archivos["file2"]['tmp_name'];
								$tamañoArchivo=$archivos["file2"]['size'];
								$idInico=uniqid();
								$fechaActual=date('Y-m-d H:i:s');
								$nombreCifrado=md5($nombreArchivo2);
								$nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
								$temporal;
								move_uploaded_file($temporal, "$ruta/$nombreCompleto");
	
								$datos2=array("id_tipo"=>28, "anio"=>date('Y'), "nombre"=>$nombreArchivo2, "archivo"=>$nombreCompleto, "id_usuario"=>$datos["id_usuario"], "fecha_alta"=>date('Y-m-d H:i:s'),
								);
								// print_r($datos2);
								$tabla2 = "Archivos";
								$resIngArchivo  = ModeloConsecuencias::mdlIngresarArchivos($tabla2,$datos2);
								 $idArchivo = $resIngArchivo[0]->id;
								if ($idArchivo!='' AND $idArchivo!='error')
								{
									$tabla3 = "ArchivosConsecuencias";
									$respuesta3  = ModeloConsecuencias::mdlIngresarArchivosConsecuencia($tabla3,$datos["idC"],$idArchivo);
									// return $respuesta3;
									$ok2='ok';
								}
							}
							if($ok2=='ok'){	return "ok";}else{return "ok";}
						}

					// return $respuesta;      
			}// isset
		}

		static public function ctrEliminarConsecuencia($datos)
        {
            // print_r($datos);
			if(isset($datos))
			{
				$tabla = "Consecuencias";
                $respuesta = ModeloConsecuencias::mdlEliminarConsecuencia($tabla,$datos);
                return $respuesta;
				
			}
		}

		static public function ctrMostrarArchivosConsecuencias($idC)
        {
			$tabla="ArchivosConsecuencias";
			$respuesta = ModeloConsecuencias::mdlMostrarArchivoConsecuencias($tabla,$idC);
			return $respuesta;
		}

		static public function ctrMostrarConsecuencias($pais,$divisiones)
        {
			$tabla="Consecuencias";
			// $cod_division=$cod_division;
			$respuesta  = ModeloConsecuencias::mdlMostrarConsecuencias($tabla,$pais,$divisiones);
			return $respuesta;
		}

		static public function ctrBuscarAmonestacionesConsecuencia($datos)
        {
			$tabla="AmonestacionConsecuencia";

            $respuesta = ModeloConsecuencias::mdlBuscarAmonestacionConsecuencia($tabla, $datos);
            // corregir acentos 
            // $titleUTF8Array=array();
            // foreach ($respuesta as $key => $value)
            // {
            //     $titleUTF8=utf8_encode($value->consecuencia);
            //     array_push($titleUTF8Array,$titleUTF8 );
            // }
            // for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
            // {
            //     $respuesta[$i]->consecuencia=$titleUTF8Array[$i];
            // }
			// 	           echo "<pre>";
			//    print_r($respuesta);
			//    echo "</pre>";
            return $respuesta;
        }
	}