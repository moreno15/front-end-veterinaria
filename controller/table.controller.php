<?php

class TableController{


	/*=============================================
	Función DataTable
	=============================================*/

	public function registerCliente(){
		//date_default_timezone_set("America/Lima");

				if (isset($_POST["dni_cliente"])) {
					$id_cliente=$_POST["id_cliente"];
					$dni_cliente=$_POST["dni_cliente"];
					$nombre_cliente=$_POST["nombre_cliente"];
					$apellido_cliente=$_POST["apellido_cliente"];
					$email_cliente=$_POST["email_cliente"];
					$telefono_cliente=$_POST["telefono_cliente"];
					$direccion_cliente=$_POST["direccion_cliente"];

					$dataCliente = array(

						"nombre_cliente"=>$nombre_cliente,
						"apellido_cliente"=>$apellido_cliente,
						"telefono_cliente"=>$telefono_cliente,
						"direccion_cliente"=>$direccion_cliente,
						"dni_cliente"=>$dni_cliente,
						"email_cliente"=>$email_cliente

					);
					$url = CurlController::api()."cliente?token=prueba";//.$_SESSION["user"]->token_user;
			 	 $method = "POST";
			 	 $fields = json_encode($dataCliente);
			 	 $header = array(

			 			'Content-Type: application/json' //x-www-form-urlencoded

			 	 );

			 	 $saveData= CurlController::request($url, $method, $fields, $header);

					if($saveData->status == 200){

						echo '<script>

							 fncFormatInputs();

							 fncSweetAlert("success", "Los datos se registraron exitozamente","");


						 </script>';
						 return;

					}else{
						echo ' <script>
						fncFormatInputs();
						 fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente", "");
						</script>';
						return;

					}


				}

 }//funcion cliente

 public function registerPaciente(){
	 //date_default_timezone_set("America/Lima");

			 if (isset($_POST["id_cliente"]) && !empty($_POST["id_cliente"]) ) {

					$id_cliente=$_POST["id_cliente"];
					$nombre_paciente=$_POST["nombre_paciente"];
					$sexo_paciente=$_POST["sexo_paciente"];
					$color_paciente=$_POST["color_paciente"];
					$raza=$_POST["raza"];
					$esterelizado=$_POST["esterelizado"];
					$fecha_nacimiento=$_POST["fecha_nacimiento"];

				/* if(isset($_FILES['fotopaciente']["tmp_name"]) && !empty($_FILES['fotopaciente']["tmp_name"]) ){

 					$image = $_FILES['fotopaciente'];
 					$folder = "img/paciente";
 					$path =  time();
 					$width = 300;
 					$height = 300;
 					$name = time()."_".$_POST["nombre_paciente"];

 					$saveImagePaciente= TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

	 					if($saveImagePaciente == "error"){

	 						echo '<script>

	 						fncFormatInputs();
	 						fncSweetAlert("error","no se pudo guardar la imagen el paciente '.$_POST["sexo_paciente"].' ","");
	 						</script>';

	 						return;
	 					}

	 				}else{

		 				echo '<script>

		 					fncFormatInputs();
		 						fncSweetAlert("error","Selecione una imagen","");
		 					</script>';
		 					return;

	 				}*/


				 $dataPaciente = array(

					 "nombre_paciente"=>$nombre_paciente,
					 "sexo_paciente"=>$sexo_paciente,
					 "color_paciente"=>$color_paciente,
					 "id_raza_paciente"=>$raza,
					 "esterilizado"=>$esterelizado,
					 "fecha_nacimiento"=>$fecha_nacimiento,
					 "foto_paciente"=>"",
					 "id_cliente_paciente"=>$id_cliente

				 );
				 $url = CurlController::api()."paciente?token=prueba";//.$_SESSION["user"]->token_user;
				$method = "POST";
				$fields = json_encode($dataPaciente);
				$header = array(

					 'Content-Type: application/json' //x-www-form-urlencoded

				);

				$saveData= CurlController::request($url, $method, $fields, $header);

				 if($saveData->status == 200){
					 $url2 = CurlController::api()."historia?select=id_historia";
					 $method2 = "GET";
					 $fields2 = array();
					 $header2 = array();

					 $totalData = CurlController::request($url2, $method2, $fields2, $header2);
					 $numero_histotia=($totalData->total)+1;

         //   registramos la hisotoria
					 $dataHistoria = array(

						 "numero_historia"=>$numero_histotia,
						 "id_paciente_historia"=>$saveData->id

					 );

					$url = CurlController::api()."historia?token=prueba";//.$_SESSION["user"]->token_user;
					$method = "POST";
					$fields = json_encode($dataHistoria);
					$header = array(

						 'Content-Type: application/json' //x-www-form-urlencoded

					);

					$saveDatad= CurlController::request($url, $method, $fields, $header);

					 if($saveDatad->status == 200){

							 echo '<script>

									fncFormatInputs();

									fncSweetAlert("success", "Los datos se registraron exitozamente h","");


								</script>';
								return;
						}

				 }else{
					 echo ' <script>
					 fncFormatInputs();
						fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente", "");
					 </script>';
					 return;

				 }


			 }
 }//funcion paciente


