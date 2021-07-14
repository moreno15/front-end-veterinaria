<div class="content-wrapper" style="height:3000px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Paciente <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default">
                  Registrar Paciente
                </button></h1>
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
    <section class="content">
      <input type="hidden" id="urlapiruc" value="https://dniruc.apisperu.com/api/v1/">
      <input type="hidden" id="path" value="<?= TemplateController::path() ?>">
      <input type="hidden" id="tipo" value="paciente">
      <div class="container-fluid">

        <?php include 'modelo/md-paciente.php'; ?>
     <?php include "modelo/lista-paciente.php" ?>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
