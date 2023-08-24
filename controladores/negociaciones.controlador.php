<?php

class ControladorNegociaciones
{

    static public function ctrMostrarNegociacionesCalendario($cod_division)
    {
//    echo "ctrMostrarOrdenes";
        $respuesta = ModeloNegociaciones::mdlMostrarNegociacionesCalendario($cod_division);
        return $respuesta;
    }

    static  public  function ctrMostrarNegociacionesPorDia($dia)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlMostrarNegociacionesPorDia($dia);
        return $respuesta;
    }

    static  public  function ctrMostrarArchivoporSindicato($idSin)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlMostrarArchivoporSindicato($idSin);
        return $respuesta;
    }
    static  public  function ctrContenidoCCT($idContenido)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlContenidoCCT($idContenido);
        return $respuesta;
    }
    static  public  function ctrMostrarHistorialCCTporSindicato($idSin)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlMostrarHistorialCCTporSindicato($idSin);
        return $respuesta;
    }

    static  public  function ctrMostrarBitacoraNegociacion($IDNeg)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlMostrarBitacoraNegociacion($IDNeg);
//        print_r($respuesta);
        return $respuesta;
    }

    static  public  function ctrCerrarNegociacion($post)
    {
//        echo "ctrCerrarNegociacion";
//        print_r($post);
//exit();
        $respuesta = ModeloNegociaciones::mdlCerrarNegociacion($post);
//        print_r($respuesta);
        return $respuesta;
    }
    static  public  function ctrCambiarFechaBitacora($post)
    {
//        echo "ctrCambiarFechaBitacora";
//        print_r($post);

        $respuesta = ModeloNegociaciones::mdlCambiarFechaBitacora($post);
//        print_r($respuesta);
        return $respuesta;
    }
    static  public  function ctrUltimaFechaNego($idNeg)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlUltimaFechaNego($idNeg);
        return $respuesta;
    }

    static  public  function ctrAlertaNegociacionesPendientes($divisiones)
    {
//        echo "ctrMostrarPagosPorDia";
        $respuesta = ModeloNegociaciones::mdlAlertaNegociacionesPendientes($divisiones);
        return $respuesta;
    }

    static  public  function ctrModificarWordxSindicato($contenido,$idContenido)
    {
//        echo "<pre>";
//        print_r($contenido);
//        print_r($idContenido);
//        echo "<pre>";
        $respuesta =ModeloNegociaciones::mdlActualizarWord($contenido,$idContenido);
        print_r($respuesta);
        if ($respuesta=='ok')
    {

        echo '<script language="javascript" type="text/javascript">

                    Swal.fire({
                        title: "¡Documento Guardado!",
                        text: "¡La ventana se cerrará y podra continuar!",
                        icon: "success",
                        confirmButtonText:"Entendido!"
                    }).then((result)=>{
                        if(result.value){
                            // window.location = "calendario";
                            window.open("","_parent","");
                             window.close();
                             //location.reload();

                        }
                    });
               
//               location.reload();

            </script>';


    }
//        return $respuesta;
    }

//
}