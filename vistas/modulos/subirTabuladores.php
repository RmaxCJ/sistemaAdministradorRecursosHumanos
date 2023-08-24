<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Subir Tabuladores</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Subir Tabuladores</li>
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

                            <button type="submit" class="btn btn-primary">Subir</button>
                            <?php
                            $subirExcel = new ControladorExcel();
                            $subirExcel -> ctrSubirTabuladores();

                            ?>

                        </form>
                    </div>
                    <div class="col-md-2"></div>

                </div>

                <br><br>

            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
