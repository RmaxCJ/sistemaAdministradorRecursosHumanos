<?php
session_start(); //no borrar ni comentar
//session_destroy($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Relaciones Laborales</title>
    <link rel="shortcut icon" type="image/png" href="vistas/img/logoRotoplas.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!--Datatable CSS-->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vistas/plugins/chart.js/Chart.min.js"></script>
<script src="vistas/plugins/flot/jquery.flot.js"></script>
<!-- Sparkline -->
<script src="vistas/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="vistas/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="vistas/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="vistas/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>

<!-- Datatable Jquery-->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script> -->
<!-- Datatable  para tablas-->
<link rel="stylesheet" type="text/css" href="vistas/plugins/DataTables02032021/datatables.min.css"/>
 
<script type="text/javascript" src="vistas/plugins/DataTables02032021/datatables.min.js"></script>

<!--  -->
<!--DATATABLE ESPAÑOL--> 
<!-- <link rel="stylesheet" type="text/css" href="vistas/plugins/datatable/jquery.dataTables.css">
<script src="vistas/plugins/datatable/jquery.dataTableses.js"></script> -->
<!-- solo comente la siguiente  -->
<!-- <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!--SweetAlert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- fileinput-->
<link href="vistas/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="vistas/plugins/fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="vistas/plugins/fileinput/js/plugins/piexif.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/js/locales/fr.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/themes/fas/theme.js" type="text/javascript"></script>
<script src="vistas/plugins/fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
<!-- CSS chosen-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
<!-- JSPDF -->
<script src="vistas/plugins/jspdf/jspdf.min.js"></script>
<!-- fullcalendar_2021 -->
<link href='vistas/plugins/fullcalendar_2021/lib/main.css' rel='stylesheet' />
<script src='vistas/plugins/fullcalendar_2021/lib/main.js'></script>
<script src='vistas/plugins/fullcalendar_2021/lib/locales-all.js'></script>

<!---->
<!--    <script src="http://momentjs.com/downloads/moment.js"></script>-->
<!--    <script src="https://rawgit.com/monkbroc/fullcalendar/year-view-demo/dist/fullcalendar.js"></script>-->




    <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  rel='stylesheet'>-->
<!--    <link rel="stylesheet" type="text/css" href="' + stylesheetUrl + '"/>-->

<!--<link href='vistas/plugins/CSS/estilo.css' rel='stylesheet' />-->
<!--    <script src="vistas/plugins/CLEditor1_4_5/jquery.min.js"></script>-->
    <script src="vistas/plugins/CLEditor1_4_5/jquery.cleditor.js"></script>
    <link href='vistas/plugins/CLEditor1_4_5/jquery.cleditor.css' rel='stylesheet' />

    <!--    <script src="vistas/plugins/CLEditor1_4_5/jquery.cleditor.table.min.js"></script>-->

    <!-- <link href="vistas/dist/css/estilo_pdf.css" media="all" rel="stylesheet" type="text/css"/> -->


</head>



 <?php
