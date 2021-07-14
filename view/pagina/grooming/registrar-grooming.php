<div class="col-md-4" >
  <div class="card">
    <div class="card-body">
      <form class="form-horizontal   " method="post"  >
              <div class="form-group ">
                <label for="" class="  col-form-label">Paciente</label>
                <div class=" ">
                  <div class="input-group   ">
                    <input type="hidden" name="id_citas" id="id_citas"  class="form-control form-control-sm" >
                      <input type="hidden" name="idpaciente" id="idpaciente" class="form-control form-control-sm">
                      <input type="text" name="nombre_cliente" id="nombre_paciente" class="form-control form-control-sm" readonly>
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat btn-sm" onclick="dataTable('cl-paciente2')" data-toggle="modal" data-target="#md-buscar-paciente" >Buscar</button>
                      </span>
                    </div>
                </div>
              </div>

              <div class="form-group">
                        <label>Servicios</label>
                        <select multiple="" name="servicio[]" class="custom-select">
                          <option value="Baño" >Baño</option>
                          <option value="Corte" >Corte</option>
                        </select>
                </div>


              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label " style="float:left">Nota:</label>
                <div class="col-sm-9" style="float:left">
                      <textarea name="descripcion" rows="2" cols="80"  style="resize:none" class="form-control form-control-sm"></textarea>
                </div>
              </div>

              <?php $citas=new TableController();
                    $citas->registerGrooming();

               ?>
              <div class="col-lg-12">
                   <div class="col-lg-12"     >
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
