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
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Repositorio de Ordenes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="pagos">Pagos</a></li>
                        <li class="breadcrumb-item active">Repositorio de Ordenes de compra</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarOrdenes">Subir Orden</button>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1>Ordenes de compra subidas</h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="14%">Orden</th>
                                <th scope="col" width="14%">Proveedor</th>
                                <th scope="col" width="14%">RFC</th>
                                <th scope="col" width="14%">Concepto</th>
                                <th scope="col" width="14%">Pedido por</th>
                                <th scope="col" width="14%">Fecha Alta</th>
                                <th scope="col" width="15%">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
                            //   echo "aqui<br>";
                            $ordenes = ControladorOrdenes::ctrMostrarOrdenes();
                                                  echo "<pre>";
                                                  print_r($ordenes);
                                                  echo "</pre>";
                            //          echo count($usuarios);
                            foreach ($ordenes as $key => $value)
                            {
//              echo "<br>";
//              print_r($value->id);
                                echo'<tr>
                              <td>'.$value->orden_compra.'</td>
                              <td>'.$value->proveedor.'</td>
                              <td>'.$value->rfc.'</td>
                              <td>'.$value->concepto.'</td>
                              <td>'.$value->usuario.'</td>
                              <td>'.$value->fecha_alta.'</td>
                              <td>
                                <div class="btn-group">';

//                      <button class="btn btn-warning btn-xs btnEditarUsuario"  data-toggle="modal" data-target="#modalEditarPliego_'.$value->IDPliego.'"><i class="fas fa-pencil-alt"></i></button>
//
//                      <button class="btn btn-danger btn-xs btnEliminarPliego" idPliego="'.$value->IDPliego.'" ><i class="fa fa-times"></i></button>

                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>

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
                          <option value="3">Sindicato</option>';
                                }
                                elseif ($value->id_perfil==2)
                                {

                                    echo '
                          <option  value="1" >Administrador</option>
                          <option value="2" selected>Gerente CH</option>
                          <option value="3">Sindicato</option>';
                                }
                                elseif ($value->id_perfil==3)
                                {

                                    echo '
                          <option  value="1" >Administrador</option>
                          <option value="2" >Gerente CH</option>
                          <option value="3" selected>Sindicato</option>';

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


<!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Modal -->
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
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        </div>
                                        <select class="form-control input-lg" name="pago" id="pago" required>
                                            <option value="">Seleccionar Pago</option>
                                            <?php
                                            $pagos = ControladorPagos::ctrMostrarPagos();

                                            foreach ($pagos as $key => $valS)
                                            {
                                                $id = $valS->id_perfil;

                                                echo'<option value="'.$valS->IDPAGO.'">'.$valS->concepto.' - '.$valS->proveedor.'</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control input-lg" type="text" name="txtTema" id="txtTema"  maxlength="10" placeholder="Orden de Compra" required>
                                        </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-md" placeholder="Concepto" name="concepto" id="concepto">

                                    </div>
                                </div><!-- ./ form-gruop-->
<!--                                <div class="form-group">-->
<!--                                    <div class="input-group">-->
<!--                                        <div class="input-group-text">-->
<!--                                            <span class="input-group-addon"><i class="fa fa-clock"></i></span>-->
<!--                                        </div>-->
<!--                                        <input type="month" class="form-control input-md" name="fechaPedido" id="fechaPedido">-->
<!--                                    </div>-->
<!--                                </div><!-- ./ form-gruop-->-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                        </div>
                                        <input type="number" class="form-control input-md numberinput" name="monto" id="monto" min="0.00" max="1000000.00" step="0.01">
                                    </div>
                                </div>
                                <!-- ./ form-gruop-->

                            </div>
                        </div>
                    </div>




                    <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">


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

                                            <input type="file" class="form-control input-lg " name="file" id="file" size="5000" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx">
                                            <input type="text" class="d-none" id="size">
                                        </div>
                                    </div>   <!-- ./ form-gruop-->
                                    <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido.</div>
                                    <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 5 MB).</div>
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


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- script ordenes++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>

    $('#file').change(function(event)
    {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarOrden" ).prop( "disabled", true );
        }else{
            $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarOrden" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
        }

    });

    $( ".agregarOrden" ).prop( "disabled", true );

    $(".collapseOrden").hover(function()
    {
        habiltardes();
    });

    $(".collapseArchivos").hover(function()
    {
        habiltardes();
    });
    $(".agregarOrden").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarOrden";
        var pago       = $("#pago").val();
        var txtTema            = $("#txtTema").val();
        var Concepto            = $("#concepto").val();
        // var fechaPedido            = $("#fechaPedido").val();
        var monto            = $("#monto").val();
        var idUser            = $("#idUser").val();
        var file         =  $("#file")[0].files[0];
        //var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#file").val();

        datos.append("file", file);
        datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
        datos.append("txtTema", txtTema);
        datos.append("idUser", idUser);
        datos.append("Concepto", Concepto);
        // datos.append("fechaPedido", fechaPedido);
        datos.append("monto", monto);
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
                            window.location = 'ordenescompra';
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
                            window.location = 'ordenescompra';
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
        var pago      = $( "#pago" ).val();
        var txtTema      = $( "#txtTema" ).val();
        var Concepto      = $( "#Concepto" ).val();
        // var fechaPedido      = $( "#fechaPedido" ).val();
        var monto      = $( "#monto" ).val();


        var sizeval = $("#size").val();//tamaño del archivo
        if(txtTema!='' && pago!=''&& Concepto!=''&& monto!='' && file!='' && sizeval >  5000){
            $( ".agregarOrden" ).prop( "disabled", false );
        }else{
            $( ".agregarOrden" ).prop( "disabled", true );
        }
        var extensiones = file.substring(file.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO

        if (sizeval >  5000) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        }else{
            $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarOrden" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
            $( ".agregarOrden" ).prop( "disabled", false );
        }
    };




</script>
