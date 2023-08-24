<?php
//if ($_SESSION['usuario']=='anava')
//{
//    $_SESSION['cod_division']='4M01';
//}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $textosArray[178];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[178];?></li>
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
            
               <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarMinuta">Crear Minuta 1</button> -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMinuta2"><?php echo $textosArray[217];?> </button>

            </div>
        </div>
        <br>
        <table class="table table-striped tabladatatable dt-responsive " width="100%">
            <thead>
                <tr>
                <th class="d-none" scope="col" width="5%">#</th>
                <th scope="col" width="25%"><?php echo $textosArray[176];?></th>
                <th scope="col" width="10%"><?php echo $textosArray[193];?></th>
                <th scope="col" width="15%"><?php echo $textosArray[209];?></th>
                <th scope="col" width="10%"><?php echo $textosArray[218];?></th>
                <!-- <th scope="col" width="15%">Comentarios</th> -->
                <!-- <th scope="col" width="15%">Estatus</th> -->
                <th scope="col" width="10%"><?php echo $textosArray[219];?></th>
                <th scope="col" width="10%"><?php echo $textosArray[12];?></th>
                </tr>
            </thead>
            <tbody>


            <?php
            // echo "aqui<br>";
            //   $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
            //   $sindicatos = ControladorSindicatos::ctrMostrarSindicatos();
//                $divisiones = ControladorDivisiones::ctrMostrarDivisiones();
                $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
                
                $empleados = ControladorUsuarios::ctrMostrarEmpleados();

            if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
            {
                $minutas = ControladorMinutas::ctrMostrarMinutas($_SESSION['divisiones'],"");
                $divisiones = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']);
                $sindicatos = ControladorSindicatos::ctrMostrarSindicatos("",$_SESSION['divisiones']);

            }
            elseif ($_SESSION['id_perfil']==4)
            {
                $minutas = ControladorMinutas::ctrMostrarMinutas("",$_SESSION['pais']);
                $divisiones = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']);
                $sindicatos = ControladorSindicatos::ctrMostrarSindicatos($_SESSION['pais'],"");

            }
            elseif ($_SESSION['id_perfil']==1)
            {
                $minutas = ControladorMinutas::ctrMostrarMinutas("admin","admin");
                $divisiones = ControladorDivisiones::ctrMostrarDivisiones("");
                $sindicatos = ControladorSindicatos::ctrMostrarSindicatos("","");

            }



