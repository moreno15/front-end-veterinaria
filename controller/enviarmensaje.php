<?php

 require_once "Contacto.php";
require_once "curl.controller.php";



    $fecaId=$_GET["id"];

    $idata=explode("-",$fecaId);

    $url = CurlController::api()."cliente?&select=*&linkTo=id_cliente&equalTo=".$idata[0] ;
    $method = "GET";
    $fields = array();
    $header = array();

    $dataCliente = CurlController::request($url, $method, $fields, $header)->results;

    $name=$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente;
    $subject="Recordatorio Cita Clinica San Cristobal";
    $message="hola ". $name  . " Tiene una cita recervada para  el dia ".$idata[1];

    $email=trim($dataCliente[0]->email_cliente);
    $url='http://sancritobal.com/';

    $contacto=new Contacto();
    $rpt=$contacto->enviarmensaje($name,$email,$subject,$message);
    echo $rpt ;

 ?>
