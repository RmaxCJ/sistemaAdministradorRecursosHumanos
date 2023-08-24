<?php
require_once "../modelos/pagos.modelo.php";
require_once "../controladores/pagos.controlador.php";

class AjaxFunciones
{
    public function ajaxAgregarNuevoPago()
    {
            //    print_r($_POST);
            //    echo "<pre>";
            //    print_r($_POST);
            //    echo "</pre>";

            //        print_r($datos);
        $respuesta=ControladorPagos::ctrAgregarNuevoPago($_POST);
            //    echo "<pre>";
            //    print_r($respuesta);
            //    echo "</pre>";
            //    // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxGuardarComprobante()
    {
        //    print_r($datos);
    
        $respuesta=ControladorPagos::ctrGuardarComprobante($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarPago()
    {
        $datos = array(
            "IdPago"         =>$_POST['IdPago'],
        );
//        print_r($datos);
        $respuesta=ControladorPagos::ctrEliminarPago($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function buscarNumRecepcion()
    {
        $datos = array(
            "IdPago"         =>$_POST['IdPago'],
        );
//        print_r($datos);
        $respuesta=ControladorPagos::ctrNumRecepcionxPago($datos);
//         $respuesta=1;
        echo json_encode($respuesta);
    }

    public function buscarFechasRecepcion()
    {
        $datos = array(
            "IdPago"         =>$_POST['IdPago'],
        );
//        print_r($datos);
        $respuesta=ControladorPagos::ctrBuscarFechasRecepcion($datos);
//         $respuesta=1;
        echo json_encode($respuesta);
    }
}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarNuevoPago")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxAgregarNuevoPago();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="GuardarComprobante")
{
    $guardarcomprobante=new AjaxFunciones();
    $guardarcomprobante->funcion = $_POST["funcion"];
    $guardarcomprobante-> ajaxGuardarComprobante(); 
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarPago")
{
    $obj=new AjaxFunciones();
    $obj->funcion = $_POST["funcion"];
    $obj-> ajaxEliminarPago();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarNumRecepcion")
{
    $obj=new AjaxFunciones();
    $obj->funcion = $_POST["funcion"];
    $obj-> buscarNumRecepcion();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarFechasRecepcion")
{
    $obj=new AjaxFunciones();
    $obj->funcion = $_POST["funcion"];
    $obj-> buscarFechasRecepcion();
}