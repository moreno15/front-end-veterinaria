<?php

	$url="https://dniruc.apisperu.com/api/v1/dni/".$_GET['dni']."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJvbmFsZC4yN3Vuc2NoQGdtYWlsLmNvbSJ9.A5skM32ygnSTr5WqUErUkZWhhIE-TFgmesaF7uUW84g";

  //$response = CurlController::request($url, $method, $fields, $header);
  $dato=  file_get_contents($url);

   echo $dato;


 ?>
