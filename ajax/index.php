<?php

    //------------------------------------------------------------------ controladores
    require_once "controladores/usuarios.controlador.php";
    require_once "controladores/sindicatos.controlador.php";
    require_once "controladores/plantilla.controlador.php";
    require_once "controladores/divisiones.controlador.php";
    require_once "controladores/minutas.controlador.php";

    //---------------------------------------------------------------- modelos
    require_once "modelos/usuarios.modelo.php";
    require_once "modelos/sindicatos.modelo.php";
    require_once "modelos/divisiones.modelo.php";
    require_once "modelos/minutas.modelo.php";
    
    // require_once "modelos/alumnosgrupos.modelo.php";

    //------------------------------------------------------------------ AJAX
//    require_once "ajax/usuarios.ajax.php";


    $plantilla = new ControladorPlantilla();
	$plantilla -> ctrPlantilla();
