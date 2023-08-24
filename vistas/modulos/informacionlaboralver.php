<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ver Información Laboral</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver Información Laboral</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <table class="table table-striped tabladatatable dt-responsive table-sm" width="100%">
            <thead>  
                <tr>
                    <th width="33%" scope="col">Mes</th>
                    <th width="33%" scope="col">Año</th>
                    <th width="33%" scope="col">Archivo</th>
                    <th width="33%" scope="col">País</th>
                    <th width="33%" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //  $divisiones=ControladorDivisiones::ctrMostrarDivisionesSoloPais();
                 
                $inflab = ControladorInformacion::ctrMostrarArchivoInformacion($_SESSION['pais'], $_SESSION['cod_division'] );
                // echo "<pre>";
                // print_r($inflab);
                // echo "</pre>";
                foreach ($inflab as $key => $value)
                {
                    if ($value->mes==1){$mes='Enero';}
                    elseif($value->mes==2){$mes='Febrero';}
                    elseif($value->mes==3){$mes='Marzo';}
                    elseif($value->mes==4){$mes='Abril';}
                    elseif($value->mes==5){$mes='Mayo';}
                    elseif($value->mes==6){$mes='Junio';}
                    elseif($value->mes==7){$mes='Julio';}
                    elseif($value->mes==8){$mes='Agosto';}
                    elseif($value->mes==9){$mes='Septiembre';}
                    elseif($value->mes==10){$mes='Octubre';}
                    elseif($value->mes==11){$mes='Noviembre';}
                    elseif($value->mes==12){$mes='Diciembre';}
                    else{$mes='';}

                    echo'<tr>
                <td>'.utf8_encode($mes).'</td>
                <td>'.utf8_encode($value->anio).'</td>
                <td>'.utf8_encode($value->nombre).'</td>
                <td>'.utf8_encode($value->pais).'</td>
                <td>
                        <button title="Archivos" class="btn btn-success btn-sm" data-toggle="modal" data-target="#btnArchivo_'.$value->idIL.'">&nbsp;Archivo&nbsp;<i class="fa fa-file"></i></button>
                </td>
                </tr>';
                
                //////////////////////////////////////////////
                echo'<div id="btnArchivo_'.$value->idIL.'" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                           
                                <div class="modal-content">
                                <div class="modal-header" style="background-color: #002554; color: white;">
                                    <h4 class="modal-title">'.utf8_encode($value->idIL).'</h4> 
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">
                                    <div class="box-body"> 
                                    <ul>';
                                   
                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/informacionlaboral/'.$value->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                    echo '<label>'.$value->nombre.'-  '.substr($value->fecha_alta,0,11).'</label></li>';
                                    
                                    echo '</ul>
                                                                                                            
                            
                                    </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                        
                                </div>              
                                </div>
                           
                </div>';
                }
                ?>
                    
            </tbody>
        </table>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

