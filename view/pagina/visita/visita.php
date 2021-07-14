<?php  		date_default_timezone_set("America/Lima"); ?>
<div class="content-wrapper" style="min-height: 1071.31px;">
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
        <?php if (count($urlParams)==2): ?>
          <?php if (empty($urlParams[1])): ?>
                <?php $urlParams[1]="listado-visita" ?>
          <?php endif; ?>
          <?php else: ?>
            <?php $urlParams[1]="listado-visita" ?>
        <?php endif; ?>

        <?php if ($urlParams[1]==="listado-visita"): ?>
          <div class="col-md-12 col-sm-12 col-12 "  >
                  <div class="info-box shadow">
                        <span class="info-box-icon "> <i class="fa fa-file-text-o shadow" style="font-size:50px;color:#480088 "></i>  </span>

                        <div class="info-box-content " >
                          <div class="row">
                            <div class="col-lg-9">

                            </div>
                            <div class="col-lg-3">
                                  <a  href="<?php echo $path."visitas/reg-visita" ?>" class="btn btn-success btn-flat">Registrar Nueva Visita</a>
                            </div>

                          </div>

                        </div>
                        <!-- /.info-box-content -->
                  </div>
                      <!-- /.info-box -->
           </div>
         <?php endif; ?>


        <div class="row">
          <div class="col-md-12">
              <div class="card  ">
                <div class="card-header p-0 pt-0">
                      <?php if ($urlParams[1]=="reg-visita"): ?>
                              <h3>   <a  href="<?php echo $path."visitas/listado-visita" ?>" class="btn btn-outline-primary  btn-sm ml-3"> <span class="fa  fa-arrow-left"></span> ir listado Visita</a> Registrar Nueva Visita</h3>
                      <?php else: ?>
                            <h2>Listado de Visitas</h2>
                       <?php endif; ?>
                </div>
                <div class="card-body">
                  <input type="hidden" id="path" value="<?= TemplateController::path() ?>">
                  <input type="hidden" id="urlApi" value="<?= CurlController::api() ?>">
                  <input type="hidden" id="tipo" name="" value="visitas">
                  <?php if ($urlParams[1]=="reg-visita"): ?>
                          <?php include 'modelo/registrar-visita.php'; ?>

                  <?php else: ?>
                    <?php include 'modelo/lista-visitas.php'; ?>
                   <?php endif; ?>


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


<?php include 'modelo/buscar-paciente.php'; ?>
<?php include 'modelo/buscar-citas.php'; ?>
    </section>

    <!-- /.content -->
  </div>
