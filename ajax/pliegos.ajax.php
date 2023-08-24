<?php
require_once "../modelos/pliegos.modelo.php";
require_once "../controladores/pliegos.controlador.php";

class AjaxFunciones
{
    public function ajaxAgregarPliego()
    {
//        print_r($_POST);
//        echo "<pre>";
//        print_r($_POST);
//        print_r($_FILES);
//        print_r($_SESSION);
//        echo "</pre>";

//            print_r($datos);
        $respuesta=ControladorPliegos::ctrAgregarPliegos($_POST,$_FILES);
//        echo "<pre>";
//        print_r($respuesta);
//        echo "</pre>";
//        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxCrearPliego()
    {
        $datos = array(
            "id_sindicato"      =>$_POST['sindicato'],
            "tema"              =>$_POST['txtTema'],
            "id_usuario"        =>$_POST['idUser'],
            "jsonPeticiones"      =>$_POST['jsonPeticiones'],
            "fecha_alta"        =>date('Y-m-d H:i:s'),
            "estatus"           =>"Activo",
            "tipoCreacion"        =>'Creado',

        );
//        print_r($datos);
        $respuesta=ControladorPliegos::ctrCrearPliego($datos);
//        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarPliego()
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
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarPliego")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxAgregarPliego();

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="crearPliego")
{
    $funcion=new AjaxFunciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxCrearPliego();

}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarPliego")
{
    $eliminarminutas=new AjaxMinutas();
    $eliminarminutas->funcion = $_POST["funcion"];
    $eliminarminutas-> ajaxEliminarPliego();
}