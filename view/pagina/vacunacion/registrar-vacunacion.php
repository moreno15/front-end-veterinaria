<div class="col-md-12" >
  <div class="card">
    <div class="card-body ">
      <form class="form-horizontal   " method="post"  >
              <div class="form-group col-md-4 m-0 p-0">
                <label for="" class="  col-form-label">Paciente</label>
                <div class=" ">
                  <div class="input-group   ">
                    <input type="hidden" name="id_citas" id="id_citas"  class="form-control form-control-sm" >
                    <input type="hidden" name="id_historia" id="id_historia" value="">
                      <input type="hidden" name="idpaciente" id="idpaciente" class="form-control form-control-sm">
                      <input type="text" name="nombre_paciente" id="nombre_paciente" class="form-control form-control-sm" readonly>
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat btn-sm" onclick="dataTable('cl-paciente2')" data-toggle="modal" data-target="#md-buscar-paciente" >Buscar</button>
                      </span>
                    </div>
                </div>
              </div>
              <div class="form-group row   m-0 p-0 mt-3">
                <div class="col-md-12   m-0 p-0">
                  <label for="">Enfermedad</label>
                  <hr>
                </div>
                        <div class="col-md-4">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="parvovirus" id="chek_1"  value="1">
                            <label for="chek_1"  class="custom-control-label">parvovirus</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="coronavirus"  id="chek_2" value="1">
                            <label for="chek_2"  class="custom-control-label">coronavirus</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="distemper"  id="chek_3"  value="1">
                            <label for="chek_3"   class="custom-control-label">distemper</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="hepatitis"   id="chek_4"  value="1">
                            <label for="chek_4"  class="custom-control-label">hepatitis</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="parainflueza"   id="chek_5"  value="1">
                            <label for="chek_5"  class="custom-control-label">parainflueza</label>
                          </div>
                        </div>
                        <div class="col-md-4">

                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="l_canicola"    id="chek_6" value="1">
                            <label for="chek_6"  class="custom-control-label">L. canicola</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="l_icterohaemorrag"   id="chek_7"  value="1">
                            <label for="chek_7"  class="custom-control-label">L.icterohaemorragiae</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="l_grippotyphosa" id="chek_8"   value="1">
                            <label for="chek_8" class="custom-control-label">L.grippotyphosa</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="l_pomona"  id="chek_9" value="1">
                            <label for="chek_9" class="custom-control-label">L.pomona</label>
                          </div>
                        </div>

                        <div class="col-md-4">

                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="rabia"  id="chek_10" value="1">
                            <label for="chek_10" class="custom-control-label">rabia</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="rinotraqueitis"  id="chek_11"  value="1">
                            <label for="chek_11" class="custom-control-label">rinotraqueitis</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"  name="panleucopenia"  id="chek_12" value="1">
                            <label for="chek_12" class="custom-control-label">panleucopenia</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="calcivirus"  id="chek_13"  value="1">
                            <label for="chek_13" class="custom-control-label">calcivirus</label>
                          </div>

                        </div>
                      <div class="col-lg-12 m-0 p-0">
                          <hr>
                      </div>
                </div>

              <div class="form-group  row  m-0 p-0">
                <div class="col-md-4 m-0 p-0">
                  <label for="" class="col-sm-12 col-form-label " style="float:left">Fecha programada:</label>
                  <div class="col-sm-12" style="float:left">
                        <input type="date" name="fecha_programada" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="form-group col-md-4 m-0 p-0">
                  <label for="" class="col-sm-12 col-form-label " style="float:left">Fecha Aplicada:</label>
                  <div class="col-sm-12" style="float:left">
                        <input type="date"name="fecha_aplicada"  class="form-control form-control-sm">
                  </div>
                </div>
                <div class="form-group  col-md-4   m-0 p-0">
                  <label for="" class="col-sm-12 col-form-label  " style="float:left">Veterinario:</label>
                  <div class="col-sm-12" style="float:left">
                         <select class="form-control form-control-sm " name="id_veterinario">
                           <?php
                           $url = CurlController::api()."veterinario?&select=*";
                           $method = "GET";
                           $fields = array();
                           $header = array();

                           $dataVterinario= CurlController::request($url, $method, $fields, $header)->results;

                             ?>
                           <?php foreach ($dataVterinario as $key => $value): ?>
                                 <option value="<?php echo trim($value->id_veterinario) ?>"> <?php echo $value->nombre_veterinario ?></option>
                           <?php endforeach; ?>
                         </select>
                  </div>
                </div>

              </div>



              <?php $vacunacion=new TableController();
                    $vacunacion->registerVacunacion();

               ?>
              <div class="row p-3">
                <div class="col-lg-12">
                      <button type="submit"class="btn btn-success btn-flat"  >
                        <span class="fa fa-plus-circle"></span>
                        Agregar</button>

                </div>
              </div>
        </form>
        <!-- /.col -->
      </div>
    </div>
</div>
