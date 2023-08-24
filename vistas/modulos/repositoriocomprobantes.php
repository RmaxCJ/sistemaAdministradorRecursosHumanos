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
                        <li class="breadcrumb-item active">Repositorio de Comprobantes</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarComprobante">Subir Comprobante</button>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1>Comprobantes Subidos</h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="10%">Pliego</th>
                                <th scope="col" width="25%">Sindicato</th>
                                <th scope="col" width="15%">Creador</th>
                                <th scope="col" width="15%">Fecha Alta</th>
                                <th scope="col" width="15%">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
                            //   echo "aqui<br>";
                            $pliegos = ControladorPliegos::ctrMostrarPliegos();
                            //                      echo "<pre>";
                            //                      print_r($pliegos);
                            //                      echo "</pre>";
                            //          echo count($usuarios);
                            foreach ($pliegos as $key => $value)
                            {
//              echo "<br>";
//              print_r($value->id);
                                echo'<tr>
          <td>'.$value->IDPliego.'</td>
          <td>'.$value->sindicato.'</td>
          <td>'.$value->usuario.'</td>
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










<?php
$sindicatos = ControladorSindicatos::ctrMostrarSindicatos();

?>



<!--            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Modal -->
<div class="modal fade" id="modalAgregarComprobante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #002554; color: white;">
                <h5 class="modal-title" id="exampleModalLabel">Subir Comprobante</h5>
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
                                    Pliegos Petitorios
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
                                        <select class="form-control input-lg" name="proveedor" id="proveedor" required>
                                            <option value="">Seleccionar Proveedor</option>
                                            <?php
                                            $proveedor = ControladorProveedores::ctrMostrarProveedores();

                                            foreach ($proveedor as $key => $valS)
                                            {
                                                $id = $valS->id_perfil;

                                                echo'<option value="'.$valS->id.'">'.$valS->num_proveedor.' - '.$valS->proveedor.'</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                        <textarea class="form-control input-lg" type="text" name="txtTema" id="txtTema"  maxlength="150" placeholder="Orden de Compra" required></textarea>
                                        </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                        <input type="text" class="form-control input-md" placeholder="Concepto" name="concepto" id="concepto">

                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                        </div>
                                        <input type="month" class="form-control input-md" name="fechaPedido" id="fechaPedido">
                                    </div>
                                </div><!-- ./ form-gruop-->
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
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
                                    Archivos Pliegos Petitorios
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
<script>
//
//    $(".numberinput").on(
//        {
//        "focus": function (event) {
//            $(event.target).select();
//        },
//        "keyup": function (event) {
//            $(event.target).val(function (index, value ) {
//                return value.replace(/\D/g, "")
//                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
//                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
//            });
//        }
//    });


    $('#file').change(function(event) {
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

    $(".collapseOrden").hover(function(){
        habiltardes();
    });

    $(".collapseArchivos").hover(function(){
        habiltardes();
    });
    $(".agregarOrden").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarOrden";
        var proveedor       = $("#proveedor").val();
        var txtTema            = $("#txtTema").val();
        var Concepto            = $("#Concepto").val();
        var fechaPedido            = $("#fechaPedido").val();
        var monto            = $("#monto").val();




        var idUser            = $("#idUser").val();
        var file         =  $("#file")[0].files[0];
        //var jsonPeticiones = $("#jsonPeticiones").val();


        // var jsonAcuerdos = $("#jsonAcuerdos").val();
        // var file            = $("#file").val();

        datos.append("file", file);
        datos.append("proveedor", proveedor);//PARA MANDARLO A LA VARIABLE datos
        datos.append("txtTema", txtTema);
        datos.append("idUser", idUser);
        datos.append("Concepto", Concepto);
        datos.append("fechaPedido", fechaPedido);
        datos.append("monto", monto);
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
        if(sindicato!='' && txtTema!='' && file!='' && sizeval >  5000){
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
