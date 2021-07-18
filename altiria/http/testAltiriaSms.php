<?php

require_once "../../controller/curl.controller.php";

// Copyright (c) 2020, Altiria TIC SL

// XX, YY y ZZ se corresponden con los valores de identificacion del
// usuario en el sistema.
include('httpPHPAltiria.php');

$altiriaSMS = new AltiriaSMS();

$altiriaSMS->setLogin('ronald.27unsch@gmail.com');
$altiriaSMS->setPassword('cfhgqaay');

$altiriaSMS->setDebug(true);

$creditito=$altiriaSMS->getCredit();
	date_default_timezone_set("America/Lima");
if (preg_match('/.*OK credit\(0\):(.*?)$/',$creditito,$match)==1) {

  $saldo=number_format($match[1]);
   if ($saldo>0) {

     if (isset($_GET['data'])&&empty($_GET['data']) ) {



    $url = CurlController::api()."citas?select=*&linkTo=estado&equalTo=0";
    $method = "GET";
    $fields = array();
    $header = array();



      $resultsCitas = CurlController::request($url, $method, $fields, $header)->results;
      foreach ($resultsCitas as $key => $value) {
        $url = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$value->id_paciente;
        $resultsPaciente = CurlController::request($url, $method, $fields, $header)->results;

        foreach ($resultsPaciente as $key1 => $paciente) {

          $url = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$paciente->id_cliente_paciente;
          $resultsCliente= CurlController::request($url, $method, $fields, $header)->results;
          foreach ($resultsCliente as $key2 => $cliente) {

            $hora=explode(" ", $value->hora_cita);

            $horaCita=strtotime($hora[0]);
            $horaActual= strtotime(date('h:i'));

            $fecha_actual = strtotime(date("Y-m-d"));
            $fecha_entrada = strtotime($value->fecha_cita);

             if($fecha_actual == $fecha_entrada){
                if ($horaActual==$horaCita) {
                  // ACTUALIZAD SI SE ENVIO MENSAJE O NO
                  if ($value->send_sms=="0") {

                      $url2 = CurlController::api()."citas?id=".$value->id_citas."&nameId=id_citas";
                      $method2 = "PUT";
                      $fields2 =  "send_sms=1";

                       //$updateSendsms = CurlController::request($url2, $method2, $fields2, $header2)->results;
                       //enviar mensaje al Celular
                        /*$sDestino = $cliente->telefono_cliente;
                         $response = $altiriaSMS->sendSMS($sDestino, "Primer mensaje de prueba D");

                          if (!$response){
                              echo "El envío ha terminado en error";
                           }  else{
                              echo "ENVIO MENSAJE EXITOZAMENTE";
                            }*/
                            echo $horaActual."-".$horaCita;
                      }
                    }
              }
          }
        }
    }
  }else{
    $data=$_GET['data'];
    $idArray=explode("-",$data);

    $url = CurlController::api()."citas?select=*&linkTo=id_citas&equalTo=".trim($idArray[1]);
    $method = "GET";
    $fields = array();
    $header = array();
    $resultsCitas = CurlController::request($url, $method, $fields, $header)->results;

    $url2 = CurlController::api()."citas?token=prueba&id=".trim($idArray[1])."&nameId=id_citas";
    $method2 = "PUT";
    $fields2 =  "send_sms=1";
    $header2 = array();
     $updateSendsms = CurlController::request($url2, $method2, $fields2, $header2)->results;
     //enviar mensaje al Celular
     $fecha=date_create($resultsCitas[0]->fecha_cita);
     $fech=date_format($fecha,'d/m/Y');

     $mensaje="Tiene una cita pendiente en la clinica veterinaria San Cristobal el dia ". $fech." a las ". $resultsCitas[0]->hora_cita." en el servicio ".$resultsCitas[0]->servicio_cita;
      $sDestino =$idArray[0];
			if (is_numeric($sDestino)) {
			  $response = $altiriaSMS->sendSMS($sDestino,$mensaje);
			}else{
				$response=0;
			}


        if (!$response){
            echo "El envío ha terminado en error - ";
         }  else{
            echo "ENVIO MENSAJE EXITOZAMENTE - ";
          }

  }
 }//saldo
}

?>
