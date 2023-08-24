<?php
//$fechaCalendario=$_GET['fecha'];
//echo "<pre>";
//print_r($_POST['fechaCalendario']);
//echo "</pre>";
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//exit();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[179];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[179];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1><?php echo $textosArray[179];?></h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="14%"><?php echo $textosArray[48];?></th>
                                <th scope="col" width="10%"><?php echo $textosArray[240];?></th>
                                <th scope="col" width="15%"><?php echo $textosArray[196];?></th>
                                <th scope="col" width="10%"><?php echo $textosArray[77];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[199];?></th>
                                <th scope="col" width="12%"><?php echo $textosArray[67];?></th>
                                <th scope="col" width="27%"><?php echo $textosArray[12];?></th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
//                               echo "aqui<br>";
                            if ($_SESSION['id_perfil']==7 || $_SESSION['id_perfil']==2)
                            {
                                $pagosdia=ControladorPagos::ctrMostrarPagosPorDia($_POST['fechaCalendario'],$_SESSION['divisiones']);

                            }
                            else
                            {
                                $pagosdia=ControladorPagos::ctrMostrarPagosPorDia($_POST['fechaCalendario'],"");

                            }
//                                echo "<pre>";
//                                print_r($pagosdia);
//                                echo "</pre>";

                            //              echo count($usuarios);
                            foreach ($pagosdia as $key => $value)
                            {
                            //  echo "<br>";
                            //  print_r($value->id);
                                if ($value->nombre=='' || $value->nombre==null)
                                {

                                }
                                elseif ($value->nombre!='' || $value->nombre!=null)
                                {
                                    $tamaño=strlen($value->nombre);
                                    $tamañoF=$tamaño/3;
                                    $tamañoF=$tamañoF*2;
                                    echo '<tr>
                              <td>' . utf8_encode($value->concepto) . '</td>
                              <td>' . $value->monto . '</td>';


                                    if ($value->estatus=="Pendiente")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #b0acac !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="En Proceso")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #5ebbed !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="En Validacion")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #801580 !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="Rechazado")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #dc3545 !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="Validado")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #801580 !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="Recepcion")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #f2c010 !important;color: black !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="Registrado")
                                    {
                                        echo '<td><input type="text" class="form-control input-md" style="background-color: #6c757d !important;color: white !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }
                                    elseif ($value->estatus=="Pagado")
                                    {
                                    echo '<td><input type="text" class="form-control input-md" style="background-color: #343a40 !important;color: white !important; " value="'.$value->estatus.'" readonly ></td>';
                                    }







                                //  echo'<td>' . $value->estatus . '</td>';

                              echo '<td>' . $value->fecha_vencimiento . '</td>
                               <td title="'.utf8_encode($value->nombre).'" style="text-decoration:none">'.utf8_encode(substr($value->nombre, 0,-$tamañoF)).'...</td>
                               <td title="'.utf8_encode($value->division).'" style="text-decoration:none">'.utf8_encode($value->division).'</td>

                              <td>
                                <div class="btn-group">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalRecibos'.$value->IDPAGO.'">'.$textosArray[242].'</button>
                      <!--button class="btn btn-primary btn-sm modalRecibos "   IdPago="' . $value->IDPAGO . '" concepto="' . $value->concepto . '" monto="' . $value->monto . '">Recibo/Factura</button-->
                      <!--button class="btn btn-success btn-sm modalOrdenes" IdPago="' . $value->IDPAGO . '" concepto="' . $value->concepto . '" monto="' . $value->monto . '">Orden de compra</button-->
                      <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalOrdenes'.$value->IDPAGO.'">'.$textosArray[243].' </button>
                      <button class="btn btn-default btn-sm modalValidacion" style="background-color: #801580 !important; color: white !important;"  IdPago="' . $value->IDPAGO . '"  fechaVenc="' . $value->fecha_vencimiento . '">'.$textosArray[244].'</button>
                      <button class="btn btn-warning btn-sm modalRecepcion"   IdPago="' . $value->IDPAGO . '">'.$textosArray[245].'</button>
                      <button class="btn btn-secondary btn-sm modalRegistro"  IdPago="' . $value->IDPAGO . '">'.$textosArray[246].'</button>
                      <!--button class="btn btn-dark btn-sm"   IdPago="' . $value->IDPAGO . '">Comprobante</button-->
                      <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#ModalComprobantes'.$value->IDPAGO.'">'.$textosArray[247].'</button>';
                      if ($_SESSION['id_perfil']==1)
                      {
                          echo'<button class="btn btn-danger btn-xs btnEliminarPago" IdPago="' . $value->IDPAGO . '"><i class="fa fa-times"></i></button>';

                      }

                        echo '<div class="modal fade"  id="ModalComprobantes'.$value->IDPAGO.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" ><!--style=" min-width: 100%; margin: 0;"-->
                                <div class="modal-content" ><!--style="min-height: 100%;"-->
                                    <div class="modal-header" style="background-color: #002554; color: white;" >
                                        <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[247].' '.$value->IDPAGO.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="accordion"> 
                                            <div class="card">
                                                <div class="card-header collapseHistorial active" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseHistorial" data-toggle="collapse" data-target="#collapseHistorial" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[250].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseHistorial" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                        <ul>';
                                                        $ac = ControladorPagos::ctrMostrarArchivosComprobante($value->IDPAGO);
                                                        foreach ($ac as $key => $valac)
                                                        {  
                                                            if ($valac === reset($ac))
                                                            {
                                                                echo '<li style="color:red;"><a title="Ver " class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comprobantes/'.$valac->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                echo '<label>'.$valac->nombre.'-  '.substr($valac->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Ultimo</li>';
                                                            }else
                                                            {
                                                                echo '<li><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comprobantes/'.$valac->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                echo '<label>'.$valac->nombre.'-  '.substr($valac->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[30].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseArchivos" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group" >
                                                                <div class="input-group">
                                                                </div>
                                                                <input class="d-none" type="text" id="IDPAGO'.$value->IDPAGO.'" value="<?php echo $idS;?>">
                                                                <input type="file" class="form-control input-lg fil" IdPago="'.$value->IDPAGO.'" num="1" size="10000" name="file1'.$value->IDPAGO.'" id="file1'.$value->IDPAGO.'" accept=".pdf">
                                       
                                                            </div>   <!-- ./ form-gruop-->
                                                         <div class="alert alert-danger align-center" id="tipoarchivo1'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).</div> 
                                                         <div class="alert alert-danger align-center" id="tamañoarchivo1'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                            <button type="button" class="btn btn-primary GuardarComprobante" num="1" IdPago="'.$value->IDPAGO.'">'.$textosArray[231].'</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade"  id="ModalRecibos'.$value->IDPAGO.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" ><!--style=" min-width: 100%; margin: 0;"-->
                                <div class="modal-content" ><!--style="min-height: 100%;"-->
                                    <div class="modal-header" style="background-color: #002554; color: white;" >
                                        <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[242].' '.$value->IDPAGO.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">';
                                    $FC=ControladorPagos::ctrFacturaxPago($value->IDPAGO);
                                    // echo "<br>".count($FC);
//                                         echo "<pre>";
//                                        print_r($FC);
                                        $countFC=count($FC);
//                                        echo "</pre>";
                                        foreach ($FC as $key => $valFC)
                                        {  
                                            $id_factura= $valFC->id_factura;
                                            $concepto= $valFC->concepto;
                                            $monto= $valFC->monto;
                                            $comentario= $valFC->comentario;
                                            $id_archivo= $valFC->id_archivo;
                                            $nombre= $valFC->nombre;
                                            $archivo= $valFC->archivo;
                                        }
                                        echo '<div id="accordion">
                                            <div class="card">
                                                <div class="card-header collapseFactura active" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseFactura" data-toggle="collapse" data-target="#collapseFactura" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[248].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseFactura" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <span>'.$textosArray[48].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control input-md" placeholder="Concepto" value="'.$valFC->concepto.'" name="conceptoRecibos'.$value->IDPAGO.'" id="conceptoRecibos'.$value->IDPAGO.'" >
                    
                                                                </div>
                                                            </div><!-- ./ form-gruop-->
                                                            <div class="form-group">
                                                                <span>'.$textosArray[240].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                                    </div>
                                                                    <input type="number" class="form-control input-md numberinput" value="'.$valFC->monto.'" name="montoRecibo'.$value->IDPAGO.'" id="montoRecibo'.$value->IDPAGO.'" >
                                                                </div>
                                                            </div><!-- ./ form-gruop-->
                                                            <div class="form-group">
                                                                <span>'.$textosArray[40].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                                    </div>
                                                                    <textarea class="form-control input-lg" type="text" name="" id=""  maxlength="500" placeholder="Comentario" readonly>'.$valFC->comentario.'</textarea >
                                                                </div>
                                                            </div><!-- ./ form-gruop-->
                                                            <div class="form-group">
                                                                <span>'.$textosArray[249].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                                    </div>
                                                                    <textarea class="form-control input-lg" type="text" name="comentarioRecibo'.$value->IDPAGO.'" id="comentarioRecibo'.$value->IDPAGO.'"  maxlength="500" placeholder="Comentario" required></textarea>
                                                                </div>
                                                            </div><!-- ./ form-gruop-->
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapseHistorial " id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseHistorial" data-toggle="collapse" data-target="#collapseHistorial" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[250].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseHistorial" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <ul>';
                                        if ($countFC==0)
                                        {

                                        }elseif ($countFC>0)
                                        {
                                            echo '<li><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/facturas/'.$valFC->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;
                                            <label>'.$valFC->nombre.'-  '.substr($valFC->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';

                                        }
                                                                 echo '</ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[25].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseArchivos" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group" >
                                                                <div class="input-group">
                                                                </div>
                                                                <input class="d-none" type="text" id="IDPAGO'.$value->IDPAGO.'" value="<?php echo $idS;?>">
                                                                <input type="file" class="form-control input-lg fil" IdPago="'.$value->IDPAGO.'" num="2" size="5000" name="file2'.$value->IDPAGO.'" id="file2'.$value->IDPAGO.'" accept=".pdf">
                                    
                                                            </div>   <!-- ./ form-gruop-->
                                                        <div class="alert alert-danger align-center" id="tipoarchivo2'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).</div> 
                                                        <div class="alert alert-danger align-center" id="tamañoarchivo2'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                            <button type="button" class="btn btn-primary agregarRecibo"  num="2" IdPago="'.$value->IDPAGO.'">'.$textosArray[231].'</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade"  id="modalOrdenes'.$value->IDPAGO.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" ><!--style=" min-width: 100%; margin: 0;"-->
                                <div class="modal-content" ><!--style="min-height: 100%;"-->
                                    <div class="modal-header" style="background-color: #002554; color: white;" >
                                        <h5 class="modal-title" id="exampleModalLabel">'.$textosArray[243].'  '.$value->IDPAGO.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">';
                             
                                        echo '<div id="accordion">
                                            <div class="card">
                                                <div class="card-header collapseFactura active" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseFactura" data-toggle="collapse" data-target="#collapseFactura" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[243].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseFactura" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                            <span>'.$textosArray[48].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control input-md" placeholder="Concepto" value="'.$value->concepto.'" name="conceptoOrden'.$value->IDPAGO.'" id="conceptoOrden'.$value->IDPAGO.'" >
                    
                                                                </div>
                                                            </div><!-- ./ form-gruop-->
                                                            <div class="form-group">
                                                            <span>'.$textosArray[240].'</span>
                                                                <div class="input-group">
                                                                    <div class="input-group-text">
                                                                        <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                                    </div>
                                                                    <input type="number" class="form-control input-md numberinput" value="'.$value->monto.'" name="montoOrden'.$value->IDPAGO.'" id="montoOrden'.$value->IDPAGO.'" >
                                                                </div>
                                                            </div>
                                                            <!-- ./ form-gruop-->

                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapseHistorial " id="headingArchivosO" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseHistorial" data-toggle="collapse" data-target="#collapseHistorial" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[250].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseHistorial" class="collapse" aria-labelledby="headingArchivosO" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">';
                                                        $Orden=ControladorPagos::ctrOrdenxPago($value->IDPAGO);
                                                        // echo "<br>".count($Orden);
                                                        // echo "<pre>";
                                                        //        print_r($Orden);
                                                        //        echo "</pre>";
                                                        $countOrden=count($Orden);
                                                        foreach ($Orden as $key => $valO)
                                                        {  
                                                            $id_archivo= $valO->id_archivo;
                                                            $nombre= $valO->nombre;
                                                            $archivo= $valO->archivo;
                                                        }
                                                          echo'  <ul>';
                                                        if ($countOrden==0)
                                                        {

                                                        }elseif ($countOrden>0)
                                                        {
                                                            echo'<li><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/ordenes/'.$valO->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;
                                                                <label>'.$valO->nombre.'-  '.substr($valO->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';


                                                        }

                                                                echo'</ul>';
                                                        echo '</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="true" aria-controls="collapseArchivos" style="color: white !important;">
                                                            '.$textosArray[30].'
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseArchivos" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group" >
                                                                <div class="input-group">
                                                                </div>
                                                                
                                                                <input class="d-none" type="text" id="IDPAGO'.$value->IDPAGO.'" value="<?php echo $idS;?>">
                                                                <input type="file" class="form-control input-lg fil" IdPago="'.$value->IDPAGO.'" num="3" size="5000" name="file3'.$value->IDPAGO.'" id="file3'.$value->IDPAGO.'" accept=".pdf">
                                    
                                                            </div>   <!-- ./ form-gruop-->
                                                        <div class="alert alert-danger align-center" id="tipoarchivo3'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).</div> 
                                                        <div class="alert alert-danger align-center" id="tamañoarchivo3'.$value->IDPAGO.'" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                            <button type="button" class="btn btn-primary agregarOrden"  num="3" IdPago="'.$value->IDPAGO.'">'.$textosArray[231].'</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                     
';

//                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>

                                    echo ' </div></td>
                            </tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
        <input class="d-none" type="text" id="id_usuario" value="<?php echo $idS;?>"> 
        <!--   Modals         ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!-- Modal Orden -->
        <div class="modal fade" id="modalAgregarOrdenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Subir Orden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapseOrden" id="headingOne" style="background-color: #002554 !important; ">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapseOrden" data-toggle="collapse" data-target="#collapseOrden" aria-expanded="true" aria-controls="collapseOrden" style="color: white !important;">
                                            Ordenes de compra
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOrden" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">

                                       <!-- <div class="form-group">
                                            <div class="input-group">
                                               <div class="input-group-text">
                                                   <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                               </div>
                                               <input class="form-control input-lg" type="text" name="temaOrden" id="temaOrden"  maxlength="10" placeholder="Orden de Compra" required>
                                           </div>
                                       </div> -->
                                        <div class="form-group">
                                        <span>Concepto</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-md" placeholder="Concepto" name="conceptoOrden" id="conceptoOrden" readonly>

                                            </div>
                                        </div><!-- ./ form-gruop-->
                                        <div class="form-group">
                                        <span>Monto Orden</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                </div>
                                                <input type="number" class="form-control input-md numberinput" name="montoOrden" id="montoOrden" readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->

                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                            <input type="hidden" name="IdPagoinputOrden" id="IdPagoinputOrden">


                            <div class="card">
                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="false" aria-controls="collapseArchivos" style="color: white !important;">
                                            Archivos Ordenes de compra
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseArchivos" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="form-group" >
                                                <div class="input-group">
                                                    <!--                                                        <div class="input-group-text">-->
                                                    <!--                                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>-->
                                                    <!--                                                        </div>-->

                                                    <input type="file" class="form-control input-lg " name="fileOrden" id="fileOrden" size="10000" accept=".pdf">
                                                    <input type="text" class="d-none" id="size">
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"> El tipo de archivo es invalido (solo PDF).</div>
                                            <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"> El tamaño del archivo es demaciado grande (Maximo 10 MB).</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary agregarOrden" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!-- Modal Recibos -->
        <div class="modal fade" id="modalAgregarRecibos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Subir Recibo/Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapseRecibo2" id="headingOne" style="background-color: #002554 !important; ">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapseRecibo2" data-toggle="collapse" data-target="#collapseRecibo2" aria-expanded="true" aria-controls="collapseRecibo2" style="color: white !important;">
                                            Recibos
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseRecibo2" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="form-group">
                                        <span>Concepto</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-md" placeholder="Concepto" name="conceptoRecibos" id="conceptoRecibos" readonly>

                                            </div>
                                        </div><!-- ./ form-gruop-->

                                        <div class="form-group">
                                        <span>Monto Recibo</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                </div>
                                                <input type="number" class="form-control input-md numberinput" name="montoRecibo" id="montoRecibo" readonly>
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                        <span>Comentario del Recibo</span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                </div>
                                                <textarea class="form-control input-lg" type="text" name="comentarioRecibo" id="comentarioRecibo"  maxlength="500" placeholder="Comentario" required></textarea>
                                            </div>
                                        </div><!-- ./ form-gruop-->
                                    </div>
                                </div>
                            </div>




                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                            <input type="hidden" name="IdPagoinputRecibo" id="IdPagoinputRecibo">


                            <div class="card">
                                <div class="card-header collapseArchivos2" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseArchivos2" data-toggle="collapse" data-target="#collapseArchivos2" aria-expanded="false" aria-controls="collapseArchivos2" style="color: white !important;">
                                            Archivos Recibos
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseArchivos2" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="form-group" >
                                                <div class="input-group">
                                                    <!--                                                        <div class="input-group-text">-->
                                                    <!--                                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>-->
                                                    <!--                                                        </div>-->

                                                    <input type="file" class="form-control input-lg " name="filerecibo" id="filerecibo" multiple="multiple" size="10000" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx">
                                                    <input type="text" class="d-none" id="size">
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="alert alert-danger align-center" id="tipoarchivo2" style="display: none;"> El tipo de archivo es invalido (solo PDF).</div>
                                            <div class="alert alert-danger align-center" id="tamañoarchivo2" style="display: none;"> El tamaño del archivo es demaciado grande (Maximo 10 MB).</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary agregarRecibox" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!-- Modal Validacion -->
        <div class="modal fade" id="modalValidar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="tituloValidacion"><?php echo $textosArray[244];?></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                        <input type="hidden" name="IdPagoValidar" id="IdPagoValidar">
                        <button type="button" class="btn btn-success lg btnVisualizar" ><?php echo $textosArray[251];?> </button>
                        <hr>
                        <div class="visualizarReciboOrden">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><?php echo $textosArray[252];?></span>
                                    </div>
                                    <textarea class="form-control input-md" name="txtareaFactura" id="txtareaFactura" readonly></textarea>
                                </div>
                            </div><!-- ./ form-gruop-->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><?php echo $textosArray[253];?></span>
                                    </div>
                                    <textarea class="form-control input-md" name="txtareaOrden" id="txtareaOrden" readonly></textarea>
                                </div>
                            </div><!-- ./ form-gruop-->

                            <div class="form-group">
                                <div class="input-group">
                                <div class="botonesDescarga">

                                </div>
                                </div>
                            </div><!-- ./ form-gruop-->
                        </div>
                    </div>
                    <div class="modal-footer" align="center" >
                       <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button> -->
                        <div class="footerDiv" style="display: none;">
                            <button type="button" class="btn btn-success aceptarValidacion">Aceptar</button>
                            <button type="button" class="btn btn-danger rechazarValidacion" >Rechazar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!-- Modal Recepcion -->
        <div class="modal fade" id="modalRecepcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[245];?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                        <input type="hidden" name="IdPagoRecepcion" id="IdPagoRecepcion">
                       <!-- <button type="button" class="btn btn-success lg btnVisualizar" >Visualizar </button> -->
                        <div class="visualizarReciboOrden">
                            <div class="form-group">
                            <span><?php echo $textosArray[254];?></span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="nav-icon fas fa-check"></i></span>
                                    </div>
                                    <input type="text" class="form-control input-sm" name="numeroRecepcion" id="numeroRecepcion" placeholder="<?php echo $textosArray[254];?>" >
                                </div>
                            </div><!-- ./ form-gruop-->
                            <hr color="red" size="2px">

                            <div class="visualizarReciboOrden">

                                <div class="form-group">
                                    <span>Historial</span>
                                    <input type="text" class="form-control input-sm" name="anteriorNumeroRecepcion" id="anteriorNumeroRecepcion" readonly >

                                </div><!-- ./ form-gruop-->

                            </div>
                    </div>
                    <div class="modal-footer" align="center" >
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-success guardarNumRecepcion"><?php echo $textosArray[231];?></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

<!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Modal registro -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #002554; color: white;">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[245];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                <input type="hidden" name="IdPagoRegistro" id="IdPagoRegistro">
                <!--                        <button type="button" class="btn btn-success lg btnVisualizar" >Visualizar </button>-->
                <hr>
                <div class="visualizarReciboOrden">
                    <div class="form-group">
                    <span><?php echo $textosArray[255];?></span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="nav-icon fas fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control input-sm" name="fechaRegistro" id="fechaRegistro" placeholder="Numero de Recepción" >
                        </div>
                    </div><!-- ./ form-gruop-->

                </div>
                <hr color="red" size="2px">
                <div class="visualizarReciboOrden">
                    <div class="form-group">
                        <span>Historial</span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="nav-icon fas fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control input-sm" name="anteriorfechaRegistro" id="anteriorfechaRegistro" readonly >
                        </div>
                    </div><!-- ./ form-gruop-->

                </div>
            </div>
            <div class="modal-footer" align="center" >
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                <button type="button" class="btn btn-success guardarFechaRegistro"><?php echo $textosArray[231];?></button>
            </div>

        </div>
    </div>
</div>
</div>


<!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --><
<!-- script ordenes-->
<script>
    $( ".GuardarComprobante" ).prop( "disabled", true ); 
    $( ".agregarRecibo" ).prop( "disabled", true );    
    $('.fil').change(function(event) {
        var IdPago = $(this).attr("IdPago");
        var num = $(this).attr("num");
        var archivo = $("#file"+num+IdPago).val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file'+num+IdPago)[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file'+num+IdPago).attr('size')) {//if de tamaño
            $("#tamañoarchivo"+num+IdPago).show();//mostrar archivo demaciado grande
            $( ".GuardarComprobante" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo"+num+IdPago).hide();//
                $( ".GuardarComprobante" ).prop( "disabled", false );
                $( ".agregarRecibo" ).prop( "disabled", false );
                $( ".agregarOrden" ).prop( "disabled", false );
                
                
        }
        if(extensiones != ".pdf")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo"+num+IdPago).show();
                $( ".GuardarComprobante" ).prop( "disabled", true );
                $( ".agregarRecibo" ).prop( "disabled", true );
                $( ".agregarOrden" ).prop( "disabled", true );

            }else{
                $("#tipoarchivo"+num+IdPago).hide();  
                $( ".GuardarComprobante" ).prop( "disabled", false ); 
                $( ".agregarRecibo" ).prop( "disabled", false ); 
                $( ".agregarOrden" ).prop( "disabled", false );           
            }      
    });
    $(".GuardarComprobante").click(function()
    {  
        var IdPago = $(this).attr("IdPago"); 
        var num = $(this).attr("num"); 
        var datos = new FormData();
        var funcion      = "GuardarComprobante";
        var id_pago       = IdPago;
        var id_usuario   = $("#id_usuario").val();
        var file         = $("#file"+num+IdPago)[0].files[0];

        if( file!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("id_pago", id_pago);
            datos.append("id_usuario", id_usuario);
            datos.append("file", file);

            $.ajax({
                url:"ajax/pagos.ajax.php",
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
                        text: '¡Registro Exitoso!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            // window.location = 'pagos';
                            location.reload();
                        }
                    });
                }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Registro Exitoso!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'pagos';
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
                $('.succes').show();
            });
        }else{
            Swal.fire({ 
            title: 'Error!',
            text: '¡Llenar Información!',
            icon: 'error',
            confirmButtonText:'Ok'
            });
        }
    });    

    $(".modalOrdenes").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        var concepto = $(this).attr("concepto");
        var monto = $(this).attr("monto");
        $("#modalAgregarOrdenes").modal("show");
        $("#IdPagoinputOrden").val(IdPago);
        $("#conceptoOrden").val(concepto);
        $("#montoOrden").val(monto);
    });
    $('#fileOrden').change(function(event)
    {
        var archivo = $("#fileOrden").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        extensiones = extensiones.toLowerCase();
        var fileSize = $('#fileOrden')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#fileOrden').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarOrden" ).prop( "disabled", true );
        }else{
            $("#tamañoarchivo").hide();//
            $( ".agregarOrden" ).prop( "disabled", false );
        }
        if( extensiones != ".pdf")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarOrden" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
            $( ".agregarOrden" ).prop( "disabled", false );
        }

    });

    $( ".agregarOrden" ).prop( "disabled", true );

    // $(".collapseOrden").hover(function()
    // {
    //     habiltardes();
    // });

    // $(".collapseArchivos").hover(function()
    // {
    //     habiltardes();
    // });
    $(".agregarOrden").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarOrden";

        var IdPago = $(this).attr("IdPago"); 
        var num = $(this).attr("num"); 

        // var pago       = $("#IdPagoinputOrden").val();
        var pago       = IdPago;
        var temaOrden            = $("#temaOrden").val();
        var Concepto            = $("#conceptoOrden"+IdPago).val();
        // var fechaPedido            = $("#fechaPedido").val();
        var montoOrden            = $("#montoOrden"+IdPago).val();
        // var idUser            = $("#idUser").val();
        var idUser            = $("#id_usuario").val();
        // var file         =  $("#fileOrden")[0].files[0];
        var file         =  $("#file"+num+IdPago)[0].files[0];
        //var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#fileOrden").val();
        if(Concepto!='' && montoOrden!=''  && file!='' ){

            
            datos.append("file", file);
            datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
            datos.append("temaOrden", temaOrden);
            datos.append("idUser", idUser);
            datos.append("Concepto", Concepto);
            // datos.append("fechaPedido", fechaPedido);
            datos.append("montoOrden", montoOrden);
            datos.append("funcion", funcion);
            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/ordenes.ajax.php",
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
                            text: '¡Orden guardada!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Orden guardada!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
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
                $('.succes').show();
            });
        } else {
                Swal.fire({ 
                title: 'Error!',
                text: '¡Llenar Información!',
                icon: 'error',
                confirmButtonText:'Ok'
                });
        }   
    });


    // function habiltardes()
    // {//para habilitar llenar los campos
    //     var fileOrden    = $( "#fileOrden" ).val();
    //     var IdPagoinputOrden      = $( "#IdPagoinputOrden" ).val();
    //     var temaOrden      = $( "#temaOrden" ).val();
    //     var Concepto      = $( "#Concepto" ).val();
    //     // var fechaPedido      = $( "#fechaPedido" ).val();
    //     var montoOrden      = $( "#montoOrden" ).val();

    //     var sizeval = $("#size").val();//tamaño del archivo
    //     if(temaOrden!='' && IdPagoinputOrden!=''&& Concepto!=''&& montoOrden!='' && fileOrden!='' ){
    //         $( ".agregarOrden" ).prop( "disabled", false );
    //     }else{
    //         $( ".agregarOrden" ).prop( "disabled", true );
    //     }
    //     if (fileOrden!=''){
    //         var fileSize = $('#fileOrden')[0].files[0].size;//se toma el tamaño real del archivo
    //         var siezekiloByte = parseInt(fileSize / 1024);//se parsea
    //         var extensiones = fileOrden.substring(fileOrden.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
    //         extensiones = extensiones.toLowerCase();

    //         if (siezekiloByte >  $('#fileOrden').attr('size')) {//if de tamaño
    //             $("#tamañoarchivo").show();//mostrar archivo demaciado grande
    //         }else{
    //             $("#tamañoarchivo").hide();//
    //         }
    //         if(extensiones != ".pdf")
    //         {
    //             // alert("El archivo de tipo " + extensiones + " no es válido");
    //             $("#tipoarchivo").show();
    //             $( ".agregarOrden" ).prop( "disabled", true );
    //         }else{
    //             $("#tipoarchivo").hide();
    //             $( ".agregarOrden" ).prop( "disabled", false );
    //         }
    //     }
    // };




