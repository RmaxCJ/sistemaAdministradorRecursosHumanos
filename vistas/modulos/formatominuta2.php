<?php
require_once "../../modelos/minutas.modelo.php";
require_once "../../modelos/usuarios.modelo.php";
// require_once "../../controladores/usuarios.controlador.php";
  $id = $_GET['id'];
$res=ModeloMinutas::ctrMostrarMinutasID("Minutas",$id);
$res2=ModeloMinutas::mdlMostrarAcuerdosMinutasID("Minutas",$id);
$res3=ModeloMinutas::mdlMostrarAsistentesMinutasID("Minutas",$id);
$resu=ModeloUsuarios::mdlMostrarUsuariosSencillo('Usuarios');
$resul=ModeloUsuarios::mdlMostrarUsuariosSencillo('Usuarios'); 
$resu2=ModeloUsuarios::mdlMostrarUsuariosSencillo('Usuarios'); 


foreach($res as $key => $value)//minutas
{    
   $idu              = $value->idu; 
   $id_perfil        = $value->id_perfil; 
   $usuario          = $value->usuario; 
   $id_sindicato     = $value->id_sindicato; 
   $sindicato        = $value->sindicato; 
   $nombre_corto     = $value->nombre_corto; 
   $idm              = $value->idm; 
   $tema                   = $value->tema; 
   $id_usuario             = $value->id_usuario; 
   $usuario                = $value->usuario; 
   $generales              = $value->generales; 
   $id_usuario_responsable = $value->id_usuario_responsable; 
   $usuario_responsable    = $value->usuario_responsable; 
   $lugar                  = $value->lugar; 
   $horainicio             = $value->horainicio; 
   $horafinal              = $value->horafinal; 
   $nombre_asistente       = $value->nombre_asistente; 
   $id_archivo             = $value->id_archivo;
   $fecha_alta             =$value->fecha_alta; 
} 
      $fecha_hoy = date('Y-m-d');
      $html .= '<html><body>';
      
$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr><td colspan="4" style="text-align: center;"><h2>Rotoplas<h2></td></tr>
            <tr>
            <td colspan="3" style="text-align: center;">Minuta Ejecutiva</td>
            <td rowspan="2" style="text-align: center;"><br><img src="../plugins/fpdf/rt1.png" width="25%">&nbsp;</td>
            </tr>
            <thead>
            <tr>
            <td width="20%"><p>Fecha del formato: <br></p></td>
            <td width="20%"><p>'.$fecha_alta.'</p></td>
            <td width="25%"><p>Código Capital Humano</p></td>
            </tr>
            </thead>     
        </table> 
        <br>';
$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <td width="20%"><p>Fecha: '.$fecha_hoy.'</p></td>
                <td width="20%"><p>Hora Inicio</p></td>
                <td width="20%"><p>&nbsp;'.substr($horainicio,0,8).'</p></td>
                <td><p>Hora Finalización: </p></td>
                <td><p>&nbsp;'.substr($horafinal,0,8).'</p></td>
            </tr>
            </thead>

            <tr>
            
            <td width="15%"><p>Responsable</p></td>';
            foreach ($resu as $key => $valUs) {
                // $id_usuario=$value->id_usuario_responsable;//---->de la tabla de minuta
                $idusu = $valUs->id;
                $idperfil = $valU->id_perfil;
                $nombre_usuario = $valUs->nombre_usuario;
                $num_empleado = $valUs->num_empleado;

                if($idusu==$id_usuario_responsable){
                    if ($nombre_usuario != null) {
                        $html.='<td width="20%">'.utf8_encode($nombre_usuario).'</td>';
                    } 
                    else 
                    {
                        $empleadosData = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoM('Empleados', $num_empleado);
                        foreach ($empleadosData as $key => $valE)
                            {
                                $nombre=$valE->nombre;
                                $html.='<td width="20%">'.utf8_encode($nombre).'</td>';
                            }
                    }
                }                   
            }

            // if($value->id_usuario_responsable!=0){
            //   foreach ($resu as $key => $valU)//
            //   {
            //     $idusuario=$valU->id;
            //     $id_usuario=$value->id_usuario_responsable;
            //     if($idusuario==$id_usuario){
            //       if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') {
            //           // echo utf8_encode($valU->nombre_usuario);
            //           $html.='<td width="25%"><p>'.utf8_encode($valU->nombre_usuario).'</p></td>';
            //           }
            //           else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
            //               $empleadosData = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoM('Empleados',$valU->num_empleado);
            //               foreach ($empleadosData as $key => $valE)
            //                   {
            //                       $nombre=$valE->nombre;
            //                           // echo utf8_encode($nombre);
            //                           $html.='<td width="25%"><p>'.utf8_encode($nombre).'</p></td>';
            //                   }
            //           }
            //     }
            //   }
            // }else{
            //         $html.= '<td width="25%"><p>'.utf8_encode($value->usuario_responsable).'</p></td>';
            // }
            // if($value->id_usuario_responsable!=0){
            //   $empleadosData = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoPaisbyId($value->id_usuario_responsable);
            //   foreach ($empleadosData as $key => $valEm)
            //   {
  
            //       // echo  $html.='<td width="25%"><p>'.utf8_encode($nombre=$valE->nombre).'</p></td>';
            //       $html.='<td width="25%"><p>'.utf8_encode($nombre=$valEm->nombre).'</p></td>';
            //   }
            // }else{
            //       echo  $html.='<td width="25%"><p>'.utf8_encode($value->usuario_responsable).'</p></td>';
            // }
    $html.='<td width="20%"><p>Lugar</p></td>
            <td width="20%" ><p>'.$lugar.'</p></td>
            <td width="20%"><p></p></td>
            
            </tr>     
            <tr>
            <td><p>Tema</p></td>
            <td colspan="4"><p>'.$tema.'</p></td>
            </tr> 
            <tr>
            <td colspan="5" width="25%"><p>&nbsp;</p></td>
            </tr>     
        </table>
        <br>';
