<?php
if($_SESSION['id_perfil']==1)
{


?>


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
                    <h1 class="m-0 text-dark"><?php echo $textosArray[186];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="inicio"><?php echo $textosArray[190];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $textosArray[186];?></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <div class="container-fluid">


            <div class="row">

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="mexico">

                                <img src="vistas/img/recurso-1.jpg"  width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="argentina">

                                <img src="vistas/img/recurso-2.jpg"  width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="brasil">
                                <img src="vistas/img/recurso-3.jpg" width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="peru">

                                <img src="vistas/img/recurso-4.jpg"  width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <!--                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>-->

                        <div class="info-box-content">
                            <button class="paisBTN" id="usa">

                                <img src="vistas/img/recurso-5.jpg"  width="100%" />
                            </button>
                        </div>
                    </div>
                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">

                                        <div class="info-box-content">
                                            <button class="paisBTN" id="centroAmerica">
                                                <img src="vistas/img/recurso-6.jpg" width="100%" />
                                            </button>
                                        </div>
                                    </div>
                                </div>


            </div>

        </div><!--/. container-fluid -->
        <form style="display: none" action="listarevisiones" method="POST" id="formPais">
            <input type="hidden" id="paisSelect" name="paisSelect" value=""/>
        </form>

        <!-- Modal -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

    $(".paisBTN").click(function()
    {

        var pais = $(this).attr("id");
        $("#paisSelect").val(pais);
        $("#formPais").submit();

    });

</script>
    <?php
}
else
{
//    echo $_SESSION['pais'];
    ?>
    <form style="display: none" action="listarevisiones" method="POST" id="formPais">
        <input type="text" id="paisSelect" name="paisSelect" value="<?php echo $_SESSION['pais'];?>">
    </form>
    <script>

        $("#formPais").submit();


    </script>
    <?php
}
?>
