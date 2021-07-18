<div id="menuCapa"  class="dropdown-menu" role="menu" style="">
      <a class="dropdown-item"  style="cursor:pointer" onclick="contexMenu(),dataTable('cl-paciente')"  data-toggle="modal" data-target="#md-buscar-cita"  href="#">Buscar Cita</a>
      <a class="dropdown-item"   style="cursor:pointer"  onclick="contexMenu(),dataTable('cl-paciente2')"   data-toggle="modal" data-target="#md-buscar-paciente" >Buscar Paciente</a>

  </div>
<div class="col-md-4" >
  <div class="card">
    <div class="card-body form-grooming">
      <form class="form-horizontal   " id="form-grooming" method="post"  >
              <div class="form-group ">
                <label for="" class="  col-form-label">Paciente</label>
                <div class=" ">
                  <div class="input-group   ">
                    <input type="hidden" name="id_grooming" id="id_grooming">

                    <input type="hidden" name="id_citas" id="id_citas"  class="form-control form-control-sm" >
                      <input type="hidden" name="idpaciente" id="idpaciente" class="form-control form-control-sm">
                      <input type="text" name="nombre_paciente" id="nombre_paciente" class="form-control form-control-sm" readonly>
                      <span class="input-group-append">
                        <button type="button" id="btnbuscarPc" class="btn btn-info btn-flat btn-sm" onclick="dataTable('cl-paciente2')" data-toggle="modal" data-target="#md-buscar-paciente" >Buscar</button>
                      </span>
                    </div>
                </div>
              </div>

              <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control form-control-sm" readonly>

              <div class="form-group">
                        <label>Servicios</label>
                        <select multiple="" name="servicio[]" class="custom-select" required>
                          <option value="Baño" >Baño</option>
                          <option value="Corte" >Corte</option>
                        </select>
                </div>


              <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label " style="float:left">Descripción:</label>
                <div class="col-sm-9" style="float:left">
                      <textarea name="descripcion" id="descripcion" rows="2" cols="80"  style="resize:none" class="form-control form-control-sm"></textarea>
                </div>
              </div>

              <?php $grooming=new TableController();
                    $grooming->registerGrooming();

               ?>
              <div class="col-lg-12">
                   <div class="col-lg-12"     >
                    <button type="submit"class="btn btn-success btn-flat"  >
                      <span class="fa fa-plus-circle"></span>
                      Guardar</button>
                      <button type="button" onclick="viewBuacsrPc()"  class="btn btn-warning btn-flat"  >

                        Nuevo</button>

                  </div>
              </div>
        </form>
        <!-- /.col -->
      </div>
    </div>
</div>
