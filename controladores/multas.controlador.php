<?php

class ControladorMultas
{


    static public function ctrGuardarMulta($datos)
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
            $respuesta  = ModeloMultas::mdlGuardarMulta($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }


    static public function ctrGuardarEdicionMulta($datos)
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
            $respuesta  = ModeloMultas::mdlGuardarEdicionMulta($datos);
//					echo $respuesta;
            return $respuesta;

        }// isset
    }



    static  public function  ctrMostrarMulta($divisiones)
    {
        $respuesta=ModeloMultas::mdlMostrarMulta($divisiones);
        return $respuesta;

    }




    static public function ctrSubirArchivoMulta($post,$archivos)
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
            $ruta="/var/www/html/relaciones/vistas/archivos/multas";
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
                "id_tipo"=>21,
                "anio"=>date('Y'),
                "nombre"=>$nombreArchivo,
                "archivo"=>$nombreCompleto,
                "id_usuario"=>$post["idUser"],
                "fecha_alta"=>date('Y-m-d H:i:s'),

            );
            $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla2,$datos2);
//                print_r($resIngArchivo);
            $idArchivo = $resIngArchivo[0]->id;
//
//                print_r($idArchivo);
//            exit();

            if ($idArchivo!='' AND $idArchivo!='error')
            {

                $tabla3 = "ArchivosMultas";
                $respuesta3  = ModeloMultas::mdlArchivosMultas($tabla3,$idArchivo,$post['idMulta']);
//                print_r($respuesta3);
                return $respuesta3;
            }


            // }//pragmatch
        }// isset
    }



    static  public  function ctrMostrarHistorialArchivosxMulta($id)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloMultas::mdlMostrarHistorialArchivosxMulta($id);
        return $respuesta;
    }

//


}