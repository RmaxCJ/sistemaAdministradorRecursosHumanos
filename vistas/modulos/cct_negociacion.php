<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
//echo $fecha=$_GET['fecha'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Contratos Colestivos de Trabajo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="cct_negociacion">Contratos Colestivos de Trabajo</a></li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalSubirCCT">Subir CCT</button>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body">
                        <h1>Contratos Colectivos de Trabajo</h1>
                        <table class="table table-striped tabladatatable dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <th scope="col" width="25%">Año</th>
                                <th scope="col" width="25%">Nombre</th>
                                <th scope="col" width="25%">Fecha Alta</th>
                                <th scope="col" width="25%">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $ccts= ControladorCCT::ctrMostrarCCT();
                            //                            echo "<pre>";
                            //                            print_r($ccts);
                            //                            echo "</pre>";
                            foreach ($ccts as $key => $value)
                            {
//                                echo "<pre>";
//                            print_r($value->anio);
//                            echo "</pre>";
                                echo'<tr>
                              <td>'.$value->anio.'</td>
                              <td>'.$value->nombre.'</td>
                              <td>'.$value->fecha_alta.'</td>
                              <td>
                                <div class="btn-group">';

//                                echo '<button class="btn btn-danger descargarPDF" id="'.$value->id.'" alt="PDF"><i class="fas fa-download"></i></button>';
                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/cct/'.$value->anio.'/'.$value->archivo.'"><i class="fa fa-download"></i></a>';
//
//                                echo'<a class="btn btn-primary" download href="/relaciones/vistas/archivos/ordenes/'.$value->archivo.'"><i class="fa fa-download"></i></a>';


                                echo '</div></td>

                    </tr>';


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
        <div class="modal fade" id="modalSubirCCT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #002554; color: white;">
                        <h5 class="modal-title" id="exampleModalLabel">Subir CCT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header collapseCCT" id="headingOne" style="background-color: #002554 !important; ">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapseCCT" data-toggle="collapse" data-target="#collapseCCT" aria-expanded="true" aria-controls="collapseCCT" style="color: white !important;">
                                            Datos
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseCCT" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">



                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>
                                                </div>
                                                <input type="number" class="form-control input-md " name="año" id="año" min="2000" max="2030">
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

                                                    <input type="file" class="form-control input-lg " name="fileCCT" id="fileCCT" multiple="multiple" size="5000" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx">
                                                    <!--                                                    <input type="text" class="d-none" id="size">-->
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
                            <button type="button" class="btn btn-primary agregarCCT" title="Para habilitar llenar todos los campos de Minutas">Guardar</button>
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


    $('#file').change(function(event)
    {
        var archivo = $("#fileCCT").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        //var fileSize = $('#fileCCT')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        //var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        //$("#size").val(siezekiloByte);
        //if (siezekiloByte >  $('#fileCCT').attr('size')) {//if de tamaño
        //     $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        //     $( ".agregarCCT" ).prop( "disabled", true );
        // }else{
        //     $("#tamañoarchivo").hide();//
        // }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarCCT" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
        }

    });

    $( ".agregarCCT" ).prop( "disabled", true );

    $(".collapseCCT").hover(function(){
        habiltardes();
    });

    $(".collapseArchivos").hover(function(){
        habiltardes();
    });
    $(".agregarCCT").click(function()
    {   //Vista->Ajax[Direccionamiento]->Controlador[proceso de datos]->Modelo[Consulta a base]
        //var idUsuario = $(this).attr("idUsuario");
        // alert('hola');
        var datos = new FormData();
        var funcion         ="agregarCCT";
        var año       = $("#año").val();
        var idUser            = $("#idUser").val();
        var file         =  document.getElementById("fileCCT");
        var archivos= file.files;

        if (archivos.length>200)
        {
            Swal.fire({
                title: 'Warning!',
                text: '¡No puede subir mas de 200 archivos!',
                icon: 'error',
                confirmButtonText:'Ok'
            });
        }else
        {
            for (i=0;i<archivos.length;i++)
            {
                datos.append('archivo'+i,archivos[i]);
            }


            datos.append("funcion", funcion);
            datos.append("año", año);
            datos.append("idUser", idUser);

            //datos.append("funcion", jsonPeticiones);


            $.ajax({
                url:"ajax/cct.ajax.php",
                method: "POST",
                data: datos,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta)
                {
                    if (respuesta=="finalizado")
                    {
                        Swal.fire({
                            title: 'Success!',
                            text: '¡CCT guardado!',
                            icon: 'success',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'cct';
                            }
                        });
                    }else
                    {
                        Swal.fire({
                            title: 'Warning!',
                            text: '¡CCT guardado!',
                            icon: 'warning',
                            confirmButtonText:'Ok'
                        }).then((result)=>{
                            if(result.value){
                                window.location = 'cct';
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
        var fileCCT    = $( "#fileCCT" ).val();
        var año      = $( "#año" ).val();


        // var sizeval = $("#size").val();//tamaño del archivo
        if(año!='' && fileCCT!='')
        {
            $( ".agregarCCT" ).prop( "disabled", false );
        }else{
            $( ".agregarCCT" ).prop( "disabled", true );
        }
        var extensiones = fileCCT.substring(fileCCT.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO

        // if (sizeval >  5000) {//if de tamaño
        //     $("#tamañoarchivo").show();//mostrar archivo demaciado grande
        // }else{
        //     $("#tamañoarchivo").hide();//
        // }
        if(extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".png" && extensiones != ".pdf" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx")
        {
            // alert("El archivo de tipo " + extensiones + " no es válido");
            $("#tipoarchivo").show();
            $( ".agregarCCT" ).prop( "disabled", true );
        }else{
            $("#tipoarchivo").hide();
            $( ".agregarCCT" ).prop( "disabled", false );
        }
    };




</script>