$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
            <td colspan="4" style="text-align: center;"><p>Asistentes</p></td>
            </tr>
            <thead>
                <tr>
                <td width="100%" class="center"><b>Nombre</b></td>
                <!--td width="50%" class="center"><b>Correo</b></td-->
                <!--td width="25%" class="center"><b>Asistió</b></td-->
                <!--td width="25%" class="center"><b>Excusa</b></td-->
                </tr>
            </thead>';
foreach($res3 as $key => $value3)//asistentes minuta 
{    
   $id = $value3->id;
   $count+=1;  
   $nombre_asistente = $value3->nombre_asistente; 
   $nombre_asistentesr = $value3->nombre_asistentesr;
   $nombreA='';
   if( $nombre_asistente!='NA'){
    $html .= '<tr>
      <td><p>'.$count.'.- '.$nombre_asistente.'</p></td> 
      <!--td><p>'.$correo.'</p></td-->
      <!--td><p>&nbsp;</p></td-->
      <!--td><p>&nbsp;</p></td-->
      </tr>';
   }else {
    $html .= '<tr>
    <td><p>'.$count.'.- '.$nombre_asistentesr.'</p></td> 
    <!--td><p>&nbsp;</p></td-->
    <!--td><p>&nbsp;</p></td-->
    <!--td><p>&nbsp;</p></td-->
    </tr>';
   }
}
for($i=1;$i<5;$i++){

} 
      $html.='
      <tr>
      <td colspan="4" class="center"><p>temas</p></td>
      </tr> 
      <tr>
      <td colspan="4"><ul>';
      $temas = ModeloMinutas::ctrMostrarTemasMinutasID('TemasMinuta',$idm);
      foreach ($temas as $key => $valT)
          {
                  $html.='<p><li>'. utf8_encode($valT->tema).'</li><br></p>';
          }
$html.='</ul></td>
      </tr>     
      </table>
      <br>';

