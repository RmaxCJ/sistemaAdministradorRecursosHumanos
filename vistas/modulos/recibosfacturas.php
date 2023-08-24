<?php
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
echo $fecha=$_GET['fecha'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Repositorio de Recibos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="pagos">Pagos</a></li>
                        <li class="breadcrumb-item active">Recibos/Facturas </li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRecibos">Subir Recibo/Factura</button>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1>Recibos subidos</h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="14%">ID</th>
                                <th scope="col" width="14%">Estatus</th>
                                <th scope="col" width="14%">Proveedor</th>
                                <th scope="col" width="14%">RFC</th>
                                <th scope="col" width="14%">Concepto</th>
                                <th scope="col" width="14%">Fecha programada</th>
                                <th scope="col" width="14%">Fecha Alta</th>
                                <th scope="col" width="15%">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                           $recibos= ControladorRecibos::ctrMostrarRecibos();
                                                        //$recibos = ModeloRecibos::ctrMostrarRecibos();
//                            echo "<pre>";
//                            print_r($recibos);
//                            echo "</pre>";
//                                                                  echo count($usuarios);
                            foreach ($recibos as $key => $value)
                            {
//              echo "<br>";
//              print_r($value->id);
                                echo'<tr>
                              <td>'.$value->id.'</td>
                              <td>'.$value->estatus.'</td>
                              <td>'.$value->proveedor.'</td>
                              <td>'.$value->rfc.'</td>
                              <td>'.$value->concepto.'</td>
                              <td>'.$value->fecha_programada_pago.'</td>
                              <td>'.$value->fecha_alta.'</td>
                              <td>
                                <div class="btn-group">';

                      echo '<button class="btn btn-danger descargarPDF" id="'.$value->id_archivo_pdf.'" alt="PDF"><i class="fas fa-download"></i></button>';

                      if (isset($value->id_archivo_xml))
                      {
                          echo '<button class="btn btn-success descargarXML" id="'.$value->id_archivo_xml.'" alt="XML"><i class="fas fa-download"></i></button>';

                      }


//                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>';
//
//                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>';


                        echo '</div></td>
            
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
        <div class="modal fade" id="modalAgregarRecibos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Subir Recibo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapseRecibo" id="headingOne" style="background-color: #002554 !important; ">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapseRecibo" data-toggle="collapse" data-target="#collapseRecibo" aria-expanded="true" aria-controls="collapseRecibo" style="color: white !important;">
                                            Recibos
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseRecibo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-pen-square"></i></span>
                                                </div>
                                                <input type="text" class="form-control input-md" placeholder="Concepto" name="conceptoRecibos" id="conceptoRecibos">

                                            </div>
                                        </div><!-- ./ form-gruop-->

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                </div>
                                                <input type="number" class="form-control input-md numberinput" name="montoRecibo" id="montoRecibo" min="0.00" max="1000000.00" step="0.01">
                                            </div>
                                        </div>
                                        <!-- ./ form-gruop-->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                                </div>
                                                <textarea class="form-control input-lg" type="text" name="comentarioRecibo" id="comentarioRecibo"  maxlength="500" placeholder="Comentario" required></textarea>
                                            </div>
                                        </div><!-- ./ form-gruop-->
                                    </div>
                                </div>
                            </div>




                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'];?>">
                            <input type="hidden" name="IdPagoinputRecibo" id="IdPagoinputRecibo">


                            <div class="card">
                                <div class="card-header collapseArchivos" id="headingArchivos" style="background-color: #002554 !important; color: white !important;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed collapseArchivos" data-toggle="collapse" data-target="#collapseArchivos" aria-expanded="false" aria-controls="collapseArchivos" style="color: white !important;">
                                            Archivos Recibos
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

                                                    <input type="file" class="form-control input-lg " name="filerecibo" id="filerecibo" multiple="multiple" size="5000" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx">
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
                            <button type="button" class="btn btn-primary agregarRecibo" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
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
    $(".modalRecibos").click(function()
    {
        var IdPago = $(this).attr("IdPago");
        $("#modalAgregarRecibos").modal("show");
        $("#IdPagoinputRecibo").val(IdPago);
    });

    $('#file').change(function(event) {
        var archivo = $("#fileRecibo").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
        }

    });

    $( ".agregarRecibo" ).prop( "disabled", true );

    $(".collapseRecibo").hover(function(){
        habiltardes();
    });

    $(".collapseArchivos").hover(function(){
        habiltardes();
    });
    $(".agregarRecibo").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarRecibo";
        var pago       = $("#pago").val();
        var comentarioRecibo            = $("#comentarioRecibo").val();
        var Concepto            = $("#conceptoRecibos").val();
        var montoRecibo            = $("#montoRecibo").val();
        var idUser            = $("#idUser").val();
        //var file         =  $("#fileRecibo")[0].files[0];
        var file         =  document.getElementById("file");
        var archivos= file.files;

        if (archivos.length>2)
        {
            Swal.fire({
                title: 'Warning!',
                text: '¡No puede subir mas de 2 archivos!',
                icon: 'error',
                confirmButtonText:'Ok'
            });
        }else
        {
            for (i=0;i<archivos.length;i++)
            {
                datos.append('archivo'+i,archivos[i]);
            }


            datos.append("pago", pago);//PARA MANDARLO A LA VARIABLE datos
            datos.append("comentarioRecibo", comentarioRecibo);
            datos.append("idUser", idUser);
            datos.append("Concepto", Concepto);
            datos.append("montoRecibo", montoRecibo);
            datos.append("funcion", funcion);
            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/recibos.ajax.php",
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
                            text: '¡Recibo guardada!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'recibosfacturas';
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡Recibo guardada!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'recibosfacturas';
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

        }


    });


    function habiltardes()
    {//para habilitar llenar los campos
        var filerecibo    = $( "#fileRecibo" ).val();
        var pago      = $( "#pago" ).val();
        var comentarioRecibo      = $( "#comentarioRecibo" ).val();
        var Concepto      = $( "#Concepto" ).val();
        var montoRecibo      = $( "#montoRecibo" ).val();


        var sizeval = $("#size").val();//tamaño del archivo
        if(comentarioRecibo!='' && pago!=''&& Concepto!=''&& montoRecibo!='' && filerecibo!='' && sizeval >  5000){
            $( ".agregarRecibo" ).prop( "disabled", false );
        }else{
            $( ".agregarRecibo" ).prop( "disabled", true );
        }
        var extensiones = filerecibo.substring(filerecibo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO

        if (sizeval >  5000) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        }else{
            $("#tamañoarchivo").hide();//
        }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarRecibo" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
            $( ".agregarRecibo" ).prop( "disabled", false );
        }
    };




</script>
