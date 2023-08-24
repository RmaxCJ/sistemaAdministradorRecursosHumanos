<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);

class ControladorRecibos
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

    static public function ctrAgregarRecibos($post,$archivos)
    {

        if(isset($post) && isset($archivos))
        {

//            echo "<pre>CTR";
//            print_r($post);
//            print_r($archivos);
////        print_r($_SESSION);
//            echo count($archivos);
            $contArchivos=count($archivos);

//            echo "</pre>";


            //die();
            $date= explode("-",$post["fechaPedido"]);



//            echo "<pre>datos";
//            print_r($datos);
//            echo "</pre>";
//
//            echo getcwd() . "\n";
            $arrayIdsArchivos=array();

            for ($x=0;$x<=$contArchivos-1;$x++)
            {

                 $archivoname="archivo".$x;

//                echo "<br>";

                $ruta="/var/www/html/relaciones/vistas/archivos/facturas";
                $nombreArchivo=$archivos[$archivoname]['name'];
                $nameArray = explode(".", $nombreArchivo);
//            echo "<pre>datos";
//                print_r($nombreArchivo);
//                print_r($nameArray);
            //echo "</pre>";
                $tipoArchivo=$archivos[$archivoname]['type'];
                $temporal=$archivos[$archivoname]['tmp_name'];
//               echo "<br>";
                $tamañoArchivo=$archivos[$archivoname]['size'];
                $idInico=uniqid();
                $fechaActual=date('Y-m-d H:i:s');
                $nombreCifrado=md5($nombreArchivo);
                 $nombreCompleto=$nombreCifrado.'_'.$idInico.'_'.$fechaActual.'.'.$nameArray[1];
                $temporal;
                 move_uploaded_file($temporal, "$ruta/$nombreCompleto");
//                print_r($temporal);
//                print_r($nombreCompleto);
//                print_r($nameArray);


//                echo "</pre>";
                $tabla="Archivos";
                $datos=array(
                    "id_tipo"=>5,
                    "anio"=>date('Y'),
                    "nombre"=>$nombreArchivo,
                    "archivo"=>$nombreCompleto,
                    "id_usuario"=>$post["idUser"],
                    "fecha_alta"=>date('Y-m-d H:i:s'),

                );

//                echo "<pre>DATOS";
//                print_r($datos);
//                echo "</pre>";

                $resIngArchivo  = ModeloPliegos::mdlIngresarArchivos($tabla,$datos);
//                print_r($resIngArchivo);
                $idArchivo = $resIngArchivo[0]->id;
                if ($idArchivo!='' AND $idArchivo!='error')
                {

                    array_push($arrayIdsArchivos,$idArchivo);

                }


            }
//
//            echo "<pre>CTR$arrayIdsArchivos";
//            print_r($arrayIdsArchivos);
//            echo "</pre>";
            if (empty($arrayIdsArchivos[1]))
            {
                $segundoid="";
            }
            else
            {
                $segundoid=$arrayIdsArchivos[1];
            }
                $tabla2="Facturas";
                $datos2=array(
                    "id_pago"=>$post['pago'],
                    "id_archivo_pdf"=>$arrayIdsArchivos[0],
                    "id_archivo_xml"=>$segundoid,
                    "concepto"=>$post['Concepto'],
                    "monto"=>$post['montoRecibo'],
                    "comentario"=>$post['comentarioRecibo'],
                    "fecha_alta"=>date('Y-m-d H:i:s'),
//                    "fecha_programada_pago"=>date("Y-m-d",strtotime(date('Y-m-d H:i:s')."+ 1 month"))

                );
//                echo "<pre>datos2";
//                print_r($datos2);
//                echo "</pre>";
                $respuesta= ModeloRecibos::mdlIngresarRecibos($tabla2,$datos2);
                if ($respuesta=="ok")
                {
                    $respuestaUpdate=ModeloRecibos::mdlActualizarPago($post['pago'],"En Proceso");
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




            // }//pragmatch
        }// isset
    }

    static public function ctrMostrarRecibos()
    {
//    echo "ctrMostrarOrdenes";
        $respuesta = ModeloRecibos::mdlMostrarRecibos();
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

    static public function ctrBuscarInfo($post)
    {
        if(isset($post))
        {


            $respuestaFacturas  = ModeloRecibos::mdlBuscarInfo($post);
            $respuestaOrdenes  = ModeloOrdenes::mdlBuscarInfo($post);
            $arrayResponse=array();

//            echo "<pre>";
//            print_r($respuestaFacturas);
//            print_r($respuestaOrdenes);
//            echo "</pre>";

            array_push($arrayResponse, $respuestaFacturas, $respuestaOrdenes);
//            echo "<pre>arrayResponse";
//            print_r($arrayResponse);
//            echo "</pre>";

            return $arrayResponse;

        }// isset
    }
}