</script>
<!-- script Recibos-->

<script>
    $(".modalRecibos").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        var concepto = $(this).attr("concepto");
        var monto = $(this).attr("monto");
        $("#modalAgregarRecibos").modal("show");
        $("#IdPagoinputRecibo").val(IdPago);
        $("#montoRecibo").val(monto);
        $("#conceptoRecibos").val(concepto);
    });

    $('#filerecibo').change(function(event) {
        var archivoRecibo = $("#filerecibo").val();//obtener el id del archivoRecibo
        var extensiones2 = archivoRecibo.substring(archivoRecibo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        extensiones2 = extensiones2.toLowerCase();


        var fileSize2 = $('#filerecibo')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize2 / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#filerecibo').attr('size')) {//if de tamaño
            $("#tamañoarchivo2").show();//mostrar archivo demaciado grande
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tamañoarchivo2").hide();//
            $( ".agregarRecibo" ).prop( "disabled", false );
        }
        if(extensiones2 != ".pdf")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo2").show();
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo2").hide();
            $( ".agregarRecibo" ).prop( "disabled", false );
        }

    });

    // $( ".agregarRecibo" ).prop( "disabled", true );

    // $(".collapseRecibo").hover(function(){
    //     habiltardes();
    // });

    // $(".collapseArchivos").hover(function(){
    //     habiltardes();
    // });

    // $(".collapseRecibo2").hover(function(){
    //     habiltardes2();
    // });

    // $(".collapseArchivos2").hover(function(){
    //     habiltardes2();
    // });

    $(".agregarRecibo").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var IdPago = $(this).attr("IdPago"); 
        var num = $(this).attr("num"); 
        var datos = new FormData();
        var funcion         ="agregarRecibo";
        // var pago       = $("#IdPagoinputRecibo").val();
        var pago       = IdPago;
        var comentarioRecibo            = $("#comentarioRecibo"+IdPago).val();
        var Concepto            = $("#conceptoRecibos"+IdPago).val();
        var montoRecibo            = $("#montoRecibo"+IdPago).val();
        var idUser            = $("#id_usuario").val();
        var file         =  $("#file"+num+IdPago)[0].files[0];


            // var file         =  document.getElementById("filerecibo");
            var file         =  document.getElementById("file"+num+IdPago);
            
        var archivos2= file.files;
        if(Concepto!='' && montoRecibo!=''  && file!='' ){
            if (archivos2.length>2)
            {
                Swal.fire({
                    title: 'Warning!',
                    text: '¡No puede subir mas de 2 archivos!',
                    icon: 'error',
                    confirmButtonText:'Ok'
                });
            }else
            {
                for (i=0;i<archivos2.length;i++)
                {
                    datos.append('archivo'+i,archivos2[i]);
                }
                // datos.append("archivo", file);
                datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
                datos.append("comentarioRecibo", comentarioRecibo);
                datos.append("idUser", idUser);
                datos.append("Concepto", Concepto);
                datos.append("montoRecibo", montoRecibo);
                datos.append("funcion", funcion);
                //datos.append("funcion", jsonPeticiones);


                $.ajax({
                    url:"ajax/recibos.ajax.php",
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
                                text: '¡Recibo guardada!',
                                icon: 'success',
                                confirmButtonText:'Ok'
                            }).then((result)=>{
                                if(result.value){
                                    // window.location = 'calendario';
                                    location.reload();
                                }
                            });
                        }else
                        {
                            Swal.fire({
                                title: 'Warning!',
                                text: '¡Recibo guardada!',
                                icon: 'warning',
                                confirmButtonText:'Ok'
                            }).then((result)=>{
                                if(result.value){
                                    // window.location = 'calendario';
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
                    $('.succes').show();
                });

            }
        } else {
                Swal.fire({ 
                title: 'Error!',
                text: '¡Llenar Información!',
                icon: 'error',
                confirmButtonText:'Ok'
                });
        } 


    });


    function habiltardes2()
    {//para habilitar llenar los campos
        var filerecibo    = $( "#filerecibo" ).val();
        var IdPagoinputRecibo      = $( "#IdPagoinputRecibo" ).val();
        var comentarioRecibo      = $( "#comentarioRecibo" ).val();
        var Concepto      = $( "#Concepto" ).val();
        var montoRecibo      = $( "#montoRecibo" ).val();


        var sizeval = $("#size").val();//tamaño del archivo
        if(comentarioRecibo!='' && IdPagoinputRecibo!=''&& Concepto!=''&& montoRecibo!='' && filerecibo!=''){
            $( ".agregarRecibo" ).prop( "disabled", false );
        }else{
            $( ".agregarRecibo" ).prop( "disabled", true );
        }

        var fileSize2 = $('#filerecibo')[0].files[0].size;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize2 / 1024);//se parsea
        var extensiones2 = filerecibo.substring(filerecibo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        extensiones2 = extensiones2.toLowerCase();

        if (siezekiloByte >  $('#filerecibo').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tamañoarchivo").hide();//
            $( ".agregarRecibo" ).prop( "disabled", false );
        }
        if(extensiones2 != ".pdf")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo2").show();
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo2").hide();
            $( ".agregarRecibo" ).prop( "disabled", false );
        }
    };




