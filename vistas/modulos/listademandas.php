<?php
//echo "<pre>";
//print_r($_POST['paisSelect']);
//echo "</pre>";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//echo "<pre>";
//print_r($reportes);
//echo "</pre>";
//echo $_POST['paisSelect'];
$divisionesDisponibles="";
if ( $_SESSION['id_perfil']==1)
{
    $divisionesDisponibles="ALL";
}
elseif ($_SESSION['id_perfil']==5 || $_SESSION['id_perfil']==4 || $_SESSION['id_perfil']==2 )
{
    $divisionesDisponibles=$_SESSION['divisiones'];
}

$proveedor = ControladorProveedores::ctrMostrarProveedoresSindicato($_POST['paisSelect']);
$reportes=ControladorDemandas::ctrVisualizarReportes($divisionesDisponibles);
$demandas= ControladorDemandas::ctrDemandasInternasxPais($_POST['paisSelect'],$divisionesDisponibles);
$demandasEX= ControladorDemandas::ctrDemandasExternasxPais($_POST['paisSelect'],$divisionesDisponibles);
//ese max

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[63];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[63];?></li>
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
                <div class="btn-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalDemandaInterna"><?php echo $textosArray[118];?></button>
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalDemandaExterna"><?php echo $textosArray[117];?></button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalReporteAbogados"><?php echo $textosArray[35];?></button>
                <button class="btn btn-success " data-toggle="modal" data-target="#modalVisualizarReportes"><?php echo $textosArray[135];?></button>
                </div>
                <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                <input type="hidden" name="paisSES" id="paisSES" value="<?php echo $_SESSION['pais'];?>">
                <input type="hidden" name="idPerfilSES" id="idPerfilSES" value="<?php echo $_SESSION['id_perfil'];?>">

            </div>
        </div>
        <br><br>
<div class="modal fade" id="modalVisualizarReportes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[265];?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped tabladatatable" >
                            <thead>
                            <tr>

                                <th width="5" scope="col"><?php echo $textosArray[77];?></th>
                                <th width="5" scope="col"><?php echo $textosArray[67];?></th>
                                <th width="5" scope="col"><?php echo $textosArray[150];?></th>
                                <th width="5" scope="col"><?php echo $textosArray[40];?></th>
                                <th width="5" scope="col"><?php echo $textosArray[25];?></th>


                            </tr>
                            </thead>
                            <tbody>
                        <?php

                        foreach ($reportes as $key => $rep)
                        {

                        echo'  <tr><td> <span class="input-group-addon ">'.utf8_encode($rep->fecha_alta).'</span></td>  
                               <td><span class="input-group-addon ">'.utf8_encode($rep->division).'</span></td>';

                                if ($rep->num_empleado=="Externo" && $rep->nombre_usuario=="")
                                {
                                echo'<td><input type="text" class="form-control input-sm " readonly value="'.$rep->usuario.'"> </td>';

                                }
                                elseif ($rep->num_empleado=="Externo" && $rep->nombre_usuario!="")
                                {
                                    echo'<td><input type="text" class="form-control input-sm " readonly value="'.$rep->nombre_usuario.'"></td>';

                                }
                                elseif ($rep->num_empleado!="Externo")
                                {
                                    $empleado=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($rep->num_empleado);
                                    foreach ($empleado as $key => $emp)
                                    {
                                    echo '<td><input type="text" class="form-control input-sm " readonly value="' . $emp->nombre . '"></td>';
                                    }
                                }
                                if($rep->comentario!=null) {
                                    echo '<td><span class="input-group-addon ">' . $rep->comentario . '</span></td>
                                    ';
                                }
                                else if($rep->comentario==null || $rep->comentario==''){
                                    echo '<td></td>';
                                }
                                echo '<td><a class="btn btn-dark" download href="/relaciones/vistas/archivos/reportesDemandas/' . utf8_encode($rep->archivo) . '"><i class="fa fa-download"></i></a></td>';
                                echo ' </tr>';
                        }

                        ?>
                            </tbody>
                        </table>
                       </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                    </div>
                </div>
            </div>
        </div>





        <div id="accordion">
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++     accordion internas  abiertas    -->
            <div class="card">
                <div class="card-header" id="headingOne" style="background-color: #002554 !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: white !important;">
                            <?php echo $textosArray[64];?>
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
<!--                        <div class="card" >-->
<!--                            <div class="card-body">-->
                                <table class="table table-striped tablaDescargaReportes dt-responsive" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="20%" ></th>
                                        <th width="16%" ><?php echo $textosArray[110];?></th>
                                        <th width="16%" ><?php echo $textosArray[70];?></th>
                                        <th width="16%" ><?php echo $textosArray[126];?></th>
                                        <th width="16%" ><?php echo $textosArray[169];?></th>
                                        <th width="16%" ><?php echo $textosArray[31];?></th>
                                        <th width="6%" ><?php echo $textosArray[72];?></th>
                                        <th class="d-none" width="6%" >Fecha Baja</th>
                                        <th class="d-none" width="6%" >Fecha Ingreso</th>
                                        <th class="d-none" width="6%" >Antiguedad</th>
                                        <th class="d-none" width="6%" >Motivos de salida</th>
                                        <th class="d-none" width="6%" >Riesgo</th>
                                        <th class="d-none" width="6%" >CECO</th>
                                        <th class="d-none" width="6%" >Contingencia Inicial Local</th>
                                        <th class="d-none" width="6%" >Contingencia Abogados Local</th>
                                        <th class="d-none" width="6%" >Contingencia Inicial MXN</th>
                                        <th class="d-none" width="6%" >Contingencia Sbogados MXN</th>
                                        <th class="d-none" width="6%" >Fecha cierre</th>
                                        <th class="d-none" width="6%" >Cierre Bruto Local</th>
                                        <th class="d-none" width="6%" >Cierre Neto Local</th>
                                        <th class="d-none" width="6%" >Cierre Bruto MXN</th>
                                        <th class="d-none" width="6%" >Cierre Neto MXN</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
