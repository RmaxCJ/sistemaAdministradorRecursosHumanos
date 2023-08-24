<?php

	class ControladorRit{

        static public function ctrMostrarRit($divisiones,$pais)
        {
			$tabla="Rit";
			$respuesta = ModeloRit::mdlMostrarRit($tabla,$divisiones,$pais);
			return $respuesta;
		}
        static public function ctrMostrarObservacionRit()
        {
			$tabla="ObservacionesRit";
			$respuesta = ModeloRit::mdlMostrarObservacionRit($tabla);
			return $respuesta;
		}
        static public function ctrMostrarObsRit()
        {
			$tabla="ObservacionesRit";
			$respuesta = ModeloRit::mdlMostrarObsRit($tabla);
			return $respuesta;
		}

        static public function ctrCrearObservacionRit($datos)
        {
			if(isset($datos))
            {
				if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['observacion']))
				{
					$tabla = "ObservacionesRit";
					$respuesta  = ModeloRit::mdlIngresarObservacionRit($tabla, $datos);
					return $respuesta;
				}//pragmatch
			}// isset
		}

        static public function ctrMostrarArchivoRit($cod_division)
        {
			$tabla="Rit";
			$respuesta = ModeloRit::mdlMostrarArchivoRit($tabla,$cod_division);
			return $respuesta;
		}

		static public function ctrCrearRit($datos,$archivos)
        {
            if(isset($datos))
            {
                $tabla = "Rit";  
                $respuesta1  = ModeloRit::mdlIngresarRit($tabla, $datos);
                 $idRit = $respuesta1[0]->id;
                if($idRit!='' AND $idRit!='error'){

                    $ruta="/var/www/html/relaciones/vistas/archivos/rit";
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
                        "id_tipo"=>22,
                        "anio"=>date('Y'),
                        "nombre"=>$nombreArchivo,
                        "archivo"=>$nombreCompleto,
                        "id_usuario"=>$datos["id_usuario"],
                        "fecha_alta"=>date('Y-m-d H:i:s'),

                    );
                    // print_r($datos2);
                    $tabla2 = "Archivos";
                    $resIngArchivo  = ModeloRit::mdlIngresarArchivos($tabla2,$datos2);
                    $idArchivo = $resIngArchivo[0]->id;
                    if ($idArchivo!='' AND $idArchivo!='error')
                    {
                        $tabla3 = "ArchivosRit";
                        $respuesta3  = ModeloRit::mdlIngresarArchivosRit($tabla3,$idRit,$idArchivo,$datos);
                        return $respuesta3;
                    }
                    
                }
			}// isset
		}

	}