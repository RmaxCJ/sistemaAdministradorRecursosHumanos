<?php
//print_r($_POST);
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $textosArray[176];?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
              <li class="breadcrumb-item active"><?php echo $textosArray[176];?></li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSindicatos"><?php echo $textosArray[191];?></button>
        </div>
      </div>
      <br>
     <table class="table table-striped tabladatatable dt-responsive" width="100%">
      <thead>
        <tr>
          <th scope="col" width="40%" ><?php echo $textosArray[176];?></th>
          <th scope="col" width="15%" ><?php echo $textosArray[192];?></th>
          <th scope="col" width="15%" ><?php echo $textosArray[193];?></th>
          <th scope="col" width="5%" ><?php echo $textosArray[194];?></th>
          <th scope="col" width="10%" ><?php echo $textosArray[195];?></th>
          <th scope="col" width="10%" ><?php echo $textosArray[196];?></th>
          <th scope="col" width="10%" ><?php echo $textosArray[12];?></th>
          </tr>
      </thead>
      <tbody>


      <?php
      // echo "aqui<br>";
      $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
      $proveedor = ControladorProveedores::ctrMostrarProveedores();
//      $divisiones = ControladorDivisiones::ctrMostrarDivisiones();
//      $divisionesp = ControladorDivisiones::ctrMostrarDivisionesPais($_POST['paisSelect']);



      if ($_SESSION['id_perfil']==2 || $_SESSION['id_perfil']==3 || $_SESSION['id_perfil']==4 || $_SESSION['id_perfil']==5)
      {
//          $minutas = ControladorMinutas::ctrMostrarMinutas($_SESSION['cod_division'],"");
          $sindicatos = ControladorSindicatos::ctrMostrarSindicatos("",$_SESSION['divisiones']);
          $divisionesp = ControladorDivisiones::ctrMostrarDivisiones($_SESSION['divisiones']);

      }
      elseif ($_SESSION['id_perfil']==1)
      {
          // $sindicatos = ControladorSindicatos::ctrMostrarSindicatos("","");
          $sindicatos = ControladorSindicatos::ctrMostrarSindicatos($_POST['paisSelect'],$_SESSION['divisiones']);
          $divisionesp = ControladorDivisiones::ctrMostrarDivisiones("");

      }


//      $sindicatos = ControladorSindicatos::ctrMostrarSindicatos($_POST['paisSelect']);

