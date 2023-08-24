<?php
require_once "../modelos/valuaciones.modelo.php";
require_once "../controladores/valuaciones.controlador.php";

class AjaxValuaciones
{
    public function ajaxsubirValuacion()
    {
        $respuesta=ControladorValuaciones::ctrsubirValuaciones($_POST,$_FILES);
        echo json_encode($respuesta);
    }

    public function ajaxBuscarDivisionPersonal()
    {
        $datos = array(
            "cod_division" =>$_POST['cod_division'],            
        );
        //    print_r($datos);
        $respuesta=ControladorValuaciones::ctrBuscarDivisionPersonal($datos);
        echo json_encode($respuesta);
    }
    
    public function ajaxBuscarDatos()
    {
        $datos = array(
            "cod_division" =>$_POST['cod_division'],   
            "subdivision"  =>$_POST['subdivision'],   
            "anio"         =>$_POST['anio'],            
        );
        //    print_r($datos);
        $respuesta=ControladorValuaciones::ctrBuscarDatos($datos);
        echo json_encode($respuesta);
    }
    public function ajaxAgregarValuacion()
    {
        $datos = array(
            "cod_division"                    =>$_POST['cod_division'],   
            "subdivision"                     =>$_POST['subdivision'],   
            "anio"                            =>$_POST['anio'],   
            "prop_neg"                        =>$_POST['prop_neg'],   
            "prest_fijas_agui_sal_fijo"       =>$_POST['prest_fijas_agui_sal_fijo'],            
            "prest_fijas_prima_vac_sal_fijo"  =>$_POST['prest_fijas_prima_vac_sal_fijo'],   
            "prest_fijas_fond_ahorro_sal_fijo"=>$_POST['prest_fijas_fond_ahorro_sal_fijo'],   
            "prest_var_bono_prod"              =>$_POST['prest_var_bono_prod'],   
            "otros_gastos_rev_cct"            =>$_POST['otros_gastos_rev_cct'],   
            "otros_gastos_iguala_sind"        =>$_POST['otros_gastos_iguala_sind'],   
            "otros_gastos_fom_dep_bolsas"     =>$_POST['otros_gastos_fom_dep_bolsas'], 
            "arrayBeneficios"                 =>$_POST['arrayBeneficios'],   
            "fecha_alta"                      =>date('Y-m-d H:i:s'),
        );
        //    print_r($datos);
        $respuesta=ControladorValuaciones::ctrAgregarValuacion($datos);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["funcion"]) && $_POST["funcion"]=="subirValuacion")
{
    $funcion=new AjaxValuaciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxsubirValuacion();

}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="BuscarDivisionPersonal")
{
    $funcion=new AjaxValuaciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxBuscarDivisionPersonal();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="BuscarDatos")
{
    $funcion=new AjaxValuaciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxBuscarDatos();
}
if (isset($_POST["funcion"]) && $_POST["funcion"]=="agregarValuacion")
{
    $funcion=new AjaxValuaciones();
    $funcion->funcion = $_POST["funcion"];
    $funcion-> ajaxAgregarValuacion();
}
