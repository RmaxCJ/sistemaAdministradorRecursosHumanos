<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Información Laboral</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Información Laboral</li>
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
                        <!-- <form method="post" name="" enctype="multipart/form-data"> -->
                            <br><br>
                        <div class="form-group">
                            <span>Mes</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                </div>
                                <select class="form-control input-lg" name="mes" id="mes">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                <span>Año</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="anio" id="anio">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>

                            <input class="d-none" type="text" id="id_usuario" value="<?php echo $_SESSION['id'];?>">   
                            <div class="form-group">
                                <span>Archivo</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-calendar-day"></i></span>
                                    </div>
                                    <input type="file" class="form-control input-lg fil" size='8000' name="file" id="file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xlsx">
                                </div>
                                <div class="alert alert-danger align-center" id="tipoarchivo" style="display: none;"><strong>Alert!</strong> El tipo de archivo es invalido (solo PDF, png, jpg, jpeg, pdf, doc, docx, xlsx ).</div>
                                <div class="alert alert-danger align-center" id="tamañoarchivo" style="display: none;"><strong>Alert!</strong> El tamaño del archivo es demaciado grande (Maximo 10 MB).</div>
                        
                            </div>


                            <div class="form-group">
                                <span>País</span>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    </div>
                                    <select class="form-control input-lg" name="pais" id="pais"  >
                                       <?php
                                    if($_SESSION['id_perfil']==1){
                                        $paisvacio='';
                                        $divisiones=ControladorDivisiones::ctrMostrarDivisionesSoloPais($paisvacio);
                                    }else if($_SESSION['id_perfil']==2){
                                        $divisiones=ControladorDivisiones::ctrMostrarDivisionesSoloPais($_SESSION['pais']);
                                    }
                                        foreach ($divisiones as $key => $div)
                                        {

                                        echo ' <option  value="'.$div->pais.'">'.utf8_encode($div->pais).'</option>';
 
                                        }
                                        ?>
                                        </select><br>

                                </div>
                            </div>
                            <!-- ./ form-gruop-->

                            <button type="submit" class="btn btn-primary agregararchivo">Subir</button>
                        <!-- </form> -->
                    </div>
                    <div class="col-md-2"></div>

                </div>                            <br><br>

            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

    $('#file').change(function(event) {
        var archivo = $("#file").val();//obtener el id del archivo
        var extensiones = archivo.substring(archivo.lastIndexOf("."));// SE TOMA LA EXTENCIÓN DEL ARCHIVO
        var fileSize = $('#file')[0].files[0].size;//se toma el tamaño real del archivo
        // var fileSize = 5000;//se toma el tamaño real del archivo
        var siezekiloByte = parseInt(fileSize / 1024);//se parsea
        // $("#size").val(siezekiloByte);
        if (siezekiloByte >  $('#file').attr('size')) {//if de tamaño
            $("#tamañoarchivo").show();//mostrar archivo demaciado grande
            $( ".agregararchivo" ).prop( "disabled", true );
        }else{
                $("#tamañoarchivo").hide();//
                $( ".agregararchivo" ).prop( "disabled", false );
        }
        if(extensiones != ".png" && extensiones != ".jpg" && extensiones != ".jpeg" && extensiones != ".pdf" && extensiones != ".PDF" && extensiones != ".doc" && extensiones != ".docx" && extensiones != ".xlsx" )
            {
                // alert("El archivo de tipo " + extensiones + " no es válido");
                $("#tipoarchivo").show();
                $( ".agregararchivo" ).prop( "disabled", true );
            }else{
                $("#tipoarchivo").hide();  
                $( ".agregararchivo" ).prop( "disabled", false );           
            }
           
    });   

    $(".agregararchivo").click(function()
    {  
        var datos = new FormData();
        var funcion      = "agregarinformacion";
        var id_usuario   = $("#id_usuario").val();
        var mes         = $("#mes").val();
        var anio         = $("#anio").val();
        var file         = $("#file")[0].files[0];
        var pais         = $("#pais").val();
        

        if(anio!='' && file!=undefined && pais!='' ){

            datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
            datos.append("id_usuario", id_usuario);
            datos.append("anio", anio);
            datos.append("mes", mes);
            datos.append("file", file);
            datos.append("pais", pais);

            $.ajax({
                url:"ajax/informacionlaboral.ajax.php",
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
                            window.location = 'informacionlaboral';
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
                                window.location = 'informacionlaboral';
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
        }else{
            Swal.fire({ 
            title: 'Error!',
            text: '¡Llenar Información!',
            icon: 'error',
            confirmButtonText:'Ok'
            });
        }
    });

</script>

