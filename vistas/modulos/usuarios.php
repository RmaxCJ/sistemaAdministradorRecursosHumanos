 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Externo</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarEmpleado">Agregar Empleado</button>
            </div>
        </div>
      </div>


        <br>
     <table class="table table-striped tabladatatable dt-responsive" width="100%">
      <thead>
        <tr>
          <th width="15%" scope="col">Perfil</th>
          <th width="5%" scope="col">Numero Empleado</th>
          <th width="5%" scope="col">Usuario</th>
          <th width="15%" scope="col">Nombre</th>
          <th width="15%" scope="col">Correo</th>
<!--            <th width="10%" scope="col">Estatus</th>-->
            <th width="30%" scope="col">Divisiones</th>
          <th width="5%" scope="col">Acciones</th>
          </tr>
      </thead>
      <tbody>


      <?php
      $perfiles= ControladorUsuarios::ctrPerfiles();
      $divisiones=ControladorDivisiones::ctrMostrarDivisiones();
//      echo "<pre>";
//      print_r($perfiles);
//      echo "</pre>";
    //   echo "aqui<br>";
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios();
//          echo "<pre>";
//          print_r($usuarios);
//          echo "</pre>";
//          echo count($usuarios);
          foreach ($usuarios as $key => $value)
          {
//              echo "<br>";
//              print_r($value->id);
            echo'<tr>
          <td>'.$value->perfil.'</td>
          <td>'.$value->num_empleado.'</td>
          <td>'.$value->usuario.'</td>';
         
            
//          if ( $value->nombre_usuario != null || $value->nombre_usuario!='')
//          {
//
//          }
              if ($value->num_empleado!='Externo')
              {
                  $empleadosData = ControladorUsuarios::ctrDatosEmpleadoByNumemp($value->num_empleado);
                  foreach ($empleadosData as $key => $valE)
                      {

                              echo  "<td>".utf8_encode($nombre=$valE->nombre)."</td>";
                      }
              }
              else
              {
                  echo "<td>".utf8_encode($value->nombre_usuario)."</td>";
              }
       
     
      
      echo '
          <td>'.$value->correo.'</td>';
//          $divisionesUsuario=ControladorUsuarios::ctrDivisionesUsuario($value->idu);
//          echo "<pre>";
//          print_r($divisionesUsuario);
//          echo "</pre>";
//          foreach ($divisionesUsuario as $key=>$valD)
//          {
////              <select class="form-control input-lg monedaCierre" id="'.$value->id.'" >
//          }

          // echo $value->estatus;
//          if ( $value->activo=='A') : echo 'Activo';  elseif ($value->activo=='B'): echo 'Baja'; endif;
          echo '<td>';
            if($value->num_empleado=='Externo')
            {

                $divisionesUsuario=ControladorUsuarios::ctrDivisionesUsuario($value->idu);
//            echo "<pre>";
//            print_r($divisionesUsuario);
//            echo "</pre>";
                $arrayDivisiones=array();
                $divConcat="";
                foreach ($divisionesUsuario as $key => $value3)
                {
                    $divConcat.=utf8_encode($value3->division);
                    $divConcat.="/";
//                  array_push($arrayDivisiones,$titleUTF8_3 );
                }
//              print_r($arrayDivisiones);
                echo '<textarea type="text" class="form-control input-lg" style="font-size: small !important;" readonly>'.$divConcat.'</textarea>';





            }
            elseif ($value->num_empleado!='Externo')
            {

                $divisionesUsuario=ControladorUsuarios::ctrDivisionesEmpleados($value->idu);
//            echo "<pre>";
//            print_r($divisionesUsuario);
//            echo "</pre>";
                $arrayDivisiones=array();
                $divConcat="";
                foreach ($divisionesUsuario as $key => $value3)
                {
                    $divConcat.=utf8_encode($value3->division);
                    $divConcat.="/";
//                  array_push($arrayDivisiones,$titleUTF8_3 );
                }
//              print_r($arrayDivisiones);
                echo '<textarea type="text" class="form-control input-lg" style="font-size: small !important;" readonly>'.$divConcat.'</textarea>';


            }


              echo'</td>
                    <td>
            <div class="btn-group">

                      <button class="btn btn-warning btn-xs btnEditarUsuario" idUsuario="'.$value->idu.'" data-toggle="modal" data-target="#modalEditarUsuario_'.$value->idu.'"><i class="fas fa-pencil-alt"></i></button>
                      <button class="btn btn-primary btn-xs btnRevisarDivisiones" idUsuario="'.$value->idu.'" data-toggle="modal" data-target="#modalRevisarDivisiones_'.$value->idu.'"><i class="fas fa-user-edit"></i></button>
                      <button style="background-color: #afb42b !important;color: black !important;" class="btn btn-default btn-xs btnQuitarDivisiones" idUsuario="'.$value->idu.'" data-toggle="modal" data-target="#modalQuitarDivisiones_'.$value->idu.'"><i class="fas fa-user-minus"></i></button>

                      <button class="btn btn-danger btn-xs btnBajaUsuario" idUsuario="'.$value->idu.'" usuario="'.$value->usuario.'"><i class="fa fa-stop-circle"></i></button>
                      <button class="btn btn-dark btn-xs btnEliminarUsuario" idUsuario="'.$value->idu.'" usuario="'.$value->usuario.'"><i class="fa fa-times"></i></button>';
                      if ($value->num_empleado=="Externo")
                          {
                                echo'<button class="btn btn-success btn-xs btnResetearPass" idUsuario="'.$value->idu.'" usuario="'.$value->usuario.'"><i class="fa fa-recycle"></i></button>';

                          }

            echo'</div></td>

        </tr>
        <div id="modalEditarUsuario_'.$value->idu.'" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" id="form_'.$value->idu.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Editar Usuario '.$value->usuario.'</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">
                    
                    <div class="form-group">
                    <span>Numero Empleado</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          </div>
                          <input type="text" name="editarNumEmpleado" id="editarNumEmpleado" class="form-control input-lg" value="'.$value->num_empleado.'" required readonly>

                      </div>
                    </div>
                    <div class="form-group">
                    <span>Nombre Empleado</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                          </div>
                          <input type="text" name="editarNombre" id="editarNombre" class="form-control input-lg" value="'.utf8_encode($value->nombre_usuario).'" required >

                      </div>
                    </div>
                    <div class="form-group">
                    <span>Usuario</span>
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
                    <span>Correo @</span>
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
                    <span>Perfil<span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          </div>                        
                          <select class="form-control input-lg" name="editarPerfil" value="'.$value->perfil.'">';
                            foreach ($perfiles as $key => $per)
                                      {
                                        $selectedP="";
                                        $idp=$per->id;
                                        $idperfil = $value->id_perfil;
                                        if($idp==$idperfil){$selectedP = 'Selected';}
                                          echo ' <option  value="'.$per->id.'"'  .$selectedP. '>'.$per->perfil.'</option>';
                                      }

                          echo '</select>
                      </div>
                    </div>
 
                    
                  </div>
                 
              
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_'.$value->idu.'" idUsuario="'.$value->idu.'">Guardar</button>
                </div>              
              </div>
            </form>  
         </div>
       </div>
       <!-- +++ Modal Revisar Divisiones ++++ -->
         <div id="modalRevisarDivisiones_'.$value->idu.'" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" id="frmGuardarDivisiones_'.$value->idu.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Asignar Divisiones al usuario '.$value->usuario.'</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">
                  
                     
                     <div class="form-group">
                        <span>Divisiones Actuales</span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div>
                           <textarea type="text" class="form-control input-lg" style="font-size: small !important;" readonly>'.$divConcat.'</textarea>

                        </div>
                    </div>
                    <!-- ./ form-gruop-->
                     
                     <div class="form-group">
                        <span>Agregar Divisiones</span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                            </div>
                            <select class="form-control input-lg" name="addDivisiones" id="addDivisiones" multiple >';
                              foreach ($divisiones as $key => $div)
                              {
                                  echo ' <option  value="'.$div->cod_division.'">'.utf8_encode($div->division).'</option>';
                              }
                            echo'</select><br>
                        <p style="font-size: 12px;color: red;">(Para seleccionar multiples divisiones debe mantener presionado el boton "Ctrl")</p>

                        </div>
                    </div>
                    <!-- ./ form-gruop-->
                   
                  </div>
                 
              
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary guardarDivisiones" idForm="frmGuardarDivisiones_'.$value->idu.'" idUsuario="'.$value->idu.'" NumEmpleadoUsuario="'.$value->num_empleado.'">Guardar</button>
                </div>              
              </div>
            </form>  
         </div>
       </div>
       
          <!-- +++ Modal Quitar Divisiones ++++ -->
         <div id="modalQuitarDivisiones_'.$value->idu.'" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <form role="form" enctype="multipart/form-data" id="frmQuitarDivisiones_'.$value->idu.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Quitar Divisiones al usuario '.$value->usuario.'</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">
                  
                     
                     <div class="form-group">
                        <span>Divisiones Actuales</span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div>
                           <textarea type="text" class="form-control input-lg" style="font-size: small !important;" readonly>'.$divConcat.'</textarea>

                        </div>
                    </div>
                    <!-- ./ form-gruop-->
                     
                     <div class="form-group">
                        <span>Agregar Divisiones</span>
                        <div class="input-group">
                            <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                            </div>
                            <select class="form-control input-lg" name="quitarDivisiones" id="quitarDivisiones" multiple >';
//              foreach ($divisiones as $key => $div)
//              {
//                  echo ' <option  value="'.$div->cod_division.'">'.utf8_encode($div->division).'</option>';
//              }
                          foreach ($divisionesUsuario as $key => $value3)
                          {
            //                  $divConcat.=utf8_encode($value3->division);
            //                  $divConcat.="/";
            //                  array_push($arrayDivisiones,$titleUTF8_3 );
                              echo ' <option  value="'.$value3->cod_division.'">'.utf8_encode($value3->division).'</option>';

                          }

              echo'</select><br>
                        <p style="font-size: 12px;color: red;">(Para seleccionar multiples divisiones debe mantener presionado el boton "Ctrl")</p>

                        </div>
                    </div>
                    <!-- ./ form-gruop-->
                   
                  </div>
                 
              
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      <button type="button" class="btn btn-primary quitarDivisiones" idForm="frmQuitarDivisiones_'.$value->idu.'" idUsuario="'.$value->idu.'" NumEmpleadoUsuario="'.$value->num_empleado.'">Guardar</button>
                </div>              
              </div>
            </form>  
         </div>
       </div>
       
       ';
        

          }
        ?>

      </tbody>
