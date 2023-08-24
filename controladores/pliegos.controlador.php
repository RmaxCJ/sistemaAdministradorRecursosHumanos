<?php

class ControladorPliegos
{


//    static public function ctrEditarPliegos($datos)
//    {
////            			echo "ctr";
////			print_r($datos);
//        // $tabla="Sindicatos";
//        if(isset($datos))
//        {
//            // echo "ctr";
//            // print_r($datos);
//            // $tabla="Sindicatos";
//            // if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['tema']))
//            // {
//            $tabla = "Minutas";
//
//            $respuesta1  = ModeloMinutas::mdlEditarMinutas($tabla, $datos);
//            // print_r($respuesta1[0]->id);
//            // $id = $respuesta1[0]->id;//ya no se ocupa
//            if($respuesta1=='ok'){
//                $tabla2 = "AsistentesMinuta";
//                $respuesta2  = ModeloMinutas::mdlEditarAsistenteMinuta($tabla2,$datos);
//                // return $respuesta2;
//                // print_r($respuesta2);
//                if($respuesta2=='ok'){
//                    $tabla3 = "AcuerdosMinuta";
//                    $respuesta3  = ModeloMinutas::mdlEditarAcuerdosMinutas($tabla3,$datos);
//                    // return $respuesta3;
//
//                    if($respuesta3=='ok'){
//                        $tabla4 = "ArchivosMinuta";
//                        $respuesta4  = ModeloMinutas::mdlEditarArchivosMinutas($tabla4,$datos);
//                        return $respuesta4;
//                    }
//                }
//            }
//            // }//pragmatch
//        }// isset
//    }
//
//
    static  public  function ctrCrearPliego($datos)
    {
        if (isset($datos))
        {
            $tabla = "Pliegos";
            $resIDpliego  = ModeloPliegos::mdlIngresarPliegos($tabla, $datos);
//            print_r($resIDpliego);
            $idPliego = $resIDpliego[0]->id;
            if($idPliego!='' AND $idPliego!='error' AND $idPliego!=null)
            {

                $tabla2="Peticiones";
                $resIngPeti  = ModeloPliegos::mdlIngresarPeticiones($tabla2,$datos,$idPliego);
//                print_r($resIngPeti);
                //$idArchivo = $resIngArchivo[0]->id;
                return $resIngPeti;
//                 echo "<pre>";
//                 print_r($respuesta2);
//                 echo "</pre>";

            }
        }
    }

    static public function ctrAgregarPliegos($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
////        print_r($_SESSION);
//            echo "</pre>";
//

            $datos = array(
                "id_sindicato"      =>$post['sindicato'],
                "tema"              =>$post['txtTema'],
                "estatus"           =>"Activo",
                "id_usuario"        =>$post["idUser"],
//                "generales"         =>$_POST['Generales'],
                "fecha_alta"        =>date('Y-m-d H:i:s'),
                "tipoCreacion"        =>'Cargado',
            );

//            echo "<pre>datos";
//            print_r($datos);
//            echo "</pre>";
//
//            echo getcwd() . "\n";
            $ruta="/var/www/html/relaciones/vistas/archivos/pliegos";
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


//        exit();
            // echo "ctr";
            // print_r($datos);
            // $tabla="Sindicatos";
            // if(preg_match('/^[a-zA-Z0-9ñÑaáéÉíÍóÓúÚ ]+$/',$datos['tema']))
            // {
            $tabla = "Pliegos";

            $resIDpliego  = ModeloPliegos::mdlIngresarPliegos($tabla, $datos);

            //Pliegos->Archivos 2->ArchivosPliegos


            // echo $respuesta1;
//              echo $respuesta1;
//            echo "<pre>";
//             print_r($respuesta1[0]->id);
//             echo "</pre>";
//            exit();


            $idPliego = $resIDpliego[0]->id;
            if($idPliego!='' AND $idPliego!='error')
            {
                $tabla2="Archivos";
                $datos2=array(
                    "id_tipo"=>2,
                    "anio"=>date('Y'),
                    "nombre"=>$nombreArchivo,
                    "archivo"=>$nombreCompleto,
                    "id_usuario"=>$post["idUser"],
                    "fecha_alta"=>date('Y-m-d H:i:s'),

                );
                $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla2,$datos2);
                //print_r($resIngArchivo);
                $idArchivo = $resIngArchivo[0]->id;
                if ($idArchivo!='' AND $idArchivo!='error')
                {

                    $tabla3 = "ArchivosPliego";
                    $respuesta3  = ModeloPliegos::mdlIngresarArchivosPliegos($tabla3,$idPliego,$idArchivo);
                    //print_r($respuesta3);
                    return $respuesta3;
                }

//                 echo "<pre>";
//                 print_r($respuesta2);
//                 echo "</pre>";

            }


            // }//pragmatch
        }// isset
    }

    static public function ctrMostrarPliegos($cod_division,$pais)
    {

        $respuesta = ModeloPliegos::mdlMostrarPliegos($cod_division,$pais);
        return $respuesta;
    }
    static public function ctrMostrarPliegosCreados($cod_division,$pais)
    {
        //echo $tabla="Pliegos";
//            echo $tabla;
//            echo $item;
//            echo $valor;
        $respuesta = ModeloPliegos::mdlMostrarPliegosCreados($cod_division,$pais);
//        print_r($respuesta);
        return $respuesta;
    }

//
    static public function ctrBorrarPliegos($datos)
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
            $tabla = "Pliegos";

            $respuesta  = ModeloPliegos::mdlBorrarPliegos($tabla, $datos);
            return $respuesta;

            // }//pragmatch
        }// isset
    }
}