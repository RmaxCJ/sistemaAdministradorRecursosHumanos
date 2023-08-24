<?php
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores
{
    public function ajaxCrearProveedores()
    {
        
        $datos = array(
            "num_proveedor" =>$_POST['numproveedor'],
            "proveedor"     =>$_POST['proveedor'],
            "rfc"           =>$_POST['rfc'],
            "correo"        =>$_POST['correo'],
            "contacto"      =>$_POST['contacto'],
            "moneda"        =>$_POST['moneda'],
            "codplanta"     =>$_POST['codplanta'],
            "estatus"       =>"A",
            "fecha_alta"    =>date('Y-m-d H:i:s'),
            
        );
//        print_r($datos);
        $respuesta=ControladorProveedores::ctrCrearProveedores($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEditarProveedores()
    {
        $datos = array(
            "num_proveedor" =>$_POST['numproveedor'],
            "proveedor"     =>$_POST['proveedor'],
            "rfc"           =>$_POST['rfc'],
            "correo"        =>$_POST['correo'],
            "contacto"      =>$_POST['contacto'],
            "moneda"        =>$_POST['moneda'],
            "cod_planta"     =>$_POST['codplanta'],
            "estatus"       =>$_POST['estatus'],
            "id"             =>$_POST['id'],

        );
    //    print_r($datos);
        $respuesta=ControladorProveedores::ctrEditarProveedores($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxEliminarProveedores()
    {
        $datos = array(
            "id" =>$_POST['id'],
        );
//        print_r($datos);
        $respuesta=ControladorProveedores::ctrBorrarProveedores($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarProveedores")
{
    $crearproveedores=new AjaxProveedores();
    $crearproveedores->funcion = $_POST["funcion"];
    $crearproveedores-> ajaxCrearProveedores();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarProveedores")
{
    $crearproveedores=new AjaxProveedores();
    $crearproveedores->funcion = $_POST["funcion"];
    $crearproveedores-> ajaxEditarProveedores();
}

// if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarProveedores")
// {
//     $crearproveedores=new AjaxProveedores();
//     $crearproveedores->funcion = $_POST["funcion"];
//     $crearproveedores-> ajaxEliminarProveedores();
// }


