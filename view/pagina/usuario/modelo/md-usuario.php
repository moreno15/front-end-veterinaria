
      <div class="modal fade" id="md-reg-usuario">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Nuevo usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-usuario"    method="post">
            <div class="modal-body">
              <div class="row">


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
                           <label>Contraseña</label>
                           <input type="text"  name="password_usuario" id="password_usuario"  class="form-control form-control-sm" >
                         </div>
                       </div>
                       <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Rol</label>
                             <select class="" name="">
                               <option value="">Seleccione</option>
                             </select>
                          </div>
                        </div>

              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
               
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
