<style>

    .card {
        min-height: 200px;
    }
    .paisBTN{
        border: none;
        background-color: transparent;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">RIT</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active">RIT</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

    <!-- Array ( [iniciarSesion] => ok [id] => 3 [usuario] => frosales [id_perfil] => 1 
    [correo] => francisco.rosales@swyti.com.mx [num_empleado] => Externo [nombre] => Francisco Rosales Perez [resetear_pass] => [cod_division] => TODAS [pais] => Mexico )
    Array ( [iniciarSesion] => ok [id] => 160 [usuario] => adsegovia [id_perfil] => 2 
    [correo] => adsegovia@rotoplas.com [num_empleado] => 10006833 [nombre] => Alejandro Daniel Segovia Ramirez [resetear_pass] => [division] => AR Buenos Aires [cod_division] => 1A01 [pais] => Argentina ) -->
        <div class="container-fluid">
            <div class="row">
            <?php if($_SESSION['id_perfil']==1){ ?>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="Mexico">

                                <img src="vistas/img/recurso-1.jpg"  width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="Nicaragua">

                                <img src="vistas/img/recurso-7.gif"  width="85%" />
                            </button>
                        </div>
                    </div>
                </div>


                <?php } ?>

            </div>

        </div><!--/. container-fluid form para administrador -->
        <form style="display: none" action="rit" method="POST" id="formPais">
            <input type="hidden" id="paisSelect" name="paisSelect" value=""/>
        </form>
            <input type="text" class="d-none" name="perfil" id="perfil" value="<?php echo $_SESSION['id_perfil']; ?>">
        <!-- Modal -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
 $(document).ready(function() { 
    datossesion();//para tomar la informacion de los perfiles
 });
 function datossesion(){
    var perfil = $("#perfil").val();
    if(perfil!=1){
        window.location.href="rit";
    }
 }


    $(".paisBTN").click(function()
    {

        var pais = $(this).attr("id");
        $("#paisSelect").val(pais);
        $("#formPais").submit();

    });

</script>