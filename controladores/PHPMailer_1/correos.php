<?php
// require_once ("class.phpmailer.php");
// use PHPMailer\PHPMailer\PHPMailer;
//
require_once "PHPMailerAutoload.php";
//require_once "class.PHPMailerAutoload.php";
require_once "class.smtp.php";
//require_once "class.phpmailer.php";
require_once "class.PHPMailer.php";

// require_once "../PHPMailer/src/PHPMailer.php";
// require_once "../../../reclutamiento/includes/class.phpmailer.php";
Class Correos
{
	/*estrucura*/
	private $cuerpo;
	private $cuerpohtmlinicio;
	private $cuerpohtmlfinal;
	
	function envia_correo($cuerpoOri,$asunto,$correo)
	{
		// try{
            // echo $cuerpoOri;
            // echo $asunto;
            // echo $correo;
            // echo "hola en envia coreo.php";
			 $titulo = "Rotoplas: Portal Relaciones";
			
			// $imagen = "<!--img src='http://zbb.rotoplas.com/relaciones/vistas/img/logoRotoplas.png'-->";
					
            // $cuerpohtmlinicio = "<html><head><title>".$titulo."</title>".$imagen."</head><body>";
            $cuerpohtmlinicio = "<html><head><title>".$titulo."</title></head><body>";
			$cuerpohtmlfinal = "</body></html>";
			// print_r($cuerpoOri.$asunto.$correo);
			
			$cuerpo = $cuerpohtmlinicio."<table width='100%' align='left'><tr><td><br/><br/>";
			$cuerpo = $cuerpo.$cuerpoOri;
			$cuerpo = $cuerpo."Atentamente, <br/><strong>Capital Humano</strong></font></td></tr></table><br/><br/><br/><hr>";
			$cuerpo = $cuerpo.$cuerpohtmlfinal;
			
			//echo $cuerpo;
			
			$from1 = 'miportal@rotoplas.com';
			$from2 = utf8_decode('Portal Reclutamiento');
									
			$mail = new PHPMailer();
						
			$mail->IsSMTP();                                      // Set mailer to use SMTP
			$mail->Host = '192.168.15.56';                 			// Specify main and backup server
			$mail->Port = 2525;                                    // Set the SMTP port
						
			$mail->AddReplyTo($from1, $from2);
			$mail->SetFrom($from1, $from2);
			$mail->Subject = utf8_decode($asunto);
										
			$mail->MsgHTML(utf8_decode($cuerpo));
			$mail->IsHTML(true); 
										
			$address = trim($correo);
			$mail->AddAddress($address);
			
			//$mail->AddBCC('carlos@aipmx.com');
			// $mail->AddBCC('enrique.ramirez@swyti.com.mx');
			// $mail->AddBCC('rodrigo.garcia@swyti.com.mx');

			/*$mail->AddBCC('jose.r.lecuona.torras@tuck.dartmouth.edu');
			$mail->AddBCC('carlos@aipmx.com');
			$mail->AddBCC('hschroeder@rotoplas.com');*/
			
			if($mail->Send())
				$resp = 'ok';
//			else
//				$resp = "Error al enviar el mensaje: ".$mail­>ErrorInfo;
			
			$mail->ClearAddresses();
	        $mail->ClearAllRecipients();
            // $resp = 'ok';
			return $resp;

	// 	}catch (phpmailerException $e) {
	// 	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	// 	} catch (Exception $e) {
	// 	  echo $e->getMessage(); //Boring error messages from anything else!
	// 	}

	}
}
?>