//                                                      echo "<pre>";
//                                                      print_r($demandas);
//                                                      echo "</pre>";
                                    //   echo "aqui<br>";
                                    foreach ($demandas as $key => $value)
                                    {
                                        if($value->fecha_cierre!='' || $value->fecha_cierre!=null)
                                        {
                                            continue;
                                        }
                                        echo'<tr>';
//                                        if ($value->fecha_cierre!='' || $value->fecha_cierre!=null)
//                                        {
//                                            echo '<td  align="center"><div class="btn-group">
//                                               <button class="btn btn-dark btn-md" data-toggle="modal" data-target="#detallesDemanda_'.$value->id.'"><i class="fa fa-clipboard-list"></i></button>
//                                             <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$value->id.'"><i class="fa fa-list"></i></button>
//
//
//
//                                            </div>';
//                                        }
                                        if($value->fecha_cierre=='' || $value->fecha_cierre==null)
                                        {
                                            echo '<td><div class="btn-group">
                                       <button class="btn btn-primary" data-toggle="modal" data-target="#subirArchivo_'.$value->id.'"><i class="fa fa-upload"></i></button>
                                       <button class="btn btn-warning" data-toggle="modal" data-target="#cerrarCaso_'.$value->id.'"><i class="fa fa-calendar"></i></button>
                        
                                       <button class="btn btn-success " data-toggle="modal" data-target="#editarDemanda_'.$value->id.'"><i class="fa fa-edit"></i></button>
                                       <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$value->id.'"><i class="fa fa-list"></i></button>
                                    </div>';
                                        }

                                            echo'<td>'.$value->num_empleado.'</td>
                                            <td>'.utf8_encode($value->nombre).'</td>
                                          <td>'.utf8_encode($value->pais).'</td>
                                          <td>'.utf8_encode($value->nombre_vicepresidencia).'</td>
                                          <td>'.utf8_encode($value->nombre_area).'</td>
                                          <td>'.utf8_encode($value->estatus).'</td>

                                          <td class="d-none">'.utf8_encode($value->fecha_ingreso).'</td>
                                          <td class="d-none">'.utf8_encode($value->fecha_baja).'</td>
                                          <td class="d-none">'.utf8_encode($value->antiguedad).'</td>
                                          <td class="d-none">'.utf8_encode($value->motivo_salida).'</td>
                                          <td class="d-none">'.utf8_encode($value->riesgo).'</td>
                                          <td class="d-none">'.utf8_encode($value->CECO).'</td>

                                          <td class="d-none">'.utf8_encode($value->contingencia_inicial_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_abogados_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_inicial_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_abogados_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->fecha_cierre).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_bruto_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_neto_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_bruto_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_neto_MXN).'</td>
                                          ';


                                        echo'</td>

        </tr>
        
          <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Historial de Archivos de la demanda #'.$value->id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                                        $archivosIN=ControladorDemandas::ctrMostrarHistorialArchivosxDemanda($value->id);
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
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/demandas/'.utf8_encode($arIN->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arIN->fecha_alta).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Subir Archivo a demanda '.$value->id.'</h5>
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
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                               </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary archivoDemandaInterna" IdDemandaInterna="'.$value->id.'" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
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
                    <form role="form" method="post" enctype="multipart/form-data" >
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
              <!-- Modal Cerrar Demanda -->
        <div  id="cerrarCaso_'.$value->id.'" name="cerrarCaso_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Cierre de demanda '.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                       <input type="date" class="form-control input-lg" name="fechaCierre_'.$value->id.'" id="fechaCierre_'.$value->id.'" placeholder="Fecha de Cierre" required>
                                       <input type="hidden" class="form-control input-lg" name="demandaID" id="demandaID" value="'.$value->id.'" required>

                                    </div>
                                </div><!-- ./ form-gruop-->
                               	<div class="form-group">
                                                <span>Importe de Cierre Bruto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICBML_'.$value->id.'" id="ICBML_'.$value->id.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Importe de Cierre Neto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICNML" id="ICNML_'.$value->id.'"  required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Importe de Cierre Bruto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICBMXN" id="ICBMXN_'.$value->id.'" placeholder="ICBMXN_'.$value->id.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Importe de Cierre Neto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICNMXN_'.$value->id.'" id="ICNMXN_'.$value->id.'" placeholder="ICNMXN" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                            <span>Moneda</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg monedaCierre" id="'.$value->id.'" >
                                                    <option value="">Seleccione una moneda</option>';

                                        $moneda=ControladorDemandas::ctrMonedas();

                                        foreach ($moneda as $key => $valmoneda)
                                        {
                                            echo ' <option  idmoneda="'.$valmoneda->diferencia_mxn.'" value="'.$valmoneda->id.'">'.$valmoneda->nombre_moneda. ' <--> '.$valmoneda->diferencia_mxn.'MXN</option>';
                                        }

                                        echo'</select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->



                            </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary cerrarDemanda" idDemanda="'.$value->id.'">Cerrar Demanda</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal cerrar demanda-->

            <!-- Modal editar Demanda -->
        <div  id="editarDemanda_'.$value->id.'" name="editarDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Editar Demanda Interna #'.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                            

                                        <div class="form-group">
                                            <span>Estatus</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcionEdit" id="descripcionEdit'.$value->id.'">'.$value->estatus.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                             
                             
                                        	<div class="form-group">
                                                <span>Contingencia Inicial (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIML_'.$value->id.'" id="CIML_'.$value->id.'" value="'.$value->contingencia_inicial_local.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Contingencia Abogados (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg CAML" idDemanda="'.$value->id.'" name="CAML_" id="CAML_'.$value->id.'"  value="'.$value->contingencia_abogados_local.'" required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Contingencia Inicial (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CIMXN_" id="CIMXN_'.$value->id.'"  value="'.$value->contingencia_inicial_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Contingencia Abogados (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CAMXN_'.$value->id.'" id="CAMXN_'.$value->id.'"  value="'.$value->contingencia_abogados_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!--------------------------Agregado por Francisco------------------------->
                                        <div class="form-group">
                                            <span>Provision demanda (Moneda Local)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="PDML_'.$value->id.'" id="PDML_'.$value->id.'" placeholder="PDML" required readonly>
                                            </div>
                                        </div>
                                        <!--------------------------------------------------->
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                                <span>Moneda</span>';

                                        $monedaActual=$value->id_moneda;
                                        $monedaEdit=ControladorDemandas::ctrMonedas();

                                        echo'<div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                <select class="form-control input-lg monedaEdit"  name="monedaEdit'.$value->id.'" id="monedaEdit'.$value->id.'" idDemanda="'.$value->id.'" >
                                                        <option value="">Seleccione una moneda</option>';

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

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary guardarEdicion" idDemanda="'.$value->id.'">Guardar Edicion</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal editar demanda-->
        
 
      
        
        ';
                                    }

                                    ?>

                                    </tbody>
                                </table>
<!--                            </div>-->
<!--                        </div>-->



                    </div>
                </div>
            </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     accordion externas  abiertas    -->
            <div class="card">
                <div class="card-header" id="headingTwo" style="background-color: #002554 !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: #ffffff !important; ">
                            <?php echo $textosArray[266];?>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-body">
<!--                            <div class="card" >-->
<!--                                <div class="card-body">-->
                                    <table class="table table-striped tablaDescargaReportes dt-responsive" width="100%">
                                        <thead>
                                        <tr>
                                            <th width="16%" ><?php echo $textosArray[110];?></th>
                                            <th width="16%" ><?php echo $textosArray[70];?></th>
                                            <th width="16%" ><?php echo $textosArray[126];?></th>
                                            <th width="16%" ><?php echo $textosArray[169];?></th>
                                            <th width="16%" ><?php echo $textosArray[31];?></th>
                                            <th width="6%" ><?php echo $textosArray[72];?></th>
                                            <th class="d-none" width="6%" >Fecha Baja</th>
                                            <th class="d-none" width="6%" >Antiguedad</th>
                                            <th class="d-none" width="6%" >Motivos de salida</th>
                                            <th class="d-none" width="6%" >Riesgo</th>
                                            <th class="d-none" width="6%" >CECO</th>
                                            <th class="d-none" width="6%" >Contingencia Inicial Local</th>
                                            <th class="d-none" width="6%" >Contingencia Abogados Local</th>
                                            <th class="d-none" width="6%" >Contingencia Inicial MXN</th>
                                            <th class="d-none" width="6%" >Contingencia Sbogados MXN</th>
                                            <th class="d-none" width="6%" >Fecha cierre</th>
                                            <th class="d-none" width="6%" >Cierre Bruto Local</th>
                                            <th class="d-none" width="6%" >Cierre Neto Local</th>
                                            <th class="d-none" width="6%" >Cierre Bruto MXN</th>
                                            <th class="d-none" width="6%" >Cierre Neto MXN</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php
//                                                          echo "<pre>";
//                                                          print_r($demandasEX);
//                                                          echo "</pre>";
                                        //   echo "aqui<br>";
                                        foreach ($demandasEX as $key => $valueEX)
                                        {

                                            if($valueEX->fecha_cierre!='' || $valueEX->fecha_cierre!=null)
                                            {
                                                continue;
                                            }
                                            echo'<tr>';
                                            if ($valueEX->fecha_cierre!='' || $valueEX->fecha_cierre!=null)
                                            {
                                                echo '<td  align="center"><div class="btn-group">
                                               <button class="btn btn-dark btn-md" data-toggle="modal" data-target="#detallesDemanda_'.$valueEX->id.'"><i class="fa fa-clipboard-list"></i></button>
                                             <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$valueEX->id.'"><i class="fa fa-list"></i></button>
                    
                                
                                
                                            </div>';
                                            }
                                            elseif($valueEX->fecha_cierre=='' || $valueEX->fecha_cierre==null)
                                            {
                                                echo '<td><div class="btn-group">
                                       <button class="btn btn-primary" data-toggle="modal" data-target="#subirArchivo_'.$valueEX->id.'"><i class="fa fa-upload"></i></button>
                                       <button class="btn btn-warning" data-toggle="modal" data-target="#cerrarCaso_'.$valueEX->id.'"><i class="fa fa-calendar"></i></button>
                        
                                       <button class="btn btn-success " data-toggle="modal" data-target="#editarDemanda_'.$valueEX->id.'"><i class="fa fa-edit"></i></button>
                                       <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$valueEX->id.'"><i class="fa fa-list"></i></button>
                                    </div>';
                                            }

                                            echo'<td>'.utf8_encode($valueEX->num_empleado).'</td>
                                            <td>'.$valueEX->nombre.'</td>
                                          <td>'.utf8_encode($valueEX->pais).'</td>
                                          <td>'.utf8_encode($valueEX->nombre_vicepresidencia).'</td>
                                          <td>'.utf8_encode($valueEX->nombre_area).'</td>
                                          <td>'.utf8_encode($valueEX->estatus).'</td>
                                          
                                          
                                           <td class="d-none">'.utf8_encode($valueEX->fecha_baja).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->antiguedad).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->motivo_salida).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->riesgo).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->CECO).'</td>


                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_inicial_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_abogados_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_inicial_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_abogados_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->fecha_cierre).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_bruto_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_neto_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_bruto_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_neto_MXN).'</td>
                                          ';


                                            echo'</td>

        </tr>
        
        <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$valueEX->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Historial de Archivos de la demanda #'.$valueEX->id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                                            $archivosEX=ControladorDemandas::ctrMostrarHistorialArchivosxDemanda($valueEX->id);
//                                    echo "<pre>";
//                                    print_r($archivosEX);
//                                    echo "</pre>";
                                            foreach ($archivosEX as $key => $arEX)
                                            {

                                                echo'<div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arEX->nombre).'</span>
                                              </div>
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/demandas/'.utf8_encode($arEX->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arEX->fecha_alta).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

                                                if ($arEX->num_empleado=="Externo")
                                                {
                                                    echo'<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="'.$arEX->usuario.'">';

                                                }
                                                elseif ($arEX->num_empleado!="Externo")
                                                {
                                                    $empleado2=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($arEX->num_empleado);
                                                    foreach ($empleado2 as $key => $emp2)
                                                    {
                                                        echo '<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="' . $emp2->nombre . '">';
                                                    }
                                                }

                                                echo '</div>
                                        </div>
                                        
                                        
                                        ';


                                            }
                                            echo '</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
        
          <!-- Modal Archivos historial -->
      
        
          <!-- Modal Subir Archivo-->
            <div class="modal fade" id="subirArchivo_'.$valueEX->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Subir Archivo a demanda '.$valueEX->id.'</h5>
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

                                                        <input type="file" class="form-control input-lg " name="fileExterna" id="fileExterna'.$valueEX->id.'">

                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                                  </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary archivoDemandaExterna" IdDemandaExterna="'.$valueEX->id.'">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Modal Subir archivo Demanda -->

        
        
               <!-- Modal detalles Demanda -->
        <div  id="detallesDemanda_'.$valueEX->id.'" name="detallesDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda '.$valueEX->id.'</h4>
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
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Numero de empleado</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->num_empleado.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Pais</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->pais.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>VP</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre_vicepresidencia.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Area</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre_area.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" class="form-control input-lg" value="'.$valueEX->fecha_cierre.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Importe de Cierre Bruto (Moneda Local)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_bruto_local.'" readonly onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                            
                                <div class="form-group">
                                    <span>Importe de Cierre Neto (Moneda Local)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_neto_local.'" readonly onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Importe de Cierre Bruto (MXN)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_bruto_MXN.'" readonly >
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                            
                                <div class="form-group">
                                    <span>Importe de Cierre Neto (MXN)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_neto_MXN.'" readonly >
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
              <!-- Modal Cerrar Demanda -->
        <div  id="cerrarCaso_'.$valueEX->id.'" name="cerrarCaso_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda '.$valueEX->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                       <input type="date" class="form-control input-lg" name="fechaCierre_'.$valueEX->id.'" id="fechaCierre_'.$valueEX->id.'" placeholder="Fecha de Cierre" required>
                                       <input type="hidden" class="form-control input-lg" name="demandaID" id="demandaID" value="'.$valueEX->id.'" required>

                                    </div>
                                </div><!-- ./ form-gruop-->
                               	<div class="form-group">
                                                <span>Importe de Cierre Bruto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICBML_'.$valueEX->id.'" id="ICBML_'.$valueEX->id.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Importe de Cierre Neto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICNML" id="ICNML_'.$valueEX->id.'" required onKeyPress="return soloNumeros(event)">                        
                                                    
                                                  </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Importe de Cierre Bruto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICBMXN" id="ICBMXN_'.$valueEX->id.'" placeholder="ICBMXN_'.$valueEX->id.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Importe de Cierre Neto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICNMXN_'.$valueEX->id.'" id="ICNMXN_'.$valueEX->id.'" placeholder="ICNMXN" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                            <span>Moneda</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg monedaCierre" id="'.$valueEX->id.'" >
                                                    <option value="">Seleccione una moneda</option>';

                                            $moneda=ControladorDemandas::ctrMonedas();

                                            foreach ($moneda as $key => $valmoneda)
                                            {
                                                echo ' <option  idmoneda="'.$valmoneda->diferencia_mxn.'" value="'.$valmoneda->id.'">'.$valmoneda->nombre_moneda. ' <--> '.$valmoneda->diferencia_mxn.'MXN</option>';
                                            }

                                            echo'</select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->



                            </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary cerrarDemanda" idDemanda="'.$valueEX->id.'">Cerrar Demanda</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal cerrar demanda-->
        
            <!-- Modal editar Demanda -->
        <div  id="editarDemanda_'.$valueEX->id.'" name="editarDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Editar Demanda  Externa #'.$valueEX->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                            

                                        <div class="form-group">
                                            <span>Estatus</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcionEdit'.$valueEX->id.'" id="descripcionEdit'.$valueEX->id.'">'.$valueEX->estatus.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                             
                             
                                        	<div class="form-group">
                                                <span>Contingencia Inicial (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIML_'.$valueEX->id.'" id="CIML_'.$valueEX->id.'" value="'.$valueEX->contingencia_inicial_local.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Contingencia Abogados (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CAML_" id="CAML_'.$valueEX->id.'"  value="'.$valueEX->contingencia_abogados_local.'" required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Contingencia Inicial (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CIMXN_" id="CIMXN_'.$valueEX->id.'"  value="'.$valueEX->contingencia_inicial_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Contingencia Abogados (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CAMXN_'.$valueEX->id.'" id="CAMXN_'.$valueEX->id.'"  value="'.$valueEX->contingencia_abogados_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                                <span>Moneda</span>';

                                            $monedaActual=$valueEX->id_moneda;
                                            $monedaEdit=ControladorDemandas::ctrMonedas();

                                            echo'<div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                <select class="form-control input-lg monedaEdit"  name="monedaEdit'.$valueEX->id.'" id="monedaEdit'.$valueEX->id.'" idDemanda="'.$valueEX->id.'">
                                                        <option value="">Seleccione una moneda</option>';

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

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary guardarEdicion" idDemanda="'.$valueEX->id.'">Guardar Edicion</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal editar demanda-->
        
        

      
        
        ';
                                        }

                                        ?>

                                        </tbody>
                                    </table>
<!--                                </div>-->
<!--                            </div>-->



                        </div>

                    </div>
                </div>
            </div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++     accordion internas  cerradas    -->
            <div class="card">
                <div class="card-header" id="heading4" style="background-color: black !important; color: white !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4" style="color: white !important;">
                            <?php echo $textosArray[268];?>
                        </button>
                    </h5>
                </div>

                <div id="collapse4" class="collapse " aria-labelledby="heading4" data-parent="#accordion">
                    <div class="card-body">
                        <!--                        <div class="card" >-->
                        <!--                            <div class="card-body">-->
                        <table class="table table-striped tablaDescargaReportes dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th width="20%" ></th>
                                <th width="16%" ><?php echo $textosArray[110];?></th>
                                <th width="16%" ><?php echo $textosArray[70];?></th>
                                <th width="16%" ><?php echo $textosArray[126];?></th>
                                <th width="16%" ><?php echo $textosArray[169];?></th>
                                <th width="16%" ><?php echo $textosArray[31];?></th>
                                <th width="6%" ><?php echo $textosArray[72];?></th>
                                <th class="d-none" width="6%" >Fecha Ingreso</th>
                                <th class="d-none" width="6%" >Fecha Baja</th>
                                <th class="d-none" width="6%" >Antiguedad</th>
                                <th class="d-none" width="6%" >Motivos de salida</th>
                                <th class="d-none" width="6%" >Riesgo</th>
                                <th class="d-none" width="6%" >CECO</th>
                                <th class="d-none" width="6%" >Contingencia Inicial Local</th>
                                <th class="d-none" width="6%" >Contingencia Abogados Local</th>
                                <th class="d-none" width="6%" >Contingencia Inicial MXN</th>
                                <th class="d-none" width="6%" >Contingencia Sbogados MXN</th>
                                <th class="d-none" width="6%" >Fecha cierre</th>
                                <th class="d-none" width="6%" >Cierre Bruto Local</th>
                                <th class="d-none" width="6%" >Cierre Neto Local</th>
                                <th class="d-none" width="6%" >Cierre Bruto MXN</th>
                                <th class="d-none" width="6%" >Cierre Neto MXN</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
                            //                                                      echo "<pre>";
                            //                                                      print_r($demandas);
                            //                                                      echo "</pre>";
                            //   echo "aqui<br>";
                            foreach ($demandas as $key => $value)
                            {
                                if($value->fecha_cierre=='' || $value->fecha_cierre==null)
                                {
                                    continue;
                                }
                                echo'<tr>';
                                if ($value->fecha_cierre!='' || $value->fecha_cierre!=null)
                                {
                                    echo '<td  align="center"><div class="btn-group">
                                               <button class="btn btn-dark btn-md" data-toggle="modal" data-target="#detallesDemanda_'.$value->id.'"><i class="fa fa-clipboard-list"></i></button>
                                             <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$value->id.'"><i class="fa fa-list"></i></button>
                    
                                
                                
                                            </div>';
                                }
//                                elseif($value->fecha_cierre=='' || $value->fecha_cierre==null)
//                                {
//                                    echo '<td><div class="btn-group">
//                                       <button class="btn btn-primary" data-toggle="modal" data-target="#subirArchivo_'.$value->id.'"><i class="fa fa-upload"></i></button>
//                                       <button class="btn btn-warning" data-toggle="modal" data-target="#cerrarCaso_'.$value->id.'"><i class="fa fa-calendar"></i></button>
//
//                                       <button class="btn btn-success " data-toggle="modal" data-target="#editarDemanda_'.$value->id.'"><i class="fa fa-edit"></i></button>
//                                       <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$value->id.'"><i class="fa fa-list"></i></button>
//                                    </div>';
//                                }

                                echo'<td>'.$value->num_empleado.'</td>
                                            <td>'.utf8_encode($value->nombre).'</td>
                                          <td>'.utf8_encode($value->pais).'</td>
                                          <td>'.utf8_encode($value->nombre_vicepresidencia).'</td>
                                          <td>'.utf8_encode($value->nombre_area).'</td>
                                          <td>'.utf8_encode($value->estatus).'</td>

                                          <td class="d-none">'.utf8_encode($value->fecha_baja).'</td>
                                          <td class="d-none">'.utf8_encode($value->fecha_ingreso).'</td>
                                          <td class="d-none">'.utf8_encode($value->antiguedad).'</td>
                                          <td class="d-none">'.utf8_encode($value->motivo_salida).'</td>
                                          <td class="d-none">'.utf8_encode($value->riesgo).'</td>
                                          <td class="d-none">'.utf8_encode($value->CECO).'</td>

                                          <td class="d-none">'.utf8_encode($value->contingencia_inicial_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_abogados_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_inicial_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->contingencia_abogados_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->fecha_cierre).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_bruto_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_neto_local).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_bruto_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($value->cierre_neto_MXN).'</td>
                                          ';


                                echo'</td>

        </tr>
        
          <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Historial de Archivos de la demanda #'.$value->id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                                $archivosIN=ControladorDemandas::ctrMostrarHistorialArchivosxDemanda($value->id);
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
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/demandas/'.utf8_encode($arIN->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arIN->fecha_alta).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Subir Archivo a demanda '.$value->id.'</h5>
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
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                               </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary archivoDemandaInterna" IdDemandaInterna="'.$value->id.'" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
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
                    <form role="form" method="post" enctype="multipart/form-data" >
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
              <!-- Modal Cerrar Demanda -->
        <div  id="cerrarCaso_'.$value->id.'" name="cerrarCaso_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Cierre de demanda '.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                       <input type="date" class="form-control input-lg" name="fechaCierre_'.$value->id.'" id="fechaCierre_'.$value->id.'" placeholder="Fecha de Cierre" required>
                                       <input type="hidden" class="form-control input-lg" name="demandaID" id="demandaID" value="'.$value->id.'" required>

                                    </div>
                                </div><!-- ./ form-gruop-->
                               	<div class="form-group">
                                                <span>Importe de Cierre Bruto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICBML_'.$value->id.'" id="ICBML_'.$value->id.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Importe de Cierre Neto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICNML" id="ICNML_'.$value->id.'"  required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Importe de Cierre Bruto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICBMXN" id="ICBMXN_'.$value->id.'" placeholder="ICBMXN_'.$value->id.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Importe de Cierre Neto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICNMXN_'.$value->id.'" id="ICNMXN_'.$value->id.'" placeholder="ICNMXN" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                            <span>Moneda</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg monedaCierre" id="'.$value->id.'" >
                                                    <option value="">Seleccione una moneda</option>';

                                $moneda=ControladorDemandas::ctrMonedas();

                                foreach ($moneda as $key => $valmoneda)
                                {
                                    echo ' <option  idmoneda="'.$valmoneda->diferencia_mxn.'" value="'.$valmoneda->id.'">'.$valmoneda->nombre_moneda. ' <--> '.$valmoneda->diferencia_mxn.'MXN</option>';
                                }

                                echo'</select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->



                            </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary cerrarDemanda" idDemanda="'.$value->id.'">Cerrar Demanda</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal cerrar demanda-->

            <!-- Modal editar Demanda -->
        <div  id="editarDemanda_'.$value->id.'" name="editarDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Editar Demanda  #'.$value->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                            

                                        <div class="form-group">
                                            <span>Estatus</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcionEdit" id="descripcionEdit'.$value->id.'">'.$value->estatus.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                             
                             
                                        	<div class="form-group">
                                                <span>Contingencia Inicial (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIML_'.$value->id.'" id="CIML_'.$value->id.'" value="'.$value->contingencia_inicial_local.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Contingencia Abogados (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg CAML_" idDemanda="'.$value->id.'" name="CAML_" id="CAML_'.$value->id.'"  value="'.$value->contingencia_abogados_local.'" required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Contingencia Inicial (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CIMXN_" id="CIMXN_'.$value->id.'"  value="'.$value->contingencia_inicial_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Contingencia Abogados (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CAMXN_'.$value->id.'" id="CAMXN_'.$value->id.'"  value="'.$value->contingencia_abogados_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!----------------------------------------------------------------------->
                                  
                                        <!----------------------------------------------------------------------->
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                                <span>Moneda</span>';

                                $monedaActual=$value->id_moneda;
                                $monedaEdit=ControladorDemandas::ctrMonedas();

                                echo'<div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                <select class="form-control input-lg monedaEdit"  name="monedaEdit'.$value->id.'" id="monedaEdit'.$value->id.'" idDemanda="'.$value->id.'" >
                                                        <option value="">Seleccione una moneda</option>';

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

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary guardarEdicion" idDemanda="'.$value->id.'">Guardar Edicion</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal editar demanda-->
        
 
      
        
        ';
                            }

                            ?>

                            </tbody>
                        </table>
                        <!--                            </div>-->
                        <!--                        </div>-->



                    </div>
                </div>
            </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     accordion externas  cerradas    -->

            <div class="card">
                <div class="card-header" id="heading3" style="background-color: black !important; color: white !important; ">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3" style="color: #ffffff !important; ">
                            <?php echo $textosArray[267];?>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-body">
                            <!--                            <div class="card" >-->
                            <!--                                <div class="card-body">-->
                            <table class="table table-striped tablaDescargaReportes dt-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="16%" ><?php echo $textosArray[110];?></th>
                                    <th width="16%" ><?php echo $textosArray[70];?></th>
                                    <th width="16%" ><?php echo $textosArray[126];?></th>
                                    <th width="16%" ><?php echo $textosArray[169];?></th>
                                    <th width="16%" ><?php echo $textosArray[31];?></th>
                                    <th width="6%" ><?php echo $textosArray[72];?></th>
                                    <th class="d-none" width="6%" >Fecha Baja</th>
                                    <th class="d-none" width="6%" >Antiguedad</th>
                                    <th class="d-none" width="6%" >Motivos de salida</th>
                                    <th class="d-none" width="6%" >Riesgo</th>
                                    <th class="d-none" width="6%" >CECO</th>
                                    <th class="d-none" width="6%" >Contingencia Inicial Local</th>
                                    <th class="d-none" width="6%" >Contingencia Abogados Local</th>
                                    <th class="d-none" width="6%" >Contingencia Inicial MXN</th>
                                    <th class="d-none" width="6%" >Contingencia Sbogados MXN</th>
                                    <th class="d-none" width="6%" >Fecha cierre</th>
                                    <th class="d-none" width="6%" >Cierre Bruto Local</th>
                                    <th class="d-none" width="6%" >Cierre Neto Local</th>
                                    <th class="d-none" width="6%" >Cierre Bruto MXN</th>
                                    <th class="d-none" width="6%" >Cierre Neto MXN</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php
                                //                                                          echo "<pre>";
                                //                                                          print_r($demandasEX);
                                //                                                          echo "</pre>";
                                //   echo "aqui<br>";
                                foreach ($demandasEX as $key => $valueEX)
                                {
                                    if($valueEX->fecha_cierre=='' || $valueEX->fecha_cierre==null)
                                    {
                                        continue;
                                    }
                                    echo'<tr>';
                                    if ($valueEX->fecha_cierre!='' || $valueEX->fecha_cierre!=null)
                                    {
                                        echo '<td  align="center"><div class="btn-group">
                                               <button class="btn btn-dark btn-md" data-toggle="modal" data-target="#detallesDemanda_'.$valueEX->id.'"><i class="fa fa-clipboard-list"></i></button>
                                             <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$valueEX->id.'"><i class="fa fa-list"></i></button>
                    
                                
                                
                                            </div>';
                                    }
//                                    elseif($valueEX->fecha_cierre=='' || $valueEX->fecha_cierre==null)
//                                    {
//                                        echo '<td><div class="btn-group">
//                                       <button class="btn btn-primary" data-toggle="modal" data-target="#subirArchivo_'.$valueEX->id.'"><i class="fa fa-upload"></i></button>
//                                       <button class="btn btn-warning" data-toggle="modal" data-target="#cerrarCaso_'.$valueEX->id.'"><i class="fa fa-calendar"></i></button>
//
//                                       <button class="btn btn-success " data-toggle="modal" data-target="#editarDemanda_'.$valueEX->id.'"><i class="fa fa-edit"></i></button>
//                                       <button class="btn btn-danger" data-toggle="modal" data-target="#historialArchivos_'.$valueEX->id.'"><i class="fa fa-list"></i></button>
//                                    </div>';
//                                    }

                                    echo'<td>'.utf8_encode($valueEX->num_empleado).'</td>
                                            <td>'.$valueEX->nombre.'</td>
                                          <td>'.utf8_encode($valueEX->pais).'</td>
                                          <td>'.utf8_encode($valueEX->nombre_vicepresidencia).'</td>
                                          <td>'.utf8_encode($valueEX->nombre_area).'</td>
                                          <td>'.utf8_encode($valueEX->estatus).'</td>
                                          
                                          
                                           <td class="d-none">'.utf8_encode($valueEX->fecha_baja).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->antiguedad).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->motivo_salida).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->riesgo).'</td>
                                            <td class="d-none">'.utf8_encode($valueEX->CECO).'</td>


                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_inicial_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_abogados_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_inicial_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->contingencia_abogados_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->fecha_cierre).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_bruto_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_neto_local).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_bruto_MXN).'</td>
                                          <td class="d-none">'.utf8_encode($valueEX->cierre_neto_MXN).'</td>
                                          ';


                                    echo'</td>

        </tr>
        
        <!-- Modal Archivos historial -->
                    <div class="modal fade" id="historialArchivos_'.$valueEX->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Historial de Archivos de la demanda #'.$valueEX->id.'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">';

                                    $archivosEX=ControladorDemandas::ctrMostrarHistorialArchivosxDemanda($valueEX->id);
//                                    echo "<pre>";
//                                    print_r($archivosEX);
//                                    echo "</pre>";
                                    foreach ($archivosEX as $key => $arEX)
                                    {

                                        echo'<div class="form-group">
                                          <div class="input-group">
                                              <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arEX->nombre).'</span>
                                              </div>
                                              <a class="btn btn-dark" download href="/relaciones/vistas/archivos/demandas/'.utf8_encode($arEX->archivo).'"><i class="fa fa-download"></i></a>
                                             &nbsp&nbsp

                                               <div class="input-group-text">
                                                <span class="input-group-addon ">'.utf8_encode($arEX->fecha_alta).'</span>
                                              </div>
                                               &nbsp&nbsp
                                               ';

                                        if ($arEX->num_empleado=="Externo")
                                        {
                                            echo'<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="'.$arEX->usuario.'">';

                                        }
                                        elseif ($arEX->num_empleado!="Externo")
                                        {
                                            $empleado2=ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($arEX->num_empleado);
                                            foreach ($empleado2 as $key => $emp2)
                                            {
                                                echo '<div class="input-group-text" style="background-color: #102554 !important; color: white !important;"><span >Subido por </span> </div><input type="text" class="form-control input-sm " readonly value="' . $emp2->nombre . '">';
                                            }
                                        }

                                        echo '</div>
                                        </div>
                                        
                                        
                                        ';


                                    }
                                    echo '</div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
        
          <!-- Modal Archivos historial -->
      
        
          <!-- Modal Subir Archivo-->
            <div class="modal fade" id="subirArchivo_'.$valueEX->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel">Subir Archivo a demanda '.$valueEX->id.'</h5>
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

                                                        <input type="file" class="form-control input-lg " name="fileExterna" id="fileExterna'.$valueEX->id.'">

                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                                  </div>
                                        </div>
                                   
                                </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary archivoDemandaExterna" IdDemandaExterna="'.$valueEX->id.'">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Modal Subir archivo Demanda -->

        
        
               <!-- Modal detalles Demanda -->
        <div  id="detallesDemanda_'.$valueEX->id.'" name="detallesDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda '.$valueEX->id.'</h4>
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
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Numero de empleado</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->num_empleado.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Pais</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->pais.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>VP</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre_vicepresidencia.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Area</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->nombre_area.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                        <input type="date" class="form-control input-lg" value="'.$valueEX->fecha_cierre.'" readonly>
                            
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Importe de Cierre Bruto (Moneda Local)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_bruto_local.'" readonly onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                            
                                <div class="form-group">
                                    <span>Importe de Cierre Neto (Moneda Local)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_neto_local.'" readonly onKeyPress="return soloNumeros(event)">
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                                <div class="form-group">
                                    <span>Importe de Cierre Bruto (MXN)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_bruto_MXN.'" readonly >
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->
                            
                                <div class="form-group">
                                    <span>Importe de Cierre Neto (MXN)</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" value="'.$valueEX->cierre_neto_MXN.'" readonly >
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
              <!-- Modal Cerrar Demanda -->
        <div  id="cerrarCaso_'.$valueEX->id.'" name="cerrarCaso_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda '.$valueEX->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <span>Fecha de cierre</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                        </div>
                                       <input type="date" class="form-control input-lg" name="fechaCierre_'.$valueEX->id.'" id="fechaCierre_'.$valueEX->id.'" placeholder="Fecha de Cierre" required>
                                       <input type="hidden" class="form-control input-lg" name="demandaID" id="demandaID" value="'.$valueEX->id.'" required>

                                    </div>
                                </div><!-- ./ form-gruop-->
                               	<div class="form-group">
                                                <span>Importe de Cierre Bruto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICBML_'.$valueEX->id.'" id="ICBML_'.$valueEX->id.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Importe de Cierre Neto (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ICNML" id="ICNML_'.$valueEX->id.'" required onKeyPress="return soloNumeros(event)">                        
                                                    
                                                  </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Importe de Cierre Bruto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICBMXN" id="ICBMXN_'.$valueEX->id.'" placeholder="ICBMXN_'.$valueEX->id.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Importe de Cierre Neto (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="ICNMXN_'.$valueEX->id.'" id="ICNMXN_'.$valueEX->id.'" placeholder="ICNMXN" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                            <span>Moneda</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg monedaCierre" id="'.$valueEX->id.'" >
                                                    <option value="">Seleccione una moneda</option>';

                                    $moneda=ControladorDemandas::ctrMonedas();

                                    foreach ($moneda as $key => $valmoneda)
                                    {
                                        echo ' <option  idmoneda="'.$valmoneda->diferencia_mxn.'" value="'.$valmoneda->id.'">'.$valmoneda->nombre_moneda. ' <--> '.$valmoneda->diferencia_mxn.'MXN</option>';
                                    }

                                    echo'</select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->



                            </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary cerrarDemanda" idDemanda="'.$valueEX->id.'">Cerrar Demanda</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal cerrar demanda-->
        
            <!-- Modal editar Demanda -->
        <div  id="editarDemanda_'.$valueEX->id.'" name="editarDemanda_" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Editar Demanda  #'.$valueEX->id.'</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                            

                                        <div class="form-group">
                                            <span>Estatus</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcionEdit'.$valueEX->id.'" id="descripcionEdit'.$valueEX->id.'">'.$valueEX->estatus.'</textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                             
                             
                                        	<div class="form-group">
                                                <span>Contingencia Inicial (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIML_'.$valueEX->id.'" id="CIML_'.$valueEX->id.'" value="'.$valueEX->contingencia_inicial_local.'"  required  onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Contingencia Abogados (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg CAML_" name="CAML_" id="CAML_'.$valueEX->id.'" idCAML="'.$valueEX->id.'"  value="'.$valueEX->contingencia_abogados_local.'" required onKeyPress="return soloNumeros(event)">  
                                                 </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                             <div class="form-group">
                                                <span>Contingencia Inicial (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CIMXN_" id="CIMXN_'.$valueEX->id.'"   value="'.$valueEX->contingencia_inicial_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                                <span>Contingencia Abogados (MXN)</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CAMXN_'.$valueEX->id.'" id="CAMXN_'.$valueEX->id.'"  value="'.$valueEX->contingencia_abogados_MXN.'" required readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                                <div class="form-group">
                                                <span>Moneda</span>';

                                    $monedaActual=$valueEX->id_moneda;
                                    $monedaEdit=ControladorDemandas::ctrMonedas();

                                    echo'<div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                <select class="form-control input-lg monedaEdit"  name="monedaEdit'.$valueEX->id.'" id="monedaEdit'.$valueEX->id.'" idDemanda="'.$valueEX->id.'">
                                                        <option value="">Seleccione una moneda</option>';

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

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary guardarEdicion" idDemanda="'.$valueEX->id.'">Guardar Edicion</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->
        <!-- fin modal editar demanda-->
        
        

      
        
        ';
                                }

                                ?>

                                </tbody>
                            </table>
                            <!--                                </div>-->
                            <!--                            </div>-->



                        </div>

                    </div>
                </div>
            </div>

        </div>




        <!-- Modal modalReporteAbogados -->
        <div  id="modalReporteAbogados" name="modalReporteAbogados" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[134];?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <span><?php echo $textosArray[10];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="usuarioAb" id="usuarioAb">
                                                        <?php
                                                        if($_SESSION['id_perfil']==1)
                                                        {
                                                            $abogados=ControladorUsuarios::ctrAbogados();
                                                        echo ' <option value="">---</option>';
                                                            foreach ($abogados as $key => $valueA)
                                                            {
                                                                echo ' <option  value="'.$valueA->id.'">'.$valueA->usuario.' - '.$valueA->num_empleado.'</option>';
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo ' <option  value="'.$_SESSION['id'].'">'.$_SESSION['usuario'].' - '.$_SESSION['nombre'].'</option>';

                                                        }



                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group"> 
                                                <span><?php echo $textosArray[67];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-signal"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="DivisionAb" id="DivisionAb" multiple>
                                                        <?php
                                                        if($_SESSION['id_perfil']==1)
                                                        {
                                                            echo '<option value="">---</option>';
                                                            $divisiones=ControladorDivisiones::ctrMostrarDivisionesxPais($_POST['paisSelect']);
                                                    //    echo $_POST['paisSelect'];
                                                    //    echo "<pre>";
                                                    //    print_r($divisiones);
                                                    //    echo "</pre>";

                                                            $titleUTF8Array=array();
                                                            foreach ($divisiones as $key => $valueDivs)
                                                            {

                                                                $titleUTF8=utf8_encode($valueDivs->division);
                                                                array_push($titleUTF8Array,$titleUTF8 );


                                                            }
                                                            for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
                                                            {
                                                                $divisiones[$i]->division=$titleUTF8Array[$i];
                                                                //                            echo $i;
                                                            }



                                                            foreach ($divisiones as $key => $valueD)
                                                            {
                                                                echo ' <option  value="'.$valueD->cod_division.'">'.$valueD->division.'</option>';
                                                            }
                                                        }
                                                        else
                                                        { 
                                                            $divisiones = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']);
                                                            foreach ($divisiones as $key => $valDXP)
                                                            { 
                                                                    echo '<option value="'.$valDXP->cod_division.'">'.utf8_encode($valDXP->division).'</option>';
                                                            }
                                                            // echo ' <option  value="'.$_SESSION['cod_division'].'">'.utf8_encode($_SESSION['division']).'</option>';

                                                        }
                                                    // if($_SESSION['id_perfil']==2)
                                                    // {
                                                    //  $divisiones = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']); 
                                                    // }
                                                    // else
                                                    // {
                                                    //      $divisiones = ControladorDivisiones::ctrMostrarDivisionesxPais($paisselect); 
                                                    // }
                                                    // foreach ($divisiones as $key => $valDXP)
                                                    // { 
                                                    //         echo '<option value="'.$valDXP->cod_division.'">'.utf8_encode($valDXP->division).'</option>';
                                                    // }

                                                        ?>
                                                    </select>
                                                    <p style="font-size: 12px;color: red;">(Para seleccionar multiples divisiones debe mantener presionado el boton "Ctrl")</p>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                           
                                        </div><!--  ./boxbody -->
                                    </div> <!--col md -->
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <span><?php echo $textosArray[25];?></span>

                                            <div class="input-group">
                                                <!--                                                        <div class="input-group-text">-->
                                                <!--                                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>-->
                                                <!--                                                        </div>-->

                                                <input type="file" class="form-control input-lg " name="fileReporteAbogado" id="fileReporteAbogado">

                                            </div>
                                        </div>   <!-- ./ form-gruop-->
                                        <div class="form-group" >
                                            <span><?php echo $textosArray[40];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                </div>

                                                <textarea class="form-control input-lg" name="comentarioReporte" id="comentarioReporte" placeholder="Describe yourself here...">
                                                </textarea>
                                            </div>
                                        </div>






                                    </div>

                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary guardarReporte" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal  abogadoreportes -->




        <!-- Modal modalDemandaInterna -->
        <div  id="modalDemandaInterna" name="modalDemandaInterna" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" id="FRMinterna">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[62];?> </h4>
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
                                                <span><?php echo $textosArray[84];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaIngreso" id="fechaIngreso" placeholder="Fecha" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[99];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-place-of-worship"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="localidad" id="localidad" placeholder="Localidad" required readonly>
                                                    <input type="text" class="form-control input-lg" name="localidadPais" id="localidadPais" placeholder="Localidad" required readonly>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[80];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaBaja" id="fechaBaja" placeholder="Fecha de baja" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <span><?php echo $textosArray[24];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control input-lg" name="antiguedad" id="antiguedad" placeholder="Antiguedad" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[53];?></span>
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
                                                    <input type="text" class="form-control input-lg" name="CIML" id="CIML" placeholder="CIML" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[52];?></span>
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
                                                    <input type="text" class="form-control input-lg" name="CAML" id="CAML" placeholder="CAML" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[54];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIMXN" id="CIMXN" placeholder="CIMXN" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[269];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CAMXN" id="CAMXN" placeholder="CAMXN" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Provision demanda (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="PDML" id="PDML" placeholder="PDML" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Provision demanda (MXN)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="PDMXN" id="PDMXN" placeholder="PDMXN" required readonly>
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
                                                        <option value="">Seleccione una moneda</option>
                                                        <?php
                                                        $moneda=ControladorDemandas::ctrMonedas();

                                                        foreach ($moneda as $key => $value)
                                                        {
                                                            echo ' <option  idmoneda="'.$value->diferencia_mxn.'" value="'.$value->id.'">'.$value->nombre_moneda. ' <--> '.$value->diferencia_mxn.'MXN</option>';
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
                                            <span><?php echo $textosArray[163];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="tipoEmp" id="tipoEmp">
                                                    <option value="">Seleccione el tipo de empleado</option>
                                                    <option value="Operativo">Operativo</option>
                                                    <option value="Administrativo">Administrativo</option>
                                                </select>
                                            </div>
                                        </div>



                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                            <span>VP</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-alt"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="vp" id="vp">
                                                    <option value="">Seleccione una VP</option>
                                                   <?php
                                                   $vps=ControladorDemandas::ctrVPs();

                                                   foreach ($vps as $key => $value)
                                                   {
                                                       echo ' <option  value="'.$value->id.'">'.$value->nombre_vicepresidencia.'</option>';
                                                   }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span>Area</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-chart-area"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="area" id="area">
                                                    <!-- Areas se llena por Ajax  -->
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->


                                        <div class="form-group">
                                            <span><?php echo $textosArray[88];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="riesgo" id="riesgo">
                                                    <option value="">Seleccione el tipo de empleado</option>
                                                    <option value="Alto">Alto</option>
                                                    <option value="Medio">Medio</option>
                                                    <option value="Bajo">Bajo</option>
                                                    <option value="Sin riesgo">Sin riesgo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->






                                        <div class="form-group">
                                            <span><?php echo $textosArray[47];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-chart-area"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="sociedad" id="sociedad">
                                                    <option value="">Seleccione una Sociedad</option>
                                                    <?php
                                                    $sociedades=ControladorDemandas::ctrSociedades();
                                                    $titleUTF8Array=array();
                                                    foreach ($sociedades as $key => $value)
                                                    {

                                                        $titleUTF8=utf8_encode($value->nombre_sociedad);
                                                        array_push($titleUTF8Array,$titleUTF8 );


                                                    }
                                                    for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
                                                    {
                                                        $sociedades[$i]->nombre_sociedad=$titleUTF8Array[$i];
//                            echo $i;
                                                    }



                                                    foreach ($sociedades as $key => $value)
                                                    {
                                                        echo ' <option  value="'.$value->id.'">'.$value->nombre_sociedad.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <span>CECO</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CECO" id="CECO" placeholder="CECO" required >

                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                            <span><?php echo $textosArray[108];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                </div>
                                                <!--                                                <input type="text" class="form-control input-lg" name="motivoSalida" id="motivoSalida" placeholder="Motivo Salida" required >-->
                                                <textarea  class="form-control input-lg" name="motivoSalida" id="motivoSalida"></textarea>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <span><?php echo $textosArray[72];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcion" id="descripcion"></textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->






                                    </div>

                                    </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary guardarDemanda" >Guardar Demanda</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal demanda interna -->

        <!-- Modal modalDemandaExterna -->
        <div  id="modalDemandaExterna" name="modalDemandaExterna" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" id="FRMexterna">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Demanda Externa </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="box-body">

                                            <div class="form-group">
                                                <span><?php echo $textosArray[199];?> </span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="ProveedorExterna" id="ProveedorExterna" placeholder="Proveedor" required>
<!--                                                    <select class="form-control input-lg" name="ProveedorExterna" id="ProveedorExterna" required>-->
<!--                                                        <option value="">Seleccionar Proveedor</option>-->
<!--                                                                --><?php
//    //
//                                                                foreach ($proveedor as $key => $value)
//                                                                {
//                                                                    echo'<option  value="'.$value->id.'">'.utf8_encode($value->sindicato).' - '.utf8_encode($value->division).'</option>';
//
//                                                                }
//            //
//        //
//        //                                                    ?>
<!---->
<!--                                                    </select>-->
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[70];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="NombreExterna" id="NombreExterna" placeholder="Nombre" required>
                                                </div>
                                            </div><!-- ./ form-gruop-->



                                            <div class="form-group">
                                                <span><?php echo $textosArray[84];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaIngresoExterna" id="fechaIngresoExterna" placeholder="Fecha" required>
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="form-group">
                                                <span><?php echo $textosArray[99];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-place-of-worship"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="localidadExterna" id="localidadExterna" >

                                                    <?php
                                                    if($divisionesDisponibles=="ALL")
                                                    {
                                                        $divs0=ControladorDivisiones::ctrMostrarDivisionesxPais($_POST['paisSelect']);
                                                        echo '<option value="">Seleccione la division</option>';
                                                        foreach ($divs0 as $key=>$divs)
                                                        {
                                                            echo '<option value="'.$divs->cod_division.'">'.utf8_encode($divs->division).'</option>';

                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="'.$_SESSION['cod_division'].'">'.utf8_encode($_SESSION['division']).'</option>';
                                                    }

//                                                    <option value="Operativo">Operativo</option>
                                                    ?>
                                                    </select>

                                                </div>
                                            </div>   <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[80];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control input-lg" name="fechaBajaExterna" id="fechaBajaExterna" placeholder="Fecha de baja" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <span><?php echo $textosArray[24];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control input-lg" name="antiguedadExterna" id="antiguedadExterna" placeholder="Antiguedad" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[53];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIMLExterna" id="CIMLExterna" placeholder="CIML" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[52];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CAMLExterna" id="CAMLExterna" placeholder="CAML" required onKeyPress="return soloNumeros(event)">
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[54];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CIMXNExterna" id="CIMXNExterna" placeholder="CIMXN" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span><?php echo $textosArray[278];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="CAMXNExterna" id="CAMXNExterna" placeholder="CAMXN" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Provision demanda (Moneda Local)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="PDMLExterna" id="PDMLExterna" placeholder="PDMLExterna" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                            <div class="form-group">
                                                <span>Provision demanda (MXN)</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa  fa-money-bill-wave"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control input-lg" name="PDMXNExterna" id="PDMXNExterna" placeholder="PDMXNExterna" required readonly>
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->



                                            <div class="form-group">
                                                <span><?php echo $textosArray[103];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="monedaExterna" id="monedaExterna">
                                                        <option value="">---</option>
                                                        <?php
                                                        $moneda=ControladorDemandas::ctrMonedas();

                                                        foreach ($moneda as $key => $value)
                                                        {
                                                            echo ' <option  idmonedaExterna="'.$value->diferencia_mxn.'" value="'.$value->id.'">'.$value->nombre_moneda. ' <--> '.$value->diferencia_mxn.'MXN</option>';
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
                                            <span><?php echo $textosArray[163];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="tipoEmpExterna" id="tipoEmpExterna">
                                                    <option value="">Seleccione el tipo de empleado</option>
                                                    <option value="Operativo">Operativo</option>
                                                    <option value="Administrativo">Administrativo</option>
                                                </select>
                                            </div>
                                        </div>



                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                            <span>VP</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-alt"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="vpExterna" id="vpExterna">
                                                    <option value="">Seleccione una VP</option>
                                                    <?php
                                                    $vps=ControladorDemandas::ctrVPs();

                                                    foreach ($vps as $key => $value)
                                                    {
                                                        echo ' <option  value="'.$value->id.'">'.$value->nombre_vicepresidencia.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span>Area</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-chart-area"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="areaExterna" id="areaExterna">
                                                    <!-- Areas se llena por Ajax  -->
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->


                                        <div class="form-group">
                                            <span><?php echo $textosArray[88];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="riesgoExterna" id="riesgoExterna">
                                                    <option value="">Seleccione el tipo de empleado</option>
                                                    <option value="Alto">Alto</option>
                                                    <option value="Medio">Medio</option>
                                                    <option value="Bajo">Bajo</option>
                                                    <option value="Sin riesgo">Sin riesgo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->






                                        <div class="form-group">
                                            <span><?php echo $textosArray[47];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-chart-area"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="sociedadExterna" id="sociedadExterna">
                                                    <option value="">Seleccione una Sociedad</option>
                                                    <?php
                                                    $sociedades=ControladorDemandas::ctrSociedades();
                                                    $titleUTF8Array=array();
                                                    foreach ($sociedades as $key => $value)
                                                    {

                                                        $titleUTF8=utf8_encode($value->nombre_sociedad);
                                                        array_push($titleUTF8Array,$titleUTF8 );


                                                    }
                                                    for ($i=0;$i<=count($titleUTF8Array)-1;$i++)
                                                    {
                                                        $sociedades[$i]->nombre_sociedad=$titleUTF8Array[$i];
//                            echo $i;
                                                    }



                                                    foreach ($sociedades as $key => $value)
                                                    {
                                                        echo ' <option  value="'.$value->id.'">'.$value->nombre_sociedad.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <span>CECO</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-lg" name="CECOExterna" id="CECOExterna" placeholder="CECO" required >

                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                            <span><?php echo $textosArray[108];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                </div>
                                                <!--                                                <input type="text" class="form-control input-lg" name="motivoSalida" id="motivoSalida" placeholder="Motivo Salida" required >-->
                                                <textarea  class="form-control input-lg" name="motivoSalidaExterna" id="motivoSalidaExterna"></textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->


                                        <div class="form-group">
                                            <span><?php echo $textosArray[72];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user-edit"></i></span>
                                                </div>
                                                <textarea  class="form-control input-lg" name="descripcionExterna" id="descripcionExterna"></textarea>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->






                                    </div>

                                </div>
                            </div> <!-- container fluid-->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary guardarDemandaExterna" ><?php echo $textosArray[231];?></button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


        <!-- fin modal demanda externa -->


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

    $(document).ready (function () {

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
                success: function (respuesta) {

                    console.log(respuesta);
                    console.log(respuesta['nombre']);
                    console.log(respuesta['fecha_ingreso']);
                    console.log(respuesta['cod_division']);
                    console.log(respuesta['division']);
                    console.log(respuesta['pais']);

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
                        $("#localidadPais").val(respuesta['pais']);


                        $("#nombre").css("background-color", "#86a76e");
                        $("#nombre").css("color", "#000000");


                        $("#fechaIngreso").css("background-color", "#86a76e");
                        $("#fechaIngreso").css("color", "#000000");

                        $("#localidad").css("background-color", "#86a76e");
                        $("#localidad").css("color", "#000000");

                        $("#localidadPais").css("background-color", "#ffe268");
                        $("#localidadPais").css("color", "#000000");

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

        $("#fechaBaja").change(function () {
            var fechaIngreso = $("#fechaIngreso").val();//tomar el atributo
            var fechaBaja = $("#fechaBaja").val();//tomar el atributo

            var fechai = new Date(fechaIngreso);
            var fechaF = new Date(fechaBaja);
            var tiempo = fechaF.getTime() - fechai.getTime();
            var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
            var años = dias / 365;

            $("#antiguedad").val((años).toFixed(2));
            $("#antiguedad").css("background-color", "#86a76e");
            $("#antiguedad").css("color", "#000000");
        });

        $("#vp").change(function () {
            var idVP = $("#vp").val();//tomar el atributo

            var funcion = "areasPorVPs";
            var datos = new FormData();

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idVP", idVP);

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
                    console.log(respuesta);
                    var stringHTML = '<option value="">Seleccione un area</option>';
                    respuesta.forEach((obj, i) => {

                        stringHTML += '<option value="' + obj['id_area'] + '">' + obj['nombre_area'] + '</option>';

                    });
                    $("#area").html(stringHTML);


                }

            });

        });

        //CAMBIAR CUANDO ESCRIBO VALORES

        $("#CIML").change(function () {
            var CIML = $("#CIML").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');

            var CIML_R=CIML.replace(/,/g, '');//

            var valorMoneda = $('option:selected', $("#moneda")).attr('idmoneda');

            if (valorMoneda==null || valorMoneda=='')
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Debe seleccionar un cambio de moneda!',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {
                var cuentaMXN0=(CIML_R * valorMoneda);
                $("#CIMXN").val(formatter.format(cuentaMXN0));
                $("#CIMXN").css("background-color", "#86a76e");
                $("#CIMXN").css("color", "#000000");


            }
            // alert(valorMoneda);


        });


///////////////////////////////////////////////////////////////////////////////////////////////////CAML
        $("#CAML").change(function () {
            var CAML = $("#CAML").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta=(CAML_R * 0.35);
            $("#PDML").val(formatter.format(cuenta));
            $("#PDML").css("background-color", "#86a76e");
            $("#PDML").css("color", "#000000");
            var valorMoneda = $('option:selected', $("#moneda")).attr('idmoneda');
            if (valorMoneda==null || valorMoneda=='')
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Debe seleccionar un cambio de moneda!',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {
                var cuentaMXN=(CAML_R * valorMoneda);
                var cuentaMXN2=(cuentaMXN  * 0.35);
                $("#PDMXN").val(formatter.format(cuentaMXN2));
                $("#PDMXN").css("background-color", "#86a76e");
                $("#PDMXN").css("color", "#000000");

                var cuentaMXN0=(CAML_R * valorMoneda);
                $("#CAMXN").val(formatter.format(cuentaMXN0));
                $("#CAMXN").css("background-color", "#86a76e");
                $("#CAMXN").css("color", "#000000");
            }
            // alert(valorMoneda);
        });
///////////////////////////////////////////////////////////////////////////CAML --->edicion
        $(".CAML").change(function () {
            var demandaID = $(this).attr("idDemanda");
            var CAML = $("#CAML_"+demandaID).val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta=(CAML_R * 0.35);
            $("#PDML_"+demandaID).val(formatter.format(cuenta));
            $("#PDML_"+demandaID).css("background-color", "#86a76e");
            $("#PDML_"+demandaID).css("color", "#000000");

            // var valorMoneda = $('option:selected', $("#monedaEdit"+demandaID)).attr('idmoneda');
            // if (valorMoneda==null || valorMoneda=='')
            // {
            //     Swal.fire({
            //         title: 'Warning!',
            //         text: '¡Debe seleccionar un cambio de moneda!',
            //         icon: 'warning',
            //         confirmButtonText: 'Ok'
            //     });
            // }
            // else
            // {
            //     var cuentaMXN=(CAML_R * valorMoneda);
            //     var cuentaMXN2=(cuentaMXN  * 0.35);
            //     $("#PDMXN").val(formatter.format(cuentaMXN2));
            //     $("#PDMXN").css("background-color", "#86a76e");
            //     $("#PDMXN").css("color", "#000000");

            //     var cuentaMXN0=(CAML_R * valorMoneda);
            //     $("#CAMXN").val(formatter.format(cuentaMXN0));
            //     $("#CAMXN").css("background-color", "#86a76e");
            //     $("#CAMXN").css("color", "#000000");
            // }
            // // alert(valorMoneda);

        });



        $(".CAML_").change(function () {
            var CAML = $("#CAML").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta=(CAML_R * 0.35);
            $("#PDML").val(formatter.format(cuenta));
            $("#PDML").css("background-color", "#86a76e");
            $("#PDML").css("color", "#000000");
            var valorMoneda = $('option:selected', $("#moneda")).attr('idmoneda');
            if (valorMoneda==null || valorMoneda=='')
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Debe seleccionar un cambio de moneda!',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {
                var cuentaMXN=(CAML_R * valorMoneda);
                var cuentaMXN2=(cuentaMXN  * 0.35);
                $("#PDMXN").val(formatter.format(cuentaMXN2));
                $("#PDMXN").css("background-color", "#86a76e");
                $("#PDMXN").css("color", "#000000");

                var cuentaMXN0=(CAML_R * valorMoneda);
                $("#CAMXN").val(formatter.format(cuentaMXN0));
                $("#CAMXN").css("background-color", "#86a76e");
                $("#CAMXN").css("color", "#000000");
            }
            // alert(valorMoneda);
        });

        $("#CIMLExterna").change(function () {
            var CIMLExterna = $("#CIMLExterna").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');

            var CIMLExterna_R=CIMLExterna.replace(/,/g, '');//

            var valorMoneda = $('option:selected', $("#monedaExterna")).attr('idmonedaExterna');

            if (valorMoneda==null || valorMoneda=='')
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Debe seleccionar un cambio de moneda!',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {
                var cuentaMXN0=(CIMLExterna_R * valorMoneda);
                $("#CIMXNExterna").val(formatter.format(cuentaMXN0));
                $("#CIMXNExterna").css("background-color", "#86a76e");
                $("#CIMXNExterna").css("color", "#000000");


            }
            // alert(valorMoneda);


        });

////////////////////////////////////////////////////////////////////////////////////////////CAMLExterna
        $("#CAMLExterna").change(function () {
            var CAMLExterna = $("#CAMLExterna").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');
            var CAMLExterna_R=CAMLExterna.replace(/,/g, '');//
            var cuenta=(CAMLExterna_R * 0.35);
            $("#PDMLExterna").val(formatter.format(cuenta));
            $("#PDMLExterna").css("background-color", "#86a76e");
            $("#PDMLExterna").css("color", "#000000");
            var valorMoneda = $('option:selected', $("#monedaExterna")).attr('idmonedaExterna');
            // alert(valorMoneda);
            if (valorMoneda==null || valorMoneda=='')
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡Debe seleccionar un cambio de moneda!',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            }
            else
            {
                var cuentaMXN=(CAMLExterna_R * valorMoneda);
                var cuentaMXN2=(cuentaMXN  * 0.35);
                $("#PDMXNExterna").val(formatter.format(cuentaMXN2));
                $("#PDMXNExterna").css("background-color", "#86a76e");
                $("#PDMXNExterna").css("color", "#000000");
            }
            // alert(valorMoneda);
        });


            $("#moneda").change(function () {

            var valorMoneda = $('option:selected', this).attr('idmoneda');

            // alert(option);
            // console.log(option);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            var CIML = $("#CIML").val();//tomar el atributo
            var CAML = $("#CAML").val();//tomar el atributo

            const formatter = new Intl.NumberFormat('es-MX');

            var CIML_R=CIML.replace(/,/g, '');//
            var cuenta=(CIML_R * valorMoneda);


            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta2=(CAML_R * valorMoneda);


            $("#CIMXN").val(formatter.format(cuenta));
            $("#CIMXN").css("background-color", "#86a76e");
            $("#CIMXN").css("color", "#000000");

            $("#CAMXN").val(formatter.format(cuenta2));
            $("#CAMXN").css("background-color", "#86a76e");
            $("#CAMXN").css("color", "#000000");
        });

        $(".monedaCierre").change(function () {
            var idDemanda = $(this).attr('id');
            // alert(idDemanda);

            var valorMoneda = $('option:selected', this).attr('idmoneda');

            // alert(valorMoneda);
            console.log(valorMoneda);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');


            var ICBML = $("#ICBML_" + idDemanda).val();//tomar el atributo
            var ICNML = $("#ICNML_" + idDemanda).val();//tomar el atributo

            var ICBML_R=ICBML.replace(/,/g, '');//
            var cuenta=(ICBML_R * valorMoneda);


            var ICNML_R=ICNML.replace(/,/g, '');//
            var cuenta2=(ICNML_R * valorMoneda);


            $("#ICBMXN_" + idDemanda).val(formatter.format(cuenta));
            $("#ICBMXN_" + idDemanda).css("background-color", "#86a76e");
            $("#ICBMXN_" + idDemanda).css("color", "#000000");

            $("#ICNMXN_" + idDemanda).val(formatter.format(cuenta2));
            $("#ICNMXN_" + idDemanda).css("background-color", "#86a76e");
            $("#ICNMXN_" + idDemanda).css("color", "#000000");
        });

        $(".monedaEdit").change(function () {
            //var idDemanda = $(this).attr('id');
            var idDemanda = $(this).attr('idDemanda');
            // alert(idDemanda);

            var valorMoneda = $('option:selected', this).attr('idmoneda');

            // alert(valorMoneda);
            console.log(valorMoneda);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');


            var CIML = $("#CIML_" + idDemanda).val();//tomar el atributo
            var CAML = $("#CAML_" + idDemanda).val();//tomar el atributo

            var CIML_R=CIML.replace(/,/g, '');//
            var cuenta=(CIML_R * valorMoneda);


            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta2=(CAML_R * valorMoneda);


            $("#CIMXN_" + idDemanda).val(formatter.format(cuenta));
            $("#CIMXN_" + idDemanda).css("background-color", "#86a76e");
            $("#CIMXN_" + idDemanda).css("color", "#000000");

            $("#CAMXN_" + idDemanda).val(formatter.format(cuenta2));
            $("#CAMXN_" + idDemanda).css("background-color", "#86a76e");
            $("#CAMXN_" + idDemanda).css("color", "#000000");
        });


        $(".guardarDemanda").click(function ()
        {
            //FRMinterna
            var dataString = $('#FRMinterna').serializeArray();
            var camposFaltantes=[];
            console.log(dataString);
            $.each(dataString   , function(i, field){
                var nombrecampo=field.name;
                var valorCampo=field.value;

                if (valorCampo=="")
                {
                    // if (nombrecampo=="medioText" )
                    // {
                    //
                    // }
                    // else {
                        camposFaltantes.push(nombrecampo);
                    // }
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

                // alert("aqui");
                var datos = new FormData();
                var funcion = "guardarDemanda";

                var num_EmpleadoActive = $("#num_EmpleadoActive").val();
                var nombre = $("#nombre").val();
                var fechaIngreso = $("#fechaIngreso").val();
                var localidad = $("#localidad").val();
                var fechaBaja = $("#fechaBaja").val();
                var antiguedad = $("#antiguedad").val();
                var CIMXN = $("#CIMXN").val();
                var CIMXN_R=CIMXN.replace(/,/g, '');//

                var CAMXN = $("#CAMXN").val();
                var CAMXN_R=CAMXN.replace(/,/g, '');//

                var motivoSalida = $("#motivoSalida").val();
                var tipoEmp = $("#tipoEmp").val();
                var vp = $("#vp").val();
                var area = $("#area").val();
                var riesgo = $("#riesgo").val();
                var sociedad = $("#sociedad").val();
                var CECO = $("#CECO").val();

                var CIML = $("#CIML").val();
                var CIML_R=CIML.replace(/,/g, '');//

                var CAML = $("#CAML").val();
                var CAML_R=CAML.replace(/,/g, '');//


                var PDML = $("#PDML").val();
                var PDML_R=PDML.replace(/,/g, '');//
                var PDMXN = $("#PDMXN").val();
                var PDMXN_R=PDMXN.replace(/,/g, '');//


                var moneda = $("#moneda").val();
                // var idmoneda = $("#moneda").attr("idmoneda");

                var descripcion = $("#descripcion").val();
                var localidadPais = $("#localidadPais").val();
                var paisSES = $("#paisSES").val();
                var idPerfilSES = $("#idPerfilSES").val();
                var localidadPais = $("#localidadPais").val();

                // alert(idPerfilSES);
                // alert(localidadPais);

                if (idPerfilSES!=1)
                {
                    alert("Perfil diferente Admin"+idPerfilSES);

                    if (localidadPais!=paisSES)
                    {
                        // alert("diferentes paises:  "+localidadPais+" / "+paisSES);
                        Swal.fire({
                            title: 'Danger!',
                            text: '¡El emplado al que intenta generar la demanda, no pertenece a su Division/Pais!',
                            icon: 'danger',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                    else
                    {


                        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

                        datos.append("num_EmpleadoActive", num_EmpleadoActive);
                        datos.append("nombre", nombre);
                        datos.append("fechaIngreso", fechaIngreso);
                        datos.append("localidad", localidad);
                        datos.append("fechaBaja", fechaBaja);
                        datos.append("antiguedad", antiguedad);
                        datos.append("CIMXN", CIMXN_R);
                        datos.append("CAMXN", CAMXN_R);
                        datos.append("motivoSalida", motivoSalida);
                        datos.append("tipoEmp", tipoEmp);
                        datos.append("vp", vp);
                        datos.append("area", area);
                        datos.append("riesgo", riesgo);
                        datos.append("sociedad", sociedad);
                        datos.append("CECO", CECO);
                        datos.append("CIML", CIML_R);
                        datos.append("CAML", CAML_R);
                        datos.append("PDML", PDML_R);
                        datos.append("PDMXN", PDMXN_R);
                        datos.append("moneda", moneda);
                        // datos.append("idmoneda", idmoneda);
                        datos.append("descripcion", descripcion);


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
                    }
                }
                else
                {


                    datos.append("PDMXN", PDMXN_R);
                    datos.append("PDML", PDML_R);
                    datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

                    datos.append("num_EmpleadoActive", num_EmpleadoActive);
                    datos.append("nombre", nombre);
                    datos.append("fechaIngreso", fechaIngreso);
                    datos.append("localidad", localidad);
                    datos.append("fechaBaja", fechaBaja);
                    datos.append("antiguedad", antiguedad);
                    datos.append("CIMXN", CIMXN_R);
                    datos.append("CAMXN", CAMXN_R);
                    datos.append("motivoSalida", motivoSalida);
                    datos.append("tipoEmp", tipoEmp);
                    datos.append("vp", vp);
                    datos.append("area", area);
                    datos.append("riesgo", riesgo);
                    datos.append("sociedad", sociedad);
                    datos.append("CECO", CECO);
                    datos.append("CIML", CIML_R);
                    datos.append("CAML", CAML_R);
                    datos.append("moneda", moneda);
                    // datos.append("idmoneda", idmoneda);
                    datos.append("descripcion", descripcion);


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
                }
            }


        });
//-------------------------------------------------------------------

        $(".cerrarDemanda").click(function () {
            var demandaID = $(this).attr("idDemanda");
            // alert('hola');

            var datos = new FormData();
            var funcion = "cerrarDemanda";

            var fechaCierre = $("#fechaCierre_" + demandaID).val();
            // var demandaID      = $("#demandaID_").val();
            var ICBML = $("#ICBML_" + demandaID).val();
            var ICNML = $("#ICNML_" + demandaID).val();
            var ICBMXN = $("#ICBMXN_" + demandaID).val();
            var ICNMXN = $("#ICNMXN_" + demandaID).val();

            var ICBML_R=ICBML.replace(/,/g, '');//
            var ICNML_R=ICNML.replace(/,/g, '');//
            var ICBMXN_R=ICBMXN.replace(/,/g, '');//
            var ICNMXN_R=ICNMXN.replace(/,/g, '');//


            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

            datos.append("fechaCierre", fechaCierre);
            datos.append("demandaID", demandaID);
            datos.append("ICBML", ICBML_R);
            datos.append("ICNML", ICNML_R);
            datos.append("ICBMXN", ICBMXN_R);
            datos.append("ICNMXN", ICNMXN_R);


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


//--------------------------------------------------

        $("#fechaBajaExterna").change(function ()
        {
            var fechaIngreso = $("#fechaIngresoExterna").val();//tomar el atributo
            var fechaBaja = $("#fechaBajaExterna").val();//tomar el atributo

            var fechai = new Date(fechaIngreso);
            var fechaF = new Date(fechaBaja);
            var tiempo = fechaF.getTime() - fechai.getTime();
            var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
            var años =dias/365;

            $("#antiguedadExterna").val((años).toFixed(2));
            $("#antiguedadExterna").css("background-color", "#86a76e");
            $("#antiguedadExterna").css("color", "#000000");
        });

        $("#vpExterna").change(function ()
        {
            var idVP = $("#vpExterna").val();//tomar el atributo

            var funcion="areasPorVPs";
            var datos = new FormData();

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idVP", idVP);

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
                    console.log(respuesta);
                    var stringHTML='<option value="">Seleccione un area</option>';
                    respuesta.forEach((obj, i) =>
                    {

                        stringHTML+='<option value="'+obj['id_area']+'">'+obj['nombre_area']+'</option>';

                    });
                    $("#areaExterna").html(stringHTML);


                }

            });

        });


        $("#monedaExterna").change(function ()
        {

            var valorMoneda = $('option:selected', this).attr('idmonedaExterna');

            // alert(option);
            // console.log(option);
            //var valorMoneda = $(this).attr("idmoneda");//tomar el atributo
            var CIML = $("#CIMLExterna").val();//tomar el atributo
            var CAML = $("#CAMLExterna").val();//tomar el atributo
            const formatter = new Intl.NumberFormat('es-MX');


            var CIML_R=CIML.replace(/,/g, '');//
            var cuenta=(CIML_R * valorMoneda);

            var CAML_R=CAML.replace(/,/g, '');//
            var cuenta2=(CAML_R * valorMoneda);


            $("#CIMXNExterna").val(formatter.format(cuenta));
            $("#CIMXNExterna").css("background-color", "#86a76e");
            $("#CIMXNExterna").css("color", "#000000");

            $("#CAMXNExterna").val(formatter.format(cuenta2));
            $("#CAMXNExterna").css("background-color", "#86a76e");
            $("#CAMXNExterna").css("color", "#000000");
        });


        $(".guardarDemandaExterna").click(function ()
        {
            //FRMinterna
            var dataString = $('#FRMexterna').serializeArray();
            var camposFaltantes=[];
            console.log(dataString);
            $.each(dataString   , function(i, field){
                var nombrecampo=field.name;
                var valorCampo=field.value;

                if (valorCampo=="")
                {
                    // if (nombrecampo=="medioText" )
                    // {
                    //
                    // }
                    // else {
                        camposFaltantes.push(nombrecampo);
                    // }
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
                var funcion = "guardarDemandaExterna";
                var proveedor = $("#ProveedorExterna").val();
                var nombre = $("#NombreExterna").val();
                var fechaIngreso = $("#fechaIngresoExterna").val();
                var localidad = $("#localidadExterna").val();
                var fechaBaja = $("#fechaBajaExterna").val();
                var antiguedad = $("#antiguedadExterna").val();


                var CIMXN = $("#CIMXNExterna").val();
                var CIMXN_R=CIMXN.replace(/,/g, '');//

                var CAMXN = $("#CAMXNExterna").val();
                var CAMXN_R=CAMXN.replace(/,/g, '');//


                var motivoSalida = $("#motivoSalidaExterna").val();
                var tipoEmp = $("#tipoEmpExterna").val();
                var vp = $("#vpExterna").val();
                var area = $("#areaExterna").val();
                var riesgo = $("#riesgoExterna").val();
                var sociedad = $("#sociedadExterna").val();
                var CECO = $("#CECOExterna").val();

                var CIML = $("#CIMLExterna").val();
                var CIML_R=CIML.replace(/,/g, '');//

                var CAML = $("#CAMLExterna").val();
                var CAML_R=CAML.replace(/,/g, '');//

                var PDML = $("#PDMLExterna").val();
                var PDML_R=PDML.replace(/,/g, '');//


                var PDMXN = $("#PDMXNExterna").val();
                var PDMXN_R=PDMXN.replace(/,/g, '');//




                var moneda = $("#monedaExterna").val();
                // var idmoneda = $("#moneda").attr("idmoneda");

                var descripcion = $("#descripcionExterna").val();
                datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

                datos.append("proveedor", proveedor);
                datos.append("nombre", nombre);
                datos.append("fechaIngreso", fechaIngreso);
                datos.append("localidad", localidad);
                datos.append("fechaBaja", fechaBaja);
                datos.append("antiguedad", antiguedad);
                datos.append("CIMXN", CIMXN_R);
                datos.append("CAMXN", CAMXN_R);
                datos.append("motivoSalida", motivoSalida);
                datos.append("tipoEmp", tipoEmp);
                datos.append("vp", vp);
                datos.append("area", area);
                datos.append("riesgo", riesgo);
                datos.append("sociedad", sociedad);
                datos.append("CECO", CECO);
                datos.append("CIML", CIML_R);
                datos.append("CAML", CAML_R);
                datos.append("PDML", PDML_R);
                datos.append("PDMXN", PDMXN_R);

                datos.append("moneda", moneda);
                // datos.append("idmoneda", idmoneda);
                datos.append("descripcion", descripcion);


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
            }

        });


        $(".archivoDemandaInterna").click(function()
        {

            var idDemanda = $(this).attr("IdDemandaInterna");

            var datos = new FormData();
            var funcion         ="subirArchivoDemanda";
            // var idDemanda       = $("#IdDemandaInterna").val();
            var idUser       = $("#idUser").val();
            // var file         =  $("#fileInterna")[0].files[0];
            var file         =  $("#fileInterna"+idDemanda)[0].files[0];

            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("idDemanda", idDemanda);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idUser", idUser);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
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

        $(".archivoDemandaExterna").click(function()
        {
            var idDemanda = $(this).attr("IdDemandaExterna");
            var datos = new FormData();
            var funcion         ="subirArchivoDemanda";
            // var idDemanda       = $("#IdDemandaExterna").val();
            var idUser       = $("#idUser").val();
            var file         =  $("#fileExterna"+idDemanda)[0].files[0];

            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("idDemanda", idDemanda);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idUser", idUser);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
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
//------------------------------------------------------------------------------------
        $(".guardarReporte").click(function()
        {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
            //var idUsuario = $(this).attr("idUsuario");
            // alert('hola');
            var datos = new FormData();
            var funcion         ="subirReporteAbogado";
            var usuario       = $("#usuarioAb").val();
            var division       = $("#DivisionAb").val();
            var idUser       = $("#idUser").val();
            var comentarioReporte       = $("#comentarioReporte").val();
            var file         =  $("#fileReporteAbogado")[0].files[0];
            //var jsonPeticiones = $("#jsonPeticiones").val();


            // var jsonAcuerdos = $("#jsonAcuerdos").val();
            // var file            = $("#file").val();

            datos.append("file", file);
            datos.append("usuario", usuario);//PARA MANDARLO A LA VARIABLE datos
            datos.append("division", division);//PARA MANDARLO A LA VARIABLE datos
            datos.append("funcion", funcion);
            datos.append("idUser", idUser);
            datos.append("comentarioReporte", comentarioReporte);
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
//---------------------------------------------------------------------

        $(".guardarEdicion").click(function ()
        {
            var demandaID = $(this).attr("idDemanda");
            // alert('hola');
            // alert(demandaID);

            var datos = new FormData();
            var funcion = "guardarEdicion";

            var descripcionEdit = $("#descripcionEdit" + demandaID).val();
            // var demandaID      = $("#demandaID_").val();
            var CIML = $("#CIML_" + demandaID).val();
            var CAML = $("#CAML_" + demandaID).val();
            var CIMXN = $("#CIMXN_" + demandaID).val();
            var CAMXN = $("#CAMXN_" + demandaID).val();
            var monedaEdit = $("#monedaEdit" + demandaID).val();

            var CIML_R=CIML.replace(/,/g, '');//
            var CAML_R=CAML.replace(/,/g, '');//
            var CIMXN_R=CIMXN.replace(/,/g, '');//
            var CAMXN_R=CAMXN.replace(/,/g, '');//


            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos

            datos.append("descripcionEdit", descripcionEdit);
            datos.append("demandaID", demandaID);
            datos.append("CIML", CIML_R);
            datos.append("CAML", CAML_R);
            datos.append("CIMXN", CIMXN_R);
            datos.append("CAMXN", CAMXN_R);
            datos.append("monedaEdit", monedaEdit);


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





    });
</script>

