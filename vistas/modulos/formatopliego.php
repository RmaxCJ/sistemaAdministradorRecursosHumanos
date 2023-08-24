<?php
 require_once "../../modelos/pliegos.modelo.php";
   $id = $_GET['id'];
require('../plugins/fpdf/fpdf.php');
$datosPliego=ModeloPliegos::mdlDatosPliegoById($id);
$peticionesPliego=ModeloPliegos::mdlPeticionesByIdPliego($id);
//echo "<pre>";
////print_r($datosPliego);
////print_r($datosPliego[0]->sindicato);
//print_r($peticionesPliego);
//echo count($peticionesPliego);
//echo "</pre>";
// exit();

class PDF extends FPDF
{
     
// Cabecera de página
// public function Header($res)
// {

    // foreach($res as $key => $value)
    // {    
    //    $idminuta = $value->idm; 
    //    $tema = $value->tema; 
    //    $id_usuario = $value->id_usuario; 
      
    // } 

     
    // // Logo
    // // $this->Image('logo.png',10,8,33);
    // // Arial bold 15
    // $this->SetFont('Arial','B',15);
    // // Movernos a la derecha
    // // $this->Cell(20);
    // // Título
    // $this->Cell(190,10,'Rotoplas',1,0,'C');
    // $this->Ln();
    // $this->SetFont('Arial','B',12);
    // $this->Cell(158,10,  'Minuta Ejecutiva'.$idminuta.' dsfsd',  1,0,'C');
    // // $this->Cell(30,20,'Logo',1,0,'C');
    // $this->Image('../plugins/fpdf/rt1.png',170,22,30);
    // $this->Ln();
    // $this->SetFont('Arial','B',8);
    // $this->Cell(60,8,'Fecha del formato:'.date("Y.m.d"),1,0,'L');
    // $this->Cell(40,8,'Pagina: '.' '.$this->PageNo(),1,0,'L');
    // $this->Cell(58,8, utf8_decode('Código Capital Humano:'),1,0,'L');
    // // Salto de línea
    // $this->Ln(12);
   
// }

public function Datosinf($datosPliego,$peticionesPliego)
{
    // Arial bold 15
//    $this->Image('../plugins/fpdf/pliego.png', 20, 20, 60);
    $this->Ln(60);
    $this->SetFont('Arial', 'B', 12);
    $this->Ln();
    $this->Cell(190, 10, utf8_decode('PLIEGO PETITORIO 2021'), 1, 0, 'C');
    $this->Ln();
    $this->Cell(95, 6, utf8_decode('Nombre del Sindicato '), 1, 0, 'L');//header de la tabla
    $this->Cell(95, 6, $datosPliego[0]->sindicato, 1, 1, 'L');
    $this->Ln();
    $this->Cell(95, 6, utf8_decode('Localidad '), 1, 0, 'L');//header de la tabla
    $this->Cell(95, 6, utf8_decode($datosPliego[0]->pais), 1, 0, 'L');
    $this->Ln();
    $this->Cell(95, 6, utf8_decode('Fecha '), 1, 0, 'L');//header de la tabla
    $this->Cell(95, 6, utf8_decode($datosPliego[0]->fecha_alta), 1, 0, 'L');
    $this->Ln(15);

    $this->SetFillColor(111,222,255); 
    $this->Cell(190,8, utf8_decode('PETICIONES'),1,0,'C');
    $this->Ln(10);
    $this->Ln();
    $this->Cell(10,6, utf8_decode('No. '),1,0,'L');//header de la tabla
    $this->Cell(180,6, utf8_decode('Petición'),1,0,'L');
    $this->Ln();
            for($i=0;$i<count($peticionesPliego);$i++)
            {
                $html.='<td width="20%">'.utf8_encode($peticionesPliego[$i]->peticion).'</td>';

            }
    
    // Salto de línea
    $this->Ln(30);
    $this->Cell(190,6, utf8_decode('Atentamente'),0,0,'C');
    $this->Ln(30);
    
    $this->Cell(190,6, utf8_decode('_______________________________'),0,0,'C');
    $this->Ln();
    
    $this->Cell(190,6, utf8_decode('Nombre Representante Sindical'),0,0,'C');
    $this->Ln(30);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
}
}

// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
// $pdf->Header($res);
// $pdf->Datosinf($res);
$pdf->Datosinf($datosPliego,$peticionesPliego);



$pdf->Output();
?>