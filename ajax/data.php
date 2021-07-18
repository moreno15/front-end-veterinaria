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

 							$select = "id_cliente,nombre_cliente,apellido_cliente,dni_cliente,telefono_cliente,direccion_cliente,email_cliente";

 							/*=============================================
 							Cuando se usa el buscador de DataTable
 							=============================================*/

 							if(!empty($_POST['search']['value'])){

 									$linkTo = [ 'nombre_cliente','apellido_cliente','dni_cliente'];

 									$search = str_replace(" ", "_", $_POST['search']['value']);

 									foreach ($linkTo as $key => $value) {

 										 $url = CurlController::api()."cliente?linkTo=apellido_cliente&search=".$search."&select=*";

 										 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

 											if($searchTable == "Not Found"){

 												$dataTable = array();

 											}else{
 													$dataTable = $searchTable;
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
 							 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
 							 "aaData"=>$data);

 						 echo json_encode($results);
 		 }

		 		if ($dataTable!="Not Found") {

		 			 foreach ($dataTable as $key => $value) {
		 				 /*=============================================
		 				 Actions
		 				 =============================================*/


										$actions = '<div class="btn-group">

								 										 <a   style="cursor:pointer"   class="btn btn-info rounded-circle mr-2"
																		 style="cursor:pointer"
																		data-toggle="modal" data-target="#md-reg-cliente"
																		data-id_cliente="'.$value->id_cliente.'"
																		data-nombre_cliente="'.$value->nombre_cliente.'"
																		data-apellido_cliente="'.$value->apellido_cliente.'"
																		data-dni_cliente="'.$value->dni_cliente.'"
																		data-email_cliente="'.$value->email_cliente.'"
																		data-telefono_cliente="'.$value->telefono_cliente.'"
																		data-direccion_cliente="'.$value->direccion_cliente.'"
																		  >

								 												 <i class="fa fa-pencil" style="font-size:12px"></i>

								 										 </a>

								 						 </div>';


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
		 								 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
		 								 "aaData"=>$data);
		 							 echo json_encode($results);
		 			}else{
		 						 $results = array(
		 							 "sEcho"=>$draw, //Información para el datatables
		 								"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
		 								"iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
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
										   $select ='id_paciente,nombre_paciente,fecha_nacimiento,sexo_paciente, color_paciente, esterilizado,foto_paciente,id_raza_paciente,id_cliente_paciente';

 		  							/*=============================================
 		  							Cuando se usa el buscador de DataTable
 		  							=============================================*/

 		  							if(!empty($_POST['search']['value'])){

 		  									$linkTo = ['nombre_paciente'];

			 									$search = str_replace(" ", "_", $_POST['search']['value']);

			 									/*foreach ($linkTo as $key => $value) {


			 									}*/


												$url = CurlController::api()."paciente?linkTo=nombre_paciente&search=".$search."&select=*";

												$searchTable = CurlController::request($url, $method, $fields, $header)->results;

												 if($searchTable == "Not Found"){

													 $dataTable = array();

												 }else{
														 $dataTable = $searchTable;
														 $recordsFiltered = count($dataTable);

												 }
 		  							}else{

 		  									$url = CurlController::api()."paciente?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*" ;
 		  									$dataTable = CurlController::request($url, $method, $fields, $header)->results;
 		  									$recordsFiltered = $totalData;

 		  							}

 		  				/*=============================================
 		  									 Verificamos que la tabla no venga vacía
 		  				 =============================================*/


 		  		if ($dataTable!="Not Found") {

 		  			 foreach ($dataTable as $key => $value) {
							 $url = CurlController::api()."historia?select=*&linkTo=id_paciente_historia&equalTo=".$value->id_paciente ;
							 $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."raza?select=*&linkTo=id_raza&equalTo=".$value->id_raza_paciente ;
							 $dataEspecie= CurlController::request($url2, $method, $fields, $header)->results;

							 $url3 = CurlController::api()."cliente?select=nombre_cliente,apellido_cliente&linkTo=id_cliente&equalTo=".$value->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;
 		  				 /*=============================================
 		  				 Actions
 		  				 =============================================*/

							       $date = date_create($value->fecha_nacimiento);


															 $actions = '<div class="btn-group">

																					 <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
															<span class="sr-only">Toggle Dropdown</span>
														</button>
																<div class="dropdown-menu" role="menu" style="">
																	<a class="dropdown-item"
																	style="cursor:pointer"

																	data-toggle="modal" data-target="#modal-paciente"
																 data-id_cliente="'.$value->id_cliente_paciente.'"
																 data-cliente="'.$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente. '"
																 data-id_paciente="'.$value->id_paciente.'"
																 data-nombre_paciente="'.$value->nombre_paciente.'"
																 data-fecha_nacimiento="'. date_format($date,'Y-m-d').'"
																 data-sexo_paciente="'.$value->sexo_paciente.'"
																 data-esterilizado="'.$value->esterilizado.'"
																 data-color="'.$value->color_paciente.'"
																 data-raza="'.$value->id_raza_paciente.'"
																 data-especie="'.$dataEspecie[0]->id_especie_raza.'" ><i class="fa fa-pencil"></i>  Editar</a>

																 <a class="dropdown-item" style="cursor:pointer" href="'.TemplateController::path().'paciente/historia-clinica/'.$dataHistoria[0]->id_historia.'"    > <i class="fas fa-eye" style="font-size:12px"></i> Ver	Historial</a>
																	<a class="dropdown-item"  style="cursor:pointer" onclick="eliminarPaciente('.$value->id_paciente.')" > <i class="fa fa-trash"></i> Eliminar</a>

																</div>


																			</div>';


 		  			 //	$actions =  TemplateController::htmlClean($actions);
						 if ($value->esterilizado!="0") {
							 $rpt="Si";
						 	 $class='badge bg-success';
						 }else{
							 $rpt="No";
							 $class='badge bg-danger';
						 }



											$fechaActual=date('d-m-Y');

											$firstDate  = new DateTime(date_format($date,'d-m-Y'));
											$secondDate = new DateTime($fechaActual);
											$intvl = $firstDate->diff($secondDate);

											$edad= "<strong style='color:blue'>" .$intvl->y ." Años con ".$intvl->m." Meses y ".$intvl->d." días</strong>";

 		  								 $data[]=array(
 		  									 "id_paciente"=>$value->id_paciente,
 		  									 "accion"=>  $actions,
												 "foto_paciente"=>"<img src='img/paciente/".$value->foto_paciente."' style='height:50px'>",
 		  									 "nombre_paciente"=>$value->nombre_paciente ,
												 "edad"=>$edad,
 		  									 "fecha_nacimiento"=>date_format($date,'d-m-Y'),
 		  									 "sexo_paciente"=> $value->sexo_paciente,
 		  									 "esterilizado"=>"<spa class='badge ".$class."' style='width:100px'>".$rpt."</span>",
												 "color_paciente"=> $value->color_paciente,
												 "raza_paciente"=> $dataEspecie[0]->nombre_raza,



 		  									 );
 		  							 }// fin for

 		  							 $results = array(
 		  									"sEcho"=>$draw, //Información para el datatables
 		  								 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  								 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
 		  								 "aaData"=>$data);
 		  							 echo json_encode($results);
 		  			}else{
 		  						 $results = array(
 		  							 "sEcho"=>$draw, //Información para el datatables
 		  								"iTotalRecords"=>$totalData, //enviamos el total registros al datatable
 		  								"iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
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

										$select ='id_citas,fecha_cita,hora_cita,cliente_cita,servicio_cita,estado,id_paciente,send_sms';
										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										$url = CurlController::api()."citas?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=estado&equalTo=0" ;
 									 $dataTable = CurlController::request($url, $method, $fields, $header)->results;
 									 $recordsFiltered = $totalData;

							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
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

		// citas recervados cita------------------------------------------------------------------------------------
		if ($_GET['tipo']=='cl-citas') {

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

										$select ='id_citas,fecha_cita,hora_cita,cliente_cita,servicio_cita,estado,id_paciente,send_sms';
										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										$url = CurlController::api()."citas?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=estado&equalTo=0" ;
										$dataTable = CurlController::request($url, $method, $fields, $header)->results;
										$recordsFiltered = $totalData;
							/*=============================================
												 Verificamos que la tabla no venga vacía
							 =============================================*/
						if(count($dataTable) == 0){

								 $results = array(
										 "sEcho"=>$draw, //Información para el datatables
										 "iTotalRecords"=>$totalData, //enviamos el total registros al datatable
										 "iTotalDisplayRecords"=>0, //enviamos el total registros a visualizar
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

								$celular='"'.$dataCliente[0]->telefono_cliente."-".$value->id_citas.'"';
							 				$actions = "<div class='btn-group'>

							 													<a onclick='sendSMSNotificacion(".$celular.")' class='btn btn-success rounded-circle mr-2' >

							 														  <i class='fa fa-fax'  ></i>

							 													</a>



							 													<a type='button' class='btn btn-danger rounded-circle text-white' onclick='removeCita(".$value->id_citas.")'>

							 															<i class='fas fa-trash' style='font-size:12px'></i>

							 													</a>

							 									</div>";



											 $fecha=date_create($value->fecha_cita);

				               $fech=date_format($fecha,'d/m/Y');

												 $data[]=array(
													"id_citas"=>$value->id_citas,
													"accion"=>  $actions,
													"cliente"=>$cliente,
													"telefono_cliente"=>$dataCliente[0]->telefono_cliente,
													"nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
													"servicio_cita"=>$value->servicio_cita,
													"fecha_cita"=> $fech." " .$value->hora_cita,
													"sms"=>  ($value->send_sms) ? "<span class='badge  badge-success'>Enviado</span>":"<span class='badge  badge-danger'> No Enviado</span>",
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

												$url = CurlController::api()."paciente?linkTo=nombre_paciente&search=".$search."&select=*";

												$searchTable = CurlController::request($url, $method, $fields, $header)->results;

												 if($searchTable == "Not Found"){

												   $dataTable = array();

												 }else{
												     $dataTable = $searchTable;
												     $recordsFiltered = count($dataTable);

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

							 $paciente="'"."-".trim($value->id_paciente)."-".$value->nombre_paciente."-".$cliente."-".$dataHistoria[0]->id_historia."'";

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

												$url = CurlController::api()."grooming?linkTo=nombre_cliente&search=".$search."&select=*";
												$searchTable = CurlController::request($url, $method, $fields, $header)->results;

												 if($searchTable == "Not Found"){
												   $dataTable = array();

												 }else{
												     $dataTable = $searchTable;
												     $recordsFiltered = count($dataTable);

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

							 $url4 = CurlController::api()."grooming?select=*&linkTo=id_grooming&equalTo=".$value->id_grooming ;
							 $dataDetalleGroo= CurlController::request($url4, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/
							 $serv="";
							 foreach ($dataDetalle as $key => $val) {
							 	 $serv.=$val->tipo_grooming.",";
							 }

							 $serv = substr($serv, 0, -1);


											$id="'".$value->id_grooming."'";

											 $actions = '<div class="btn-group">

																	 <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
												<div class="dropdown-menu" role="menu" style="">
		                      <a class="dropdown-item" style="cursor:pointer"
													onclick="editarGrooming(event)"
												 data-idpaciente="'.$dataPaciente[0]->id_paciente.'"
												 data-nombre_paciente="'.$dataPaciente[0]->nombre_paciente.'"
												 data-id_grooming="'.$value->id_grooming.'"
												 data-descripcion="'.$value->descripcion.'"><i class="fa fa-pencil"></i>  Editar</a>

		                      <a class="dropdown-item"  style="cursor:pointer" onclick="eliminarGrooming('.$id.')"  > <i class="fa fa-trash"></i> Eliminar</a>

		                    </div>


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
												 "fecha"=>date_format($fecha,"d/m/Y"),
												 "cliente"=>$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente,
												 "nombre_paciente"=>$dataPaciente[0]->nombre_paciente,
												 "servicio"=>$serv,
												 "estado"=>"<spa class='badge ".$class."' style='width:100px'>".$rpt."</span>",
												 "descripcion"=>$value->descripcion,


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

												$linkTo = ["nombre_cliente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												$url = CurlController::api()."consulta?linkTo=nombre_cliente&search=".$search."&select=*";
											 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

												if($searchTable == "Not Found"){
													$dataTable = array();

												}else{
														$dataTable = $searchTable;
														$recordsFiltered = count($dataTable);

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


							 $url4= CurlController::api()."evaluacion_fisica?select=*&linkTo=id_consulta&equalTo=".$value->id_consulta ;
							 $dataevaluacion= CurlController::request($url4, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/


							 $id="'".$value->id_consulta."'"; //"-" .$dataevaluacion[0]->id_evaluacion.
															$actions = '<div class="btn-group">

																					<button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
																					<span class="sr-only">Toggle Dropdown</span>
																					</button>
																					 <div class="dropdown-menu" role="menu" style="">

																						<a class="dropdown-item" style="cursor:pointer" href="'.TemplateController::path().'visitas/edit-visita/'.$value->id_consulta.'"    > <i class="fa fa-pencil"  ></i>Editar	</a>
																						 <a class="dropdown-item"  style="cursor:pointer" onclick="eliminarVista('.$id.')"  > <i class="fa fa-trash"></i> Eliminar</a>

																					 </div>


																		 </div>';


																		 /*$actions = '<div class="btn-group">

																		 									<a   style="cursor:pointer" href="'.TemplateController::path().'visitas/edit-visita/'.$value->id_consulta.'"  class="btn btn-info rounded-circle mr-2" >

																		 											<i class="fa fa-pencil" style="font-size:12px"></i>

																		 									</a>
																											<a   style="cursor:pointer"   class="btn btn-danger rounded-circle mr-2" >

																		 											<i class="fa fa-trash" style="font-size:12px"></i>

																		 									</a>

																		 					</div>';*/

											 $fecha=date_create($value->fecha_consulta);
											 $data[]=array(
												 "id_consulta"=>$value->id_consulta,
												 "accion"=>  $actions,
												 "cliente"=>$dataCliente[0]->nombre_cliente ." ".$dataCliente[0]->apellido_cliente,
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

												$url = CurlController::api()."internamiento?linkTo=nombre_cliente&search=".$search."&select=*";

												$searchTable = CurlController::request($url, $method, $fields, $header)->results;

												 if($searchTable == "Not Found"){

												   $dataTable = array();

												 }else{
												     $dataTable = $searchTable;
												     $recordsFiltered = count($dataTable);

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


							 $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/


						/*	 $actions = '<div class="btn-group">

															 <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
									 <span class="sr-only">Toggle Dropdown</span>
								 </button>
										<div class="dropdown-menu" role="menu" style="">
										<a class="dropdown-item"  style="cursor:pointer"  href="'.TemplateController::path().'internamiento/detalle-internacion/'.$value->id_internamiento.'"> <i class="fa fa-eye"></i> Ver</a>
											<a class="dropdown-item" style="cursor:pointer" ><i class="fa fa-pencil"></i>  Editar</a>
											<a class="dropdown-item"  style="cursor:pointer" onclick="removercliente('.$value->id_internamiento.')"> <i class="fa fa-trash"></i> Eliminar</a>

										</div>

											 </div>';*/

												  $id="'".$value->id_internamiento."'";
																			$actions = '<div class="btn-group">

																									<button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
																									<span class="sr-only">Toggle Dropdown</span>
																									</button>
																									 <div class="dropdown-menu" role="menu" style="">

																										<a class="dropdown-item" style="cursor:pointer"  href="'.TemplateController::path().'internamiento/detalle-internacion/'.$value->id_internamiento.'"    > <i class="fa fa-pencil"  ></i>Ver	</a>
																										 <a class="dropdown-item"  style="cursor:pointer"  onclick="eliminarInternamiento('.$id.')"   > <i class="fa fa-trash"></i> Eliminar</a>

																									 </div>


																						 </div>';



											 $fecha_internamiento=date_create($value->fecha_internamiento);
											 $fecha_alta=date_create($value->fecha_alta);
											 $data[]=array(
												 "id_internamiento"=>$value->id_internamiento,
												 "accion"=>  $actions,
												 "cliente"=>$dataCliente[0]->nombre_cliente." ".$dataCliente[0]->apellido_cliente,
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

		// en internamiento
		if ($_GET['tipo']=='tratamiento') {

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

										$select = "id_tratamiento";

										$url = CurlController::api()."tratamiento?&select=".$select."&linkTo=id_internamiento&equalTo=".trim($_GET['id']);

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

										$select ='id_tratamiento,id_articulo_tratamiento,dosis,fecha_tratamiento,hora_tratamiento,id_via_dosis,id_internamiento';

										/*=============================================
										Cuando se usa el buscador de DataTable
										=============================================*/

										if(!empty($_POST['search']['value'])){

												$linkTo = ["nombre_paciente"];

												$search = str_replace(" ", "_", $_POST['search']['value']);

												foreach ($linkTo as $key => $value) {

													 $url = CurlController::api()."tratamiento?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select."&linkTo=id_internamiento&equalTo=".trim($_GET['id']);

													 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

														if($searchTable == "Not Found"){

															$dataTable = array();

														}else{
																$dataTable = $searchTable;
																$recordsFiltered = count($dataTable);

																break;

														}
												}

										}else{

												$url = CurlController::api()."tratamiento?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_internamiento&equalTo=".trim($_GET['id']) ;
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

							 $url = CurlController::api()."via?select=*&linkTo=id_via&equalTo=".$value->id_via_dosis ;
							 $dataVia= CurlController::request($url, $method, $fields, $header)->results;

							 $url2 = CurlController::api()."articulo?select=*&linkTo=id_articulo&equalTo=".$value->id_articulo_tratamiento ;
							 $dataArticulo= CurlController::request($url2, $method, $fields, $header)->results;

							// $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
							 //$dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

							 /*=============================================
							 Actions
							 =============================================*/

							 $id="'".$value->id_tratamiento."'";
							 $actions = '<div class="btn-group">
															 <a style="cursor:pointer"   class="btn btn-danger  btn-xs" onclick="eliminarTratamiento('.$id.')" >

																	 <i class="fas fa-trash" style="font-size:12px"></i> eliminar

															 </a>

											 </div>';
											 $fecha_tratamiento=date_create($value->fecha_tratamiento);
											 $data[]=array(
												 "id_tratamiento"=>$value->id_tratamiento,
												 "accion"=>  $actions,
												 "farmaco"=>$dataArticulo[0]->nombre_articulo,
												 "dosis"=>$value->dosis,
												 "via"=>$dataVia[0]->descripcion,
												 "fecha_tratamiento"=>date_format($fecha_tratamiento,"d/m/Y") .' '.$value->hora_tratamiento,

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

		if ($_GET['tipo']=='evaluacion') {

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

												$select = "id_control";

												$url = CurlController::api()."control?&select=".$select."&linkTo=id_internamiento&equalTo=".trim($_GET['id']);

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

												$select ='id_control,temperatura,frecuencia_card,frecuencia_resp,fecha_control,hora_control,id_internamiento';

												/*=============================================
												Cuando se usa el buscador de DataTable
												=============================================*/

												if(!empty($_POST['search']['value'])){

														$linkTo = ["nombre_paciente"];

														$search = str_replace(" ", "_", $_POST['search']['value']);

														foreach ($linkTo as $key => $value) {

															 $url = CurlController::api()."control?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select."&linkTo=id_internamiento&equalTo=".trim($_GET['id']);

															 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

																if($searchTable == "Not Found"){

																	$dataTable = array();

																}else{
																		$dataTable = $searchTable;
																		$recordsFiltered = count($dataTable);

																		break;

																}
														}

												}else{

														$url = CurlController::api()."control?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_internamiento&equalTo=".trim($_GET['id']) ;
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


									 $id="'".$value->id_control."'";
									 $actions = '<div class="btn-group">
																	 <a style="cursor:pointer"   class="btn btn-danger  btn-xs" onclick="eliminarEavaluacion('.$id.')" >

																			 <i class="fas fa-trash" style="font-size:12px"></i> eliminar

																	 </a>

													 </div>';
													 $fecha_control=date_create($value->fecha_control);
													 $data[]=array(
														 "id_control"=>$value->id_control,
														 "accion"=>  $actions,
														 "temperatura"=>$value->temperatura,
														 "frecuencia_card"=>$value->frecuencia_card,
														 "frecuencia_resp"=>$value->frecuencia_resp,
														 "fecha_tratamiento"=>date_format($fecha_control,"d/m/Y") .' '.$value->hora_control,

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

		if ($_GET['tipo']=='incidencia') {

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

												$select = "id_internamiento_incidencia";

												$url = CurlController::api()."internamiento_incidencia?&select=".$select."&linkTo=id_internamiento_inter_incid&equalTo=".trim($_GET['id']);

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

												$select ='id_internamiento_incidencia,id_internamiento_inter_incid,id_incidencia_inter_incid,nota,fecha_registro,hora_ragistro';

												/*=============================================
												Cuando se usa el buscador de DataTable
												=============================================*/

												if(!empty($_POST['search']['value'])){

														$linkTo = ["nombre_paciente"];

														$search = str_replace(" ", "_", $_POST['search']['value']);

														foreach ($linkTo as $key => $value) {

															 $url = CurlController::api()."internamiento_incidencia?linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=".$select."&linkTo=id_internamiento_inter_incid&equalTo=".trim($_GET['id']);

															 $searchTable = CurlController::request($url, $method, $fields, $header)->results;

																if($searchTable == "Not Found"){

																	$dataTable = array();

																}else{
																		$dataTable = $searchTable;
																		$recordsFiltered = count($dataTable);

																		break;

																}
														}

												}else{
														///api/internamiento_incidencia?orderBy=id_incidencia&orderMode=desc&startAt=0&endAt=5&select=*
														$url = CurlController::api()."internamiento_incidencia?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_internamiento_inter_incid&equalTo=".trim($_GET['id']) ;
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

									 $url = CurlController::api()."incidencia?select=*&linkTo=id_incidencia&equalTo=".$value->id_incidencia_inter_incid ;
									 $dataIncidencia= CurlController::request($url, $method, $fields, $header)->results;

									// $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
									 //$dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

									 /*=============================================
									 Actions
									 =============================================*/

									 $id="'".$value->id_internamiento_incidencia."'";
									 $actions = '<div class="btn-group">
																	 <a style="cursor:pointer"   class="btn btn-danger  btn-xs" onclick="eliminarIncidencia('.$id.')" >

																			 <i class="fas fa-trash" style="font-size:12px"></i> eliminar

																	 </a>

													 </div>';

													 $fecha_registro=date_create($value->fecha_registro);
													 $data[]=array(
														 "id_internamiento_incidencia"=>$value->id_internamiento_incidencia,
														 "accion"=>  $actions,
														 "incidencia"=>$dataIncidencia[0]->descripcion,
														 "nota"=>$value->nota,
														 "fecha_evaluacion"=>date_format($fecha_registro,"d/m/Y") .' '.$value->hora_ragistro,

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

				//falta vacunacion
			//mostramos en historia clinica


		if ($_GET['tipo']=='vacunacion'  ) {

		 					if (!empty($_POST)){

		 						$idHisoriaInter=$_GET['id'];

		 						 $draw = $_POST["draw"]; //Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

		 						 $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

		 						 $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Obtener el nombre de la columna de clasificación de su índice
		 						 $orderType = $_POST['order'][0]['dir']; // Obtener el orden ASC o DESC
		 						 $start  = $_POST["start"];//Indicador de primer registro de paginación.
		 						 $length = $_POST['length'];//Indicador de la longitud de la paginación.

		 						 /*=============================================
		 										Traer el total de la data de cliente
		 										=============================================*/

		 										$select = "id_vacuna";

		 										$url = CurlController::api()."vacuna?&select=".$select."&linkTo=id_historia&equalTo=".$idHisoriaInter;

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


												$select ='id_vacuna,parvovirus,coronavirus,distemper,hepatitis,parainflueza,l_canicola,l_icterohaemorrag,l_grippotyphosa,l_pomona,rabia,rinotraqueitis,panleucopenia,calcivirus,fecha_programada,fecha_aplicada,id_veterinario_vacuna,id_historia';

		 										/*=============================================
		 										Cuando se usa el buscador de DataTable
		 										=============================================*/
												$url = CurlController::api()."vacuna?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_historia&equalTo=".$idHisoriaInter;
											 $dataTable = CurlController::request($url, $method, $fields, $header)->results;
											 $recordsFiltered = $totalData;
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

									 	//$url = CurlController::api()."articulo?select=*&linkTo=id_vacuna&equalTo=".$value->id_vacuna ;
									 //	$dataMedicamento= CurlController::request($url, $method, $fields, $header)->results;

		 							 /*=============================================
		 							 Actions
		 							 =============================================*/


		 							 $actions = '<div class="btn-group">
		 															 <a onclick="eliminarVacuna('.$value->id_vacuna.')"     class="btn btn-success  btn-xs" >

		 																	 <i class="fas fa-trash" style="font-size:12px"></i> eliminar

		 															 </a>

		 											 </div>';
		 											 $fecha_programada=date_create($value->fecha_programada);
		 											 $fecha_aplicada=date_create($value->fecha_aplicada);

		 											 $data[]=array(
		 												 "id_vacuna"=>$value->id_vacuna,
														 "accion"=>  $actions,
														 "parvovirus"=> ($value->parvovirus=="1")? "SI":"NO"  ,
														 "coronavirus"=>($value->coronavirus=="1")? "SI":"NO"          ,
														 "distemper"=>($value->distemper=="1")? "SI":"NO"   ,
														 "hepatitis"=>($value->hepatitis=="1")?  "SI":"NO"          ,
														 "parainflueza"=>($value->parainflueza=="1")?"SI":"NO",
														 "l_canicola"=>($value->l_canicola=="1")? "SI":"NO"            ,
														 "l_icterohaemorrag"=>($value->l_icterohaemorrag=="1")? "SI":"NO"       ,
														 "l_grippotyphosa"=>($value->l_grippotyphosa=="1")? "SI":"NO"        ,
														 "l_pomona"=>($value->l_pomona=="1")? "SI":"NO" ,
														 "rabia"=>($value->rabia=="1")?  "SI":"NO"          ,
														 "rinotraqueitis"=>($value->rinotraqueitis=="1")? "SI":"NO",
														 "panleucopenia"=>($value->panleucopenia=="1")? "SI":"NO"           ,
														 "calcivirus"=>($value->calcivirus=="1")?  "SI":"NO"   ,
		 												 "fecha_programada"=>date_format($fecha_programada,"d/m/Y"),
		 												 "fecha_aplicada"=>date_format($fecha_aplicada,"d/m/Y"),

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

		if ($_GET['tipo']=='internamientoPaciente'  ) {

							if (!empty($_POST)){

								$idHisoriaInter=$_GET['id'];

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

												$url = CurlController::api()."internamiento?&select=".$select."&linkTo=id_historia_internamiento&equalTo=".$idHisoriaInter;

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
																		$dataTable = $searchTable;
																		$recordsFiltered = count($dataTable);

																		break;

																}
														}

												}else{

														$url = CurlController::api()."internamiento?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_historia_internamiento&equalTo=".$idHisoriaInter;
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


									 $actions = '<div class="btn-group">
																	 <a href="'.TemplateController::path().'internamiento/detalle-internacion/'.$value->id_internamiento.'"    class="btn btn-success  btn-xs" >

																			 <i class="fas fa-eye" style="font-size:12px"></i> Ver

																	 </a>

													 </div>';
													 $fecha_internamiento=date_create($value->fecha_internamiento);
													 $fecha_alta=date_create($value->fecha_alta);
													 $data[]=array(
														 "id_internamiento"=>$value->id_internamiento,
														 "accion"=>  $actions,
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

		if ($_GET['tipo']=='visitasHitorial') {

							if (!empty($_POST)){
								$idHisoriaInter=$_GET['id'];
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

												$url = CurlController::api()."consulta?&select=".$select."&linkTo=id_historia_consulta&equalTo=".$idHisoriaInter;

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
												$url = CurlController::api()."consulta?orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&select=*&linkTo=id_historia_consulta&equalTo=".$idHisoriaInter ;
												$dataTable = CurlController::request($url, $method, $fields, $header)->results;
												$recordsFiltered = $totalData;
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

									 $url = CurlController::api()."historia?select=*&linkTo=id_historia&equalTo=".$idHisoriaInter ;
									 $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

									 $url2 = CurlController::api()."paciente?select=*&linkTo=id_paciente&equalTo=".$dataHistoria[0]->id_paciente_historia ;
									 $dataPaciente= CurlController::request($url2, $method, $fields, $header)->results;

									 $url3 = CurlController::api()."cliente?select=*&linkTo=id_cliente&equalTo=".$dataPaciente[0]->id_cliente_paciente ;
									 $dataCliente= CurlController::request($url3, $method, $fields, $header)->results;

									 /*=============================================
									 Actions
									 =============================================*/


									 $actions = '<div class="btn-group">
 																	<a  href="'.TemplateController::path().'visitas/edit-visita/'.$value->id_consulta.'"      class="btn btn-success  btn-xs" >

 																			<i class="fas fa-eye" style="font-size:12px"></i> Ver

 																	</a>

 													</div>';


													 $fecha=date_create($value->fecha_consulta);
													 $data[]=array(
														 "id_consulta"=>$value->id_consulta,
														 "accion"=>  $actions,
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
 }//data



}

/*=============================================
Activar función DataTable
=============================================*/

$data  = new DataTableController();
$data -> data();
