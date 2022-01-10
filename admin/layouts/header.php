 
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <style>
      @media (min-width: 600px) {
        .navbar {
          display: none;
            }
      }
</style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="http://alfgc.epizy.com/serra/" class="brand-link">
      <img src="./dist/img/serra.png" alt="Martinez Serra Logo" class="brand-image img-circle" style="opacity: .8">
      <span class="brand-text font-weight-bolder h5">MARTINEZ SERRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div> -->
    

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           
          <li class="nav-item">
            <a href="./login.php" class="nav-link">
              <i class="nav-icon fas fa-home fa-2x"></i>
              <p class="h4">
                Inicio
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./pedidos.php" class="nav-link">
              <i class="nav-icon fas fa-truck fa-2x"></i>
              <p class="h4">
                Pedidos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./productos.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart fa-2x"></i>
              <p class="h4">
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-users fa-2x"></i>
              <p class="h4">
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./categorias.php" class="nav-link">
              <i class="nav-icon fas fa-bezier-curve fa-2x"></i>
              <p class="h4">
                Categorías
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  </body>
  </html>