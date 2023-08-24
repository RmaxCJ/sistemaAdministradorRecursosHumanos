
<!-- +++++++++++++++++++++++++++++++++ Revision Multa BD no esta autoincrement -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Conceptos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Conceptos</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <div class="container-fluid">
            <div class="btn-group">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoMedioDefensa">Agregar Defensa</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#modalNuevoEstatus">Agregar Estatus</button>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevaArea">Agregar Area</button>
            <button class="btn btn-dark" data-toggle="modal" data-target="#modalNuevoResultado">Agregar Resultado</button>
            </div>
            <!-- modalNuevoMedioDefensa -->
<div  id="modalNuevoMedioDefensa" name="modalNuevoMedioDefensa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" >
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">Nuevo Medio de Defensa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-body">


                        <div class="form-group">
                            <span>Defensa</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="defensa" id="defensa" placeholder="Medio de defensa" required>
                            </div>
                        </div><!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Descripcion</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                </div>
                                <textarea type="text" class="form-control input-lg" name="descripcionDefensa" id="descripcionDefensa" placeholder="Descripción" required></textarea>
                            </div>
                        </div>   <!-- ./ form-gruop-->

                    </div><!--  ./boxbody -->

                </div><!-- ./modalbody  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarMedioDefensa" >Guardar</button>
                </div>
            </form>
        </div><!-- ./ modal content -->
    </div><!-- ./ modal dialog -->
</div><!-- ./ primer div id modal -->
<!-- fin modalNuevoMedioDefensa-->

<!-- modalNuevoEstatus -->
<div  id="modalNuevoEstatus" name="modalNuevoEstatus" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" >
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">Nuevo Estatus</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-body">


                        <div class="form-group">
                            <span>Estatus</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="estatus" id="estatus" placeholder="Estatus" required>
                            </div>
                        </div><!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Descripcion</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                </div>
                                <textarea type="text" class="form-control input-lg" name="descripcionEstatus" id="descripcionEstatus" placeholder="Descripción" required></textarea>
                            </div>
                        </div>   <!-- ./ form-gruop-->

                    </div><!--  ./boxbody -->

                </div><!-- ./modalbody  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarEstatus" >Guardar</button>
                </div>
            </form>
        </div><!-- ./ modal content -->
    </div><!-- ./ modal dialog -->
</div><!-- ./ primer div id modal -->
<!-- fin modalNuevoEstatus-->


<!-- modalNuevaArea -->
<div  id="modalNuevaArea" name="modalNuevaArea" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" >
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">Nueva Area</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-body">


                        <div class="form-group">
                            <span>Area</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="area" id="area" placeholder="Area" required>
                            </div>
                        </div><!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Descripcion</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                </div>
                                <textarea type="text" class="form-control input-lg" name="descripcionArea" id="descripcionArea" placeholder="Descripción" required></textarea>
                            </div>
                        </div>   <!-- ./ form-gruop-->

                    </div><!--  ./boxbody -->

                </div><!-- ./modalbody  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarArea" >Guardar</button>
                </div>
            </form>
        </div><!-- ./ modal content -->
    </div><!-- ./ modal dialog -->
</div><!-- ./ primer div id modal -->
<!-- fin modalNuevaArea-->

<!-- modalNuevoResultado -->
<div  id="modalNuevoResultado" name="modalNuevoResultado" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data" >
                <div class="modal-header" style="background-color: #002554; color: white;">
                    <h4 class="modal-title">Nuevo Resultado</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box-body">


                        <div class="form-group">
                            <span>Resultado</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pen"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="resultado" id="resultado" placeholder="Resultado" required>
                            </div>
                        </div><!-- ./ form-gruop-->

                        <div class="form-group">
                            <span>Descripcion</span>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                </div>
                                <textarea type="text" class="form-control input-lg" name="descripcionResultado" id="descripcionResultado" placeholder="Descripción" required></textarea>
                            </div>
                        </div>   <!-- ./ form-gruop-->

                    </div><!--  ./boxbody -->

                </div><!-- ./modalbody  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregarResultado" >Guardar</button>
                </div>
            </form>
        </div><!-- ./ modal content -->
    </div><!-- ./ modal dialog -->