</script>
<!-- script validacion -->
<script>
    $(".aceptarValidacion").click(function()
    {
        // var status = "Validado";

        var datos = new FormData();
        var funcion         ="aceptarValidacion";
        var pago       = $("#IdPagoValidar").val();

        datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
        datos.append("funcion", funcion);
        $.ajax(
            {
                url:"ajax/validacion.ajax.php",
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
                            text: '¡Recibo guardada!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Recibo guardada!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
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
            $('.succes').show();
        });

    });

    $(".rechazarValidacion").click(function()
    {

        var datos = new FormData();
        var funcion         ="rechazarValidacion";
        var pago       = $("#IdPagoValidar").val();

        datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
        datos.append("funcion", funcion);
        $.ajax(
            {
                url:"ajax/validacion.ajax.php",
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
                            text: '¡Recibo guardada!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Recibo guardada!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
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
            $('.succes').show();
        });
    });


    $(".modalValidacion").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        var fechaVenc = $(this).attr("fechaVenc");

        $("#modalValidar").modal("show");
        $("#IdPagoValidar").val(IdPago);
        //$("#tituloValidacion").html(fechaVenc);
    });

    $(".btnVisualizar").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="buscarInfo";
        var pago       = $("#IdPagoValidar").val();
        var idUser            = $("#idUser").val();
        //var file         =  $("#fileRecibo")[0].files[0];



            datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
            datos.append("idUser", idUser);
            datos.append("funcion", funcion);
            //datos.append("funcion", jsonPeticiones);


            $.ajax(
                {
                url:"ajax/validacion.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta)
                {
                    // alert(respuesta);
                    console.log(respuesta);
                    // respuesta.forEach(
                    //     element => console.log(element)
                    //
                    // );
                    console.log(respuesta.length);
                    console.log("Factura");
                    console.log(respuesta[0][0]['concepto']);
                    console.log(respuesta[0][0]['monto']);
                    console.log(respuesta[0][0]['archivo']);
                    console.log("Orden");
                    console.log(respuesta[1][0]['concepto']);
                    console.log(respuesta[1][0]['monto']);
                    console.log(respuesta[1][0]['archivo']);
                    let Facturaval= "Concepto ->"+respuesta[0][0]['concepto']+'  Monto ->'+respuesta[0][0]['monto'];
                    let Ordenval= "Concepto ->"+respuesta[1][0]['concepto']+'  Monto ->'+respuesta[1][0]['monto'];
                    var btnFactura='<a class="btn btn-warning" download href="/relaciones/vistas/archivos/facturas/'+respuesta[0][0]['archivo']+'"><i class="fa fa-download"></i>Factura</a>';
                    console.log(btnFactura);
                    var btnOrden='<a class="btn btn-dark" download href="/relaciones/vistas/archivos/ordenes/'+respuesta[1][0]['archivo']+'"><i class="fa fa-download"></i>Orden</a>';
                    console.log(btnOrden);

                    $("#txtareaFactura").val(Facturaval);
                    $("#txtareaOrden").val(Ordenval);


                    $(".botonesDescarga").html(btnFactura+'&nbsp&nbsp&nbsp'+btnOrden);


                    $(".footerDiv").show();




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
                $('.succes').show();
            });




    });




