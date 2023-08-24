<?php
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
                <div class="col-md-6">
                    <h1 style="font-size: 45px"><?php echo $textosArray[177];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[177];?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarMinuta">Crear Minuta 1</button> -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPliego"><?php echo $textosArray[212];?></button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalCrearPliego"><?php echo $textosArray[213];?></button>
                </div>
            </div>
        </div>
        <br>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item waves-effect waves-light show">
                    <a class="nav-link" id="subidos-tab" data-toggle="tab" href="#subidos" role="tab" aria-controls="subidos" aria-selected="false"><?php echo $textosArray[208];?></a>
<!--                    <a class="nav-link active " id="subidos-tab" data-toggle="tab" href="#subidos" role="tab" aria-controls="subidos" aria-selected="true">Cargados</a>-->
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" id="creados-tab" data-toggle="tab" href="#creados" role="tab" aria-controls="creados" aria-selected="false"><?php echo $textosArray[207];?></a>
                </li>

            </ul>

        <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="subidos" role="tabpanel" aria-labelledby="subidos-tab" width="100%">
                    <div class="col-md-12">
                        <div class="card" >
                            <div class="card-body">
<!--                                <h3>Pliegos Cargados</h3>-->
                                <table class="table table-striped tabladatatable dt-responsive" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="d-none" scope="col" width="10%">Pliego</th>
                                        <th scope="col" width="25%"><?php echo $textosArray[176];?></th>
                                        <th scope="col" width="25%"><?php echo $textosArray[67];?></th>
                                        <th scope="col" width="25%"><?php echo $textosArray[209];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[210];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[211];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[12];?></th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
                                    //   echo "aqui<br>";
                                    if ($_SESSION['id_perfil']==3)
                                    {
                                        $pliegos = ControladorPliegos::ctrMostrarPliegos($_SESSION['cod_division'],"");

                                    }
                                    elseif ($_SESSION['id_perfil']==4 || $_SESSION['id_perfil']==2)
                                    {
                                        $pliegos = ControladorPliegos::ctrMostrarPliegos($_SESSION['divisiones'],$_SESSION['pais']);

                                    }
                                    elseif ($_SESSION['id_perfil']==1 )
                                    {
//                                        $pliegosCreados = ControladorPliegos::ctrMostrarPliegosCreados("admin","admin");
                                        $pliegos = ControladorPliegos::ctrMostrarPliegos("admin","admin");

                                    }


                                    $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
