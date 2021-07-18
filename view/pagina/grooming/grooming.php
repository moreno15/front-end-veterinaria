<div class="content-wrapper" >


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Grooming  </h1>
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
      <input type="hidden" id="tipo" value="grooming">
      <div class="container-fluid">
        <div class="row">

        <?php include 'registrar-grooming.php'; ?>
         <?php include "lista-grooming.php" ?>
        </div>

      </div><!-- /.container-fluid -->
    </section>
         <?php include "buscar-citas.php" ?>
            <?php include "buscar-paciente.php" ?>
    <!-- /.content -->
  </div>
