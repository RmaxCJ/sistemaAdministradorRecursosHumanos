<?php
//require_once "../controladores/aspirantes.controlador.php";
require_once "../modelos/alumnosgrupos.modelo.php";
class AjaxFunciones
{
    public function funcion1()
    {
       $respuesta=1;
        echo json_encode($respuesta);
    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarAlumnosgrupos")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> funcion1();

}
