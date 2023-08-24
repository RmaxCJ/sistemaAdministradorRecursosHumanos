<?php
//session_destroy();


?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Página Restringida</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Permisos insuficientes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <!-- <h2 class="headline text-warning"> </h2> -->

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página Restringida.</h3>
          <p>Usuario no permitido consultar  un administrador !</p>
          <p>
            Podrias volver a la navegacion dando clic en  <a href="inicio">volver al inicio</a> 
          </p>

         
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->