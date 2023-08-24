<?php
require_once "../controladores/revisiones.controlador.php";
require_once "../modelos/revisiones.modelo.php";
require_once "../modelos/pliegos.modelo.php";
require_once "../modelos/multas.modelo.php";

class AjaxRevisiones
{



    public function guardarRevision()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorRevisiones::ctrGuardarRevision($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }


    public function subirArchivoRevision()
    {

        // echo "ajax";
        // print_r($_POST);
        // print_r($_FILES);
        // exit();
        $respuesta=ControladorRevisiones::ctrSubirArchivoRevision($_POST,$_FILES);
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
    public function guardarEdicionRevision()
    {

//        echo "ajax";
//        print_r($_POST);
//        exit();
        $respuesta=ControladorRevisiones::ctrGuardarEdicionRevision($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarRevision")
{
    $crearusuario=new AjaxRevisiones();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarRevision();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="subirArchivoRevision")
{
    $crearusuario=new AjaxRevisiones();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> subirArchivoRevision();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarRevision")
{
    $crearusuario=new AjaxRevisiones();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarRevision();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarEdicionRevision")
{
    $crearusuario=new AjaxRevisiones();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarEdicionRevision();
}

//print_r($_POST);