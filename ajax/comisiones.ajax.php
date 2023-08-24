<?php
require_once "../controladores/comisiones.controlador.php";
require_once "../modelos/comisiones.modelo.php";

class AjaxComisiones
{
    public function ajaxCrearComisiones()
    {
        $respuesta=ControladorComisiones::ctrCrearComisiones($_POST,$_FILES);
        echo json_encode($respuesta);
    }
    public function ajaxModificarComisiones()
    {
        $respuesta=ControladorComisiones::ctrModificarComisiones($_POST,$_FILES);
        echo json_encode($respuesta);
    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarComisiones")
{
    $crearcomisiones=new AjaxComisiones();
    $crearcomisiones->funcion = $_POST["funcion"];
    $crearcomisiones-> ajaxCrearComisiones();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="actualizarComisiones")
{
    $actualizarcomisiones=new AjaxComisiones();
    $actualizarcomisiones->funcion = $_POST["funcion"];
    $actualizarcomisiones-> ajaxModificarComisiones();
}
