
      <div class="modal fade" id="md-tratamiento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro de Tratamientos</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class=""   method="post">
            <div class="modal-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Medicamento  <span style="color:red">*</span> </label>
                <div class="col-sm-9">
                      <div class="input-group  ">
                        <input type="hidden" name="id_internamiento" value="<?=$internamiento[0]->id_internamiento ?>">
                          <input type="hidden" name="id_articulo_tratamiento" id="idproducto" value="1" class="form-control form-control-sm">

                          <select  class="form-control form-control-sm  select2 " name="id_articulo_tratamiento" style="width:100%" required>
                            <?php
                            $url = CurlController::api()."articulo?&select=*";
                            $method = "GET";
                            $fields = array();
                            $header = array();

                            $dataIncidencia= CurlController::request($url, $method, $fields, $header)->results;

                              ?>
                            <option value="" selected>Seleccione</option>
                            <?php foreach ($dataIncidencia as $key => $value): ?>
                                  <option value="<?php echo trim($value->id_articulo) ?>"> <?php echo $value->nombre_articulo ?></option>
                            <?php endforeach; ?>
                          </select>
                     </div>

                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Dosis  <span style="color:red">*</span> </label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm" name="dosis" value="" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Via  <span style="color:red">*</span> </label>
                <div class="col-sm-9">
                  <select  class="form-control form-control-sm    " name="id_via_dosis" style="width:100%" required>
                    <?php
                    $url = CurlController::api()."via?&select=*";
                    $method = "GET";
                    $fields = array();
                    $header = array();

                    $dataIncidencia= CurlController::request($url, $method, $fields, $header)->results;

                      ?>
                    <option value="" selected>Seleccione</option>
                    <?php foreach ($dataIncidencia as $key => $value): ?>
                          <option value="<?php echo trim($value->id_via) ?>"> <?php echo $value->descripcion ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Fecha Tratamiento  <span style="color:red">*</span> </label>
                <div class="col-sm-9">
                   <input type="date" class="form-control form-control-sm" name="fecha_tratamiento" value="" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hora  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                  <div class="input-group date" id="timepicker2" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input" name="hora_tratamiento"   required data-target="#timepicker2"/>
                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
                              <?php $tratamiento=new TableController();
                                    $tratamiento->registerTratamiento();

                               ?>
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
