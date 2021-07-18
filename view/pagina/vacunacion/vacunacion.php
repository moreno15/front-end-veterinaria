<div class="content-wrapper" >
  <div id="menuCapa"  class="dropdown-menu" role="menu" style="">
        <a class="dropdown-item"  style="cursor:pointer" onclick="contexMenu(),dataTable('cl-paciente')"  data-toggle="modal" data-target="#md-buscar-cita"  href="#">Buscar Cita</a>
        <a class="dropdown-item"   style="cursor:pointer"  onclick="contexMenu(),dataTable('cl-paciente2')"   data-toggle="modal" data-target="#md-buscar-paciente" >Buscar Paciente</a>
        <a class="dropdown-item" style="cursor:pointer"  href="#">Something else here</a>
        <div class="dropdown-divider" style="cursor:pointer" ></div>
        <a class="dropdown-item"  style="cursor:pointer" href="#">Separated link</a>
    </div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vacunación  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buttons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content"  style="height:3000px">
      <input type="hidden" id="path" value="<?= TemplateController::path() ?>">
      <input type="hidden" id="urlApi" value="<?= CurlController::api() ?>">
      <input type="hidden" id="tipo" value="vacunacion">
      <div class="container-fluid">
        <div class="row">

        <?php include 'registrar-vacunacion.php'; ?>
         <?php //include "lista-vacunacion.php" ?>
        </div>

      </div><!-- /.container-fluid -->
    </section>
         <?php include "buscar-citas.php" ?>
            <?php include "buscar-paciente.php" ?>
    <!-- /.content -->
  </div>
