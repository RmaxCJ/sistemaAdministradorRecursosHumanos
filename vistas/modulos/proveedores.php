 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Abogados</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Abogados</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSindicatos">Agregar Abogado</button>
        </div>
      </div>
      <br>
     <table class="table table-striped tabladatatable dt-responsive" width="100%">
      <thead>
        <tr>
        <th class="d-none" scope="col" width="5%">#</th>
          <th scope="col" width="10%">Num. Abogado</th>
          <th scope="col" width="20%">Abogado</th>
          <th scope="col" width="15%">RFC</th>
          <th scope="col" width="15%">Código Planta</th>
          <th scope="col" width="20%">Contacto</th>
          <th scope="col" width="15%">Correo</th>
          <th class="d-non" scope="col" width="10%">Estatus</th>
          <th scope="col" width="5%">Acciones</th>
          </tr>
      </thead>
      <tbody>


      <?php
      // echo "aqui<br>";

      $proveedor = ControladorProveedores::ctrMostrarProveedores();
      $divisiones = ControladorDivisiones::ctrMostrarDivisiones();
      $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
        //        echo "<pre>";
        //  print_r($proveedor);
        //  echo "</pre>";
        //  echo count($proveedor);
    
          foreach ($proveedor as $key => $value)
          {  
            //    $est ="";   
            //   if($value->estatus=="A"){$est = "Activo"; } else {$est= "inactivo"; }
            echo'<tr>
          <td class="d-none">'.$value->id.'</td>
          <td>'.$value->num_proveedor.'</td>
          <td>'.$value->proveedor.'</td>
          <td>'.$value->rfc.'</td>
          <td>';
          foreach ($divisiones as $key => $valD)//Del controlador divisiones  realizo la busqueda
          {
            $coddivision=$valD->cod_division;
            $codplanta=$value->cod_planta;
            if($coddivision==$codplanta){
              echo $valD->division;
            }
          }
          
          echo '</td>
          <td>';
          foreach ($usuariossencillos as $key => $valU)
          {
            $idusu=$valU->id;
            $id_cont=$value->id_contacto;
                if($idusu==$id_cont){
                  echo utf8_encode($valU->nombre_usuario);
                }
          }
          
          echo '</td>
          <td>'.$value->correo.'</td>
          <td>';
          // echo $value->estatus;
          if ( $value->estatus=='A') : echo 'Activo';  elseif ($value->estatus=='I') : echo 'Inactivo'; endif;
          echo '</td>
          <td>
          
            <div class="btn-group">

                      <button class="btn btn-warning btn-xs btnEditarSindicatos" id="'.$value->id.'" data-toggle="modal" data-target="#modalEditarSindicatos_'.$value->id.'"><i class="fas fa-pencil-alt"></i></button>

                      <!--button class="btn btn-danger btn-xs btnEliminarUsuario" idSindicato="'.$value->id.'" ><i class="fa fa-times"></i></button-->

            </div></td>

        </tr>
        <div id="modalEditarSindicatos_'.$value->id.'" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg">
            <form role="form" enctype="multipart/form-data" id="form_'.$value->id.'" >
              <div class="modal-content">
                <div class="modal-header" style="background-color: #002554; color: white;">
                  <h4 class="modal-title">Editar Abogado ( '.$value->proveedor.' )</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="box-body">
                      <div class="row col-md-12">
                        <div class="form-group col-md-6">
                        <span>Número Proveedor</span>
                            <div class="input-group">
                            <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" value="'.$value->num_proveedor.'" name="txtnumproveedor" id="txtnumproveedor" placeholder="Num Proveedor" maxlength="10" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <span>Proveedor</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                            <input type="text" class="form-control input-lg" value="'.$value->proveedor.'" name="txtproveedor" id="txtproveedor" placeholder="Proveedor" maxlength="75" maxlength="75" required>
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
                                <input type="text" class="form-control input-lg" value="'.$value->rfc.'" name="txtrfc" id="txtrfc" placeholder="RFC" maxlength="15" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                        <span>Correo @</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                </div>
                            <input type="text" class="form-control input-lg" value="'.$value->correo.'" name="txtcorreo" id="txtcorreo" placeholder="Correo" maxlength="75" required>
                            </div>
                        </div>
                      </div>
                      <div class="row col-md-12">
                        <div class="form-group col-md-6">
                        <span>Contacto</span>
                            <div class="input-group">
                              <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                                <!--input type="text" class="form-control input-lg" value="'.$value->contacto.'" name="txtcontacto" id="txtcontacto" placeholder="Contacto" maxlength="75" required-->
                                <select class="form-control input-lg chosen-selet" name="txtcontacto" id="txtcontacto">
                                <option value="">--Seleccione Contacto--</option>';
                               
                            
                                // foreach ($usuariossencillos as $key => $valU)
                                // {
                                //   $selectedU="";
                                //   $idusu=$valU->id;
                                //   $id_cont=$value->id_contacto;

                                //   $idperfil = $valU->id_perfil;
                                //    if($idperfil==4 || $idperfil==5){
                                      
                                //         echo'<option value="'.$valU->id.'">'.$valU->usuario.'</option>';
                                      
                                //    }
                                // }
                                foreach ($usuariossencillos as $key => $valU)//
                                {
                                  $selectedU="";
                                  $idusuario=$valU->id;
                                  $id_cont=$value->id_contacto;
                                  $idperfil = $valU->id_perfil;
                                  if($idperfil==4 || $idperfil==5){
                                    if($id_cont==$idusuario){$selectedU='Selected';}
                                      
                                      if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') {
                                        echo'<option value="'.$valU->id.'"'.$selectedU.'>'.utf8_decode($valU->nombre_usuario).'</option>';
                                          }
                                          else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
                                              $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                              foreach ($empleadosData as $key => $valE)
                                                  {
                                                      $nombre=$valE->nombre;
                                                          // echo utf8_encode($nombre);
                                                          echo'<option value="'.$valU->id.'"'.$selectedU.'>'.utf8_decode($nombre).'</option>';
                                                  }
                                          }
                                      }
                                  

                                  }
                               
                              
                            echo '</select></div>
                        </div>
                        <div class="form-group col-md-6">
                        <span>Moneda</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                            <input type="text" class="form-control input-lg" value="'.$value->moneda.'" name="txtmoneda" id="txtmoneda" placeholder="Moneda" maxlength="3" required>
                            </div>
                        </div>
                      </div>
                      <div class="row col-md-12">
                        <div class="form-group col-md-6">
                        <span>Código Planta</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                            <!--input type="text" class="form-control input-lg" value="'.$value->cod_planta.'" name="txtcodplanta" id="txtcodplanta" placeholder="cod planta" maxlength="4" required-->
                            <select class="form-control chosen-selec input-lg" name="txtcodplanta" id="txtcodplanta">';
                            foreach ($divisiones as $key => $valD)
                            {
                              
                              $selectedP="";
                              $coddivision=$valD->cod_division;
                              $codplanta=$value->cod_planta;
                              if($coddivision==$codplanta){$selectedP = 'Selected';}

                              echo'<option value="'.$valD->cod_division.'"'  .$selectedP. '>'.$valD->cod_division. ' - ' .utf8_encode($valD->division).'</option>';
                            }
                            echo '</select>
                          </div>
                        </div>
                        <div class="form-group col-md-6 d-none">
                        <span>Estatus</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                </div>
                                <select class="form-control" name="cboestatus">';
                                  
                                $selec1='';
                                $selec2='';
                                $est = $value->estatus;
                            
                                if($est=='A'){
                                   $selec1 = "selected"; 
                                  } 
                                  else if($est=='I'){
                                     $selec2 ="selected"; 
                                    }

                                echo '<option value="A" ' .$selec1. '>Activo</option>';
                                echo '<option value="I" ' .$selec2. '>Inactivo</option>';
                          echo '</select>
                            </div>
                        </div>
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
                  <h4 class="modal-title">Agregar Abogado</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <div class="box-body">

                  <div class="row col-md-12">
                    <div class="form-group col-md-6">
                    <span>Número Proveedor</span>
                      <div class="input-group">
                        <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="" id="numproveedor" placeholder="Num Abogado" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    <span>Abogado</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                          </div>
                        <input type="text" class="form-control input-lg" name="" id="proveedor" placeholder="Abogado" maxlength="75" maxlength="75" required>
                      </div>
                    </div>
                  </div>

                  <div class="row  col-md-12">
                    <div class="form-group col-md-6">
                    <span>RFC</span>
                      <div class="input-group">
                        <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            </div>
                          <input type="text" class="form-control input-lg" name="" id="rfc" placeholder="RFC" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    <span>Correo @</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          </div>
                        <input type="text" class="form-control input-lg" name="" id="correo" placeholder="Correo" maxlength="75" required>
                      </div>
                    </div>
                  </div>

                  <div class="row col-md-12">
                    <div class="form-group col-md-6">
                    <span>Contacto</span>
                      <div class="input-group">
                        <div class="input-group-text">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                          <!-- <input type="text" class="form-control input-lg" name="" id="contacto" placeholder="Contacto" maxlength="75" required> -->
                          <select class="form-control input-lg chosen-selet" name="contacto" id="contacto">
                            <option value="">--Seleccione Contacto--</option>
                            <?php
                            // foreach ($usuariossencillos as $key => $valU)
                            // {
                            //   $idperfil = $valU->id_perfil;
                            //   $nombre_usuario=$valU->nombre_usuario;
                            //    if($idperfil==4 || $idperfil==5){
                                  
                            //          echo'<option value="'.$valU->id.'"> - '.$valU->nombre_usuario.'</option>';
                                  
                            //    }
                            // }
                            foreach ($usuariossencillos as $key => $valU)//
                            {
                              $idusuario=$valU->id;
                              $id_usuario=$value->idu;
                              $idperfil = $valU->id_perfil;
                              if($idperfil==4 || $idperfil==5){
                                if ( $valU->nombre_usuario != null || $valU->nombre_usuario!='') {
                                  echo'<option value="'.$valU->id.'">'.utf8_decode($valU->nombre_usuario).'</option>';
                                    }
                                    else if ($valU->nombre_usuario == null || $valU->nombre_usuario == ''){
                                        $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
                                        foreach ($empleadosData as $key => $valE)
                                            {
                                                $nombre=$valE->nombre;
                                                    // echo utf8_encode($nombre);
                                                    echo'<option value="'.$valU->id.'">'.utf8_decode($nombre).'</option>';
                                            }
                                    }
                              }
                            }
                            ?>  
                          </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    <span>Moneda</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                          </div>
                        <input type="text" class="form-control input-lg" name="" id="moneda" placeholder="Moneda" maxlength="3" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <span>Código Planta</span>
                      <div class="input-group">
                          <div class="input-group-text">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                          </div>
                        <!-- <input type="text" class="form-control input-lg" name="" id="codplanta" placeholder="cod planta" maxlength="4" required> -->
                        <select class="form-control chosen-select input-lg" name="codplanta" id="codplanta">
                        <option value="">--Seleccione Cod Planta--</option>
                        <?php
                            foreach ($divisiones as $key => $valD)
                            { 
                              echo'<option value="'.$valD->cod_division.'">'.$valD->cod_division. ' - ' .utf8_encode($valD->division).'</option>';
                            }
                        ?>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarProveedor" >Guardar Cambios</button>
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
  //////////////////////para el chosenselect
  $('.chosen-select').chosen({//para funcionamiento de chosen select
          // allow_single_deselect: true,
          no_results_text: "No se han encontrado datos con:",
          width: '90%',
          heigth: '100%'
  });

    $(".agregarProveedor").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base] 
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion="agregarProveedores";
        var numproveedor = $("#numproveedor").val();
        var proveedor    = $("#proveedor").val();
        var rfc          = $("#rfc").val();
        var correo       = $("#correo").val();
        var contacto     = $("#contacto").val();
        var moneda       = $("#moneda").val();
        var codplanta    = $("#codplanta").val();
      
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("numproveedor", numproveedor);
        datos.append("proveedor", proveedor);
        datos.append("rfc", rfc);
        datos.append("correo", correo);
        datos.append("contacto", contacto);
        datos.append("moneda", moneda);
        datos.append("codplanta", codplanta);
        
        $.ajax({
            url:"ajax/proveedores.ajax.php",
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
                          window.location = 'proveedores';
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
                              window.location = 'proveedores';
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
        var funcion="editarProveedores";
        var numproveedor = datos[0];
        var proveedor    = datos[1];
        var rfc          = datos[2];
        var correo       = datos[3];
        var contacto     = datos[4];
        var moneda       = datos[5];
        var codplanta    = datos[6];
        var estatus      = datos[7];


        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("numproveedor", numproveedor);
        dataForm.append("proveedor", proveedor);
        dataForm.append("rfc", rfc);
        dataForm.append("correo", correo);
        dataForm.append("contacto", contacto);
        dataForm.append("moneda", moneda);
        dataForm.append("codplanta", codplanta);
        dataForm.append("estatus", estatus);
        dataForm.append("id", id);

        $.ajax({
            url:"ajax/proveedores.ajax.php",
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
                            window.location = 'proveedores';
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
                            window.location = 'proveedores';
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

    $(".btnEliminarUsuario").click(function()
     {

         var id = $(this).attr("idSindicato");
         var dataForm = new FormData();
         var funcion="eliminarSindicatos";
         dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
         dataForm.append("id", id);//PARA MANDARLO A LA VARIABLE datos

         Swal.fire({
             title: '¡Estas seguro que deseas eliminar el Sindicato?',
             text: "Si no es asi puedes presionar el boton cancelar",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Borrar Sindicato'
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
                                     window.location = 'sindicatos';
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
                                     window.location = 'sindicatos';
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

 


 </script>
 
<?php

//  ?>