<?php
require_once "../controladores/conceptos.controlador.php";
require_once "../modelos/conceptos.modelo.php";

class AjaxConceptos
{



    public function agregarMedioDefensa()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrAgregarMedioDefensa($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function agregarEstatus()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrAgregarEstatus($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function agregarArea()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrAgregarArea($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function agregarResultado()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrAgregarResultado($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function eliminarDefensa()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrEliminarDefensa($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function eliminarEstatus()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrEliminarEstatus($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function eliminarArea()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrEliminarArea($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function eliminarResultado()
    {

//        echo "ajax";
//        print_r($_POST);
        $respuesta=ControladorConceptos::ctrEliminarResultado($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}
//----------------------------------------------------------------------------------------------

if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarMedioDefensa")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> agregarMedioDefensa();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarEstatus")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> agregarEstatus();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarArea")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> agregarArea();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarResultado")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> agregarResultado();
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarDefensa")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarDefensa();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarEstatus")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarEstatus();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarArea")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarArea();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarResultado")
{
    $crearusuario=new AjaxConceptos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> eliminarResultado();
}