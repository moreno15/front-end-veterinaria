<div class="col-md-12">
            <div class="card card-purple collapsed-card">
              <div class="card-header">
                <h3 class="   card-title  " data-card-widget="collapse" style="cursor:pointer">Evaluacion Fisica(Opcional) </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <input type="hidden" name="" value="0">
                  <table class="table tb-evaluacion">
                      <tbody>
                        <tr>
                          <th>T°</th>
                          <th>FC</th>
                          <th>PUL</th>
                          <th>FR</th>
                          <th>PESO</th>
                          <th>CC</th>
                          <th>MUC</th>

                        </tr>
                        <tr>

                          <td> <input type="text" class="form-control form-control-sm" name="temperatura"  > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="frec_cardiaca" > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="pulso"  > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="frec_respiratoria" > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="peso" > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="conciencia" > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="mucosa"  > </td>
                        </tr>
                        <tr>
                            <th>COND.CORP.</th>
                          <th>LTC</th>
                          <th>%DSH</th>
                          <th>CCIA</th>
                          <th>LLENADO CAPILAR</th>
                          <th>FECHA</th>
                          <th>HORA EVAL.</th>
                        </tr>
                        <tr>
                          <td> <input type="text" class="form-control form-control-sm" name="condicion_corporal"  > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ltc"  > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ptje_dsh"  > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ccia" > </td>
                          <td> <input type="text" class="form-control form-control-sm" name="llenado_capilar"  > </td>
                          <td> <input type="date" class="form-control form-control-sm" name="fecha_evaluacion"  > </td>
                          <td>
                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                              <input type="text" class="form-control form-control-sm datetimepicker-input" name="hora_evaluacion"     data-target="#timepicker"/>
                              <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="far fa-clock"></i></div>
                              </div>
                              </div>
                          </td>
                        </tr>
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</div>
