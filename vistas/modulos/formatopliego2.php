<?php

require_once "../../modelos/pliegos.modelo.php";
require_once "../../modelos/sindicatos.modelo.php";
$id = $_GET['id'];
require('../plugins/fpdf/fpdf.php');
$datosPliego=ModeloPliegos::mdlDatosPliegoById($id);
$peticionesPliego=ModeloPliegos::mdlPeticionesByIdPliego($id);
require_once "../../modelos/minutas.modelo.php";
require_once "../../modelos/usuarios.modelo.php";


  $sindicato=$datosPliego[0]->sindicato;
  $pais=$datosPliego[0]->pais;
  $fecha_alta=$datosPliego[0]->fecha_alta;
  $idSindicato=$datosPliego[0]->id_sindicato;
$logo=$datosPliego[0]->logo;
$division=$datosPliego[0]->division;
$path = getcwd();
//echo $path;
//echo "<pre>";
//print_r($datosPliego);
//echo "</pre>";
//exit();



$respuesta=ModeloSindicatos::mdlMostrarResponsableSindicato($idSindicato);
//echo "<pre>";
//print_r($respuesta);
//print_r(utf8_encode($respuesta[0]->nombre_usuario));
//echo "</pre>";
//exit();
$nombreResponsable=utf8_encode($respuesta[0]->nombre_usuario);


$fecha_hoy = date('Y-m-d');
$html = '<html><body>';
//$html.='<img src="/var/www/html/relaciones/vistas/archivos/logos/'.$logo.'" >';
$html.='<img src="../archivos/logos/'.$logo.'" >';
$html .='<br><br><table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr><td colspan="4" style="text-align: center;"><h2>PLIEGO PETITORIO 2021<h2></td></tr>
            <tr>
            <td width="20%">Sindicato</td>
            <td><p>'.utf8_encode($sindicato).'</p></td>
            </tr>  
        </table> 
        <br><br><br>';
$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <td width="50%"><p>Localidad: </p></td>
                <td><p>'.utf8_encode($division).'</p></td>
            </tr>
            <tr>
                <td><p>Fecha: </p></td>
                <td><p>&nbsp;'.$fecha_alta.'</p></td>
            </tr>
            </thead>
            </table>';
            
$html.='<br><br><br><table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <td  style="text-align: center;"><h2>PETICIONES </h2></td>
            </tr>
';
for($i=0;$i<count($peticionesPliego);$i++)
{
    $html.='<tr><td>'.utf8_encode($peticionesPliego[$i]->peticion).'</td></tr>';

}
$html.='</table>';


$html .='<br><br><br><br><br><br><label>Atentamente:</label><br><br><br>';
$html .='<p width="100%" border="" cellspacing="0" cellpadding="0"> 
         <p>__________________________________________</p>
         <p>'.$nombreResponsable.'</p>
        </p>
        
        <br><br>';

$footer = '</body></html>';
include("../../../mpdf60/mpdf.php");

$mpdf = new mPDF();

$stylesheet = file_get_contents('../../vistas/dist/css/estilo_pdf.css');
$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->SetHTMLFooter($footer);
//$mpdf->Image('../archivos/logos/'.$logo, 0, 0, 210, 297, 'jpg', '', true, false);

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;


?>