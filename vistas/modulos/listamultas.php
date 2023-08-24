
<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//$proveedor = ControladorProveedores::ctrMostrarProveedoresSindicato($_POST['paisSelect']);
//$reportes=ControladorDemandas::ctrVisualizarReportes();
//$_SESSION
//echo "<pre>";
//print_r($reportes);
//echo "</pre>";
//echo $_POST['paisSelect'];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[109];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[109];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMulta"><?php echo $textosArray[19];?></button>
                <!--                <button class="btn btn-danger" data-toggle="modal" data-target="#modalReporteAbogados">Reporte Abogados</button>-->
                <!--                <button class="btn btn-success float-right" data-toggle="modal" data-target="#modalVisualizarReportes">Reportes Subidos</button>-->

                <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">

            </div>
        </div>
        <br><br>

        <div id="accordion">
            <div class="card" >
                <div class="card-body">
                    <table class="table table-striped tablaDescargaReportes dt-responsive" >
                        <thead>
                        <tr>
                            <th width="10%" scope="col"></th>
                            <th width="9%" scope="col"><?php echo $textosArray[70];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[120];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[126];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[99];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[130];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[82];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[83];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[106];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[105];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[132];?></th>
                            <th width="9%" scope="col"><?php echo $textosArray[31];?></th>
                            <th class="d-none" width="9%" scope="col"><?php echo $textosArray[61];?></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        if ( $_SESSION['id_perfil']==1)
                        {
                            $divisionesDisponibles="ALL";
                        }
                        elseif ($_SESSION['id_perfil']==5 || $_SESSION['id_perfil']==4 || $_SESSION['id_perfil']==2 )
                        {
                            $divisionesDisponibles=$_SESSION['divisiones'];
                        }


                        $multas= ControladorMultas::ctrMostrarMulta($divisionesDisponibles);