</script>
<!--script Recepcion-->
<script>
    $(".modalRecepcion").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        $("#modalRecepcion").modal("show");
        $("#IdPagoRecepcion").val(IdPago);

        var datos = new FormData();
        var funcion         ="buscarNumRecepcion";
        datos.append("funcion",funcion);
        datos.append("IdPago",IdPago);
        $.ajax(
            {
                url:"ajax/pagos.ajax.php",
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
                    console.log(respuesta[0]);
                    console.log(respuesta[0]['num_recepcion']);


                    $("#anteriorNumeroRecepcion").val(respuesta[0]['num_recepcion']);
                }
            });

    });
    $(".guardarNumRecepcion").click(function()
    {
        var datos = new FormData();
        var funcion         ="guardarNumRecepcion";
        var pago       = $("#IdPagoRecepcion").val();
        var idUser            = $("#idUser").val();
        var numeroRecepcion = $("#numeroRecepcion").val();
        datos.append("funcion",funcion);
        datos.append("pago",pago);
        datos.append("idUser",idUser);
        datos.append("numeroRecepcion",numeroRecepcion);
        $.ajax(
            {
                url:"ajax/validacion.ajax.php",
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
                            text: '¡Exito!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Alerta!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
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
            $('.succes').show();
        });


    });
</script>
<!--script Registro -->
<script>


    $(".modalRegistro").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        $("#modalRegistro").modal("show");
        $("#IdPagoRegistro").val(IdPago);


        var datos = new FormData();
        var funcion         ="buscarFechasRecepcion";
        datos.append("funcion",funcion);
        datos.append("IdPago",IdPago);
        $.ajax(
            {
                url:"ajax/pagos.ajax.php",
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
                    console.log(respuesta[0]['fecha_programada_pago']);


                    $("#anteriorfechaRegistro").val(respuesta[0]['fecha_programada_pago']);
                }
            });

    });
    $(".guardarFechaRegistro").click(function()
    {
        var datos = new FormData();
        var funcion         ="guardarFechaRegistro";
        var pago       = $("#IdPagoRegistro").val();
        var idUser            = $("#idUser").val();
        var fechaRegistroPago = $("#fechaRegistro").val();

        datos.append("funcion",funcion);
        datos.append("pago",pago);
        datos.append("idUser",idUser);
        datos.append("fechaRegistroPago",fechaRegistroPago);
        $.ajax(
            {
                url:"ajax/validacion.ajax.php",
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
                            text: '¡Exito!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
                                location.reload();
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Alerta!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                // window.location = 'calendario';
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
            $('.succes').show();
        });


    });

    $(".btnEliminarPago").click(function()
    {

        var IdPago = $(this).attr("IdPago");
        var dataForm = new FormData();
        var funcion="eliminarPago";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("IdPago", IdPago);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¿<?php echo $textosArray[256];?>?',
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
                    url:"ajax/pagos.ajax.php",
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
                                text: '¡Listo!',
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
</script>