//                                    echo "<pre>";
//                                    print_r($pliegos);
//                                    echo "</pre>";10006591
                                    //          echo count($usuarios);
                                    foreach ($pliegos as $key => $value)
                                    {

        echo'<tr>
          <td class="d-none">'.$value->IDPliego.'</td>
          <td>'.utf8_encode($value->nombre_corto).'</td>
          <td>'.utf8_encode($value->division).'</td>
          <td>'.utf8_encode($value->generales).'</td>';


                if ($value->num_empleado!='Externo')
                {

                        $empleadosData = ControladorUsuarios::ctrDatosEmpleadoByNumemp($value->num_empleado);
//                        echo "<pre>";
//                        print_r($empleadosData);
//                        echo "</pre>";
                        foreach ($empleadosData as $key => $valE)
                            {
                                $nombre=$valE->nombre;
                                    echo '<td>'.$nombre.'</td>';
                            }
                }
                elseif($value->num_empleado=='Externo')
                {
                    if($value->nombre_usuario!="" )
                    {
                        echo '<td>'.$value->nombre_usuario.'</td>';

                    }
                    else
                    {
                        echo '<td>'.utf8_encode($value->usuario).'</td>';

                    }
                }
                elseif ($value->num_empleado=="" || $value->num_empleado==null)
                {

                        echo '<td> - </td>';


                }


          echo'
          <td>'.$value->fecha_alta.'</td>
          <td>
            <div class="btn-group">'; 

//                      <button class="btn btn-warning btn-xs btnEditarUsuario"  data-toggle="modal" data-target="#modalEditarPliego_'.$value->IDPliego.'"><i class="fas fa-pencil-alt"></i></button>
//
//                      <button class="btn btn-danger btn-xs btnEliminarPliego" idPliego="'.$value->IDPliego.'" ><i class="fa fa-times"></i></button>

                                        echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/pliegos/'.$value->archivo.'"><i class="fa fa-download"></i></a>

            </div></td>

        </tr>
        <div id="modalEditar_'.$value->id.'" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" id="form_'.$value->id.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Editar Usuario '.$value->usuario.'</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">

                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          </div>
                          <input type="text" name="editarNumEmpleado" id="editarNumEmpleado" class="form-control input-lg" value="'.$value->num_empleado.'" required>

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          </div>
                        </div>
                        <input type="text" name="editarUsuario" id="editarUsuario" class="form-control input-lg"  value="'.$value->usuario.'" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-mail-bulk"></i></span>
                          </div>
                        </div>
                        <input type="text" name="editarCorreo" id="editarCorreo" class="form-control input-lg"  value="'.$value->correo.'" required>
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          </div>                        
                          <select class="form-control input-lg" name="editarPerfil" value="'.$value->perfil.'">';

                                        if ($value->id_perfil==1)
                                        {

                                            echo '
                          <option  value="1" selected>Administrador</option>
                          <option value="2">Gerente CH</option>
                          <option value="3">'.$textosArray[176].'</option>';
                                        }
                                        elseif ($value->id_perfil==2)
                                        {

                                            echo '
                          <option  value="1" >Administrador</option>
                          <option value="2" selected>Gerente CH</option>
                          <option value="3">'.$textosArray[176].'</option>';
                                        }
                                        elseif ($value->id_perfil==3)
                                        {

                                            echo '
                          <option  value="1" >Administrador</option>
                          <option value="2" >Gerente CH</option>
                          <option value="3" selected>'.$textosArray[176].'</option>';

                                        }

                                        echo '</select>
                      </div>
                    </div>
 
                    
                  </div>
                 
              
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_'.$value->id.'" idUsuario="'.$value->id.'">Guardar</button>
                </div>              
              </div>
            </form>  
         </div>
       </div>';


                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>

                    <div class="tab-pane fade" id="creados" role="tabpanel" aria-labelledby="creados-tab">
                        <div class="col-md-12">
                            <div class="card" ">
                            <div class="card-body">
                                <h4>Pliegos Creados</h4>
                                <table class="table table-striped tabladatatable dt-responsive" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="d-none" scope="col" width="10%">Pliego</th>
                                        <th scope="col" width="25%"><?php echo $textosArray[176];?></th>
                                        <th scope="col" width="25%"><?php echo $textosArray[67];?></th>
                                        <th scope="col" width="25%"><?php echo $textosArray[209];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[210];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[211];?></th>
                                        <th scope="col" width="15%"><?php echo $textosArray[12];?></th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
                                    if ($_SESSION['id_perfil']==3)
                                    {
                                        $pliegosCreados = ControladorPliegos::ctrMostrarPliegosCreados($_SESSION['cod_division'],"");

                                    }
                                    elseif ($_SESSION['id_perfil']==4 || $_SESSION['id_perfil']==2)
                                    {
                                        $pliegosCreados = ControladorPliegos::ctrMostrarPliegosCreados($_SESSION['divisiones'],$_SESSION['pais']);

                                    }
                                    elseif ($_SESSION['id_perfil']==1)
                                    {
                                        $pliegosCreados = ControladorPliegos::ctrMostrarPliegosCreados("admin","admin");

                                    }
                                    //   echo "aqui<br>";
//                                      echo "<pre>";
//                                      print_r($pliegosCreados);
//                                      echo "</pre>";
                                    //          echo count($usuarios);
                                    foreach ($pliegosCreados as $key => $val)
                                    {
    //              echo "<br>";
    //              print_r($val->id);
                                        echo'<tr>
              <td class="d-none">'.$val->IDPliego.'</td>
              <td>'.utf8_encode($val->sindicato).'</td>
              <td>'.utf8_encode($val->division).'</td>
              <td>'.utf8_encode($val->generales).'</td>';
                    if ($val->num_empleado!='Externo')
                    {

                        $empleadosData = ControladorUsuarios::ctrDatosEmpleadoByNumemp($val->num_empleado);
//                        echo "<pre>";
//                        print_r($empleadosData);
//                        echo "</pre>";
                        foreach ($empleadosData as $key => $valE2)
                        {

                            $nombre=$valE2->nombre;
                            echo '<td>'.$nombre.'</td>';
                        }
                    }
                    elseif($val->num_empleado=='Externo')
                    {
                        if($val->nombre_usuario!="" )
                        {
                            echo '<td>'.utf8_encode($val->nombre_usuario).'</td>';

                        }
                        else
                        {
                            echo '<td>'.utf8_encode($val->usuario).'</td>';

                        }
                    }
                    elseif ($val->num_empleado=="" || $val->num_empleado==null)
                    {

                        echo '<td> - </td>';


                    }
              echo'
              <td>'.$val->fecha_alta.'</td>
              <td>
                <div class="btn-group">';

    //                      <button class="btn btn-warning btn-xs btnEditarUsuario"  data-toggle="modal" data-target="#modalEditarPliego_'.$val->IDPliego.'"><i class="fas fa-pencil-alt"></i></button>
    //
    //                      <button class="btn btn-danger btn-xs btnEliminarPliego" idPliego="'.$val->IDPliego.'" ><i class="fa fa-times"></i></button>

                                        echo '<a href="vistas/modulos/formatopliego2.php?id='.$val->IDPliego.'" target=”_blank”,> <button type="button" class="btn btn-danger" id="descargar pdf" id="'.$val->IDPliego.'"  title="Formato Pliego" ><i class="fa fa-file"></i></button></a>
    
                </div></td>
    
            </tr>
            <div id="modalEditar_'.$val->id.'" class="modal fade" role="dialog">
             <div class="modal-dialog">
                <form role="form" enctype="multipart/form-data" id="form_'.$value->id.'" >
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                      <h4 class="modal-title">Editar Usuario '.$value->usuario.'</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
    
                    </div>
                    <div class="modal-body">
                      <div class="box-body">
    
                        <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                              </div>
                              <input type="text" name="editarNumEmpleado" id="editarNumEmpleado" class="form-control input-lg" value="'.$value->num_empleado.'" required>
    
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                            </div>
                            <input type="text" name="editarUsuario" id="editarUsuario" class="form-control input-lg"  value="'.$value->usuario.'" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-mail-bulk"></i></span>
                              </div>
                            </div>
                            <input type="text" name="editarCorreo" id="editarCorreo" class="form-control input-lg"  value="'.$value->correo.'" required>
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div>                        
                              <select class="form-control input-lg" name="editarPerfil" value="'.$value->perfil.'">';

                                        if ($value->id_perfil==1)
                                        {

                                            echo '
                              <option  value="1" selected>Administrador</option>
                              <option value="2">Gerente CH</option>
                              <option value="3">'.$textosArray[176].'</option>';
                                        }
                                        elseif ($value->id_perfil==2)
                                        {

                                            echo '
                              <option  value="1" >Administrador</option>
                              <option value="2" selected>Gerente CH</option>
                              <option value="3">'.$textosArray[176].'</option>';
                                        }
                                        elseif ($value->id_perfil==3)
                                        {

                                            echo '
                              <option  value="1" >Administrador</option>
                              <option value="2" >Gerente CH</option>
                              <option value="3" selected>'.$textosArray[176].'</option>';

                                        }

                                        echo '</select>
                          </div>
                        </div>
     
                        
                      </div>
                     
                  
                    </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                          <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_'.$value->id.'" idUsuario="'.$value->id.'">Guardar</button>
                    </div>              
                  </div>
                </form>  
             </div>
           </div>';


                                    }
                                    ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>











        <?php
//            echo "<pre>";
//            print_r($sindicatos);
//            echo "</pre>";
//            $divisiones = ControladorDivisiones::ctrMostrarDivisiones();

            ?>



<!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
            <!-- Modal -->
            <div class="modal fade" id="modalAgregarPliego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $textosArray[212];?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header collapsePliego" id="headingOne" style="background-color: #002554 !important; ">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsePliego" data-toggle="collapse" data-target="#collapsePliego" aria-expanded="true" aria-controls="collapsePliego" style="color: white !important;">
                                                <?php echo $textosArray[177];?>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapsePliego" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                            <span><?php echo $textosArray[176];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                    </div>
                                                    <select class="form-control input-lg" name="sindicato" id="sindicato" required>
                                                        <?php
                                                        if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
                                                        {
                                                            $sindicato=ControladorSindicatos::ctrMostrarSindicatoxDivision($_SESSION['divisiones']);
//                                                            print_r($sindicato);
//                                                            echo $sindicato[0]->sindicato;
                                                            echo count($sindicato);
                                                            for ($x=0;$x< count($sindicato);$x++)
                                                            {
                                                                $tamaño=strlen($sindicato[$x]->sindicato);
                                                                $tamañoF=$tamaño/3;
                                                                $tamañoF=$tamañoF*2;
                                                                echo $sindicato[$x]->cod_division;
                                                                echo'<option title="'.utf8_encode($sindicato[$x]->sindicato).'" value="'.$sindicato[$x]->id.'">'.utf8_encode(substr($sindicato[$x]->sindicato, 0,-$tamañoF)).' - '. utf8_encode($sindicato[$x]->division).'('.$sindicato[$x]->cod_division.')</option>';

                                                            }
//

                                                        }
//
                                                        else
                                                        {
                                                            $sindicatos = ControladorSindicatos::ctrMostrarSindicatos($_SESSION['pais']);

                                                            echo '<option value="">'.$textosArray[214].'</option>';
                                                            foreach ($sindicatos as $key => $valS)
                                                            {
                                                                $tamaño=strlen($valS->sindicato);
                                                                $tamañoF=$tamaño/3;
                                                                $tamañoF=$tamañoF*2;
                                                                echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.$valS->id.'-'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).' - '. utf8_encode($valS->division).'</option>';

//
                                                            }

                                                        }


                                                        ?> 
                                                    </select>
                                                </div>
                                            </div><!-- ./ form-gruop-->
                                            <div class="form-group">
                        <span><?php echo $textosArray[209];?></span>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    </div>
                                                    <textarea class="form-control input-lg" type="text" name="txtTema" id="txtTema"  maxlength="150" placeholder="<?php echo $textosArray[209];?>" required></textarea>
                                                </div>
                                            </div><!-- ./ form-gruop-->

                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="false" aria-controls="collapseArchivos" style="color: white !important;">
                                                 <?php echo $textosArray[30];?>
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

                                                        <input type="file" class="form-control input-lg " name="file" id="file" size="10000" accept=".pdf">
                                                        <input type="text" class="d-none" id="size">
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
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary agregarPliego" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
        <!-- Modal -->
        <div class="modal fade" id="modalCrearPliego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #004fac; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Pliego</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapsePliego2" id="headingOne" style="background-color: #004fac !important; ">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsePliego2" data-toggle="collapse" data-target="#collapsePliego2" aria-expanded="true" aria-controls="collapsePliego2" style="color: white !important;">
                                            <?php echo $textosArray[177];?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapsePliego2" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-group">
                                        <span><?php echo $textosArray[176];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                </div>
                                                <select class="form-control input-lg" name="sindicato2" id="sindicato2" required>
                                                    <?php
                                                    if ($_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==2)
                                                    {
                                                        $sindicato=ControladorSindicatos::ctrMostrarSindicatoxDivision($_SESSION['divisiones']);
//                                                            print_r($sindicato);
//                                                            echo $sindicato[0]->sindicato;
                                                        echo count($sindicato);
                                                        for ($x=0;$x< count($sindicato);$x++)
                                                        {
                                                            $tamaño=strlen($sindicato[$x]->sindicato);
                                                            $tamañoF=$tamaño/3;
                                                            $tamañoF=$tamañoF*2;
                                                            echo $sindicato[$x]->cod_division;
                                                            echo'<option title="'.utf8_encode($sindicato[$x]->sindicato).'" value="'.$sindicato[$x]->id.'">'.utf8_encode(substr($sindicato[$x]->sindicato, 0,-$tamañoF)).' - '. utf8_encode($sindicato[$x]->division).'('.$sindicato[$x]->cod_division.')</option>';

                                                        }
//

                                                    }