//              echo "<pre>";
//          print_r($sindicatos);
//          echo "</pre>";
        //  echo count($usuariossencillos);
    
          foreach ($sindicatos as $key => $value)
          {   
            // $tamaño=strlen($value->sindicato);
            //         $tamañoF=$tamaño/3;
            //         $tamañoF=$tamañoF*2;      
            //         $id_minuta =$value->idm;
//                         <td title='".utf8_encode($value->sindicato)."' style='text-decoration:none'>".utf8_encode(substr($value->sindicato, 0,70))."...</td>
            $id_sindicato =$value->id;   
            echo"<tr>
           <td title='".utf8_encode($value->sindicato)."' style='text-decoration:none'>".utf8_encode($value->sindicato)."</td>
          <td>".utf8_encode($value->nombre_corto)."</td>
          <td>".utf8_encode($value->division)."</td>
          <td>".utf8_encode($value->pais)."</td>
          <!--td>".$value->id_responsable. " - " .$value->usuario."</td-->
          <td>";
          foreach ($usuariossencillos as $key => $valU)//
          {
            $idusuario=$valU->id;
            $id_usuario=$value->idu;
            if($idusuario==$id_usuario){
              if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') {
                  echo utf8_encode($valU->nombre_usuario);
                  }
                  else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
                      $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                      foreach ($empleadosData as $key => $valE)
                          {
                              $nombre=$valE->nombre;
                                  echo utf8_encode($nombre);
                          }
                  }
            }
          }
          
          echo '</td>
          <td>';
          // echo $value->estatus;
          if ( $value->estatus=='A') : echo 'Activo';  elseif ($value->estatus=='B'): echo 'Baja'; endif;
          echo '</td>
          <td>
    
            <div class="btn-group">

                      <button class="btn btn-warning btn-xs btnEditarSindicatos" id="'.$value->id.'" data-toggle="modal" data-target="#modalEditarSindicatos_'.$value->id.'"><i class="fas fa-pencil-alt"></i></button>
                      <button title="Agregar Lider Sindical" class="btn btn-success btn-xs btnAgregaLider" idSindicato="'.$value->id.'" data-toggle="modal" data-target="#modalAgregarLider_'.$value->id.'"><i class="fa fa-user">&nbsp;+</i></button>

                      <button class="btn btn-warning btn-xs btnEliminarSindicato" idSindicato="'.$value->id.'" title="Dar de baja sindicato"><i class="fa fa-times"></i></button>
                      <button class="btn btn-danger btn-xs btnEliminarSindicato2" idSindicato="'.$value->id.'" title="Eliminar Sindicato"><i class="fa fa-times"></i></button>
                      

            </div></td>

        </tr>
        <div id="modalEditarSindicatos_'.$value->id.'" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
              <form role="form" enctype="multipart/form-data" id="form_'.$value->id.'" >
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">'.$textosArray[12].'</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                  </div>
                  <div class="modal-body">
                    <div class="box-body">

                      <div class="row col-md-12">
                        <div class="form-group col-md-6">
                        <span>'.$textosArray[176].'</span>
                          <div class="input-group">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                              </div>
                              <input type="text" name="editarSindicato'.$value->id.'" id="editarSindicato'.$value->id.'" class="form-control input-lg" value="'.utf8_encode($value->sindicato).'" required>

                          </div>
                        </div>
                        <div class="form-group col-md-6">
                        <span>'.$textosArray[191].'</span>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                              </div>
                            </div>
                            <input type="text" name="editarNombreCorto'.$value->id.'" id="editarNombreCorto'.$value->id.'" class="form-control input-lg"  value="'.utf8_encode($value->nombre_corto).'" required>
                          </div>
                        </div>
                      </div>

                    <div class="row col-md-12">
                      <div class="form-group col-md-6">
                      <span>'.$textosArray[192].'</span>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          </div>
                          <select class="form-control input-lg chosen-selec" name="editartxtCod_Division'.$value->id.'" id="editartxtCod_Division'.$value->id.'">';
                          // <input type="text" name="editarCod_division" id="editarCod_division" class="form-control input-lg"  value="'.$value->cod_division.'" required>
                          
                          foreach ($divisionesp as $key => $valD)
                          
                          {
                            $selected="";
                            $cod_div=$valD->cod_division;
                            $cod_divS=$value->cod_division;
                            
                            if($cod_div==$cod_divS){$selected = 'Selected';}

                          echo'<option value="'.$valD->cod_division.'"'  .$selected. '>'.$valD->cod_division. ' - ' .utf8_encode($valD->division).'</option>';
                          }
                          echo
                          '</select> 
                          </div>
                      </div>
                      <!--datos para la tabla proveedores-->
                      <div class="form-group d-none">
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" value="'.utf8_encode($value->idp).'" name="id_proveedor'.$value->id.'" id="id_proveedor'.$value->id.'" maxlength="10" placeholder="id_proveedor" required>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                      <span>'.$textosArray[199].'</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" value="'.utf8_encode($value->num_proveedor).'" name="editartxtnum_proveedor'.$value->id.'" id="editartxtnum_proveedor'.$value->id.'" maxlength="10" placeholder="Num Proveedor" required>
                        </div>
                      </div>
                    </div>

                    <div class="row col-md-12">
                      <div class="form-group col-md-6">
                      <span>RFC</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" value="'.utf8_encode($value->rfc).'" name="editartxtrfc'.$value->id.'" id="editartxtrfc'.$value->id.'" maxlength="15" placeholder="RFC" required>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                      <span>'.$textosArray[57].'</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" value="'.utf8_encode($value->correo).'" name="editartxtcorreo'.$value->id.'" id="editartxtcorreo'.$value->id.'" maxlength="75" placeholder="correo@domain.com" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row col-md-12">
                      <div class="form-group col-md-6">
                      <span>'.$textosArray[103].'</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" value="'.utf8_encode($value->moneda).'" name="editartxtmoneda'.$value->id.'" id="editartxtmoneda'.$value->id.'" placeholder="Moneda" maxlength="20" required>
                        </div>
                      </div>
                    
                      <div class="form-group col-md-6">
                      <span>'.$textosArray[194].'</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div>
                            <select name="editarResponsable'.$value->id.'" id="editarResponsable'.$value->id.'" class="form-control" >';

                            // foreach ($usuariossencillos as $key => $valU)
                            // {
                            //   $selectedU="";
                            //     $idusu=$valU->id;
                            //     $idperfil = $valU->id_perfil;
                            //     $id_resp=$value->id_responsable;
                            
                            //   if($idperfil==3){
                            //         if($idusu==$id_resp){$selectedU = 'Selected';}
                            //     echo'<option value="'.$valU->id.'"'  .$selectedU. '>'.$valU->id.' - '.$valU->usuario.'</option>';
                            //   }
                            // }
                            foreach ($usuariossencillos as $key => $valU) {//asi
                              $selectedU="";
                              $idusu=$valU->id;//PARA COMPARAR DE USUARIOS SENCILLOS
                              $id_resp=$value->id_responsable;//DE LA TABLA DE SINDICATOS
                              if($valU->id_perfil==3){
                                  if ($valU->nombre_usuario != null) {
                                    if($idusu==$id_resp){$selectedU = 'Selected';}
                                      echo'<option value="'.$valU->id.'" '.$selectedU.'>'.utf8_encode($valU->nombre_usuario).'</option>';
                                  } 
                                  else if ($valU->nombre_usuario == null || $valU->nombre_usuario != '') {
                                      $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                      foreach ($empleadosData as $key => $valE)
                                          {
                                            if($idusu==$id_resp){$selectedU = 'Selected';}
                                              $nombre=$valE->nombre;
                                              echo'<option value="'.$valU->id.'" '.$selectedU.'>'.utf8_encode($nombre).'</option>';
                                          }
                                  }
                              }
                            }


                            echo
                            '</select>                    
                    
                        </div>
                      </div>
                    </div>
                    
                    <div class="row col-md-12">
                      <div class="form-group col-md-12">
                      <span>'.$textosArray[200].'</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                          <input type="file" class="form-control input-lg editarfile" size="5000" name="editarfile'.$value->id.'" id="editarfile'.$value->id.'" id_sindicato="'.$value->id.'" placeholder="Moneda" accept=".png" required>';
                          if($value->logo!=" "){//si es diferente de ' ' muestra el boton para ver imagen
                          echo'<a title="Ver Logo" class="btn btn-success" href="/relaciones/vistas/archivos/logos/'.$value->logo.'" target="_blak"><i class="fa fa-file"></i></a>';
                          }
                  echo '</div>
                      </div>
                      <div class="alert alert-danger align-center" id="tipoarchivo'.$value->id.'" style="display: none;"> El tipo de archivo es invalido (solo PNG).</div>
                      <div class="alert alert-danger align-center" id="tamañoarchivo'.$value->id.'" style="display: none;"> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>               
                    </div>
                  </div>  
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                        <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_'.$value->id.'" id="'.$value->id.'">Guardar</button>
                  </div>              
                </div>
              </form>  
          </div>
        </div>';
        //////////////////////////////////////////////Agregar Lider
        echo' <div id="modalAgregarLider_'.$value->id.'" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" id="formLider_'.$value->id.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">'.$textosArray[201].'</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">
                  
                      <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div>
                            <select name="lider'.$value->id.'" id="lider'.$value->id.'" class="form-control" >
                              <option value="">'.$textosArray[203].'</option>';

                            // foreach ($usuariossencillos as $key => $valUsu)
                            // {
                              
                            //   if($valUsu->id_perfil==3){
                            //         if($idusu==$id_resp){$selectedU = 'Selected';}
                            //     echo'<option value="'.$valUsu->id.'-'.$valUsu->usuario.'">'.$valUsu->id.' - '.utf8_encode($valUsu->usuario).'</option>';
                            //   }
                            // }
                            foreach ($usuariossencillos as $key => $valU) {//asi
                              if($valU->id_perfil==3){
                                  if ($valU->nombre_usuario != null) {
                                      echo'<option value="'.$valU->id.' - '.utf8_encode($valU->nombre_usuario).'">'.utf8_encode($valU->nombre_usuario).'</option>';
                                  } 
                                  else if ($valU->nombre_usuario == null || $valU->nombre_usuario != '') {
                                      $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                      foreach ($empleadosData as $key => $valE)
                                          {
                                              $nombre=$valE->nombre;
                                              echo'<option value="'.$valU->id.' - '.utf8_encode($nombre).'">'.utf8_encode($nombre).'</option>';
                                          }
                                  }
                              }
                            }
                            echo
                            '</select>
                            <button class="btn btn-primary AgregarLider" onclick="addLider('.$value->id.')" aria-label="Agregar Lider" title="Agregar Lider" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                    
                    
                        </div>
                      </div>
                        <div class="alert alert-danger" id="agregalider'.$value->id.'" style="display:none;">
                           Agregar lider.
                        </div>
                      <div class=lideres id="lideres'.$value->id.'">

                      </div>                 
                      <input type="text" class="d-none arraylider" id="jsonLideres'.$value->id.'"><!--Json para armar el guardado multiple-->
                      <input type="text" class="d-none arrayliderg" id="jsonLideresG'.$value->id.'"><!--Json para armar el guardado multiple-->';
                      
                      echo '<div class="mostrarlideres" id="mostrarlideres'.$value->id.'">
                            </div>';
            echo '</div>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary guardarLideres" title="Para habilitar se requiere agregar un lider o seleccionar un lider a eliminar" idForm="form_'.$value->id.'" id="'.$value->id.'">Guardar</button>
                </div>              
              </div>
            </form>  
        </div>
      </div>';
          }
        ?>

      </tbody>