//                        echo "<pre>";
//                  print_r($sindicatos);
//                  echo "</pre>";
                //  echo count($minutas);
            
                foreach ($minutas as $key => $value)
                {
                    $tamaño=strlen($value->sindicato);
                    $tamañoF=$tamaño/3;
                    $tamañoF=$tamañoF*2;      
                    $id_minuta =$value->idm;
                    echo'<tr>
                <td class="d-none">'.$value->idm.'</td>
                
                <td title="'.utf8_encode($value->sindicato).'" style="text-decoration:none">'.utf8_encode(substr($value->sindicato, 0,50)).'...</td>
                             
                <td>';
                foreach ($divisiones as $key => $valD)//Del controlador divisiones  realizo la busqueda
                {
                  $coddivision=$valD->cod_division;
                  $codplanta=$value->cod_division;
                  if($coddivision==$codplanta){
                    echo utf8_encode($valD->division);
                  }
                }
                
                
                echo '</td>
                <td>'.$value->tema.'</td>';
                // echo'<!--td>';
                // $temas = ControladorMinutas::ctrMostrarTemasMinutasID($value->idm);
                // foreach ($temas as $key => $valT)
                //     {
                //             echo utf8_encode($valT->tema).'<br>';
                //     }
                // echo'</td-->';
                 echo'<!--td>'.$value->idu.'</td-->
                <td>';

                foreach ($usuariossencillos as $key => $valU) {
                    $id_usuario=$value->id_usuario_responsable;//---->de la tabla de minuta
                    $idusu = $valU->id;
                    $idperfil = $valU->id_perfil;
                    $nombre_usuario = $valU->nombre_usuario;
                    $id_resp = $valU->id_responsable;
                    $num_empleado = $valU->num_empleado;

                    if($idusu==$id_usuario){
                        if ($nombre_usuario != null) {
                            echo'<p>'.utf8_encode($nombre_usuario).'</p>';
                        } 
                        else 
                        {
                            $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoM($num_empleado);
                            foreach ($empleadosData as $key => $valE)
                                {
                                    $nombre=$valE->nombre;
                                    echo'<p>'.utf8_encode($nombre).'</p>';
                                }
                        }
                    }                   
                }
                // if($value->id_usuario_responsable!=0){
                //     foreach ($usuariossencillos as $key => $valU)//
                //     {
                //     $idusuario=$valU->id;
                //     $id_usuario=$value->id_usuario_responsable;
                //     if($idusuario==$id_usuario){
                //         if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') {
                //             echo utf8_encode($valU->nombre_usuario);
                //             }
                //             else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
                //                 $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                //                 foreach ($empleadosData as $key => $valE)
                //                     {
                //                         $nombre=$valE->nombre;
                //                             echo utf8_encode($nombre);
                //                     }
                //             }
                //     }
                //     }
                // }else{
                //     echo '<h5 class="card-title" id="">'.utf8_encode($value->usuario_responsable).'</h5>';
                // }
                // if($value->id_usuario_responsable!=0){
                //     $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoPais();
                //     foreach ($empleadosData as $key => $valE)
                //     {
                //         $idusuario=$valE->idE;
                //         $id_usuario=$value->id_usuario_responsable;
                //         $nombre=$valE->nombre;
                //         if($idusuario==$id_usuario){
                //             echo $valE->idE.' - '.utf8_encode($nombre);
                //         }
                //     }
                // }else{
                //         echo utf8_encode($value->usuario_responsable);
                //     }

                echo '</td>
                <!--td>'.$value->generales.'</td-->
                <!--td>';
                // echo $value->estatus;
                if ( $value->estatus=='A') : echo 'Activo';  elseif ($value->estatus=='B'): echo 'Baja'; endif;
                echo '</td-->
                <td>'.$value->fecha_alta.'</td>
                <td align="center">
                    <div class="btn-group">
                           <!--button class="btn btn-warning btn-xs btnEditarMinutas" id="'.$value->idm.'" data-toggle="modal" data-target="#modalEditarMinutas_'.$value->idm.'"><i class="fas fa-pencil-alt"></i></button-->
                            <!--button class="btn btn-warning btn-xs btnEditMinuta" idMinuta="'.$value->idm.'" title="Editar minuta"><i class="fas fa-pencil-alt"></i></button-->
                            <button class="btn btn-success btn-xs " title="Revisar Minuta" data-toggle="modal" data-target="#reviewPDF_'.$value->idm.'">&nbsp;<i class="fa fa-eye "></i>&nbsp;</button>
                            <button class="btn btn-danger btn-xs btnEliminarMinuta" idMinuta="'.$value->idm.'" title="Eliminar minuta"><i class="fa fa-times"></i></button>
                           
                            

                    </div></td>
                </tr>';
                echo'<div class="modal fade" id="reviewPDF_'.$value->idm.'" tabindex="-1" role="dialog" aria-labelledby="reviewPDF_'.$value->idm.'" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="background: hsla(214, 100%, 16%, 1); color: white;">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" >Revisión minuta ('.$value->idm.') </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div   style="background-color: white; color: black; height: 500px;  width: 100%;  overflow-y: scroll;">
                
                            <div class="text-justify" style="margin-left: 50px; margin-right: 50px;" id="content'.$value->idm.'">
                            <br>
                                <h3>'.$textosArray[232].'</h3>
                                <br>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[176];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="">'.$value->id_sindicato.' - '.utf8_encode($value->sindicato).'</h5>
                                    </div>
                                </div>
                                <div class="card">
                                <div class="card-header">
                                    <label>Lugar</label>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" id="">'.$value->lugar.'</h5>
                                </div>
                            </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label>Tema</label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="">'.$value->tema.'</h5>
                                    </div>
                                </div>
                                <div class="card">
                                <div class="card-header">
                                    <label>Temas</label>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" id="">';
                                    $temas = ControladorMinutas::ctrMostrarTemasMinutasID($value->idm);   
                                    foreach ($temas as $key => $valT)
                                        {
                                                echo utf8_encode($valT->tema).'<br>';
                                        }

                                echo'</h5>
                                </div>
                            </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label>Usuario Responsable</label>
                                    </div>
                                    <div class="card-body">
                                        <!--h5 class="card-title" id="">'.$value->id_usuario.' - '.$value->usuario.'</h5-->';

                                    // if($value->id_usuario_responsable!=0){
                                    //     foreach ($usuariossencillos as $key => $valU)//
                                    //     {
                                    //       $idusuario=$valU->id;
                                    //       $id_usuario=$value->id_usuario_responsable;
                                    //       if($idusuario==$id_usuario){
                                    //         if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') { 
                                    //             //  utf8_encode($valU->nombre_usuario);
                                    //             echo '<h5 class="card-title" id="">'.utf8_encode($valU->nombre_usuario).'</h5>';
                                    //             }
                                    //             else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
                                    //                 $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                    //                 foreach ($empleadosData as $key => $valE)
                                    //                     {
                                    //                         $nombre=$valE->nombre;
                                    //                             // echo utf8_encode($nombre);
                                    //                             echo '<h5 class="card-title" id="">'.utf8_encode($nombre).'</h5>';
                                    //                     }
                                    //             }
                                    //       }
                                    //     }
                                    // }else{
                                    //     echo '<h5 class="card-title" id="">'.utf8_encode($value->usuario_responsable).'</h5>';
                                    // }
                                    foreach ($usuariossencillos as $key => $valU) {
                                        $id_usuario=$value->id_usuario_responsable;//---->de la tabla de minuta
                                        $idusu = $valU->id;
                                        $idperfil = $valU->id_perfil;
                                        $nombre_usuario = $valU->nombre_usuario;
                                        $id_resp = $valU->id_responsable;
                                        $num_empleado = $valU->num_empleado;
                    
                                        if($idusu==$id_usuario){
                                            if ($nombre_usuario != null) {
                                                echo'<p>'.utf8_encode($nombre_usuario).'</p>';
                                            } 
                                            else 
                                            {
                                                $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoM($num_empleado);
                                                foreach ($empleadosData as $key => $valE)
                                                    {
                                                        $nombre=$valE->nombre;
                                                        echo'<p>'.utf8_encode($nombre).'</p>';
                                                    }
                                            }
                                        }                   
                                    }

                                echo '</div>
                                </div>
                                <!--div class="card">
                                    <div class="card-header">
                                        <label>Generales</label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="">'.$value->generales.'</h5>
                                    </div>
                                </div-->
                                <div class="card">
                                    <div class="card-header">
                                        <label>Hora Inicio/Finalización</label>
                                    </div>
                                    <div class="card-body">
                                    <div class="row"><label>Hora Inicio  :&nbsp;&nbsp;</label><br><h5 class="card-title" id="">'.substr($value->horainicio,0,8).'</h5></div>
                                    <div class="row"><label>Hora Finalización  :&nbsp;&nbsp;</label><br><h5 class="card-title" id="">'.substr($value->horafinal,0,8).'</h5></div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label>Asistente</label>
                                    </div>
                                    <div class="card-body">
                                    <div id="">';
                                    $minutasasistentes = ControladorMinutas::ctrMostrarAsistentesMinutasID($id_minuta);
                                    foreach ($minutasasistentes as $key => $vala)
                                    {   
                                        $nombre_asistente = $vala->nombre_asistente; 
                                        $nombre_asistentesr = $vala->nombre_asistentesr;
                                        $nombreA='';
                                        if( $nombre_asistente!='NA'){
                                         $nombreA=$nombre_asistente;
                                        }else {
                                         $nombreA=$nombre_asistentesr;
                                        }

                                        echo    '<ul>
                                                    <li><label>Asistente : </label> '.$nombreA.'</li>

                                                </ul>';
                                        
                                    }
                                        echo '</div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label>Acuerdos</label>
                                    </div>
                                    <div class="card-body">
                                    <div id="">';
                                    $minutasacuerdosid = ControladorMinutas::ctrMostrarAcuerdosMinutasID($id_minuta);
                                    foreach ($minutasacuerdosid as $key => $valacmid)
                                    {   
                                        echo    '<ul>
                                                    <li><label>Acuerdo : </label> '.$valacmid->acuerdo.'</li>
                                                    <li><label>Fecha compromiso : </label> '.$valacmid->fecha_compromiso.'</li>
                                                    <li><label>Responsable : </label> '.$valacmid->responsable.'</li>
                                                    <li><label>Comentarios :</label> '.$valacmid->comentarios.'</li>
                                                </ul>';
                                        
                                    }
                                        echo '</div>
                                    
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label>Archivo</label>
                                    </div>
                                    <div class="card-body">
    
                                    <div id=""> 
                                        </div>
                                         <a class="btn btn-primary btn-xs" download href="/relaciones/vistas/archivos/minutas/'.$value->archivo.'"><i class="fa fa-download"></i></a>
                                         <a href="/relaciones/vistas/archivos/minutas/'.$value->archivo.'" target="_blank"><button type="button" class="btn btn-primary btn-xs d-non">Ver</button></a>
                                        
                                    </div>
                                </div>                               
                            </div>
                        </div>

                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" id="cerrarprev" data-dismiss="modal">Cerrar</button>
                            <!--a href="javascript:demoFromHTML('.$value->idm.')"> <button type="button" class="btn btn-danger" id="descargar pdf" id="'.$value->idm.'" title="Descargar minuta" >PDF&nbsp;<i class="fa fa-file"></i></button></a-->           
                            <a href="vistas/modulos/formatominuta2.php?id='.$value->idm.'" target=”_blank”> <button type="button" class="btn btn-danger" id="descargar pdf" id="'.$value->idm.'"  title="Formato minuta" >Formato&nbsp;<i class="fa fa-file"></i></button></a>           
                        
                        </div>
                    </div>
                </div>
            </div>';
          
               

                }
                ?>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="modalAgregarMinuta2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Minuta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapseMinutas" id="headingOne" style="background-color:#002554; color:white; !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapseMinutas" data-toggle="collapse" data-target="#collapseMinutas" aria-expanded="true" aria-controls="collapseMinutas" style="color: white !important;">
                                            Minutas
                                        </button>
                                    </h5>
                                </div>
                                
                                <div id="collapseMinutas" class="collapse " aria-labelledby="headingOne" data-parent="#accordion"><!--show-->
                                    <div class="card-body">
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-6">
                                            <span><?php echo $textosArray[176];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="cbo_sindicato" id="cbo_sindicato" required>
                                                        <?php

                                                        if ($_SESSION['id_perfil']==3)
                                                        {
                                                            $sindicato=ControladorSindicatos::ctrMostrarSindicatoxDivision($_SESSION['divisiones']);
//                                                            print_r($sindicato);
//                                                            echo $sindicato[0]->sindicato;
                                                            $tamaño=strlen($sindicato[0]->sindicato);
                                                            $tamañoF=$tamaño/3;
                                                            $tamañoF=$tamañoF*2;
                                                            echo'<option title="'.utf8_encode($sindicato[0]->sindicato).'" value="'.$sindicato[0]->id.'">'.utf8_encode(substr($sindicato[0]->sindicato, 0,-$tamañoF)).' - '. utf8_encode($sindicato[0]->division).'('.$sindicato[0]->cod_division.')</option>';

                                                        }
                                                        else
                                                        {
                                                            echo '<option value="">Seleccionar sindicato</option>';
                                                            foreach ($sindicatos as $key => $valS)
                                                            {
                                                                $tamaño=strlen($valS->sindicato);
                                                                $tamañoF=$tamaño/3;
                                                                $tamañoF=$tamañoF*2;
                                                                echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.$valS->id.'-'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).' - '. utf8_encode($valS->division).'</option>';

//
                                                            }

                                                        }






                                                        //                                                        CODIGO ORIGINAL NO BORRAR HASTA DESPUES DE PRUEBAS
