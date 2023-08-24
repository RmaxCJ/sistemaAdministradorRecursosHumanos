<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[46];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[46];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <?php 
    
      
    // for ($x = 1; $x <= 5; $x++) {
      
    //     echo "The number is: $x <br>";
    //  if($x==5){
    //     echo "ultimo elemento$x";
    //   }
    // }
    ?> 
    
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
               <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarMinuta">Crear Minuta 1</button> -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarComision"><?php echo $textosArray[274];?> </button>
            </div>
        </div>
        <br>

        <table class="table table-striped tabladatatable dt-responsive" width="100%">
            <thead>  
            <tr>
                <th width="33%" scope="col"><?php echo $textosArray[67];?></th>
                <th width="33%" scope="col"><?php echo $textosArray[197];?></th>
                <!--th width="33%" scope="col">vencidas</th-->
            </tr>
            </thead>
            <tbody>
            <?php

            if($_SESSION['id_perfil']==2){
                $comisionesdivisiones = ControladorComisiones::ctrMostrarComisionesDivisiones($_SESSION['divisiones']); 
                $comisiones = ControladorComisiones::ctrMostrarComisiones($_SESSION['divisiones']); 
            }
            elseif($_SESSION['id_perfil']==1)
            {
                $comisionesdivisiones = ControladorComisiones::ctrMostrarComisionesDivisiones($_SESSION['cod_division']); 
                $comisiones = ControladorComisiones::ctrMostrarComisiones($_SESSION['cod_division']); 
            }
            // $comisionesdivisiones = ControladorComisiones::ctrMostrarComisionesDivisiones(); 

            // $comisiones = ControladorComisiones::ctrMostrarComisiones(); 
            foreach ($comisiones as $key => $value)
            {  
                echo'<tr>
            <td>'.utf8_encode($value->division).'</td>
            <!--td>
                <button style="display:inline;" class="btn btn-success btn-xs btnHistorialRit" idRit="'.$value->cod_division.'" data-toggle="modal" data-target="#btnHistorialComision_'.$value->id.'">&nbsp;Explorar&nbsp;<i class="fa fa-history"></i></button>';
                if($value->estatus1==2){ echo '<div title="Comisión Mixta de RIT (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></div>';}
                if($value->estatus2==2){ echo '<div title="Cuadro General de Antigüedades (Vencida)" style="width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></div>';}
                if($value->estatus3==2){ echo '<div title="Comisión Mixta de PTU (Vencida)" style="width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></div>';}
                if($value->estatus4==2){ echo '<div title="Comision Mixta de Seguridad e Higiene (Vencida)" style="width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></div>';}
                if($value->estatus5==2){ echo '<div title="Comision Mixta de Productividad Capacitación y Adiestramiento (Vencida)" style="width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></div>';}
            echo '</td-->
            <td><button style="display:inline;" class="btn btn-success btn-xs btnHistorialRit" idRit="'.$value->cod_division.'" data-toggle="modal" data-target="#btnHistorialComision_'.$value->id.'">&nbsp;Explorar&nbsp;<i class="fa fa-history"></i></button>&nbsp;';
            if($value->estatus1==2){ echo '<button title="Comisión Mixta de RIT (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';}
            //Validacion de Fechas
            if((date("Y-m-d") >=$value->fecha_inicio2) && (date("Y-m-d") <= $value->fecha_termino2)){  }else{ 
                // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                echo '<button title="Cuadro General de Antiguedades (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
            }
            if((date("Y-m-d") >=$value->fecha_inicio3) && (date("Y-m-d") <= $value->fecha_termino3)){  }else{ 
                // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                echo '<button title="Comisión Mixta de PTU (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
            }
            if((date("Y-m-d") >=$value->fecha_inicio4) && (date("Y-m-d") <= $value->fecha_termino4)){  }else{ 
                // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                echo '<button title="Comision Mixta de Seguridad e Higiene (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
            }
            if((date("Y-m-d") >=$value->fecha_inicio5) && (date("Y-m-d") <= $value->fecha_termino5)){  }else{ 
                // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                echo '<button title="Comision Mixta de Productividad Capacitación y Adiestramiento (Vencida)" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
            }
            echo '</td>';
            echo '</tr>';
            
            //////////////////////////////////////////////historial Rit
            echo'<div id="btnHistorialComision_'.$value->id.'" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-xl">
                        <!--form role="form" enctype="multipart/form-data" id="formLider_'.$value->cod_division.'" -->
                            <div class="modal-content">
                            <div class="modal-header" style="background-color: #002554; color: white;">
                                <h4 class="modal-title">Historial   '.$value->division.' </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <div class="box-body" style="height:600px; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                    <div class="form-group col-md-6">
                                        <span>División </span><!-------------------------------->
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input  class="form-control" name="" id="" value="'.$value->division.'" disabled>
                                            <input  class="form-control d-none" name="" id="cod_divisionEdit" value="'.$value->cod_division.'" disabled>
            
                                        </div>
                                    </div><!-- ./ form-gruop-->
                                    <div id="accordion">
                                        <div class="card"><!--------------------------------------------Comision Mixta de RIT Edit-------------------------------------------------------------------------------->
                                            <div class="card-header collapse_1E" id="headingOneE" style="background-color:#002554; color:white; !important;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapse_1E" data-toggle="collapse" data-target="#collapse_1E" aria-expanded="true" aria-controls="collapse_1E" style="color: white !important;">
                                                    Comision Mixta de RIT
                                                    </button>
                                                    <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN RIT.docx" download="COMISIÓN RIT.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>';
                                                    if($value->estatus1==2){$disabled=""; echo '<button class="float-right" title="Vencida" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';}else{$disabled="disabled";}
                                                     
                                                echo ' 
                                                </h5>
                                            </div>
                                            <div id="collapse_1E" class="collapse " aria-labelledby="headingOneE" data-parent="#accordion"><!--show-->
                                                <div class="card-body">
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Archivo Comisión Mixta de RIT</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <input type="file" class="form-control input-lg fil fileritE" size="10000" num="1" idfilerit="'.$value->id.'" name="fileE1'.$value->id.'" id="fileE1'.$value->id.'" accept=".pdf" '.$disabled.'><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                                
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivoE1" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivoE1" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->
                                        
                                                        <div class="form-group col-md-6">
                                                            <span>Estatus</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <select class="form-control" name="estatusE1'.$value->id.'" id="estatusE1'.$value->id.'" disabled>';
                                                               
                                                                $selected1='';  $selected2='';
                                                                if($value->estatus1==1){ $selected1='selected'; }else if($value->estatus1==2){$selected2='selected'; }
                                                                echo '<option value="1" '.$selected1.'>Completa/Vigente</option>
                                                                      <option value="2" '.$selected2.'>Pendiente/ Vencida</option>
                                                                </select>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->     
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Inicio de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechainiciovigenciaE1'.$value->id.'" value="'.$value->fecha_inicio1.'" id="fechainiciovigenciaE1'.$value->id.'" '.$disabled.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop--> 
                                                        <!--div class="form-group col-md-6">
                                                            <span>Fecha Termino de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechaterminovigenciaE1'.$value->id.'" value="'.$value->fecha_termino1.'" id="fechaterminovigenciaE1'.$value->id.'" disabled>
                                                            </div>
                                                        </div-->   <!-- ./ form-gruop-->       
                                                    </div>
                                                
                                                    <div class="row col-md-12">                                                                                  
                                                        <ul class="col-md-8" style="height:100px;  width:100%; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                                        <label for="">Historial</label>';
                                                        $tipo_com=1;
                                                        $comcoddiv = ControladorComisiones::ctrMostrarArchivoComisiones($value->cod_division,$tipo_com); 
                                                        foreach ($comcoddiv as $key => $valid)
                                                        {  
                                                            if($valid->tipo_comisiones==1){
                                                                if ($valid === reset($comcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                                    // -'.$valid->fecha_alta.'
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                        <div class="form-group col-md-4">
                                                            <!--button class="btn btn-primary btn-sm float-center updaterit" id="'.$value->id.'" tipo="1" name="" title="Solo Administrador">Cambio</button-->&nbsp;';
                                                        if($value->estatus1==2){ 
                                                            echo'<button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" cod_division="'.$value->cod_division.'" tipo="1" name="" title="Actualizar Información">Guardar</button>';
                                                        }
                                                        if($_SESSION["id_perfil"]=='1'){
                                                        echo'<button class="btn btn-primary btn-sm float-center updaterit" id="'.$value->id.'" tipo="1" name="" title="Solo Administrador">Cambio</button>&nbsp;';
                                                        echo'<button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" cod_division="'.$value->cod_division.'" tipo="1" name="" title="Actualizar Información">Guardar (Administrador)</button>';
                                                        }
                                                        echo'</div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card"><!------------------------------------Cuadro General de Antiguedades------------------------------------------------------------------>
                                            <div class="card-header collapse_2E" id="headingTwoE" style="background-color:#002554; color:white; !important;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapse_2E" data-toggle="collapse" data-target="#collapse_2E" aria-expanded="true" aria-controls="collapse_2E" style="color: white !important;">
                                                    Cuadro General de Antigüedades
                                                    </button>
                                                    <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN CUADRO GENERAL DE ANTIGUEDADES.docx" download="COMISIÓN CUADRO GENERAL DE ANTIGUEDADES.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>';
                                                    if((date("Y-m-d") >=$value->fecha_inicio2) && (date("Y-m-d") <= $value->fecha_termino2)){$disabled2="disabled";  }else{ $disabled2=""; 
                                                        // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                                                        echo '<button class="float-right" title="Vencida" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
                                                    }
                                                echo'
                                                </h5>
                                            </div>
                                            <div id="collapse_2E" class="collapse " aria-labelledby="headingTwoE" data-parent="#accordion"><!--show-->
                                                <div class="card-body">
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Archivo Cuadro General de Antigüedades</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <input type="file" class="form-control input-lg fil" size="10000" num="1" name="fileE2'.$value->id.'" id="fileE2'.$value->id.'" accept=".pdf" '.$disabled2.'><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                                
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivoE2" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivoE2" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->';
                                                            $sel2= 'selectedE2'.$value->id;                                                       
                                                        if((date("Y-m-d") >=$value->fecha_inicio2) && (date("Y-m-d") <= $value->fecha_termino2)){ $sel2=''; }else{ 
                                                             
                                                           $sel2='selected';
                                                        }

                                                        echo'<div class="form-group col-md-6">
                                                            <span>Estatus</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <select class="form-control" name="estatusE2'.$value->id.'" id="estatusE2'.$value->id.'" disabled>';
                                                            
                                                                $selected1='';  $selected2='';
                                                                if($value->estatus2==2){ $selected1='selected'; }else if($value->estatus2==2){$selected2='selected'; }
                                                                echo '<option value="1" '.$selected1.'>Completa/Vigente</option>
                                                                    <option value="2" '.$selected2.' '.$sel2.'>Pendiente/ Vencida</option>
                                                                </select>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->     
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Inicio de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg " tipo="2" idcom="'.$value->id.'" name="fechainiciovigenciaE2'.$value->id.'" value="'.$value->fecha_inicio2.'" id="fechainiciovigenciaE2'.$value->id.'" onchange="check_in_range(2,'.$value->id.')" '.$disabled2.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop--> 
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Termino de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechaterminovigenciaE2'.$value->id.'" value="'.$value->fecha_termino2.'" id="fechaterminovigenciaE2'.$value->id.'" onchange="check_in_range(2,'.$value->id.')" '.$disabled2.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->       
                                                    </div>
                                                
                                                    <div class="row col-md-12">                                                                                  
                                                        <ul class="col-md-8" style="height:100px;  width:100%; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                                        <label for="">Historial</label>';
                                                        $tipo_com=2;
                                                        $comcoddiv = ControladorComisiones::ctrMostrarArchivoComisiones($value->cod_division,$tipo_com);
                                                        foreach ($comcoddiv as $key => $valid)
                                                        {  
                                                            if($valid->tipo_comisiones==2){
                                                                if ($valid === reset($comcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver " class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                                    // -'.$valid->fecha_alta.'
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                        <div class="form-group col-md-4">';
                                                        if((date("Y-m-d") >=$value->fecha_inicio2) && (date("Y-m-d") <= $value->fecha_termino2)){ }else{ 
                                                        
                                                            echo '<!--button class="btn btn-primary btn-sm float-center update" id="'.$value->id.'" tipo="2" name="" title="Solo Administrador">Cambio Anticipado</button-->&nbsp;
                                                            <button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" tipo="2" cod_division="'.$value->cod_division.'" name="" title="Actualizar Información">Guardar</button>';
                                                        }
                                                       echo' </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card"><!------------------------------------Comisión Mixta de PTU------------------------------------------------------------------>
                                            <div class="card-header collapse_3E" id="headingthreeE" style="background-color:#002554; color:white; !important;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapse_3E" data-toggle="collapse" data-target="#collapse_3E" aria-expanded="true" aria-controls="collapse_3E" style="color: white !important;">
                                                    Comisión Mixta de PTU
                                                    </button>
                                                    <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN PTU.docx" download="COMISIÓN PTU.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>';
                                                    if((date("Y-m-d") >=$value->fecha_inicio3) && (date("Y-m-d") <= $value->fecha_termino3)){ $disabled3="disabled"; }else{ 
                                                        $disabled3="";
                                                        // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                                                        echo '<button class="float-right" title="Vencida" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
                                                    }
                                                echo'
                                                </h5>
                                            </div>
                                            <div id="collapse_3E" class="collapse " aria-labelledby="headingthreeE" data-parent="#accordion"><!--show-->
                                                <div class="card-body">
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Comisión Mixta de PTU</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <input type="file" class="form-control input-lg fil" size="10000" num="1" name="fileE3'.$value->id.'" id="fileE3'.$value->id.'" accept=".pdf" '.$disabled3.'><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                                
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivo3E" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivo3E" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->';
                                                        $sel3= 'selectedE3'.$value->id;                                                       
                                                    if((date("Y-m-d") >=$value->fecha_inicio3) && (date("Y-m-d") <= $value->fecha_termino3)){ $sel3=''; }else{ 
                                                         
                                                       $sel3='selected';
                                                    }

                                                echo'   <div class="form-group col-md-6">
                                                            <span>Estatus</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <select class="form-control" name="estatusE3'.$value->id.'" id="estatusE3'.$value->id.'" disabled>';
                                                            
                                                                $selected1='';  $selected2='';
                                                                if($value->estatus3==3){ $selected1='selected'; }else if($value->estatus3==3){$selected2='selected'; }
                                                                echo '<option value="1" '.$selected1.'>Completa/Vigente</option>
                                                                    <option value="2" '.$selected2.' '.$sel3.'>Pendiente/ Vencida</option>
                                                                </select>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->     
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Inicio de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechainiciovigenciaE3'.$value->id.'" value="'.$value->fecha_inicio3.'" id="fechainiciovigenciaE3'.$value->id.'" onchange="check_in_range(3,'.$value->id.')" '.$disabled3.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop--> 
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Termino de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechaterminovigenciaE3'.$value->id.'" value="'.$value->fecha_termino3.'" id="fechaterminovigenciaE3'.$value->id.'" onchange="check_in_range(3,'.$value->id.')" '.$disabled3.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->       
                                                    </div>
                                                
                                                    <div class="row col-md-12">                                                                                  
                                                        <ul class="col-md-8" style="height:100px;  width:100%; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                                        <label for="">Historial</label>';
                                                        $tipo_com=3;
                                                        $comcoddiv = ControladorComisiones::ctrMostrarArchivoComisiones($value->cod_division,$tipo_com);
                                                        foreach ($comcoddiv as $key => $valid)
                                                        {  
                                                            if($valid->tipo_comisiones==3){
                                                                if ($valid === reset($comcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                                    // -'.$valid->fecha_alta.'
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                        <div class="form-group col-md-4">';
                                                        if((date("Y-m-d") >=$value->fecha_inicio3) && (date("Y-m-d") <= $value->fecha_termino3)){ }else{
                                                         
                                                            echo'<!--button class="btn btn-primary btn-sm float-center update" id="'.$value->id.'" tipo="3" name="" title="Solo Administrador">Cambio Anticipado</button-->&nbsp;
                                                            <button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" tipo="3" cod_division="'.$value->cod_division.'" name="" title="Actualizar Información">Guardar</button>';
                                                        }
                                                       echo'</div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card"><!---------------------------------Comision Mixta de Seguridad e Higiene------------------------------------------------------------------>
                                            <div class="card-header collapse_4E" id="headingForE" style="background-color:#002554; color:white; !important;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapse_4E" data-toggle="collapse" data-target="#collapse_4E" aria-expanded="true" aria-controls="collapse_4E" style="color: white !important;">
                                                    Comision Mixta de Seguridad e Higiene
                                                    </button><a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN DE SEGURIDAD E HIGIENE.docx" download="COMISIÓN DE SEGURIDAD E HIGIENE.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>';
                                                    if((date("Y-m-d") >=$value->fecha_inicio4) && (date("Y-m-d") <= $value->fecha_termino4)){ $disabled4="disabled"; }else{ $disabled4=""; 
                                                        // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                                                        echo '<button class="float-right" title="Vencida" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
                                                    }
                                                echo'
                                                
                                                </h5>
                                            </div>
                                            <div id="collapse_4E" class="collapse " aria-labelledby="headingForE" data-parent="#accordion"><!--show-->
                                                <div class="card-body">
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Comision Mixta de Seguridad e Higiene</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <input type="file" class="form-control input-lg fil" size="10000" num="1" name="fileE4'.$value->id.'" id="fileE4'.$value->id.'" accept=".pdf" '.$disabled4.'><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                                
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivoE4" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivoE4" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->';
                                                        $sel4= 'selectedE4'.$value->id;                                                       
                                                    if((date("Y-m-d") >=$value->fecha_inicio4) && (date("Y-m-d") <= $value->fecha_termino4)){ $sel=''; }else{ 
                                                         
                                                       $sel4='selected';
                                                    }

                                                echo'   <div class="form-group col-md-6">
                                                            <span>Estatus</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <select class="form-control" name="estatusE4'.$value->id.'" id="estatusE4'.$value->id.'" disabled>';
                                                            
                                                                $selected1='';  $selected2='';
                                                                if($value->estatus4==4){ $selected1='selected'; }else if($value->estatus4==4){$selected2='selected'; }
                                                                echo '<option value="1" '.$selected1.'>Completa/Vigente</option>
                                                                    <option value="2" '.$selected2.' '.$sel4.'>Pendiente/ Vencida</option>
                                                                </select>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->     
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Inicio de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechainiciovigenciaE4'.$value->id.'" value="'.$value->fecha_inicio4.'" id="fechainiciovigenciaE4'.$value->id.'" onchange="check_in_range(4,'.$value->id.')" '.$disabled4.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop--> 
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Termino de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechaterminovigenciaE4'.$value->id.'" value="'.$value->fecha_termino4.'" id="fechaterminovigenciaE4'.$value->id.'" onchange="check_in_range(4,'.$value->id.')" '.$disabled4.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->       
                                                    </div>
                                                
                                                    <div class="row col-md-12">                                                                                  
                                                        <ul class="col-md-8" style="height:100px;  width:100%; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                                        <label for="">Historial</label>';
                                                        $tipo_com=4;
                                                        $comcoddiv = ControladorComisiones::ctrMostrarArchivoComisiones($value->cod_division,$tipo_com);
                                                        foreach ($comcoddiv as $key => $valid)
                                                        {  
                                                            if($valid->tipo_comisiones==4){
                                                                if ($valid === reset($comcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                                    // -'.$valid->fecha_alta.'
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                        <div class="form-group col-md-4">';
                                                        if((date("Y-m-d") >=$value->fecha_inicio4) && (date("Y-m-d") <= $value->fecha_termino4)){ }else{
                                                        
                                                           echo' <!--button class="btn btn-primary btn-sm float-center update" id="'.$value->id.'" tipo="4" name="" title="Solo Administrador">Cambio Anticipado</button-->&nbsp;
                                                            <button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" tipo="4" cod_division="'.$value->cod_division.'" name="" title="Actualizar Información">Guardar</button>';
                                                        }
                                                  echo' </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card"><!-------------------------Comision Mixta de Productividad Capacitación y Adiestramiento-------------------------------------------------->
                                            <div class="card-header collapse_5E" id="headingFiveE" style="background-color:#002554; color:white; !important;">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapse_5E" data-toggle="collapse" data-target="#collapse_5E" aria-expanded="true" aria-controls="collapse_5E" style="color: white !important;">
                                                    Comision Mixta de Productividad Capacitación y Adiestramiento
                                                    </button>';
                                                    if((date("Y-m-d") >=$value->fecha_inicio5) && (date("Y-m-d") <= $value->fecha_termino5)){  $disabled5="disabled"; }else{ $disabled5="";
                                                        // echo'<button class="btn btn-danger btn-xs"><i class="fa fa-circle"></i></button>'; 
                                                        echo '<button class="float-right" title="Vencida" style="display:inline; width: 20px; height: 20px; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%; background: red;"></button>';
                                                    }
                                                echo'</h5>
                                            </div>
                                            <div id="collapse_5E" class="collapse " aria-labelledby="headingFiveE" data-parent="#accordion"><!--show-->
                                                <div class="card-body">
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Archivo Comision Mixta de Productividad Capacitación y Adiestramiento</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <input type="file" class="form-control input-lg fil" size="10000" num="1" name="fileE5'.$value->id.'" id="fileE5'.$value->id.'" accept=".pdf" '.$disabled5.'><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                                
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tipoarchivoE5" style="display: none;">
                                                                <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                            </div>
                                                            <div class="alert alert-danger align-center" id="tamañoarchivoE5" style="display: none;">
                                                                <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->';
                                                        $sel5= 'selectedE5'.$value->id;                                                       
                                                    if((date("Y-m-d") >=$value->fecha_inicio5) && (date("Y-m-d") <= $value->fecha_termino5)){ $sel5=''; }else{ 
                                                         
                                                       $sel5='selected';
                                                    }

                                                echo'   <div class="form-group col-md-6">
                                                            <span>Estatus</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                                </div>
                                                                <select class="form-control" name="estatusE5'.$value->id.'" id="estatusE5'.$value->id.'" disabled>';
                                                            
                                                                $selected1='';  $selected2='';
                                                                if($value->estatus5==1){ $selected1='selected'; }else if($value->estatus5==2){$selected2='selected'; }
                                                                echo '<option value="1" '.$selected1.'>Completa/Vigente</option>
                                                                    <option value="2" '.$selected2.' '.$sel5.'>Pendiente/ Vencida</option>
                                                                </select>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->     
                                                    </div>
                                                    <div class="row  col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Inicio de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechainiciovigenciaE5'.$value->id.'" value="'.$value->fecha_inicio5.'" id="fechainiciovigenciaE5'.$value->id.'" onchange="check_in_range(5,'.$value->id.')" '.$disabled5.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop--> 
                                                        <div class="form-group col-md-6">
                                                            <span>Fecha Termino de Vigencia</span>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                                <input type="date" class="form-control input-lg" name="fechaterminovigenciaE5'.$value->id.'" value="'.$value->fecha_termino5.'" id="fechaterminovigenciaE5'.$value->id.'" onchange="check_in_range(5,'.$value->id.')" '.$disabled5.'>
                                                            </div>
                                                        </div>   <!-- ./ form-gruop-->       
                                                    </div>
                                                
                                                    <div class="row col-md-12">                                                                                  
                                                        <ul class="col-md-8" style="height:100px;  width:100%; border: 1px solid #ddd;  background: #f1f1f1;  overflow-y: scroll;">
                                                        <label for="">Historial</label>';
                                                        $tipo_com=5;
                                                        $comcoddiv = ControladorComisiones::ctrMostrarArchivoComisiones($value->cod_division,$tipo_com);
                                                        foreach ($comcoddiv as $key => $valid)
                                                        {  
                                                            if($valid->tipo_comisiones==5){
                                                                if ($valid === reset($comcoddiv)) {
                                                                    echo '<li style="color:red;"><a title="Ver" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;&nbsp;&nbsp;Vigente</li>';
                                                                }else{
                                                                    echo '<li><a title="Ver Logo" class="btn btn-danger btn-sm" href="/relaciones/vistas/archivos/comisiones/'.$valid->archivo.'" target="_blak"><i class="fa fa-eye">&nbsp;PDF</i></a>&nbsp;&nbsp;&nbsp;';
                                                                    echo '<label>'.$valid->nombre.'-  '.substr($valid->fecha_alta,0,11).'</label>&nbsp;&nbsp;</li>';
                                                                    // -'.$valid->fecha_alta.'
                                                                }
                                                            }
                                                        }
                                                        
                                                        echo '</ul>
                                                        <div class="form-group col-md-4">';
                                                        if((date("Y-m-d") >=$value->fecha_inicio4) && (date("Y-m-d") <= $value->fecha_termino4)){ }else{
                                                            echo'<!--button class="btn btn-primary btn-sm float-center update" id="'.$value->id.'" tipo="5" name="" title="Solo Administrador">Cambio Anticipado</button-->&nbsp;
                                                            <button class="btn btn-success btn-sm float-center actualizar" id="'.$value->id.'" tipo="5" cod_division="'.$value->cod_division.'" name="" title="Actualizar Información">Guardar</button>';
                                                        }
                                                   echo'</div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                    
                            </div>              
                            </div>
                        <!--/form-->  
                </div>';
            }?>
                
            </tbody>
        </table>
        
            <!-- Modal -->
            <div class="modal fade" id="modalAgregarComision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[13];?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">

                            <input class="d-none" type="text" id="id_usuario" value="<?php echo $idS;?>">                     
                            <div class="form-group col-md-6">
                                <span><?php echo $textosArray[67];?> </span><!-------------------------------->
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <select name="cboCod_Division" id="cboCod_Division" class="form-control">
                                    <?php
                                    foreach ($comisionesdivisiones as $key => $valDXP)
                                    {
                                        $cod_div=$valDXP->cod_division;
                                        if($cod_div!='2S01' && $cod_div!='2S02' && $cod_div!='2S03' && $cod_div!='2S04' && $cod_div!='2S05'){
                                            echo '<option value="'.$valDXP->cod_division.'">'.utf8_encode($valDXP->division).'</option>';
                                        }
                                    }
                                    
                                    ?>
                                    </select>

                                </div>
                            </div><!-- ./ form-gruop-->
    
                            <div id="accordion">
                                <div class="card"><!--------------------------------------------Comision Mixta de RIT-------------------------------------------------------------------------------->
                                    <div class="card-header collapse_1" id="headingOne" style="background-color:#002554; color:white; !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapse_1" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1" style="color: white !important;">
                                                <?php echo $textosArray[45];?>
                                            </button>
                                            <!-- <button title="Formato Comision Mixta de rit" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-dowload"></i></button> -->
                                            <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN RIT.docx" download="COMISIÓN RIT.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>
                                        </h5>
                                    </div>
                                    <div id="collapse_1" class="collapse " aria-labelledby="headingOne" data-parent="#accordion"><!--show-->
                                        <div class="card-body">
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[25];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control input-lg fil filerit" size='10000' num="1" name="file1" id="file1" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                        
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tipoarchivo1" style="display: none;">
                                                        <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tamañoarchivo1" style="display: none;">
                                                        <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[72];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <select class="form-control" name="estatus1" id="estatus1" disabled ="true">
                                                        <option value="">---</option>
                                                        <option value="1">Completa/Vigente</option>
                                                        <option value="2">Pendiente/ Vencida</option>
                                                        <q></q>
                                                        </select>
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->     
                                            </div>
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[85];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" name="fechainiciovigencia1" id="fechainiciovigencia1" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop--> 
                                                <!-- <div class="form-group col-md-6">
                                                    <span>Fecha Termino de Vigencia</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" name="fechaterminovigencia1" id="fechaterminovigencia1" >
                                                    </div>
                                                </div>    -->
                                                <!-- ./ form-gruop-->       
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <button class="btn btn-success" id="" name="" title="Solo Administrador">Cambio Anticipado</button>
                                            </div>                                                                                       -->
                                        </div>
                                    </div>
                                    <div id="btn_formato_comision_rit" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-xl" >
                                            <!-- <form role="form" enctype="multipart/form-data" id="formLider_'.$value->cod_division.'" > -->
                                                <div class="modal-content" style="background: hsla(214, 100%, 16%, 0.7); color: white;">
                                                    <div class="modal-header" style="background-color: #002554; color: white;">
                                                        <h4 class="modal-title">Formato Comisión mixta de Rit</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="box-body">
                                                            <div id="contenido" class="container-fluid" style="background-color: white; color: black; height: 500px;  width: 100%;  overflow-y: scroll;">
                                                            <div style="display:inline;"><input  id="text1" ></div>
                                                                <div class="text-justify" style="margin-left: 50px; margin-right: 50px;">
                                                                    <h3>Comisión mixta de Rit</h3>
                                                                    
                                                                    <!-- <span id="1"> </span> -->

                                                                    <span style="display:inline;">
                                                                    Desde  hace más de</span>  <span style="display:inline;" id="1"> </span style="display:inline;"> <span>cuatro décadas, en Rotoplas tenemos como misión contribuir a mejorar la calidad de vida de las personas; por ello, día con día, nos enfocamos en crear soluciones que faciliten el tener más y mejor agua.  Somos una compañía líder, de origen mexicano, con una tradición que nos impulsa a crecer sostenidamente en México y a traspasar fronteras para llevar nuestras soluciones de Almacenamiento, Conducción, Calentamiento Purificación y Mejoramiento del agua a otros países.</span> 
                                                                    <p>Nuestra pasión es innovar y desarrollar nuevas tecnologías que nos permitan brindar soluciones de agua individuales y con servicio de alta calidad y máxima garantía, acorde a las necesidades hídricas que presenta cada país, industria y clientes.</p> 
                                                                    <p>Como Empresa Socialmente Responsable, mantenemos un firme compromiso de ayudar a las comunidades más vulnerables mediante nuestros diferentes programas sociales, siempre ocupándonos de contar con procesos y soluciones sustentables que contribuyan a preservar el medio ambiente para el bienestar de ésta y las generaciones por venir.</p>
                                                                    <h4><strong>Objetivo</strong></h4>
                                                                    <ul>
                                                                        <li></li>
                                                                    </ul>
                                                                    <h4><strong>Perfil</strong></h4>
                                                                    <ul>
                                                                    </ul>
                                                                    <h4><strong>Funciones</strong></h4>
                                                                    <ul>
                                                                            <li></li>
                                                                    </ul>
                                                                    <h4><strong>Competencias</strong></h4>
                                                                    <ul>     
                                                                    </ul>
                                                                    <h4><strong>Aviso de Privacidad:</strong></h4>
                                                                    <p>ROTOPLAS S.A. de C.V., con domicilio en Calle Pedregal #24 Piso 19, Colonia Molino del Rey, Delegación Miguel Hidalgo, C.P. 11040, México D.F., comprometido con la privacidad y manejo adecuado de los datos personales de candidatos y empleados, y de conformidad con la Ley Federal de Protección de Datos Personales en Posesión de Particulares y su Reglamento, registra sus datos personales sensibles y/o financieros para los efectos mencionados en el presente Aviso de Privacidad. Haciendo de su conocimiento que sus datos personales serán resguardados y tratados con base en los principios de licitud, calidad, consentimiento, información, finalidad, lealtad, proporcionalidad y responsabilidad, consagrados en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y su Reglamento. Para mayor detalle por favor consulte la página <a href="http://www.rotoplas.com/aviso-de-privacidad.html">http://www.rotoplas.com/aviso-de-privacidad.html</a></p>

                                                                    </p>
                                                                </div>                                                        
                                                            </div>                                                                                                       
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="background-color: #002554; color: white;">
                                                            <a href="#" onclick="javascript:demoFromHTML();"><button class="btn btn-info">Exportar a PDF</button></a>  
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                                    </div>              
                                                </div>
                                            <!-- </form>   -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card"><!------------------------------------------------------Cuadro General de Antiguedades------------------------------------------------------------->
                                    <div class="card-header collapse_2" id="headingTwo" style="background-color:#002554; color:white; !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed collapse_2" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" aria-controls="collapse_2" style="color: white !important;">
                                                <?php echo $textosArray[60];?>
                                            </button>
                                            <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN CUADRO GENERAL DE ANTIGUEDADES.docx" download="COMISIÓN CUADRO GENERAL DE ANTIGUEDADES.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>
                                        </h5>
                                    </div>
                                    <div id="collapse_2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[29];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control input-lg fil" num="2" size='10000' name="file2" id="file2" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                        
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tipoarchivo2" style="display: none;">
                                                        <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tamañoarchivo2" style="display: none;">
                                                        <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->

                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[72];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <select class="form-control" name="estatus2" id="estatus2" disabled="true">
                                                        <option value="">---</option>
                                                        <option value="1">Completa/Vigente</option>
                                                        <option value="2">Pendiente/ Vencida</option>
                                                        <q></q>
                                                        </select>
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->     
                                            </div>
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[85];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(2)" name="fechainiciovigencia2" id="fechainiciovigencia2" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop--> 
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[86];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(2)" name="fechaterminovigencia2" id="fechaterminovigencia2" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->       
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <button class="btn btn-success" id="" name="" title="Solo Administrador">Cambio Anticipado</button>
                                            </div>                                                  -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card"><!--------------------------------------------------Comisión Mixta de PTU-------------------------------------------------------------------------->
                                    <div class="card-header collapse_3" id="headingAcuerdos" style="background-color:#002554; color:white; !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed collapse_3" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" aria-controls="collapse_3" style="color: white !important;">
                                                <?php echo $textosArray[43];?>
                                            </button>
                                            <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN PTU.docx" download="COMISIÓN PTU.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>
                                        </h5>
                                    </div>
                                    <div id="collapse_3" class="collapse" aria-labelledby="headingAcuerdos" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[27];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control input-lg fil" num="3" size='10000' name="file3" id="file3" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                        
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tipoarchivo3" style="display: none;">
                                                        <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tamañoarchivo3" style="display: none;">
                                                        <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                                <div class="form-group col-md-6">
                                                    <span>Estatus</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <select class="form-control" name="estatus3" id="estatus3" disabled="true">
                                                        <option value="">--Seleccione--</option>
                                                        <option value="1">Completa/Vigente</option>
                                                        <option value="2">Pendiente/ Vencida</option>
                                                        <q></q>
                                                        </select>
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->     
                                            </div>
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[85];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(3)" name="fechainiciovigencia3" id="fechainiciovigencia3" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop--> 
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[86];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(3)" name="fechaterminovigencia3" id="fechaterminovigencia3" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->       
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <button class="btn btn-success" id="" name="" title="Solo Administrador">Cambio Anticipado</button>
                                            </div>                                             -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card"><!------------------------------------------------Comision Mixta de Seguridad e Higiene------------------------------------------------------------>
                                    <div class="card-header collapse_4" id="" style="background-color:#002554; color:white; !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed collapse_4" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4" style="color: white !important;">
                                                <?php echo $textosArray[44];?>
                                            </button>
                                            <a href="/relaciones/vistas/archivos/comisionesformatosautorizados/COMISIÓN DE SEGURIDAD E HIGIENE.docx" download="COMISIÓN DE SEGURIDAD E HIGIENE.docx" class="btn btn-success float-right" >&nbsp;Formato Autorizado&nbsp;<i class="fa fa-file"></i></a>
                                        </h5>
                                    </div>
                                    <div id="collapse_4" class="collapse" aria-labelledby="" data-parent="#accordion">
                                        <div class="card-body">  
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[28];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control input-lg fil" num="4" size='10000' name="file4" id="file4" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                        
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tipoarchivo4" style="display: none;">
                                                        <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tamañoarchivo4" style="display: none;">
                                                        <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                                <div class="form-group col-md-6">
                                                    <span>Estatus</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <select class="form-control" name="estatus4" id="estatus4" disabled="true">
                                                        <option value="">--Seleccione--</option>
                                                        <option value="1">Completa/Vigente</option>
                                                        <option value="2">Pendiente/ Vencida</option>
                                                        <q></q>
                                                        </select>
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->     
                                            </div>
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[85];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg"  onchange="check_in_range1(4)" name="fechainiciovigencia4" id="fechainiciovigencia4" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop--> 
                                                <div class="form-group col-md-6">
                                                    <span><?php echo $textosArray[86];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(4)" name="fechaterminovigencia4" id="fechaterminovigencia4" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->       
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <button class="btn btn-success" id="" name="" title="Solo Administrador">Cambio Anticipado</button>
                                            </div>    -->
                                        </div>
                                    </div>
                                </div>

                                <div class="card"><!----------------------------------------Comision Mixta de Productividad Capacitación y Adiestramiento-------------------------------------------->
                                    <div class="card-header collapse_5" id="headingArchivos" style="background-color:#002554; color:white; !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" aria-controls="collapse_5" style="color: white !important;">
                                                <?php echo $textosArray[42];?>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse_5" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span> <?php echo $textosArray[26];?></span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <input type="file" class="form-control input-lg fil" num="5" size='10000' name="file5" id="file5" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                        
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tipoarchivo5" style="display: none;">
                                                        <strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).
                                                    </div>
                                                    <div class="alert alert-danger align-center" id="tamañoarchivo5" style="display: none;">
                                                        <strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->
                                                <div class="form-group col-md-6">
                                                    <span>Estatus</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                        </div>
                                                        <select class="form-control" name="estatus5" id="estatus5" disabled ="true">
                                                        <option value="">--Seleccione--</option>
                                                        <option value="1">Completa/Vigente</option>
                                                        <option value="2">Pendiente/ Vencida</option>
                                                        <q></q>
                                                        </select>
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->     
                                            </div>
                                            <div class="row  col-md-12">
                                                <div class="form-group col-md-6">
                                                    <span>Fecha Inicio de Vigencia</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(5)" name="fechainiciovigencia5" id="fechainiciovigencia5" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop--> 
                                                <div class="form-group col-md-6">
                                                    <span>Fecha Termino de Vigencia</span>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control input-lg" onchange="check_in_range1(5)" name="fechaterminovigencia5" id="fechaterminovigencia5" >
                                                    </div>
                                                </div>   <!-- ./ form-gruop-->       
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <button class="btn btn-success" id="" name="" title="Solo Administrador">Cambio Anticipado</button>
                                            </div>    -->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                            <button type="button" class="btn btn-primary agregarComisiones" title="Para habilitar llenar todos los campos">231</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<script>
$(document).ready (function () {
    $(".update").click(function()//para el boton que habilita la los campos 
    {
        var tipo = $(this).attr("tipo");//tomar el id  
        var id = $(this).attr("id");//tomar el id   
        $("#fileE"+tipo+id).removeAttr("disabled");
        // $("#estatusE"+tipo+id).removeAttr("disabled");
        $("#fechainiciovigenciaE"+tipo+id).removeAttr("disabled");
        $("#fechaterminovigenciaE"+tipo+id).removeAttr("disabled");
    });
    $(".updaterit").click(function()//para el boton que habilita la los campos 
    {
        var tipo = $(this).attr("tipo");//tomar el id  
        var id = $(this).attr("id");//tomar el id   
        $("#fileE"+tipo+id).removeAttr("disabled");
        $("#estatusE"+tipo+id).removeAttr("disabled");
        $("#fechainiciovigenciaE"+tipo+id).removeAttr("disabled");
        $("#fechaterminovigenciaE"+tipo+id).removeAttr("disabled");
    });

    $(".actualizar").click(function()
    {
        
        var tipo            = $(this).attr("tipo");//tomar el id
        var cod_division    = $(this).attr("cod_division");//tomar el id
        var id              = $(this).attr("id");//tomar el id
        var datos           = new FormData();
        var funcion         = "actualizarComisiones";
        $("#estatusE"+tipo+id).attr('disabled', false);
        var id_usuario      = $("#id_usuario").val();
        if($("#fileE"+tipo+id)[0].files[0]!=undefined){
            var file           = $("#fileE"+tipo+id)[0].files[0];
        }else{
            var file   ="";
        }
        
        var estatus1        = $("#estatusE"+tipo+id).val();
        var fecha_inicio1   = $("#fechainiciovigenciaE"+tipo+id).val();
        if($("#fechaterminovigenciaE"+tipo+id).val()!=undefined){
        var fecha_termino1  = $("#fechaterminovigenciaE"+tipo+id).val();
        }else{
            var d = new Date(); var month = d.getMonth()+1; var day = d.getDate();
            var date_now = d.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;//fecha actuao
            var fecha_termino1=date_now;
        }

        if( cod_division!='' && file!=undefined && estatus1!='' && fecha_inicio1!='' && fecha_termino1!=''){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("id_usuario", id_usuario);
            datos.append("id", id);
            datos.append("tipo", tipo);
            datos.append("cod_division", cod_division);
            datos.append("file", file);
            datos.append("estatus", estatus1);
            datos.append("fecha_inicio", fecha_inicio1);
            datos.append("fecha_termino", fecha_termino1);


            $.ajax({
                url:"ajax/comisiones.ajax.php",
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
                            window.location = 'comisiones';
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
                                window.location = 'comisiones';
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
            $("#estatusE"+tipo+id).attr('disabled', true);
        }   

    });
    

    $(".fileritE").change(function()
    {
        var idfil = $(this).attr("idfilerit");//tomar el id
        var id = $(this).attr("id");//tomar el id
        var file1 =$("#"+id).val();
        if(file1!=''){
            $("#estatusE1"+idfil).val(1);
        }else{
            $("#estatusE1"+idfil).val(1);
        }
    });  
    $(".filerit").change(function()
    {
        
        var file1 =$("#file1").val();
        if(file1!=''){
            $("#estatus1").val(1);
        }else{
            $("#estatus1").val(1);
        }
    });  
    $(".fil").change(function()
    {  
        var num = $(this).attr("num");//tomar el id
        validararchivo(num); 
    });
    $(".agregarComisiones").click(function()
    {  
        $('#estatus1').attr('disabled', false);
        $('#estatus2').attr('disabled', false);
        $('#estatus3').attr('disabled', false);
        $('#estatus4').attr('disabled', false);
        $('#estatus5').attr('disabled', false);

        var datos = new FormData();
        var funcion               = "agregarComisiones";
        var id_usuario            = $("#id_usuario").val();
        var cod_division          = $("#cboCod_Division").val();
        var file1                 = $("#file1")[0].files[0];
        var estatus1              = $("#estatus1").val();
        var fecha_inicio1         = $("#fechainiciovigencia1").val();
        // var fecha_termino1        = $("#fechaterminovigencia1").val();
        var file2                 = $("#file2")[0].files[0];
        var estatus2              = $("#estatus2").val();
        var fecha_inicio2         = $("#fechainiciovigencia2").val();
        var fecha_termino2        = $("#fechaterminovigencia2").val();
        var file3                 = $("#file3")[0].files[0];
        var estatus3              = $("#estatus3").val();
        var fecha_inicio3         = $("#fechainiciovigencia3").val();
        var fecha_termino3        = $("#fechaterminovigencia3").val();
        var file4                 = $("#file4")[0].files[0];
        var estatus4              = $("#estatus4").val();
        var fecha_inicio4         = $("#fechainiciovigencia4").val();
        var fecha_termino4        = $("#fechaterminovigencia4").val();
        var file5                 = $("#file5")[0].files[0];
        var estatus5              = $("#estatus5").val();
        var fecha_inicio5         = $("#fechainiciovigencia5").val();
        var fecha_termino5        = $("#fechaterminovigencia5").val();
        

        if( cod_division!='' && file1!=undefined && estatus1!='' && fecha_inicio1!='' && file2!=undefined && estatus2!='' && fecha_inicio2!='' && fecha_termino2!=''&& file3!=undefined && estatus3!='' && fecha_inicio3!='' && fecha_termino3!=''&& file4!=undefined && estatus4!='' && fecha_inicio4!='' && fecha_termino4!=''&& file5!=undefined && estatus5!='' && fecha_inicio5!='' && fecha_termino5!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("id_usuario", id_usuario);
            datos.append("cod_division", cod_division);
            datos.append("file1", file1);
            datos.append("estatus1", estatus1);
            datos.append("fecha_inicio1", fecha_inicio1);
            // datos.append("fecha_termino1", fecha_termino1);
            datos.append("file2", file2);
            datos.append("estatus2", estatus2);
            datos.append("fecha_inicio2", fecha_inicio2);
            datos.append("fecha_termino2", fecha_termino2);
            datos.append("file3", file3);
            datos.append("estatus3", estatus3);
            datos.append("fecha_inicio3", fecha_inicio3);
            datos.append("fecha_termino3", fecha_termino3);
            datos.append("file4", file4);
            datos.append("estatus4", estatus4);
            datos.append("fecha_inicio4", fecha_inicio4);
            datos.append("fecha_termino4", fecha_termino4);
            datos.append("file5", file5);
            datos.append("estatus5", estatus5);
            datos.append("fecha_inicio5", fecha_inicio5);
            datos.append("fecha_termino5", fecha_termino5);

            $.ajax({
                url:"ajax/comisiones.ajax.php",
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
                            window.location = 'comisiones';
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
                                window.location = 'comisiones';
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
    $("#text1").keyup(function()
    {  
        $("#1").append('');
       var text1 = $("#text1").val();
       $("#1").text(text1);
         
    });
});
function check_in_range1(tipo ) {
    var date_start= $("#fechainiciovigencia"+tipo).val();//fecha inicial 
    var date_end= $("#fechaterminovigencia"+tipo).val();//fecha final 
    var d = new Date(); var month = d.getMonth()+1; var day = d.getDate();
    var date_now = d.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;//fecha actuao
//    $date_start = strtotime($date_start);
//    $date_end = strtotime($date_end);
//    $date_now = strtotime($date_now);
   if ((date_now >= date_start) && (date_now <= date_end)){
    // alert('si');
    $("#estatus"+tipo).val(1);
   }else{
    // alert('no');
    $("#estatus"+tipo).val(2);
   }
}

function check_in_range(tipo, id ) {
    var date_start= $("#fechainiciovigenciaE"+tipo+id).val();//fecha inicial 
    var date_end= $("#fechaterminovigenciaE"+tipo+id).val();//fecha final 
    var d = new Date(); var month = d.getMonth()+1; var day = d.getDate();
    var date_now = d.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;//fecha actuao
//    $date_start = strtotime($date_start);
//    $date_end = strtotime($date_end);
//    $date_now = strtotime($date_now);
   if ((date_now >= date_start) && (date_now <= date_end)){
    // alert('si');
    $("#estatusE"+tipo+id).val(1);
   }else{
    // alert('no');
    $("#estatusE"+tipo+id).val(2);
   }
}

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
function demoFromHTML() 
    {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#contenido')[0];
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 20,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                pdf.save('levantamientoPerfil.pdf');
            }, margins
        );
    }
 </script>
<!-- /.content-wrapper --><?php ?>
