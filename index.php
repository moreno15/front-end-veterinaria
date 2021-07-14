<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once "controller/templateController.php";
require_once "controller/curl.controller.php";
//require_once "controller/user.controller.php";
//require_once "controller/checkout.controller.php";
//require_once "controller/vendors.controller.php";
require_once "controller/table.controller.php";


require_once "extension/vendor/autoload.php";

$index = new TemplateController();
$index->index();
