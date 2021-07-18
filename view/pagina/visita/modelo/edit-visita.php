<?php
$dataVisitas="";
if (isset($urlParams[2])) {
  $url = CurlController::api()."consulta?select=*&linkTo=id_consulta&equalTo=".$urlParams[2] ;

  $method = "GET";
  $fields = array();
  $header = array();
  $dataVisitas= CurlController::request($url, $method, $fields, $header)->results;

  $url2 = CurlController::api()."historia?select=*&linkTo=id_historia&equalTo=".$dataVisitas[0]->id_historia_consulta ;
  $dataHistoria= CurlController::request($url2, $method, $fields, $header)->results;

  $url3 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
  $dataPaciente= CurlController::request($url3, $method, $fields, $header)->results;

  $url4 = CurlController::api()."evaluacion_fisica?select=*&linkTo=id_consulta&equalTo=".$dataVisitas[0]->id_consulta ;
  $dataEvaluacion= CurlController::request($url4, $method, $fields, $header)->results;


  $fecha=date_create($dataVisitas[0]->fecha_consulta);
  $fecha_eval=date_create($dataEvaluacion[0]->fecha_evaluacion);
}

 ?>
 <h3>   <a  href="<?php echo $path."visitas/listado-visita" ?>" class="btn btn-outline-primary  btn-sm ml-3"> <span class="fa  fa-arrow-left"></span> ir listado Visita</a>Editar La Visita</h3>



<form class="form-horizontal"  method="post">

<div class="col-sm-12">
  <div class="card">
    <div class="card-body">
        <div class="row">

          <div class="col-sm-4">
           <label>Paciente <span style="color:red">*</span> </label>
            <div class="col-sm-12  mb-3 pl-0 ml-0">
               <div class="input-group  ">
                 <input type="hidden" name="id_evaluacion" value="<?=$dataEvaluacion[0]->id_evaluacion ?>">
                  <input type="hidden" readonly name="id_visita" id="id_visita" readonly  value="<?=$dataVisitas[0]->id_consulta  ?>" class="form-control form-control-sm">
                 <input type="hidden" readonly name="id_historia" id="id_historia" readonly value="<?=$dataHistoria[0]->id_historia ?>"  class="form-control form-control-sm">
                   <input type="text" readonly name="nombre_paciente" required id="nombre_paciente" value="<?=$dataPaciente[0]->nombre_paciente ?>"  class="form-control form-control-sm">

             </div>
           </div>
          </div>

          <!--<div class="col-sm-4">
             <div class="form-group">
               <label>Fecha consulta</label>
                <input type="date" class="form-control form-control-sm" name="fecha_consulta" value="<?= date_format($fecha,"Y-m-d") ?>" >
             </div>
           </div>-->
           <div class="col-sm-12">
             <!-- text input -->
             <div class="form-group">
               <label>Motivo Consulta <span style="color:red">*</span></label>
               <textarea name="motivo_consulta" class="form-control" rows="2" required cols="80"  style="resize: none;">  <?=trim($dataVisitas[0]->motivo_consulta ) ?></textarea>
             </div>
           </div>
          <div class="col-sm-12">
             <!-- text input -->
             <div class="form-group">
               <label>Anamnesis</label>
               <textarea name="anamnesis" class="form-control" rows="2" cols="80"  style="resize: none;">   <?=trim($dataVisitas[0]->anamnesis)  ?></textarea>
             </div>
           </div>

            <div class="col-sm-4">
               <!-- text input -->
               <div class="form-group">
                 <label>examen clinico</label>
                 <textarea name="examen_clinico" class="form-control"  rows="2" cols="80"   style="resize: none;">  <?=trim($dataVisitas[0]->examen_clinico ) ?></textarea>
               </div>
             </div>

             <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>dx_presuntivo</label>
                <textarea name="dx_presuntivo" class="form-control" rows="2" cols="80"   style="resize: none;">  <?=trim($dataVisitas[0]->dx_presuntivo) ?></textarea>
                </div>
              </div>
              <div class="col-sm-4">
                 <!-- text input -->
                 <div class="form-group">
                   <label>Analisis requerido</label>
                  <textarea name="analisis_req" class="form-control" rows="2" cols="80"   style="resize: none;">  <?=trim($dataVisitas[0]->analisis_req)  ?></textarea>
                 </div>
               </div>
               <div class="col-sm-4">
                  <!-- text input -->
                  <div class="form-group">
                    <label>estudio imagen</label>
                     <textarea name="estudio_imagen" class="form-control"   rows="2" cols="80"   style="resize: none;"><?=trim($dataVisitas[0]->estudio_imagen) ?></textarea>
                  </div>
                </div>
                <div class="col-sm-4">
                   <!-- text input -->
                   <div class="form-group">
                     <label>analisis clinico</label>
                      <textarea name="analisis_clinico" class="form-control"  rows="2" cols="80"   style="resize: none;"> <?=trim($dataVisitas[0]->analisis_clinico)  ?></textarea>
                   </div>
                 </div>
                 <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                      <label>tratamiento clinico</label>
                       <textarea name="tratamiento_clinico" class="form-control" rows="2" cols="80"   style="resize: none;">  <?=trim($dataVisitas[0]->tratamiento_clinico)  ?></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <!-- text input -->
                     <div class="form-group">
                       <label>tratamiento casa</label>
                        <textarea name="tratamiento_casa" class="form-control"  rows="2" cols="80"   style="resize: none;"><?=trim($dataVisitas[0]->tratamiento_casa)  ?> </textarea>
                     </div>
                   </div>
                   <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>otros</label>
                         <textarea class="form-control" name="otros" rows="2"  cols="80"   style="resize: none;"> <?=trim($dataVisitas[0]->otros)  ?></textarea>
                      </div>
                    </div>
           </div>
    </div>
  </div>
</div>
<?php include 'edit-evaluacion.php'; ?>
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
