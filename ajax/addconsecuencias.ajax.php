<?php
require_once "../controladores/addconsecuencias.controlador.php";
require_once "../modelos/addconsecuencias.modelo.php";

class AjaxConsecuencias
{
    public function ajaxCrearAddConsecuencias()
    {
        
        $datos = array(
            "num_proveedor" =>$_POST['numproveedor'],
            "proveedor"     =>$_POST['proveedor'],  
        );
        $respuesta=Controlador::ctrCrearAddconcecuencias($datos);
        echo json_encode($respuesta);
    }

    // public function ajaxEditarProveedores()
    // {
    //     $datos = array(
    //         "num_proveedor" =>$_POST['numproveedor'],
    //         "proveedor"     =>$_POST['proveedor'],
    //         "rfc"           =>$_POST['rfc'],
    //         "correo"        =>$_POST['correo'],
    //         "contacto"      =>$_POST['contacto'],
    //         "moneda"        =>$_POST['moneda'],
    //         "cod_planta"     =>$_POST['codplanta'],
    //         "estatus"       =>$_POST['estatus'],
    //         "id"             =>$_POST['id'],

    //     );
    // //    print_r($datos);
    //     $respuesta=ControladorProveedores::ctrEditarProveedores($datos);
    //     // $respuesta=1;
    //     echo json_encode($respuesta);
    // }

//     public function ajaxEliminarProveedores()
//     {
//         $datos = array(
//             "id" =>$_POST['id'],
//         );
// //        print_r($datos);
//         $respuesta=ControladorProveedores::ctrBorrarProveedores($datos);
//         // $respuesta=1;
//         echo json_encode($respuesta);
//     }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarAddConsecuencias")
{
    $crearaddconcecuencias=new AjaxAddConsecuencias();
    $crearaddconcecuencias->funcion = $_POST["funcion"];
    $crearaddconcecuencias-> ajaxCrearAddConsecuencias();
}

// if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarProveedores")
// {
//     $crearproveedores=new AjaxProveedores();
//     $crearproveedores->funcion = $_POST["funcion"];
//     $crearproveedores-> ajaxEditarProveedores();
// }

// // if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarProveedores")
// // {
// //     $crearproveedores=new AjaxProveedores();
// //     $crearproveedores->funcion = $_POST["funcion"];
// //     $crearproveedores-> ajaxEliminarProveedores();
// // }


