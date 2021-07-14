<div class="col-md-12">
            <div class="card card-purple collapsed-card">
              <div class="card-header">
                <h3 class="   card-title  " data-card-widget="collapse" style="cursor:pointer">Incidencia </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                 <div class="row">
                   <table class="table">
                     <thead>
                       <th>#</th>
                       <th>Incidencia</th>
                       <th>Descripcion</th>
                       <th>Hora</th>
                       <th>Fecha</th>

                     </thead>
                   </table>
                 </div>
                 <div class="col-lg-3 m-3 "  >
                     <button type="button" data-toggle="modal" data-target="#md-incidencia"  class="btn btn-success" name="button"> <span class="fa fa-plus-circle"></span> Agregar Incidencia </button>
                 </div>
              </div>
              <!-- /.card-body -->
          </div>
            <!-- /.card -->

</div>
<?php include "modal/md-incidencia.php" ?>
