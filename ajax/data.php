<?php

require_once "../controller/curl.controller.php";
require_once "../controller/templateController.php";


class DataTableController{

	/*=============================================
	Función DataTable
	=============================================*/

	public function data(){
		date_default_timezone_set("America/Lima");
		if ($_GET["tipo"]=='cliente') {

			if (!empty($_POST)){

 			 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

 			 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

 			 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
 			 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
 			 $start  = $_POST["start"];//Indicador de primer registro de paginación.
 			 $length = $_POST['length'];//Indicador de la longitud de la paginación.

 			 /*=============================================
 							Traer el total de la data de cliente
 							=============================================*/

 							$select = "id_cliente";

 							$url = CurlController::api()."cliente?select=".$select;

 							$method = "GET";
 						 $fields = array();
 						 $header = array();

 							$totalData = CurlController::request($url, $method, $fields, $header);
 							 $data = array();
 							if ($totalData->status==404) {
 								$results = array(
 									 "sEcho"=>$draw, //Información para el datatables
 									 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 									 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 									 "aaData"=>$data);

 								 echo json_encode($results);
 								return;
 							}else{
 								$totalData=$totalData->total;
 							}

 							/*=============================================
 							Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
 							=============================================*/

 							$select = "id_cliente,nombre_cliente,apellido_cliente,dni_cliente,telefono_cliente,direccion_cliente,email_cliente";

 							/*=============================================
 							Cuando se usa el buscador de DataTable
 							=============================================*/

 							if(!empty($_POST['search']['value'])){

 									$linkTo = ["nombre_cliente","apellido_cliente","telefono_cliente","dni_cliente"];

 									$search = str_replace(" ", "_", $_POST['search']['value']);

 									foreach ($linkTo as $key => $value) {

 										 $url = CurlController::api()."cliente?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

 										 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

 											if($searchTable == "Not Found"){

 												$dataTable = array();

 											}else{
 													$dataTable = $searchCliente;
 													$recordsFiltered = count($dataTable);

 													break;

 											}
 									}

 							}else{

 									$url = CurlController::api()."cliente?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

 									$dataTable = CurlController::request($url, $method, $fields, $header)->results;

 									$recordsFiltered = $totalData;

 							}

 				/*=============================================
 									 Verificamos que la tabla no venga vacía
 				 =============================================*/
 			if(count($dataTable) == 0){

 					 $results = array(
 							 "sEcho"=>$draw, //Información para el datatables
 							 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 							 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 							 "aaData"=>$data);

 						 echo json_encode($results);
 		 }

		 		if ($dataTable!="Not Found") {

		 			 foreach ($dataTable as $key => $value) {
		 				 /*=============================================
		 				 Actions
		 				 =============================================*/

		 			 $actions = "<div class='btn-group'>

		 												 <a href='".TemplateController::path().'cliente/'.$value->id_cliente."' target='_blank' class='btn btn-info rounded-circle mr-2' >

		 														 <i class='fas fa-eye' style='font-size:12px'></i>

		 												 </a>

		 												 <a href='".TemplateController::path()."cliente/edit-cliente/".$value->id_cliente."' class='btn btn-warning rounded-circle mr-2'>

		 														 <i class='fas fa-pencil-alt' style='font-size:12px'></i>

		 												 </a>

		 												 <a type='button' class='btn btn-danger rounded-circle text-white' onclick='removeProduct(".$value->id_cliente.")'>

		 														 <i class='fas fa-trash' style='font-size:12px'></i>

		 												 </a>

		 								 </div>";

		 			 //	$actions =  TemplateController::htmlClean($actions);

		 								 $data[]=array(
		 									 "id_cliente"=>$value->id_cliente,
		 									 "accion"=>  $actions,
		 									 "nombre_cliente"=>$value->nombre_cliente,
		 									 "apellido_cliente"=> $value->apellido_cliente,
		 									 "dni_cliente"=>$value->dni_cliente,
		 									 "email_cliente"=>$value->email_cliente,
		 									 "telefono_cliente"=>$value->telefono_cliente,
		 									 "direccion_cliente"=>$value->direccion_cliente,

		 									 );
		 							 }// fin for

		 							 $results = array(
		 									"sEcho"=>$draw, //Información para el datatables
		 								 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
		 								 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
		 								 "aaData"=>$data);
		 							 echo json_encode($results);
		 			}else{
		 						 $results = array(
		 							 "sEcho"=>$draw, //Información para el datatables
		 								"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
		 								"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
		 								"aaData"=>$data);
		 							echo json_encode($results);
		 			 }

 		 }// if post


		}

		// paciente ------------------------------------------------------------------------------------
		if ($_GET['tipo']=='paciente') {

 		 			if (!empty($_POST)){

 		  			 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

 		  			 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

 		  			 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
 		  			 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
 		  			 $start  = $_POST["start"];//Indicador de primer registro de paginación.
 		  			 $length = $_POST['length'];//Indicador de la longitud de la paginación.

 		  			 /*=============================================
 		  							Traer el total de la data de cliente
 		  							=============================================*/

 		  							$select = "id_paciente";

 		  							$url = CurlController::api()."paciente?select=".$select;

 		  							$method = "GET";
 		  						 $fields = array();
 		  						 $header = array();

 		  							$totalData = CurlController::request($url, $method, $fields, $header);
 		  							 $data = array();
 		  							if ($totalData->status==404) {
 		  								$results = array(
 		  									 "sEcho"=>$draw, //Información para el datatables
 		  									 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  									 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 		  									 "aaData"=>$data);

 		  								 echo json_encode($results);
 		  								return;
 		  							}else{
 		  								$totalData=$totalData->total;
 		  							}

 		  							/*=============================================
 		  							Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
 		  							=============================================*/
										   $select ='id_paciente,nombre_paciente,fecha_nacimiento,sexo_paciente, color_paciente, esterilizado,foto_paciente,id_raza_paciente,id_cliente_paciente';

 		  							/*=============================================
 		  							Cuando se usa el buscador de DataTable
 		  							=============================================*/

 		  							if(!empty($_POST['search']['value'])){

 		  									$linkTo = ["nombre_paciente"];

 		  									$search = str_replace(" ", "_", $_POST['search']['value']);

 		  									foreach ($linkTo as $key => $value) {

 		  										 $url = CurlController::api()."paciente?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

 		  										 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

 		  											if($searchTable == "Not Found"){

 		  												$dataTable = array();

 		  											}else{
 		  													$dataTable = $searchCliente;
 		  													$recordsFiltered = count($dataTable);

 		  													break;

 		  											}
 		  									}

 		  							}else{

 		  									$url = CurlController::api()."paciente?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
 		  									$dataTable = CurlController::request($url, $method, $fields, $header)->results;
 		  									$recordsFiltered = $totalData;

 		  							}

 		  				/*=============================================
 		  									 Verificamos que la tabla no venga vacía
 		  				 =============================================*/
 		  			if(count($dataTable) == 0){

 		  					 $results = array(
 		  							 "sEcho"=>$draw, //Información para el datatables
 		  							 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  							 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 		  							 "aaData"=>$data);

 		  						 echo json_encode($results);
 		  		 }

 		  		if ($dataTable!="Not Found") {

 		  			 foreach ($dataTable as $key => $value) {
 		  				 /*=============================================
 		  				 Actions
 		  				 =============================================*/

 		  			 $actions = "<div class='btn-group'>

 		  												 <a href='".TemplateController::path().'paciente/'.$value->id_paciente."' target='_blank' class='btn btn-info rounded-circle mr-2' >

 		  														 <i class='fas fa-eye' style='font-size:12px'></i>

 		  												 </a>

 		  												 <a href='".TemplateController::path()."paciente/edit-cliente/".$value->id_paciente."' class='btn btn-warning rounded-circle mr-2'>

 		  														 <i class='fas fa-pencil-alt' style='font-size:12px'></i>

 		  												 </a>

 		  												 <a type='button' class='btn btn-danger rounded-circle text-white' onclick='removeProduct(".$value->id_paciente.")'>

 		  														 <i class='fas fa-trash' style='font-size:12px'></i>

 		  												 </a>

 		  								 </div>";

 		  			 //	$actions =  TemplateController::htmlClean($actions);
						 if ($value->esterilizado!="0") {
							 $rpt="Si";
						 	 $class='badge bg-success';
						 }else{
							 $rpt="No";
							 $class='badge bg-danger';
						 }

											$date = date_create($value->fecha_nacimiento);
											$fechaActual=date('d-m-Y');

											$firstDate  = new DateTime(date_format($date,'d-m-Y'));
											$secondDate = new DateTime($fechaActual);
											$intvl = $firstDate->diff($secondDate);

											$edad= "<strong style='color:blue'>" .$intvl->y ." Años con ".$intvl->m." Meses y ".$intvl->d." días</strong>";

 		  								 $data[]=array(
 		  									 "id_paciente"=>$value->id_paciente,
 		  									 "accion"=>  $actions,
												 "foto_paciente"=>$value->foto_paciente,
 		  									 "nombre_paciente"=>$value->nombre_paciente ,
												 "edad"=>$edad,
 		  									 "fecha_nacimiento"=>date_format($date,'d-m-Y'),
 		  									 "sexo_paciente"=> $value->sexo_paciente,
 		  									 "esterilizado"=>"<spa class='badge ".$class."' style='width:100px'>".$rpt."</span>",

 		  									 );
 		  							 }// fin for

 		  							 $results = array(
 		  									"sEcho"=>$draw, //Información para el datatables
 		  								 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  								 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 		  								 "aaData"=>$data);
 		  							 echo json_encode($results);
 		  			}else{
 		  						 $results = array(
 		  							 "sEcho"=>$draw, //Información para el datatables
 		  								"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  								"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
 		  								"aaData"=>$data);
 		  							echo json_encode($results);
 		  			 }

 		  		 }// if post

		}


		// citas recervados cita------------------------------------------------------------------------------------
		if ($_GET['tipo']=='cl-paciente') {

					if (!empty($_POST)){

						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

						 /*=============================================
										Traer el total de la data de cliente
										=============================================*/

										$select = "id_citas";

										$url = CurlController::api()."citas?select=".$select ."&linkTo=estado&equalTo=0";

										$method = "GET";
									 $fields = array();
									 $header = array();

										$totalData = CurlController::request($url, $method, $fields, $header);
										 $data = array();
										if ($totalData->status==404) {
											$results = array(
												 "sEcho"=>$draw, //Información para el datatables
												 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
												 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
												 "aaData"=>$data);

											 echo json_encode($results);
											return;
										}else{
											$totalData=$totalData->total;
										}

										/*=============================================
										Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
										=============================================*/

										$select ='id_citas,fecha_cita,hora_cita,cliente_cita,servicio_cita,estado,id_paciente,send_sms';
										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["cliente_cita"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."citas?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select ."&linkTo=estado&equalTo=0";

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchCliente;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."citas?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=estado&equalTo=0" ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;

										}

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
										 "aaData"=>$data);

									 echo json_encode($results);
					 }

					if ($dataTable!="Not Found") {

						 foreach ($dataTable as $key => $value) {

							 $url = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$value->id_paciente ;
							 $dataPaciente= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url2, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."historia?select=*&linkTo=id_paciente_historia&equalTo=".$value->id_paciente ;
							 $dataHistoria= CurlController::request($url2, $method, $fields, $header)->results;


							 /*=============================================
							 Actions
							 =============================================*/
							 $cliente=$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente;
							 $paciente="'".trim($value->id_citas)."-". trim($value->id_paciente)."-".$dataPaciente[0]->nombre_paciente."-".$cliente."-".$dataHistoria[0]->numero_historia."'";

							 $actions = '<div class="btn-group">

																		 <a    onclick="agregarPacienteGrooming('.$paciente.')"  class="btn btn-success btn-xs"    >

																				 <i class="fas fa-plus-circle" style="font-size:12px"></i> Agregar

																		 </a>

											 </div>';
											 $fecha=date_create($value->fecha_cita);

				               $fech=date_format($fecha,'d/m/Y');

												 $data[]=array(
													"id_citas"=>$value->id_citas,
													"accion"=>  $actions,
													"cliente"=>$cliente,
													"nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
													"servicio_cita"=>$value->servicio_cita,
													"fecha_cita"=> $fech." " .$value->hora_cita
													);

										 }// fin for

										 $results = array(
												"sEcho"=>$draw, //Información para el datatables
											 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											 "aaData"=>$data);


										 echo json_encode($results);
						}else{
									 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
											"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											"aaData"=>$data);
										echo json_encode($results);
						 }

					 }// if post

		}

		// listado de paciente total------------------------------------------------------------------------------------
		if ($_GET['tipo']=='cl-paciente2') {

					if (!empty($_POST)){

						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

						 /*=============================================
										Traer el total de la data de cliente
										=============================================*/

										$select = "id_paciente";

										$url = CurlController::api()."paciente?select=".$select;

										$method = "GET";
									 $fields = array();
									 $header = array();

										$totalData = CurlController::request($url, $method, $fields, $header);
										 $data = array();
										if ($totalData->status==404) {
											$results = array(
												 "sEcho"=>$draw, //Información para el datatables
												 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
												 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
												 "aaData"=>$data);

											 echo json_encode($results);
											return;
										}else{
											$totalData=$totalData->total;
										}

										/*=============================================
										Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
										=============================================*/

										$select ='id_paciente,nombre_paciente,id_cliente_paciente';

										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["nombre_paciente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."paciente?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchCliente;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."paciente?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;

										}

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
										 "aaData"=>$data);

									 echo json_encode($results);
					 }

					if ($dataTable!="Not Found") {

						 foreach ($dataTable as $key => $value) {

							 $url = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$value->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."historia?select=*&linkTo=id_paciente_historia&equalTo=".$value->id_paciente ;
							 $dataHistoria= CurlController::request($url2, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/
							 $cliente=$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente;

							 $paciente="'"."-".trim($value->id_paciente)."-".$value->nombre_paciente."-".$cliente."-".$dataHistoria[0]->numero_historia."'";

							 $actions = '<div class="btn-group">

															 <a    onclick="agregarPacienteGrooming('.$paciente.')"  class="btn btn-success  btn-xs" >

																	 <i class="fas fa-plus-circle" style="font-size:12px"></i> Agregar

															 </a>

											 </div>';

											 $data[]=array(
												 "id_paciente"=>$value->id_paciente,
												 "accion"=>  $actions,
												 "cliente"=>'<span class="badge bg-primary">'. $cliente .'</span>',
												 "nombre_paciente"=>$value->nombre_paciente


												 );
										 }// fin for

										 $results = array(
												"sEcho"=>$draw, //Información para el datatables
											 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											 "aaData"=>$data);
										 echo json_encode($results);
						}else{
									 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
											"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											"aaData"=>$data);
										echo json_encode($results);
						 }

					 }// if post

		}

		// listado de paciente total------------------------------------------------------------------------------------
		if ($_GET['tipo']=='grooming') {

					if (!empty($_POST)){

						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

						 /*=============================================
										Traer el total de la data de cliente
										=============================================*/

										$select = "id_grooming";

										$url = CurlController::api()."grooming?&select=".$select;

										$method = "GET";
									 $fields = array();
									 $header = array();

										$totalData = CurlController::request($url, $method, $fields, $header);
										 $data = array();
										if ($totalData->status==404) {
											$results = array(
												 "sEcho"=>$draw, //Información para el datatables
												 "iTotalRecords"=>0, //enviamos el total registros al datatable
												 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
												 "aaData"=>$data);

											 echo json_encode($results);
											return;
										}else{
											$totalData=$totalData->total;
										}

										/*=============================================
										Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
										=============================================*/

										$select ='id_grooming,id_paciente,descripcion,fecha_registro,estado';
										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["nombre_paciente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."grooming?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchCliente;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."grooming?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;

										}

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
										 "aaData"=>$data);

									 echo json_encode($results);
					 }

					if ($dataTable!="Not Found") {

						 foreach ($dataTable as $key => $value) {

							 $url = CurlController::api()."detalle_grooming?select=*&linkTo=id_grooming&equalTo=".$value->id_grooming ;
							 $dataDetalle= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$value->id_paciente ;
							 $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

							 $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/
							 $serv="";
							 foreach ($dataDetalle as $key => $val) {
							 	 $serv.=$val->tipo_grooming.",";
							 }

							 $serv = substr($serv, 0, -1);

							 $actions = '<div class="btn-group">

															 <a    onclick="agregarPacienteGrooming('.$value->id_grooming.')"  class="btn btn-success  btn-xs" >

																	 <i class="fas fa-plus-circle" style="font-size:12px"></i> Finalizar

															 </a>

											 </div>';

											 //	$actions =  TemplateController::htmlClean($actions);
											 if ($value->estado!="0") {
												 $rpt="Finalizado";
												 $class='badge bg-success';
											 }else{
												 $rpt="Pendiente";
												 $class='badge bg-danger';
											 }

											 $fecha=date_create($value->fecha_registro);
											 $data[]=array(
												 "id_grooming"=>$value->id_grooming,
												 "accion"=>  $actions,
												 "cliente"=>$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente,
												 "nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
												 "servicio"=>$serv,
												 "estado"=>"<spa class='badge ".$class."' style='width:100px'>".$rpt."</span>",
												 "descripcion"=>$value->descripcion,
												  "fecha"=>date_format($fecha,"d/m/Y"),

												 );
										 }// fin for

										 $results = array(
												"sEcho"=>$draw, //Información para el datatables
											 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											 "aaData"=>$data);
										 echo json_encode($results);
						}else{
									 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
											"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											"aaData"=>$data);
										echo json_encode($results);
						 }

					 }// if post

		}

		// listado de paciente total------------------------------------------------------------------------------------
		if ($_GET['tipo']=='visitas') {

					if (!empty($_POST)){

						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

						 /*=============================================
										Traer el total de la data de cliente
										=============================================*/

										$select = "id_consulta";

										$url = CurlController::api()."consulta?&select=".$select;

										$method = "GET";
									 $fields = array();
									 $header = array();

										$totalData = CurlController::request($url, $method, $fields, $header);
										 $data = array();
										if ($totalData->status==404) {
											$results = array(
												 "sEcho"=>$draw, //Información para el datatables
												 "iTotalRecords"=>0, //enviamos el total registros al datatable
												 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
												 "aaData"=>$data);

											 echo json_encode($results);
											return;
										}else{
											$totalData=$totalData->total;
										}

										/*=============================================
										Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
										=============================================*/

										$select ='id_consulta,id_historia_consulta,motivo_consulta,fecha_consulta';

										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["nombre_paciente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."consulta?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchCliente;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."consulta?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;

										}

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
										 "aaData"=>$data);

									 echo json_encode($results);
					 }

					if ($dataTable!="Not Found") {
						 foreach ($dataTable as $key => $value) {

							 $url = CurlController::api()."historia?select=*&linkTo=id_historia&equalTo=".$value->id_historia_consulta ;
							 $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
							 $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

							 $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/


							 $actions = '<div class="btn-group">

															 <a    onclick="agregarPacienteGrooming('.$value->id_consulta.')"  class="btn btn-success  btn-xs" >

																	 <i class="fas fa-eye" style="font-size:12px"></i> editar

															 </a>

											 </div>';


											 $fecha=date_create($value->fecha_consulta);
											 $data[]=array(
												 "id_consulta"=>$value->id_consulta,
												 "accion"=>  $actions,
												 "nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
												 "motivo_consulta"=>$value->motivo_consulta,
												 "fecha_consulta"=>date_format($fecha,"d/m/Y"),

												 );
										 }// fin for

										 $results = array(
												"sEcho"=>$draw, //Información para el datatables
											 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											 "aaData"=>$data);
										 echo json_encode($results);
						}else{
									 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
											"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											"aaData"=>$data);
										echo json_encode($results);
						 }

					 }// if post

		}

		if ($_GET['tipo']=='internamiento') {

					if (!empty($_POST)){

						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

						 /*=============================================
										Traer el total de la data de cliente
										=============================================*/

										$select = "id_internamiento";

										$url = CurlController::api()."internamiento?&select=".$select;

										$method = "GET";
									 $fields = array();
									 $header = array();

										$totalData = CurlController::request($url, $method, $fields, $header);
										 $data = array();
										if ($totalData->status==404) {
											$results = array(
												 "sEcho"=>$draw, //Información para el datatables
												 "iTotalRecords"=>0, //enviamos el total registros al datatable
												 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
												 "aaData"=>$data);

											 echo json_encode($results);
											return;
										}else{
											$totalData=$totalData->total;
										}

										/*=============================================
										Traer la data de cliente de acuerdo a la paginación o al orden o a la búsqueda
										=============================================*/

										$select ='id_internamiento,id_veterinario,fecha_internamiento,motivo_internamiento,fecha_alta,hora_alta,id_historia_internamiento';

										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["nombre_paciente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."internamiento?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select;

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchCliente;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."internamiento?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;

										}

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
										 "aaData"=>$data);

									 echo json_encode($results);
					 }

					if ($dataTable!="Not Found") {

						 foreach ($dataTable as $key => $value) {

							 $url = CurlController::api()."historia?select=*&linkTo=id_historia&equalTo=".$value->id_historia_internamiento ;
							 $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
							 $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

							// $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 //$dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/


							 $actions = '<div class="btn-group">
															 <a href="'.TemplateController::path().'internacion/datelle-internacion/'.$value->id_internamiento.'"    class="btn btn-success  btn-xs" >

																	 <i class="fas fa-eye" style="font-size:12px"></i> Ver

															 </a>

											 </div>';
											 $fecha_internamiento=date_create($value->fecha_internamiento);
											 $fecha_alta=date_create($value->fecha_alta);
											 $data[]=array(
												 "id_internamiento"=>$value->id_internamiento,
												 "accion"=>  $actions,
												 "nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
												 "motivo_internamiento"=>$value->motivo_internamiento,
												 "fecha_internamiento"=>date_format($fecha_internamiento,"d/m/Y"),
												 "fecha_alta"=>date_format($fecha_alta,"d/m/Y").' '.$value->hora_alta,

												 );
										 }// fin for

										 $results = array(
												"sEcho"=>$draw, //Información para el datatables
											 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											 "iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											 "aaData"=>$data);
										 echo json_encode($results);
						}else{
									 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
											"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
											"iTotalDisplayRecords"=>$totalData, //enviamos el total registros a visualizar
											"aaData"=>$data);
										echo json_encode($results);
						 }

					 }// if post

		}



 }//data



}

/*=============================================
Activar función DataTable
=============================================*/

$data  = new DataTableController();
$data -> data();
