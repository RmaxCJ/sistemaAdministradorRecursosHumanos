<?php

	class ControladorMinutas{


// 		static public function ctrEditarMinutas($datos)
//         {
// //            			echo "ctr";
// //			print_r($datos);
//             // $tabla="Sindicatos";
// 			if(isset($datos))
//             {
// 				// echo "ctr";
// 				// print_r($datos);
// 				// $tabla="Sindicatos";
// 				// if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['tema']))
// 				// {
// 					$tabla = "Minutas";

// 					$respuesta1  = ModeloMinutas::mdlEditarMinutas($tabla, $datos);
// 					// print_r($respuesta1[0]->id);
// 					// $id = $respuesta1[0]->id;//ya no se ocupa
// 					 if($respuesta1=='ok'){
// 						$tabla2 = "AsistentesMinuta";
// 						$respuesta2  = ModeloMinutas::mdlEditarAsistenteMinuta($tabla2,$datos);
// 						// return $respuesta2;
// 						// print_r($respuesta2);
// 						if($respuesta2=='ok'){
// 							$tabla3 = "AcuerdosMinuta";
// 							$respuesta3  = ModeloMinutas::mdlEditarAcuerdosMinutas($tabla3,$datos);
// 							// return $respuesta3;
							
// 							if($respuesta3=='ok'){
// 								$tabla4 = "ArchivosMinuta";
// 								$respuesta4  = ModeloMinutas::mdlEditarArchivosMinutas($tabla4,$datos);
// 								return $respuesta4;
// 							}
// 						}
// 					 }
// 				// }//pragmatch
// 			}// isset
// 		}


		static public function ctrCrearMinutas($datos,$archivos)
        {

//            echo "<pre>CTR";
//            print_r($datos);
//            print_r($archivos);
////        print_r($_SESSION);
//            echo "</pre>";
//


            if(isset($datos))
            {

				 // $datos = array(
        //     "id_sindicato"      =>$_POST['Sindicato'],
        //     "tema"              =>$_POST['Tema'],
        //     "estatus"           =>$_POST['Estatus'],
        //     "id_usuario"        =>$_POST['Usuario'],
        //     "generales"         =>$_POST['Generales'],
        //     "fecha_alta"        =>date('Y-m-d H:i:s'),
        //     "nombre_asistente"  =>$_POST['NombreAsistente'],
        //      "jsonAcuerdos"      =>$_POST['jsonAcuerdos'],
        //     // "acuerdo"           =>$_POST['Acuerdo'],
        //     // "fcompromiso"       =>$_POST['FCompromiso'],
        //     // "responsable"       =>$_POST['Responsable'],
        //     // "comentarios"       =>$_POST['Comentarios'],       
        //     "file"             =>$_POST['file'],
        // );

				// echo "ctr";
				// print_r($datos);
				// $tabla="Sindicatos";
				// if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['tema']))
				// {
					$tabla = "Minutas";

					$respuesta1  = ModeloMinutas::mdlIngresarMinutas($tabla, $datos);
					// echo $respuesta1;
					//  echo $respuesta1;
//					echo "<br>";
//					 print_r($respuesta1[0]->id);
					$idMinuta = $respuesta1[0]->id;
					if($idMinuta!='' AND $idMinuta!='error'){
						$tabla6 = "TemasMinuta";
						$respuesta6  = ModeloMinutas::mdlIngresarTemasMinutas($tabla6,$idMinuta,$datos);
						if($respuesta6=='ok'){
							$tabla2 = "AsistentesMinuta";
							$respuesta2  = ModeloMinutas::mdlIngresarAsistenteMinuta($tabla2,$idMinuta,$datos);
							// return $respuesta2;
								// echo "<br>";

								// print_r($respuesta2);
							if($respuesta2=='ok'){
								$tabla3 = "AcuerdosMinuta";
								$respuesta3  = ModeloMinutas::mdlIngresarAcuerdosMinutas($tabla3,$idMinuta,$datos);
								// return $respuesta3;
								// echo "<br>";
								// print_r($respuesta3);
								if($respuesta3=='ok')
								{
									$ruta="/var/www/html/relaciones/vistas/archivos/minutas";
									$nombreArchivo=$archivos['file']['name'];
									$nameArray = explode(".", $nombreArchivo);
									// echo "<pre>datos";
									// print_r($nameArray);
									// echo "</pre>";
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
										"id_tipo"=>1,
										"anio"=>date('Y'),
										"nombre"=>$nombreArchivo,
										"archivo"=>$nombreCompleto,
										"id_usuario"=>$datos["id_usuario"],
										"fecha_alta"=>date('Y-m-d H:i:s'),
									);
									// echo "<br>";
									// print_r($datos2);
									$tabla4 = "Archivos";
									$resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla4,$datos2);
	                            	//    echo "<br>";
	                            	//    print_r($resIngArchivo[0]);
									$idArchivo = $resIngArchivo[0]->id;
									if ($idArchivo!='' AND $idArchivo!='error')
									{
										$tabla5 = "ArchivosMinuta";
										$respuesta5  = ModeloMinutas::mdlIngresarArchivosMinutas($tabla5,$idMinuta,$idArchivo);
										// echo "<br>";
										// print_r($respuesta5);
										return $respuesta5;
									}
								}
							}
						}
					}


				// }//pragmatch
			}// isset
		}

		static public function ctrMostrarMinutas($cod_division,$pais)
        {
			$tabla="Minutas";
			$respuesta = ModeloMinutas::mdlMostrarMinutas($cod_division,$pais);
			return $respuesta;
		}
		/////////////////////////////////////////////////////////////para consulta y editar
		static public function ctrMostrarMinutasID($id_minuta)
        {
			  $tabla="Minutas";
			  $id_minuta;
			$respuesta = ModeloMinutas::ctrMostrarMinutasID($tabla,$id_minuta);
			return $respuesta;
		}
		/////////-------------------------------
		static public function ctrMostrarTemasMinutasID($id_minuta)
        {
			  $tabla="TemasMinuta";
			  $id_minuta;
			$respuesta = ModeloMinutas::ctrMostrarTemasMinutasID($tabla,$id_minuta);
			return $respuesta;
		}
		/////////-------------------------------
		static public function ctrMostrarAcuerdosMinutasID($id_minuta)
        {
			  $tabla="Minutas";
			  $id_minuta;
			$respuesta = ModeloMinutas::mdlMostrarAcuerdosMinutasID($tabla,$id_minuta);
			return $respuesta;
		}
		/////////-------------------------------
		static public function ctrMostrarAsistentesMinutasID($id_minuta)
        {
			  $tabla="AsistentesMinuta";
			  $id_minuta;
			$respuesta = ModeloMinutas::mdlMostrarAsistentesMinutasID($tabla,$id_minuta);
			return $respuesta;
		}
		/////////-------------------------------
		static public function ctrMostraracuerdosMinutaspasadas($datos)
		{
				// print_r($datos);
				$tabla="Minutas";
				$tabla2="AcuerdosMinuta";
			// $respuesta = ModeloMinutas::mdlMostrarAcuerdosMinutasPasadas($datos,$tabla,$tabla2);
			$respuesta1 = ModeloMinutas::mdlMostrarIdMaximoAcuerdobyId_sindicato($datos);//max idminuta
			 $idMinuta = $respuesta1[0]->id;
			if($idMinuta!='' AND $idMinuta!='error'){
				$respuesta = ModeloMinutas::mdlMostrarAcuerdosMinutasPasadas($datos,$tabla,$tabla2,$idMinuta);
				return $respuesta;
			}
			
		}
		/////////////////////////////////////////////////////////////


		static public function ctrBorrarMinutas($datos)
        {
//            			echo "ctr";
//			print_r($datos);
            // $tabla="Sindicatos";
			if(isset($datos))
            {
				// echo "ctr";
				// print_r($datos);
				// $tabla="Sindicatos";
				// if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['tema']))
				// {
					$tabla = "Minutas";

					$respuesta  = ModeloMinutas::mdlBorrarMinutas($tabla, $datos);
					return $respuesta;

				// }//pragmatch
			}// isset
		}
	}