$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
            <td colspan="6" style="text-align: center;"><label>SEGUIMIENTO A COMPROMISOS REUNIÓN ANTERIOR</label></td>
            </tr>
            <thead>
                <tr>
                <td class="center" width="4%"><b>No</b></td>
                <td class="center" width="20%"><b>Comprommiso</b></td>
                <td class="center" width="20%"><b>Responsable</b></td>
                <td class="center" width="16%"><b>Fecha en que se debio realizar</b></td>
                <td class="center" width="20%"><b>Comentario</b></td>
                <td class="center" width="20%"><b>Estatus</b></td>
                </tr>
            </thead>';
            $buscarminutaanterior=ModeloMinutas::mdlBuscarAcuerdosMinutasAnterior($id_sindicato);
            foreach($buscarminutaanterior as $key => $value6)//acuerdos minutas pasadas
            {  

               $id              = $value6->id; 
               $id_minutabuscar = $value6->id_minuta;         
            } 
            // $html.='<td>'.$id_minuta.'</td>';
            $res4=ModeloMinutas::mdlMostrarAcuerdosMinutasPasadasS($id_sindicato,$id_minutabuscar);
            foreach($res4 as $key => $value4)//acuerdos minutas pasadas
            {    
               $id               = $value4->id; 
               $id_minuta        = $value4->id_minuta; 
               $acuerdo          = $value4->acuerdo; 
               $fecha_compromiso = $value4->fecha_compromiso; 
               $responsable      = $value4->responsable;
               $resp = explode("-", $responsable);
               $re = $resp[1]; 
               $comentarios      = $value4->comentarios;
               $estatus          = $value4->estatus;
               $countAP+=1; 
               $html.='<tr>
                        <td class="center"><p>'.$countAP.'</p></td>
                        <td><p>'.$acuerdo.'</p></td>
                        <td><p>'.$responsable.'</p></td>
                        <td><p>'.$fecha_compromiso.'</p></td>
                        <td><p>'.$comentarios.'</p></td>
                        <td><p>'.$estatus.'</p></td>
                      </tr>';        
            } 
    $html.='</table>';

            $html.='<br>     
            <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
            <td colspan="5" style="text-align: center;"><label>NUEVOS COMPROMISOS</label></td>
            </tr>
            <thead>
                <tr>
                <td class="center" width="4%"><b>No</b></td>
                <td class="center" width="24%"><b>Compromiso</b></td>
                <td class="center" width="24%"><b>Responsable</b></td>
                <td class="center" width="24%"><b>Fecha en que se debio realizar</b></td>
                <td class="center" width="24%"><b>Seguimiento comentario</b></td>
                </tr>
            </thead>';
            foreach($res2 as $key => $value2)//acuerdos minutas
            {    
               $id               = $value2->id; 
               $id_minuta        = $value2->id_minuta; 
               $acuerdo          = $value2->acuerdo; 
               $fecha_compromiso = $value2->fecha_compromiso; 
               $responsable      = $value2->responsable;
               $resp = explode("-", $responsable);
               $re = $resp[1];  
               $comentarios      = $value2->comentarios;
               $countA+=1; 
               $html.='<tr>
                        <td class="center"><p>&nbsp;'.$countA.'</p></td>
                        <td><p>&nbsp;'.$acuerdo.'</p></td>
                        <td><p>&nbsp;'.$responsable.'</p></td>
                        <td><p>&nbsp;'.$fecha_compromiso.'</p></td>
                        <td><p>&nbsp;'.$comentarios.'</p></td>
                      </tr>';        
            } 

    $html.='<tr>
            <td><p>&nbsp;</p></td>
            <td><p>&nbsp;</p></td>
            <td><p>&nbsp;</p></td>
            <td><p>&nbsp;</p></td>
            <td><p>&nbsp;</p></td>
            </tr>
            </table>
            <br>';
   
$html .='<table width="100%" border="1" cellspacing="0" cellpadding="0"> 
            <thead>
            <tr>
                <td width="50%"><p>Redactado por: ';//no funcion
                foreach ($resul as $key => $valUs)//
                { 
                  $idusuario=$valUs->id;
                  $id_usuario=$value->id_usuario;
                  if($idusuario==$id_usuario){
                    if ( $valUs->nombre_usuario != null || $valUs->nombre_usuario!='') {
                        // echo utf8_encode($valU->nombre_usuario);
                        $html.=utf8_encode($valUs->nombre_usuario);
                        }
                        else if ($valUs->nombre_usuario == null || $valUs->nombre_usuario == ''){
                            $empleadosData = ModeloUsuarios::mdlbuscarEmpleadoByNumEmpleadoM('Empleados',$valUs->num_empleado);
                            foreach ($empleadosData as $key => $valE)
                                {
                                    $nombre=$valE->nombre;
                                        // echo utf8_encode($nombre);
                                        $html.=utf8_encode($nombre);
                                }
                        }
                  }
                }
                                
    $html .= '</p></td>
                <td width="50%">Fecha de elaboración de minuta: <br>'.$fecha_alta.'</td>
            </tr>
            </thead>    
        </table>
        <br>';


$html .='<label>Firmas:</label><br><br><br>';
$html .='<table width="100%" border="" cellspacing="0" cellpadding="0"> 
            <tr>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            </tr>     
        </table>
        <br><br>';
      
$html .='<table width="100%" border="" cellspacing="0" cellpadding="0"> 
            <tr>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            </tr>     
        </table>
        <br><br>';

$html .='<table width="100%" border="" cellspacing="0" cellpadding="0"> 
            <tr>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            <td class="center" colspan="2"><p>__________________________________________</p></td>
            </tr>     
        </table>';
      $footer = '</body></html>';
      include("../../../mpdf60/mpdf.php");

      $mpdf = new mPDF();

      $stylesheet = file_get_contents('../../vistas/dist/css/estilo_pdf.css');
      $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text

      $mpdf->SetHTMLFooter($footer);

      $mpdf->WriteHTML($html);
      $mpdf->Output();
      exit;


?>