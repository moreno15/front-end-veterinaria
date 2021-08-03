<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class TemplateController{

	/*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/

	public function index(){

		include "view/template.php";
	}

	/*=============================================
	Ruta Principal o Dominio del sitio
	=============================================*/

	static public function path(){

		return "http://clinicasancristobal.com/";

	}



	/*=============================================
	Función para mayúscula inicial
	=============================================*/

	static public function capitalize($value){

		$text = str_replace("_", " ", $value);

		return ucwords($text);
	}

 

		/*=============================================
		Función para almacenar imágenes
		=============================================*/

		static public function saveImage($image, $folder, $path, $width, $height, $name){



			if(isset($image["tmp_name"]) && !empty($image["tmp_name"])){
				$newName="";
				/*=============================================
				Configuramos la ruta del directorio donde se guardará la imagen
				=============================================*/

				$directory = strtolower("view/".$folder."/".$path);

				/*=============================================
				Preguntamos primero si no existe el directorio, para crearlo
				=============================================*/

				if(!file_exists($directory)){

					mkdir($directory, 0755);

				}

				/*=============================================
				Eliminar todos los archivos que existan en ese directorio
				=============================================*/

				/*$files = glob($directory."/*");

				foreach ($files as $file) {

					unlink($file);
				}*/

					/*=============================================
					Capturar ancho y alto original de la imagen
					=============================================*/

					list($lastWidth, $lastHeight) = getimagesize($image["tmp_name"]);

					/*=============================================
					De acuerdo al tipo de imagen aplicamos las funciones por defecto
					=============================================*/

					if($image["type"] == "image/jpeg"){

						//definimos nombre del archivo
						$newName  = $name.'.jpg';

						//definimos el destino donde queremos guardar el archivo
						$folderPath = $directory.'/'.$newName;

						//Crear una copia de la imagen
						$start = imagecreatefromjpeg($image["tmp_name"]);

						//Instrucciones para aplicar a la imagen definitiva
						$end = imagecreatetruecolor($width, $height);

						imagecopyresized($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

						imagejpeg($end, $folderPath);

					}

					if($image["type"] == "image/png"){

						//definimos nombre del archivo
						$newName  = $name.'.png';

						//definimos el destino donde queremos guardar el archivo
						$folderPath = $directory.'/'.$newName;

						//Crear una copia de la imagen
						$start = imagecreatefrompng($image["tmp_name"]);

						//Instrucciones para aplicar a la imagen definitiva
						$end = imagecreatetruecolor($width, $height);

						imagealphablending($end, FALSE);

						imagesavealpha($end, TRUE);

						imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

						imagepng($end, $folderPath);

					}

				return $newName;

			}else{

				return "error";

			}

		}

		static public function saveFilepdf($image, $folder, $path, $width, $height, $name){



			if(isset($image["tmp_name"]) && !empty($image["tmp_name"])){
				$newName="";
				/*=============================================
				Configuramos la ruta del directorio donde se guardará la imagen
				=============================================*/

				$directory = strtolower("view/".$folder."/".$path);

				/*=============================================
				Preguntamos primero si no existe el directorio, para crearlo
				=============================================*/

				if(!file_exists($directory)){

					mkdir($directory, 0755);

				}

				/*=============================================
				Eliminar todos los archivos que existan en ese directorio
				=============================================*/

				/*$files = glob($directory."/*");

				foreach ($files as $file) {

					unlink($file);
				}*/

				if($image["type"] == "application/pdf"){

					//definimos nombre del archivo
					$temp =$image['tmp_name'];
					$newName  = $name.'.pdf';

					//definimos el destino donde queremos guardar el archivo
					$folderPath = $directory.'/'.$newName;

					if (!move_uploaded_file($temp, $folderPath)) {
						return "error";
					}

				}else{
						 return "error";
				}// else pdf
				return $newName;

			}else{

				return "error";

			}

		}

		/*=============================================
		Función Limpiar HTML
		=============================================*/

		static public function htmlClean($code){

			$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');

			$replace = array('>','<','\\1');

			$code = preg_replace($search, $replace, $code);

			$code = str_replace("> <", "><", $code);

			return $code;

		}
}