</table>

<!-- Modal Nuevo Sindicatos -->

<div id="modalAgregarSindicatos" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg">
            <form role="form" method="post" enctype="multipart/form-data" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Agregar Sindicatos</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">
                  <input type="text" class="d-none" value="<?php echo $_SESSION["id"]; ?>" name="id_usuario" id="id_usuario">  

                    <div class=" row col-md-12">  
                      <div class="form-group col-md-6">
                      <span for="">Sindicato</span>
                        <div class="input-group">
                              <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                            <input type="text" class="form-control input-lg" name="txtSindicato" id="txtSindicato" placeholder="Sindicato" required>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                      <span for="">Nombre Corto</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="txtNombreCorto" id="txtNombreCorto" placeholder="Nombre corto" required>
                        </div>
                      </div>
                    </div>  
                    <div class="row col-md-12">
                      <div class="form-group col-md-6">
                      <span for="">Código División</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                          <!-- <input type="text" class="form-control input-lg" name="txtCod_Division" id="txtCod_Division" placeholder="Codigo Div" required> -->
                          <select class="form-control chosen-selec input-xl" name="txtCod_Division" id="txtCod_Division">
                          <option value="">Seleccione División</option>
                          <?php
                              foreach ($divisionesp as $key => $valDp)
                              { 
                                // if($valD->pais=='mexico' OR $valD->pais=='argentina'){
                                  echo'<option value="'.$valDp->cod_division.'">'.$valDp->cod_division. ' - ' .utf8_encode($valDp->division).'</option>';
                                // }
                              }
                          ?>
                          </select>
                        </div>
                      </div>
                      <!--datos para la tabla proveedores-->
                      <div class="form-group col-md-6">
                      <span for="">Número Proveedor</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="txtnum_proveedor" id="txtnum_proveedor" maxlength="10" placeholder="Num Proveedor" required>
                        </div>
                      </div>
                    </div>

                    <div class="row col-md-12">
                      <div class="form-group col-md-6">
                      <span for="">RFC</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="txtrfc" id="txtrfc" maxlength="15" placeholder="RFC" required>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                      <span for="">Correo @</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="txtcorreo" id="txtcorreo" maxlength="75" placeholder="correo@domain.com" required>
                        </div>
                      </div>
                    </div>

                    <div class="row col-md-12"> 
                      <div class="form-group col-md-6">
                      <span for="">Moneda</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="txtmoneda" id="txtmoneda" placeholder="Moneda" maxlength="20" required>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                      <span for="">Responsable Sindical</span>
                        <div class="input-group">
                          <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              </div>
                              <select class="form-control input-lg" name="responsableSelect" id="responsableSelect">
                              <option value="">Responsable Sindical</option>
                              <?php
                              $responsables=ControladorUsuarios::ctrMostrarUsuariosResponsables();
