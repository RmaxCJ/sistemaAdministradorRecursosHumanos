<?php

class ControladorIdioma
{

    static public function mdlTextosIdioma($lang)
    {
        $tabla="Textos";
//            echo $tabla;
//            echo $item;
//            echo $valor;
        $respuesta = ModeloIdioma::mdlTextosIdioma($tabla,$lang);
        return $respuesta;
    }


}