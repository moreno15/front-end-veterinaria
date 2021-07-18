<?php  		date_default_timezone_set("America/Lima"); ?>
<div class="content-wrapper" style="min-height: 1071.31px;">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Visitas
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
        <input type="hidden" id="path" value="<?= TemplateController::path() ?>">
        <input type="hidden" id="tipo" name="" value="visitas">



                  <?php
                  if (isset($urlParams[1])) {
                      if ($urlParams[1]=="reg-visita") {
                           include 'modelo/registrar-visita.php';
                      }else if($urlParams[1]=="listado-visita"||$urlParams[1]==""){
                        include 'modelo/lista-visitas.php';
                      }else if($urlParams[1]=="edit-visita"||$urlParams[1]==""){
                          include 'modelo/edit-visita.php';
                        }
                    }else{
                      include 'modelo/lista-visitas.php';
                    }

                  ?>

      </div><!-- /.container-fluid -->


<?php include 'modelo/buscar-paciente.php'; ?>
<?php include 'modelo/buscar-citas.php'; ?>
    </section>

    <!-- /.content -->
  </div>
