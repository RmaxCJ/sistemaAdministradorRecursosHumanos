<?php

class ControladorPagos
{

    static public function ctrMostrarPagosCalendario($cod_division)
    {
        // echo "ctrMostrarOrdenes";
        $respuesta = ModeloPagos::mdlMostrarPagosCalendario($cod_division);
        return $respuesta;
    }
    static public function ctrAlertaPagosPendientes($divisiones)
    {
        // echo "ctrMostrarOrdenes";
        $respuesta = ModeloPagos::mdlAlertaPagosPendientes($divisiones);
        return $respuesta;
    }
    static public function ctrMostrarPagos()
    {
        // echo "ctrMostrarOrdenes";
        $respuesta = ModeloPagos::mdlMostrarPagos();
        return $respuesta;
    }
    static  public  function ctrMostrarPagosPorDia($dia,$cod_division)
    {
//         echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloPagos::mdlMostrarPagosPorDia($dia,$cod_division);
        return $respuesta;
    }
    static public function ctrValidarPago($post,$status)
    {
        $respuesta=ModeloPagos::mdlValidarPago($post,$status);
        if ($respuesta=="ok")
        {

        }
        return $respuesta;
    }
    static public function ctrRechazarPago($post,$status)
    {
        $respuesta=ModeloPagos::mdlRechazarPago($post,$status);
        return $respuesta;
    }
    static public function ctrGuardarRecepcion($post,$status)
    {
        if (isset($post) && isset($status))
        {
            // echo "<pre>";
            // print_r($post);
            // print_r($status);
            // echo "</pre>";
            $respuestaNumRec=ModeloPagos::mdlGActualizarRecepcion($post,$status);
            // print_r($respuestaNumRec);
            if ($respuestaNumRec=="ok")
            {
                $respuestaGuardaRecep=ModeloPagos::mdlGuardarRecepcion($post);
                // print_r($respuesta);
                // ControladorCorreos::ctrEnviarCorreoRecepcion();  //correos
                return $respuestaGuardaRecep;
            }
            // return $respuestaNumRec;
        }
    }
    static public function ctrGuardarFechaRegistro($post,$status)
    {
        if (isset($post) && isset($status))
        {
            // echo "<pre>";
            // print_r($post);
            // echo "</pre>";
            $respuesta=ModeloPagos::mdlActualizarFechaProgramada($post);
            //    print_r($respuesta);
            //    return $respuesta;
            if ($respuesta=='ok')
            {
                $respuesta2=ModeloPagos::mdlActualizarRegistro($post,$status);
            //    print_r($respuesta2);
                return $respuesta2;

            }
        }
    }
    static public function ctrAgregarNuevoPago($post)
    {
        if (isset($post))
        {
            // echo "<pre>";
            // print_r($post);
            // print_r($status);
            // echo "</pre>";
            $respuestaNumRec=ModeloPagos::mdlAgregarNuevoPago($post);
            //    print_r($respuestaNumRec);

            return $respuestaNumRec;
        }
    }
    static public function ctrGuardarComprobante($datos,$archivos)
    {
        if(isset($datos))
        {
            $ruta="/var/www/html/relaciones/vistas/archivos/comprobantes";
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
            $resIngArchivo  = ModeloPagos::mdlIngresarArchivos($tabla2,$datos2);
            $idArchivo = $resIngArchivo[0]->id;
            if ($idArchivo!='' AND $idArchivo!='error')
            {
                $tabla3 = "Comprobantes";
                // $idpago = $datos["idpago"];
                $respuesta3  = ModeloPagos::mdlGuardarComprobante($tabla3,$idArchivo,$datos);    
                return $respuesta3; 
            }
        }// isset
    }
    static public function ctrMostrarArchivosComprobante($id_pago)
    {
        $tabla="Comprobantes";
        $respuesta = ModeloPagos::mdlMostrarArchivosComprobante($tabla,$id_pago);
        return $respuesta;
    }
    static public function ctrFacturaxPago($id_pago)
    {
        $resp=ModeloPagos::mdlFacturaxPago($id_pago);
        return$resp;
    }

    static public function ctrOrdenxPago($id_pago)
    {
        $resp=ModeloPagos::mdlOrdenxPago($id_pago);
        return$resp;
    }
    static public function ctrNumRecepcionxPago($datos)
    {
        $resp=ModeloPagos::ctrNumRecepcionxPago($datos);
        return$resp;
    }
    static public function ctrBuscarFechasRecepcion($datos)
    {
        $resp=ModeloPagos::mdlBuscarFechasRecepcion($datos);
        return$resp;
    }

    static public function ctrEliminarPago($datos)
    {
        if(isset($datos))
        {
            $tabla = "Pagos";
            $respuesta = ModeloPagos::mdlEliminarPago($tabla,$datos);
            return $respuesta;

        }
    }

}