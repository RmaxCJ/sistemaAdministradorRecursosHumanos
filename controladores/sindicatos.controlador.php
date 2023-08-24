<?php

	class ControladorSindicatos{
		static public function ctrEditarSindicatos($post,$archivos)
        {
            if(isset($post) && isset($archivos))
            {
				$datos = array(
					"Sindicato"      =>$post['Sindicato'],
					"NombreCorto"    =>$post['NombreCorto'],
					"Cod_division"   =>$post['Cod_division'],
					"id_proveedor"   =>$post['id_proveedor'],
					"num_proveedor"  =>$post['Num_Proveedor'],
					"rfc"            =>$post['rfc'],
					"correo"         =>$post['Correo'],
					"moneda"         =>$post['Moneda'],
					"id_Responsable" =>$post['id_Responsable'],
					// "archivo"        =>$_POST['archivo'],
					"id"             =>$post['id'],
		
				);
                if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ,. ]+$/',$datos['Sindicato']))
                {
					$tabla = "Sindicatos";
					$tabla2 = "Proveedores";
					// $tabla3 = "SindicatosLider";
					// ,[id_sindicato]
					// ,[id_lider]
					$ruta="/var/www/html/relaciones/vistas/archivos/logos";
					$nombreArchivo=$archivos['file']['name'];
					if($nombreArchivo!=''){//SI ES DIFERENTE DE VACIO SI ENTRA
						$nameArray = explode(".", $nombreArchivo);

						$tipoArchivo=$archivos['file']['type'];
						$temporal=$archivos['file']['tmp_name'];
						$tamañoArchivo=$archivos['file']['size'];
						$idInico=uniqid();
						$fechaActual=date('Y-m-d H:i:s');
						$nombreCifrado=md5($nombreArchivo);
							$nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
						$temporal;
						move_uploaded_file($temporal, "$ruta/$nombreCompleto");

						$datos2=array(
							"id_tipo"=>6,
							"anio"=>date('Y'),
							"nombre"=>$nombreArchivo,
							"archivo"=>$nombreCompleto,
							"id_usuario"=>$datos["id_usuario"],
							"fecha_alta"=>date('Y-m-d H:i:s'),

						);
					}
                    $respuesta  = ModeloSindicatos::mdlEditarSindicatos($tabla,$tabla2,$datos,$datos2);
                    return $respuesta;
                }//pragmatch
                else{
                    return "error pregmatch";
                }
            }// isset
		}
		static public function ctrCrearSindicatos($post,$archivos)
        {
			if(isset($post) && isset($archivos))
            { 
				// echo 'antes del post de datos';
			$datos = array(
			    "Sindicato"      =>$post['Sindicato'],
			    "NombreCorto"    =>$post['NombreCorto'],
			    "Cod_Division"   =>$post['Cod_Division'],
			    "num_proveedor"  =>$post['num_proveedor'],
			    "rfc"            =>$post['rfc'],
			    "correo"         =>$post['correo'],
			    "moneda"         =>$post['moneda'],
			    "id_Responsable" =>$post['IDRES'],
			    // "file"           =>$_POST['file'],
			    "estatus"        =>"A",
			    "fecha_alta"     =>date('Y-m-d H:i:s'),
			    "id_usuario"     =>$post['id_usuario'],

			);
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['Sindicato']))
				{

					$tabla = "Sindicatos";
					$tabla2 = "Proveedores";
					$tabla3 = "Archivos";
					$respuesta1 = ModeloSindicatos::mdlIngresarProveedorSindicato($tabla2, $datos);//primero se guarda proveedor 
					$id_prov = $respuesta1[0]->id;//regresa id proveedor

					 if($id_prov!='' AND $id_prov!='error')
					 {
							$ruta="/var/www/html/relaciones/vistas/archivos/logos";
							$nombreArchivo=$archivos['file']['name'];
							$nameArray = explode(".", $nombreArchivo);

							$tipoArchivo=$archivos['file']['type'];
							$temporal=$archivos['file']['tmp_name'];
							$tamañoArchivo=$archivos['file']['size'];
							$idInico=uniqid();
							$fechaActual=date('Y-m-d H:i:s');
							$nombreCifrado=md5($nombreArchivo);
							 $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
							$temporal;
							move_uploaded_file($temporal, "$ruta/$nombreCompleto");

							$datos2=array(
								"id_tipo"=>6,
								"anio"=>date('Y'),
								"nombre"=>$nombreArchivo,
								"archivo"=>$nombreCompleto,
								"id_usuario"=>$datos["id_usuario"],
								"fecha_alta"=>date('Y-m-d H:i:s'),

							);
                        // $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla2,$datos2);
                        // $idArchivo = $resIngArchivo[0]->id;

                        // if ($idArchivo!='' AND $idArchivo!='error')
                        // {
                             $respuesta2 = ModeloSindicatos::mdlIngresarSindicatos($tabla, $datos, $id_prov, $datos2);
                        // }
						return $respuesta2;
						// $id_sindicato = $respuesta2[0]->id;//regresa id sindicatp
						// if($id_sindicato!='' AND $id_sindicato!='error'){
						// 	$respuesta3 = ModeloSindicatos::mdlIngresarArchivos($tabla3,$datos2);//tabla archivos, datos de archivo
						// 	$id_archivo = $respuesta3[0]->id;//regresa id sindicatp

						// 	if($id_archivo!='' AND $id_archivo!='error'){
						// 		$respuesta = ModeloSindicatos::mdlUpdateLogoSindicato($tabla,$id_archivo,$id_sindicato);
						// 		$id_sindicato = $respuesta4[0]->id;//regresa id sindicatp
						// 		return $respuesta;
						// 	 }
						//  }
					 }

				}//pragmatch
			}// isset
		}
		static public function ctrMostrarSindicatos($pais,$cod_division)
        {
			$respuesta = ModeloSindicatos::mdlMostrarSindicatos($pais,$cod_division);
			return $respuesta;
		}
		static public function ctrMostrarSindicatosLider($datos)
        {
			$tabla = "SindicatosLider";
			$respuesta = ModeloSindicatos::mdlMostrarSindicatosLider($tabla,$datos);
			return $respuesta;
		}
		//////////////////////////////////////////////
		static public function ctrAgregarLideresSindicatos($datos)
        {
            // print_r($datos);
			if(isset($datos))
			{
				$tabla = "SindicatosLider";
                $respuesta = ModeloSindicatos::mdlAgregarLideresSindicatos($tabla,$datos);
                return $respuesta;				
			}
		}
		static public function ctrBorrarSindicatos($datos)
        {
            // print_r($datos);
			if(isset($datos))
			{
				$tabla = "Sindicatos";
                $respuesta = ModeloSindicatos::mdlBorrarSindicatos($tabla,$datos);
                return $respuesta;
				
			}
		}
		static public function ctrBorrarSindicatos2($datos)
        {
            // print_r($datos);
			if(isset($datos))
			{
				$tabla = "Sindicatos";
                $respuesta = ModeloSindicatos::mdlBorrarSindicatos2($tabla,$datos);
                return $respuesta;
				
			}
		}
        static public function ctrMostrarSindicatoxDivision($divisiones)
        {

            $respuesta = ModeloSindicatos::mdlMostrarSindicatoxDivision($divisiones);
            return $respuesta;
        }

	}