//                              print_r($responsables);
                              foreach ($responsables as $key =>$val)
                              {
                                  echo'<option value="'.$val->idu.'">'.utf8_encode($val->nombre_usuario).'</option>';

                              }
                              // foreach ($usuariossencillos as $key => $valU)
                              // {
                              //   $idperfil = $valU->id_perfil;
                              //   if($idperfil==3){
                              //     echo'<option value="'.$valU->id.'">'.$valU->id.' - '.utf8_encode($valU->nombre_usuario).'</option>';
                              //   }
                              // }
//                              foreach ($usuariossencillos as $key => $valU) {
//                                if($valU->id_perfil==3){
//                                    if ($valU->nombre_usuario != null) {
//                                        echo'<option value="'.$valU->id.'">'.utf8_encode($valU->nombre_usuario).'</option>';
//                                    }
//                                    else if ($valU->nombre_usuario == null || $valU->nombre_usuario != '') {
//                                        $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
//                                        foreach ($empleadosData as $key => $valE)
//                                            {
//                                                $nombre=$valE->nombre;
//                                                echo'<option value="'.$valU->id.'">'.utf8_encode($nombre).'</option>';
//                                            }
//                                    }
//                                }
//                              }
                              ?>  
                            </select>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row col-md-12">
                      <div class="form-group col-md-12">
                        <span> Logo Sindicato</span>
                        <div class="input-group">
                            <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                          <input type="file" class="form-control input-lg" name="file" id="file" size="5000" placeholder="Moneda" accept=".png" required>
                        </div>
                      </div>
                    </div>
                    <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"> El tipo de archivo es invalido (solo PNG).</div>
                    <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarSindicatos" >Guardar Cambios</button>
                  </div>
                 
                </div>
                
              </div>

            </form>
           
         </div>
       </div>
