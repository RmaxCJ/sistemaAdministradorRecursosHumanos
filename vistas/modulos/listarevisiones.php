<?php
//echo "<pre>";
//print_r($_SESSION['divisiones']);
//echo "</pre>";


//
//$proveedor = ControladorProveedores::ctrMostrarProveedoresSindicato($_POST['paisSelect']);
//$reportes=ControladorDemandas::ctrVisualizarReportes();
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
                    <h1 class="m-0 text-dark"><?php echo $textosArray[186];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[186];?></li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarRevision"><?php echo $textosArray[114];?></button>
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

                            <th width="15%" scope="col"></th>
                            <th width="5" scope="col"><?php echo $textosArray[120];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[70];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[126];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[99];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[130];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[98];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[159];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[106];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[105];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[132];?></th>
                            <th width="5" scope="col"><?php echo $textosArray[32];?></th>
                            <th class="d-none" width="5" scope="col">Resultado</th>
                            <th class="d-none" width="5" scope="col">Tipo de revisión</th>
                            <th class="d-none"  width="5" scope="col">Defensa</th>
                            <th class="d-none" width="5" scope="col">Observaciones</th>
                            <th class="d-none"  width="5" scope="col">RealizoPago</th>
                            <th class="d-none"  width="5" scope="col">Estatus</th>
                            <th class="d-none" width="5" scope="col">Monto(Local)</th>
                            <th class="d-none"  width="5" scope="col">Moneda(Local)</th>

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

                        $revisiones= ControladorRevisiones::ctrMostrarRevisiones($divisionesDisponibles);
