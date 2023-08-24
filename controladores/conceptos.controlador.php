<?php

class ControladorConceptos
{


    static public function ctrAgregarMedioDefensa($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {

            $respuesta  = ModeloConceptos::mdlAgregarMedioDefensa($datos);
            return $respuesta;

        }// isset
    }
    static public function ctrAgregarEstatus($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {

            $respuesta  = ModeloConceptos::mdlAgregarEstatus($datos);
            return $respuesta;

        }// isset
    }
    static public function ctrAgregarArea($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {

            $respuesta  = ModeloConceptos::mdlAgregarArea($datos);
            return $respuesta;

        }// isset
    }
    static public function ctrAgregarResultado($datos)
    {
//			echo "ctr";
//			print_r($datos);
//			exit();
        if(isset($datos))
        {

            $respuesta  = ModeloConceptos::mdlAgregarResultado($datos);
            return $respuesta;

        }// isset
    }



    static public function  ctrMostrarDefensas()
    {
        $respuesta=ModeloConceptos::mdlMostrarDefensas();
        return $respuesta;

    }
    static public function  ctrMostrarEstatus()
    {
        $respuesta=ModeloConceptos::mdlMostrarEstatus();
        return $respuesta;

    }
    static public function  ctrMostrarAreas()
    {
        $respuesta=ModeloConceptos::mdlMostrarAreas();
        return $respuesta;

    }
    static public function  ctrMostrarResultados()
    {
        $respuesta=ModeloConceptos::mdlMostrarResultados();
        return $respuesta;

    }
    static public function  ctrEliminarDefensa($post)
    {
//        print_r($post);
//        exit();
        $respuesta=ModeloConceptos::mdlEliminarDefensa($post);
        return $respuesta;

    }
    static public function  ctrEliminarEstatus($post)
    {
//        print_r($post);
//        exit();
        $respuesta=ModeloConceptos::mdlEliminarEstatus($post);
        return $respuesta;

    }
    static public function  ctrEliminarArea($post)
    {
//        print_r($post);
//        exit();
        $respuesta=ModeloConceptos::mdlEliminarArea($post);
        return $respuesta;

    }
    static public function  ctrEliminarResultado($post)
    {
//        print_r($post);
//        exit();
        $respuesta=ModeloConceptos::mdlEliminarResultado($post);
        return $respuesta;

    }





}