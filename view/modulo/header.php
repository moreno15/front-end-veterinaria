<!-- Navbar -->
<!-- Main Footer -->

<nav class="main-header navbar navbar-expand navbar-danger navbar-purple"   >
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!--<li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>-->
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- Messages Dropdown Menu -->
    <!--<li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-calendar"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>

    </li>-->
    <li class="nav-item dropdown">
      <a class="nav-link"  href="<?php echo $path."logout" ?>">
        <i class="fa fa-lock"></i> Salir
      </a>

    </li>

  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-purple" >
  <!-- Brand Logo -->
  <a href="<?php echo $path."/" ?>" class="brand-link navbar-purple">

    <span class="brand-text font-weight-light" style="color:#fff">CLINICA SAN CRISTOBAL</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"> <?php echo $_SESSION["user"]->user_usuario; ?> </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <?php
              $menu_open="menu-open";
              $active="";



              ?>

        <li class="nav-item   ">
            <a href="/" class="nav-link  ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
              </p>
            </a>
        </li>
        <li class="nav-item ">
            <a  href="<?php  echo $path.'cliente/' ?>" class="nav-link <?=$active ?> ">
              <i class="nav-icon fa   fa-users"></i>
              <p>
                <strong>Cliente</strong>
              </p>
            </a>
        </li>
        <li class="nav-item ">
            <a  href="<?php  echo $path.'paciente/' ?>" class="nav-link   <?=$active ?> ">
              <i class="nav-icon fa  fa-github"></i>
              <p>
                <strong>Paciente</strong>
              </p>
            </a>
        </li>


        <li class="nav-item has-treeview   <?= $menu_open?>">
            <a href="#" class="nav-link  <?=$active ?> "  >
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                <strong>Citas</strong>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo $path."citas/reg-citas/" ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registrar Cita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $path."citas/lista-citas/" ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gestionar Citas</p>
                  </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview    <?= $menu_open?>">
            <a href="#" class="nav-link  " >
              <i class="nav-icon fa  fa-heartbeat"></i>
              <p>
                <strong>Servicios</strong>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a  href="<?php echo $path.'visitas/' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Visitas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo $path.'grooming' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grooming</p>
                </a>
              </li>
              <li class="nav-item">
                <a  href="<?php echo $path.'vacunacion/' ?>" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vacunacion</p>
                </a>
              </li>

            </ul>
          </li>

        <li class="nav-item">
          <a href="<?php echo $path."internamiento" ?>" class="nav-link">
            <i class="fa  fa-ambulance nav-icon"></i>
            <p> <strong>Internamiento</strong> </p>
          </a>
        </li>



      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
