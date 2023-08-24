<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Subir Plantilla</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Subir Plantilla</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="car-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form method="post" name="forma" enctype="multipart/form-data">
                            <br><br>
                            <div class="form-group">
                                <span>Año</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="anioExcel" id="anioExcel">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <span>Archivo</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                    </div>
                                    <input class="form-control input-lg" type="file" name="archivoExcel" id="archivoExcel">
                                </div>
                            </div>


                            <div class="form-group">
                                <span>Agregar Divisiones</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-user-check"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="division" id="division"  >
                                       <?php

                                        $divisiones=ControladorDivisiones::ctrMostrarDivisiones();

                                        foreach ($divisiones as $key => $div)
                                        {

                                        echo ' <option  value="'.$div->cod_division.'">'.utf8_encode($div->division).'</option>';
 
                                        }
                                        ?>
                                        </select><br>

                                </div>
                            </div>
                            <!-- ./ form-gruop-->

                            <button type="submit" class="btn btn-primary">Subir</button>
                            <?php
                            $subirExcel = new ControladorExcel();
                            $subirExcel -> ctrSubirPlantilla();

                            ?>

                        </form>
                    </div>
                    <div class="col-md-2"></div>

                </div>                            <br><br>

            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--<script>-->
<!--$(document).ready (function ()-->
<!--{-->
<!--    $(".agregarExcelPagos").click(function()-->
<!--    {-->
<!--        alert('click');-->
<!--        var datos = new FormData();-->
<!--            var funcion         ="agregarExcelPagos;-->
<!--            var anioExcel       = $("#anioExcel").val();-->
<!--            var archivoExcel         =  $("#archivoExcel")[0].files[0];-->
<!--            //var jsonPeticiones = $("#jsonPeticiones").val();-->
<!---->
<!---->
<!--            // var jsonAcuerdos = $("#jsonAcuerdos").val();-->
<!--            // var file            = $("#file").val();-->
<!---->
<!--            datos.append("funcion", funcion);-->
<!--            datos.append("anioExcel", anioExcel);//PARA MANDARLO A LA VARIABLE datos-->
<!--            datos.append("archivoExcel", archivoExcel);-->
<!---->
<!--            $.ajax({-->
<!--                url:"ajax/excel.ajax.php",-->
<!--                method: "POST",-->
<!--                data: datos,-->
<!--                async: true,-->
<!--                cache: false,-->
<!--                contentType: false,-->
<!--                processData: false,-->
<!--                dataType: "json",-->
<!--                success: function(respuesta)-->
<!--                {-->
<!--                    if (respuesta=="ok")-->
<!--                    {-->
<!--                        Swal.fire({-->
<!--                            title: 'Success!',-->
<!--                            text: '¡Pliego guardado!',-->
<!--                            icon: 'success',-->
<!--                            confirmButtonText:'Ok'-->
<!--                        }).then((result)=>{-->
<!--                            if(result.value){-->
<!--                                window.location = 'pliegos';-->
<!--                            }-->
<!--                        });-->
<!--                    }else-->
<!--                    {-->
<!--                        Swal.fire({-->
<!--                            title: 'Warning!',-->
<!--                            text: '¡Pliego guardado!',-->
<!--                            icon: 'warning',-->
<!--                            confirmButtonText:'Ok'-->
<!--                        }).then((result)=>{-->
<!--                            if(result.value){-->
<!--                                window.location = 'pliegos';-->
<!--                            }-->
<!--                        });-->
<!--                    }-->
<!---->
<!---->
<!--                },-->
<!--                error : function(respuesta)-->
<!--                {-->
<!--                    Swal.fire({-->
<!--                        title: 'Error!',-->
<!--                        text: '¡error al guardar!',-->
<!--                        icon: 'error',-->
<!--                        confirmButtonText:'Ok'-->
<!--                    });-->
<!--                }-->
<!---->
<!--            }).done(function ()-->
<!--            {-->
<!--                $('.succes').show();-->
<!--            });-->
<!---->
<!---->
<!--    });-->
<!--});-->
<!---->
<!--</script>-->