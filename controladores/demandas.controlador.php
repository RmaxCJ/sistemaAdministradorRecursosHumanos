<?php

class ControladorDemandas
{

    static public function  ctrVPs()
    {
        $respuesta=ModeloDemandas::mdlVPs();
        return $respuesta;
    }

    static public function  ctrSociedades()
    {
        $respuesta=ModeloDemandas::mdlSociedades();
        return $respuesta;
    }

    static public function  ctrMonedas()
    {
        $respuesta=ModeloDemandas::mdlMonedas();
        return $respuesta;
    }
    static public function  ctrMonedaxPais($pais)
    {
        $respuesta=ModeloDemandas::mdlMonedaxPais($pais);
        return $respuesta;
    }
    static public function  ctrDemandasInternasxPais($pais,$divisionesDisponibles)
    {

        $respuesta=ModeloDemandas::mdlDemandasInternasxPais($pais,$divisionesDisponibles);
        return $respuesta;
    }
    static public function  ctrDemandasExternasxPais($pais,$divisionesDisponibles)
    {

        $respuesta=ModeloDemandas::mdlDemandasExternasxPais($pais,$divisionesDisponibles);
        return $respuesta;
    }

    static public function  ctrAreasPorVPs($datos)
    {
        $respuesta=ModeloDemandas::mdlAreasPorVPs($datos);

        $titleUTF8Array=array();
        foreach ($respuesta as $key => $value)
        {

            $titleUTF8=utf8_encode($value->nombre_area);
            array_push($titleUTF8Array,$titleUTF8 );


        }
        for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
        {
            $respuesta[$i]->nombre_area=$titleUTF8Array[$i];
//                            echo $i;
        }


//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
        return $respuesta;
    }

    static public function ctrGuardarDemanda($datos)
    {
//			echo "ctr";
//			print_r($datos);
        // $tabla="Usuarios";
        if(isset($datos))
        {
//			echo "ctr";
//			print_r($datos);
            $respuesta  = ModeloDemandas::mdlGuardarDemanda($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }

    static public function ctrCerrarDemanda($datos)
    {
//			echo "ctr";
//			print_r($datos);
        // $tabla="Usuarios";
        if(isset($datos))
        {
//			echo "ctr";
//			print_r($datos);
            $respuesta  = ModeloDemandas::mdlCerrarDemanda($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }

    static public function ctrGuardarEdicion($datos)
    {
//			echo "ctr";
//			print_r($datos);
        // $tabla="Usuarios";
        if(isset($datos))
        {
//			echo "ctr";
//			print_r($datos);
            $respuesta  = ModeloDemandas::mdlGuardarEdicion($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }

    static public function ctrGuardarDemandaExterna($datos)
    {
//			echo "ctr";
//			print_r($datos);
        // $tabla="Usuarios";
        if(isset($datos))
        {
//			echo "ctr";
//			print_r($datos);
            $respuesta  = ModeloDemandas::mdlGuardarDemandaExterna($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }

    static public function ctrSubirArchivoDemanda($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
//            echo "</pre>";
//            exit();
//
//
//            echo getcwd() . "\n";
            $ruta="/var/www/html/relaciones/vistas/archivos/demandas";
            $nombreArchivo=$archivos['file']['name'];
            $nameArray = explode(".", $nombreArchivo);
//            echo "<pre>datos";
//            print_r($nameArray);
//            echo "</pre>";
            $tipoArchivo=$archivos['file']['type'];
            $temporal=$archivos['file']['tmp_name'];
            $tamañoArchivo=$archivos['file']['size'];
            $idInico=uniqid();
            $fechaActual=date('Y-m-d H:i:s');
            $nombreCifrado=md5($nombreArchivo);
            $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
            $temporal;
            move_uploaded_file($temporal, "$ruta/$nombreCompleto");
//exit();

                $tabla2="Archivos";
                $datos2=array(
                    "id_tipo"=>15,
                    "anio"=>date('Y'),
                    "nombre"=>$nombreArchivo,
                    "archivo"=>$nombreCompleto,
                    "id_usuario"=>$post["idUser"],
                    "fecha_alta"=>date('Y-m-d H:i:s'),

                );
                $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla2,$datos2);
//                print_r($resIngArchivo);
                $idArchivo = $resIngArchivo[0]->id;

//                print_r($idArchivo);
//            exit();

            if ($idArchivo!='' AND $idArchivo!='error')
                {

                    $tabla3 = "ArchivosDemandas";
                    $respuesta3  = ModeloDemandas::mdlIngresarArchivosDemandas($tabla3,$post['idDemanda'],$idArchivo);
                    //print_r($respuesta3);
                    return $respuesta3;
                }


            // }//pragmatch
        }// isset
    }

    static  public  function ctrMostrarHistorialArchivosxDemanda($id)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloDemandas::mdlMostrarHistorialArchivosxDemanda($id);
        return $respuesta;
    }


    static public function ctrSubirReporteAbogado($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
//            echo "</pre>";
//            exit();
//
//
//            echo getcwd() . "\n";
            $ruta="/var/www/html/relaciones/vistas/archivos/reportesDemandas";
            $nombreArchivo=$archivos['file']['name'];
            $nameArray = explode(".", $nombreArchivo);
//            echo "<pre>datos";
//            print_r($nameArray);
//            echo "</pre>";
            $tipoArchivo=$archivos['file']['type'];
            $temporal=$archivos['file']['tmp_name'];
            $tamañoArchivo=$archivos['file']['size'];
            $idInico=uniqid();
            $fechaActual=date('Y-m-d H:i:s');
            $nombreCifrado=md5($nombreArchivo);
            $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
            $temporal;
            move_uploaded_file($temporal, "$ruta/$nombreCompleto");
//exit();

            $tabla2="Archivos";
            $datos2=array(
                "id_tipo"=>17,
                "anio"=>date('Y'),
                "nombre"=>$nombreArchivo,
                "archivo"=>$nombreCompleto,
                "id_usuario"=>$post["idUser"],
                "fecha_alta"=>date('Y-m-d H:i:s'),

            );
            $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla2,$datos2);
//                print_r($resIngArchivo);
            $idArchivo = $resIngArchivo[0]->id;

//                print_r($idArchivo);
//            exit();

            if ($idArchivo!='' AND $idArchivo!='error')
            {

                $tabla3 = "ReportesDemandaAbogados";
                $respuesta3  = ModeloDemandas::mdlReportesDemandaAbogados($tabla3,$idArchivo,$post['division'],$post['usuario'],$post['comentarioReporte']);
                //print_r($respuesta3);
                return $respuesta3;
            }


            // }//pragmatch
        }// isset
    }

    static  public  function ctrVisualizarReportes($divisionesDisponibles)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloDemandas::mdlVisualizarReportes($divisionesDisponibles);
        return $respuesta;
    }







}