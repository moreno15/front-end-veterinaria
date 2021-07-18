<div class="modal fade"  id="modal-paciente" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Paciente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form class="form-horizontal"  method="post" enctype="multipart/form-data" >
                <div class="modal-body  ">
                  <div class="row pt-0 mt-0">
                    <div class="col-md-12 pt-0 mt-0">

                            <div class="form-group row">
                              <label for="" class="col-sm-3 col-form-label">Dueño <span style="color:red">*</span></label>
                              <div class="col-sm-9">
                                <div class="input-group   ">

                                    <select  class="form-control form-control-sm  select2  " required   name="id_cliente" id="id_cliente" style="width:100%">
                                      <?php
                                      $url = CurlController::api()."cliente?&select=*";
                                      $method = "GET";
                                      $fields = array();
                                      $header = array();

                                      $dataCliente= CurlController::request($url, $method, $fields, $header)->results;

                                        ?>
                                      <option value="" >Seleccione</option>
                                      <?php foreach ($dataCliente as $key => $value): ?>
                                            <option value="<?php echo trim($value->id_cliente) ?>"> <?php echo $value->nombre_cliente." ".$value->apellido_cliente ?></option>
                                      <?php endforeach; ?>
                                    </select>

                                  </div>
                              </div>
                            </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Nombre paciente <span style="color:red">*</span> </label>
                                  <div class="col-sm-9">
                                    <input type="hidden"  name="id_paciente" id="id_paciente" class="form-control form-control-sm">
                                    <input type="text" name="nombre_paciente" id="nombre_paciente" class="form-control form-control-sm" required  >
                                  </div>
                                </div>

                                  <div class="row pl-0 ml-0">
                                    <div class="col-lg-7 pl-0 ml-0"  >
                                      <div class="form-group ">
                                        <label  class="col-sm-5 col-form-label " style="float:left">Sexo <span style="color:red">*</span></label>
                                        <div class="col-sm-7" style="float:left">
                                          <select class="form-control form-control-sm" name="sexo_paciente" id="sexo_paciente" required>
                                            <option value=" ">Selecciones</option>
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
                                          <input type="text" name="color_paciente" id="color_paciente" class="form-control form-control-sm"  >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="row">
                                  <div class="col-lg-7"  >
                                    <div class="form-group ">
                                      <label for="" class="col-sm-5 col-form-label" style="float:left">Especie <span style="color:red">*</span></label>
                                      <div class="col-sm-7" style="float:left">
                                        <select class="form-control form-control-sm" name="especie" id="especie" required>
                                          <option value="">Selecciones</option>
                                          <option value="1">Canino</option>
                                          <option value="2">Felino</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-5" >
                                    <div class="form-group ">
                                      <label for="" class="col-sm-3 col-form-label" style="float:left">Raza <span style="color:red">*</span></label>
                                      <div class="col-sm-9" style="float:left">
                                        <select class="form-control form-control-sm" name="raza" id="raza" required>
                                          <option value="">Selecciones</option>
                                          <option value="1">Bichon Bolos</option>
                                          <option value="2">Bichon Maltos</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Fecha Naci. <span style="color:red">*</span></label>
                                  <div class="col-sm-9">
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm"  required >
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-3 col-form-label">Esterelizado</label>
                                  <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="esterelizado" id="esterilizado">
                                      <option value=" ">Selecciones</option>
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
                                            >

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
