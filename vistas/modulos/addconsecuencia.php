<?php $_POST['paisSelect'];?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tipo de Consecuencias </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Tipos Consecuencias</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoConcecuencia">Crear Tipo Consecuencia </button>

            </div>
        </div>
        <br>
        <table class="table table-striped tabladatatable dt-responsive " width="100%">
            <thead>
                <tr>
                <th class="d-non" scope="col" width="5%">#</th>
                <th scope="col" width="25%">Pais</th>
                <th scope="col" width="10%">Tipo </th>
                <th scope="col" width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $divisionesp = ControladorDivisiones::ctrMostrarDivisionesPais($_POST['paisSelect']);
                // foreach ($sindicatos as $key => $value)
                // {   
                    echo'<tr>
                        <td class=""></td>
                        <td class=""></td>
                        <td title="" style="text-decoration:none"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning btn-xs btnEditar" id="" data-toggle="modal" data-target="#modalEditar"><i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                <div id="modalEditar" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <form role="form" enctype="multipart/form-data" id="form_" >
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #002554; color: white;">
                                    <h4 class="modal-title">Editar </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                                    <button type="button" class="btn btn-primary guardarEdicion"  idForm="form_" id="">Guardar</button>
                                </div>              
                            </div>
                        </form>  
                    </div>
                </div>';
                
                ?>
            </tbody>
        </table>
        <!-- Modal Nuevo Agregar -->

        <div id="modalAgregar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <form role="form" method="post" enctype="multipart/form-data" >
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #002554; color: white;">
                        <h4 class="modal-title">Agregar </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                        <div class="box-body">
                        <input type="text" class="d-none" value="<?php echo $_SESSION["id"]; ?>" name="id_usuario" id="id_usuario">   
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
<!-- /.content-wrapper -->

