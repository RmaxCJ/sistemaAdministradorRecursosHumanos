<?php

class ControladorOrdenes
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

    static public function ctrAgregarOrdenes($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {
//
//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
////        print_r($_SESSION);
//            echo "</pre>";
//            die();
//           $date= explode("-",$post["fechaPedido"]);



//            echo "<pre>datos";
//            print_r($datos);
//            echo "</pre>";
//
//            echo getcwd() . "\n";
            $ruta="/var/www/html/relaciones/vistas/archivos/ordenes";
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

            $tabla="Archivos";
            $datos=array(
                "id_tipo"=>3,
                "anio"=>date('Y'),
                "nombre"=>$nombreArchivo,
                "archivo"=>$nombreCompleto,
                "id_usuario"=>$post["idUser"],
                "fecha_alta"=>date('Y-m-d H:i:s'),

            );
//            echo "<pre>";
//            print_r($datos);
//            echo "</pre>";
            $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla,$datos);
//            print_r($resIngArchivo);
            $idArchivo = $resIngArchivo[0]->id;
            if ($idArchivo!='' AND $idArchivo!='error')
            {

                $tabla2="OrdenesCompra";
                $datos2=array(
                    "id_archivo"=>$idArchivo,
                    "orden_compra"=>$post['temaOrden'],
                    //"idUser"=>$post['idUser'],
                    "concepto"=>$post['Concepto'],

                    "monto"=>$post['montoOrden'],
                    "fecha_alta"=>date('Y-m-d H:i:s'),
                    "id_pago"=>$post['pago'],

                );
//                echo "<pre>";
//                print_r($datos2);
//                echo "</pre>";
                $respuesta= ModeloOrdenes::mdlIngresarOrdenes($tabla2,$datos2);
//                echo $respuesta;
                if ($respuesta=="ok")
                {
                    $respuestaUpdate=ModeloRecibos::mdlActualizarPago($post['pago'],"En Validacion");
//                    try {
//                        //Server settings
//                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//                        // $mail->isSMTP();                                            // Send using SMTP
//                        $mail->Host       = '';                    // Set the SMTP server to send through
//                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//                        $mail->SMTPSecure = 'tls';
//                        $mail->Username   = '';                     // SMTP username
//                        $mail->Password   = '';                               // SMTP password
//                        $mail->Port       = 465;
//
//                        $mail->setFrom($_POST['email'], $_POST['name']);
//                        $mail->addAddress('ejemplo@hotmail.com','ejemplo.com');     // Add a recipient
//
//
//
//
//                        //$mail->isHTML(true);                                  // Set email format to HTML
//                        $mail->Subject = '';
//                        $mail->Body    = '';
//
//                        if ($mail->send())
//                        {
//                            // echo "<pre>";
//                            // print_r($mail);
//                            // echo "</pre>";
//                            // exit();
//                            echo json_encode('success', JSON_FORCE_OBJECT);
//
//                        }
//                        else
//                        {
//                            echo json_encode('error', JSON_FORCE_OBJECT);
//
//                            // echo $mail->ErrorInfo;
//                        }
//
//                    } catch (Exception $e) {
//                        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//                        echo $e->errorMessage();
//                    }
                    return $respuestaUpdate;
                }
//                return $respuesta;
            }



            // }//pragmatch
        }// isset
    }

    static public function ctrMostrarOrdenes()
    {
//    echo "ctrMostrarOrdenes";
        $respuesta = ModeloOrdenes::mdlMostrarOrdenes();
        return $respuesta;
    }
    static public function ctrMostrarPliegosCreados()
    {
        //echo $tabla="Pliegos";
//            echo $tabla;
//            echo $item;
//            echo $valor;
        $respuesta = ModeloPliegos::mdlMostrarPliegosCreados();
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