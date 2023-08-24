<?php
require_once "../modelos/cct.modelo.php";
require_once "../controladores/cct.controlador.php";

class AjaxFunciones
{
    public function ajaxAgregarCCT()
    {
        if ($_FILES=='' || $_FILES==null)
        {
            $problemaDocs='problemaDocs';
            echo json_encode($problemaDocs);

        }
        else
        {
            ////        print_r($_POST);
//            echo "<pre>";
//            print_r($_POST);
//            print_r($_FILES);
//            echo "</pre>";

//            print_r($datos);
             $respuesta=ControladorCCT::ctrAgregarCCT($_POST,$_FILES);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
            echo json_encode($respuesta);
        }

    }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarCCT")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxAgregarCCT();

}
