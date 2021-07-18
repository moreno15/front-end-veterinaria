
      <div class="modal fade" id="md-evaluacion">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro de evaluacion fisica</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="form-evalu"  method="post">
            <div class="modal-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Temperatura </label>
                <div class="col-sm-9">
                  <input type="hidden" name="valid" id="valid"  >
                  <input type="hidden"  name="id_internamiento"  value="<?php echo $internamiento[0]->id_internamiento ?>">
                   <input type="text" class="form-control form-control-sm" name="temperatura" >
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Frec.Cardiaca</label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm"  name="frecuencia_card"  >
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Frec.Repiratoria</label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm"  name="frecuencia_resp"  >
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Fecha Evaluacion  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                   <input type="date" class="form-control form-control-sm"required  name="fecha_control" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hora  <span style="color:red">*</span>  </label>
                <div class="col-sm-9">
                  <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input" required  name="hora_control"  data-target="#timepicker"/>
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                    </div>
                </div>
              </div>

            </div>
            <?php $evaluacion=new TableController();
                  $evaluacion->registerEvaluacion();

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
