<?php
require_once "../modelos/recibos.modelo.php";
require_once "../modelos/ordenes.modelo.php";
require_once "../modelos/pliegos.modelo.php";
require_once "../modelos/pagos.modelo.php";
require_once "../controladores/recibos.controlador.php";
require_once "../controladores/ordenes.controlador.php";
require_once "../controladores/pagos.controlador.php";

class AjaxFunciones
{
    public function ajaxbuscarInfo()
    {
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

//            print_r($datos);
        $respuesta=ControladorRecibos::ctrBuscarInfo($_POST);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxaceptarValidacion()
    {

//        print_r($datos);
        $respuesta=ControladorPagos::ctrValidarPago($_POST,"Validado");
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxrechazarValidacion()
    {

//        print_r($datos);
        $respuesta=ControladorPagos::ctrRechazarPago($_POST,"Rechazado");
        // $respuesta=1;
        echo json_encode($respuesta);

    }

    public function ajaxguardarNumRecepcion()
    {

//        print_r($datos);
        $respuesta=ControladorPagos::ctrGuardarRecepcion($_POST,"Recepcion");
        // $respuesta=1;
        echo json_encode($respuesta);

    }

    public function ajaxguardarFechaRegistro()
    {

//        print_r($_POST);
//        exit();
        $respuesta=ControladorPagos::ctrGuardarFechaRegistro($_POST,"Registrado");
        // $respuesta=1;
        echo json_encode($respuesta);

    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarInfo")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxbuscarInfo();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="aceptarValidacion")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxaceptarValidacion();

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="rechazarValidacion")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxrechazarValidacion();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarNumRecepcion")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxguardarNumRecepcion();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarFechaRegistro")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxguardarFechaRegistro();

}
