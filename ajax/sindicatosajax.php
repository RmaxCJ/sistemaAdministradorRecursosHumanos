<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios
{
    public function ajaxCrearUsuario()
    {
        $salt = md5($_POST['contrasena']);
        $passwordEncriptado = crypt($_POST['contrasena'],$salt);
        $datos = array(
            "perfil"  =>$_POST['perfil'],
            "num_Empleado" =>$_POST['num_Empleado'],
            "usuario"  =>$_POST['usuario'],
            "correo"         =>$_POST['correo'],
            "contrasena"=>$passwordEncriptado,
            "activo"         =>"A",
            "active"         =>"N",
//            "fecha_alta"     =>"2020-11-24 16:00:00.000",
            "fecha_alta"     =>date('Y-m-d H:i:s'),
        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrCrearUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEditarUsuario()
    {
        $datos = array(
            "perfil"  =>$_POST['perfil'],
            "num_Empleado" =>$_POST['num_Empleado'],
            "usuario"  =>$_POST['usuario'],
            "correo"         =>$_POST['correo'],
            "idUsuario"         =>$_POST['idUsuario'],

        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrEditarUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxEliminarUsuario()
    {
        $datos = array(
            "idUsuario"         =>$_POST['idUsuario'],
        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrBorrarUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarUsuarios")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxCrearUsuario();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarUsuario")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEditarUsuario();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarUsuario")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEliminarUsuario();
}


