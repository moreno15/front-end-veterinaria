<?php
$select = "*";
$url = CurlController::api()."historia?&select=*&linkTo=id_historia&equalTo=".$urlParams[2];
$method = "GET";
$fields = array();
$header = array();

$dataHistoria= CurlController::request($url, $method, $fields, $header);

if ($dataHistoria->status==200) {
  $dataHistoria=$dataHistoria->results;

  $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
  $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

  $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
  $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

  $url4 = CurlController::api()."raza?select=*&linkTo=id_raza&equalTo=".$dataPaciente[0]->id_raza_paciente ;
  $dataRaza= CurlController::request($url4, $method, $fields, $header)->results;

  $url5 = CurlController::api()."especie?select=*&linkTo=id_especie&equalTo=".$dataRaza[0]->id_especie_raza ;
  $dataEspecie= CurlController::request($url5, $method, $fields, $header)->results;



}else{
  echo '<script>

       window.location = "'.TemplateController::path().'internacion";
  </script>';
}

 ?>
<div class="col-lg-12  mt-3">
  <a href="<?php echo $path.'paciente' ?>" class="btn btn-outline-primary  btn-sm ml-3"> <span class="fa  fa-arrow-left"></span>ir listado Internamiento</a>

</div>
<div class="col-lg-12 mt-3" >
          <div class="info-box shadow">
                <div class="info-box-content " >
                  <div class="row">
                    <div class="col-lg-12">

                      <h4 > HISTORIA CLINICA DE: <?php echo  strtoupper($dataPaciente[0]->nombre_paciente) ?> </h4>
                    </div>

                    <div class="col-lg-12 m-0 p-0">
                      <table class=" table-bordered  " style="width:100%">
                        <tr>
                          <td> <strong>CLIENTE:</strong> </td>
                          <td> <?php echo  strtoupper($dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente)  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>SEXO:</strong> </td>
                          <td> <?php echo  strtoupper($dataPaciente[0]->sexo_paciente)  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>COLOR:</strong> </td>
                          <td> <?php echo  strtoupper($dataPaciente[0]->color_paciente)  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>ESPECIE:</strong> </td>
                          <td> <?php echo  strtoupper($dataEspecie[0]->nombre_especie)  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>RAZA:</strong> </td>
                          <td> <?php echo  strtoupper($dataRaza[0]->nombre_raza)  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>ESTERELIZADO:</strong> </td>
                          <td> <?php
                          $es=$dataPaciente[0]->esterilizado;
                          if ($es!="0") {
                            $rpt="SI";
                            $class='badge bg-success';
                          }else{
                            $rpt="NO";
                            $class='badge bg-danger';
                          }
                            echo  "<spa class='badge ".$class."' style='width:100px'>".$rpt."</span>"  ?></td>
                        </tr>
                        <tr>
                          <td> <strong>FECHA NACIMOIENTO:</strong> </td>
                          <td> <?php
                          $date = date_create($dataPaciente[0]->fecha_nacimiento);
                          $fechaActual=date('d-m-Y');

                          $firstDate  = new DateTime(date_format($date,'d-m-Y'));
                          $secondDate = new DateTime($fechaActual);
                          $intvl = $firstDate->diff($secondDate);

                           echo date_format($date,'d-m-Y');
                            ?></td>
                        </tr>
                        <tr>
                          <td> <strong>EDAD:</strong> </td>
                          <td> <?php
                          echo "<strong style='color:blue'>" .$intvl->y ." Años con ".$intvl->m." Meses y ".$intvl->d." días</strong>";


                            ?></td>
                        </tr>


                      </table>
                    </div>



                  </div>

                </div>
                <!-- /.info-box-content -->
          </div>
              <!-- /.info-box -->
</div>
<div class="col-lg-12">
  <input type="hidden" id="tipo5"  value="internamientoPaciente">
  <input type="hidden" id="tipo6"  value="vacunacion">
  <input type="hidden" id="tipo7"  value="visitasHitorial">
  <input type="hidden" id="id_historia"  value="<?php echo(trim($urlParams[2])) ?>">
   <?php
       include 'lista-visitas.php';
       include 'lista-internacion.php';
        include 'lista-vacunacion.php';

    ?>

</div>