 public function registerCitas(){
	 //date_default_timezone_set("America/Lima");

			 if (isset($_POST["idpaciente"]) && !empty($_POST["idpaciente"]) ) {

					$fecha_cita=$_POST["fecha_cita"];
					$hora_cita=$_POST["hora_cita"];
					$servicio=$_POST["id_servicio"];
					$idpaciente=$_POST["idpaciente"];
					$nombre_cliente=$_POST["nombre_cliente"];

				 $dataPaciente = array(
					  'fecha_cita'=>$fecha_cita,
		        'hora_cita'=>$hora_cita,
		        'cliente_cita'=>$nombre_cliente,
		        'servicio_cita'=>(explode("-",$servicio))[1],
		        'estado'=>'0',//pendiente
		        'id_paciente'=>$idpaciente,
		        'id_servicio'=>(explode("-",$servicio))[0],
		        'send_sms'=>'0' // no envio mensaje


				 );
				 $url = CurlController::api()."citas?token=prueba";//.$_SESSION["user"]->token_user;
				$method = "POST";
				$fields = json_encode($dataPaciente);
				$header = array(

					 'Content-Type: application/json' //x-www-form-urlencoded

				);

				$saveData= CurlController::request($url, $method, $fields, $header);

				 if($saveData->status == 200){

					 echo '<script>

							fncFormatInputs();

							fncSweetAlert("success", "Los datos se registraron exitozamente","'.TemplateController::path().'citas");


						</script>';
						return;

				 }else{
					 echo ' <script>
					 fncFormatInputs();
						fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente", "");
					 </script>';
					 return;

				 }


			 }
 }//funcion citas


