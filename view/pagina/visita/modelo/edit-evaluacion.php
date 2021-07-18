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

                          <td> <input type="text" class="form-control form-control-sm" name="temperatura" value="<?=$dataEvaluacion[0]->temperatura ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="frec_cardiaca" value="<?=$dataEvaluacion[0]->frec_cardiaca ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="pulso" value="<?=$dataEvaluacion[0]->pulso ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="frec_respiratoria" value="<?=$dataEvaluacion[0]->frec_respiratoria ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="peso" value="<?=$dataEvaluacion[0]->peso ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="conciencia" value="<?=$dataEvaluacion[0]->conciencia ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="mucosa" value="<?=$dataEvaluacion[0]->mucosa ?>"> </td>
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
                          <td> <input type="text" class="form-control form-control-sm" name="condicion_corporal" value="<?=$dataEvaluacion[0]->condicion_corporal ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ltc" value="<?=$dataEvaluacion[0]->ltc ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ptje_dsh" value="<?=$dataEvaluacion[0]->ptje_dsh ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="ccia" value="<?=$dataEvaluacion[0]->ccia ?>"> </td>
                          <td> <input type="text" class="form-control form-control-sm" name="llenado_capilar" value="<?=$dataEvaluacion[0]->llenado_capilar ?>"> </td>
                          <td> <input type="date" class="form-control form-control-sm" name="fecha_evaluacion" value="<?= date_format($fecha_eval,"Y-m-d")  ?>"> </td>
                          <td>
                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                              <input type="text" class="form-control form-control-sm datetimepicker-input" name="hora_evaluacion"  value="<?=$dataEvaluacion[0]->hora_evaluacion ?>"  data-target="#timepicker"/>
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
