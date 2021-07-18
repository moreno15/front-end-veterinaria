
      <div class="modal fade" id="md-reg-cliente">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Nuevo Cliente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-cliente"    method="post">
            <div class="modal-body">
              <div class="row">

                <div class="col-sm-12">
                  <label>Dni <span style="color:red">*</span></label>
                   <div class="col-sm-12  mb-3 pl-0 ml-0">
                  <div class="input-group  ">
                    <input type="hidden" name="id_cliente" id="id_cliente" >
                      <input type="text" name="dni_cliente" id="dni_cliente" class="form-control form-control-sm" required>
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat btn-sm" onclick="buscarDni()">Buscar(RENIEC) </button>
                      </span>
                    </div>
                  </div>
               </div>
                <div class="col-sm-6">
                   <!-- text input -->
                   <div class="form-group">
                     <label>Nombre <span style="color:red">*</span></label>
                     <input type="text"  name="nombre_cliente" id="nombre_cliente" class="form-control form-control-sm" required >
                   </div>
                 </div>
                 <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Apellido <span style="color:red">*</span></label>
                      <input type="text"  name="apellido_cliente" id="apellido_cliente" class="form-control form-control-sm" required >
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <!-- text input -->
                     <div class="form-group">
                       <label>Correo</label>
                       <input type="text"  name="email_cliente" id="email_cliente"  class="form-control form-control-sm" >
                     </div>
                   </div>
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text"  name="telefono_cliente" id="telefono_cliente"  class="form-control form-control-sm" >
                      </div>
                    </div>
                    <div class="col-sm-12">
                       <!-- text input -->
                       <div class="form-group">
                         <label>Direccion</label>
                         <input type="text"  name="direccion_cliente" id="direccion_cliente"  class="form-control form-control-sm" >
                       </div>
                     </div>

              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <?php $cliente=new TableController();
                    $cliente->registerCliente();

               ?>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
