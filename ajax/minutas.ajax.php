<?php
require_once "../controladores/minutas.controlador.php";
require_once "../modelos/minutas.modelo.php";
require_once "../modelos/pliegos.modelo.php";

class AjaxMinutas
{
    public function ajaxCrearMinutas()
    {
        
        $datos = array(
            "id_sindicato"      =>$_POST['Sindicato'],
            "tema"              =>$_POST['Tema'],
            "estatus"           =>$_POST['Estatus'],
            // "id_usuario"        =>$_POST['Usuario'],
            "generales"         =>$_POST['Generales'],
            "lugar"             =>$_POST['lugar'],
            "externo"           =>$_POST['externo'],
            "id_usuario_resp"   =>$_POST['id_usuario_resp'],
            "horainicio"        =>$_POST['horainicio'],
            "horafin"           =>$_POST['horafin'],
            "jsonTemas"         =>$_POST['jsonTemas'],
            "fecha_alta"        =>date('Y-m-d H:i:s'),
            "id_usuario"         =>$_POST['Redactado'],
            "jsonAsistentes"      =>$_POST['jsonAsistentes'],
            "AsistentesSR"      =>$_POST['AsistentesSR'],
            "jsonAcuerdos"      =>$_POST['jsonAcuerdos'],
            "jsonAcuerdos2"      =>$_POST['jsonAcuerdos2'],  
            "file"             =>$_POST['file'],
        );
    //    print_r($datos);
        $respuesta=ControladorMinutas::ctrCrearMinutas($datos,$_FILES);
        // $respuesta=ControladorMinutas::ctrCrearMinutas($_POST,$_FILES);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

    public function ajaxBuscarAcuerdosMinutasPasadas()
    {
        $datos = array(
            "id_sindicato" =>$_POST['sindicato'],
        );
        //    print_r($datos);
        $respuesta=ControladorMinutas::ctrMostraracuerdosMinutaspasadas($datos);
        echo json_encode($respuesta);
    }

    // public function ajaxEditarMinutas()
    // {
    //     $datos = array(
    //         "id_sindicato"      =>$_POST['Sindicato'],
    //         "tema"              =>$_POST['Tema'],
    //         "estatus"           =>$_POST['Estatus'],
    //         "id_usuario"        =>$_POST['Usuario'],
    //         "generales"         =>$_POST['Generales'],
    //         "fecha_alta"        =>date('Y-m-d H:i:s'),
    //         "nombre_asistente"  =>$_POST['NombreAsistente'],
    //         "jsonAcuerdos"      =>$_POST['jsonAcuerdos'],
    //         "jsonAcuerdosEdit"      =>$_POST['jsonAcuerdosEdit'],
    //         // "acuerdo"           =>$_POST['Acuerdo'],
    //         // "fcompromiso"       =>$_POST['FCompromiso'],
    //         // "responsable"       =>$_POST['Responsable'],
    //         // "comentarios"       =>$_POST['Comentarios'],       
    //         "file"             =>$_POST['file'],
    //         "id"             =>$_POST['id_minuta'],

    //     );
    // //    print_r($datos);
    //     $respuesta=ControladorMinutas::ctrEditarMinutas($datos);
    //     // $respuesta=1;
    //     echo json_encode($respuesta);
    // }

    public function ajaxEliminarMinutas()
    {
        $datos = array(
            "id" =>$_POST['id'],
        );
//        print_r($datos);
        $respuesta=ControladorMinutas::ctrBorrarMinutas($datos);
        // $respuesta=1;
        echo json_encode($respuesta);
    }

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarMinutas")
{
    $crearminuta=new AjaxMinutas();
    $crearminuta->funcion = $_POST["funcion"];
    $crearminuta-> ajaxCrearMinutas();
}

// if (isset($_POST["funcion"]) && $_POST["funcion"]=="editarMinutas")
// {
//     $editarminuta=new AjaxMinutas();
//     $editarminuta->funcion = $_POST["funcion"];
//     $editarminuta-> ajaxEditarMinutas();
// }

if (isset($_POST["funcion"]) && $_POST["funcion"]=="eliminarMinutas")
{
    $eliminarminutas=new AjaxMinutas();
    $eliminarminutas->funcion = $_POST["funcion"];
    $eliminarminutas-> ajaxEliminarMinutas();
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="BuscarAcuerdosMinutasPasadas")
{
    $buscarminutas=new AjaxMinutas();
    $buscarminutas->funcion = $_POST["funcion"];
    $buscarminutas-> ajaxBuscarAcuerdosMinutasPasadas();
}