<!-- fin modal agregar -->

    </section>
    <!-- /.content -->
  </div>

 <script>
 $(document).ready (function ()
{
  $('.guardarLideres').attr('disabled', true);
  // $('.guardarLideres').click(function(event) {
  //   var id = $(this).attr("id");
  //   var jsonlider = $("#jsonLideres"+id).val();
  //   var jsonliderg = $("#jsonLideresG"+id).val();
  //   if(jsonlider!=""||jsonliderg!=""){
  //     $('.guardarLideres').attr('disabled', false);
  //   }
  // });

  $('#file').change(function(event) {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarSindicatos" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo").hide();//
                $( ".agregarSindicatos" ).prop( "disabled", false );
        }
        if(extensiones != ".png")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregarSindicatos" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();  
                $( ".agregarSindicatos" ).prop( "disabled", false );           
            }
           
    });    
    $('.editarfile').change(function(event) {
        var id = $(this).attr("id_sindicato");
        var archivo = $("#editarfile"+id).val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#editarfile'+id)[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#editarfile'+id).attr('size')) {//if de tamaño
            $("#tamañoarchivo"+id).show();//mostrar archivo demaciado grande
            $( "#"+id ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo"+id).hide();//
                $( "#"+id ).prop( "disabled", false );
        }
        if(extensiones != ".png")
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo"+id).show();
                $( "#"+id ).prop( "disabled", true );
            }else{
                $("#tipoarchivo"+id).hide();  
                $( "#"+id ).prop( "disabled", false );           
            }
           
    });    

  //////////////////////para el chosenselect
  $('.chosen-select').chosen({//para funcionamiento de chosen select
          // allow_single_deselect: true,
          no_results_text: "No se han encontrado datos con:",
          width: '90%',
          heigth: '100%'
  });
  $(document).on("change", ".eliminalider", function() {//para detectar el checbox dinamico creado de la consulta de los acuerdos pasados 
        var id = $(this).attr("id");
        var id_sindicato = $(this).attr("id_sindicato");
        var id_liderG = $(this).attr("id_lider");//buscar el atributo id que es el id_acuerdo para q sea unico
        if( $("."+id+"").is(':checked') ) {
            // alert('Seleccionado');
            var acuerdoG = $(this).attr("acuerdo");//apartir de aqui se toman los valores de cad uno de los atributos q es la info  de los acuerdos pasados
            var id_lider = $(this).attr("id_lider");
            var id_lid = $(this).attr("id_lid");
            var acpas = "<input class='d-none' id='liderG_"+id_liderG+"'  type='text' name='jsonLidG"+id_sindicato+"[]' value='"+ id_lid +'~'+"'/>";//se crea  la variable para agregarlos al div correspondiente en la clase correspondiente
            $("#lideres"+id_sindicato).append(acpas);
            jasonLideresG(id_sindicato);//funcion para leer los inputs tipo arreglo y agregarlos al arreglo final concatenando todos 
        }else{
            $("#liderG_"+id_liderG+"").remove();//eliminacion del elemento al deschecar check
            jasonLideresG(id_sindicato);

        }    
    });
  $('.btnAgregaLider').click(function(event) {//consiulta va y regresa con la info solicitada de los lideres 
    //para y regresar con los acuerdos pasados
        var id_sindicato = $(this).attr("idSindicato");
        var datos = new FormData();
        var funcion ="BuscarLideresSindicatos";
        // var sindicato   = $('#cbo_sindicato').val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("id_sindicato", id_sindicato);
        $.ajax({//regresa la informacion en forma de tabla para poder procesarla si se requiere usar algun acuerdo pasado
            url:"ajax/sindicatos.ajax.php",
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
                stringHTML+= "<thead align='center'>";
                stringHTML+= "<tr align='center'>";
                // stringHTML+= "<th width='25%' scope='col'>id</th>";
                stringHTML+= "<th align='center' class='justify-content-center' width='25%' scope='col'>Usuario</th>";
                // stringHTML+= "<th width='25%' scope='col'>id_lider</th>";
                stringHTML+= "<th align='center' class='justify-content-center' width='25%' scope='col'>eliminar</th>";
                stringHTML+= "</tr>";
                stringHTML+= "</thead>";
                stringHTML+= "<tbody>";


                respuesta.forEach((obj, i) => {
                  // var nombre_usuario = obj['nombre_usuario'];
                    stringHTML+="<tr>";
                    // stringHTML+="<td>"+obj['id']+"</td>";id =id_lider/ id_sindicato/ id_lider/ nombre/num_empleado/id_perfil
                    stringHTML+="<td align='center' class='justify-content-center'>"+obj['id']+"-"+obj['nombre']+"</td>";
                    // stringHTML+="<td>"+obj['id_lider']+"</td>";
                    stringHTML+="<td title='Al checar la casilla se eliminará el lider.' align='center' class='justify-content-center'><center><input type='checkbox' id='addlider_"+obj['id']+"' id_lider id_sindicato='"+obj['id_sindicato']+"' id_lider='"+obj['id_lider']+"' id_lid='"+obj['id']+"' class='eliminalider addlider_"+obj['id']+"' value=''/></center></td>";
                    stringHTML+="</tr>";
                });
                stringHTML+="</tbody>";
                stringHTML+="</table><br>";
                $(".mostrarlideres").html(stringHTML);
              }
              else{
                console.log(respuesta);
                var stringHTML="";
                stringHTML+="<br><div class='alert alert-warning' align='center'><strong></strong><?php echo $textosArray[202];?>.</div>";
        
                $(".mostrarlideres").html(stringHTML);

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
    $(".agregarSindicatos").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base] 
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion="agregarSindicatos";
        var Sindicato       = $("#txtSindicato").val();
        var NombreCorto     = $("#txtNombreCorto").val();
        var Cod_Division    = $("#txtCod_Division").val();
        var num_proveedor   = $("#txtnum_proveedor").val();
        var rfc             = $("#txtrfc").val();
        var correo          = $("#txtcorreo").val();
        var moneda          = $("#txtmoneda").val();
        var file         =  $("#file")[0].files[0];//logo
        var IDRES  = $("#responsableSelect").val();
        var id_Responsable  = $("#responsableSelect").val();
        var id_usuario  = $("#id_usuario").val();
        
        datos.append("file", file);
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("Sindicato", Sindicato);
        datos.append("NombreCorto", NombreCorto);
        datos.append("Cod_Division", Cod_Division);
        datos.append("num_proveedor", num_proveedor);
        datos.append("rfc", rfc);
        datos.append("correo", correo);
        datos.append("moneda", moneda);
        datos.append("IDRES", IDRES);
        datos.append("id_usuario", id_usuario);

        
        $.ajax({
            url:"ajax/sindicatos.ajax.php",
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
    });

    $(".guardarEdicion").click(function()
    {
        var idForm = $(this).attr("idForm");//tomar el atributo
        var id = $(this).attr("id");//tomar el id 
        // console.log(idForm);
        //  // console.log(document.getElementById(idForm));

        // console.log($('#'+idForm).serializeArray());
        // var inputs=$('#'+idForm).serializeArray();

        // // var datos = new FormData();
        // var datos =  new Array();
        // // datos.push(funcion);
        // $.each(inputs, function(i, field){//para poderlos ocupar afuera
        //     // $("#results").append(field.name + ":" + field.value + " ");
        //     //  datos.append(field.name, field.value);
        //     // alert(field.value);
        //     datos.push(field.value);//se guarda en el array de datos


        // });
        // console.log(datos);

        // var dataForm = new FormData();
        // var funcion="editarSindicatos";
        // var Sindicato      = datos[0];
        // var NombreCorto    = datos[1];
        // var Cod_division   = datos[2];
        // var id_proveedor   = datos[3];
        // var Num_Proveedor  = datos[4];
        // var rfc            = datos[5];
        // var Correo         = datos[6];
        // var Moneda         = datos[7];
        // var id_Responsable = datos[8];
        // var archivo        = datos[9];
        var datos = new FormData();
        var funcion       ="editarSindicatos";
        var Sindicato     = $("#editarSindicato"+id).val();
        var NombreCorto   = $("#editarNombreCorto"+id).val();
        var Cod_division  = $("#editartxtCod_Division"+id).val();
        var id_proveedor  = $("#id_proveedor"+id).val();
        var Num_Proveedor = $("#editartxtnum_proveedor"+id).val();
        var rfc           = $("#editartxtrfc"+id).val();
        var Correo        = $("#editartxtcorreo"+id).val();
        var Moneda        = $("#editartxtmoneda"+id).val();
        var file          =  $("#editarfile"+id)[0].files[0];//logo
        var id_Responsable= $("#editarResponsable"+id).val();

        datos.append("file", file);
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("Sindicato", Sindicato);
        datos.append("NombreCorto", NombreCorto);
        datos.append("Cod_division", Cod_division);
        datos.append("id_proveedor", id_proveedor);
        datos.append("Num_Proveedor", Num_Proveedor);
        datos.append("rfc", rfc);
        datos.append("Correo", Correo);
        datos.append("Moneda", Moneda);
        datos.append("id_Responsable", id_Responsable);
        datos.append("id", id);

        $.ajax({
            url:"ajax/sindicatos.ajax.php",
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

    $(".guardarLideres").click(function()//agregar lideres
    {
        var idForm = $(this).attr("idForm");//tomar el atributo
        var id = $(this).attr("id");//tomar el id 

        var datos = new FormData();
        var funcion       ="AgregarLideresSindicatos";
        var jsonLideres     = $("#jsonLideres"+id).val();
        var jsonLideresG     = $("#jsonLideresG"+id).val();
        var id_sindicato   = id;

        datos.append("file", file);
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("jsonLideres", jsonLideres);
        datos.append("jsonLideresG", jsonLideresG);
        datos.append("id_sindicato", id_sindicato);

        datos.append("id", id);

        $.ajax({
            url:"ajax/sindicatos.ajax.php",
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

    $(".btnEliminarSindicato").click(function()
     {

         var id = $(this).attr("idSindicato");
         var dataForm = new FormData();
         var funcion="eliminarSindicatos";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos

         Swal.fire({
             title: '¿<?php echo $textosArray[206];?>?',
             //text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'OK'
         }).then((result) => {
             if (result.value) {
                 // window.location = "usuarios";

                 $.ajax({
                     url:"ajax/sindicatos.ajax.php",
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

     $(".btnEliminarSindicato2").click(function()
     {

         var id = $(this).attr("idSindicato");
         var dataForm = new FormData();
         var funcion="eliminarSindicatos2";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos

         Swal.fire({
             title:'¿<?php echo $textosArray[205];?>?',
             //text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'OK'
         }).then((result) => {
             if (result.value) {
                 // window.location = "usuarios";

                 $.ajax({
                     url:"ajax/sindicatos.ajax.php",
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


});

var contador = 0;//variable para remover
function addLider(id) {
        contador += 1;//contador sumando
        var idremove = "$('#lider_"+contador+"')";
        var Lider    = $('#lider'+id).val();
        var res = Lider.split("-");
        var idlider = res[0];
        if (Lider != "") { //checar si vienen diferende de vacia
            var info = "<div class='form-group' name='' id='lider_"+contador+"'>"+
                            "<div class='input-group'>"+
                                "<div class='input-group-text'>"+
                                  "<span class='input-group-addon'><i class='fa fa-users'></i></span>"+
                                "</div>"+
                                "<input class='d-none' type='text' name='jsonLid"+id+"[]' value='"+ idlider +'~'+"'/>"+
                                "<input class='form-control' name='acuer"+id+"[]' id='' type='text'  value='" + Lider + "' autofocus readonly/>"+
                                "<button class='btn btn-primary' onclick='borrar("+contador+','+id+")'><i class='fa fa-minus' aria-hidden='true'></i></button>"+
                           "</div>"+
                       "</div>";
                                  
            $("#lideres"+id).append(info);
            reset_campos(id); //funcion resetear campos
            $('#agregalider'+id).hide();
            jasonLideres(id);
            $('.guardarLideres').attr('disabled', false);
        } else {
            $('#agregalider'+id).show();
        }
}
function reset_campos(id) { //reseteo de campos
    $("#Acuerdo"+id).val("");
}
function jasonLideres(id){
    var jsonLider = '';
    var acuCount = document.getElementsByName("jsonLid"+id+"[]").length;
    for(i=0;i<acuCount;i++){
         jsonLider =jsonLider+$("input[name*='jsonLid"+id+"']")[i].value;
        $('#jsonLideres'+id).val(" "+jsonLider+" "); //formatojson
        $('.guardarLideres').attr('disabled', false);
    }
    if(acuCount==0){
        $('#jsonLideres'+id).val(""); //formatojson
    }
}
function jasonLideresG(id_sindicato){///////////////////////lideres G
    var jsonLider = '';
    var acuCount2 = document.getElementsByName("jsonLidG"+id_sindicato+"[]").length;
    for(i=0;i<acuCount2;i++){
         jsonLider =jsonLider+$("input[name*='jsonLidG"+id_sindicato+"']")[i].value;
        $('#jsonLideresG'+id_sindicato).val(" "+jsonLider+" "); //formatojson
        $('.guardarLideres').attr('disabled', false);
    }
    if(acuCount2==0){
        $('#jsonLideresG'+id_sindicato).val(""); //formatojson
    }
}
function borrar(contador,id) { //para borrar las mismas filas
    $("#lider_"+contador+"").remove();//se toma el id dinamico creado para poder eliminar el elemento
    jasonLideres(id);    
}
 


 </script>
 
<?php

//  ?>