//                          echo "<pre>";
//                          print_r($revisiones);
//                          echo "</pre>";
                        foreach ($revisiones as $key => $value)
                        {
                            echo'<tr>
                                   <td><div class="btn-group">
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#subirArchivo_'.$value->id.'"><i class="fa fa-upload"></i></button>
                                    <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#historialArchivos_'.$value->id.'"><i class="fa fa-list"></i></button>
                                    <button class="btn btn-success  btn-xs" data-toggle="modal" data-target="#editarRevision_'.$value->id.'"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-xs btnEliminarRevision" idRevision="'.$value->id.'"><i class="fa fa-times"></i></button>
                                        </div>
                                  </td>
                                  <td>'.$value->num_empleado.'</td>
                                  <td>'.utf8_encode($value->nombre).'</td>
                                  <td>'.utf8_encode($value->pais).'</td>
                                  <td>'.utf8_encode($value->division).'</td>
                                  <td>'.utf8_encode($value->posicion).'</td>
                                  <td>'.utf8_encode($value->inicio_revision).'</td>
                                  <td>'.utf8_encode($value->fin_revision).'</td>
                                  <td>'.$value->motivo.'</td>
                                  <td>'.$value->montoMXN.'</td>
                                  <td>'.$value->region.'</td>
                                  <td>'.utf8_encode($value->area_revisada).'</td>
                                  <td class="d-none">'.utf8_encode($value->resultado).'</td>
                                  <td class="d-none">'.utf8_encode($value->tipo_revision).'</td>
                                  <td class="d-none">'.$value->defensa.'</td>
                                  <td class="d-none">'.utf8_encode($value->observaciones).'</td>
                                  <td class="d-none">'.utf8_encode($value->realizoPago).'</td>
                                  <td class="d-none">'.utf8_encode($value->estatus).'</td>
                                  <td class="d-none">'.$value->monto.'</td>
                                  <td class="d-none">'.utf8_encode($value->nombre_moneda).'</td>
                                 
                                </tr>
         
          <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[92].' '.$value->id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                            $archivosIN=ControladorRevisiones::ctrMostrarHistorialArchivosxRevision($value->id);
//                                    echo "<pre>";
//                                    print_r($archivosIN);
//                                    echo "</pre>";
                            foreach ($archivosIN as $key => $arIN)
                            {

                                echo'<div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arIN->nombre).'</span>
                                              </div>
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/revisiones/'.utf8_encode($arIN->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp';

                                if ($arIN->num_empleado=="Externo")
                                {
                                    echo'<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="'.$arIN->usuario.'">';

                                }
                                elseif ($arIN->num_empleado!="Externo")
                                {
                                    $empleado=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($arIN->num_empleado);
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
            <div class="modal fade" id="subirArchivo_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[152].' '.$value->id.'</h5>
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

                                                        <input type="file" class="form-control input-lg " name="fileInterna" id="fileInterna'.$value->id.'">
                                                        <input type="hidden" value="'.$value->id.'"  id="idRevision'.$value->id.'">
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                               </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                <button type="button" class="btn btn-primary archivoRevision" idR="'.$value->id.'" title="Para habilitar llenar todos los campos de Minutas">'.$textosArray[231].'</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Modal Subir archivo Demanda -->
        
        
               <!-- Modal detalles Demanda -->
        <div  id="detallesDemanda_'.$value->id.'" name="detallesDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" id="frmDetalles">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda '.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                        <div class="box-body">
                            <div class="form-group">
                                <span>Empleado</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" value="'.$value->nombre.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Numero de empleado</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" value="'.$value->num_empleado.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Pais</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" value="'.$value->pais.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>VP</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" value="'.$value->nombre_vicepresidencia.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Area</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-lg" value="'.$value->nombre_area.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Fecha de cierre</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                    </div>
                                    <input type="date" class="form-control input-lg" value="'.$value->fecha_cierre.'" readonly>
                        
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Importe de Cierre Bruto (Moneda Local)</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" value="'.$value->cierre_bruto_local.'" readonly >
                                </div>
                            </div>
                            <!-- ./ form-gruop-->
                        
                            <div class="form-group">
                                <span>Importe de Cierre Neto (Moneda Local)</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" value="'.$value->cierre_neto_local.'" readonly >
                                </div>
                            </div>
                            <!-- ./ form-gruop-->
                            <div class="form-group">
                                <span>Importe de Cierre Bruto (MXN)</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" value="'.$value->cierre_bruto_MXN.'" readonly >
                                </div>
                            </div>
                            <!-- ./ form-gruop-->
                        
                            <div class="form-group">
                                <span>Importe de Cierre Neto (MXN)</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" value="'.$value->cierre_neto_MXN.'" readonly >
                                </div>
                            </div>
                            <!-- ./ form-gruop-->
                        
                        
                        
                        </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal detalles demanda-->
        
          <!-- Modal editarRevision -->
        <div  id="editarRevision_'.$value->id.'" name="editarRevision_" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">'.$textosArray[270].'  '.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <span>'.$textosArray[98].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="inicioRevisionEdit'.$value->id.'" id="inicioRevisionEdit'.$value->id.'" value="'.$value->inicio_revision.'" required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->


                                            <div class="form-group">
                                                <span>'.$textosArray[159].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="finRevisionEdit'.$value->id.'" id="finRevisionEdit'.$value->id.'" value="'.$value->fin_revision.'" required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->

                                             <div class="form-group">
                                                <span>'.$textosArray[9].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="multaEdit'.$value->id.'" id="multaEdit'.$value->id.'">';
                                                     if ($value->realizoPago=="Si")
                                                    {
                                                        echo '<option value="Si" selected>Si</option>
                                                            <option value="No">No</option>';
                                                    }
                                                     elseif ($value->realizoPago=="No")
                                                     {
                                                         echo '<option value="Si" >Si</option>
                                                            <option value="No" selected>No</option>';
                                                     }

                                                    echo'</select>

                                                </div>
                                            </div>
                                      <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>'.$textosArray[106].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="motivoEdit'.$value->id.'" id="motivoEdit'.$value->id.'" placeholder="Motivo" value="'.$value->motivo.'"required>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                        </div><!--  ./boxbody -->
                                    </div> <!--col md -->
                                    <div class="col-md-6">
                                    
                                        
                                             <div class="form-group">
                                                <span>'.$textosArray[164].'</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="tipoRevEdit'.$value->id.'" id="tipoRevEdit'.$value->id.'">';
                                                    if ($value->tipo_revision=="Interna")
                                                    {
                                                        echo '   <option value="Interna" selected>Interna</option>
                                                                <option value="Externa">Externa</option>';
                                                    }
                                                    elseif ($value->tipo_revision=="Externa")
                                                    {
                                                        echo '   <option value="Interna">Interna</option>
                                                                 <option value="Externa" selected>Externa</option>';
                                                    }

                                                    echo'</select>

                                                </div>
                                            </div>
                                      <!-- ./ form-gruop-->
                        


                                        <div class="form-group">
                                            <span>'.$textosArray[232].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="regionEdit'.$value->id.'" id="regionEdit'.$value->id.'" >
                                                    <option value="">---</option>';
                            if ($value->region=="México & CA")
                            {

                                echo '<option value="México & CA" selected>México & CA</option>
                                                              <option value="EUA">EUA</option>
                                                              <option value="LATAM">LATAM</option>';

                            }
                            elseif ($value->region=="EUA")
                            {

                                echo '<option value="México & CA">México & CA</option>
                                                                                      <option value="EUA" selected>EUA</option>
                                                                                      <option value="LATAM">LATAM</option>';

                            }
                            elseif ($value->region=="LATAM")
                            {

                                echo '<option value="México & CA" >México & CA</option>
                                                                                      <option value="EUA">EUA</option>
                                                                                      <option value="LATAM" selected>LATAM</option>';

                            }

                            echo'</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span>Area </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="areaRevisadaEdit'.$value->id.'" id="areaRevisadaEdit'.$value->id.'" value="'.$value->area.'">
                                                    <option value="">Seleccione el Area</option>';
                            if ($value->area_revisada=="Laboral")
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
                            elseif($value->area_revisada=="Seguridad Social")
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
                            elseif($value->area_revisada=="Certificación ISO")
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
                            elseif($value->area_revisada=="Seguridad e Higiene")
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
                            elseif($value->area_revisada=="Fiscal")
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
                            elseif($value->area_revisada=="Integral")
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
                                                <textarea  class="form-control input-lg" name="observacionesEdit'.$value->id.'" id="observacionesEdit'.$value->id.'" >'.$value->observaciones.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <span>'.$textosArray[72].'</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="estatusEdit'.$value->id.'" id="estatusEdit'.$value->id.'" >
                                                    <option value="">Seleccione el estatus</option>';
                            if ($value->estatus=="Abierta")
                            {
                                echo '
                                                                <option value="Abierta" selected>Abierta</option>
                                                                <option value="Cerrada">Cerrada</option>
                                                                <option value="En proceso">En proceso</option>
                                                        
                                                        ';

                            }
                            elseif ($value->estatus=="Cerrada")
                            {
                                echo '
                                                                <option value="Abierta" >Abierta</option>
                                                                <option value="Cerrada" selected>Cerrada</option>
                                                                <option value="En proceso">En proceso</option>
                                                        
                                                        ';
                            }
                            elseif ($value->estatus=="En proceso")
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


                                    
                                        
                                         <div class="form-group" >
                                            <h3>Medios de defensa</h3>';

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

                            echo' <input type="checkbox" name="mediosEdit[]'.$value->id.'" id="motivo1Edit'.$value->id.'" class="checkBoxGroup " value="Recorridos en Instalaciones" '.$varcheked1.'>
                                                            <label for="motivo1">Recorridos en Instalaciones</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->id.'" id="motivo2Edit'.$value->id.'" class="checkBoxGroup" value="Revisión documental" '.$varcheked2.'>
                                                            <label for="motivo2">Revisión documental</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->id.'" id="motivo3Edit'.$value->id.'" class="checkBoxGroup" value="Entrevistas a colaboradores" '.$varcheked3.'>
                                                            <label for="motivo3">Entrevistas a colaboradores</label>
                                                            <br>
                                                              <input type="checkbox" name="mediosEdit[]'.$value->id.'" id="motivo4Edit'.$value->id.'" class="checkBoxGroup" value="Pruebas de diagnostico" '.$varcheked4.'>
                                                            <label for="motivo4">Pruebas de diagnostico</label>
                                                            <br>
                                                            <input type="checkbox" name="mediosEdit[]'.$value->id.'" id="motivo5Edit'.$value->id.'" idRevision="'.$value->id.'" class="checkBoxGroup" value="Otro" '.$varcheked5.'>
                                                            <label for="mot">Otro</label>
                                                            <div class="form-group"  id="divOtroMotivoEdit'.$value->id.'">
                                                                <!--                                            <span>Otro Motivo</span>-->
                                                                <div class="input-group" >
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                                                    </div>
                                                                    <input style="background-color: #0c0c0c !important;color: white !important;" type="text" class="form-control input-lg" name="medioTextEdit'.$value->id.'" id="medioTextEdit'.$value->id.'" placeholder="Motivo" required value="'.$valorValmedio.'">
                                                                    <hr>
                                                                </div>
                                                            </div>
</div>
 
                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">'.$textosArray[230].'</button>
                            <button type="button" class="btn btn-primary guardarEdicionRevision" idRevision="'.$value->id.'" >'.$textosArray[231].'</button>
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




        <!-- Modal modalRegistrarRevision -->
        <div  id="modalRegistrarRevision" name="modalRegistrarRevision" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" id="frmRegRev">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[114];?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <span><?php echo $textosArray[122];?></span>
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
                                                <span><?php echo $textosArray[126];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="pais" id="pais" placeholder="Pais" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[130];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-holly-berry"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="puesto" id="puesto" placeholder="Puesto" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[98];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="inicioRevision" id="inicioRevision"  required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[159];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="terminoRevision" id="terminoRevision"  required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[9];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="multa" id="multa">
                                                        <option value="">---</option>
                                                        <option value="Si">Si</option>
                                                        <option value="No">No</option>

                                                    </select>

                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                        <div style="display: none !important;" id="camposMULTAS">
                                            <div class="form-group" >
                                                <span><?php echo $textosArray[83];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaPagoMulta" id="fechaPagoMulta"  required>
                                                </div>
                                            </div> <!-- ./ form-gruop-->

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
                                                    <input type="number" class="form-control input-lg" name="monto" id="monto" placeholder="Monto" required >
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[105];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control input-lg" name="montoMXN" id="montoMXN" placeholder="MontoMXN" required readonly>
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
                                                            echo ' <option  idmoneda="'.$value->diferencia_mxn.'" value="'.$value->id.'">'.$value->signo.'  '.$value->nombre_moneda. ' <--> '.$value->diferencia_mxn.'MXN</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                        </div>




                                        </div><!--  ./boxbody -->
                                    </div> <!--col md -->
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <span><?php echo $textosArray[164];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="tipoRev" id="tipoRev">
                                                    <option value="">---</option>
                                                    <option value="Interna">Interna</option>
                                                    <option value="Externa">Externa</option>
                                                </select>
                                            </div>
                                        </div>

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
                                            <span><?php echo $textosArray[32];?></span>
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
                                        <div class="form-group" >
                                            <h3><?php echo $textosArray[106];?></h3>


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
                                            <label for="motivo4"><?php echo $textosArray[129];?></label>
                                            <br>
                                            <input type='checkbox' name='medios[]' id="motivo5" class="checkBoxGroup" value='Otro' >
                                            <label for="motivo5"><?php echo $textosArray[125];?></label>






                                            <!--                                                <div class="input-group-text">-->
<!--                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>-->
<!--                                                </div>-->
<!--                                                <input type="hidden" class="form-control input-lg" name="Otro" id="Otro" placeholder="Otro" required >-->

<!--                                            </div>-->
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
                                            <span><?php echo $textosArray[136];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="resultado" id="resultado">
                                                    <option value="">---</option>
                                                    <option value="Satisfactorio">Satisfactorio</option>
                                                    <option value="En proceso">En proceso</option>
                                                    <option value="Con observaciones">Con observaciones</option>
                                                    <option value="0 No Conformidades">0 No Conformidades</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

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
                                            <span><?php echo $textosArray[72];?></span>
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
                                            <span><?php echo $textosArray[66];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="Distintivo" id="Distintivo">
                                                    <option value="">--</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group" style="display: none !important;" id="divDistintivoText">
                                            <span><?php echo $textosArray[66];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="DistintivoText" id="DistintivoText" placeholder="Distintivo" required >

                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->





                                    </div>

                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary guardarRevision" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal demanda interna -->



    </section>
    <!-- /.content -->
</div>


<script>


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
        $("#multa").change(function ()
        {
            var distintivo=$("#multa").val();
            if (distintivo=='Si')
            {
                $("#camposMULTAS").show();

            }
            if (distintivo=='No')
            {
                $("#camposMULTAS").hide();

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
                $("#divOtroMotivo").hide();
                $("#divOtroMotivo").val('');


            }
           //  var motivo5=$("#motivo5").val();
           // alert(motivo5);

        });


            $("#moneda").change(function () {

            var valorMoneda = $('option:selected', this).attr('idmoneda');

            // alert(option);
            // console.log(option);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            var monto = $("#monto").val();//tomar el atributo

            var cuenta=(monto * valorMoneda);
            var conDecimal = cuenta.toFixed(2);

            $("#montoMXN").val(conDecimal);
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
                        if(n=='-1')
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

        $(".guardarRevision").click(function ()
        {

            var dataString = $('#frmRegRev').serializeArray();
            var camposFaltantes=[];
            console.log(dataString);
            $.each(dataString   , function(i, field){
                var nombrecampo=field.name;
                var valorCampo=field.value;

                if (valorCampo=="")
                {
                    if (nombrecampo=="fechaPagoMulta" || nombrecampo=="monto" || nombrecampo=="montoMXN" || nombrecampo=="moneda" || nombrecampo=="medioText"|| nombrecampo=="DistintivoText" )
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
                var funcion = "guardarRevision";
                var num_EmpleadoActive = $("#num_EmpleadoActive").val();
                var nombre = $("#nombre").val();
                var localidad = $("#localidad").val();
                var pais = $("#pais").val();
                var puesto = $("#puesto").val();
                var inicioRevision = $("#inicioRevision").val();
                var terminoRevision = $("#terminoRevision").val();
                var motivo = $("#motivo").val();
                var fechaPagoMulta = $("#fechaPagoMulta").val();
                var monto = $("#monto").val();
                var montoMXN = $("#montoMXN").val();
                var tipoRev = $("#tipoRev").val();
                var region = $("#region").val();
                var areaRevisada = $("#areaRevisada").val();
                var medios =  JSON.stringify($('[name="medios[]"]').serializeArray());
                var resultado = $("#resultado").val();
                var observaciones = $("#observaciones").val();
                var estatus = $("#estatus").val();
                var Distintivo = $("#Distintivo").val();
                var multa = $("#multa").val();
                var DistintivoText = $("#DistintivoText").val();
                var medioText = $("#medioText").val();
                var moneda = $("#moneda").val();

                // var idmoneda = $("#moneda").attr("idmoneda");
                // alert(medios);


                datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
                datos.append("num_EmpleadoActive", num_EmpleadoActive);
                datos.append("nombre", nombre);
                datos.append("localidad", localidad);
                datos.append("pais", pais);
                datos.append("puesto", puesto);
                datos.append("inicioRevision", inicioRevision);
                datos.append("terminoRevision", terminoRevision);
                datos.append("motivo", motivo);
                datos.append("fechaPagoMulta", fechaPagoMulta);
                datos.append("monto", monto);
                datos.append("montoMXN", montoMXN);
                datos.append("tipoRev", tipoRev);
                datos.append("region", region);
                datos.append("areaRevisada", areaRevisada);
                datos.append("medios", medios);
                datos.append("resultado", resultado);
                datos.append("observaciones", observaciones);
                datos.append("estatus", estatus);
                datos.append("Distintivo", Distintivo);
                datos.append("multa", multa);
                datos.append("DistintivoText", DistintivoText);
                datos.append("medioText", medioText);
                datos.append("moneda", moneda);


                $.ajax({
                    url: "ajax/revisiones.ajax.php",
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

        $(".cerrarDemanda").click(function () {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
            var idRevision = $(this).attr("idRevision");
            // alert('hola');

            var datos = new FormData();
            var funcion = "cerrarDemanda";

            var fechaCierre = $("#fechaCierre_" + demandaID).val();
            // var demandaID      = $("#demandaID_").val();
            var ICBML = $("#ICBML_" + demandaID).val();
            var ICNML = $("#ICNML_" + demandaID).val();
            var ICBMXN = $("#ICBMXN_" + demandaID).val();
            var ICNMXN = $("#ICNMXN_" + demandaID).val();


            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

            datos.append("fechaCierre", fechaCierre);
            datos.append("demandaID", demandaID);
            datos.append("ICBML", ICBML);
            datos.append("ICNML", ICNML);
            datos.append("ICBMXN", ICBMXN);
            datos.append("ICNMXN", ICNMXN);


            $.ajax({
                url: "ajax/demandas.ajax.php",
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




        $(".archivoRevision").click(function()
        {
            var idR = $(this).attr("idR");
            var datos = new FormData();
            var funcion         ="subirArchivoRevision";
            var idRevision       = $("#idRevision"+idR).val();
            var idUser       = $("#idUser").val();
            var file         =  $("#fileInterna"+idR)[0].files[0];
            console.log(file);
            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("idRevision", idRevision);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idUser", idUser);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/revisiones.ajax.php",
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
        $(".guardarReporte").click(function()
        {
            var datos = new FormData();
            var funcion         ="subirReporteAbogado";
            var usuario       = $("#usuarioAb").val();
            var division       = $("#DivisionAb").val();
            var idUser       = $("#idUser").val();
            var file         =  $("#fileReporteAbogado")[0].files[0];
            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("usuario", usuario);//PARA MANDARLO A LA VARIABLE datos
            datos.append("division", division);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
            datos.append("idUser", idUser);
            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/demandas.ajax.php",
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


        $(".btnEliminarRevision").click(function()
        {

            var idRevision = $(this).attr("idRevision");
            var dataForm = new FormData();
            var funcion="eliminarRevision";
            dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            dataForm.append("idRevision", idRevision);//PARA MANDARLO A LA VARIABLE datos


            Swal.fire({
                title: '<?php echo $textosArray[7];?>',
               // text: "Si no es asi puedes presionar el boton cancelar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    // window.location = "usuarios";

                    $.ajax({
                        url:"ajax/revisiones.ajax.php",
                        method: "POST",
                        data: dataForm,
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
                                    text: '¡Eliminado!',
                                    icon: 'success',
                                    confirmButtonText:'Ok'
                                }).then((result)=>{
                                    if(result.value){
                                        location.reload();
                                    }
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    title: 'Warning!',
                                    text: '¡Eliminado de manera exitosa!',
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

                    });

                }
            })
        });
//--------------------------------------------Editar Revision
        $("#motivo5Edit").change(function ()
        {
            var idRevision = $(this).attr('idRevision');
            alert(idRevision);
            if ($(this).is(':checked'))
            {
                // Do something...
                // alert('You can rock now...');
                $("#divOtroMotivoEdit"+idRevision).show();

            }
            else
            {
                $("#divOtroMotivoEdit"+idRevision).hide();
                $("#medioTextEdit"+idRevision).val('');



            }
            //  var motivo5=$("#motivo5").val();
            // alert(motivo5);

        });



        $(".guardarEdicionRevision").click(function ()
        {

            var datos = new FormData();
            var funcion = "guardarEdicionRevision";
            var idRevision=$(this).attr("idRevision");
            var motivo = $("#motivoEdit"+idRevision).val();
            var region = $("#regionEdit"+idRevision).val();
            var areaRevisada = $("#areaRevisadaEdit"+idRevision).val();
            var medios =  JSON.stringify($('[name="mediosEdit[]'+idRevision+'"]').serializeArray());
            var medioText = $("#medioTextEdit"+idRevision).val();
            var observaciones = $("#observacionesEdit"+idRevision).val();
            var estatus = $("#estatusEdit"+idRevision).val();
            var inicioRevisionEdit = $("#inicioRevisionEdit"+idRevision).val();
            var finRevisionEdit = $("#finRevisionEdit"+idRevision).val();
            var multaEdit = $("#multaEdit"+idRevision).val();
            var tipoRevEdit = $("#tipoRevEdit"+idRevision).val();


            // var idmoneda = $("#moneda").attr("idmoneda");
            // alert(medios);

            datos.append("motivo", motivo);
            datos.append("region", region);
            datos.append("areaRevisada", areaRevisada);
            datos.append("medios", medios);
            datos.append("medioText", medioText);
            datos.append("observaciones", observaciones);
            datos.append("estatus", estatus);
            datos.append("inicioRevisionEdit", inicioRevisionEdit);
            datos.append("finRevisionEdit", finRevisionEdit);
            datos.append("multaEdit", multaEdit);
            datos.append("tipoRevEdit", tipoRevEdit);
            datos.append("funcion", funcion);
            datos.append("idRevision", idRevision);


            $.ajax({
                url: "ajax/revisiones.ajax.php",
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


//----------------------------------------------------------------------------------


    });
</script>