//                                                        foreach ($sindicatos as $key => $valS)
//                                                        {
//                                                            $tamaño=strlen($valS->sindicato);
//                                                            $tamañoF=$tamaño/3;
//                                                            $tamañoF=$tamañoF*2;
//
//                                                            $id = $valS->id;
//                                                            $id = $valS->id_perfil;
//                                                            $cod_division = $valS->cod_division;
//
//                                                            foreach ($divisiones as $key => $valD)//Del controlador divisiones  realizo la busqueda
//                                                            {
//                                                              $coddivision=$valD->cod_division;//de la consulta de divisiones
//
//                                                              $divisionname="";
//                                                              if($coddivision==$cod_division)
//                                                              {
//                                                                $divisionname = utf8_encode($valD->division);
//                                                                echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.$valS->id.'-'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).' - '. $divisionname.'</option>';
//                                                              }
//                                                            }
//
//                                                            // echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).'-'. $cod_division.'</option>';
//
//                                                        }
                                                        ?>  
                                                    </select>
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            <div class="form-group col-md-6"><!---------------------TemaPrincipal---------------------->
                                            <span>Tema de minuta</span>
                                                <div class="input-group ">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <input class="form-control input-lg" type="text" name="txtTema" id="txtTema"  maxlength="150" placeholder="Tema" required />
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-6"><!---------------------Lugar---------------------->
                                                <span>Lugar</span>
                                                <div class="input-group ">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <input class="form-control input-lg" type="text" name="txtLugar" id="txtLugar"  maxlength="150" placeholder="Lugar" required />
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <div class="form-group col-md-6" id="usuarios" title="Solo México y Argentina">
                                                <span>Coordinador de Minuta</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg chosen-select" name="id_usuario_resp" id="id_usuario_resp" required>
                                                        <option value="">Seleccionar Usuario</option>
                                                        <?php
                                                            foreach ($usuariossencillos as $key => $valU) {
                                                                $idusu = $valU->id;
                                                                $idperfil = $valU->id_perfil;
                                                                $nombre_usuario = $valU->nombre_usuario;
                                                                $id_resp = $valU->id_responsable;
                                                                $num_empleado = $valU->num_empleado;
                                                                // if($idperfil==3){
                                                                    if ($nombre_usuario != null) {
                                                                        echo'<option value="'.$valU->id.'">'.utf8_encode($nombre_usuario).'</option>';
                                                                    } 
                                                                    else 
                                                                    {
                                                                        $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoM($num_empleado);
                                                                        foreach ($empleadosData as $key => $valE)
                                                                            {
                                                                                $nombre=$valE->nombre;
                                                                                echo'<option value="'.$valU->id.'">'.utf8_encode($nombre).'</option>';
                                                                            }
                                                                    }
                                                                // }
                                                            }
                                                            // $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoPais();
                                                            // foreach ($empleadosData as $key => $valE)
                                                            // {
                                                            //     $nombre=$valE->nombre;
                                                            //     echo'<option value="'.$valE->idE.'">'.$valE->idE.' - '.utf8_encode($nombre).'</option>';
                                                            // }
                                                        ?>  
                                                    </select>
                                                </div>
                                            </div><!-- ./ form-gruop-->

                                        </div>
                                        <div class="row col-md-12 ">
                                            <div class="form-group col-md-6 d-none">
                                            <span>Estatus de minuta</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <select class="form-control chosen-selec input-lg" name="cboEstatus" id="cboEstatus" required>
                                                    
                                                    <option value="A">Activo</option>
                                                    <option value="I">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            
                                            <div class="form-group col-md-6 d-none">
                                            <span>Redactado por: <?php echo $idS; ?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="d-no" value="<?php echo $idS; ?>" name="cboRedactado" id="cboRedactado">
                                                    <!-- <select class="form-control input-lg" name="cboRedactado" id="cboRedactado" disabled>
                                                        <option value="">Seleccionar Usuario</option> -->
                                                        <?php 
                                                            // foreach ($usuariossencillos as $key => $valU) {
                                                            //     $idusu = $valU->id;
                                                            //     $idperfil = $valU->id_perfil;
                                                            //     $nombre_usuario = $valU->nombre_usuario;
                                                            //     $id_resp = $valU->id_responsable;
                                                            //     $num_empleado = $valU->num_empleado;
                                                            //     // if($idperfil==3){
                                                            //         if($idS==$idusu){$selected='selected';}
                                                            //         if ($nombre_usuario != null) {
                                                            //             echo'<option value="'.$valU->id.'" '.$selected.'>'.$valU->id.' - '.utf8_encode($nombre_usuario).'</option>';
                                                            //         } 
                                                            //         else if ($nombre_usuario == null || $nombre_usuario == '') {
                                                            //             $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                                            //             foreach ($empleadosData as $key => $valE)
                                                            //                 {
                                                            //                     $nombre=$valE->nombre;
                                                            //                     echo'<option value="'.$valU->id.'" '.$selected.'>'.$valU->id.' - '.utf8_encode($nombre).'</option>';
                                                            //                 }
                                                            //         }
                                                            //     // }
                                                            // }
                                                        ?>  
                                                    <!-- </select> -->
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->
                                            <!-- <div class="form-group col-md-6">
                                                <span>Coordinador de Minuta </span>

                                                <div class="input-group ">
                                                    &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input tipo" name="optradio" value="US">Usuarios Sistema
                                                        </label>
                                                    </div>&nbsp; &nbsp; &nbsp;
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input tipo" name="optradio" value="EX">Externo
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- ./ form-gruop-->
                                            <div class="form-group col-md-6" style="display:none;" id="externo">
                                            <span>Externo</span>
                                                <div class="input-group ">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <input class="form-control input-lg" type="text" name="txtexterno" id="txtexterno"  maxlength="150" placeholder="Usuario Responsable" required />
                                                </div>
                                            </div>
                                            <!-- ./ form-gruop-->

                                        </div>
                                        <div class="row col-md-12"><!----------horas de inicio y fin-------->
                                            <div class="form-group col-md-6">
                                            <span>Hora Inicio</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-time"></i></span>
                                                    </div>
                                                    <input type="time" class="form-control" name="horainicio" id="horainicio">
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            <div class="form-group col-md-6">
                                            <span>Hora Finalización</span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    </div>
                                                    <input type="time" class="form-control" name="horafin" id="horafin">
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                        </div>
                                        <!-- <div class="form-group">
                                            <span>Comentarios </span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-time"></i></span>
                                                </div>
                                                <textarea class="form-control input-lg" name="txtGenerales" id="txtGenerales" placeholder="Comentarios" required></textarea>

                                            </div>
                                        </div>    -->
                                        <!-- ./ form-gruop-->
                                        <table class="table table-bordered" width="100%">
                                            <thead style="background-color:#002554; color:white; !important;">
                                            <tr>
                                                <th width="90%">Temas</th>
                                                <th width="10%">Agregar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <textarea type="text" class="form-control input-lg" name="tema" id="tema" placeholder="Tema (N)" required></textarea>
                                                </td>
                                                <td class="justify-content-center align-items-center">
                                                    <button class="btn btn-primary AgregarTemas" aria-label="Agregar Tema" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tbody id="tablaagregartemas">
                                            </tbody>
                                        </table>
                                        <input type="text" class="d-none" id="jsonTemas"><!--Json para armar el guardado de acuerdos-->
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header collapseAsistentes" id="headingTwo" style="background-color:#002554; color:white; !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseAsistentes" data-toggle="collapse" data-target="#collapseAsistentes" aria-expanded="false" aria-controls="collapseAsistentes" style="color: white !important;">
                                            <?php echo $textosArray[220];?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseAsistentes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-group">
                                        <span><?php echo $textosArray[222];?> </span><!-------------------------------->
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                </div>
                                                <!-- <input type="text" class="form-control input-lg" name="txtNombreAsistente" id="txtNombreAsistente" maxlength="75" placeholder="Nombre Asistente" required> -->
                                                <select class="form-control input-lg" name="cboNombreAsistente" id="cboNombreAsistente" required>
                                                        <option value=""><?php echo $textosArray[224];?></option>
                                                        <?php
                                                                        foreach ($usuariossencillos as $key => $valU) {
                                                                            $idusu = $valU->id;
                                                                            $idperfil = $valU->id_perfil;
                                                                            $nombre_usuario = $valU->nombre_usuario;
                                                                            $id_resp = $valU->id_responsable;
                                                                            $num_empleado = $valU->num_empleado;
                                                                            // if($idperfil==3){
                                                                                if ($nombre_usuario != null) {
                                                                                    echo'<option value="'.$valU->id.'">'.utf8_encode($nombre_usuario).'</option>';
                                                                                } 
                                                                                else 
                                                                                {
                                                                                    $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoM($num_empleado);
                                                                                    foreach ($empleadosData as $key => $valE)
                                                                                        {
                                                                                            $nombre=$valE->nombre;
                                                                                            echo'<option value="'.$valU->id.'">'.utf8_encode($nombre).'</option>';
                                                                                        }
                                                                                }
                                                                            // }
                                                                        }
                                                        ?>  
                                                </select>&nbsp;&nbsp;&nbsp;
                                                <button class="btn btn-primary Agregarasistentes" aria-label="Agregar asistente" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                <input type="text" class="d-none" id="jsonAsistentes"><!--Json para armar el guardado de jsonAsistentes-->
                                            </div>
                                        </div><!-- ./ form-gruop-->
                                        <div id="agregarasistentes">
                                        </div>
                                        <div class="form-group">
                                        <span><?php echo $textosArray[223];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input title="Para poder agregar nombres es requerido separarlos por una coma( , ) para su registro" type="text" class="form-control input-lg" name="txtNombreAsistenteSR" id="txtNombreAsistenteSR" maxlength="75" placeholder="Nombre,Nombre,Nombre,Nombre,Nombre,ETC" required>
                                        &nbsp;&nbsp;&nbsp;
                                                <!-- <button class="btn btn-primary Agregarasistentes" aria-label="Agregar asistente" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                <input type="text" class="d-none" id="jsonAsistentesSR">Json para armar el guardado de jsonAsistentes -->
                                            </div>
                                        </div><!-- ./ form-gruop-->
                                        <div id="agregarasistentesSR">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header collapseAcuerdos" id="headingAcuerdos" style="background-color:#002554; color:white; !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseAcuerdos" data-toggle="collapse" data-target="#collapseAcuerdos" aria-expanded="false" aria-controls="collapseAcuerdos" style="color: white !important;">
                                            <?php echo $textosArray[221];?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseAcuerdos" class="collapse" aria-labelledby="headingAcuerdos" data-parent="#accordion">
                                    <div class="card-body">
                                    <!--------------------- btn de minutas pasadas------------------- -->
                                    <button class="btn btn-primary" title="Debe Seleccionar un Sindicato" id="minutaspasadas"<?php echo $textosArray[225];?></button>
                                    <br>
                                    <div class="minutaspasadas" id="minutaspasadas">
                                    </div>
                                        <table class="table table-bordered" width="100%">
                                            <thead style="background-color:#002554; color:white; !important;">
                                            <tr>
                                                <th width="23%"><?php echo $textosArray[226];?></th>
                                                <th width="23%"><?php echo $textosArray[227];?></th>
                                                <th width="23%"><?php echo $textosArray[228];?></th>
                                                <th width="23%"><?php echo $textosArray[41];?></th>
                                                <th width="8%"><?php echo $textosArray[13];?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <textarea type="text" class="form-control input-lg" name="Acuerdo" id="Acuerdo" placeholder="<?php echo $textosArray[226];?>" required></textarea>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control input-lg" name="FechaCompromiso" id="FechaCompromiso" required>
                                                </td>
                                                <td>
                                                    <!-- <input type="text" class="form-control input-lg" name="Responsable" id="Responsable" maxlength="75" placeholder="Responsable" required> -->
                                                    <select class="form-control" name="Responsable" id="Responsable">
                                                    <option value="">---</option>
                                                    <!-- <div id="resptabla"></div> -->
                                                    <?php 
                                                    
                                                    foreach ($usuariossencillos as $key => $valU) {
                                                        $idusu = $valU->id;
                                                        $idperfil = $valU->id_perfil;
                                                        $nombre_usuario = $valU->nombre_usuario;
                                                        $id_resp = $valU->id_responsable;
                                                        $num_empleado = $valU->num_empleado;
                                                        // if($idperfil==3){
                                                            if ($nombre_usuario != null) {
                                                                echo'<option value="'.$valU->id.'">'.utf8_encode($nombre_usuario).'</option>';
                                                            } 
                                                            else 
                                                            {
                                                                $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleadoM($num_empleado);
                                                                foreach ($empleadosData as $key => $valE)
                                                                    {
                                                                        $nombre=$valE->nombre;
                                                                        echo'<option value="'.$valU->id.'">'.utf8_encode($nombre).'</option>';
                                                                    }
                                                            }
                                                        // }
                                                    }
                                                    
                                                    ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="form-control input-lg" name="txtComentarios" id="Comentarios" placeholder="<?php echo $textosArray[41];?>" required></textarea>
                                                </td class="justify-content-center align-items-center">
                                                <td>
                                                    <button class="btn btn-primary Agregaracuerdos" aria-label="Agregar Acuerdo" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tbody id="tablaagregaracuerdos">
                                            </tbody>
                                        </table>
                                        <input type="text" class="d-none" id="jsonAcuerdos"><!--Json para armar el guardado de acuerdos multiples ya sean de acuerdos pasadas(se convierten en nuevos) o nuevos acuerdos-->
                                        <input type="text" class="d-none" id="jsonAcuerdos2"><!--Json para armar el guardado de acuerdos multiples ya sean de acuerdos pasadas(se convierten en nuevos) o nuevos acuerdos-->
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color:#002554; color:white; !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="false" aria-controls="collapseArchivos" style="color: white !important;">
                                            <?php echo $textosArray[30];?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseArchivos" class="collapse" aria-labelledby="headingArchivos" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    </div>
                                                    <input type="file" class="form-control input-lg fil" size='10000' name="file" id="file" accept=".pdf"><!--accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx"-->
                                                    <input type="text" class="d-none" id="size" >
                                                </div>
                                            </div>   <!-- ./ form-gruop-->
                                            <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF).</div>
                                            <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-info revision" id="revisión"  data-toggle="modal" data-target="#review" title="Para ver el Review de la Minuta"><?php echo $textosArray[229];?></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                        <button type="button" class="btn btn-primary agregarMinutas" title="Para habilitar llenar todos los campos de Minutas"><?php echo $textosArray[231];?></button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Modal Revisar minuta -->
        <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="review" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="background: hsla(214, 100%, 16%, 1); color: white;">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="review">Revisión minuta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="contenido"  style="background-color: white; color: black; height: 500px;  width: 100%;  overflow-y: scroll;">
                
                            <div class="text-justify" style="margin-left: 50px; margin-right: 50px;">
                                <h3><?php echo $textosArray[232];?></h3>
                                <br>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[176];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="sindicato"></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[233];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="temap"></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[212];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="temas"></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[234];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="lugar"></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[222];?></label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="usuario"></h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[235];?></label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row"><label><?php echo $textosArray[236];?>  :&nbsp;&nbsp;</label><br><h5 class="card-title" id="hora_inicio"></h5></div>
                                        <div class="row"><label><?php echo $textosArray[237];?>  :&nbsp;&nbsp;</label><br><h5 class="card-title" id="hora_final"></h5></div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-header">
                                        <label>Generales</label>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="generales"></h5>
                                    </div>
                                </div> -->
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[220];?></label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row"><h5 class="card-title" id="asistente"></h5><br></div>
                                        <div class="row"><label>Sin registro en sistema :&nbsp;&nbsp;</label><br><h5 class="card-title" id="asistentesr"></h5></div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[221];?></label>
                                    </div>
                                    <div class="card-body">
                                    <div id="acuerdos"> 
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label><?php echo $textosArray[30];?></label>
                                    </div>
                                    <div class="card-body">
       
                                    <div id="archivo"> 
                                        </div>
                                        
                                        
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" id="cerrarprev" data-dismiss="modal"><?php echo $textosArray[230];?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script>
 $(document).ready (function ()
{
    $('.tipo').change(function(event) {
        var tipo = $('input:radio[name=optradio]:checked').val();
        if (tipo=="EX"){
            $('#txtexterno').val('');
            $('#externo').show();
            $('#usuarios').hide();
        }else if (tipo=="US"){
            $('#id_usuario_resp').val('');
            $('#externo').hide();
            $('#usuarios').show();

        }
    });
    $('#acuerdospas').DataTable( {
        // "paging":   false,
        "ordering": false// para desabilitar el ordenamiento
        // "info":     false
    } );

    $('#minutaspasadas').prop( "disabled", true );
    $('#cbo_sindicato').change(function(event) {
       var cbo_sindicato = $('#cbo_sindicato').val();
       if(cbo_sindicato!=''){
        $('#minutaspasadas').prop( "disabled", false );
       }else{
        $('#minutaspasadas').prop( "disabled", true );
       }
    });

    $(document).on("change", ".addminuta", function() {//para detectar el checbox dinamico creado de la consulta de los acuerdos pasados 
        var id = $(this).attr("id");
        var id_acuerdoG = $(this).attr("id_acuerdo");//buscar el atributo id que es el id_acuerdo para q sea unico
        if( $("#"+id+"").prop('checked') ) {
            // alert('Seleccionado');
            
            // var acuerdoG = $(this).attr("acuerdo");//apartir de aqui se toman los valores de cad uno de los atributos q es la info  de los acuerdos pasados
            // var fecha_compromisoG = $(this).attr("fecha_compromiso");
            // var responsableG = $(this).attr("responsable");
            // var comentariosG = $(this).attr("comentarios");
            var acuerdo = $("#acuerdo"+id_acuerdoG).val();
            var fechaC = $("#fechaC"+id_acuerdoG).val();
            var resp = $("#resp"+id_acuerdoG).val();
            var coment = $("#coment"+id_acuerdoG).val();
            var estatus = $("#estat"+id_acuerdoG).val();
            var acpas = "<input class='d-none' id='acuerdoG_"+id_acuerdoG+"'  type='text' name='acuerdopasadoeditado[]' value='"+ id_acuerdoG + '/'+ estatus +'~'+"' />";//se crea  la variable para agregarlos al div correspondiente en la clase correspondiente
            $(".minutaspasadas").append(acpas);
            var acuprevG = "<label>Acuerdos Minutas Pasadas </label><ul id='acuerdoprev_"+id_acuerdoG+"'>"+
                            "<li><label>Acuerdo : </label>"+acuerdo+"</li>"+
                            "<li><label>Fecha compromiso : </label>"+fechaC+"</li>"+
                            "<li><label>Responsable : </label>"+resp+"</li>"+
                            "<li><label>Comentarios :</label>"+coment+"</li>"+
                            "<li><label>Estatus :</label>"+estatus+"</li>"+ 
                          "</ul>";
            $("#acuerdos").append(acuprevG);//apend de la variable a ingresar al div de preview de la minuta
            //para la tabla de los acuerdos nuevos
            // var infoG = "<tr class='acuedpasa' id_acuedopasa='"+id_acuerdoG+"' name='' id='acuerdoPG_"+id_acuerdoG+"'>"+
            //                "<td><input class='form-control' name='acuer[]' id='acuer"+id_acuerdoG+"' type='text'  value='" + acuerdo + "' autofocus /></td>"+
            //                 "<td><input class='form-control' type='date' name='FechaCom[]' id='FechaCom"+id_acuerdoG+"' value='" + fechaC + "'  autofocus /></td>"+
            //                 "<td><input class='form-control' type='text' name='Resp[]' id='Resp"+id_acuerdoG+"' value='" + resp + "'  autofocus readonly/></td>"+
            //                 "<td><input class='form-control' type='text' name='Com[]' id='Com"+id_acuerdoG+"' value='" + coment + "'  autofocus /></td>"+
            //                 "<td align='center'></td>"+                           
            //             "</tr>";
           
            // $("#tablaagregaracuerdos").append(infoG);
            jasonAcuerdos2();//funcion para leer los inputs tipo arreglo y agregarlos al arreglo final concatenando todos 
        }else{
            $("#acuerdoG_"+id_acuerdoG+"").remove();//eliminacion del elemento al deschecar check
            $("#acuerdoPG_"+id_acuerdoG+"").remove();//eliminacion del elemento al deschecar el check de agregar QUE SE AGREGA A LA TABLA DE ABAJO
            $("#acuerdoprev_"+id_acuerdoG+"").remove();//eliminacion del elemento al deschecar el check de agregar
            // borrarAP(id_acuerdoG);
            jasonAcuerdos2();

        }    
    });

    // $(document).on("mouseover", ".acuedpasa", function() {//para tomar los valores agregado con el checkbox de agregar minuta pasada y al editarlos 
    //     var id_acuedopasa = $(this).attr("id_acuedopasa");//tomar el atributo//tomar los valoresy sobrescribirlos en el campojasonAcu[]del arreglo
    //     var acuerdo= $("#acuer"+id_acuedopasa).val();
    //     var fechaC= $("#FechaCom"+id_acuedopasa).val();
    //     var resp= $("#Resp"+id_acuedopasa).val();
    //     var coment= $("#Com"+id_acuedopasa).val();
    //     $("#acuerdoG_"+id_acuedopasa).val(acuerdo +"/"+ fechaC +'/' + resp + '/'+ coment +'~');
    //     jasonAcuerdos();
       
    // });

    // $(document).on("over", ".acuedpasa", function() {
    //     // var id_acuedopasa = $(this).attr("id_acuedopasa");//tomar el atributo
    //     jasonAcuerdos();
    // });
   
    $('#minutaspasadas').click(function(event) {
    //para y regresar con los acuerdos pasados
            //var idUsuario = $(this).attr("idUsuario");
        var datos = new FormData();
        var funcion ="BuscarAcuerdosMinutasPasadas";
        var sindicato   = $('#cbo_sindicato').val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("sindicato", sindicato);
        $.ajax({//regresa la informacion en forma de tabla para poder procesarla si se requiere usar algun acuerdo pasado
            url:"ajax/minutas.ajax.php",
            method: "POST",
            data: datos,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta)
            {
              if(respuesta!=null)
              {
                console.log(respuesta);
                var stringHTML="";
                stringHTML+="<br><table class='tabladatatableAjax table table-striped  dt-responsive' width='100%' id='acuerdospas'>";
                stringHTML+= "<thead>";
                stringHTML+= "<tr>";
                // stringHTML+= "<th class='d-none' width='15%' scope='col'>ID Minuta</th>";
                // stringHTML+= "<th class='d-none' width='15%' scope='col'>ID Acuerdo</th>";
                stringHTML+= "<th width='15%' scope='col'>Acuerdo</th>";
                stringHTML+= "<th width='15%' scope='col'>Fecha Compromiso</th>";
                stringHTML+= "<th width='15%' scope='col'>Responsable</th>";
                stringHTML+= "<th width='15%' scope='col'>Comentarios</th>";
                stringHTML+= "<th width='15%' scope='col'>Estatus</th>";
                stringHTML+= "<th width='10%' scope='col'>Agregar Estatus</th>";
                stringHTML+= "</tr>";
                stringHTML+= "</thead>";
                stringHTML+= "<tbody>";


                respuesta.forEach((obj, i) => {
                    stringHTML+="<tr>";
                    //stringHTML+="<td>"+i+"</td>";
                    // stringHTML+="<td class='d-none'>"+obj['id']+"</td>";
                    // stringHTML+="<td class='d-none'>"+obj['id_acuerdo']+"</td>";
                    // stringHTML+="<td>"+obj['acuerdo']+"</td>";
                    // stringHTML+="<td>"+obj['fecha_compromiso']+"</td>";
                    // stringHTML+="<td>"+obj['responsable']+"</td>";
                    // stringHTML+="<td>"+obj['comentarios']+"</td>";
                    stringHTML+="<td><input type='text' id='acuerdo"+obj['id_acuerdo']+"' class='form-control' value='"+obj['acuerdo']+"' readonly/></td>";
                    stringHTML+="<td><input type='date' id='fechaC"+obj['id_acuerdo']+"' class='form-control' value='"+obj['fecha_compromiso']+"' readonly/></td>";
                    stringHTML+="<td><input type='text' id='resp"+obj['id_acuerdo']+"' class='form-control' value='"+obj['responsable']+"' readonly/></td>";
                    stringHTML+="<td><input type='text' id='coment"+obj['id_acuerdo']+"' class='form-control' value='"+obj['comentarios']+"' readonly/></td>";
                    if (obj['estatus']==null){obj['estatus']='';}
                    stringHTML+="<td><input type='text' id='estat"+obj['id_acuerdo']+"' class='form-control' value='"+obj['estatus']+"'/></td>";
                    stringHTML+="<td class='justify-content-center'><center><input type='checkbox' id='addminuta_"+obj['id_acuerdo']+"' id_acuerdo='"+obj['id_acuerdo']+"' acuerdo='"+obj['acuerdo']+"' fecha_compromiso='"+obj['fecha_compromiso']+"' responsable='"+obj['responsable']+"' comentarios='"+obj['comentarios']+"'  class='addminuta' value=''/></center></td>";
                    stringHTML+="</tr>";
                });
                stringHTML+="</tbody>";
                stringHTML+="</table><br>";
                $(".minutaspasadas").html(stringHTML);
            }
              else{
                console.log(respuesta);
                var stringHTML="";
                stringHTML+="<br><div class='alert alert-warning' align='center'><strong></strong>Sin Registros.</div>";
        
                $(".minutaspasadas").html(stringHTML);

              }
            },
            error : function(respuesta)
            {
                console.log("Error",respuesta);
                // alert('No existen Acuerdos pasados');
            }

        }).done(function ()
        {   
            $('.tabladatatableAjax').DataTable();
        });
    });

    $('#file').change(function(event) {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarMinutas" ).prop( "disabled", true );
            $( ".revision" ).prop( "disabled", true );
            
        }else{
                $("#tamañoarchivo").hide();//
                $( ".agregarMinutas" ).prop( "disabled", false );
                $( ".revision" ).prop( "disabled", false );   
        }
        if(extensiones != ".pdf")//validar el tipo de archivo
        // if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx" && siezekiloByte >  $('#file').attr('size'))
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregarMinutas" ).prop( "disabled", true );
                $( ".revision" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();
                $( ".agregarMinutas" ).prop( "disabled", false );
                $( ".revision" ).prop( "disabled", false );             
            }
           
    });    

    $('#revisión').click(function(event) {
        //  $('#servicioSelecionado').val($("#cbo_sindicato option:selected").text());
        
        //  $('.price-cash').text('Nuevo texto: ');
        $('#sindicato').text($("#cbo_sindicato option:selected").text());
        var txtexter = $('#txtexterno').val();
        var id_usuario_r = $('#id_usuario_resp').val();   
        $('#usuario').text($("#cboUsuario option:selected").text());

        $('#temap').text($('#txtTema').val());
        $('#lugar').text($('#txtLugar').val());
        // $('#generales').text($('#txtGenerales').val());
        var txtexter = $('#txtexterno').val();
        var id_usuario_r = $('#id_usuario_resp').val();

        if(txtexter!=''){
            $('#usuario').text(txtexter);
        }else if(id_usuario_r=!''){
            $('#usuario').text($("#id_usuario_resp option:selected").text());
        }

        // $('#generales').text($('#txtGenerales').val());
        $('#hora_inicio').text($('#horainicio').val());
        $('#hora_final').text($('#horafin').val());
        $('#asistentesr').text($('#txtNombreAsistenteSR').val());
        $('#archivo').text($('#file').val());
        // $( "#tablaagregaracuerdos" ).clone().appendTo("#acuerdos");

    });
    // $('#cerrarprev').click(function(event) {  //es para limpiar la info
    //     document.getElementById("acuerdos").innerHTML="";
    //     // $("#acuerdos").innerHTML="";
    //     // $("#acuerdos").empty();
    // });
 
    $(".Agregaracuerdos").click(addAcuerdo); //agregar sub tabla
    $(".Agregarasistentes").click(addAsistente); //agregar sub tabla
    $(".AgregarTemas").click(addTemas); //agregar sub tabla
  //////////////////////para el chosenselect
  $('.chosen-select').chosen({//para funcionamiento de chosen select
          // allow_single_deselect: true,
          no_results_text: "No se han encontrado datos con:",
          width: '90%',
          heigth: '100%'
  });
  $( ".agregarMinutas" ).prop( "disabled", true );
  $( ".revision" ).prop( "disabled", true );
  
    $(".collapseMinutas").hover(function(){
        habiltardes();
    });
    $(".collapseAsistentes").hover(function(){
        habiltardes();
    });
    $(".headingAcuerdos").hover(function(){
        habiltardes();
    });
    $(".collapseArchivos").hover(function(){
        habiltardes();
    });

    $(".agregarMinutas").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base] 
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        
        var datos = new FormData();
        var funcion    ="agregarMinutas";
        var Sindicato  = $("#cbo_sindicato").val();//*requerido
        var Tema       = $("#txtTema").val();//tema Principal//*requerido
        var Estatus    = $("#cboEstatus").val();//esta oculto
        // var Usuario    = $("#cboUsuario").val();
        // var Generales  = $("#txtGenerales").val();
        var jsonTemas = $("#jsonTemas").val(); //*requerido
        var Generales  = '';
        var lugar = $("#txtLugar").val(); //*requerido
        var externo = $("#txtexterno").val(); //id_usuario responsable o uno u otro 
        var id_usuario_resp = $("#id_usuario_resp").val(); //usuario externo
        var horainicio = $("#horainicio").val();//*requerido
        var horafin    = $("#horafin").val();//*requerido
        var Redactado    = $("#cboRedactado").val();//redactado por hidden//*requerido
        // var NombreAsistente = $("#txtNombreAsistente").val();
        var jsonAsistentes = $("#jsonAsistentes").val(); 
        var AsistentesSR = $("#txtNombreAsistenteSR").val(); 
        var jsonAcuerdos = $("#jsonAcuerdos").val();
        var jsonAcuerdos2 = $("#jsonAcuerdos2").val(); 
        var file         =  $("#file")[0].files[0];
        //var file            = $("#file").val();
        
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("Sindicato", Sindicato);
        datos.append("Tema", Tema);
        datos.append("Estatus", Estatus);
        // datos.append("Usuario", Usuario);
        datos.append("Generales", Generales);
        datos.append("lugar", lugar);
        datos.append("externo", externo);
        datos.append("id_usuario_resp", id_usuario_resp);
        datos.append("jsonTemas", jsonTemas);
        datos.append("horainicio", horainicio);
        datos.append("horafin", horafin);
        datos.append("Redactado", Redactado);
        datos.append("jsonAsistentes", jsonAsistentes);
        datos.append("AsistentesSR", AsistentesSR);
        datos.append("jsonAcuerdos", jsonAcuerdos);
        datos.append("jsonAcuerdos2", jsonAcuerdos2);
        datos.append("file", file);
        
        $.ajax({
            url:"ajax/minutas.ajax.php",
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
                          window.location = 'minutas';
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
                              window.location = 'minutas';
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



    $(".guardarEdicion").click(function()
    {
        var idForm = $(this).attr("idForm");//tomar el atributo
        var id = $(this).attr("id");//tomar el id 
        console.log(idForm);
         // console.log(document.getElementById(idForm));

        console.log($('#'+idForm).serializeArray());
        var inputs=$('#'+idForm).serializeArray();

        // var datos = new FormData();
        var datos =  new Array();
        // datos.push(funcion);
        $.each(inputs, function(i, field){//para poderlos ocupar afuera
            // $("#results").append(field.name + ":" + field.value + " ");
            //  datos.append(field.name, field.value);
            // alert(field.value);
            datos.push(field.value);//se guarda en el array de datos


        });
        console.log(datos);

        var dataForm = new FormData();
        var funcion="editarMinutas";
        var Sindicato       = datos[0];
        var Tema            = datos[1];
        var Estatus         = datos[2];
        var Usuario         = datos[3];
        var Generales       = datos[4];
        var NombreAsistente = datos[5];
        var Acuerdo         = datos[6];
        var FCompromiso     = datos[7];
        var Responsable     = datos[8];
        var Comentarios     = datos[9];
        var file            = datos[10];

        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("Sindicato", Sindicato);
        dataForm.append("Tema", Tema);
        dataForm.append("Estatus", Estatus);
        dataForm.append("Usuario", Usuario);
        dataForm.append("Generales", Generales);
        dataForm.append("NombreAsistente", NombreAsistente);
        dataForm.append("Acuerdo", Acuerdo);
        dataForm.append("FCompromiso", FCompromiso);
        dataForm.append("Responsable", Responsable);
        dataForm.append("Comentarios", Comentarios);
        dataForm.append("file", file);
        dataForm.append("id", id);

        $.ajax({
            url:"ajax/minutas.ajax.php",
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
                            window.location = 'minutas';
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡Registro Exitoso!',
                        icon: 'warning',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'minutas';
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
    /////////////////////////////////////////////////////////////////////////////////////////////////

    $(".btnEditMinuta").click(function()
    {
        var id_minuta = $(this).attr("idMinuta");//tomar el id   
        var form = $('<form action="editarMinuta" target="" method="post">' + '<input type="text" class="d-none" name="id_minuta" id="id_minuta" value="' + id_minuta + '" />' + '</form>');
        $('body').append(form);
        form.submit();
     });

    $(".btnEliminarMinuta").click(function()
     {
         var id = $(this).attr("idMinuta");
         var dataForm = new FormData();
         var funcion="eliminarMinutas";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos

         Swal.fire({
             title: '¡Estas seguro que deseas eliminar la Minuta?',
             text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Borrar Minuta'
         }).then((result) => {
             if (result.value) {
                 // window.location = "usuarios";

                 $.ajax({
                     url:"ajax/minutas.ajax.php",
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
                                 text: '¡Eliminado de manera exitosa!',
                                 icon: 'success',
                                 confirmButtonText:'Ok'
                             }).then((result)=>{
                                 if(result.value){
                                     window.location = 'minutas';
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
                                     window.location = 'minutas';
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
});
function habiltardes(){//para habilitar llenar los campos
    var sindicato    = $( "#cbo_sindicato" ).val();
    var tema         = $( "#txtTema" ).val();
    var estatus      = $( "#cboEstatus" ).val();
    var usuario      = $( "#cboUsuario" ).val();
    // var nomasistente = $( "#txtNombreAsistente" ).val();
    // var acuerdo      = $( "#txtAcuerdo" ).val();
    // var compromiso   = $( "#txtFechaCompromiso" ).val();
    // var responsable  = $( "#txtResponsable" ).val();
    var jsonAsistentes   = $( "#jsonAsistentes" ).val();
    var jsonAcuerdos  = $( "#jsonAcuerdos" ).val();
    // var file         = $( "#file" ).val();
    // var sizeval = $("#size").val();//tamaño del archivo
    // var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
    // var siezekiloByte = parseInt(fileSize / 1024);//se parsea

    if(sindicato!='' && tema!='' && estatus!='' && usuario!='' && jsonAsistentes!='' && jsonAcuerdos!=''){//para revisar que ningun campo este vacio
        $( ".agregarMinutas" ).prop( "disabled", false );
        $( ".revision" ).prop( "disabled", false );
    }else{
        $( ".agregarMinutas" ).prop( "disabled", true );
        $( ".revision" ).prop( "disabled", true );
    }
        // var archivo = $("#file").val();//obtener el id del archivo
        // var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        
        // if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
        //     $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        // }else{
        //         $("#tamañoarchivo").hide();//
        // }
        // if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        //     {
        //         // alert("El archivo de tipo " + extensiones + " no es válido");
        //         $("#tipoarchivo").show();
        //         $( ".agregarMinutas" ).prop( "disabled", true );
        //         $( ".revision" ).prop( "disabled", true );  
        //     }else{
        //         $("#tipoarchivo").hide();
        //         $( ".agregarMinutas" ).prop( "disabled", false );
        //         $( ".revision" ).prop( "disabled", false );             
        //     }
        
};

var contador = 0;//variable para remover
function addAcuerdo() {
        contador += 1;//contador sumando
        var idremove = "$('#acuerdo_"+contador+"')";
        var Acuerdo         = $('#Acuerdo').val();
        var FechaCompromiso = $('#FechaCompromiso').val();
        // var Responsable     = $('#Responsable').val();
        var Responsable = $('select[name="Responsable"] option:selected').text();
        var Comentarios     = $('#Comentarios').val();
        if (Acuerdo != "" && FechaCompromiso != "" && Responsable != "") { //checar si vienen diferende de vacia
            var info = "<tr name='' id='acuerdo_"+contador+"'>"+
                            // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'{"acuerdo":'+ Acuerdo +","+'"FechaCompromiso":'+ FechaCompromiso +','+'"Responsable":'+ Responsable +','+'"Comentarios":'+ Comentarios +'},'+"'/></td>"+
                            // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'array('+'"'+ Acuerdo +'"'+","+'"'+ FechaCompromiso +'"' + ','+ '"'+ Responsable + '"'+ ','+ '"'+ Comentarios + '"'+ '),'+"'/></td>"+
                            "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+ Acuerdo +"/"+ FechaCompromiso +'/' + Responsable + '/'+ Comentarios +'~'+"'/></td>"+
                            "<td><input class='form-control' name='acuer[]' id='' type='text'  value='" + Acuerdo + "' autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='FechaCom[]' id='' value='" + FechaCompromiso + "'  autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='Resp[]' id='' value='" + Responsable + "'  autofocus readonly/></td>"+
                            "<td><input class='form-control' type='text' name='Com[]' id='' value='" + Comentarios + "'  autofocus readonly/></td>"+
                            // "<td align='center'><button class='btn btn-primary' onclick="+idremove+".remove();>Eliminar</button></td>"+
                            "<td align='center'><button class='btn btn-primary' onclick='borrar("+contador+")'>Eliminar</button></td>"+                           
                        "</tr>";
           
            $("#tablaagregaracuerdos").append(info);

            // var acuprev = "<div id='acuerdoprev_"+contador+"'>"+
            //                 "<table class='table table-bordered'><thead style='background-color: #002554; color: white;'><tr><th>Acuerdo</th><th>Fecha Compromiso</th><th>Responsable</th><th>Comentarios</th></tr></thead>"+
            //                 "<tbody><tr><td>"+Acuerdo+"</td><td>"+FechaCompromiso+"</td><td>"+Responsable+"</td><td>"+Comentarios+"</td></tr>"+
            //                 "</tbody></table>"+
            //                 "</div>";
            var acuprev = "<label>Acuerdo Nuevo</label><ul id='acuerdoprev_"+contador+"'>"+
                            "<li><label>Acuerdo : </label>"+Acuerdo+"</li>"+
                            "<li><label>Fecha compromiso : </label>"+FechaCompromiso+"</li>"+
                            "<li><label>Responsable : </label>"+Responsable+"</li>"+
                            "<li><label>Comentarios :</label>"+Comentarios+"</li>"+
                          "</ul>";
            $("#acuerdos").append(acuprev);//apend de la variable a ingresar al div de preview de la minuta

            reset_campos(); //funcion resetear campos
            $('#llenarcamposacuerdos').hide();
            jasonAcuerdos();
        } else {
            $('#llenarcamposacuerdos').show();
        }
}

function reset_campos() { //reseteo de campos
    $("#Acuerdo").val("");
    $("#FechaCompromiso").val("");
    $("#Responsable").val("");
    $("#Comentarios").val("");
    //$('#cboIva').prop('selectedIndex', 0);//para regresar al index en cero o vacio
}

function jasonAcuerdos(){
    var jsoncontador = '';
    var acuCount = document.getElementsByName("jsonAcu[]").length;
    for(i=0;i<acuCount;i++){
         jsoncontador =jsoncontador+$("input[name*='jsonAcu']")[i].value;
        //  $('#jsonAcuerdos').val("["+jsonIngredien+"]"); //formatojson
        // $('#jsonAcuerdos').val("array ("+jsonIngredien+");"); //formatojson
        $('#jsonAcuerdos').val(" "+jsoncontador+" "); //formatojson
    }
    if(acuCount==0){
        $('#jsonAcuerdos').val(""); //formatojson
    }
}

function jasonAcuerdos2(){
    var jsonIngredien2 = '';
    var acuCount2 = document.getElementsByName("acuerdopasadoeditado[]").length;
    for(i=0;i<acuCount2;i++){
         jsonIngredien2 =jsonIngredien2+$("input[name*='acuerdopasadoeditado']")[i].value;
        $('#jsonAcuerdos2').val(" "+jsonIngredien2+" "); //formatojson
    }
    if(acuCount2==0){
        $('#jsonAcuerdos2').val(""); //formatojson
    }
}

function borrar(contador) { //para borrar las mismas filas
    $("#acuerdo_"+contador+"").remove();//se toma el id dinamico creado para poder eliminar el elemento
    $("#acuerdoprev_"+contador+"").remove();//lo mismo de arriba
    jasonAcuerdos();    
}
function borrarAP(contador) { //para borrar las mismas filas
    $("#acuerdoG_"+id_acuerdoG+"").remove();//se toma el id dinamico creado para poder eliminar el elemento
    // $("#acuerdoprev_"+contador+"").remove();//lo mismo de arriba
    jasonAcuerdos();    
}
//////////////////////////////////////////////////////////////////////para asistentes
var contadorA = 0;//variable para remover
function addAsistente() {
        contadorA += 1;//contador sumando
        var idremove = "$('#asistente_"+contadorA+"')";
        var Asistente     = $('#cboNombreAsistente').val();
        var Asistentetext = $('select[name="cboNombreAsistente"] option:selected').text();
        
        if (Asistente != "") { //checar si vienen diferende de vacia
            var infoA = "<div class='form-group' id='asistente_"+contadorA+"'>"+
                            "<div class='input-group'>"+
                                "<div class='input-group-text'>"+
                                    "<span class='input-group-addon'><i class='fa fa-user'></i></span>"+
                               "</div>"+
                                "<input class='d-none' type='text' name='jsonAsis[]' value='"+ Asistentetext +'~'+"'/>"+
                                "<input class='form-control d-none' name='asis[]' id='' type='text'  value='" + Asistente + "' autofocus readonly/>&nbsp;"+
                                "<input class='form-control' name='' id='' type='text'  value='" + Asistentetext + "' autofocus readonly/>&nbsp;"+
                                "<button class='btn btn-primary' onclick='borrarA("+contadorA+")'>Eliminar</button>"+     
                            "</div>"+
                        "</div>";
           
            $("#agregarasistentes").append(infoA);

            var option ="<option value="+ Asistentetext +">"+Asistentetext+"</option>";//para agregar al select
            $("#Responsable").append(option);

            var asisprev = "<ul id='asistenteprev_"+contadorA+"'>"+
                            "<li><label>Asistente : </label>&nbsp;"+Asistentetext+"</li>"+
                          "</ul>";
            $("#asistente").append(asisprev);//apend de la variable a ingresar al div de preview de la minuta

            reset_camposA(); //funcion resetear campos
            // $('#llenarcamposacuerdos').hide();
            jasonAsistente();
        } else {
            // $('#llenarcamposacuerdos').show();
        }
}

function reset_camposA() { //reseteo de campos
    $("#cboNombreAsistente").val("");
}

function jasonAsistente(){
    var jsonAsisten = '';
    var asiCount = document.getElementsByName("jsonAsis[]").length;
    for(i=0;i<asiCount;i++){
         jsonAsisten =jsonAsisten+$("input[name*='jsonAsis']")[i].value;
        $('#jsonAsistentes').val(" "+jsonAsisten+" "); //formatojson
    }
    if(asiCount==0){
        $('#jsonAsistentes').val(""); //formatojson
    }
}

function borrarA(contadorA) { //para borrar las mismas filas
    // jasonAsistente();
    $("#asistente_"+contadorA+"").remove();//se toma el id dinamico creado para poder eliminar el elemento
    $("#asistenteprev_"+contadorA+"").remove();//lo mismo de arriba
    jasonAsistente();
        
}

////////////////////////////////////////////////////////////////////Temas
var contadorT = 0;//variable para remover
function addTemas() {
        contadorT += 1;//contador sumando
        var idremove = "$('#temas_"+contadorT+"')";
        var tema     = $('#tema').val();        
        if (tema != "") { //checar si vienen diferende de vacia
            var infoT = "<div class='form-group' id='tema"+contadorT+"'>"+
                            "<div class='input-group'>"+
                                "<div class='input-group-text'>"+
                                    "<span class='input-group-addon'><i class='fa fa-file'></i></span>"+
                               "</div>"+
                                "<input class='d-none' type='text' name='jsonTemas[]' value='"+ tema +'~'+"'/>"+
                                //"<input class='form-control d-non' name='tema[]' id='' type='text'  value='" + tema + "' autofocus readonly/>&nbsp;"+
                                "<input class='form-control' name='' id='' type='text'  value='" + tema + "' autofocus readonly/>&nbsp;"+
                                "<button class='btn btn-primary' onclick='borrarT("+contadorT+")'>Eliminar</button>"+     
                            "</div>"+
                        "</div>";
           
            $("#tablaagregartemas").append(infoT);

            var temasprev = "<ul id='temasprev_"+contadorT+"'>"+
                            "<li><label>Temas : </label>&nbsp;"+tema+"</li>"+
                          "</ul>";
            $("#temas").append(temasprev);//apend de la variable a ingresar al div de preview de la minuta

            reset_camposT(); //funcion resetear campos
            // $('#llenarcamposacuerdos').hide();
            jasonTemas();
        } else {
            // $('#llenarcamposacuerdos').show();
        }
}

function reset_camposT() { //reseteo de campos
    $("#tema").val("");
}

function jasonTemas(){
    var jsonTemas = '';
    var asiCount = document.getElementsByName("jsonTemas[]").length;
    for(i=0;i<asiCount;i++){
         jsonTemas =jsonTemas+$("input[name*='jsonTemas']")[i].value;
        $('#jsonTemas').val(" "+jsonTemas+" "); //formatojson
    }
    if(asiCount==0){
        $('#jsonTemas').val(""); //formatojson
    }
}

function borrarT(contadorT) { //para borrar las mismas filas
    $("#tema"+contadorT).remove();//se toma el id dinamico creado para poder eliminar el elemento
    $("#temasprev_"+contadorT).remove();//lo mismo de arriba
    jasonTemas();
        
}

function demoFromHTML(id) {
        var pdf = new jsPDF('p', 'pt', 'letter');

        source = $('#content'+id+'')[0];

        specialElementHandlers = {

            '#bypassme': function (element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
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
                pdf.save('Minuta#'+id+'.pdf');
            }, margins
        );
    }


 </script>
<!-- /.content-wrapper --><?php ?>
