<?php
$select = "*";
$url = CurlController::api()."internamiento?&select=*&linkTo=id_internamiento&equalTo=".$urlParams[2];
$method = "GET";
$fields = array();
$header = array();

$dataInternamiento= CurlController::request($url, $method, $fields, $header);

if ($dataInternamiento->status==200) {
  $internamiento=$dataInternamiento->results;
  $url = CurlController::api()."historia?select=*&linkTo=id_historia&equalTo=".$internamiento[0]->id_historia_internamiento ;
  $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

  $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
  $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

  $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
  $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

  $fecha_internamiento=date_create($internamiento[0]->fecha_internamiento);
  $fecha_alta=date_create($internamiento[0]->fecha_alta);

  $fecha_actual = strtotime(date("d-m-Y",time()));
 $fecha_alt = strtotime($internamiento[0]->fecha_alta);

  if($fecha_actual >= $fecha_alt) {
    $color="red";

	}else {
		 $color="blue";
	}

}else{
  echo '<script>

     	window.location = "'.TemplateController::path().'internacion";
  </script>';
}

 ?>
<div class="col-lg-12  mt-3">
  <a href="<?php echo $path.'internacion' ?>" class="btn btn-outline-primary  btn-sm ml-3"> <span class="fa  fa-arrow-left"></span>ir listado Internamiento</a>

</div>
<div class="col-lg-12 mt-3" >
  <div class="col-md-12 col-sm-12 col-12 "  >
          <div class="info-box shadow">
                <div class="info-box-content " >
                  <div class="row">
                    <div class="col-lg-12">

                      <h4 > INTERNACIÓN DE: <?php echo  strtoupper($dataPaciente[0]->nombre_paciente) ?> </h4>
                      <hr>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>MOTIVO INTERNAMIENTO:</label>
                      <span  ><?php echo strtoupper( $internamiento[0]->motivo_internamiento) ?></span>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>CLIENTE:</label>
                      <span  ><?php echo  strtoupper($dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente)  ?></span>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>ALIMENTACIÓN:</label>
                      <span  ><?php echo  strtoupper($internamiento[0]->alimentacion) ?></span>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>OTROS:</label>
                      <span  ><?php echo  strtoupper($internamiento[0]->otros)  ?></span>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>FECHA INTERNACÓN:</label>
                      <span  ><?php echo  date_format($fecha_internamiento,"d/m/Y")  ?></span>
                    </div>
                    <div class="col-lg-4 m-0 p-0">
                      <label>FECHA ALTA:</label>
                      <span style="color:<?=$color ?> "><?php echo   date_format($fecha_alta,"d/m/Y").' '.$internamiento[0]->hora_alta  ?></span>
                    </div>

                  </div>

                </div>
                <!-- /.info-box-content -->
          </div>
              <!-- /.info-box -->
   </div>
</div>

<div class="col-lg-12">
  <form class="form ">
   <?php
       include 'tratamiento.php';
       include 'evaluacion.php';
      include 'incidencia.php';


    ?>
    </form>

</div>
