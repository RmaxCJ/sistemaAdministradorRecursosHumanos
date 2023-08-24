<?php

	class ControladorInformacion{



        static public function ctrMostrarArchivoInformacion($pais,$cod_division)
        {
            // echo $pais;
            // echo $divisiones;
			 $tabla="ArchivosInformacionLaboral";
			$respuesta = ModeloInformacion::mdlMostrarInformacion($tabla,$pais,$cod_division);
			return $respuesta; 
		}

		static public function ctrCrearInformacion($datos,$archivos)
        {
            if(isset($datos))
            {
                // $tabla = "Rit";  
                // $respuesta1  = ModeloInformacion::mdlIngresarInformacion($tabla, $datos);
                //  $idRit = $respuesta1[0]->id;
                // if($idRit!='' AND $idRit!='error'){

                    $ruta="/var/www/html/relaciones/vistas/archivos/informacionlaboral";
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
                        "id_tipo"=>42,
                        "anio"=>date('Y'),
                        "nombre"=>$nombreArchivo,
                        "archivo"=>$nombreCompleto,
                        "id_usuario"=>$datos["id_usuario"],
                        "fecha_alta"=>date('Y-m-d H:i:s'),

                    );
                    // print_r($datos2);
                    $tabla2 = "Archivos";
                    $resIngArchivo  = ModeloInformacion::mdlIngresarArchivos($tabla2,$datos2);
                    $idArchivo = $resIngArchivo[0]->id;
                    if ($idArchivo!='' AND $idArchivo!='error')
                    {
                        $tabla3 = "ArchivosInformacionLaboral";
                        $respuesta3  = ModeloInformacion::mdlIngresarArchivosInformacion($tabla3,$idArchivo,$datos);
                        return $respuesta3;
                    }
                    
                // }
			}// isset
		}

	}