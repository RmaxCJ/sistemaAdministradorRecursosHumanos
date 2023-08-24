<?php

//  echo "<pre>";
//  print_r($_SESSION);
//  echo "</pre>";

if($_SESSION['id_perfil']!=1){//si no es administrador toma la informacion de la sesion 
    $paisselect= $_SESSION['pais'];
    $cod_division= $_SESSION['cod_division'];
}else{
    $paisselect= $_POST['paisSelect'];//si es administrador toma la informacion del clic del pais
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[50];?>
                    <?php   
                    if($paisselect=='mexico'){echo "México";}else if($paisselect=='argentina'){echo'Argentina';} else if($paisselect=='brasil'){echo'Brasil';}
                    else if($paisselect=='peru'){echo'Peru';} else if($paisselect=='estados unidos'){echo'USA';} else if($paisselect=='centroAmerica'){echo'CA';}
                    ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[50];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">

                <div class="box">
                <div class="box-header with-border">

                   <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarMinuta">Crear Minuta 1</button> -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregar"><?php echo $textosArray[59];?> </button>
                    <?php if($paisselect=='Mexico'){?>
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/ACTA ADMINISTRATIVA MÉXICO.docx" download="ACTA ADMINISTRATIVA MÉXICO.docx" class="btn btn-success float-right" >&nbsp;ACTA ADMINISTRATIVA MÉXICO&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                        <a   href="/relaciones/vistas/archivos/formatosconsecuencias/AMONESTACION ESCRITA MÉXICO.doc" download="AMONESTACION ESCRITA MÉXICO.doc" class="btn btn-success float-right" >&nbsp;AMONESTACION ESCRITA MÉXICO&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                    <?php } else
                    if($paisselect=='Brasil'){?>
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/Justa Causa_Portugues.doc" download="Justa Causa_Portugues.doc" class="btn btn-success float-right" >&nbsp;Justa Causa_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                        <a  href="/relaciones/vistas/archivos/formatosconsecuencias/Suspenção Disciplinar_Portugues.docx" download="Suspenção Disciplinar_Portugues.docx" class="btn btn-success float-right" >&nbsp;Suspenção Disciplinar_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                        <a  href="/relaciones/vistas/archivos/formatosconsecuencias/Advertencia Escrita_Portugues.docx" download="Advertencia Escrita_Portugues.docx" class="btn btn-success float-right" >&nbsp;Advertencia Escrita_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                    <?php } else
                    if($paisselect=='Estados Unidos'){?>
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/Warning Letter USA.doc" download="Warning Letter USA.doc" class="btn btn-success float-right" >&nbsp;Warning Letter USA&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                    <?php } else
                    if($paisselect=='Peru'){?>
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/MEMORANDUM PERU.DOCX" download="MEMORANDUM PERU.DOCX" class="btn btn-success float-right" >&nbsp;MEMORANDUM PERU&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                    <?php } else
                    if($paisselect=='CentroAmerica'){?>
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/Carta llamada de atención Centroamérica.docx" download="Carta llamada de atención Centroamérica.docx" class="btn btn-success float-right" >&nbsp;Amonestación Escrita&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                        <a href="/relaciones/vistas/archivos/formatosconsecuencias/Acta Administrativa Centroamérica .docx" download="Acta Administrativa Centroamérica .docx" class="btn btn-success float-right" >&nbsp;Acta Administrativa Centroamérica&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                    <?php }?>

                </div>
            </div>
            <br>
            <table class="table table-striped tablaDescargaReportes dt-responsive " width="100%">
                <thead>
                    <tr>
                    <th class="d-none" scope="col" width="5%">#</th>
                    <th scope="col" width="5%"><?php echo $textosArray[120];?> </th>
                    <th scope="col" width="15%"><?php echo $textosArray[112];?></th>
                    <th scope="col" width="15%"><?php echo $textosArray[160];?></th>
                    <th scope="col" width="15%"><?php echo $textosArray[79];?></th>
                    <th scope="col" width="10%"><?php echo $textosArray[163];?></th>
                    <th scope="col" width="10%"><?php echo $textosArray[67];?></th>
                        <th scope="col" width="10%"><?php echo $textosArray[130];?></th>
                        <th scope="col" width="10%">VP</th>
                        <th scope="col" width="10%"><?php echo $textosArray[132];?></th>
                        <th scope="col" width="10%"><?php echo $textosArray[31];?></th>
                        <th scope="col" width="10%"><?php echo $textosArray[106];?></th>
                    <th scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $divisionesp = ControladorDivisiones::ctrMostrarDivisionesPais($paisselect);
                    if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2){
                        $consecuencias = ControladorConsecuencias::ctrMostrarConsecuencias($paisselect,$_SESSION['divisiones']);
                    }else{
                        $consecuencias = ControladorConsecuencias::ctrMostrarConsecuencias($paisselect,$_SESSION['cod_division']);
                    }
//                    echo "<pre>";
//                    print_r($consecuencias);
//                    echo "</pre>";

                    foreach ($consecuencias as $key => $value)
                    {
                        echo'<tr>
                            <td class="d-none">'.$value->idC.'</td>
                            <td>'.$value->num_empleado.'</td>
                            <td>'.utf8_encode($value->nombre).'</td>
                            <td>'.$value->amonestacion.'</td>
                            <td>'.$value->fecha_amonestacion.'</td>
                            <td>'.$value->area_personal.'</td>
                            <td>'.utf8_encode($value->division).'</td>
                            <td>'.utf8_encode($value->posicion).'</td>
                            <td>'.utf8_encode($value->nombre_vicepresidencia).'</td>
                            <td>'.utf8_encode($value->sociedad).'</td>
                            <td>'.utf8_encode($value->nombre_area).'</td>
                            <td>'.$value->motivo_amonestacion.'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-xs " title="Editar" idc="'.$value->idC.'" data-toggle="modal" data-target="#modalEditar'.$value->idC.'"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-xs btn eliminarConsecuencia" idC="'.$value->idC.'" ><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        <div id="modalEditar'.$value->idC.'" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-xl">
                                <form role="form" enctype="multipart/form-data" id="form_" >
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #002554; color: white;">
                                            <h4 class="modal-title">Ver '.$value->num_empleado.'</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="row col-md-12"><!--no_empleado/ nombre / puesto-->
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[120].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            </div>
                                                            <input class="form-control" value="'.$value->num_empleado.'" name="cboNumEmpleadoE'.$value->idC.'" id="cboNumEmpleadoE'.$value->idC.'" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[112].' </span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg " value="'.utf8_encode($value->nombre).'" name="nombreE'.$value->idC.'" id="nombreE'.$value->idC.'" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[130].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg " value="'.$value->posicion.'" name="txtPuestoE'.$value->idC.'" id="txtPuestoE'.$value->idC.'" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-md-12"><!--tipo_epleado/Localidad/VP,DireccionGerencia-->
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[163].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg" value="'.$value->area_personal.'" name="txtTipoEmpleado'.$value->idC.'" id="txtTipoEmpleado'.$value->idC.'" maxlength="10" placeholder="" Readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[99].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg" value="'.utf8_encode($value->division).'" name="txtDivision'.$value->idC.'" id="txtDivision'.$value->idC.'" maxlength="10" placeholder="" Readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">VP</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            </div>
                                                            <select class="form-control input-lg validvp" idc="'.$value->idC.'" name="id_vpE'.$value->idC.'" id="id_vpE'.$value->idC.'" disabled>
                                                                <option value="">Seleccione una VP</option>';

                                                                $vps=ControladorDemandas::ctrVPs();

                                                                foreach ($vps as $key => $valVP)
                                                                { $selected="";
                                                                    if($value->id_vp==$valVP->id){
                                                                       $selected='selected';
                                                                    }
                                                                    echo ' <option  value="'.$valVP->id.'" '.$selected.'>'.$valVP->nombre_vicepresidencia.'</option>';
                                                                }

                                                       echo '</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-md-12"><!--Region/Pais/Area-->
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[132].' </span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg" value="'.$value->sociedad.'" name="txtRegion'.$value->idC.'" id="txtRegion'.$value->idC.'"  readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[126].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control input-lg" value="'.$value->pais.'" name="txtPais'.$value->idC.'" id="txtPais'.$value->idC.'"  readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[31].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input class="form-control" value="'.utf8_encode($value->nombre_area).'" id="id_area'.$value->idC.'" name="'.$value->idC.'" readonly>
                                                        </div>
                                                    </div>
    
    
    
                                                </div>
                                                <div class="row col-md-12"><!--TipoAmonestacion/MotivoAmonestacion/No Reincidencia-->
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[160].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <select class="form-control" name="cboConsecuencia1E'.$value->idC.'" id="cboConsecuencia1E'.$value->idC.'" disabled>';


                                                            $TCXP = ControladorConsecuencias::ctrMostrarTiposConsecuenciasxPais($paisselect);
                                                            foreach  ($TCXP as $key => $valTC)
                                                             { $selected='';
                                                                if ($value->id_tipo_amonestacion==$valTC->id){$selected='Selected';}
                                                                 echo'<option value="'.$valTC->id.'" '.$selected.'>'.$valTC->pais. ' - ' .$valTC->amonestacion.'</option>';
                                                             }


                                                    echo '</select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[107].' </span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <textarea type="text" class="form-control input-lg" name="txtMotivoAE'.$value->idC.'" id="txtMotivoAE'.$value->idC.'" maxlength="250" placeholder="" >'.$value->motivo_amonestacion.'</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">No. Reincidencia durante el año</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <select class="form-control" name="cboReincidenciaE'.$value->idC.'" id="cboReincidenciaE'.$value->idC.'" >';
                                                            if($value->num_reincidencia==1){$selectedNR1='selected';}else
                                                            if($value->num_reincidencia==2){$selectedNR2='selected';}else
                                                            if($value->num_reincidencia==3){$selectedNR3='selected';}else
                                                            if($value->num_reincidencia==4){$selectedNR4='selected';}else
                                                            if($value->num_reincidencia==5){$selectedNR5='selected';}
                                                           echo'<option value="1" '.$selectedNR1.'>1</option>
                                                                <option value="2" '.$selectedNR2.'>2</option>
                                                                <option value="3" '.$selectedNR3.'>3</option>
                                                                <option value="4" '.$selectedNR4.'>4</option>
                                                                <option value="5" '.$selectedNR5.'>5</option>';
                                                        echo'</select>
                                                            
                                                        </div>
                                                    </div>';

                                                if($value->id_amonestacion_consecuencia!=0){
                                                    echo '<div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[49].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <select class="form-control" name="consecuencia_amonestacion'.$value->idC.'" id="consecuencia_amonestacion'.$value->idC.'" disabled>';
                                                            $AC = ControladorConsecuencias::ctrMostrarConsecuenciasAmonestaciones($value->id_tipo_amonestacion);
                                                            foreach  ($AC as $key => $valAC)
                                                            {
                                                                $selectedAC='';
                                                                if ($value->id_amonestacion_consecuencia==$valAC->id){$selectedAC='Selected';}
                                                                echo'<option value="'.$valAC->id.'" '.$selectedAC.'>'.$valAC->consecuencia.'</option>';
                                                            }


                                                        echo'</select>
                                                            
                                                        </div>
                                                    </div>';
                                                }
                                                echo'</div>
                                                <div class="row col-md-12"><!--Comentarios/archivo/subirArchivo-->
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[41].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <textarea type="text" class="form-control input-lg" name="txtComentarioE'.$value->idC.'" id="txtComentarioE'.$value->idC.'" maxlength="250" placeholder="" >'.$value->comentarios.'</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[154].'</span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                            </div>
                                                            <input type="file" class="form-control input-lg fil" num="2" size="10000" name="file2E'.$value->idC.'" id="file2E'.$value->idC.'" accept=".pdf" required>
                                                        </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivo2" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivo2" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <span for="">'.$textosArray[79].' </span>
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control input-lg" value="'.$value->fecha_amonestacion.'" name="fechaAmonestacionE'.$value->idC.'" id="fechaAmonestacionE'.$value->idC.'" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <span>'.$textosArray[172].' </span><br>';
                                                        $archivosAC = ControladorConsecuencias::ctrMostrarArchivosConsecuencias($value->idC);
                                                        foreach  ($archivosAC as $key => $valAC)
                                                        {
                                                            // echo $valAC->archivo.'<br>';
                                                          echo'  <a class="btn btn-primary " download href="/relaciones/vistas/archivos/consecuencias/'.$valAC->archivo.'">'.$valAC->nombre.'</a>';
                                                        }
                                                    echo'</div>
                                                    
                                                </div>
    
    
                                            </div>
                                        </div>
    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">'.$textosArray[230].'</button>
                                            <button type="button" class="btn btn-primary guardarEdicion"  idC="'.$value->idC.'" id="" >'.$textosArray[231].'</button>
                                        </div>              
                                    </div>
                                </form>  
                            </div>
                        </div>';
                    }

                    ?>
                </tbody>
            </table>
            <!-- Modal Nuevo Agregar -->

            <div id="modalAgregar" class="modal fade" role="dialog">
                <div class="modal-dialog modal-xl">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title"><?php echo $textosArray[79];?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <div class="box-body">
                            <input type="text" class="d-none" value="<?php echo $_SESSION["id"]; ?>" name="id_usuario" id="id_usuario">
                            <input type="text" class="d-none" name="cod_division" id="cod_division">
                                <div class="row col-md-12"><!--no_empleado/ nombre / puesto-->
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[70];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select class="form-control" name="cboNumEmpleado" id="cboNumEmpleado">
                                                <option value="">---</option>
                                            <?php

                                                if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
                                                {
                                                    $num_empxdivisiones = ControladorUsuarios::ctrbuscarEmpleadoxDivisiones($_SESSION['divisiones'],$_SESSION['pais']);
                                                    foreach ($num_empxdivisiones as $key => $valUD)
                                                    {
                                                        echo'<option value="'.$valUD->num_empleado.'">'.$valUD->num_empleado.'</option>';
                                                    }

                                                }else
                                                {
                                                    $num_empxpais = ControladorUsuarios::ctrbuscarEmpleadoxPais($paisselect);
                                                    foreach ($num_empxpais as $key => $valUP)
                                                    {
                                                        echo'<option value="'.$valUP->num_empleado.'">'.$valUP->num_empleado.'</option>';
                                                    }
                                                }

                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[112];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="nombre" id="nombre" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[130];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="txtPuesto" id="txtPuesto" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12"><!--tipo_epleado/Localidad/VP,DireccionGerencia-->
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[163];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="txtTipoEmpleado" id="txtTipoEmpleado" maxlength="10" placeholder="" Readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[99];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="txtDivision" id="txtDivision" maxlength="10" placeholder="" Readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for="">VP</span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                            <select class="form-control input-lg" name="vp" id="vp">
                                            <option value="">---</option>
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
                                </div>
                                <div class="row col-md-12"><!--Region/Pais/area-->
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[132];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="txtRegion" id="txtRegion"  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[126];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="text" class="form-control input-lg read" name="txtPais" id="txtPais"  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[31];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <select class="form-control input-lg" name="area" id="area">
                                                <!-- Areas se llena por Ajax  -->
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row col-md-12"><!--TipoAmonestacion/MotivoAmonestacion/No Reincidencia-->
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[160];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                           <select class="form-control" name="cboConsecuencia1" id="cboConsecuencia1">
                                           <option value="">---</option>
                                               <?php
                                               $TCXP = ControladorConsecuencias::ctrMostrarTiposConsecuenciasxPais($paisselect);
                                               foreach  ($TCXP as $key => $valTC)
                                               {
                                                    echo'<option value="'.$valTC->id.'">'.$valTC->pais. ' - ' .$valTC->amonestacion.'</option>';
                                                }
                                               ?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[107];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <textarea type="text" class="form-control input-lg" name="txtMotivoA" id="txtMotivoA" maxlength="250" placeholder="" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[111];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <select class="form-control" name="cboReincidencia" id="cboReincidencia">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12" >
                                    <div class="col-md-4" id="AmonestacionConsecuencia1">
                                    </div>
                                    <div class="form-group col-md-4" id="tipos_archivos"  style="display:none;">
                                        <span for=""><?php echo $textosArray[30];?></span>
                                        <div class="input-group">

                                            <?php

                                                if($paisselect=='Mexico'){?>
                                                    <a id="actamexico" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/ACTA ADMINISTRATIVA MÉXICO.docx" download="ACTA ADMINISTRATIVA MÉXICO.docx" class="btn btn-success float-right" >&nbsp;ACTA ADMINISTRATIVA MÉXICO&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                                    <a id="amonesescrit" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/AMONESTACION ESCRITA MÉXICO.doc" download="AMONESTACION ESCRITA MÉXICO.doc" class="btn btn-success float-right" >&nbsp;AMONESTACION ESCRITA MÉXICO&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                        <?php   } else
                                                if($paisselect=='Brasil'){?>
                                                <a id="justacausapor" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Justa Causa_Portugues.doc" download="Justa Causa_Portugues.doc" class="btn btn-success float-right" >&nbsp;Justa Causa_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                                <a id="suspencionpor" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Suspenção Disciplinar_Portugues.docx" download="Suspenção Disciplinar_Portugues.docx" class="btn btn-success float-right" >&nbsp;Suspenção Disciplinar_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                                <a id="amonestescr" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Advertencia Escrita_Portugues.docx" download="Advertencia Escrita_Portugues.docx" class="btn btn-success float-right" >&nbsp;Advertencia Escrita_Portugues&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                            <?php } else
                                                if($paisselect=='Estados Unidos'){?>
                                                <a id="warningusa" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Warning Letter USA.doc" download="Warning Letter USA.doc" class="btn btn-success float-right" >&nbsp;Warning Letter USA&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                            <?php } else
                                                if($paisselect=='Peru'){?>
                                                <a id="memorandum" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/MEMORANDUM PERU.DOCX" download="MEMORANDUM PERU.DOCX" class="btn btn-success float-right" >&nbsp;MEMORANDUM PERU&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                            <?php } else
                                                if($paisselect=='CentroAmerica' ){?>
                                                <a id="llamadaatencionCA" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Carta llamada de atención Centroamérica.docx" download="Carta llamada de atención Centroamérica.docx" class="btn btn-success float-right" >&nbsp;Amonestación Escrita&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;

                                                <a id="actaadministrativaCA" style="display:none;" href="/relaciones/vistas/archivos/formatosconsecuencias/Acta Administrativa Centroamérica .docx" download="Acta Administrativa Centroamérica .docx" class="btn btn-success float-right" >&nbsp;Acta Administrativa Centroamérica .docx&nbsp;<i class="fa fa-file"></i></a>&nbsp;&nbsp;
                                            <?php }?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12"><!--Comentarios/archivo/subirArchivo/fecha amonestacion-->
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[41];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <textarea type="text" class="form-control input-lg" name="txtComentario" id="txtComentario" maxlength="250" placeholder="" required></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[154];?></span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="file" class="form-control input-lg fil" num="2" size='10000' name="file2" id="file2" accept=".pdf" required>
                                        </div>
                                            <div class="alert alert-danger align-center" id="tipoarchivo2" style="display: none;">
                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                            </div>
                                            <div class="alert alert-danger align-center" id="tamañoarchivo2" style="display: none;">
                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                            </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span for=""><?php echo $textosArray[79];?> </span>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control input-lg" name="fechaAmonestacion" id="fechaAmonestacion" required>
                                        </div>
                                    </div>
                                </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                                <button type="button" class="btn btn-primary agregarConsecuencia" ><?php echo $textosArray[231];?></button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- fin modal agregar -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
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
    $("#cboNumEmpleado").change(function () {
        var num_empleado = $(this).val();//tomar el atributo
        var funcion = "buscarEmpleadoByNumEmpleadoConsecuencias";
        var datos = new FormData();

        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("num_empleado", num_empleado);

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
                if (typeof (respuesta) != "undefined" && respuesta !== null) {
                    $("#nombre").val(respuesta['nombre']);  $("#txtPuesto").val(respuesta['posicion']);
                    $("#txtTipoEmpleado").val(respuesta['area_personal']); $("#txtRegion").val(respuesta['sociedad']);
                    $("#txtDivision").val(respuesta['division']); $("#txtPais").val(respuesta['pais']);
                    $("#cod_division").val(respuesta['cod_division']);
                    $(".read").css("background-color", "#86a76e"); $(".read").css("color", "#000000");
                } else {
                }
            }
        });
    });
    $("#cboConsecuencia1").change(function () {//para el tipo de consecuencia y sus amonestaciones
        var tipoConsecuencia = $(this).val();//tomar el atributo

        if(tipoConsecuencia==1){ $("#tipos_archivos").show();  $("#actamexico").show();}  else {  $("#actamexico").hide();  }
        if(tipoConsecuencia==2){ $("#tipos_archivos").show();  $("#amonesescrit").show();}  else {  $("#amonesescrit").hide();  }
        if(tipoConsecuencia==16){ $("#tipos_archivos").show();  $("#warningusa").show();}  else {  $("#warningusa").hide();  }
        if(tipoConsecuencia==14){ $("#tipos_archivos").show();  $("#memorandum").show();}  else {  $("#memorandum").hide();  }
        if(tipoConsecuencia==18||tipoConsecuencia==21||tipoConsecuencia==24||tipoConsecuencia==27||tipoConsecuencia==33)
        { $("#tipos_archivos").show();  $("#llamadaatencionCA").show();}  else {  $("#llamadaatencionCA").hide();  }
        if(tipoConsecuencia==17||tipoConsecuencia==20||tipoConsecuencia==23||tipoConsecuencia==26||tipoConsecuencia==32)
        { $("#tipos_archivos").show();  $("#actaadministrativaCA").show();}  else {  $("#actaadministrativaCA").hide();  }

        if(tipoConsecuencia==10){ $("#tipos_archivos").show();  $("#justacausapor").show();}  else {  $("#justacausapor").hide();  }
        if(tipoConsecuencia==11){ $("#tipos_archivos").show();  $("#suspencionpor").show();}  else {  $("#suspencionpor").hide();  }
        if(tipoConsecuencia==9){ $("#tipos_archivos").show();  $("#amonestescr").show();}  else {  $("#amonestescr").hide();  }



        var funcion = "buscarAmonestacionConsecuencia";
        var datos = new FormData();

        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("tipoConsecuencia", tipoConsecuencia);

        $.ajax({
            url: "ajax/consecuencias.ajax.php",
            method: "POST",
            data: datos,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",

            success: function (respuesta) {
               
                if (typeof (respuesta) != "undefined" && respuesta !== null) {
                    var stringHTML="";
                    stringHTML+=" <div class='form-group col-md-12' id='amonestacionconsecuncia'>";
                    stringHTML+="<span for=''>Tipo de Consecuencia</span>";
                    stringHTML+="<div class='input-group'>";
                    stringHTML+="<div class='input-group-text'>";
                    stringHTML+="<span class='input-group-addon'><i class='fa fa-file'></i></span>";
                    stringHTML+="</div>";
                    stringHTML+= "<select class='form-control' name='cboAC' id='cboAC' >";
                    respuesta.forEach((obj, i) => {
                        stringHTML+= "<option value='"+obj['id']+"'>"+obj['consecuencia']+"</option>";
                    // console.log(obj['id']);
                    // console.log(obj['consecuencia']);
                    });
                    stringHTML+= "</select>";
                    stringHTML+="</div>";
                    stringHTML+="</div>";
                    $("#AmonestacionConsecuencia1").html(stringHTML);
                } else {
                    $("#amonestacionconsecuncia").remove();
                }
            }
        });
    });
    $(".agregarConsecuencia").click(function()
    {   
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion                    ="agregarConsecuencia";
        var num_empleado               = $("#cboNumEmpleado").val();
        var id_vp                      = $("#vp").val();
        var area                       = $("#area").val();
        var fecha_amonestacion         = $("#fechaAmonestacion").val();
        var id_tipo_amonestacion       = $("#cboConsecuencia1").val();
        var id_amonestacion_consecuencia = $("#cboAC").val();
        if(id_amonestacion_consecuencia==undefined){id_amonestacion_consecuencia=''}
        var motivo_amonestacion        = $("#txtMotivoA").val();
        var num_reincidencia           = $("#cboReincidencia").val();
        var comentarios                = $("#txtComentario").val();
        var cod_division               = $("#cod_division").val();
        var pais                       = $("#txtPais").val();
        var file2                       =  $("#file2")[0].files[0];//logo
        var id_usuario                 = $("#id_usuario").val();
        //checar el guardado 
        // datos.append("file", file);
        if( num_empleado!='' && id_vp!='' && area!='' && fecha_amonestacion!='' && id_tipo_amonestacion!='' && motivo_amonestacion!=''&& num_reincidencia!='' && comentarios!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("num_empleado", num_empleado);
            datos.append("id_vp", id_vp);
            datos.append("area", area);
            datos.append("fecha_amonestacion", fecha_amonestacion);
            datos.append("id_tipo_amonestacion", id_tipo_amonestacion);
            datos.append("id_amonestacion_consecuencia", id_amonestacion_consecuencia);
            datos.append("motivo_amonestacion", motivo_amonestacion);
            datos.append("num_reincidencia", num_reincidencia);
            datos.append("comentarios", comentarios);
            datos.append("cod_division", cod_division);
            datos.append("pais", pais);
            datos.append("file2", file2);
            datos.append("id_usuario", id_usuario);
            
            $.ajax({
                url:"ajax/consecuencias.ajax.php",
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
                            //window.location = 'listaconsecuencias';
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
                                //   window.location = 'listaconsecuencias';
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
                $('#estatus1').attr('disabled', true);
                $('#estatus2').attr('disabled', true);
                $('#estatus3').attr('disabled', true);
                $('#estatus4').attr('disabled', true);
                $('#estatus5').attr('disabled', true);

            }

    });
    $(".guardarEdicion").click(function()
    {
        var datos              = new FormData();
        var funcion            = "actualizarConsecuencia"; 
        var idC                = $(this).attr("idC");//tomar el id
        var motivo_amonestacion= $("#txtMotivoAE"+idC).val();
        var num_reincidencia   = $("#cboReincidenciaE"+idC).val();
        var comentarios        = $("#txtComentarioE"+idC).val();
        var file2              =  $("#file2E"+idC)[0].files[0];//logo
        var fecha_amonestacion = $("#fechaAmonestacionE"+idC).val();
        var id_usuario         = $("#id_usuario").val();

        if( motivo_amonestacion!='' && num_reincidencia!='' && comentarios!=''){

            datos.append("funcion", funcion);
            datos.append("id_usuario", id_usuario);
            datos.append("idC", idC);
            datos.append("motivo_amonestacion", motivo_amonestacion);
            datos.append("num_reincidencia", num_reincidencia);
            datos.append("comentarios", comentarios);
            datos.append("fecha_amonestacion", fecha_amonestacion);
            datos.append("file2", file2);

            $.ajax({
                url:"ajax/consecuencias.ajax.php",
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
    $(".eliminarConsecuencia").click(function()
     {

         var idC = $(this).attr("idC");
         var dataForm = new FormData();
         var funcion="eliminarConsecuencia";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("idC", idC);//PARA MANDARLO A LA VARIABLE datos

         Swal.fire({
             title: '¡Estas seguro que deseas eliminar la Consecuencia?',
             text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Borrar Consecuencia'
         }).then((result) => {
             if (result.value) {
                 // window.location = "usuarios";

                 $.ajax({
                     url:"ajax/consecuencias.ajax.php",
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
                                 text: '¡Registro Exitoso!',
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
    $(".fil").change(function()
    {  
        var num = $(this).attr("num");//tomar el id
        validararchivo(num); 
    });
    function validararchivo(num){
        var archivo = $("#file"+num).val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file'+num)[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file'+num).attr('size')) {//if de tamaño
            $("#tamañoarchivo"+num).show();//mostrar archivo demaciado grande
            $( ".agregarComisiones" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo"+num).hide();//
                $( ".agregarComisiones" ).prop( "disabled", false );
        }
        if(extensiones != ".pdf")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo"+num).show();
                $( ".agregarComisiones" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo"+num).hide();  
                $( ".agregarComisiones" ).prop( "disabled", false );           
            } 
}
</script>

