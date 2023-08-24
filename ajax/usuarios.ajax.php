<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios
{
    public function ajaxCrearUsuario()
    {
//        $salt = md5($_POST['contrasena']);
//        $passwordEncriptado = crypt($_POST['contrasena'],$salt);
        $passcifrado = md5($_POST['contrasena']);

        $datos = array(
            "perfil"  =>$_POST['perfil'],
            "division"  =>$_POST['division'],
            "nombre"  =>$_POST['nombreEx'],
            "num_Empleado" =>$_POST['num_Empleado'],
            "usuario"  =>$_POST['usuario'],
            "correo"         =>$_POST['correo'],
            "contrasena"=>$passcifrado,
            "activo"         =>"A",
            "active"         =>"N",
//            "fecha_alta"     =>"2020-11-24 16:00:00.000",
            "fecha_alta"     =>date('Y-m-d H:i:s'),
        );
//        print_r($datos);
//        exit();
        $respuesta=ControladorUsuarios::ctrCrearUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function guardarDivisiones()
    {
//        print_r($_POST);
//        exit();
        $respuesta=ControladorUsuarios::ctrGuardarDivisiones($_POST);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function quitarDivisiones()
    {
//        print_r($_POST);
//        exit();
        $respuesta=ControladorUsuarios::ctrQuitarDivisiones($_POST);
        // $respuesta=1;
        echo json_encode($respuesta);
    }


    public function ajaxCrearUsuarioEmpleado()
    {
        $datos = array(
            "perfil"  =>$_POST['perfil'],
            "num_Empleado" =>$_POST['num_Empleado'],
            "usuario"  =>$_POST['usuario'],
            "correo"         =>$_POST['correo'],
            "activo"         =>"A",
            "active"         =>"S",
//            "fecha_alta"     =>"2020-11-24 16:00:00.000",
            "fecha_alta"     =>date('Y-m-d H:i:s'),
        );
//        echo "ajax";
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrCrearUsuarioEmpleado($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEditarUsuario()
    {
        $datos = array(
            "perfil"  =>$_POST['perfil'],
            "num_Empleado" =>$_POST['num_Empleado'],
            "nombreEmpleado" =>$_POST['nombreEmpleado'],
            "usuario"  =>$_POST['usuario'],
            "correo"         =>$_POST['correo'],
            "idUsuario"         =>$_POST['idUsuario'],

        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrEditarUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxBajaUsuario()
    {
        $datos = array(
            "idUsuario"         =>$_POST['idUsuario'],
        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrBajaUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }
    public function ajaxEliminarUsuario()
    {
        $datos = array(
            "idUsuario"         =>$_POST['idUsuario'],
        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrEliminarUsuario($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function buscarEmpleadoByNumEmpleado()
    {
//        $datos = array(
//            "numEmpleadoActive"         =>$_POST['numEmpleadoActive'],
//        );
//        echo "ajax";
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($_POST);
//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]->correo);
        // $respuesta=1;
        echo json_encode($respuesta[0]->correo);
    }

    public function buscarEmpleadoByNumEmpleadoDEMANDAS()
    {
        $datos = array(
            "numEmpleadoActive"         =>$_POST['numEmpleadoActive'],
        );
//        echo "ajax";
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoDEMANDAS($datos);
//        echo "<pre>";
//        print_r($respuesta);
//        print_r($respuesta[0]->cod_division);
//        print_r($_SESSION['divisiones']);
//        echo "</pre>";
//
//        if ($_SESSION['id_perfil']!=1)
//        {
//
//            $cadena_de_texto = $_SESSION['divisiones'];
//            $cadena_buscada   = $respuesta[0]->cod_division;
//            $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
//
//        }



//        echo "ajax2";
//        print_r($respuesta);
//        print_r($respuesta[0]);
        // $respuesta=1;
        echo json_encode($respuesta[0]);
    }

    public function buscarEmpleadoByNumEmpleadoConsecuencias()//para Gestion de Cuencecuencias
    {
        $datos = array(
            "numEmpleadoActive" =>$_POST['num_empleado'],
        );
            //    print_r($datos);
        $respuesta=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoConsecuencias($datos);
        echo json_encode($respuesta[0]);
    }

    public function ajaxResetPass()
    {
        $datos = array(
            "idUsuario"         =>$_POST['idUsuario'],
            "nameUsuario"         =>$_POST['nameUsuario'],
        );
//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrResetPass($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function resetPassUser()
    {

//        print_r($datos);
        $respuesta=ControladorUsuarios::ctrResetPassUser($_POST);
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

if (isset($_POST["funcion"]) && $_POST["funcion"]=="bajaUsuario")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxBajaUsuario();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarUsuario")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxEliminarUsuario();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarEmpleadoByNumEmpleado")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> buscarEmpleadoByNumEmpleado();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarEmpleadoByNumEmpleadoDEMANDAS")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> buscarEmpleadoByNumEmpleadoDEMANDAS();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="buscarEmpleadoByNumEmpleadoConsecuencias")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> buscarEmpleadoByNumEmpleadoConsecuencias();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarUsuariosEmpleados") {
    $crearusuario = new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario->ajaxCrearUsuarioEmpleado();
}


if (isset($_POST["funcion"]) && $_POST["funcion"]=="resetPass")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> ajaxResetPass();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="resetPassUser")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> resetPassUser();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="guardarDivisiones")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> guardarDivisiones();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="quitarDivisiones")
{
    $crearusuario=new AjaxUsuarios();
    $crearusuario->funcion = $_POST["funcion"];
    $crearusuario-> quitarDivisiones();
}
