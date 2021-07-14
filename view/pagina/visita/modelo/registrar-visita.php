<form class="form-horizontal"  method="post">
<div class="col-sm-12">
  <div class="card">
    <div class="card-body">
        <div class="row">

          <div class="col-sm-4">
           <label>Paciente</label>
            <div class="col-sm-12  mb-3 pl-0 ml-0">
               <div class="input-group  ">
                 <input type="hidden" readonly name="id_historia" id="id_historia" readonly class="form-control form-control-sm">
                   <input type="text" readonly name="nombre_paciente" id="nombre_paciente" class="form-control form-control-sm">
                   <span class="input-group-append">
                     <button type="button" class="btn btn-info btn-flat btn-sm" onclick="dataTable('cl-paciente2')" data-toggle="modal" data-target="#md-buscar-paciente" >Buscar</button>
                   </span>
             </div>
           </div>
          </div>

          <div class="col-sm-4">
             <!-- text input -->
             <div class="form-group">
               <label>Fecha consulta</label>
                <input type="date" class="form-control form-control-sm" name="fecha_consulta" value="<?php echo date('Y-m-d') ?>" >
             </div>
           </div>
           <div class="col-sm-12">
             <!-- text input -->
             <div class="form-group">
               <label>Motivo Consulta</label>
               <textarea name="motivo_consulta" class="form-control"  rows="2"  cols="80"  style="resize: none;"></textarea>
             </div>
           </div>
          <div class="col-sm-12">
             <!-- text input -->
             <div class="form-group">
               <label>Anamnesis</label>
               <textarea name="anamnesis" class="form-control"   rows="2" cols="80"  style="resize: none;"></textarea>
             </div>
           </div>

            <div class="col-sm-4">
               <!-- text input -->
               <div class="form-group">
                 <label>examen clinico</label>
                 <textarea name="examen_clinico" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
               </div>
             </div>

             <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>dx_presuntivo</label>
                <textarea name="dx_presuntivo" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                </div>
              </div>
              <div class="col-sm-4">
                 <!-- text input -->
                 <div class="form-group">
                   <label>Analisis requerido</label>
                  <textarea name="analisis_req" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                 </div>
               </div>
               <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>estudio imagen</label>
                     <textarea name="estudio_imagen" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                  </div>
                </div>
                <div class="col-sm-4">
                   <!-- text input -->
                   <div class="form-group">
                     <label>analisis clinico</label>
                      <textarea name="analisis_clinico" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                   </div>
                 </div>
                 <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                      <label>tratamiento clinico</label>
                       <textarea name="tratamiento_clinico" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <!-- text input -->
                     <div class="form-group">
                       <label>tratamiento casa</label>
                        <textarea name="tratamiento_casa" class="form-control" rows="2" cols="80"   style="resize: none;"></textarea>
                     </div>
                   </div>
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>otros</label>
                         <textarea class="form-control" name="otros" rows="2" cols="80"   style="resize: none;"></textarea>
                      </div>
                    </div>
           </div>
    </div>
  </div>
</div>
<?php include 'evaluacion.php'; ?>


<?php $visitas=new TableController();
      $visitas->registerVisita();

 ?>
<div class="col-sm-12">
 <div class="card">
   <div class="card-body">
     <div class="col-sm-2"  style="float:right">
       <button type="submit" class="btn btn-block btn-success btn-flat" name="button" >Guardar</button>
     </div>
   </div>
 </div>
</div>

</form>