 public function registerGrooming(){
	 date_default_timezone_set("America/Lima");

			 if (isset($_POST["idpaciente"]) && !empty($_POST["idpaciente"]) ) {

					$id_citas=trim($_POST["id_citas"]);
					$idpaciente=trim($_POST["idpaciente"]);
					$servicio=$_POST["servicio"];
					$descripcion=$_POST["descripcion"];

				 $dataGroming = array(
					  'id_paciente'=> $idpaciente,
		        'descripcion'=> $descripcion,
		        'fecha_registro'=>  date("Y-m-d H:i:s"),
		        'estado'=>'0'

				 );
				 $url = CurlController::api()."grooming?token=prueba";//.$_SESSION["user"]->token_user;
				$method = "POST";
				$fields = json_encode($dataGroming);
				$header = array(

					 'Content-Type: application/json' //x-www-form-urlencoded

				);

				$saveData= CurlController::request($url, $method, $fields, $header);

				 if($saveData->status == 200){
					  $con=0;

								foreach ($servicio as $key => $value) {

											 $dataGromingDeta = array(
									        'tipo_grooming'=>$value,
									        'id_grooming'=> $saveData->id

											 );
											  $url = CurlController::api()."detalle_grooming?token=prueba";
											 	$fields = json_encode($dataGromingDeta);

												 $saveDeta= CurlController::request($url, $method, $fields, $header);

								 				 if($saveDeta->status == 200){
													 $con++;

								 				 }
								 }

								 if (isset($id_citas)&&!empty($id_citas)) {
									 $url = CurlController::api()."citas?id=".$id_citas."&nameId=id_citas&token=prueba";
									 $method = "PUT";
									 $fields =  "estado=1";
									 $header = array();

									 $updatePassword = CurlController::request($url, $method, $fields, $header);

 									 if($saveDeta->status == 200){
										 if (count($servicio)==$con) {
											 echo '<script>

													fncFormatInputs();

													fncSweetAlert("success", "Los datos se registraron exitozamente s ","'.TemplateController::path().'grooming");


												</script>';
												return;
										 }

 									 }
								 }else {
									 if (count($servicio)==$con) {
										 echo '<script>

												fncFormatInputs();

												fncSweetAlert("success", "Los datos se registraron exitozamente ","'.TemplateController::path().'grooming");


											</script>';
											return;
									 }
								 }


				 }else{
					 echo ' <script>
					 fncFormatInputs();
						fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente", "");
					 </script>';
					 return;

				 }


			 }
 }//funcion citas

 public function registerVisita(){
	 date_default_timezone_set("America/Lima");

			 if (isset($_POST["id_historia"]) && !empty($_POST["id_historia"]) ) {

					$id_historia_consulta=trim($_POST["id_historia"]);
	        $motivo_consulta=$_POST["motivo_consulta"];
	        $anamnesis=$_POST["anamnesis"];
	        $fecha_consulta=$_POST["fecha_consulta"];
	        $examen_clinico=$_POST["examen_clinico"];
	        $dx_presuntivo=$_POST["dx_presuntivo"];
	        $analisis_req=$_POST["analisis_req"];
	        $estudio_imagen=$_POST["estudio_imagen"];
	        $analisis_clinico=$_POST["analisis_clinico"];
	        $tratamiento_clinico=$_POST["tratamiento_clinico"];
	        $tratamiento_casa=$_POST["tratamiento_casa"];
	        $otro=$_POST["otros"];

					// Evaluaciontemperatura
					 $temperatura=$_POST["temperatura"];
					 $frec_cardiaca=$_POST["frec_cardiaca"];
					 $pulso=$_POST["pulso"];
					 $frec_respiratoria=$_POST["frec_respiratoria"];
					 $peso=$_POST["peso"];
					 $conciencia=$_POST["conciencia"];
					 $mucosa=$_POST["mucosa"];
					 $condicion_corporal=$_POST["condicion_corporal"];
					 $ltc=$_POST["ltc"];
					 $ptje_dsh=$_POST["ptje_dsh"];
					 $ccia=$_POST["ccia"];
					 $llenado_capilar=$_POST["llenado_capilar"];
					 $fecha_evaluacion=$_POST["fecha_evaluacion"];
					 $hora_evaluacion=$_POST["hora_evauacion"];


					 //registrar la consulta
				 $dataVisitas = array(
						"id_historia_consulta"=>$id_historia_consulta,
		        "motivo_consulta"=>$motivo_consulta,
		        "anamnesis"=>$anamnesis,
		        "fecha_consulta"=>  date("Y-m-d H:i:s"),
		        "examen_clinico"=>$examen_clinico,
		        "dx_presuntivo"=>$dx_presuntivo,
		        "analisis_req"=>$analisis_req,
		        "estudio_imagen"=>$estudio_imagen,
		        "analisis_clinico"=>$analisis_clinico,
		        "tratamiento_clinico"=>$tratamiento_clinico,
		        "tratamiento_casa"=>$tratamiento_casa,
		        "otros"=>$otro

				 );
				 $url = CurlController::api()."consulta?token=prueba";//.$_SESSION["user"]->token_user;
				$method = "POST";
				$fields = json_encode($dataVisitas);
				$header = array(

					 'Content-Type: application/json' //x-www-form-urlencoded

				);

				$saveData= CurlController::request($url, $method, $fields, $header);

				 if($saveData->status == 200){

					 $dataEvaluacion = array(
							"temperatura"=>$temperatura,
			        "frec_cardiaca"=>$frec_cardiaca,
			        "pulso"=>$pulso,
			        "frec_respiratoria"=> $frec_respiratoria,
			        "peso"=>$peso,
			        "conciencia"=>$conciencia,
			        "mucosa"=>$mucosa,
			        "condicion_corporal"=>$condicion_corporal,
			        "ltc"=>$ltc,
			        "ptje_dsh"=>$ptje_dsh,
			        "ccia"=>$ccia,
			        "llenado_capilar"=>$llenado_capilar,
							"fecha_evaluacion"=>$fecha_evaluacion,
							"hora_evaluacion"=>$hora_evaluacion,
							"id_consulta"=>$saveData->id

					 );
					  $url = CurlController::api()."evaluacion_fisica?token=prueba";//.$_SESSION["user"]->token_user;
						$fields = json_encode($dataEvaluacion);

						$saveDataEaval= CurlController::request($url, $method, $fields, $header);
						if ($saveDataEaval->status==200) {
							echo '<script>

								fncFormatInputs();

								fncSweetAlert("success", "Los datos se registraron exitozamente ","'.TemplateController::path().'visitas/reg-visita");


							</script>';
							return;
						}
				 }else{
					 echo ' <script>
					 fncFormatInputs();
						fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente d", "");
					 </script>';
					 return;

				 }


			 }
 }//funcion visitas

