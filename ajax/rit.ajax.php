<?php
require_once "../controladores/rit.controlador.php";
require_once "../modelos/rit.modelo.php";

class AjaxRit
{
    public function ajaxCrearRit()
    {
    //    print_r($datos);
    
        $respuesta=ControladorRit::ctrCrearRit($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxCrearObsevacionRit()
    {
        $datos = array(
            "id_usuario" =>$_POST['id_usuario'],
            "observacion" =>$_POST['observacion'],
            "fecha_alta"    =>date('Y-m-d H:i:s'),
            "alcance"     =>$_POST['alcance'],
            "meta"        =>$_POST['meta'],
        );
    
        $respuesta=ControladorRit::ctrCrearObservacionRit($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarRit")
{
    $crearrit=new AjaxRit();
    $crearrit->funcion = $_POST["funcion"];
    $crearrit-> ajaxCrearRit();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarObservacionRit")
{
    $crearrit=new AjaxRit();
    $crearrit->funcion = $_POST["funcion"];
    $crearrit-> ajaxCrearObsevacionRit();
}