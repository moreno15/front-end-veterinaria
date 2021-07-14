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
if (preg_match('/.*OK credit\(0\):(.*?)$/',$creditito,$match)==1) {

  $saldo=number_format($match[1]);
   if ($saldo>0) {

    $url = CurlController::api()."citas?select=*&linkTo=estado&equalTo=0";
    $method = "GET";
    $fields = array();
    $header = array();

		date_default_timezone_set("America/Lima");

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

                       $updateSendsms = CurlController::request($url2, $method2, $fields2, $header2)->results;
                       //enviar mensaje al Celular
                        $sDestino = $cliente->telefono_cliente;
                         $response = $altiriaSMS->sendSMS($sDestino, "Primer mensaje de prueba D");

                          if (!$response){
                              echo "El envío ha terminado en error";
                           }  else{
                              echo "ENVIO MENSAJE EXITOZAMENTE";
                            }
                      }
                    }
              }
          }
        }
    }
 }
}

?>
