<?php
require_once "../../modelos/minutas.modelo.php";
require_once "../../modelos/usuarios.modelo.php";
  $id = $_GET['id'];
require('../plugins/fpdf/fpdf.php');
$res=ModeloMinutas::ctrMostrarMinutasID("Minutas",$id);
$res2=ModeloMinutas::mdlMostrarAcuerdosMinutasID("Minutas",$id);
$res3=ModeloMinutas::mdlMostrarAsistentesMinutasID("Minutas",$id);
$resu=ModeloUsuarios::mdlMostrarUsuariosSencillo();
// print_r($res2);
// exit();

class PDF extends FPDF
{
     
// Cabecera de página
public function Header($res)
{

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
    // $this->Cell(158,10,  'Minuta Ejecutiva  '.$idminuta.'',  1,0,'C');
    // // $this->Cell(30,20,'Logo',1,0,'C');
    // $this->Image('../plugins/fpdf/rt1.png',170,22,30);
    // $this->Ln();
    // $this->SetFont('Arial','B',8);
    // $this->Cell(60,8,'Fecha del formato:'.date("Y.m.d"),1,0,'L');
    // $this->Cell(40,8,'Pagina: '.' '.$this->PageNo(),1,0,'L');
    // $this->Cell(58,8, utf8_decode('Código Capital Humano:'),1,0,'L');
    // // Salto de línea
    // $this->Ln(12);
   
}
// Array ( [0] => stdClass Object ( [idu] => 34 [id_perfil] => 3 [usuario] => mcanuto [id_sindicato] => 6 [sindicato] => SINDICATO SWYTI [nombre_corto] => S SWYTI [idm] => 20 [tema] => Tema Prueba [estatus] => A [id_usuario] => 34 [generales] => Generales [id_minuta] => 20 [nombre_asistente] => ASSTENTE Daniel [id_archivo] => 5 ) )
public function Datosinf1($res)
{
    foreach($res as $key => $value)
    {    
       $idu = $value->idu; 
       $id_perfil = $value->id_perfil; 
       $usuario = $value->usuario; 
       $id_sindicato = $value->id_sindicato; 
       $sindicato = $value->sindicato; 
       $nombre_corto = $value->nombre_corto; 
       $idm = $value->idm; 
       $tema = $value->tema; 
       $id_usuario = $value->id_usuario; 
       $usuario = $value->usuario; 
       $generales = $value->generales; 
       $horainicio = $value->horainicio; 
       $horafinal = $value->horafinal; 
       $nombre_asistente = $value->nombre_asistente; 
       $id_archivo = $value->id_archivo; 
    } 
    // Logo
    // $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    // $this->Cell(20);
    // Título
    $this->Cell(190,10,'Rotoplas',1,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',12);
    $this->Cell(158,10,  'Minuta Ejecutiva:  '.$idm.'',  1,0,'C');
    // $this->Cell(30,20,'Logo',1,0,'C');
    $this->Image('../plugins/fpdf/rt1.png',170,22,30);
    $this->Ln();
    $this->SetFont('Arial','B',8);
    $this->Cell(60,8,'Fecha del formato:'.date("Y.m.d"),1,0,'L');
    $this->Cell(40,8,'Pagina: '.' '.$this->PageNo(),1,0,'L');
    $this->Cell(58,8, utf8_decode('Código Capital Humano:'),1,0,'L');
    // Salto de línea
    $this->Ln(12);

    // exit();

    // Logo
    // $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',8);
    // Movernos a la derecha
    // $this->Cell(20);
    // Título
    $this->Cell(35,8,'Fecha:',1,0,'L');
    $this->Cell(35,8, utf8_decode('Acta número:'),1,0,'L');
    $this->Cell(25,8,'',1,0,'L');
    $this->Cell(35,8,'Hora Inicio:',1,0,'L');
    $this->Cell(60,8, substr($horainicio,0,8),1,0,'L');
    $this->Ln();
    $this->SetFont('Arial','B',8);
    $this->Cell(35,8,'',1,0,'L');
    $this->Cell(35,8, utf8_decode('Versión Acta'),1,0,'L');
    $this->Cell(25,8,'',1,0,'L');
    $this->Cell(35,8,utf8_decode('Hora Finalización:'),1,0,'L');
    $this->Cell(60,8, substr($horafinal,0,8),1,0,'L');
    $this->Ln();
    $this->SetFont('Arial','B',8);
    $this->Cell(35,8,'Cordinador',1,0,'L');
    // foreach($resu as $key => $valueu)
    // {    
    //      $id = $valueu->id;
    //      $usuario = $valueu->usuario;
    //      $id_nombre_usuario="";

    //      if($id==$id_usuario){
    //         $this->Cell(35,8, utf8_decode($id_usuario),1,0,'L');
    //      }
    //      $this->Cell(35,8, utf8_decode('nombree'),1,0,'L');
        
    // } 
    $this->Cell(35,8, utf8_decode($usuario),1,0,'L');
    $this->Cell(25,8,'Lugar',1,0,'L');
    $this->Cell(35,8,utf8_decode(''),1,0,'L');
    $this->Cell(60,8,'',1,0,'L');
    $this->Ln();
    $this->SetFont('Arial','B',8);
    $this->Cell(35,8,'Tema:',1,0,'L');
    $this->Cell(155,8, utf8_decode($tema),1,0,'L');
    $this->Ln();
    $this->Cell(190,8, utf8_decode(''),1,0,'L');
}
public function Datosinf3($res3)
{
    $this->Ln();
    $this->Cell(190,8, utf8_decode('Asistentes'),1,0,'C');
    $this->Ln();
    $this->Cell(48,6, utf8_decode('nombre'),1,0,'C');//header de la tabla
    $this->Cell(48,6, utf8_decode('Correo'),1,0,'C');
    $this->Cell(47,6, utf8_decode('Asistió'),1,0,'C');
    $this->Cell(47,6, utf8_decode('Excusa'),1,0,'C');
    $this->Ln();
    foreach($res3 as $key => $value3)
    {    
       $id = $value3->id;
       $count+=1;  
       $nombre_asistente = $value3->nombre_asistente; 
       $nombre_asistentesr = $value3->nombre_asistentesr;
       $nombreA='';
       if( $nombre_asistente!='NA'){
        $this->Cell(48,6, $count.'.- '.$nombre_asistente,1,0,'L');
       }else {
        $this->Cell(48,6, $count.'.- '.$nombre_asistentesr,1,0,'L');
       }
       
       $this->Cell(48,6, utf8_decode(''),1,0,'C');
       $this->Cell(47,6, utf8_decode(''),1,0,'C');
       $this->Cell(47,6, utf8_decode(''),1,0,'C');
       $this->Ln();
    }
    for($i=1;$i<5;$i++){
        $this->Cell(48,6, ' ',1,0,'C');
        $this->Cell(48,6, utf8_decode(''),1,0,'C');
        $this->Cell(47,6, utf8_decode(''),1,0,'C');
        $this->Cell(47,6, utf8_decode(''),1,0,'C');
        $this->Ln();
    } 
    $this->Cell(190,8, utf8_decode('TEMAS'),1,0,'C');
    $this->Ln();
    $this->Cell(190,20, utf8_decode('Agenda.-'),1,0,'L');
    
    $this->Ln();
    $this->Cell(190,8, utf8_decode('SEGUIMIENTO A COMPROMISOS REUNIÓN ANTERIOR'),1,0,'C');
    $this->Ln();
    $this->Cell(10,6, utf8_decode('No.'),1,0,'C'); 
    $this->Cell(44,6, utf8_decode('Compromiso'),1,0,'C');
    $this->Cell(44,6, utf8_decode('Responsables'),1,0,'C');
    $this->Cell(44,6, utf8_decode('Fecha en que se debía realizar'),1,0,'C');
    $this->Cell(48,6, utf8_decode('Seguimiento (Fecha: comentario)'),1,0,'C');
    $this->Ln();
    for($i=1;$i<16;$i++){
        $this->Cell(10,6, $i.'.-',1,0,'C'); 
        $this->Cell(44,6, utf8_decode(''),1,0,'L');
        $this->Cell(44,6, utf8_decode(''),1,0,'C');
        $this->Cell(44,6, utf8_decode(''),1,0,'C');
        $this->Cell(48,6, utf8_decode(''),1,0,'C');
        $this->Ln();
    }

}
// Array ( [0] => stdClass Object ( [id] => 18 [id_minuta] => 20 [acuerdo] => acuerdo 1 [fecha_compromiso] => 2020-12-18 [responsable] => Responsable 1 [comentarios] => comentario 1 ) [1] => stdClass Object ( [id] => 19 [id_minuta] => 20 [acuerdo] => acuerdo 2 [fecha_compromiso] => 2020-12-04 [responsable] => responsable 2 [comentarios] => comentarios 2 ) )
public function Datosinf2($res2)
{    


   
    $this->Ln(5);
    $this->Cell(190,8, utf8_decode('NUEVOS COMPROMISOS'),1,0,'C');
    $this->Ln();
    $this->Cell(10,6, utf8_decode('No.'),1,0,'C'); 
    $this->Cell(44,6, utf8_decode('Compromiso'),1,0,'C');
    $this->Cell(76,6, utf8_decode('Responsables'),1,0,'C');
     // $this->MultiCell(60,5,'fdvnskjdfbvskjldfnvlskjdfnvlfskjbfvsdfvsdfvsdfvsdfvkhfbvkfk');
    $this->Cell(60,6, utf8_decode('Fecha en que se debe realizar(dd/mm/aaaa)'),1,0,'C');
    $this->Ln();
    foreach($res2 as $key => $value)
    {    
       $id = $value->id; 
       $id_minuta = $value->id_minuta; 
       $acuerdo = $value->acuerdo; 
       $fecha_compromiso = $value->fecha_compromiso; 
       $responsable = $value->responsable; 
       $comentarios = $value->comentarios;
       $count+=1; 
       $this->Cell(10,6, $count.'.-',1,0,'C'); 
       $this->Cell(44,6, utf8_decode($acuerdo),1,0,'L');
       $this->Cell(76,6, utf8_decode($responsable),1,0,'C');
       $this->Cell(60,6, utf8_decode($fecha_compromiso),1,0,'C');
       $this->Ln();
    } 

    //     for($i=1;$i<16;$i++){
    //     $this->Cell(10,6, $i.'.-',1,0,'C'); 
    //     $this->Cell(44,6, utf8_decode(''),1,0,'L');
    //     $this->Cell(76,6, utf8_decode(''),1,0,'C');
    //     $this->Cell(60,6, utf8_decode(''),1,0,'C');
    //     $this->Ln();
    // }
    $this->SetFont('Arial','B',8);
    // $this->SetFillColor(2,157,116);//Fondo verde de celda 
    $this->Cell(85,15,'Redactado por:',1,0,'L');
    $this->Cell(105,15, utf8_decode('Fecha de elaboración de minuta:'),1,0,'L');
    $this->Ln();
    $this->Cell(105,8, utf8_decode('Firmas:'),0,0,'L');
    $this->Ln();
    $this->Cell(80,10,'  ________________________________________________',0,0,'C');
    $this->Cell(20,10,' ',0,0,'C');
    $this->Cell(80,10,'________________________________________________',0,0,'C');
    $this->Ln();
    $this->Cell(80,10,'  ________________________________________________',0,0,'C');
    $this->Cell(20,10,' ',0,0,'C');
    $this->Cell(80,10,'________________________________________________',0,0,'C');
    $this->Ln();
    $this->Cell(80,10,'  ________________________________________________',0,0,'C');
    $this->Cell(20,10,' ',0,0,'C');
    $this->Cell(80,10,'________________________________________________',0,0,'C');

    
    
    // Salto de línea
    $this->Ln(15);
}

// // Tabla simple
// function BasicTable($header)
// {
//     // Cabecera
//     foreach($header as $col)
//         $this->Cell(40,7,$col,1);
//     $this->Ln();
//     // Datos
//     // foreach($data as $row)
//     // {
//     //     foreach($row as $col)
//     //         $this->Cell(40,6,$col,1);
//     //     $this->Ln();
//     // }
// }


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
$pdf->Datosinf1($res);
$pdf->Datosinf3($res3);
$pdf->Datosinf2($res2);

$pdf->Output();
?>