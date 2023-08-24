  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="vistas/img/ttgl.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">RmaxCJ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            if ($_SESSION['foto']!="") 
            {
              echo "<img src='".$_SESSION['foto']."' class='img-circle elevation-2' alt='User Image'>";
            }
            else
            {
              echo "<img src='vistas/img/rmns.jpg' class='img-circle elevation-2' alt='User Image'>";

            }
          ?>
        </div>
        <div class="info">
          <?php
            if ($_SESSION['nombre']!="") 
            {
              echo "<a class='d-block'>".$_SESSION['nombre']."</a>";
            }
            else
            {
                echo "<a class='d-block'>Nombre</a>";
            }
          ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
          
              
          
          <li class="nav-header">MENU</li>
           <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Tablero
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-user-edit"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="productos" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-sellsy"></i>
              <p>
                Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crearventa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reporteventa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte de ventas</p>
                </a>
              </li>
              
            </ul>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>