
      <div class="modal fade" id="md-tratamiento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro de Tratamientos</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form class="" action="index.html" method="post">
            <div class="modal-body">
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Medicamento</label>
                <div class="col-sm-9">
                      <div class="input-group  ">
                          <input type="text" name="dni_cliente" id="dni_cliente" class="form-control form-control-sm">
                          <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#md-buscar-paciente" >Buscar Medicamento</button>
                          </span>
                     </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Dosis</label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm" name="" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Via</label>
                <div class="col-sm-9">
                   <input type="text" class="form-control form-control-sm" name="" value="">
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hora</label>
                <div class="col-sm-9">
                  <div class="input-group date" id="timepicker2" data-target-input="nearest">
                    <input type="text" class="form-control form-control-sm datetimepicker-input"    data-target="#timepicker2"/>
                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                    </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Fecha Evaluacion</label>
                <div class="col-sm-9">
                   <input type="date" class="form-control form-control-sm" name="" value="">
                </div>
              </div>


            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-success">Guardar</button>
            </div>
          </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
