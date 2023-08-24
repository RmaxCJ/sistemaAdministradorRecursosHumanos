<?php
require_once "../controladores/sindicatos.controlador.php";
require_once "../modelos/sindicatos.modelo.php";

class AjaxSindicatos
{
    public function ajaxCrearSindicatos()
    {

//        print_r($_POST);
//        exit();
        $respuesta=ControladorSindicatos::ctrCrearSindicatos($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEditarSindicatos()
    {
        // $datos = array(
        //     "Sindicato"      =>$_POST['Sindicato'],
        //     "NombreCorto"    =>$_POST['NombreCorto'],
        //     "Cod_division"   =>$_POST['Cod_division'],
        //     "id_proveedor"   =>$_POST['id_proveedor'],
        //     "num_proveedor"  =>$_POST['Num_Proveedor'],
        //     "rfc"            =>$_POST['rfc'],
        //     "correo"         =>$_POST['Correo'],
        //     "moneda"         =>$_POST['Moneda'],
        //     "id_Responsable" =>$_POST['id_Responsable'],
        //     // "archivo"        =>$_POST['archivo'],
        //     "id"             =>$_POST['id'],

        // );
    //    print_r($datos);
        $respuesta=ControladorSindicatos::ctrEditarSindicatos($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarSindicatos()
    {
        $datos = array(
            "id" =>$_POST['id'],
        );
//        print_r($datos);
        $respuesta=ControladorSindicatos::ctrBorrarSindicatos($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarSindicatos2()
    {
        $datos = array(
            "id" =>$_POST['id'],
        );
//        print_r($datos);
        $respuesta=ControladorSindicatos::ctrBorrarSindicatos2($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxAgregarLideresSindicatos()
    {
        $datos = array(
            "id_sindicato" =>$_POST['id_sindicato'],
            "jsonLideres" =>$_POST['jsonLideres'],
            "jsonLideresG" =>$_POST['jsonLideresG'],
            
        );
//        print_r($datos);
        $respuesta=ControladorSindicatos::ctrAgregarLideresSindicatos($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxBuscarLideresSindicatos()
    {
        $datos = array(
            "id_sindicato" =>$_POST['id_sindicato'],
        );
    //    print_r($datos);
        $respuesta=ControladorSindicatos::ctrMostrarSindicatosLider($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
        // echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        // foreach ($respuesta as $key => $value)
        // {
        //     $titleUTF8=utf8_encode($value->nombre);
        //    echo array_push($titleUTF8Array,$titleUTF8 );
        // }
    }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarSindicatos")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxCrearSindicatos();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarSindicatos")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEditarSindicatos();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarSindicatos")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEliminarSindicatos();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarSindicatos2")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEliminarSindicatos2();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="AgregarLideresSindicatos")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxAgregarLideresSindicatos();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="BuscarLideresSindicatos")
{
    $crearusuario=new AjaxSindicatos();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxBuscarLideresSindicatos();
}


