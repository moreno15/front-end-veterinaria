
      <div class="modal fade" id="md-incidencia">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registrar Incidencia</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class=""   method="post">
            <div class="modal-body">
              <div class="form-group row">
                <input type="hidden" name="id_internamiento" value="<?=$internamiento[0]->id_internamiento ?>">
                <label for="" class="col-sm-3 col-form-label">Incidencia  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                    <select  class="form-control form-control-sm" name="id_incidencia_inter_incid" required>
                      <?php
                      $url = CurlController::api()."incidencia?&select=*";
                      $method = "GET";
                      $fields = array();
                      $header = array();

                      $dataIncidencia= CurlController::request($url, $method, $fields, $header)->results;

                        ?>
                      <option value="" selected>Seleccione</option>
                      <?php foreach ($dataIncidencia as $key => $value): ?>
                            <option value="<?php echo trim($value->id_incidencia) ?>"> <?php echo $value->descripcion ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Nota</label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm" name="nota" >
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Fecha Evaluacion  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                   <input type="date" class="form-control form-control-sm" name="fecha_registro" required >
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hora  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                  <div class="input-group date" id="timepicker3" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input" required name="hora_ragistro"  data-target="#timepicker3"/>
                    <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                    </div>
                </div>
              </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <?php $incidencia=new TableController();
                  $incidencia->registerIncidencia();

             ?>
          </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
