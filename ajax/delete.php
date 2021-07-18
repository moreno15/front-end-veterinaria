<?php

require_once "../controller/curl.controller.php";
require_once "../controller/templateController.php";
class DeleteController{


	public function delete(){

		if (  isset($_GET['tipo'])&& $_GET['tipo']=="paciente"  ) {
			$method = "GET";
			$fields = array();
			$header = array();

			// eliminamos el paciente
			 $url = CurlController::api()."historia?select=*&linkTo=id_paciente_historia&equalTo=".trim($_GET['id']);
			 $dataHistoria= CurlController::request($url, $method, $fields, $header)->results;

			 $url2 = CurlController::api()."consulta?select=*&linkTo=id_historia_consulta&equalTo=".trim($dataHistoria[0]->id_historia);
			 $datconsulta= CurlController::request($url2, $method, $fields, $header)->results;

			 $url3 = CurlController::api()."internamiento?select=*&linkTo=id_historia_internamiento&equalTo=".trim($dataHistoria[0]->id_historia);
			 $dataInternamiento= CurlController::request($url3, $method, $fields, $header)->results;

			 $url4= CurlController::api()."vacuna?select=*&linkTo=id_historia&equalTo=".trim($dataHistoria[0]->id_historia);
			 $dataVacuna = CurlController::request($url4, $method, $fields, $header)->results;

			 $url5= CurlController::api()."grooming?select=*&linkTo=id_paciente&equalTo=".trim($_GET['id']);
			 $dataGroming = CurlController::request($url5, $method, $fields, $header)->results;

			 //borramos el internamiento
			 $method = "DELETE";
			 $fields = array();
			 $header = array();
			 if ($dataInternamiento!="Not Found") {
					 foreach ($dataInternamiento as $key => $value) {
						 $urlC = CurlController::api()."control?token=prueba&nameId=id_internamiento&id=".trim($value->id_internamiento);
						 $deleteDControl = CurlController::request($urlC, $method, $fields, $header);

						 $urlT = CurlController::api()."tratamiento?token=prueba&nameId=id_internamiento&id=".trim($value->id_internamiento);
						 $deleteTratamiento = CurlController::request($urlT, $method, $fields, $header);

						 $urlIn = CurlController::api()."internamiento_incidencia?token=prueba&nameId=id_internamiento_inter_incid&id=".trim($value->id_internamiento);
						 $deleteIncidencia = CurlController::request($urlIn, $method, $fields, $header);

					 }
					 $urlInternamiento = CurlController::api()."internamiento?token=prueba&nameId=id_historia_internamiento&id=".trim($dataHistoria[0]->id_historia);
					 $deleteInternamiento = CurlController::request($urlInternamiento, $method, $fields, $header);
			 }
			 if ($datconsulta!="Not Found") {
					 // borramos  las evalaciones
					 foreach ($datconsulta as $key => $value) {
						 $urlE = CurlController::api()."evaluacion_fisica?token=prueba&nameId=id_consulta&id=".trim($value->id_consulta);
						 $deleteEvaluacion= CurlController::request($urlE, $method, $fields, $header);
					 }
					 //elimnamos la consulta
					 $urlInConsulta= CurlController::api()."consulta?token=prueba&nameId=id_historia_consulta&id=".trim($dataHistoria[0]->id_historia);
					 $deleteConsulta= CurlController::request($urlInConsulta, $method, $fields, $header);
				}
				 if ($datconsulta!="Not Found") {
						 // borramos  la bacuna
						 foreach ($dataVacuna as $key => $value) {
							 $urlpro = CurlController::api()."vacuna_medicamento?token=prueba&nameId=id_vacuna&id=".trim($value->id_vacuna);
							 $deleteProdVacu= CurlController::request($urlpro, $method, $fields, $header);
						 }
						 //borramos la vacuna
						 $urlVacuna= CurlController::api()."vacuna?token=prueba&nameId=id_historia&id=".trim($dataHistoria[0]->id_historia);
						 $deleteVacuna= CurlController::request($urlVacuna, $method, $fields, $header);
				 }
				 if ($dataGroming!="Not Found") {
						// borramos  la bacuna
						foreach ($dataGroming as $key => $value) {
							$urlDetalle = CurlController::api()."detalle_grooming?token=prueba&nameId=id_grooming&id=".trim($value->id_grooming);
							$deleteDetalle= CurlController::request($urlDetalle, $method, $fields, $header);
						}
						$urlgr= CurlController::api()."grooming?token=prueba&nameId=id_paciente&id=".trim($_GET['id']);
						$deletegromming= CurlController::request($urlgr, $method, $fields, $header);
				}


				//eliminamos las Citas
				$urlCitas= CurlController::api()."citas?token=prueba&nameId=id_paciente&id=".trim($_GET['id']);
			 $deletCitas= CurlController::request($urlCitas, $method, $fields, $header);

			 //borramos la hisotoria
			 $urlHisto= CurlController::api()."historia?token=prueba&nameId=id_paciente_historia&id=".trim($_GET['id']);
			 $deleteHistoria= CurlController::request($urlHisto, $method, $fields, $header);

			 //eliminamos al apciente
			 $urlPaciente= CurlController::api()."paciente?token=prueba&nameId=id_paciente&id=".trim($_GET['id']);
			 $deletePaciente= CurlController::request($urlPaciente, $method, $fields, $header);



			 if ($deletePaciente->status==200) {
				 echo "El paciente fue eliminado exitozamente" .$datconsulta;
			 }else{
					 echo "error, Hubo un problema interno" .$datconsulta;
			 }


		}else{

			$url = CurlController::api().$_GET['tabla']."?token=prueba&nameId=".$_GET['namdeId']."&id=".trim($_GET['id']);//.$_SESSION["user"]->token_user;
			$method = "DELETE";
			$fields = array();
			$header = array();
			$deleteDetalle = CurlController::request($url, $method, $fields, $header);

			if ($deleteDetalle->status==200) {
			 	echo "El paciente fue eliminado exitozamente";
			}else{
					echo "error, Hubo un problema interno";
			}
		}

	}


}

$deleteController = new DeleteController();
$deleteController -> delete();
