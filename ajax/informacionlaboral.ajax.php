<?php
require_once "../controladores/informacionlaboral.controlador.php";
require_once "../modelos/informacionlaboral.modelo.php";

class AjaxRit
{
    public function ajaxCrearInformacion()
    {
    //    print_r($datos);
    
        $respuesta=ControladorInformacion::ctrCrearInformacion($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }


}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarinformacion")
{
    $crearinformacion=new AjaxRit();
    $crearinformacion->funcion = $_POST["funcion"];
    $crearinformacion-> ajaxCrearInformacion();
}