</table>


<!-- Modal Nuevo Usuario -->
<div  id="modalAgregarUsuario" name="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" >
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                        <span>Perfil</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                </div>
                                <select class="form-control input-lg" name="perfil" id="perfil">
                                    <option value="">--Seleccione--</option>
                                    <option value="3">Sindicato</option>
                                    <option value="4">Abogado General</option>
                                    <option value="5">Abogado Local</option>

<!--                                   --><?php
//                                   foreach ($perfiles as $key => $per)
//                                   {
//                                       echo ' <option  value="'.$per->id.'">'.$per->perfil.'</option>';
//                                   }
//                                   ?>
                                </select>
                            </div>
                        </div><!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Division</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                </div>
                                <select class="form-control input-lg" name="division" id="division">
                                    <option value="">--Seleccione--</option>
                                    <?php
                                    foreach ($divisiones as $key => $div)
                                    {
                                        echo ' <option  value="'.$div->cod_division.'">'.utf8_encode($div->division).'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- ./ form-gruop-->
                        <div class="form-group" style="display: none !important;">
                        <span>Número Empleado</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="num_Empleado" id="num_Empleado" placeholder="Num Empleado" required value="Externo" readonly>
                            </div>
                        </div><!-- ./ form-gruop-->
                        <div class="form-group">
                            <span>Nombre</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="nombreEx" id="nombreEx" placeholder="Usuario" required>
                            </div>
                        </div><!-- ./ form-gruop-->
                        <div class="form-group">
                        <span>Usuario</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="usuario" id="usuario" placeholder="Usuario" required>
                            </div>
                        </div><!-- ./ form-gruop-->
                        <div class="form-group">
                        <span>Correo @</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control input-lg" name="correo" id="correo" placeholder="Correo" required>
                            </div>
                        </div>   <!-- ./ form-gruop-->
                        <div class="form-group">
                        <span>Contraseña</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control input-lg" name="contrasena" id="contrasena" placeholder="Ingresar Contraseña" required>
                            </div>
                        </div><!-- ./ form-gruop-->





                    </div><!--  ./boxbody -->

                </div><!-- ./modalbody  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarUsuarios" >Guardar Cambios</button>
                </div>
            </form>
        </div><!-- ./ modal content -->
    </div><!-- ./ modal dialog -->
</div><!-- ./ primer div id modal -->
<!-- fin modal agregar usuario-->


<!-- Modal Nuevo Usuario ACTIVE  -->
        <div  id="modalAgregarEmpleado" name="modalAgregarEmpleado" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data" >
                        <div class="modal-header" style="background-color: #002554; color: white;">
                            <h4 class="modal-title">Agregar Empleado </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group">
                                <span>Perfil Active</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        </div>
                                        <select class="form-control input-lg" name="perfilActive" id="perfilActive">
                                            <option value="">--Seleccione--</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">CH</option>
                                            <option value="6">Gerente Regional</option>
                                            <option value="7">Pagos</option>

                                        </select>
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                <span>Número Empleado Active</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" name="num_EmpleadoActive" id="num_EmpleadoActive" placeholder="Num Empleado" required>
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                <span>Usuario Active</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-lg" name="usuarioActive" id="usuarioActive" placeholder="Usuario" required readonly>
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                <span>Correo @</span>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control input-lg" name="correoActive" id="correoActive" placeholder="Correo" required readonly>
                                    </div>
                                </div>   <!-- ./ form-gruop-->


                            </div><!--  ./boxbody -->

                        </div><!-- ./modalbody  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary agregarEmpleados" >Guardar Cambios</button>
                        </div>
                    </form>
                </div><!-- ./ modal content -->
            </div><!-- ./ modal dialog -->
        </div><!-- ./ primer div id modal -->


<!-- fin modal agregar active -->


    </section>
    <!-- /.content -->
  </div>

 <script>
 $(document).ready (function ()
{

    $("#num_EmpleadoActive").change(function (){
        var numEmpleadoActive = $(this).val();//tomar el atributo
        // alert(numEmpleadoActive);
        var funcion="buscarEmpleadoByNumEmpleado";
        var datos = new FormData();

        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("numEmpleadoActive", numEmpleadoActive);

        $.ajax({
            url:"ajax/usuarios.ajax.php",
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
                if (typeof(respuesta) != "undefined" && respuesta !== null)
                {
                    var res = respuesta.split("@");
                    $("#usuarioActive").val(res[0]);
                    $("#correoActive").val(respuesta);
                    $("#usuarioActive").css("background-color", "#86a76e");
                    $("#usuarioActive").css("color", "#000000");
                    $("#correoActive").css("background-color", "#86a76e");
                    $("#correoActive").css("color", "#000000");

                }
                else
                {
                    $("#usuarioActive").val("");
                    $("#correoActive").val("");
                    $("#usuarioActive").css("background-color", "#d68585");
                    $("#correoActive").css("background-color", "#d68585");
                    $("#usuarioActive").css("color", "#000000");
                    $("#correoActive").css("color", "#000000");

                }

                // if (respuesta=="ok")
                // {
                //     Swal.fire({
                //         title: 'Success!',
                //         text: '¡Registro Exitoso!',
                //         icon: 'success',
                //         confirmButtonText:'Ok'
                //     }).then((result)=>{
                //         if(result.value){
                //             window.location = 'usuarios';
                //         }
                //     });
                // }else
                // {
                //     Swal.fire({
                //         title: 'Warning!',
                //         text: '¡Registro Exitoso!',
                //         icon: 'warning',
                //         confirmButtonText:'Ok'
                //     }).then((result)=>{
                //         if(result.value){
                //             window.location = 'usuarios';
                //         }
                //     });
                // }


             }//,
            // error : function(respuesta)
            // {
            //     Swal.fire({
            //         title: 'Error!',
            //         text: '¡error al guardar!',
            //         icon: 'error',
            //         confirmButtonText:'Ok'
            //     });
            // }

        });

    });

    $(".agregarUsuarios").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base] 
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion="agregarUsuarios";
        var perfil  = $("#perfil").val();
        var division  = $("#division").val();
        var nombreEx  = $("#nombreEx").val();
        var num_Empleado = $("#num_Empleado").val();
        var usuario      = $("#usuario").val();
        var correo       = $("#correo").val();
        var contrasena   = $("#contrasena").val();
        
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("perfil", perfil);
        datos.append("division", division);
        datos.append("nombreEx", nombreEx);
        datos.append("num_Empleado", num_Empleado);
        datos.append("usuario", usuario);
        datos.append("correo", correo);
        datos.append("contrasena", contrasena);
        $.ajax({
            url:"ajax/usuarios.ajax.php",
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
                          window.location = 'usuarios';
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
                              window.location = 'usuarios';
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

//--------------------------------------------------
     $(".agregarEmpleados").click(function()
     {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
         //var idUsuario = $(this).attr("idUsuario");
         // alert('hola');
         var datos = new FormData();
         var funcion="agregarUsuariosEmpleados";
         var perfil  = $("#perfilActive").val();
         var num_Empleado = $("#num_EmpleadoActive").val();
         var usuario      = $("#usuarioActive").val();
         var correo       = $("#correoActive").val();

         datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         datos.append("perfil", perfil);
         datos.append("num_Empleado", num_Empleado);
         datos.append("usuario", usuario);
         datos.append("correo", correo);
         $.ajax({
             url:"ajax/usuarios.ajax.php",
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
                             window.location = 'usuarios';
                         }
                     });
                 }else
                 {
                     Swal.fire({
                         title: 'Warning!',
                         text: '¡ocurrio un error, por favor verique los datos!',
                         icon: 'warning',
                         confirmButtonText:'Ok'
                     });
                 }


             },
             error : function(respuesta)
             {
                 Swal.fire({
                     title: 'Error!',
                     text: '¡error al guardar, por favor intente de nuevo!',
                     icon: 'error',
                     confirmButtonText:'Ok'
                 });
             }

         }).done(function ()
         {
             $('.succes').show();
         });
     });

     //-----------------------------------------------

    $(".guardarEdicion").click(function()
    {
        //guardarDivisiones
        var idForm = $(this).attr("idForm");//tomar el atributo
        var idUsuario = $(this).attr("idUsuario");//tomar el id 
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
        var funcion="editarUsuario";
        var num_Empleado = datos[0];
        var nombreEmpleado = datos[1];
        var usuario      = datos[2];
        var correo       = datos[3];
        var perfil   = datos[4];


        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("perfil", perfil);
        dataForm.append("num_Empleado", num_Empleado);
        dataForm.append("nombreEmpleado", nombreEmpleado);
        dataForm.append("usuario", usuario);
        dataForm.append("correo", correo);
        dataForm.append("perfil", perfil);
        dataForm.append("idUsuario", idUsuario);

        $.ajax({
            url:"ajax/usuarios.ajax.php",
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
                            window.location = 'usuarios';
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
                            window.location = 'usuarios';
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



});

 $(".btnBajaUsuario").click(function()
     {

         var idUsuario = $(this).attr("idUsuario");
         var dataForm = new FormData();
         var funcion="bajaUsuario";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("idUsuario", idUsuario);//PARA MANDARLO A LA VARIABLE datos


         Swal.fire({
             title: '¡Estas seguro que deseas dar de baja el Usuario?',
             text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Correcto!'
         }).then((result) => {
             if (result.value) {
                 // window.location = "usuarios";

                 $.ajax({
                     url:"ajax/usuarios.ajax.php",
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
                                     window.location = 'usuarios';
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
                                     window.location = 'usuarios';
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


 $(".btnEliminarUsuario").click(function()
 {

     var idUsuario = $(this).attr("idUsuario");
     var dataForm = new FormData();
     var funcion="eliminarUsuario";
     dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
     dataForm.append("idUsuario", idUsuario);//PARA MANDARLO A LA VARIABLE datos


     Swal.fire({
         title: '¡Estas seguro que deseas eliminar el Usuario?',
         text: "Si no es asi puedes presionar el boton cancelar",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, Borrar usuario'
     }).then((result) => {
         if (result.value) {
             // window.location = "usuarios";

             $.ajax({
                 url:"ajax/usuarios.ajax.php",
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
                                 window.location = 'usuarios';
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
                                 window.location = 'usuarios';
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

 $(".btnResetearPass").click(function()
 {

     var idUsuario = $(this).attr("idUsuario");
     var nameUsuario = $(this).attr("usuario");

     var dataForm = new FormData();
     var funcion="resetPass";
     dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
     dataForm.append("idUsuario", idUsuario);//PARA MANDARLO A LA VARIABLE datos
     dataForm.append("nameUsuario", nameUsuario);//PARA MANDARLO A LA VARIABLE datos


     Swal.fire({
         title: '¡Estas seguro que deseas restablecer la constraseña del Usuario?',
         text: "Si no es asi puedes presionar el boton cancelar",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si'
     }).then((result) => {
         if (result.value) {
             // window.location = "usuarios";

             $.ajax({
                 url:"ajax/usuarios.ajax.php",
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
                                 window.location = 'usuarios';
                             }
                         });
                     }
                     else
                     {
                         Swal.fire({
                             title: 'Warning!',
                             text: '¡Se presento un error, intente de nuevo!',
                             icon: 'warning',
                             confirmButtonText:'Ok'
                         }).then((result)=>{
                             if(result.value){
                                 window.location = 'usuarios';
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
 $(".guardarDivisiones").click(function()
 {
     //NumEmpleadoUsuario
     var idForm = $(this).attr("idForm");//tomar el atributo
     var idUsuario = $(this).attr("idUsuario");//tomar el id
     var NumEmpleadoUsuario = $(this).attr("NumEmpleadoUsuario");//tomar el id

     console.log(idUsuario);
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
     var funcion="guardarDivisiones";



     dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
     dataForm.append("idUsuario", idUsuario);
     dataForm.append("NumEmpleadoUsuario", NumEmpleadoUsuario);
     dataForm.append("divisiones", datos);

     $.ajax({
         url:"ajax/usuarios.ajax.php",
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
                         window.location = 'usuarios';
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
                         window.location = 'usuarios';
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

 $(".quitarDivisiones").click(function()
 {
     //NumEmpleadoUsuario
     var idForm = $(this).attr("idForm");//tomar el atributo
     var idUsuario = $(this).attr("idUsuario");//tomar el id
     var NumEmpleadoUsuario = $(this).attr("NumEmpleadoUsuario");//tomar el id
     console.log(idForm);
     console.log(idUsuario);
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
     var funcion="quitarDivisiones";



     dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
     dataForm.append("idUsuario", idUsuario);
     dataForm.append("NumEmpleadoUsuario", NumEmpleadoUsuario);
     dataForm.append("divisiones", datos);

     $.ajax({
         url:"ajax/usuarios.ajax.php",
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
                         window.location = 'usuarios';
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
                         window.location = 'usuarios';
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
 
