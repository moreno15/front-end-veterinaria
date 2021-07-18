<div class="col-md-12">
            <div class="card card-purple collapsed-card">
              <div class="card-header">
                <h3 class="   card-title  " data-card-widget="collapse" style="cursor:pointer">Tratamiento</h3>

                <!--<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                  </div>->
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body data-content" style="display: block;">
                <div class="col-lg-3 m-3 "  >
                    <button type="button"   data-toggle="modal" data-target="#md-tratamiento"  class="btn btn-success btn-sm" name="button"> <span class="fa fa-plus-circle"></span> Agregar Tratamiento </button>
                </div>
                   <table class="table dt-responsive  dt-tratamiento" style="width:100%">
                   <thead>
                     <th>#</th>
                     <th>accion</th>
                     <th>Farmaco</th>
                     <th>Dosis</th>
                     <th>Via</th>
                     <th>Fecha Tartamiento</th>
                   </thead>
                 </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>

<?php include "modal/md-tratamiento.php" ?>
