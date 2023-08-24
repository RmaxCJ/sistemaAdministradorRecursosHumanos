<?php

	class ControladorComisiones{

        static public function ctrMostrarComisiones($divisiones)
        {
			$tabla="Comisiones";
			$respuesta = ModeloComisiones::mdlMostrarComisiones($tabla,$divisiones);
			return $respuesta;
		}
        static public function ctrMostrarComisionesDivisiones($divisiones)
        {
			// $tabla="Comisiones";
			$respuesta = ModeloComisiones::mdlMostrarComisionesDivisiones($divisiones);
			return $respuesta;
		}

        static public function ctrMostrarArchivoComisiones($cod_division,$tipo_com)
        {
			$tabla="Comisiones";
			$respuesta = ModeloComisiones::mdlMostrarArchivoComisiones($tabla,$cod_division,$tipo_com);
			return $respuesta;
		}

		static public function ctrCrearComisiones($datos,$archivos)
        {
            if(isset($datos))
            {
                $tabla = "Comisiones";  
                $respuesta1  = ModeloComisiones::mdlIngresarComisiones($tabla, $datos);
                 $idComisiones = $respuesta1[0]->id;
                    for ($x = 1; $x <= 5; $x++) {
                        if($idComisiones!='' AND $idComisiones!='error'){
                            
                            $ruta="/var/www/html/relaciones/vistas/archivos/comisiones";
                            $nombreArchivo=$archivos["file$x"]['name'];
                            $nameArray = explode(".", $nombreArchivo);

                            $tipoArchivo=$archivos["file$x"]['type'];
                            $temporal=$archivos["file$x"]['tmp_name'];
                            $tamañoArchivo=$archivos["file$x"]['size'];
                            $idInico=uniqid();
                            $fechaActual=date('Y-m-d H:i:s');
                            $nombreCifrado=md5($nombreArchivo);
                            $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
                            $temporal;
                            move_uploaded_file($temporal, "$ruta/$nombreCompleto");

                            $datos2=array("id_tipo"=>27, "anio"=>date('Y'), "nombre"=>$nombreArchivo, "archivo"=>$nombreCompleto, "id_usuario"=>$datos["id_usuario"], "fecha_alta"=>date('Y-m-d H:i:s'),
                            );
                            // print_r($datos2);
                            $tabla2 = "Archivos";
                            $resIngArchivo  = ModeloComisiones::mdlIngresarArchivos($tabla2,$datos2);
                             $idArchivo = $resIngArchivo[0]->id;
                            if ($idArchivo!='' AND $idArchivo!='error')
                            {
                                $tabla3 = "ArchivosComisiones";
                                $respuesta3  = ModeloComisiones::mdlIngresarArchivosComisiones($tabla3,$idComisiones,$idArchivo,$x);
                                // return $respuesta3;
                            }

                        }
                        if($x==5){
                            // echo "ultimo elemento$x";
                            return $respuesta3;
                        }   
                    }       

			}// isset
		}
        static public function ctrModificarComisiones($datos,$archivos)
        {
            if(isset($datos))
            {
                $tabla = "Comisiones";  
                $respuesta1  = ModeloComisiones::mdlModificarComisiones($tabla, $datos);
                //  $idComisiones = $respuesta1[0]->id;
                        if($respuesta1=='ok'){
                            // $tipo=$datos['tipo'];
                            
                            // print_r($archivos);
                             $nombreArchivo=$archivos["file"]['name'];
                             $nameArray = explode(".", $nombreArchivo);
                            if($nombreArchivo!=''){//if para validar si viene o no archivo para cargar
                                $ruta="/var/www/html/relaciones/vistas/archivos/comisiones";
                                $nombreArchivo=$archivos["file"]['name'];
                                $nameArray = explode(".", $nombreArchivo);

                                $tipoArchivo=$archivos["file"]['type'];
                                $temporal=$archivos["file"]['tmp_name'];
                                $tamañoArchivo=$archivos["file"]['size'];
                                $idInico=uniqid();
                                $fechaActual=date('Y-m-d H:i:s');
                                $nombreCifrado=md5($nombreArchivo);
                                $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
                                $temporal;
                                move_uploaded_file($temporal, "$ruta/$nombreCompleto");

                                $datos2=array("id_tipo"=>27, "anio"=>date('Y'), "nombre"=>$nombreArchivo, "archivo"=>$nombreCompleto, "id_usuario"=>$datos["id_usuario"], "fecha_alta"=>date('Y-m-d H:i:s'),
                                );
                                // print_r($datos2);
                                $tabla2 = "Archivos";
                                $resIngArchivo  = ModeloComisiones::mdlIngresarArchivos($tabla2,$datos2);
                                $idArchivo = $resIngArchivo[0]->id;
                                if ($idArchivo!='' AND $idArchivo!='error')
                                {
                                    $tabla3 = "ArchivosComisiones";
                                    $id_com=$datos['id'];
                                    $tipo=$datos['tipo'];
                                    $respuesta3  = ModeloComisiones::mdlIngresarArchivosComisiones($tabla3,$id_com,$idArchivo,$tipo);
                                    return $respuesta3;
                                }
                            }else {
                                return 'ok';
                            }   
                        }
                        // if($x==5){
                        //     // echo "ultimo elemento$x";
                        //     return $respuesta3;
                        // }       

			}// isset
		}

	}