<?php
require_once "../controladores/consecuencias.controlador.php";
require_once "../modelos/consecuencias.modelo.php";

class AjaxConsecuencias
{
    public function ajaxCrearAddConsecuencias()
    {   
        $datos = array(
            "pais"         =>$_POST['pais'],
            "amonestacion" =>$_POST['amonestacion'],
            "arregloConsecuencia" =>$_POST['arregloConsecuencia'],  
        );
        // print_r($datos);
        $respuesta=ControladorConsecuencias::ctrCrearAddConsecuencias($datos);
        echo json_encode($respuesta);
    }

    public function ctrEditarAddConsecuencias()
    {
        $datos = array(
            "pais"                =>$_POST['pais'],
            "amonestacion"        =>$_POST['amonestacion'],
            "arregloConsecuencia"   =>$_POST['arregloConsecuencia'],
            "arraycondel"         =>$_POST['arraycondel'],
            "id"                  =>$_POST['id'],
        );
    //    print_r($datos);
        $respuesta=ControladorConsecuencias::ctrEditarAddConsecuencias($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxEliminarAddConsecuencias()
    {   
        $datos = array(
            "id"         =>$_POST['id'], 
        );
        // print_r($datos);
        $respuesta=ControladorConsecuencias::ctrEliminarAddConsecuencias($datos);
        echo json_encode($respuesta);
    }

    public function ajaxBuscarAmonestacionesConsecuencia()//para Gestion de Cuencecuencias
    {
        $datos = array(
            "tipoConsecuencia" =>$_POST['tipoConsecuencia'],
        );
        // print_r($datos);
        $respuesta=ControladorConsecuencias::ctrBuscarAmonestacionesConsecuencia($datos);
        echo json_encode($respuesta);
    }
    public function ajaxAgregarConsecuencia()//para Gestion de Cuencecuencias
    {
        // print_r($datos);
        $respuesta=ControladorConsecuencias::ctrAgregarConsecuencia($_POST,$_FILES);
        echo json_encode($respuesta);
    }

    public function ajaxActualizarConsecuencia()//para Gestion de Cuencecuencias
    {
        // print_r($datos);
        $respuesta=ControladorConsecuencias::ctrActualizarConsecuencia($_POST,$_FILES);
        echo json_encode($respuesta);
    }

    public function ajaxEliminarConsecuencia()
    {
        $datos = array(
            "idC" =>$_POST['idC'],
        );
    //    print_r($datos);
        $respuesta=ControladorConsecuencias::ctrEliminarConsecuencia($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarAddConsecuencias")
{
    $crearaddconcecuencias=new AjaxConsecuencias();
    $crearaddconcecuencias->funcion = $_POST["funcion"];
    $crearaddconcecuencias-> ajaxCrearAddConsecuencias();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarAddConsecuencias")
{
    $editaraddconcecuencias=new AjaxConsecuencias();
    $editaraddconcecuencias->funcion = $_POST["funcion"];
    $editaraddconcecuencias-> ctrEditarAddConsecuencias();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarEliminarAmonestacion")
{
    $eliminaraddconcecuencias=new AjaxConsecuencias();
    $eliminaraddconcecuencias->funcion = $_POST["funcion"];
    $eliminaraddconcecuencias-> ajaxEliminarAddConsecuencias();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarAmonestacionConsecuencia")
{
    $buscarAmonestacionConsecuencia=new AjaxConsecuencias();
    $buscarAmonestacionConsecuencia->funcion = $_POST["funcion"];
    $buscarAmonestacionConsecuencia-> ajaxbuscarAmonestacionesConsecuencia();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarConsecuencia")
{
    $agregarConsecuencia=new AjaxConsecuencias();
    $agregarConsecuencia->funcion = $_POST["funcion"];
    $agregarConsecuencia-> ajaxAgregarConsecuencia();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="actualizarConsecuencia")
{
    $actualizarConsecuencia=new AjaxConsecuencias();
    $actualizarConsecuencia->funcion = $_POST["funcion"];
    $actualizarConsecuencia-> ajaxActualizarConsecuencia();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarConsecuencia")
{
    $eliminarConsecuencia=new AjaxConsecuencias();
    $eliminarConsecuencia->funcion = $_POST["funcion"];
    $eliminarConsecuencia-> ajaxEliminarConsecuencia();
}




