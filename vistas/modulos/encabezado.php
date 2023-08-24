
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img src="vistas/img/logoRotoplasblanco.png" width="60%" class="m-2"></a>


    <ul class="navbar-nav" style="margin-left: -50px;">
        <li class="nav-item dropdown">
            <span class="input-group-addon"><i class="fa fa-user fa-lg mr-2"></i></span>

            <?php
            // $idS
            if ($_SESSION['nombre']!="")
            {
                echo '<span style=" color: white; font-size:18px; text-transform: capitalize;" >'.utf8_encode($_SESSION["nombre"]).'</span>';
                //echo '<span style=" background-color: #58C720; color: white;" class="dropdown-item dropdown-header">'.$_SESSION["nombre"].'</span>';

            }
            elseif ($_SESSION['nombre']=='' || $_SESSION['nombre']==null)
            {
                echo '<span style="color: white; font-size:18px; text-transform: capitalize;" >'.$_SESSION["usuario"].'</span>';
            }
            else
            {
                echo '<span style="color: white; font-size:18px; text-transform: capitalize;" >Nombre de Usuario</span>';
            }
            ?>
            <?php
            // $usuariossencillos = ControladorUsuarios::ctrMostrarUsuariosSencillo();
            // foreach ($usuariossencillos as $key => $valU) {
            //     if($idS==$valU->id){

            //         $idperfil = $valU->id_perfil;
            //         $nombre_usuario = $valU->nombre_usuario;
            //         $id_resp = $valU->id_responsable;
            //         $num_empleado = $valU->num_empleado;
            //         if ($nombre_usuario != null) {
            //         echo utf8_encode($nombre_usuario);
            //         }
            //         else if ($nombre_usuario == null || $nombre_usuario == '') {
            //             $empleadosData = ControladorUsuarios::ctrbuscarEmpleadoByNumEmpleado($valU->num_empleado);
            //         foreach ($empleadosData as $key => $valE)
            //         {
            //         $nombre=$valE->nombre;
            //             echo utf8_encode($nombre);
            //         }
            //         }
            //     }
            // }
            ?>
        </li>

    </ul>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown mr-2">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-exclamation-triangle fa-2x"></i></a>
                <ul class="dropdown-menu fade-up">
                    <li><a class="dropdown-item active" href="informacionlaboral">Subir</a></li>
                    <li><a class="dropdown-item" href="informacionlaboralver">Abrir</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-globe fa-2x"></i></a>

                <ul class="dropdown-menu fade-up">
                    <li><a class="dropdown-item active" href="http://zbb.rotoplas.com/relaciones/inicio">Español</a></li>
                    <li><a class="dropdown-item" href="http://zbb.rotoplas.com/relaciones/inicio">Ingles</a></li>
                    <li><a class="dropdown-item" href="http://zbb.rotoplas.com/relaciones/inicio">Potugues</a></li>
                </ul>

            </li>

<!--            <li class="nav-item dropdown">-->
<!--                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="vistas/plugins/ICONOS-COLORES-ROTOPLAS/Blanco/Asset%203.png"  width="35px" height="35px"></a>-->
<!---->
<!--                <ul class="dropdown-menu fade-up">-->
<!--                    <li><a class="dropdown-item" href="usuarios"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</a></li>-->
<!--                    <li><a class="dropdown-item" href="proveedores"><i class="fa fa-user-check" aria-hidden="true"></i> Abogados</a></li>-->
<!--                    <li><a class="dropdown-item" href="conceptos"><i class="fa fa-list-ol" aria-hidden="true"></i> Conceptos</a></li>-->
<!--                </ul>-->
<!--            </li>-->


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"  style="color: white !important;">
                    <i class="fas fa-user fa-2x"></i>

                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php
                    if ($_SESSION['nombre']!="")
                    {
                        echo '<span style=" background-color: #58C720; color: white;" class="dropdown-item dropdown-header">'.utf8_encode($_SESSION["nombre"]).' / '.$_SESSION["num_empleado"].'</span>';
                        echo '<div class="dropdown-divider"></div>';
//                echo '<span style=" background-color: #58C720; color: white;" class="dropdown-item dropdown-header">'.$_SESSION["nombre"].'</span>';

                    }
                    elseif ($_SESSION['nombre']=='' || $_SESSION['nombre']==null)
                    {
                        echo '<span style=" background-color: #58C720; color: white;" class="dropdown-item dropdown-header">'.$_SESSION["usuario"].' / '.$_SESSION["num_empleado"].'</span>';
                        echo '<div class="dropdown-divider"></div>';
                    }
                    else
                    {
                        echo '<span style=" background-color: #C74636; color: white;"  class="dropdown-item dropdown-header">Nombre de Usuario</span>';
                    }


                    ?>


                    <div class="dropdown-divider"></div>
                    <a href="salir" class="dropdown-item">
                        <i class="fas fa-user-times mr-2"></i> Cerrar Sesión
                        <span class="float-right text-muted text-sm">Activa</span>
                    </a>

            </li>
        </ul>

    </div> <!-- navbar-collapse.// -->

</nav>


<style>
    html{
        overflow-x: hidden;
    }
    .navbar {
        -webkit-box-shadow: 0 8px 6px -6px #999;
        -moz-box-shadow: 0 8px 6px -6px #999;
        box-shadow: 0 8px 6px -6px #999;
        box-shadow: 0px 8px 8px -6px rgba(0,0,0,.5);
        background-color: #002554 !important;
        color: white !important;
        /* the rest of your styling */
    }


    /* ============ only desktop view ============ */
    @media all and (min-width: 992px) {
        .navbar .nav-item .dropdown-menu{  display:block; opacity: 0;  visibility: hidden; transition:.3s; margin-top:0;  }
        .navbar .nav-item:hover .nav-link{ color: #fff;  }
        .navbar .dropdown-menu.fade-down{ top:80%; transform: rotateX(-75deg); transform-origin: 0% 0%; }
        .navbar .dropdown-menu.fade-up{ top:180%;  }
        .navbar .nav-item:hover .dropdown-menu{ transition: .3s; opacity:1; visibility:visible; top:100%; transform: rotateX(0deg); }
    }
    /* ============ desktop view .end// ============ */

</style>