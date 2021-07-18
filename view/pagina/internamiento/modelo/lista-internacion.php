<div class="col-md-12 col-sm-12 col-12 "  >
        <div class="info-box shadow">
              <span class="info-box-icon "> <i class="fa fa-file-text-o shadow" style="font-size:50px;color:#480088 "></i>  </span>

              <div class="info-box-content " >
                <div class="row">
                  <div class="col-lg-9">

                  </div>
                  <div class="col-lg-3">
                        <a  href="<?php echo $path."internamiento/reg-internacion" ?>" class="btn btn-success btn-flat">Iniciar Nueva Internación</a>
                  </div>

                </div>

              </div>
              <!-- /.info-box-content -->
        </div>
            <!-- /.info-box -->
 </div>

 <div class="row">
   <div class="col-md-12">
       <div class="card  ">
         <div class="card-header p-0 pt-0">

            <h2>Listado de internación</h2>

         </div>
         <div class="card-body">
           <input type="hidden" id="tipo"  value="internamiento">
                <table class="table dt-responsive  dt-internamiento" style="width:100%">

                    <thead  >

                        <tr>

                            <th>#</th>
                            <th>Accion</th>
                            <th>Cliente</th>

                             <th>Paciente</th>

                             <th>Motivo Internamiento</th>

                             <th>Fecha ingreso</th>

                             <th>Fecha Alta</th>


                        </tr>

                    </thead>

                </table>


         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
   </div>
   <!-- /.col -->
 </div>
