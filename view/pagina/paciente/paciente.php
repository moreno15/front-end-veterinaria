<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Paciente </h1>
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
    <section class="content" style="height:3000px">
      <input type="hidden" id="path" value="<?= TemplateController::path() ?>">

      <div class="container-fluid">
        <div class="row">

        <?php
           date_default_timezone_set("America/Lima");
        if (isset($urlParams[1])) {

              if ($urlParams[1]=="historia-clinica") {
                include "modelo/historia-clinica.php"  ;
              }else{
                  include 'modelo/lista-paciente.php';
                   include 'modelo/md-paciente.php';
            } 
        }else{

          include 'modelo/lista-paciente.php';
           include 'modelo/md-paciente.php';
        }

         ?>
       <?php ?>



        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
