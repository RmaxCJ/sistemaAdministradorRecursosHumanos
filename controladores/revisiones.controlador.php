<?php

class ControladorRevisiones
{


    static public function ctrGuardarRevision($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {
//			echo "ctr";
//            print_r($datos);

            $motivos=json_decode($datos['medios']);
//            print_r($motivos);
            $motivosSTR="";
            foreach ($motivos as $key=>$value)
            {
                $motivosSTR.=$value->value;
                $motivosSTR.="/";

            }
            if ($datos['medioText']!=null || $datos['medioText']!='')
            {
                $motivosSTR.=$datos['medioText'];
            }

//            print_r($motivosSTR);
            $datos['medios']=$motivosSTR;
//            print_r($datos);

            if ( $datos["monto"]=="")
            {
                $datos["monto"]='null';
            }
            if ($datos["montoMXN"]=="")
            {
                $datos["montoMXN"]='null';
            }
            if ($datos["moneda"]=="")
            {
                $datos["moneda"]=6;
            }



                $respuesta  = ModeloRevisiones::mdlGuardarRevision($datos);
//            print_r($respuesta);

            $datos['generacionMulta']=$datos['fechaPagoMulta'];

//            exit();
            if ($respuesta=="ok" || $respuesta=="Ok" || $respuesta=="OK")
            {

                if ($datos['multa']=="Si" || $datos['multa']=="si")
                {
                    $respuesta2=ModeloMultas::mdlGuardarMulta($datos);
                    return $respuesta2;

                }
                else
                {
                    return $respuesta;

                }
            }

//					echo $respuesta;

        }// isset
    }


    static public function ctrSubirArchivoRevision($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

            // echo "<pre>CTR";
            // print_r($post);
            // print_r($archivos);
            // echo "</pre>";
            // exit();

//
//            echo getcwd() . "\n";
            $ruta="/var/www/html/relaciones/vistas/archivos/revisiones";
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
                "id_tipo"=>20,
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

                $tabla3 = "ArchivosRevisiones";
                $respuesta3  = ModeloRevisiones::mdlArchivosRevisiones($tabla3,$idArchivo,$post['idRevision']);
//                print_r($respuesta3);
                return $respuesta3;
            }


            // }//pragmatch
        }// isset
    }



    static  public function  ctrMostrarRevisiones($divisiones)
    {
        $respuesta=ModeloRevisiones::mdlMostrarRevisiones($divisiones);
        return $respuesta;

    }

    static  public  function ctrMostrarHistorialArchivosxRevision($id)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloRevisiones::ctrMostrarHistorialArchivosxRevision($id);
        return $respuesta;
    }

    static  public  function ctrBorrarRevision($id)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloRevisiones::mdlBorrarRevision($id);
        return $respuesta;
    }

    static public function ctrGuardarEdicionRevision($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {
//			echo "ctr";
//            print_r($datos);

            $motivos=json_decode($datos['medios']);
//            print_r($motivos);
            $motivosSTR="";
            foreach ($motivos as $key=>$value)
            {
                if ($value->value=='Otro')
                {
                    continue;

                }
//
                $motivosSTR.=$value->value;
                $motivosSTR.="/";
//



            }
            if ($datos['medioText']!=null || $datos['medioText']!='')
            {
                $motivosSTR.=$datos['medioText'];
            }

//            print_r($motivosSTR);
            $datos['medios']=$motivosSTR;
//            print_r($datos);
//            print_r($datos['medios']);

//            exit();
            $respuesta  = ModeloRevisiones::mdlGuardarEdicionRevision($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }


}