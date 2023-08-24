<?php
//echo "formato CCT";
$id = $_GET['id'];
require_once "../../controladores/negociaciones.controlador.php";
require_once "../../modelos/negociaciones.modelo.php";
$contenido=ControladorNegociaciones::ctrContenidoCCT($id);
$html=$contenido[0]->contenido;


include("/var/www/html/mpdf60/mpdf.php");

$mpdf = new mPDF();

$stylesheet = file_get_contents('../../vistas/dist/css/estilo_pdf.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text

//$mpdf->SetHTMLFooter($footer);
//$mpdf->Image('../archivos/logos/'.$logo, 0, 0, 210, 297, 'jpg', '', true, false);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;