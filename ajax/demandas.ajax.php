<?php
require_once "../controladores/demandas.controlador.php";
require_once "../modelos/demandas.modelo.php";
require_once "../modelos/pliegos.modelo.php";

class AjaxUsuarios
{



    public function areasPorVPs()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorDemandas::ctrAreasPorVPs($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function guardarDemanda()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorDemandas::ctrGuardarDemanda($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function guardarDemandaExterna()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorDemandas::ctrGuardarDemandaExterna($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function cerrarDemanda()
    {

//        echo "ajax";
//        print_r($_POST);
//        exit();
        $respuesta=ControladorDemandas::ctrCerrarDemanda($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function guardarEdicion()
    {

//        echo "ajax";
//        print_r($_POST);
////        exit();
        $respuesta=ControladorDemandas::ctrGuardarEdicion($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function subirArchivoDemanda()
    {

//        echo "ajax";
//        print_r($_POST);
//        print_r($_FILES);
//        exit();
        $respuesta=ControladorDemandas::ctrSubirArchivoDemanda($_POST,$_FILES);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function subirReporteAbogado()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorDemandas::ctrSubirReporteAbogado($_POST,$_FILES);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="areasPorVPs")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> areasPorVPs();
}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarDemanda")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarDemanda();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="cerrarDemanda")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> cerrarDemanda();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarDemandaExterna")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarDemandaExterna();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="subirArchivoDemanda")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> subirArchivoDemanda();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="subirReporteAbogado")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> subirReporteAbogado();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarEdicion")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarEdicion();
}