//
                                                    else
                                                    {
                                                        $sindicatos = ControladorSindicatos::ctrMostrarSindicatos($_SESSION['pais']);

                                                        echo '<option value="">'.$textosArray[214].'</option>';
                                                        foreach ($sindicatos as $key => $valS)
                                                        {
                                                            $tamaño=strlen($valS->sindicato);
                                                            $tamañoF=$tamaño/3;
                                                            $tamañoF=$tamañoF*2;
                                                            echo'<option title="'.utf8_encode($valS->sindicato).'" value="'.$valS->id.'">'.$valS->id.'-'.utf8_encode(substr($valS->sindicato, 0,-$tamañoF)).' - '. utf8_encode($valS->division).'</option>';

//
                                                        }

                                                    }


                                                    ?>
                                                </select>
                                            </div>
                                        </div><!-- ./ form-gruop-->
                                        <div class="form-group">
                                        <span><?php echo $textosArray[209];?></span>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                </div>
                                                <textarea class="form-control input-lg" type="text" name="txtTema2" id="txtTema2"  maxlength="150" placeholder="<?php echo $textosArray[209];?>" required></textarea>
                                                <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                                            </div>
                                        </div><!-- ./ form-gruop-->

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header collapsePeticiones" id="headingPeticiones" style="background-color:#004fac; color:white; !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapsePeticiones" data-toggle="collapse" data-target="#collapsePeticiones" aria-expanded="false" aria-controls="collapsePeticiones" style="color: white !important;">
                                            <?php echo $textosArray[216];?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapsePeticiones" class="collapse" aria-labelledby="headingPeticiones" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%">
                                            <thead style="background-color:#004fac; color:white; !important;">
                                            <tr>
                                                <th width="92%"><?php echo $textosArray[215];?></th>

                                                <th width="8%"><?php echo $textosArray[13];?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <textarea type="text" class="form-control input-lg" name="Peticion" id="Peticion" placeholder="Petición" required></textarea>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary Agregarpeticiones" aria-label="Agregar" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tbody id="tablaagregarpeticiones">
                                            </tbody>
                                        </table>
                                        <input type="text" class="d-none" id="jsonPeticiones"><!--Json para armar el guardado de acuerdos-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary crearPliego" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $("#subidos-tab").tab('show'); // muestra la primera pestaña
    // $('#pestañas .nav-item:visible:first a').tab('show');

    $(".Agregarpeticiones").click(addPeticion); //agregar sub tabla
    var contador = 0;//variable para remover
    function addPeticion()
    {
        contador += 1;//contador sumando
        var idremove = "$('#peticion_"+contador+"')";
        var Peticion         = $('#Peticion').val();
        var FechaCompromiso = $('#FechaCompromiso').val();
        var Responsable     = $('#Responsable').val();
        var Comentarios     = $('#Comentarios').val();
        if (Peticion != "" ) { //checar si vienen diferende de vacia
            var info = "<tr name='' id='peticion_"+contador+"'>"+
                // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'{"acuerdo":'+ Acuerdo +","+'"FechaCompromiso":'+ FechaCompromiso +','+'"Responsable":'+ Responsable +','+'"Comentarios":'+ Comentarios +'},'+"'/></td>"+
                // "<td class='d-none'><input  type='text' name='jsonAcu[]' value='"+'array('+'"'+ Acuerdo +'"'+","+'"'+ FechaCompromiso +'"' + ','+ '"'+ Responsable + '"'+ ','+ '"'+ Comentarios + '"'+ '),'+"'/></td>"+
                "<td class='d-none'><input  type='text' name='jsonPet[]' value='"+ Peticion +'~'+"'/></td>"+
                "<td><input class='form-control' name='pet[]' id='' type='text'  value='" + Peticion + "' autofocus readonly/></td>"+
               // "<td align='center'><button class='btn btn-primary' onclick="+idremove+".remove();>Eliminar</button></td>"+
                "<td align='center'><button class='btn btn-primary' onclick='borrar("+contador+")'>Eliminar</button></td>"+
                "</tr>";

            $("#tablaagregarpeticiones").append(info);

            var petprev = "<div id='petprev_"+contador+"'>"+
                "<table class='table table-bordered'><thead style='background-color: #002554; color: white;'><tr><th>Peticion</th></tr></thead>"+
                "<tbody><tr><td>"+Peticion+"</td></tr>"+
                "</tbody></table>"+
                "</div>";
            var petprev = "<ul>"+
                "<li><label>Peticion : </label>"+Peticion+"</li>"+
                "</ul>";
            //$("#peticiones").append(petprev);//apend de la variable a ingresar al div de preview de la minuta

            reset_campos(); //funcion resetear campos
            $('#llenarcampospeticiones').hide();
            jasonPeticiones();
        } else {
            $('#llenarcampospeticiones').show();
        }
    }


    function reset_campos() { //reseteo de campos
        $("#Peticion").val("");

        //$('#cboIva').prop('selectedIndex', 0);//para regresar al index en cero o vacio
    }

    function jasonPeticiones()
    {
        var jsonIngredien = '';
        var ingCount = document.getElementsByName("jsonPet[]").length;
        for(i=0;i<ingCount;i++){
            jsonIngredien =jsonIngredien+$("input[name*='jsonPet']")[i].value;
            //  $('#jsonAcuerdos').val("["+jsonIngredien+"]"); //formatojson
            // $('#jsonAcuerdos').val("array ("+jsonIngredien+");"); //formatojson
            $('#jsonPeticiones').val(" "+jsonIngredien+" "); //formatojson
        }
    }

    function borrar(contador) { //para borrar las mismas filas
        $("#peticion_"+contador+"").remove();//se toma el id dinamico creado para poder eliminar el elemento
        $("#petprev_"+contador+"").remove();//lo mismo de arriba
    }


    $('#file').change(function(event) {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarPliego" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".pdf")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregarPliego" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();             
            }
           
    });

    $( ".agregarPliego" ).prop( "disabled", true );

    $(".collapsePliego").hover(function(){
        habiltardes();
    });

    $(".collapseArchivos").hover(function(){
        habiltardes();
    });
    $(".agregarPliego").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarPliego";
        var sindicato       = $("#sindicato").val();
        var txtTema            = $("#txtTema").val();
        var idUser            = $("#idUser").val();
        var file         =  $("#file")[0].files[0];
        //var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#file").val();

        datos.append("file", file);
        datos.append("sindicato", sindicato);//PARA MANDARLO A LA VARIABLE datos
        datos.append("txtTema", txtTema);
        datos.append("idUser", idUser);
        datos.append("funcion", funcion);
        //datos.append("funcion", jsonPeticiones);


        $.ajax({
            url:"ajax/pliegos.ajax.php",
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
                        text: '¡Pliego guardado!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'pliegos';
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡Pliego guardado!',
                        icon: 'warning',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'pliegos';
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


    function habiltardes()
    {//para habilitar llenar los campos
        var file    = $( "#file" ).val();
        var sindicato         = $( "#sindicato" ).val();
        var txtTema      = $( "#txtTema" ).val();
        var sizeval = $("#size").val();//tamaño del archivo
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
       var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        if(sindicato!='' && txtTema!='' && file!='' && siezekiloByte >  $('#file').attr('size')){
            $( ".agregarPliego" ).prop( "disabled", false );
        }else{
            $( ".agregarPliego" ).prop( "disabled", true );
        }
        var extensiones = file.substring(file.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        }else{
                $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregarPliego" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();
                $( ".agregarPliego" ).prop( "disabled", false );             
            }
    };




    // $(".btnEliminarPliego").click(function()
    // {
    //     var id = $(this).attr("idPliego");
    //     var dataForm = new FormData();
    //     var funcion="eliminarPliego";
    //     dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
    //     dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos
    //
    //     Swal.fire({
    //         title: '¡Estas seguro que deseas eliminar la Minuta?',
    //         text: "Si no es asi puedes presionar el boton cancelar",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Si, Borrar Minuta'
    //     }).then((result) => {
    //         if (result.value) {
    //             // window.location = "usuarios";
    //
    //             $.ajax({
    //                 url:"ajax/minutas.ajax.php",
    //                 method: "POST",
    //                 data: dataForm,
    //                 async: true,
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 dataType: "json",
    //                 success: function(respuesta)
    //                 {
    //                     if (respuesta=="ok")
    //                     {
    //                         Swal.fire({
    //                             title: 'Success!',
    //                             text: '¡Registro Exitoso!',
    //                             icon: 'success',
    //                             confirmButtonText:'Ok'
    //                         }).then((result)=>{
    //                             if(result.value){
    //                                 window.location = 'minutas';
    //                             }
    //                         });
    //                     }
    //                     else
    //                     {
    //                         Swal.fire({
    //                             title: 'Warning!',
    //                             text: '¡Eliminado de manera exitosa!',
    //                             icon: 'warning',
    //                             confirmButtonText:'Ok'
    //                         }).then((result)=>{
    //                             if(result.value){
    //                                 window.location = 'minutas';
    //                             }
    //                         });
    //                     }
    //                 },
    //                 error : function(respuesta)
    //                 {
    //                     Swal.fire({
    //                         title: 'Error!',
    //                         text: '¡error al guardar!',
    //                         icon: 'error',
    //                         confirmButtonText:'Ok'
    //                     });
    //                 }
    //
    //             });
    //
    //         }
    //     })
    // });

    $( ".crearPliegoPliego" ).prop( "disabled", true );

    $(".collapsePliego2").hover(function(){
        habiltardes2();
    });

    $(".collapseArchivos2").hover(function(){
        habiltardes2();
    });
    $(".crearPliego").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="crearPliego";
        var sindicato       = $("#sindicato2").val();
        var txtTema            = $("#txtTema2").val();
        var idUser            = $("#idUser").val();
        //var file         =  $("#file")[0].files[0];
        var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#file").val();

        //datos.append("file", file);
        datos.append("sindicato", sindicato);//PARA MANDARLO A LA VARIABLE datos
        datos.append("txtTema", txtTema);
        datos.append("idUser", idUser);
        datos.append("funcion", funcion);
        datos.append("jsonPeticiones", jsonPeticiones);


        $.ajax({
            url:"ajax/pliegos.ajax.php",
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
                        text: '¡Pliego guardado!',
                        icon: 'success',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'pliegos';
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: 'Warning!',
                        text: '¡Pliego guardado!',
                        icon: 'warning',
                        confirmButtonText:'Ok'
                    }).then((result)=>{
                        if(result.value){
                            window.location = 'pliegos';
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


    function habiltardes2()
    {//para habilitar llenar los campos
        //var file    = $( "#file" ).val();
        var jsonPeticiones = $("#jsonPeticiones").val();
        var sindicato         = $( "#sindicato2" ).val();
        var txtTema      = $( "#txtTema2" ).val();
        // var sizeval = $("#size").val();//tamaño del archivo
        if(sindicato!='' && txtTema!='' && jsonPeticiones!='' )
        {
            $( ".crearPliego" ).prop( "disabled", false );
        }else{
            $( ".crearPliego" ).prop( "disabled", true );
        }
       // var extensiones = file.substring(file.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO

        // if (sizeval >  5000) {//if de tamaño
        //     $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        // }else{
        //     $("#tamañoarchivo").hide();//
        // }
        // if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        // {
        //     // alert("El archivo de tipo " + extensiones + " no es válido");
        //     $("#tipoarchivo").show();
        //     $( ".agregarPliego" ).prop( "disabled", true );
        // }else{
        //     $("#tipoarchivo").hide();
        //     $( ".agregarPliego" ).prop( "disabled", false );
        // }
    };

</script>
