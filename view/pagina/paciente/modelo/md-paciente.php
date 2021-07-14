<div class="modal fade show" id="modal-default"  >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Paciente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="form-horizontal" method="post">
                <div class="modal-body  ">
                  <div class="row pt-0 mt-0">
                    <div class="col-md-12 pt-0 mt-0">

                            <div class="form-group row">
                              <label for="" class="col-sm-3 col-form-label">Dueño</label>
                              <div class="col-sm-9">
                                <div class="input-group   ">
                                    <input type="hidden"  value="1" name="id_cliente" id="id_cliente" class="form-control form-control-sm">
                                    <input type="text" readonly name="nombre_cliente" id="nombre_cliente" class="form-control form-control-sm">
                                    <span class="input-group-append">
                                      <button type="button" class="btn btn-info btn-flat btn-sm"  >Buscar</button>
                                    </span>
                                  </div>
                              </div>
                            </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Nombre</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="nombre_paciente" class="form-control form-control-sm"   >
                                  </div>
                                </div>

                                  <div class="row pl-0 ml-0">
                                    <div class="col-lg-7 pl-0 ml-0"  >
                                      <div class="form-group ">
                                        <label  class="col-sm-5 col-form-label " style="float:left">Sexo</label>
                                        <div class="col-sm-7" style="float:left">
                                          <select class="form-control form-control-sm" name="sexo_paciente">
                                            <option value="">Selecciones</option>
                                            <option value="Hembra">Hembra</option>
                                            <option value="Macho">Macho</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-5" >
                                      <div class="form-group ">
                                        <label for="" class="col-sm-3 col-form-label " style="float:left">Color</label>
                                        <div class="col-sm-9" style="float:left">
                                          <input type="text" name="color_paciente" class="form-control form-control-sm"  >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="row">
                                  <div class="col-lg-7"  >
                                    <div class="form-group ">
                                      <label for="" class="col-sm-5 col-form-label" style="float:left">Especie</label>
                                      <div class="col-sm-7" style="float:left">
                                        <select class="form-control form-control-sm" name="especie">
                                          <option value="">Selecciones</option>
                                          <option value="1">Canino</option>
                                          <option value="2">Felino</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-5" >
                                    <div class="form-group ">
                                      <label for="" class="col-sm-3 col-form-label" style="float:left">Raza</label>
                                      <div class="col-sm-9" style="float:left">
                                        <select class="form-control form-control-sm" name="raza">
                                          <option value="">Selecciones</option>
                                          <option value="1">Bichon Bolos</option>
                                          <option value="2">Bichon Maltos</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Fecha Naci.</label>
                                  <div class="col-sm-9">
                                    <input type="date" name="fecha_nacimiento" class="form-control form-control-sm"  >
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Esterelizado</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="esterelizado">
                                      <option value="0">No</option>
                                      <option value="1">Si</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label">Imagen Paciente </label>
                                  <div class="row">
                                      <div class="col-lg-4">
                                        <label style=" cursor:pointer" class="pb-5" for="imagePaciente">
                                            <img src="img/products/default/default-image.jpg" class="img-fluid changeImagePaciente" style="width:150px">
                                        </label>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="custom-file" style="margin-top:50%"  >

                                            <input style="height:36px; cursor:pointer"
                                            value=""
                                            type="file"
                                            id="imagePaciente"
                                            class="custom-file-input"
                                            name="fotopaciente"
                                            accept="image/*"
                                            maxSize="2000000"
                                            onchange="validateImageJS(event, 'changeImagePaciente')"
                                            required>

                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>

                                            <label style="height:36px; cursor:pointer" class="custom-file-label " id="changeImagePaciente" for="imagePaciente">Subir imagen de paciente</label>

                                        </div>
                                    </div>
                                  </div>
                                </div>
                              <!-- /.card-footer -->


                    </div>
                    <!-- /.col -->
                  </div>
                </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <?php $paciente=new TableController();
                      $paciente->registerPaciente();

                 ?>
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