</div><!-- ./ primer div id modal -->
<!-- fin modalNuevaArea-->











            <br><br>

            <div class="row">

                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card" style="width: 100%; height: 100%;">
                        <div class="card-body">
                           <button class="btn btn-primary btn-xl"><i class="fas fa-user-shield"></i></button>
                            <br>
                            <h5>Medios de Defensa</h5>
                            <table class="table table-striped tabladatatable  dt-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="9%" scope="col">Medio Defensa</th>
                                    <th width="9%" scope="col">Descripcion</th>
                                    <th width="10%" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $defensas=ControladorConceptos::ctrMostrarDefensas();
                                //                                echo "<pre>";
                                //                                print_r($defensas);
                                //                                echo "</pre>";
                                foreach ($defensas as $key => $valued)
                                {
                                    echo'<tr>
                                              <td>'.utf8_encode($valued->medio_defensa).'</td>
                                              <td>'.utf8_encode($valued->descripcion).'</td>
                                              <td>
                                                 <button class="btn btn-danger btn-xs btnEliminarDefensa" idDefensa="'.$valued->id.'"><i class="fa fa-times"></i></button>

                                              </td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card" style="width: 100%; height: 100%;">
                        <div class="card-body">
                            <button class="btn btn-primary btn-xl"><i class="fas fa-list-alt"></i></button>
                            <br>
                            <h5>Estatus (Revisiones/Multas)
                            </h5>
                            <table class="table table-striped tabladatatable  dt-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="9%" scope="col">Estatus</th>
                                    <th width="9%" scope="col">Descripcion</th>
                                    <th width="10%" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $estatus=ControladorConceptos::ctrMostrarEstatus();
                                //                                echo "<pre>";
                                //                                print_r($estatus);
                                //                                echo "</pre>";
                                foreach ($estatus as $key => $valueE)
                                {
                                    echo'<tr>
                                              <td>'.utf8_encode($valueE->estatus).'</td>
                                              <td>'.utf8_encode($valueE->descripcion).'</td>
                                              <td>
                                                 <button class="btn btn-danger btn-xs btnEliminarEstatus" idEstatus="'.$valueE->id.'"><i class="fa fa-times"></i></button>

                                              </td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card" style="width: 100%; height: 100%;">
                        <div class="card-body">
                            <button class="btn btn-primary btn-xl"><i class="fas fa-clipboard-list"></i></button>
                            <br>
                            <h5>Areas (Revisiones/Multas)
                            </h5>
                            <table class="table table-striped tabladatatable  dt-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="9%" scope="col">Area</th>
                                    <th width="9%" scope="col">Descripcion</th>
                                    <th width="10%" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $areas=ControladorConceptos::ctrMostrarAreas();
                                //                                echo "<pre>";
                                //                                print_r($areas);
                                //                                echo "</pre>";
                                foreach ($areas as $key => $valueA)
                                {
                                    echo'<tr>
                                              <td>'.utf8_encode($valueA->area_revision_multa).'</td>
                                              <td>'.utf8_encode($valueA->descripcion).'</td>
                                              <td>
                                                 <button class="btn btn-danger btn-xs btnEliminarArea" idArea="'.$valueA->id.'"><i class="fa fa-times"></i></button>

                                              </td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card" style="width: 100%; height: 100%;">
                        <div class="card-body">
                            <button class="btn btn-primary btn-xl"><i class="fas fa-list-ol"></i></button>

                            <h5>Resultados (Revisiones/Multas)</h5>
                            <table class="table table-striped tabladatatable  dt-responsive" width="100%">
                                <thead>
                                <tr>
                                    <th width="9%" scope="col">Resultados</th>
                                    <th width="9%" scope="col">Descripcion</th>
                                    <th width="10%" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $resultados=ControladorConceptos::ctrMostrarResultados();
                                //                                echo "<pre>";
                                //                                print_r($resultados);
                                //                                echo "</pre>";
                                foreach ($resultados as $key => $valueR)
                                {
                                    echo'<tr>
                                              <td>'.utf8_encode($valueR->resultado).'</td>
                                              <td>'.utf8_encode($valueR->descripcion).'</td>
                                              <td>
                                                 <button class="btn btn-danger btn-xs btnEliminarResultado" idResultado="'.$valueR->id.'"><i class="fa fa-times"></i></button>

                                              </td>
                                            </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





                </div>

            </div>

        </div><!--/. container-fluid -->
        <form style="display: none" action="listademandas" method="POST" id="formPais">
            <input type="hidden" id="paisSelect" name="paisSelect" value=""/>
        </form>

        <!-- Modal -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

    // agregarResultado
    $(".agregarMedioDefensa").click(function()
    {

        var datos = new FormData();
        var funcion="agregarMedioDefensa";
        var defensa  = $("#defensa").val();
        var descripcionDefensa = $("#descripcionDefensa").val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("defensa", defensa);
        datos.append("descripcionDefensa", descripcionDefensa);
        $.ajax({
            url:"ajax/conceptos.ajax.php",
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

    $(".agregarEstatus").click(function()
    {

        var datos = new FormData();
        var funcion="agregarEstatus";
        var estatus  = $("#estatus").val();
        var descripcionEstatus = $("#descripcionEstatus").val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("estatus", estatus);
        datos.append("descripcionEstatus", descripcionEstatus);
        $.ajax({
            url:"ajax/conceptos.ajax.php",
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

    $(".agregarArea").click(function()
    {

        var datos = new FormData();
        var funcion="agregarArea";
        var area  = $("#area").val();
        var descripcionArea = $("#descripcionArea").val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("area", area);
        datos.append("descripcionArea", descripcionArea);
        $.ajax({
            url:"ajax/conceptos.ajax.php",
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
    $(".agregarResultado").click(function()
    {

        var datos = new FormData();
        var funcion="agregarResultado";
        var resultado  = $("#resultado").val();
        var descripcionResultado = $("#descripcionResultado").val();
        datos.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        datos.append("resultado", resultado);
        datos.append("descripcionResultado", descripcionResultado);
        $.ajax({
            url:"ajax/conceptos.ajax.php",
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
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//     btnEliminarDefensa
//     btnEliminarEstatus
//     btnEliminarArea
//     btnEliminarResultado
    $(".btnEliminarDefensa").click(function()
    {

        var idDefensa = $(this).attr("idDefensa");
        var dataForm = new FormData();
        var funcion="eliminarDefensa";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("idDefensa", idDefensa);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¡Estas seguro que deseas eliminar este Registro?',
            text: "Si no es asi puedes presionar el boton cancelar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar registro'
        }).then((result) => {
            if (result.value) {
                // window.location = "usuarios";

                $.ajax({
                    url:"ajax/conceptos.ajax.php",
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

    $(".btnEliminarEstatus").click(function()
    {

        var idEstatus = $(this).attr("idEstatus");
        var dataForm = new FormData();
        var funcion="eliminarEstatus";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("idEstatus", idEstatus);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¡Estas seguro que deseas eliminar este Registro?',
            text: "Si no es asi puedes presionar el boton cancelar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar registro'
        }).then((result) => {
            if (result.value) {
                // window.location = "usuarios";

                $.ajax({
                    url:"ajax/conceptos.ajax.php",
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

    $(".btnEliminarArea").click(function()
    {

        var idArea = $(this).attr("idArea");
        var dataForm = new FormData();
        var funcion="eliminarArea";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("idArea", idArea);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¡Estas seguro que deseas eliminar este Registro?',
            text: "Si no es asi puedes presionar el boton cancelar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar registro'
        }).then((result) => {
            if (result.value) {
                // window.location = "usuarios";

                $.ajax({
                    url:"ajax/conceptos.ajax.php",
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
    $(".btnEliminarResultado").click(function()
    {

        var idResultado = $(this).attr("idResultado");
        var dataForm = new FormData();
        var funcion="eliminarResultado";
        dataForm.append("funcion", funcion);//PARA MANDARLO A LA VARIABLE datos
        dataForm.append("idResultado", idResultado);//PARA MANDARLO A LA VARIABLE datos


        Swal.fire({
            title: '¡Estas seguro que deseas eliminar este Registro?',
            text: "Si no es asi puedes presionar el boton cancelar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrar registro'
        }).then((result) => {
            if (result.value) {
                // window.location = "usuarios";

                $.ajax({
                    url:"ajax/conceptos.ajax.php",
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

</script>