//        echo "<pre>";
//        print_r($_SESSION);
//        echo "</pre>";

      $idS          = $_SESSION["id"];
  //  $usuarioS     = $_SESSION["usuario"];
  //  $isperfilS    = $_SESSION["id_perfil"];
  //  $correoS      = $_SESSION["correo"];
  //  $num_empleado = $_SESSION["num_empleado"];
  //  print_r($_SESSION["perfil"]);

    if (isset($_SESSION['iniciarSesion'])&&$_SESSION['iniciarSesion']=="ok"){

      echo('<body><div class="wrapper">');

      /*
       *
       *
id	perfil [test12345]== c06db68e819be6ec3d26c6038d8e8d1f
________________________
1	Administrador
2	Gerente CH [Empleados] ------------->anava
3	Sindicato[Externo] -------------->sperez
4	Abogado General[Externo] -------->srodriguez
5	Abogado Local[Externo] ---------->maguilar
6	Gerente Regional [Empleados] ------->gchavez
7	Pagos [Empleados] ------------------>trosas
________________________


Argentina
Brasil
Costa Rica
El Salvador
Estados Unidos
Guatemala
Honduras
Mexico
Nicaragua
Peru
       *
       * */
      if ($_SESSION["id_perfil"]=='1' && $_SESSION['pais']=='Mexico')
      {
          include "vistas/modulos/encabezadoAdmin.php";
      }else if($_SESSION["id_perfil"]!='1')
      {//agregado para ver otro menu
        include "vistas/modulos/encabezado.php";
      }
      else{
          include "vistas/modulos/404.php";

          }




      //include "vistas/modulos/menu.php";
      if(isset($_GET['ruta'])){
        if($_SESSION["id_perfil"]=='1' && $_SESSION['pais']=='Mexico')
        {
          if($_GET['ruta']=="inicio"||
              $_GET['ruta']=="usuarios"||
              $_GET['ruta']=="sindicatos"||
              $_GET['ruta']=="minutas"||
              $_GET['ruta']=="pliegos"||
              $_GET['ruta']=="editarMinuta"||
              $_GET['ruta']=="pagos"||
              $_GET['ruta']=="ordenescompra"||
              $_GET['ruta']=="nuevopago"||
              $_GET['ruta']=="recibosfacturas"||
              $_GET['ruta']=="proveedores"||
              $_GET['ruta']=="calendario"||
              $_GET['ruta']=="negociaciones"||
              $_GET['ruta']=="cctnegociacion"||
              $_GET['ruta']=="tablasdev"||
              $_GET['ruta']=="cct"||
              $_GET['ruta']=="prueba"||
              $_GET['ruta']=="valuaciones"||
              $_GET['ruta']=="vervaluacion"||
              $_GET['ruta']=="sindicatospais"||
              $_GET['ruta']=="demandas"||
              $_GET['ruta']=="listademandas"||
              $_GET['ruta']=="revisiones"||
              $_GET['ruta']=="listarevisiones"||
              $_GET['ruta']=="multas"||
              $_GET['ruta']=="listamultas"||
              $_GET['ruta']=="conceptos"||
              $_GET['ruta']=="ritpais"||
              $_GET['ruta']=="rit"||
              $_GET['ruta']=="comisiones"||
              $_GET['ruta']=="editarCCT"||
              $_GET['ruta']=="addconsecuencias"||
              $_GET['ruta']=="listaconsecuencias"||
              $_GET['ruta']=="consecuencias"||
              $_GET['ruta']=="inicio2"||
              $_GET['ruta']=="inicio3"||
              $_GET['ruta']=="subirCalendarioPagos"||
              $_GET['ruta']=="subirPlantilla"||
              $_GET['ruta']=="subirTabuladores"||
              $_GET['ruta']=="subirNegociaciones"||
              $_GET['ruta']=="informacionlaboral"||
              $_GET['ruta']=="informacionlaboralver"||
              $_GET['ruta']=="salir"

              
              ){

                include "vistas/modulos/".$_GET['ruta'].".php";
          }else{
                include "vistas/modulos/404.php";
          }
        }
        //seg inf para otro perfil
        elseif($_SESSION["id_perfil"]=='2' && $_SESSION['pais']=='Nicaragua')//agregado por Francisco para nicaragua
        {
                if(
                    $_GET['ruta']=="inicio"||
                    $_GET['ruta']=="demandas"||
                    $_GET['ruta']=="listademandas"||
                    $_GET['ruta']=="revisiones"||
                    $_GET['ruta']=="listarevisiones"||
                    $_GET['ruta']=="multas"||
                    $_GET['ruta']=="listamultas"||
                    $_GET['ruta']=="conceptos"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="listaconsecuencias"||
                    $_GET['ruta']=="consecuencias"||
                    $_GET['ruta']=="rit"||
                    $_GET['ruta']=="ritpais"||
                    $_GET['ruta']=="informacionlaboral"||
                    $_GET['ruta']=="informacionlaboralver"||
                    $_GET['ruta']=="salir"
                )
                {
                    include "vistas/modulos/".$_GET['ruta'].".php";
                }else{
                    include "vistas/modulos/errorperfil.php";
                }
         
        }
        elseif($_SESSION["id_perfil"]=='2')
        {
            if ($_SESSION['pais']=='Mexico')
            {
                if($_GET['ruta']=="inicio"||
                    $_GET['ruta']=="sindicatos"||
                    $_GET['ruta']=="minutas"||
                    $_GET['ruta']=="pliegos"||
                    $_GET['ruta']=="editarMinuta"||
                    $_GET['ruta']=="pagos"||
                    $_GET['ruta']=="ordenescompra"||
                    $_GET['ruta']=="nuevopago"||
                    $_GET['ruta']=="recibosfacturas"||
                    $_GET['ruta']=="calendario"||
                    $_GET['ruta']=="negociaciones"||
                    $_GET['ruta']=="cctnegociacion"||
                    $_GET['ruta']=="cct"||
                    $_GET['ruta']=="valuaciones"||
                    $_GET['ruta']=="vervaluacion"||
                    $_GET['ruta']=="sindicatospais"||
                    $_GET['ruta']=="demandas"||
                    $_GET['ruta']=="listademandas"||
                    $_GET['ruta']=="revisiones"||
                    $_GET['ruta']=="listarevisiones"||
                    $_GET['ruta']=="multas"||
                    $_GET['ruta']=="listamultas"||
                    $_GET['ruta']=="ritpais"||
                    $_GET['ruta']=="rit"||
                    $_GET['ruta']=="comisiones"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="listaconsecuencias"||
                    $_GET['ruta']=="consecuencias"||
                    $_GET['ruta']=="informacionlaboral"||
                    $_GET['ruta']=="informacionlaboralver"||
                    $_GET['ruta']=="salir"
                )
                {

                    include "vistas/modulos/".$_GET['ruta'].".php";
                }else{
                    include "vistas/modulos/errorperfil.php";
                }
            }
            elseif ($_SESSION['pais']=='Argentina')
            {
                if($_GET['ruta']=="inicio"||
                    $_GET['ruta']=="sindicatos"||
                    $_GET['ruta']=="minutas"||
                    $_GET['ruta']=="pliegos"||
                    $_GET['ruta']=="editarMinuta"||
                    $_GET['ruta']=="pagos"||
                    $_GET['ruta']=="ordenescompra"||
                    $_GET['ruta']=="nuevopago"||
                    $_GET['ruta']=="recibosfacturas"||
                    $_GET['ruta']=="calendario"||
                    $_GET['ruta']=="negociaciones"||
                    $_GET['ruta']=="cctnegociacion"||
                    $_GET['ruta']=="cct"||
                    $_GET['ruta']=="valuaciones"||
                    $_GET['ruta']=="vervaluacion"||
                    $_GET['ruta']=="sindicatospais"||
                    $_GET['ruta']=="demandas"||
                    $_GET['ruta']=="listademandas"||
                    $_GET['ruta']=="revisiones"||
                    $_GET['ruta']=="listarevisiones"||
                    $_GET['ruta']=="multas"||
                    $_GET['ruta']=="listamultas"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="listaconsecuencias"||
                    $_GET['ruta']=="consecuencias"||
                    $_GET['ruta']=="informacionlaboral"||
                    $_GET['ruta']=="informacionlaboralver"||
                    $_GET['ruta']=="salir"
                )
                {

                    include "vistas/modulos/".$_GET['ruta'].".php";
                }else{
                    include "vistas/modulos/errorperfil.php";
                }
            }
            elseif($_SESSION['pais']!='Mexico' && $_SESSION['pais']!='Argentina')
            {
                if($_GET['ruta']=="inicio"||
                    $_GET['ruta']=="demandas"||
                    $_GET['ruta']=="listademandas"||
                    $_GET['ruta']=="revisiones"||
                    $_GET['ruta']=="listarevisiones"||
                    $_GET['ruta']=="multas"||
                    $_GET['ruta']=="listamultas"||
                    $_GET['ruta']=="conceptos"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="listaconsecuencias"||
                    $_GET['ruta']=="consecuencias"||
                    $_GET['ruta']=="informacionlaboral"||
                    $_GET['ruta']=="informacionlaboralver"||
                    $_GET['ruta']=="salir"
                )
                {

                    include "vistas/modulos/".$_GET['ruta'].".php";
                }else{
                    include "vistas/modulos/errorperfil.php";
                }
            }

        }
        elseif($_SESSION["id_perfil"]=='3') //sindicatos
        {
            if ($_SESSION['pais']=='Mexico')
            {

                if ($_GET['ruta'] == "inicio" ||
                    $_GET['ruta']=="pliegos"||
                    $_GET['ruta']=="minutas"||
                    $_GET['ruta']=="editarMinuta"||
                    $_GET['ruta']=="negociaciones"||
                    $_GET['ruta']=="cctnegociacion"||
                    $_GET['ruta']=="addconsecuencias"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="cct"||
                    $_GET['ruta']=="inicio2"||
                    $_GET['ruta'] == "salir"
                ) {

                    include "vistas/modulos/" . $_GET['ruta'] . ".php";
                } else {
                    include "vistas/modulos/errorperfil.php";
                }
            }
            elseif ($_SESSION['pais']=='Argentina')
            {

                if ($_GET['ruta'] == "inicio" ||
                    $_GET['ruta']=="pliegos"||
                    $_GET['ruta']=="minutas"||
                    $_GET['ruta']=="editarMinuta"||
                    $_GET['ruta']=="negociaciones"||
                    $_GET['ruta']=="cctnegociacion"||
                    $_GET['ruta']=="editarCCT"||
                    $_GET['ruta']=="cct"||
                    $_GET['ruta'] == "salir"
                ) {

                    include "vistas/modulos/" . $_GET['ruta'] . ".php";
                } else {
                    include "vistas/modulos/errorperfil.php";
                }
            }
        }
        elseif($_SESSION["id_perfil"]=='4' && $_SESSION['pais']=='Mexico') //Abogado General
        {
            if($_GET['ruta']=="inicio"||
                $_GET['ruta']=="sindicatospais"||
                $_GET['ruta']=="sindicatos"||
                $_GET['ruta']=="pliegos"||
                $_GET['ruta']=="minutas"||
                $_GET['ruta']=="editarMinuta"||
                $_GET['ruta']=="negociaciones"||
                $_GET['ruta']=="cctnegociacion"||
                $_GET['ruta']=="editarCCT"||
                $_GET['ruta']=="cct"||
                $_GET['ruta']=="demandas"||
                $_GET['ruta']=="listademandas"||
                $_GET['ruta']=="ritpais"||
                $_GET['ruta']=="rit"||
                $_GET['ruta']=="comisiones"||
                $_GET['ruta']=="salir"
            ){

                include "vistas/modulos/".$_GET['ruta'].".php";
            }else{
                include "vistas/modulos/errorperfil.php";
            }
        }
        elseif($_SESSION["id_perfil"]=='5') //Abogado Local   [redireccionar a lista demandas dependiendo de pais]
        {
            if($_GET['ruta']=="inicio"||
                $_GET['ruta']=="demandas"||
                $_GET['ruta']=="listademandas"||
                $_GET['ruta']=="salir"
            ){

                include "vistas/modulos/".$_GET['ruta'].".php";
            }else{
                include "vistas/modulos/errorperfil.php";
            }
        }
        elseif($_SESSION["id_perfil"]=='6') //Gerente Regional
        {
            if($_GET['ruta']=="inicio"||
                $_GET['ruta']=="sindicatos"||
                $_GET['ruta']=="minutas"||
                $_GET['ruta']=="pliegos"||
                $_GET['ruta']=="editarMinuta"||
                $_GET['ruta']=="pagos"||
                $_GET['ruta']=="ordenescompra"||
                $_GET['ruta']=="nuevopago"||
                $_GET['ruta']=="recibosfacturas"||
                $_GET['ruta']=="calendario"||
                $_GET['ruta']=="negociaciones"||
                $_GET['ruta']=="cctnegociacion"||
                $_GET['ruta']=="cct"||
                $_GET['ruta']=="valuaciones"||
                $_GET['ruta']=="vervaluacion"||
                $_GET['ruta']=="sindicatospais"||
                $_GET['ruta']=="demandas"||
                $_GET['ruta']=="listademandas"||
                $_GET['ruta']=="revisiones"||
                $_GET['ruta']=="listarevisiones"||
                $_GET['ruta']=="multas"||
                $_GET['ruta']=="listamultas"||
                $_GET['ruta']=="ritpais"||
                $_GET['ruta']=="rit"||
                $_GET['ruta']=="comisiones"||
                $_GET['ruta']=="editarCCT"||
                $_GET['ruta']=="listaconsecuencias"||
                $_GET['ruta']=="consecuencias"||                $_GET['ruta']=="salir"
            ){

                include "vistas/modulos/".$_GET['ruta'].".php";
            }else{
                include "vistas/modulos/errorperfil.php";
            }
        }
        elseif($_SESSION["id_perfil"]=='7' && $_SESSION['pais']=='Mexico') //pagos
        {
            if($_GET['ruta']=="inicio"||
                $_GET['ruta']=="calendario"||
                $_GET['ruta']=="pagos"||
                $_GET['ruta']=="salir"
            ){

                include "vistas/modulos/".$_GET['ruta'].".php";
            }else{
                include "vistas/modulos/errorperfil.php";
            }
        }
//        elseif($_SESSION["id_perfil"]=='8')
//        {
//            if($_GET['ruta']=="inicio"||
//                $_GET['ruta']=="usuarios"||
//                // $_GET['ruta']=="formatominuta"||
//                $_GET['ruta']=="salir"
//            ){
//
//                include "vistas/modulos/".$_GET['ruta'].".php";
//            }else{
//                include "vistas/modulos/errorperfil.php";
//            }
//        }



      }
      
      include "vistas/modulos/footer.php";

    }else{
      echo ('<body class="hold-transition login-page">');
      include "vistas/modulos/login.php";
    }

 ?>

<script src="vistas/js/plantilla.js"></script>
   <!-- JS chosse-->
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

</body>

</html>
