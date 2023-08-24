<?php
require_once "../modelos/ordenes.modelo.php";
require_once "../modelos/pliegos.modelo.php";
require_once "../modelos/recibos.modelo.php";
require_once "../controladores/ordenes.controlador.php";

class AjaxFunciones
{
    public function ajaxAgregarOrden()
    {
//        echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//        echo "</pre>";

//            print_r($datos);
        $respuesta=ControladorOrdenes::ctrAgregarOrdenes($_POST,$_FILES);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarOrden()
    {
        $datos = array(
            "id" =>$_POST['id'],
        );
//        print_r($datos);
        $respuesta=ControladorPliegos::ctrBorrarPliegos($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarOrden")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxAgregarOrden();

}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarOrden")
{
    $eliminarminutas=new AjaxMinutas();
    $eliminarminutas->funcion = $_POST["funcion"];
    $eliminarminutas-> ajaxEliminarOrden();
}
