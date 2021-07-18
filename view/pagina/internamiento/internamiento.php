
<div class="content-wrapper" style="min-height: 1071.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Internación
             </h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="col-lg-12">
          <input type="hidden" id="path" value="<?= TemplateController::path() ?>">


        <?php
        		date_default_timezone_set("America/Lima");
        if (isset($urlParams[1])) {

        if ($urlParams[1]=="reg-internacion") {
            include 'modelo/registrar-internacion.php';
        }else if ($urlParams[1]=="listado-internacion") {
            include 'modelo/lista-internacion.php';
        }else if ($urlParams[1]=="detalle-internacion") {
              include 'modelo/internacion.php';

        }else{
            include '404.php';
        }
      }else{
        include 'modelo/lista-internacion.php';
      }

         ?>
        <!-- /.row -->
      </div>

      </div><!-- /.container-fluid -->


    </section>

    <!-- /.content -->
  </div>
