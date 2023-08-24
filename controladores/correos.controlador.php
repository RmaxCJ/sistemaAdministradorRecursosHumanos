<?php
//require_once "PHPMailer/correos.php";

 require_once "PHPMailer_1/correos.php";

class ControladorCorreos
{

    static public function ctrEnviarCorreo($datos)
    {
        // echo 'hola en correos.controlador.php'.$datos['nombre'];
        // $this->correos = new Correos;
        // $correo = $rsc->correo;
        $correo = 'max.nunez@swyti.com.mx';

        // manda correo
        $cuerpo = "<font face='Lucida Sans Unicode, Helvetica, sans-serif' pointsize='9px'>";
        $cuerpo = $cuerpo."<b>Envio de correo .<br><br>Los detalles en el siguiente link <a href='http://zbb.rotoplas.com/relaciones'>Relaciones</a>.<br><br><br><br>Muchas gracias.</p>";
        $cuerpo = $cuerpo.'</font>';

        $asunto = "Prueba de envio de correo";
        // $this->correos->envia_correo($cuerpo,$asunto,trim($correo));
        $respuesta=Correos::envia_correo($cuerpo,$asunto,trim($correo));

        return $respuesta;
    }
    static  public function ctrEnviarCorreoSubeOrden()
    {

    }

    static  public function ctrEnviarCorreoSubeRecibo()
    {

    }

    static  public function ctrEnviarCorreoValidacion()
    {

    }

    static  public function ctrEnviarCorreoRecepcion()
    {
// echo 'hola en correos.controlador.php'.$datos['nombre'];
        // $this->correos = new Correos;
        // $correo = $rsc->correo;
        $correo = 'max.nunez@swyti.com.mx';

        // manda correo
        $cuerpo = "<font face='Lucida Sans Unicode, Helvetica, sans-serif' pointsize='9px'>";
        $cuerpo = $cuerpo."<b>Envio de correo .<br><br>Los detalles en el siguiente link <a href='http://zbb.rotoplas.com/relaciones'>Relaciones</a>.<br><br><br><br>Muchas gracias.</p>";
        $cuerpo = $cuerpo.'</font>';

        $asunto = "Prueba de envio de correo";
        // $this->correos->envia_correo($cuerpo,$asunto,trim($correo));
        $respuesta=Correos::envia_correo($cuerpo,$asunto,trim($correo));

        return $respuesta;
    }
    static  public function ctrEnviarCorreoRegistro()
    {

    }
    static  public function ctrEnviarCorreoSubeComprobante()
    {

    }
}



?>