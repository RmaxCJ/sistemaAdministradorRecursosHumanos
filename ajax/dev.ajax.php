<?php
require_once "../modelos/tablasDEV.modelo.php";


class AjaxFunciones
{
    public function ajaxconsultarTabla()
    {
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

//            print_r($datos);
        $respuesta=ModeloTablasDEV::mdlconsultarTabla($_POST);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxquerySQL()
    {
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";

//            print_r($datos);
        $respuesta=ModeloTablasDEV::mdlquerySQL($_POST);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
//        echo $respuesta;
        echo json_encode($respuesta);
    }


}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="consultarTabla")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxconsultarTabla();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="querySQL")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxquerySQL();

}

