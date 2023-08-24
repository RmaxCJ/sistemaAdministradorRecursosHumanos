<?php
require_once "../controladores/negociaciones.controlador.php";
require_once "../modelos/negociaciones.modelo.php";

class AjaxMinutas
{
    public function ajaxCambiarFecha()
    {

//        print_r($_POST);
//        exit();
        $respuesta=ControladorNegociaciones::ctrCambiarFechaBitacora($_POST);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function cerrarNegociacion()
    {

//        print_r($_POST);
//        exit();
        $respuesta=ControladorNegociaciones::ctrCerrarNegociacion($_POST);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="cambiarFecha")
{
    $eliminarminutas=new AjaxMinutas();
    $eliminarminutas->funcion = $_POST["funcion"];
    $eliminarminutas-> ajaxCambiarFecha();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="cerrarNegociacion")
{
    $eliminarminutas=new AjaxMinutas();
    $eliminarminutas->funcion = $_POST["funcion"];
    $eliminarminutas-> cerrarNegociacion();
}