//                                                  echo "<pre>";
//                                                  print_r($multas);
//                                                  echo "</pre>";
                        foreach ($multas as $key => $value)
                        {
                            echo'<tr>
                                    <td>
                                          <div class="btn-group">
                                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#subirArchivo_'.$value->IDmulta.'"><i class="fa fa-upload"></i></button>
                                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#historialArchivos_'.$value->IDmulta.'"><i class="fa fa-list"></i></button>
                                            <button class="btn btn-success  btn-xs" data-toggle="modal" data-target="#editarMulta_'.$value->IDmulta.'"><i class="fa fa-edit"></i></button>
                                           <!-- <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#detalles_'.$value->IDmulta.'"><i class="fa fa-calendar"></i></button>-->
                    
                                        </div>
                                    </td>
                                  <td>'.utf8_encode($value->nombre).'</td>
                                  <td>'.$value->num_empleado.'</td>
                                  <td>'.utf8_encode($value->pais).'</td>
                                  <td>'.utf8_encode($value->division).'</td>
                                  <td>'.utf8_encode($value->posicion).'</td>
                                  <td>'.utf8_encode($value->fecha_generacion_multa).'</td>
                                  <td>'.utf8_encode($value->pago_multa).'</td>
                                  <td>'.utf8_encode($value->motivo).'</td>
                                  <td>'.number_format($value->montoMXN).'</td>
                                  <td>'.$value->region.'</td>
                                  <td>'.utf8_encode($value->area).'</td>
                                  <td class="d-none" title="'.$value->defensa.'">'.$value->defensa.'</td>
                                  
                                </tr>
        
          <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$value->IDmulta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[250].' #'.$value->IDmulta.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                            $archivosMul=ControladorMultas::ctrMostrarHistorialArchivosxMulta($value->IDmulta);
//                                    echo "<pre>";
//                                    print_r($archivosMul);
//                                    echo "</pre>";
                            foreach ($archivosMul as $key => $arM)
                            {

                                echo'<div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arM->nombre).'</span>
                                              </div>
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/multas/'.utf8_encode($arM->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arM->fecha_alta2).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

                                if ($arM->num_empleado=="Externo")
                                {
                                    echo'<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="'.$arM->usuario.'">';

                                }
                                elseif ($arM->num_empleado!="Externo")
                                {
                                    $empleado=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($arM->num_empleado);
                                    foreach ($empleado as $key => $emp)
                                    {
                                        echo '<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="' . $emp->nombre . '">';
                                    }
                                }

                                echo '</div>
                                        </div>
                                        
                                        
                                        ';


                            }
                            echo '</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                          </div>
                        </div>
                      </div>
                    </div>
        
          <!-- Modal Archivos historial -->
        
        
                  <!-- Modal Subir Archivo-->
            <div class="modal fade" id="subirArchivo_'.$value->IDmulta.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[151].' '.$textosArray[25].' '.$value->IDmulta.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                
                                <div class="card">
                                    <div class="card-body">
                                            <div class="card-body">
                                                <div class="form-group" >
                                                    <div class="input-group">
<!--                                                        <div class="input-group-text">-->
<!--                                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>-->
<!--                                                        </div>-->

                                                        <input type="file" class="form-control input-lg " name="file" id="file">
                                                        <input type="hidden" value="'.$value->IDmulta.'" id="idMulta">
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                               </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                <button type="button" class="btn btn-primary archivoMulta" title="Para habilitar llenar todos los campos de Minutas">'.$textosArray[231].'</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal editarMulta -->
        <div  id="editarMulta_'.$value->IDmulta.'" name="editarMulta_" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">'.$textosArray[229].' </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">

                                            <div class="form-group">
                                                <span>'.$textosArray[82].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="generacionMultaEdit'.$value->IDmulta.'" id="generacionMultaEdit'.$value->IDmulta.'" value="'.$value->fecha_generacion_multa.'" required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span>'.$textosArray[83].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaPagoMultaEdit'.$value->IDmulta.'" id="fechaPagoMultaEdit'.$value->IDmulta.'" value="'.$value->pago_multa.'" required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>'.$textosArray[106].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="motivoEdit'.$value->IDmulta.'" id="motivoEdit'.$value->IDmulta.'" placeholder="Motivo" value="'.$value->motivo.'"required>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span>'.$textosArray[104].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="montoEdit_'.$value->IDmulta.'" id="montoEdit_'.$value->IDmulta.'" placeholder="Monto" value="'.number_format($value->monto).'" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span>'.$textosArray[105].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="montoMXNEdit_'.$value->IDmulta.'" id="montoMXNEdit_'.$value->IDmulta.'" placeholder="MontoMXN" value="'.number_format($value->montoMXN).'" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>'.$textosArray[103].'</span>';

                                              $monedaActual=$value->id_moneda;
                                            $monedaEdit=ControladorDemandas::ctrMonedas();

                                                echo'<div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg monedaEdit" name="monedaEdit'.$value->IDmulta.'" id="monedaEdit'.$value->IDmulta.'" idMulta="'.$value->IDmulta.'">
                                                        <option value="">---</option>';

//                                                    $selected="";
//                                                    echo "<br>".$monedaActual;

                                                    foreach ($monedaEdit as $key => $valueEdit)
                                                    {
//                                                        echo $valueEdit->id;
                                                        if ($monedaActual==$valueEdit->id)
                                                        {
                                                            echo ' <option  idmoneda="'.$valueEdit->diferencia_mxn.'" value="'.$valueEdit->id.'" selected>'.$valueEdit->signo.' '.$valueEdit->nombre_moneda. ' <--> '.$valueEdit->diferencia_mxn.'MXN</option>';

                                                        }
                                                        else
                                                        {
                                                            echo ' <option  idmoneda="'.$valueEdit->diferencia_mxn.'" value="'.$valueEdit->id.'" >'.$valueEdit->signo.' '.$valueEdit->nombre_moneda. ' <--> '.$valueEdit->diferencia_mxn.'MXN</option>';

                                                        }

                                                    }
                                                    echo'</select>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                         





                                        </div><!--  ./boxbody -->
                                    </div> <!--col md -->
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <span>'.$textosArray[132].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="regionEdit'.$value->IDmulta.'" id="regionEdit'.$value->IDmulta.'" >
                                                    <option value="">---</option>';
                                                    if ($value->region="México & CA")
                                                    {

                                                        echo '<option value="México & CA" selected>México & CA</option>
                                                              <option value="EUA">EUA</option>
                                                              <option value="LATAM">LATAM</option>';

                                                    }
                                                    elseif ($value->region="EUA")
                                                    {

                                                        echo '<option value="México & CA">México & CA</option>
                                                                                      <option value="EUA" selected>EUA</option>
                                                                                      <option value="LATAM">LATAM</option>';

                                                    }
                                                    elseif ($value->region="LATAM")
                                                    {

                                                        echo '<option value="México & CA" >México & CA</option>
                                                                                      <option value="EUA">EUA</option>
                                                                                      <option value="LATAM" selected>LATAM</option>';

                                                    }

                                                echo'</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span>'.$textosArray[31].' </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="areaRevisadaEdit'.$value->IDmulta.'" id="areaRevisadaEdit'.$value->IDmulta.'" value="'.$value->area.'">
                                                    <option value="">---</option>';
                                                    if ($value->area="Laboral")
                                                    {

                                                        echo '
                                                                                    <option value="Laboral" selected>Laboral</option>
                                                                                    <option value="Seguridad Social">Seguridad Social</option>
                                                                                    <option value="Certificación ISO">Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene">Seguridad e Higiene</option>
                                                                                    <option value="Fiscal">Fiscal</option>
                                                                                    <option value="Integral">Integral</option>
                                                                                
                                                                                
                                                                                ';

                                                    }
                                                    elseif($value->area="Seguridad Social")
                                                    {
                                                        echo '
                                                                                    <option value="Laboral">Laboral</option>
                                                                                    <option value="Seguridad Social" selected>Seguridad Social</option>
                                                                                    <option value="Certificación ISO">Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene">Seguridad e Higiene</option>
                                                                                    <option value="Fiscal">Fiscal</option>
                                                                                    <option value="Integral">Integral</option>
                                                                                
                                                                                
                                                                                ';
                                                    }
                                                    elseif($value->area="Certificación ISO")
                                                    {
                                                        echo '
                                                                                    <option value="Laboral">Laboral</option>
                                                                                    <option value="Seguridad Social" >Seguridad Social</option>
                                                                                    <option value="Certificación ISO" selected>Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene">Seguridad e Higiene</option>
                                                                                    <option value="Fiscal">Fiscal</option>
                                                                                    <option value="Integral">Integral</option>
                                                                                
                                                                                
                                                                                ';
                                                    }
                                                    elseif($value->area="Seguridad e Higiene")
                                                    {
                                                        echo '
                                                                                    <option value="Laboral">Laboral</option>
                                                                                    <option value="Seguridad Social" >Seguridad Social</option>
                                                                                    <option value="Certificación ISO" selected>Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene" selected>Seguridad e Higiene</option>
                                                                                    <option value="Fiscal">Fiscal</option>
                                                                                    <option value="Integral">Integral</option>
                                                                                
                                                                                
                                                                                ';
                                                    }
                                                    elseif($value->area="Fiscal")
                                                    {
                                                        echo '
                                                                                    <option value="Laboral">Laboral</option>
                                                                                    <option value="Seguridad Social" >Seguridad Social</option>
                                                                                    <option value="Certificación ISO" selected>Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene" >Seguridad e Higiene</option>
                                                                                    <option value="Fiscal" selected>Fiscal</option>
                                                                                    <option value="Integral">Integral</option>
                                                                                
                                                                                
                                                                                ';
                                                    }
                                                    elseif($value->area="Integral")
                                                    {
                                                        echo '
                                                                                    <option value="Laboral">Laboral</option>
                                                                                    <option value="Seguridad Social" >Seguridad Social</option>
                                                                                    <option value="Certificación ISO" selected>Certificación ISO</option>
                                                                                    <option value="Seguridad e Higiene" >Seguridad e Higiene</option>
                                                                                    <option value="Fiscal" >Fiscal</option>
                                                                                    <option value="Integral" selected>Integral</option>
                                                                                
                                                                                
                                                                                ';
                                                    }





                                                echo'</select>
                                            </div>
                                        </div>
                                     


                                        <div class="form-group">
                                            <span>'.$textosArray[124].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="observacionesEdit'.$value->IDmulta.'" id="observacionesEdit'.$value->IDmulta.'" >'.$value->observaciones.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <span>'.$textosArray[72].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="estatusEdit'.$value->IDmulta.'" id="estatusEdit'.$value->IDmulta.'" >
                                                    <option value="">---</option>';
                                                    if ($value->estatusMulta=="Abierta")
                                                    {
                                                        echo '
                                                                <option value="Abierta" selected>Abierta</option>
                                                                <option value="Cerrada">Cerrada</option>
                                                                <option value="En proceso">En proceso</option>
                                                        
                                                        ';

                                                    }
                                                    elseif ($value->estatusMulta=="Cerrada")
                                                    {
                                                        echo '
                                                                <option value="Abierta" >Abierta</option>
                                                                <option value="Cerrada" selected>Cerrada</option>
                                                                <option value="En proceso">En proceso</option>
                                                        
                                                        ';
                                                    }
                                                    elseif ($value->estatusMulta=="En proceso")
                                                    {
                                                        echo '
                                                                <option value="Abierta" >Abierta</option>
                                                                <option value="Cerrada" >Cerrada</option>
                                                                <option value="En proceso" selected>En proceso</option>
                                                        
                                                        ';
                                                    }


                                                echo'</select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->


                                        <div class="form-group">
                                            <span>'.$textosArray[271].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="planAccionEdit'.$value->IDmulta.'" id="planAccionEdit'.$value->IDmulta.'">'.$value->plan_accion.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                    
                                    
                                        
                                         <div class="form-group" >
                                            <h3>'.$textosArray[100].'</h3>';

                                            $mediosexplode=explode("/",$value->defensa);
//                                            echo "<pre>";
//                                            print_r($mediosexplode);
//                                            echo "</pre>";
                                            $varcheked1="";
                                            $varcheked2="";
                                            $varcheked3="";
                                            $varcheked4="";
                                            $varcheked5="";
                                            foreach ($mediosexplode as $key => $valMedios)
                                            {
//                                                echo $valMedios;
                                                if($valMedios=="Recorridos en Instalaciones")
                                                {
                                                  $varcheked1="checked";
                                                }
                                                elseif ($valMedios=="Revisión documental")
                                                {
                                                    $varcheked2="checked";

                                                }
                                                elseif ($valMedios=="Entrevistas a colaboradores")
                                                {
                                                    $varcheked3="checked";

                                                }
                                                elseif ($valMedios=="Pruebas de diagnostico")
                                                {
                                                    $varcheked4="checked";

                                                }
                                                elseif ($valMedios!='' && $valMedios!="Recorridos en Instalaciones" && $valMedios!="Revisión documental" && $valMedios!="Entrevistas a colaboradores" && $valMedios!="Pruebas de diagnostico" && $valMedios!="Pruebas de diagnostico")
                                                {
                                                    $varcheked5="checked";
                                                    $valorValmedio=$valMedios;

                                                }

                                            }

                                    echo' <input type="checkbox" name="mediosEdit[]'.$value->IDmulta.'" id="motivo1Edit'.$value->IDmulta.'" class="checkBoxGroup " value="Recorridos en Instalaciones" '.$varcheked1.'>
                                                            <label for="motivo1">Recorridos en Instalaciones</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->IDmulta.'" id="motivo2Edit'.$value->IDmulta.'" class="checkBoxGroup" value="Revisión documental" '.$varcheked2.'>
                                                            <label for="motivo2">Revisión documental</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->IDmulta.'" id="motivo3Edit'.$value->IDmulta.'" class="checkBoxGroup" value="Entrevistas a colaboradores" '.$varcheked3.'>
                                                            <label for="motivo3">Entrevistas a colaboradores</label>
                                                            <br>
                                                              <input type="checkbox" name="mediosEdit[]'.$value->IDmulta.'" id="motivo4Edit'.$value->IDmulta.'" class="checkBoxGroup" value="Pruebas de diagnostico" '.$varcheked4.'>
                                                            <label for="motivo4">Pruebas de diagnostico</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->IDmulta.'" id="motivo5Edit'.$value->IDmulta.'" idMulta="'.$value->IDmulta.'" class="checkBoxGroup" value="Otro" '.$varcheked5.'>
                                                            <label for="mot">Otro</label>
                                                            <div class="form-group"  id="divOtroMotivoEdit">
                                                                <!--                                            <span>Otro Motivo</span>-->
                                                                <div class="input-group" >
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                                                    </div>
                                                                    <input style="background-color: #0c0c0c !important;color: white !important;" type="text" class="form-control input-lg" name="medioTextEdit'.$value->IDmulta.'" id="medioTextEdit'.$value->IDmulta.'" placeholder="Motivo" required value="'.$valorValmedio.'">
                                                                    <hr>
                                                                </div>
                                                            </div>
</div>

                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">'.$textosArray[230].'</button>
                            <button type="button" class="btn btn-primary guardarEdicionMulta" IDMULTAEDIT="'.$value->IDmulta.'">'.$textosArray[231].'</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal editar Multa -->        
        
        
        
        
        
         
              ';
                        }

                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal modalAgregarMulta -->
        <div  id="modalAgregarMulta" name="modalAgregarMulta" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" id="frmRegRev">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[19];?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <span><?php echo $textosArray[120];?> </span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="num_EmpleadoActive" id="num_EmpleadoActive" placeholder="Num Empleado" required>
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[112];?> </span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Nombre" required readonly>
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[99];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-place-of-worship"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="localidad" id="localidad" placeholder="Localidad" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[37];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="pais" id="pais" placeholder="Pais" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[126];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-holly-berry"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="puesto" id="puesto" placeholder="Puesto" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[82];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="generacionMulta" id="generacionMulta"  required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span><?php echo $textosArray[83];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaPagoMulta" id="fechaPagoMulta"  required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[106];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="motivo" id="motivo" placeholder="Motivo" required>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span><?php echo $textosArray[104];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <?php
                                                        if ($_POST['paisSelect']=='Argentina' || $_POST['paisSelect']=='argentina')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais($_POST['paisSelect']);
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }

                                                        }
                                                        elseif ($_POST['paisSelect']=='brasil' || $_POST['paisSelect']=='Brasil')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais($_POST['paisSelect']);
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }
                                                        }
                                                        elseif ($_POST['paisSelect']=='mexico' || $_POST['paisSelect']=='Mexico')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais($_POST['paisSelect']);
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }
                                                        }
                                                        elseif ($_POST['paisSelect']=='usa' || $_POST['paisSelect']=='USA')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais($_POST['paisSelect']);
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }
                                                        }
                                                        elseif ($_POST['paisSelect']=='peru' || $_POST['paisSelect']=='Peru')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais($_POST['paisSelect']);
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }
                                                        }
                                                        elseif ($_POST['paisSelect']=='centroAmerica')
                                                        {
                                                            $monedaPais=ControladorDemandas::ctrMonedaxPais("Guatemala");
                                                            foreach ($monedaPais as $key => $val)
                                                            {
                                                                echo '<span class="input-group-addon">'.$val->signo.'</span>';
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="monto" id="monto" placeholder="Monto" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[105];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="montoMXN" id="montoMXN" placeholder="MontoMXN" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span><?php echo $textosArray[103];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="moneda" id="moneda">
                                                        <option value="">---</option>
                                                        <?php
                                                        $moneda=ControladorDemandas::ctrMonedas();

                                                        foreach ($moneda as $key => $value)
                                                        {
                                                            echo ' <option  idmoneda="'.$value->diferencia_mxn.'" value="'.$value->id.'">'.$value->signo.' '.$value->nombre_moneda. ' <--> '.$value->diferencia_mxn.'MXN</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->





                                        </div><!--  ./boxbody -->
                                    </div> <!--col md -->
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <span><?php echo $textosArray[132];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="region" id="region">
                                                    <option value="">---</option>
                                                    <option value="México & CA">México & CA</option>
                                                    <option value="EUA">EUA</option>
                                                    <option value="LATAM">LATAM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span><?php echo $textosArray[31];?> </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="areaRevisada" id="areaRevisada">
                                                    <option value="">---</option>
                                                    <option value="Laboral">Laboral</option>
                                                    <option value="Seguridad Social">Seguridad Social</option>
                                                    <option value="Certificación ISO">Certificación ISO</option>
                                                    <option value="Seguridad e Higiene">Seguridad e Higiene</option>
                                                    <option value="Fiscal">Fiscal</option>
                                                    <option value="Integral">Integral</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <h3><?php echo $textosArray[100];?></h3>


                                            <input type='checkbox' name='medios[]' id="motivo1" class="checkBoxGroup " value='Recorridos en Instalaciones' >
                                            <label for="motivo1"><?php echo $textosArray[131];?></label>
                                            <br>
                                            <input type='checkbox' name='medios[]' id="motivo2" class="checkBoxGroup" value='Revisión documental' >
                                            <label for="motivo2"><?php echo $textosArray[138];?></label>
                                            <br>
                                            <input type='checkbox' name='medios[]' id="motivo3" class="checkBoxGroup" value='Entrevistas a colaboradores' >
                                            <label for="motivo3"><?php echo $textosArray[71];?></label>
                                            <br>
                                            <input type='checkbox' name='medios[]' id="motivo4" class="checkBoxGroup" value='Pruebas de diagnostico' >
                                            <label for="motivo4"><?php echo $textosArray[129    ];?></label>
                                            <br>
                                            <input type='checkbox' name='medios[]' id="motivo5" class="checkBoxGroup" value='Otro' >
                                            <label for="motivo5"><?php echo $textosArray[125];?></label>


                                        </div>
                                        <div class="form-group" style="display: none !important;" id="divOtroMotivo">
                                            <!--                                            <span>Otro Motivo</span>-->
                                            <div class="input-group" >
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                                </div>
                                                <input style="background-color: #0c0c0c !important;color: white !important;" type="text" class="form-control input-lg" name="medioText" id="medioText" placeholder="Motivo" required >
                                                <hr>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <span><?php echo $textosArray[124];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="observaciones" id="observaciones"></textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <span><?php echo $textosArray[70];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="estatus" id="estatus">
                                                    <option value="">---</option>
                                                    <option value="Abierta">Abierta</option>
                                                    <option value="Cerrada">Cerrada</option>
                                                    <option value="En proceso">En proceso</option>

                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->


                                        <div class="form-group">
                                            <span><?php echo $textosArray[171];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="planAccion" id="planAccion"></textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->




                                    </div>

                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary guardarMulta" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal  -->



    </section>
    <!-- /.content -->
</div>


<script>

    function soloNumeros(e)
    {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla == 8 || tecla == 9 || tecla == 0) {
            return true;
        }
        patron = /[0-9\.\,]/;
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }

    $(document).ready (function ()
    {

        $("#Distintivo").change(function ()
        {
            var distintivo=$("#Distintivo").val();
            if (distintivo=='Si')
            {
                $("#divDistintivoText").show();

            }
            if (distintivo=='No')
            {
                $("#divDistintivoText").hide();

            }

        });
        $("#motivo5").change(function ()
        {
            if ($(this).is(':checked'))
            {
                // Do something...
                // alert('You can rock now...');
                $("#divOtroMotivo").show();

            }
            else
            {
                $("#medioText").val('');
                $("#divOtroMotivo").hide();



            }
            //  var motivo5=$("#motivo5").val();
            // alert(motivo5);

        });


        $("#moneda").change(function () {
            //
            // var value = 10000
            //
            // console.log(formatter.format(value)) // "$10,000
            var valorMoneda = $('option:selected', this).attr('idmoneda');
            // alert(option);

            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            var monto = $("#monto").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var montoR=monto.replace(/,/g, '');//

            console.log(monto);
            console.log(montoR);
            // formatter.format(cuenta)
            var cuenta=(montoR * valorMoneda);
            // console.log(formatter.format(cuenta)) // "$10,000

            // var conDecimal = cuenta.toFixed(2);

            $("#montoMXN").val(formatter.format(cuenta));
            $("#montoMXN").css("background-color", "#86a76e");
            $("#montoMXN").css("color", "#000000");


        });


        $("#num_EmpleadoActive").change(function () {
            var numEmpleadoActive = $(this).val();//tomar el atributo
            // alert(numEmpleadoActive);
            var funcion = "buscarEmpleadoByNumEmpleadoDEMANDAS";
            var datos = new FormData();

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("numEmpleadoActive", numEmpleadoActive);

            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta)
                {
                    console.log(respuesta);
                    console.log(respuesta['nombre']);
                    console.log(respuesta['fecha_ingreso']);
                    console.log(respuesta['division']);

                    //console.log(<?php //echo $_SESSION['divisiones'];?>//);
                    var idPerfil="<?php echo $_SESSION['id_perfil'];?>"
                    if(idPerfil!=1)
                    {
                        var str = "<?php echo $_SESSION['divisiones'];?>";
                        console.log("str"+str);

                        var n = str.indexOf(respuesta['cod_division']);
                        console.log("n"+n);
                        if(n!='-1')
                        {
                            $("#nombre").val('');
                            $("#fechaIngreso").val('');
                            $("#localidad").val('');
                            $("#localidadPais").val('');

                            Swal.fire({
                                title: 'Error!',
                                text: 'Este usuario no pertenece a las divisiones asignadas',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });




                        }


                    }

                    if (typeof (respuesta) != "undefined" && respuesta !== null) {
                        $("#nombre").val(respuesta['nombre']);
                        $("#fechaIngreso").val(respuesta['fecha_ingreso']);
                        $("#localidad").val(respuesta['division']);
                        $("#pais").val(respuesta['pais']);
                        $("#puesto").val(respuesta['posicion']);


                        $("#nombre").css("background-color", "#86a76e");
                        $("#nombre").css("color", "#000000");


                        $("#fechaIngreso").css("background-color", "#86a76e");
                        $("#fechaIngreso").css("color", "#000000");

                        $("#localidad").css("background-color", "#86a76e");
                        $("#localidad").css("color", "#000000");

                        $("#pais").css("background-color", "#86a76e");
                        $("#pais").css("color", "#000000");

                        $("#puesto").css("background-color", "#86a76e");
                        $("#puesto").css("color", "#000000");
                    } else {
                        // $("#usuarioActive").val("");
                        // $("#correoActive").val("");
                        // $("#usuarioActive").css("background-color", "#d68585");
                        // $("#correoActive").css("background-color", "#d68585");
                        // $("#usuarioActive").css("color", "#000000");
                        // $("#correoActive").css("color", "#000000");

                    }


                }

            });

        });

        $(".guardarMulta").click(function ()
        {

            var dataString = $('#frmRegRev').serializeArray();
            var camposFaltantes=[];
            console.log(dataString);
            $.each(dataString   , function(i, field){
                var nombrecampo=field.name;
                var valorCampo=field.value;

                if (valorCampo=="")
                {
                    if (nombrecampo=="medioText" )
                    {

                    }
                    else {
                        camposFaltantes.push(nombrecampo);
                    }
                }

            });
            console.log(camposFaltantes);

            // alert(camposFaltantes.length);
            if(camposFaltantes!=0)
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Todos los campos son obligatorios!'+camposFaltantes,
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {

                var datos = new FormData();
                var funcion = "guardarMulta";
                var num_EmpleadoActive = $("#num_EmpleadoActive").val();
                var nombre = $("#nombre").val();
                var localidad = $("#localidad").val();
                var pais = $("#pais").val();
                var puesto = $("#puesto").val();
                var generacionMulta = $("#generacionMulta").val();
                var fechaPagoMulta = $("#fechaPagoMulta").val();
                var motivo = $("#motivo").val();

                var monto = $("#monto").val();
                var montoR=monto.replace(/,/g, '');//

                var montoMXN = $("#montoMXN").val();
                var montoMXNR=montoMXN.replace(/,/g, '');//

                var moneda = $("#moneda").val();
                var region = $("#region").val();
                var areaRevisada = $("#areaRevisada").val();
                var medios =  JSON.stringify($('[name="medios[]"]').serializeArray());
                var medioText = $("#medioText").val();
                var observaciones = $("#observaciones").val();
                var estatus = $("#estatus").val();
                var planAccion = $("#planAccion").val();


                // var idmoneda = $("#moneda").attr("idmoneda");
                // alert(medios);


                datos.append("datos", datos);//PARA MANDARLO A LA VARIABLE datos
                datos.append("funcion", funcion);
                datos.append("num_EmpleadoActive", num_EmpleadoActive);
                datos.append("nombre", nombre);
                datos.append("localidad", localidad);
                datos.append("pais", pais);
                datos.append("puesto", puesto);
                datos.append("generacionMulta", generacionMulta);
                datos.append("fechaPagoMulta", fechaPagoMulta);
                datos.append("motivo", motivo);
                datos.append("monto", montoR);
                datos.append("montoMXN", montoMXNR);
                datos.append("moneda", moneda);
                datos.append("region", region);
                datos.append("areaRevisada", areaRevisada);
                datos.append("medios", medios);
                datos.append("medioText", medioText);
                datos.append("observaciones", observaciones);
                datos.append("estatus", estatus);
                datos.append("planAccion", planAccion);

                $.ajax({
                    url: "ajax/multas.ajax.php",
                    method: "POST",
                    data: datos,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        if (respuesta == "ok") {
                            Swal.fire({
                                title: 'Success!',
                                text: '¡Registro Exitoso!',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Warning!',
                                text: '¡Registro Exitoso!',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }


                    },
                    error: function (respuesta) {
                        Swal.fire({
                            title: 'Error!',
                            text: '¡error al guardar!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }

                }).done(function () {
                    $('.succes').show();
                });
            }

        });
//-------------------------------------------------------------------




        $(".archivoMulta").click(function()
        {

            var datos = new FormData();
            var funcion         ="subirArchivoMulta";
            var idMulta       = $("#idMulta").val();
            var idUser       = $("#idUser").val();
            var file         =  $("#file")[0].files[0];
            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("idMulta", idMulta);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idUser", idUser);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/multas.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta)
                {
                    if (respuesta=="ok")
                    {
                        Swal.fire({
                            title: 'Success!',
                            text: '¡Archivo guardado!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Archivo guardado!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                location.reload();
                            }
                        });
                    }


                },
                error : function(respuesta)
                {
                    Swal.fire({
                        title: 'Error!',
                        text: '¡error al guardar!',
                        icon: 'error',
                        confirmButtonText:'Ok'
                    });
                }

            }).done(function ()
            {
                // $('.succes').show();
            });
        });


//------------------------------------------------------------------------------------

        $("#motivo5Edit").change(function ()
        {
            var idMulta = $(this).attr('idMulta');
            alert(idMulta);
            if ($(this).is(':checked'))
            {
                // Do something...
                // alert('You can rock now...');
                $("#divOtroMotivoEdit").show();

            }
            else
            {
                $("#divOtroMotivoEdit").hide();
                $("#medioTextEdit").val('');



            }
            //  var motivo5=$("#motivo5").val();
            // alert(motivo5);

        });


        $(".monedaEdit").change(function () {
            var idMulta = $(this).attr('idMulta');
            // alert(idMulta);

            var valorMoneda = $('option:selected', this).attr('idmoneda');

            // alert(valorMoneda);
            // console.log(option);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            var monto = $("#montoEdit_"+idMulta).val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var montoR=monto.replace(/,/g, '');//

            console.log(monto);
            console.log(montoR);
            // formatter.format(cuenta)
            var cuenta=(montoR * valorMoneda);
            // var conDecimal = cuenta.toFixed(2);

            $("#montoMXNEdit_"+idMulta).val(formatter.format(cuenta));
            $("#montoMXNEdit_"+idMulta).css("background-color", "#86a76e");
            $("#montoMXNEdit_"+idMulta).css("color", "#000000");


        });


        // $("#num_EmpleadoActiveEdit").change(function () {
        //     var numEmpleadoActive = $(this).val();//tomar el atributo
        //     // alert(numEmpleadoActive);
        //     var funcion = "buscarEmpleadoByNumEmpleadoDEMANDAS";
        //     var datos = new FormData();
        //
        //     datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        //     datos.append("numEmpleadoActive", numEmpleadoActive);
        //
        //     $.ajax({
        //         url: "ajax/usuarios.ajax.php",
        //         method: "POST",
        //         data: datos,
        //         async: true,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         dataType: "json",
        //         success: function (respuesta)
        //         {
        //             console.log(respuesta);
        //             console.log(respuesta['nombre']);
        //             console.log(respuesta['fecha_ingreso']);
        //             console.log(respuesta['division']);
        //
        //             if (typeof (respuesta) != "undefined" && respuesta !== null) {
        //                 $("#nombreEdit").val(respuesta['nombre']);
        //                 // $("#fechaIngresoEdit").val(respuesta['fecha_ingreso']);
        //                 $("#localidadEdit").val(respuesta['division']);
        //                 $("#paisEdit").val(respuesta['pais']);
        //                 $("#puestoEdit").val(respuesta['posicion']);
        //
        //
        //                 $("#nombreEdit").css("background-color", "#86a76e");
        //                 $("#nombreEdit").css("color", "#000000");
        //
        //                 //
        //                 // $("#fechaIngresoEdit").css("background-color", "#86a76e");
        //                 // $("#fechaIngresoEdit").css("color", "#000000");
        //
        //                 $("#localidadEdit").css("background-color", "#86a76e");
        //                 $("#localidadEdit").css("color", "#000000");
        //
        //                 $("#paisEdit").css("background-color", "#86a76e");
        //                 $("#paisEdit").css("color", "#000000");
        //
        //                 $("#puestoEdit").css("background-color", "#86a76e");
        //                 $("#puestoEdit").css("color", "#000000");
        //             } else {
        //                 // $("#usuarioActive").val("");
        //                 // $("#correoActive").val("");
        //                 // $("#usuarioActive").css("background-color", "#d68585");
        //                 // $("#correoActive").css("background-color", "#d68585");
        //                 // $("#usuarioActive").css("color", "#000000");
        //                 // $("#correoActive").css("color", "#000000");
        //
        //             }
        //
        //
        //         }
        //
        //     });
        //
        // });


        $(".guardarEdicionMulta").click(function ()
        {
            var datos = new FormData();
            var funcion = "guardarEdicionMulta";
            var IDMULTAEDIT=$(this).attr("IDMULTAEDIT");
            var generacionMulta = $("#generacionMultaEdit"+IDMULTAEDIT).val();
            var fechaPagoMulta = $("#fechaPagoMultaEdit"+IDMULTAEDIT).val();
            var motivo = $("#motivoEdit"+IDMULTAEDIT).val();
            var monto = $("#montoEdit_"+IDMULTAEDIT).val();
            var montoR=monto.replace(/,/g, '');//
            var montoMXN = $("#montoMXNEdit_"+IDMULTAEDIT).val();
            var montoMXNR=montoMXN.replace(/,/g, '');//
            var moneda = $("#monedaEdit"+IDMULTAEDIT).val();
            var region = $("#regionEdit"+IDMULTAEDIT).val();
            var areaRevisada = $("#areaRevisadaEdit"+IDMULTAEDIT).val();
            var medios =  JSON.stringify($('[name="mediosEdit[]'+IDMULTAEDIT+'"]').serializeArray());
            var medioText = $("#medioTextEdit"+IDMULTAEDIT).val();
            var observaciones = $("#observacionesEdit"+IDMULTAEDIT).val();
            var estatus = $("#estatusEdit"+IDMULTAEDIT).val();
            var planAccion = $("#planAccionEdit"+IDMULTAEDIT).val();


            // var idmoneda = $("#moneda").attr("idmoneda");
            // alert(medios);


            datos.append("datos", datos);//PARA MANDARLO A LA VARIABLE datos
            datos.append("IDMULTAEDIT", IDMULTAEDIT);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
            datos.append("generacionMulta", generacionMulta);
            datos.append("fechaPagoMulta", fechaPagoMulta);
            datos.append("motivo", motivo);
            datos.append("monto", montoR);
            datos.append("montoMXN", montoMXNR);
            datos.append("moneda", moneda);
            datos.append("region", region);
            datos.append("areaRevisada", areaRevisada);
            datos.append("medios", medios);
            datos.append("medioText", medioText);
            datos.append("observaciones", observaciones);
            datos.append("estatus", estatus);
            datos.append("planAccion", planAccion);

            $.ajax({
                url: "ajax/multas.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    if (respuesta == "ok") {
                        Swal.fire({
                            title: 'Success!',
                            text: '¡Registro Exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Registro Exitoso!',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }


                },
                error: function (respuesta) {
                    Swal.fire({
                        title: 'Error!',
                        text: '¡error al guardar!',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }

            }).done(function () {
                $('.succes').show();
            });
        });
//----------------------


    });
</script>

