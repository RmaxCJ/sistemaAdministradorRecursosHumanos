<?php
require_once "../controladores/multas.controlador.php";
require_once "../modelos/multas.modelo.php";
require_once "../modelos/pliegos.modelo.php";

class AjaxMultas
{



    public function guardarMulta()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorMultas::ctrGuardarMulta($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function guardarEdicionMulta()
    {

//        echo "ajax";
//        print_r($_POST);
//        exit();
        $respuesta=ControladorMultas::ctrGuardarEdicionMulta($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }


    public function subirArchivoMulta()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorMultas::ctrSubirArchivoMulta($_POST,$_FILES);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function eliminarRevision()
    {
//        print_r($datos);
        $respuesta=ControladorRevisiones::ctrBorrarRevision($_POST['idRevision']);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarMulta")
{
    $crearusuario=new AjaxMultas();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarMulta();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarEdicionMulta")
{
    $crearusuario=new AjaxMultas();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarEdicionMulta();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="subirArchivoMulta")
{
    $crearusuario=new AjaxMultas();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> subirArchivoMulta();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarMulta")
{
    $crearusuario=new AjaxMultas();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarMulta();
}
