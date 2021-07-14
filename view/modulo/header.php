<!-- Navbar -->
<!-- Main Footer -->

<nav class="main-header navbar navbar-expand navbar-danger navbar-purple" >
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
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>


    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-calendar"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>

    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-purple">
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
        <a href="#" class="d-block">usuario</a>
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
              $active="active";



              ?>
        <!--<li class="nav-item has-treeview ">
            <a href="/" class="nav-link   " >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>-->
        <li class="nav-item   ">
            <a href="/" class="nav-link  ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
              </p>
            </a>
        </li>
        <?php if ($urlParams[0]=="cliente"): ?>
        <li class="nav-item ">
            <a  href="<?php  echo $path.'cliente' ?>" class="nav-link <?=$active ?> ">
              <i class="nav-icon fa   fa-users"></i>
              <p>
                Cliente
              </p>
            </a>
        </li>
      <?php else: ?>
        <li class="nav-item ">
            <a  href="<?php  echo $path.'cliente' ?>" class="nav-link  ">
              <i class="nav-icon fa   fa-users"></i>
              <p>
                Cliente
              </p>
            </a>
        </li>
        <?php endif; ?>
          <?php if ($urlParams[0]=="paciente"): ?>
        <li class="nav-item ">
            <a  href="<?php  echo $path.'paciente' ?>" class="nav-link   <?=$active ?> ">
              <i class="nav-icon fa  fa-github"></i>
              <p>
                Paciente
              </p>
            </a>
        </li>
        <?php else: ?>
          <li class="nav-item ">
              <a  href="<?php  echo $path.'paciente' ?>" class="nav-link ">
                <i class="nav-icon fa  fa-github"></i>
                <p>
                  Paciente
                </p>
              </a>
        <?php endif; ?>
        <?php if ($urlParams[0]=="citas"): ?>
        <li class="nav-item">
          <a href="<?php echo $path."citas" ?>" class="nav-link <?=$active ?>">
            <i class="fa  fa-calendar nav-icon"></i>
            <p>Citas</p>
          </a>
        </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="<?php echo $path."citas" ?>" class="nav-link ">
              <i class="fa  fa-calendar nav-icon"></i>
              <p>Citas</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if (isset($urlParams[1])): ?>
        <li class="nav-item has-treeview <?= $menu_open?>">
            <a href="#" class="nav-link   <?=$active ?>" >
              <i class="nav-icon fa  fa-heartbeat"></i>
              <p>
                Servicios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($urlParams[0]=="visitas"): ?>
                <li class="nav-item">
                  <a  href="<?php echo $path.'visitas/' ?>" class="nav-link <?=$active ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Visitas</p>
                  </a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a  href="<?php echo $path.'visitas/' ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Visitas</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($urlParams[0]=="grooming"): ?>
                <li class="nav-item">
                  <a href="<?php echo $path.'grooming/' ?>" class="nav-link <?=$active ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Grooming</p>
                  </a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a href="<?php echo $path.'grooming/' ?>" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Grooming</p>
                  </a>
                </li>
              <?php endif; ?>

            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item has-treeview  ">
              <a href="#" class="nav-link  " >
                <i class="nav-icon fa  fa-heartbeat"></i>
                <p>
                  Servicios
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

              </ul>
            </li>
          <?php endif; ?>
        <li class="nav-item">
          <a href="<?php echo $path."internacion" ?>" class="nav-link">
            <i class="fa  fa-ambulance nav-icon"></i>
            <p>Internación</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo $path."store/product" ?>" class="nav-link">
            <i class="far  fa-file  nav-icon"></i>
            <p>Reportes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $path."/" ?>" class="nav-link">
            <i class="fa  fa-circle nav-icon"></i>
            <p>....</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $path."/" ?>" class="nav-link">
            <i class="fa  fa-circle nav-icon"></i>
            <p>....</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
