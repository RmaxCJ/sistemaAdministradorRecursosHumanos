<?php
require_once "../controladores/correos.controlador.php";

class AjaxCorreos
{

    public function ajaxEnviarCorreo()
    {
        $datos = array(
            "nombre" =>$_POST['nombre'],
        );
    //    print_r($datos);
        $respuesta=ControladorCorreos::ctrEnviarCorreo($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="EnviarCorreo")
{
    $crearusuario=new AjaxCorreos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEnviarCorreo();
}


