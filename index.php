<?php
//require_once "vendor/autoload.php";

    //------------------------------------------------------------------ controladores
    require_once "controladores/usuarios.controlador.php";
    require_once "controladores/sindicatos.controlador.php";
    require_once "controladores/plantilla.controlador.php";
    require_once "controladores/divisiones.controlador.php";
    require_once "controladores/minutas.controlador.php";
    require_once "controladores/pliegos.controlador.php";
    require_once "controladores/proveedores.controlador.php";
    require_once "controladores/ordenes.controlador.php";
    require_once "controladores/recibos.controlador.php";
    require_once "controladores/pagos.controlador.php";
    require_once "controladores/cct.controlador.php";
    require_once "controladores/negociaciones.controlador.php";
    require_once "controladores/valuaciones.controlador.php";
    require_once "controladores/demandas.controlador.php";
    require_once "controladores/revisiones.controlador.php";
    require_once "controladores/conceptos.controlador.php";
    require_once "controladores/multas.controlador.php";
    require_once "controladores/rit.controlador.php";
    require_once "controladores/comisiones.controlador.php";
    require_once "controladores/consecuencias.controlador.php";
    require_once "controladores/excel.controlador.php";
    require_once "controladores/informacionlaboral.controlador.php";
    require_once "controladores/idioma.controlador.php";

    //---------------------------------------------------------------- modelos
    require_once "modelos/usuarios.modelo.php";
    require_once "modelos/sindicatos.modelo.php";
    require_once "modelos/divisiones.modelo.php";
    require_once "modelos/minutas.modelo.php";
    require_once "modelos/pliegos.modelo.php";
    require_once "modelos/proveedores.modelo.php";
    require_once "modelos/ordenes.modelo.php";
    require_once "modelos/recibos.modelo.php";
    require_once "modelos/pagos.modelo.php";
    require_once "modelos/tablasDEV.modelo.php";
    require_once "modelos/cct.modelo.php";
    require_once "modelos/negociaciones.modelo.php";
    require_once "modelos/valuaciones.modelo.php";
    require_once "modelos/demandas.modelo.php";
    require_once "modelos/revisiones.modelo.php";
    require_once "modelos/conceptos.modelo.php";
    require_once "modelos/multas.modelo.php";
    require_once "modelos/rit.modelo.php";
    require_once "modelos/comisiones.modelo.php";
    require_once "modelos/consecuencias.modelo.php";
    require_once "modelos/excel.modelo.php";
    require_once "modelos/informacionlaboral.modelo.php";
    require_once "modelos/idioma.modelo.php";




//    require_once "modelos/cct.modelo.php";

    // require_once "modelos/alumnosgrupos.modelo.php";

    //------------------------------------------------------------------ AJAX
//    require_once "ajax/usuarios.ajax.php";


    $plantilla = new ControladorPlantilla();
	$plantilla -> ctrPlantilla();