 public function registerInternamiento(){
	 date_default_timezone_set("America/Lima");

			 if (isset($_POST["id_historia"]) && !empty($_POST["id_historia"]) ) {

					$id_historia=trim($_POST["id_historia"]);
	        $fecha_internamiento=$_POST["fecha_internamiento"];
	        $fecha_alta=$_POST["fecha_alta"];
	        $hora_alta=$_POST["hora_alta"];
	        $motivo_internamiento=$_POST["motivo_internamiento"];
	        $otros=$_POST["otros"];
	        $veterinario=$_POST["id_veterinario"];

					$veter=explode("-",$veterinario);
					 //registrar la consulta
				 $dataVisitas = array(

						"id_veterinario"=>$veter[0],
		        "fecha_internamiento"=>$fecha_internamiento,
		        "fecha_alta"=>$fecha_alta,
		        "hora_alta"=>$hora_alta  ,
		        "motivo_internamiento"=>$motivo_internamiento,
		        "otros"=>$otros,
		        "id_historia_internamiento"=>$id_historia

				 );
				 $url = CurlController::api()."internamiento?token=prueba";//.$_SESSION["user"]->token_user;
				$method = "POST";
				$fields = json_encode($dataVisitas);
				$header = array(

					 'Content-Type: application/json' //x-www-form-urlencoded

				);

				$saveData= CurlController::request($url, $method, $fields, $header);

				 if($saveData->status == 200){
					 echo '<script>

						 fncFormatInputs();

						 fncSweetAlert("success", "Los datos se registraron exitozamente ","'.TemplateController::path().'internacion/reg-internacion");


					 </script>';
					 return;
				 }else{
					 echo ' <script>
					 fncFormatInputs();
						fncSweetAlert("error", "Error no se pudo completar la operacion, intente nuevamente", "");
					 </script>';
					 return;

				 }


			 }
 }//funcion visitas

}//clase
