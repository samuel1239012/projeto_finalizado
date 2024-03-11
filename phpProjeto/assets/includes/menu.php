<?php
   include("../../assets/includes/validacao.php");
  $explode = explode("/",$_SERVER["REQUEST_URI"]);

  $local = $explode[2];



?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="<?php echo $path?>" class="brand-link">
      <img src="<?php echo $comp?>../vendor/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $comp?>../vendor/dist/img/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
                 <?php 
                  echo '<a href="' . $path . '/noticia/index.php" class="d-block">' . $_SESSION['nome'] . '</a>';
                 ?>
             

        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Páginas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                        <?php 
                          if($_SESSION['cargo']=="ADM") {
                            ?>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="<?php echo $path;?>/usuarios/index.php" class="nav-link <?php echo $local=="usuarios" ? "active" : ""; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                  <p> Usuarios</p>
                              </a>
                            </li>
                        <?php
                        }
                        ?>
            
              <li class="nav-item">
                <a href="<?php echo $path;?>/cinema/index.php" class="nav-link <?php echo $local=="cinema" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cinema</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $path;?>/noticia/index.php" class="nav-link <?php echo $local=="noticia" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Noticia</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $path;?>/generos/index.php" class="nav-link <?php echo $local=="generos" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gênero</p>
                </a>     
              </li>
              <?php 
                if($_SESSION['cargo']=="ADM") {
              ?>
              <li class="nav-item">
                <a href="<?php echo $path;?>/Clientes/index.php" class="nav-link <?php echo $local=="Clientes" ? "active" : ""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <?php
                }
              ?>
              <?php 
                if($_SESSION['cargo'] == "REDACAO" || $_SESSION['cargo'] == "ADM" || $_SESSION['cargo'] == "REVISOR") {
                ?>
                  <li class="nav-item">
                    <a href="<?php echo $path;?>/banner/index.php" class="nav-link <?php echo $local=="banner" ? "active" : ""; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Banner</p>
                    </a>
                  </li>
              <?php
                  } 
              ?>

                        <?php 
                          if($_SESSION['cargo']=="ADM") {
                            ?>
                          <li class="nav-item">
                            <a href="<?php echo $path;?>/redacao/index.php" class="nav-link <?php echo $local=="redacao" ? "active" : ""; ?>">
                              <i class="far fa-circle nav-icon"></i>
                                <p>Redação</p>
                            </a>
                           </li>
                        <?php
                        }
                        ?>
                        <?php 
                          if($_SESSION['cargo'] == "ADM") {
                            ?>
                          <li class="nav-item">
                            <a href="<?php echo $path;?>/revisor/index.php" class="nav-link <?php echo $local=="revisor" ? "active" : ""; ?>">
                              <i class="far fa-circle nav-icon"></i>
                                <p>Revisor</p>
                            </a>
                          </li>
                        <?php
                        } 
                        ?>
                          
          
          
          
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>