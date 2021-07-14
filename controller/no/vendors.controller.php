<?php

class VendorsController{

	/*=============================================
	Registro de nueva tienda y producto
	=============================================*/

	public function newVendor(){

		/*=============================================
		Validar que si vengan variables Post
		=============================================*/

		if( isset($_POST["nameStore"])){

			/*=============================================
		 	Validar sintaxis lado servidor
			=============================================*/

				/*if(
					 preg_match('/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nameStore"]) &&
				   preg_match('/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["razonSocialStore"]) &&
					 preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["titularStore"]) &&
		       preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["departmentStore"]) &&
					 preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["provinceStore"]) &&
					 preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["districtStore"]) &&
		       preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phoneStore"]) &&
					 preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["rucStore"]) &&
					 preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["dniStore"]) &&
					 preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["numCuentaBanca"])&&
					 preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["cuentaInteri"])&&
					 preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["tipoCuenta"]) &&
					 preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["banco"]) &&
		       preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/',
					 $_POST["addressStore"])   ){*/

		       	/*=============================================
		 		Validar imágenes
				=============================================*/

				if(
					  isset($_FILES['fichaBancaStore']["tmp_name"]) &&
					  !empty($_FILES['fichaBancaStore']["tmp_name"]) &&
						isset($_FILES['fichaRucStore']["tmp_name"]) &&
					  !empty($_FILES['fichaRucStore']["tmp_name"]) &&
					  isset($_FILES['fichaDNIStore']["tmp_name"]) &&
					  !empty($_FILES['fichaDNIStore']["tmp_name"])
					){

					/*=============================================
		 			Guardar  ficha bancaria
					=============================================*/

					  $fichaBancaStore = $_FILES['fichaBancaStore'];
			  		$folderFile = "file/stores";
			  		$pathFile = $_POST["urlStore"];
			  		$widthFile= 0;
			  		$heightFile = 0;
			  		$nameFile =time()."-fichaBanca";

			  		$saveFileBanca= TemplateController::saveFilepdf($fichaBancaStore, $folderFile, $pathFile, $widthFile, $heightFile, $nameFile);


			  		if($saveFileBanca == "error"){

								echo ' <script>
								fncFormatInputs();
								 fncSweetAlert("error", "Error saving cuenta bancaria", "");
								</script>';
								return;

					  }

						$fichaRucStore = $_FILES['fichaRucStore'];
						$nameFile2 =time() ."-fichaRuc";

						$saveFileRuc= TemplateController::saveFilepdf($fichaRucStore, $folderFile, $pathFile, $widthFile, $heightFile, $nameFile2);

						if($saveFileRuc == "error"){
							echo ' <script>
							fncFormatInputs();
							 fncSweetAlert("error", "Error saving ficha ruc", "");
							</script>';
							return;

						}

						$fichaDniStore = $_FILES['fichaDNIStore'];
						$nameFile3 = time() ."-fichaDNI";

						$saveFileDni= TemplateController::saveFilepdf($fichaDniStore, $folderFile, $pathFile, $widthFile, $heightFile, $nameFile3);

						if($saveFileDni == "error"){


							echo ' <script>
							fncFormatInputs();
							 fncSweetAlert("error", "Error saving copia DNI", "");
							</script>';
									return;
						}

						$documentAdjunt = array();
						$bancaStore = array();

						array_push($documentAdjunt, ["fichaBancaStore"=>$saveFileBanca,"fichaRucStore"=>$saveFileRuc,"fichaDNIStore"=>$saveFileDni]);

						$documentAdjunt = json_encode($documentAdjunt);

						array_push($bancaStore, ["titularStore"=> $_POST["titularStore"],"documento"=> $_POST["dniStore"] ,"numCuentaBanca"=> $_POST["numCuentaBanca"],"cuentaInteri"=> $_POST["cuentaInteri"],"tipoCuenta"=> $_POST["tipoCuenta"],"banco"=> $_POST["banco"]  ]);

						$bancaStore = json_encode($bancaStore);
							/*=============================================
						Organizar los datos que se subiran a BD de la tienda
						=============================================*/
						$dataStore = array(

							"id_user_store" => $_SESSION["user"]->id_user,
							"name_store" => TemplateController::capitalize($_POST["nameStore"]),
							"razon_store" =>TemplateController::capitalize($_POST["razonSocialStore"]),
							"ruc_store"=> $_POST["rucStore"],
							"state_store"=>"hidden",
							"url_store" => $_POST["urlStore"],
							"logo_store" =>"",
							"cover_store" =>"",
							"email_store" => $_POST["emailStore"],
							"deparment_store" =>$_POST["departmentStore"],
							"province_store" =>$_POST["provinceStore"],
							"district_store" =>$_POST["districtStore"],
							"address_store" => $_POST["addressStore"],
							"phone_store" => $_POST["phoneStore"],
							"socialnetwork_store" => "",
							"product_store" =>0,
							"document_adjunt"=>$documentAdjunt,
							"banca_store"=>$bancaStore,
							"date_created_store" => date("Y-m-d"));


						$url = CurlController::api()."stores?token=".$_SESSION["user"]->token_user;
						$method = "POST";
						$fields = json_encode($dataStore);
						$header =array(
							'Content-Type: application/json' //x-www-form-urlencoded

						);

						$saveStore = CurlController::request($url, $method, $fields, $header);

						if($saveStore->status == 200){

							echo '<script>

								 fncFormatInputs();

								 fncSweetAlert("success", "Su registro se realizo exitzamente, nos comunicaremos en un plazo de 24 horas","'.TemplateController::path().'account&tienda");


							 </script>';
							 return;

						}else{
							echo ' <script>
							fncFormatInputs();
							 fncSweetAlert("error", "Error saving store", "");
							</script>';
							return;

						}


				}else{

					echo ' <script>
					fncFormatInputs();
					 fncSweetAlert("error", "Error saving documentos adjuntos", "");
					</script>';


				}

		/*	}else{

				echo '<script>

					fncFormatInputs();
					fncSweetAlert("error", "Error in the syntax of the fields", "");
				</script>';

			}*/


    }
	}

	/*=============================================
	Registro de nuevo producto
	=============================================*/

	static public function newProduct($idStore){

		if( isset($_POST["nameProduct"]) ){

			/*=============================================
	 		Validar sintaxis lado servidor
			=============================================*/

			if(preg_match('/^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nameProduct"])){

				/*=============================================
	 			Agrupar Resumen del Producto
				=============================================*/

				if(isset($_POST["inputSummary"])){

					$summaryProduct = array();

					for($i = 0; $i < $_POST["inputSummary"]; $i++){

						array_push($summaryProduct, $_POST["summaryProduct_".$i]);

					}

				}

				/*=============================================
	 			Agrupar Detalles del Producto
				=============================================*/

				if(isset($_POST["inputDetails"])){

					$detailsProduct = array();

					for($i = 0; $i < $_POST["inputDetails"]; $i++){

						$detailsProduct[$i] = (object)["title"=>$_POST["detailsTitleProduct_".$i],"value"=>$_POST["detailsValueProduct_".$i]];
					}

				}

				/*=============================================
	 			Agrupar Especificaciones del Producto
				=============================================*/

				if(isset($_POST["inputSpecifications"])){

					$specificationsProduct = array();

					for($i = 0; $i < $_POST["inputSpecifications"]; $i++){

						$specificationsProduct[$i] = (object)[$_POST["specificationsTypeProduct_".$i]=>explode(",",$_POST["specificationsValuesProduct_".$i])];
					}

					$specificationsProduct = json_encode($specificationsProduct);

					if($specificationsProduct == '[{"":[""]}]'){

						$specificationsProduct = null;
					}

				}else{

					$specificationsProduct = null;

				}

				/*=============================================
	 			Validar y guardar imagen del logo
				=============================================*/

				if(isset($_FILES['imageProduct']["tmp_name"]) && !empty($_FILES['imageProduct']["tmp_name"])){

					$image = $_FILES['imageProduct'];
					$folder = "img/products";
					$path =  explode("_",$_POST["categoryProduct"])[1];
					$width = 300;
					$height = 300;
					$name = $_POST["urlProduct"];

					$saveImageProduct = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

					if($saveImageProduct == "error"){

						echo '<script>

						fncFormatInputs();
						fncSweetAlert("error","Failed to save product image","");
						</script>';

						return;

					}

				}else{

				echo '<script>

					fncFormatInputs();
						fncSweetAlert("error","Failed to save product image","");
					</script>';

					return;

				}

				/*=============================================
	 			Guardar imágenes galería
				=============================================*/

				$galleryProduct = array();
				$count = 0;

				foreach (json_decode($_POST['galleryProduct'],true) as $key => $value) {

					$count ++;

					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";

					$folder = "img/products";
					$path =  explode("_",$_POST["categoryProduct"])[1]."/gallery";
					$width = $value["width"];
					$height = $value["height"];
					$name = mt_rand(10000, 99999);

					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

					array_push($galleryProduct, $saveImageGallery);


				}

				if(count($galleryProduct) == $count){


					/*=============================================
		 			Agrupar información para Default Banner
					=============================================*/

					if(isset($_FILES['defaultBanner']["tmp_name"]) && !empty($_FILES['defaultBanner']["tmp_name"])){


						$image = $_FILES['defaultBanner'];
						$folder = "img/products";
						$path =  explode("_",$_POST["categoryProduct"])[1]."/default";
						$width = 570;
						$height = 210;
						$name = mt_rand(10000, 99999);

						$saveImageDefaultBanner  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

						if($saveImageDefaultBanner == "error"){

				  			echo '<script>

								fncFormatInputs();
								fncSweetAlert("error", "Error saving default banner image","");

							</script>';

							return;
				  		}

					}else{

						echo '<script>

						fncFormatInputs();
						fncSweetAlert("error", "Failed to save product default banner","");

						</script>';

						return;

					}

					/*=============================================
		 			Agrupar información para Horizontal Slider
					=============================================*/

					if(isset($_FILES['hSlider']["tmp_name"]) && !empty($_FILES['hSlider']["tmp_name"])){

						$image = $_FILES['hSlider'];
						$folder = "img/products";
						$path =  explode("_",$_POST["categoryProduct"])[1]."/horizontal";
						$width = 1920;
						$height = 358;
						$name = mt_rand(10000, 99999);

						$saveImageHSlider  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

						if($saveImageHSlider == "error"){

								echo '<script>

									fncFormatInputs();
									fncSweetAlert("error","Failed to save image product horizontal slider","");

								</script>';

								return;

						}


					}else{

						echo '<script>

						fncFormatInputs();
						fncSweetAlert("error","Failed to save product horizontal slider","");

						</script>';

						return;

					}




					/*=============================================
					Agrupar información de oferta
					=============================================*/

					if(!empty($_POST["type_offer"]) && !empty($_POST["value_offer"]) && !empty($_POST["date_offer"]) ){

						if(preg_match('/^[.\\,\\0-9]{1,}$/', $_POST['value_offer'])){

							$offer_product = array($_POST["type_offer"], $_POST["value_offer"], $_POST["date_offer"] );

							$offer_product = json_encode($offer_product);

						}else{

							echo '<script>

							fncFormatInputs();
							fncSweetAlert("error","Error in the syntax of the fields of Offer","");

							</script>';

							return;

						}

					}else{

						$offer_product = null;

					}

					/*=============================================
					Validar información de precio venta, precio envío, dias de entrega y stock
					=============================================*/

					if(isset($_POST["price"]) &&
					preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["price"]) &&
					isset($_POST["shipping"]) &&
					preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["shipping"]) &&
					isset($_POST["delivery_time"]) &&
					preg_match('/^[0-9]{1,}$/', $_POST["delivery_time"]) &&
					isset($_POST["stock"]) &&
					preg_match('/^[0-9]{1,}$/', $_POST["stock"])
					){


						/*=============================================
			 			Data del producto
						=============================================*/

						$dataProduct = array(

							"approval_product"=>"review",
			        "feedback_product"=>"Your product is under review",
			        "state_product"=>"show",
			        "id_store_product"=>$idStore,
			        "id_category_product"=>explode("_",$_POST["categoryProduct"])[0],
			        "id_subcategory_product"=>explode("_",$_POST["subCategoryProduct"])[0],
			        "title_list_product"=>  explode("_",$_POST["subCategoryProduct"])[1],
			        "name_product"=>TemplateController::capitalize($_POST["nameProduct"]),
			        "url_product"=>  $_POST["urlProduct"],
			        "image_product"=> $saveImageProduct,
			        "price_product"=>$_POST["price"],
			        "shipping_product"=>$_POST["shipping"],
			        "stock_product"=>$_POST["stock"],
			        "delivery_time_product"=>$_POST["delivery_time"],
			        "offer_product"=>$offer_product,
			        "description_product"=>urlencode(htmlentities($_POST["descriptionProduct"])),
			        "summary_product"=>json_encode($summaryProduct),
			        "details_product"=> json_encode($detailsProduct),
			        "specifications_product"=>$specificationsProduct,
			        "gallery_product"=> json_encode($galleryProduct),
			        "video_product"=>"",
			        "top_banner_product"=>"",
			        "default_banner_product"=>$saveImageDefaultBanner,
			        "horizontal_slider_product"=> $saveImageHSlider,
			        "vertical_slider_product"=>"",
			        "reviews_product"=>"",
			        "tags_product"=>json_encode(explode(",",$_POST["tagsProduct"])),
			        "sales_product"=>"",
			        "views_product"=>"",
			        "date_created_product"=>date("Y-m-d")
						);

						$url = CurlController::api()."products?token=".$_SESSION["user"]->token_user;
						$method = "POST";
						$fields = json_encode($dataProduct);
						$header = array(

						   'Content-Type: application/json' //x-www-form-urlencoded

						);

						$saveProduct = CurlController::request($url, $method, $fields, $header);
						if($saveProduct->status == 200){

							echo '<script>

								fncFormatInputs();

								fncSweetAlert(
									"success",
									"Your records were created successfully",
									"'.TemplateController::path().'store/product"
								);

							</script>';



						}else{

							echo '<script>

							fncFormatInputs();
							fncSweetAlert("error","Error saving product","");

						</script>';


						}


					}else{

		  				echo '<script>

							fncFormatInputs();
							fncSweetAlert("error","Error in the syntax of the fields of Price","");

						</script>';

						return;

		  			}

				}


			}else{

				echo '<script>

					fncFormatInputs();
						fncSweetAlert("error","Error in the syntax of the fields of Name Product","");

				</script>';

			}

 


		}// fin post name product

	}

	/*=============================================
	Registro de nueva tienda y producto
	=============================================*/

	public function editStore(){

		/*=============================================
		Validar que si vengan variables Post
		=============================================*/

		if( isset($_POST["idStore"]) ){

			/*=============================================
		 	Validar sintaxis lado servidor
			=============================================*/

			if(preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,1000}$/', $_POST["aboutStore"]) &&
		       preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["cityStore"]) &&
		       preg_match('/^[-\\(\\)\\0-9 ]{1,}$/', $_POST["phoneStore"]) &&
		       preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["addressStore"])){

		       	/*=============================================
		 		Guardar imagen del logo
				=============================================*/

				if(isset($_FILES['logoStore']["tmp_name"]) &&
				   !empty($_FILES['logoStore']["tmp_name"])){

					$imageLogo = $_FILES['logoStore'];
			  		$folderLogo = "img/stores";
			  		$pathLogo = $_POST["urlStore"];
			  		$widthLogo = 270;
			  		$heightLogo = 270;
			  		$nameLogo = "logo";

			  		$saveImageLogo = TemplateController::saveImage($imageLogo, $folderLogo, $pathLogo, $widthLogo, $heightLogo, $nameLogo);

			  		if($saveImageLogo == "error"){

			  			echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving default logo image");

						</script>';

						return;

			  		}

				}else{

					$saveImageLogo = $_POST["logoStoreOld"];

				}

				/*=============================================
		 		Guardar imagen de la portada
				=============================================*/

				if(isset($_FILES['coverStore']["tmp_name"]) &&
				    !empty($_FILES['coverStore']["tmp_name"])){

					/*=============================================
		 			Guardar imagen de la portada
					=============================================*/

					$imageCover = $_FILES['coverStore'];
			  		$folderCover = "img/stores";
			  		$pathCover = $_POST["urlStore"];
			  		$widthCover = 1424;
			  		$heightCover = 768;
			  		$nameCover = "cover";

			  		$saveImageCover = TemplateController::saveImage($imageCover, $folderCover, $pathCover, $widthCover, $heightCover, $nameCover);

			  		if($saveImageCover == "error"){

			  			echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving default cover image");

						</script>';

						return;

			  		}


				}else{

					$saveImageCover = $_POST["coverStoreOld"];

				}

	  			/*=============================================
 				Agrupar redes sociales
				=============================================*/
				$socialNetwork = array();

				if(isset($_POST["facebookStore"]) && !empty($_POST["facebookStore"])){

					array_push($socialNetwork, ["facebook"=>"https://facebook.com/".$_POST["facebookStore"]]);

				}

				if(isset($_POST["instagramStore"]) && !empty($_POST["instagramStore"])){

					array_push($socialNetwork, ["instagram"=>"https://instagram.com/".$_POST["instagramStore"]]);

				}

				if(isset($_POST["twitterStore"]) && !empty($_POST["twitterStore"])){

					array_push($socialNetwork, ["twitter"=>"https://twitter.com/".$_POST["twitterStore"]]);

				}

				if(isset($_POST["linkedinStore"]) && !empty($_POST["linkedinStore"])){

					array_push($socialNetwork, ["linkedin"=>"https://linkedin.com/".$_POST["linkedinStore"]]);

				}

				if(isset($_POST["youtubeStore"]) && !empty($_POST["youtubeStore"])){

					array_push($socialNetwork, ["youtube"=>"https://youtube.com/".$_POST["youtubeStore"]]);

				}

				if(count($socialNetwork) > 0){

					$socialNetwork = json_encode($socialNetwork);

				}else{

					$socialNetwork = null;
				}

	  			/*=============================================
 				Organizar los datos que se subiran a BD de la tienda
				=============================================*/
				$dataStore = "logo_store=".$saveImageLogo."&cover_store=".$saveImageCover."&about_store=".$_POST["aboutStore"]."&abstract_store=". substr($_POST["aboutStore"], 0, 100)."..."."&email_store=".$_POST["emailStore"]."&country_store=".explode("_", $_POST["countryStore"])[0]."&city_store=".$_POST["cityStore"]."&phone_store=".explode("_", $_POST["countryStore"])[1]."_".$_POST["phoneStore"]."&address_store=".$_POST["addressStore"]."&socialnetwork_store=".$socialNetwork;

				$url = CurlController::api()."stores?id=".$_POST["idStore"]."&nameId=id_store&token=".$_SESSION["user"]->token_user;
				$method = "PUT";
				$fields = $dataStore;
				$header = array(

				   "Content-Type" =>"application/x-www-form-urlencoded"

				);

				$editStore = CurlController::request($url, $method, $fields, $header);

				if($editStore->status == 200){

					echo '<script>

						fncFormatInputs();

						fncSweetAlert(
							"success",
							"Your store were edited successfully",
							"'.TemplateController::path().'account&my-store"
						);

					</script>';

				}else{

					echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving store");

						</script>';

						return;
				}

			}else{

				echo '<script>

					fncFormatInputs();

					fncNotie(3, "Error in the syntax of the fields");

				</script>';

			}

		}

	}


	/*=============================================
	Editar producto
	=============================================*/

	static public function editProduct(){

		if(isset($_POST["id_product"])){

			/*=============================================
 			Agrupar Resumen del Producto
			=============================================*/

			if(isset($_POST["inputSummary"])){

				$summaryProduct = array();

				for($i = 0; $i < $_POST["inputSummary"]; $i++){//0,1,2,3

					array_push($summaryProduct, $_POST["summaryProduct_".$i]);

				}

			}

			/*=============================================
 			Agrupar Detalles del Producto
			=============================================*/

			if(isset($_POST["inputDetails"])){

				$detailsProduct = array();

				for($i = 0; $i < $_POST["inputDetails"]; $i++){

					$detailsProduct[$i] = (object)["title"=>$_POST["detailsTitleProduct_".$i],"value"=>$_POST["detailsValueProduct_".$i]];

				}

			}

			/*=============================================
 			Agrupar Especificaciones del Producto
			=============================================*/

			if(isset($_POST["inputSpecifications"])){

				$specificationsProduct = array();

				for($i = 0; $i < $_POST["inputSpecifications"]; $i++){

					$specificationsProduct[$i] = (object)[$_POST["specificationsTypeProduct_".$i]=>explode(",",$_POST["specificationsValuesProduct_".$i])];
				}

				$specificationsProduct = json_encode($specificationsProduct);

				if($specificationsProduct == '[{"":[""]}]'){

					$specificationsProduct = null;
				}

			}else{

				$specificationsProduct = null;

			}

			/*=============================================
	 		Guardar imagen del logo
			=============================================*/

			if(isset($_FILES['imageProduct']["tmp_name"]) && !empty($_FILES['imageProduct']["tmp_name"])){

				$imageProduct = $_FILES['imageProduct'];
		  		$folderProduct = "img/products";
		  		$pathProduct = explode("_",$_POST["categoryProduct"])[1];
		  		$widthProduct = 300;
		  		$heightProduct = 300;
		  		$nameProduct = $_POST["urlProduct"];

		  		$saveImageProduct = TemplateController::saveImage($imageProduct, $folderProduct, $pathProduct, $widthProduct, $heightProduct, $nameProduct);

		  		if($saveImageProduct == "error"){

		  			echo '<script>

						fncFormatInputs();

						fncNotie(3, "Error saving product image");

					</script>';

					return;

		  		}

			}else{

				$saveImageProduct = $_POST['imageProductOld'];

			}

			/*=============================================
 			Guardar imágenes galería
			=============================================*/

			$galleryProduct = array();
			$count = 0;
			$count2 = 0;
			$continueEdit = false;

			if(!empty($_POST['galleryProduct'])){

				foreach (json_decode($_POST['galleryProduct'],true) as $key => $value) {

					$count ++;

					$image["tmp_name"] = $value["file"];
					$image["type"] = $value["type"];
					$image["mode"] = "base64";

					$folder = "img/products";
					$path =  explode("_",$_POST["categoryProduct"])[1]."/gallery";
					$width = $value["width"];
					$height = $value["height"];
					$name = mt_rand(10000, 99999);

					$saveImageGallery  = TemplateController::saveImage($image, $folder, $path, $width, $height, $name);

					array_push($galleryProduct, $saveImageGallery);

					if(count($galleryProduct) == $count){

						if(!empty($_POST['galleryProductOld'])){

							foreach (json_decode($_POST['galleryProductOld'],true) as $key => $value) {

								$count2++;
								array_push($galleryProduct, $value);
							}

							if(count(json_decode($_POST['galleryProductOld'],true)) == $count2){

			  					$continueEdit = true;

			  				}

						}else{

							$continueEdit = true;
						}

					}

				}

			}else{

				if(!empty($_POST['galleryProductOld'])){

					$count2 = 0;

					foreach (json_decode($_POST['galleryProductOld'],true) as $key => $value) {

						$count2++;
						array_push($galleryProduct, $value);
					}

					if(count(json_decode($_POST['galleryProductOld'],true)) == $count2){

	  					$continueEdit = true;

	  				}

				}

			}

			/*=============================================
 			Eliminamos archivos basura del servidor
			=============================================*/

			if(!empty($_POST['deleteGalleryProduct'])){

				foreach (json_decode($_POST['deleteGalleryProduct'],true) as $key => $value) {

					unlink("views/img/products/".explode("_",$_POST["categoryProduct"])[1]."/gallery/".$value);

				}

			}

			/*=============================================
 			Validamos que no venga la galería vacía
			=============================================*/

			if(count($galleryProduct) == 0){

  				echo '<script>

					fncFormatInputs();

					fncNotie(3, "The gallery cannot be empty");

				</script>';

				return;

  			}

			if($continueEdit){

				/*=============================================
	 			Agrupar información para Top Banner
				=============================================*/

				if(isset($_FILES['topBanner']["tmp_name"]) && !empty($_FILES['topBanner']["tmp_name"])){

					$imageTopBanner = $_FILES['topBanner'];
			  		$folderTopBanner = "img/products";
			  		$pathTopBanner = explode("_",$_POST["categoryProduct"])[1]."/top";
			  		$widthTopBanner = 1920;
			  		$heightTopBanner = 80;
			  		$nameTopBanner = mt_rand(10000, 99999);

			  		$saveImageTopBanner = TemplateController::saveImage($imageTopBanner, $folderTopBanner, $pathTopBanner, $widthTopBanner, $heightTopBanner, $nameTopBanner);

			  		if($saveImageTopBanner == "error"){

			  			echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving top banner image");

						</script>';

						return;

			  		}else{

			  			unlink("views/".$folderTopBanner."/".$pathTopBanner."/".$_POST["topBannerOld"]);
			  		}

			  	}else{

			  		$saveImageTopBanner = $_POST["topBannerOld"];
			  	}

			  	if(isset($_POST['topBannerH3Tag']) &&
	  			   preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH3Tag']) &&
	  				isset($_POST['topBannerP1Tag']) &&
	  				preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP1Tag']) &&
	  				isset($_POST['topBannerH4Tag']) &&
	  				preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH4Tag']) &&
	  			    isset($_POST['topBannerP2Tag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP2Tag']) &&
	  			    isset($_POST['topBannerSpanTag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerSpanTag']) &&
	  			    isset($_POST['topBannerButtonTag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerButtonTag'])
	  			){

	  				$topBanner = (object)[

	  					"H3 tag"=>TemplateController::capitalize($_POST['topBannerH3Tag']),
	  					"P1 tag"=>TemplateController::capitalize($_POST['topBannerP1Tag']),
	  					"H4 tag"=>TemplateController::capitalize($_POST['topBannerH4Tag']),
	  					"P2 tag"=>TemplateController::capitalize($_POST['topBannerP2Tag']),
	  					"Span tag"=>TemplateController::capitalize($_POST['topBannerSpanTag']),
	  					"Button tag"=>TemplateController::capitalize($_POST['topBannerButtonTag']),
	  					"IMG tag"=>$saveImageTopBanner

	  				];

	  			}else{

					echo '<script>

						fncFormatInputs();

						fncNotie(3, "Error in the syntax of the fields of Top Banner");

					</script>';

					return;

				}

				/*=============================================
	 			Agrupar información para Default Banner
				=============================================*/

				if(isset($_FILES['defaultBanner']["tmp_name"]) && !empty($_FILES['defaultBanner']["tmp_name"])){

					$imageDefaultBanner = $_FILES['defaultBanner'];
			  		$folderDefaultBanner = "img/products";
			  		$pathDefaultBanner = explode("_",$_POST["categoryProduct"])[1]."/default";
			  		$widthDefaultBanner = 570;
			  		$heightDefaultBanner = 210;
			  		$nameDefaultBanner = mt_rand(10000, 99999);

			  		$saveImageDefaultBanner = TemplateController::saveImage($imageDefaultBanner, $folderDefaultBanner, $pathDefaultBanner, $widthDefaultBanner, $heightDefaultBanner, $nameDefaultBanner);

			  		if($saveImageDefaultBanner == "error"){

			  			echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving default banner image");

						</script>';

						return;

			  		}else{

			  			unlink("views/".$folderDefaultBanner."/".$pathDefaultBanner."/".$_POST["defaultBannerOld"]);
			  		}

			  	}else{

			  		$saveImageDefaultBanner = $_POST["defaultBannerOld"];
			  	}

			  	/*=============================================
	 			Agrupar información para Horizontal Slider
				=============================================*/

				if(isset($_FILES['hSlider']["tmp_name"]) && !empty($_FILES['hSlider']["tmp_name"])){

					$imageHSlider = $_FILES['hSlider'];
			  		$folderHSlider = "img/products";
			  		$pathHSlider = explode("_",$_POST["categoryProduct"])[1]."/horizontal";
			  		$widthHSlider = 1920;
			  		$heightHSlider = 358;
			  		$nameHSlider = mt_rand(10000, 99999);

			  		$saveImageHSlider = TemplateController::saveImage($imageHSlider, $folderHSlider, $pathHSlider, $widthHSlider, $heightHSlider, $nameHSlider);

			  		if($saveImageHSlider == "error"){

						echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving horizontal slider image");

						</script>';

						return;

			  		}else{

						unlink("views/".$folderHSlider."/".$pathHSlider."/".$_POST["hSliderOld"]);

					}

				}else{

					$saveImageHSlider  = $_POST["hSliderOld"];

				}

				if(isset($_POST['hSliderH4Tag']) &&
	  			   preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH4Tag']) &&
	  				isset($_POST['hSliderH3_1Tag']) &&
	  				preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_1Tag']) &&
	  				isset($_POST['hSliderH3_2Tag']) &&
	  				preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_2Tag']) &&
	  			    isset($_POST['hSliderH3_3Tag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_3Tag']) &&
	  			    isset($_POST['hSliderH3_4sTag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_4sTag']) &&
	  			    isset($_POST['hSliderButtonTag']) &&
	  			    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderButtonTag'])
	  			){

	  				$hSlider = (object)[

	  					"H4 tag"=>TemplateController::capitalize($_POST['hSliderH4Tag']),
	  					"H3-1 tag"=>TemplateController::capitalize($_POST['hSliderH3_1Tag']),
	  					"H3-2 tag"=>TemplateController::capitalize($_POST['hSliderH3_2Tag']),
	  					"H3-3 tag"=>TemplateController::capitalize($_POST['hSliderH3_3Tag']),
	  					"H3-4s tag"=>TemplateController::capitalize($_POST['hSliderH3_4sTag']),
	  					"Button tag"=>TemplateController::capitalize($_POST['hSliderButtonTag']),
	  					"IMG tag"=>$saveImageHSlider

	  				];

	  			}else{

					echo '<script>

						fncFormatInputs();

						fncNotie(3, "Error in the syntax of the fields of Horizontal Slider");

					</script>';

					return;

				}

				/*=============================================
	 			Agrupar información para Vertical Slider
				=============================================*/

				if(isset($_FILES['vSlider']["tmp_name"]) && !empty($_FILES['vSlider']["tmp_name"])){

					$imageVSlider = $_FILES['vSlider'];
			  		$folderVSlider = "img/products";
			  		$pathVSlider = explode("_",$_POST["categoryProduct"])[1]."/vertical";
			  		$widthVSlider = 263;
			  		$heightVSlider = 629;
			  		$nameVSlider = mt_rand(10000, 99999);

			  		$saveImageVSlider = TemplateController::saveImage($imageVSlider, $folderVSlider, $pathVSlider, $widthVSlider, $heightVSlider, $nameVSlider);

			  		if($saveImageVSlider == "error"){

			  			echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error saving vertical slider image");

						</script>';

						return;

			  		}else{

			  			unlink("views/".$folderVSlider."/".$pathVSlider."/".$_POST["vSliderOld"]);

			  		}

			  	}else{

			  		$saveImageVSlider = $_POST["vSliderOld"];
			  	}

			  	/*=============================================
				Agrupar información para el video
				=============================================*/

				if(!empty($_POST['type_video']) &&
					!empty($_POST['id_video'])
					){

					$video_product = array();

					if(preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,100}$/', $_POST['id_video'])){

						array_push($video_product, $_POST['type_video']);
						array_push($video_product, $_POST['id_video']);

						$video_product = json_encode($video_product);

						}else{

							echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error in the syntax of the fields of Video");

						</script>';

						return;

					}

				}else{

					$video_product = null;
				}

				/*=============================================
				Agrupar información de oferta
				=============================================*/

				if(!empty($_POST["type_offer"]) &&
					!empty($_POST["value_offer"]) &&
					!empty($_POST["date_offer"])
				){

					if(preg_match('/^[.\\,\\0-9]{1,}$/', $_POST['value_offer'])){

						$offer_product = array($_POST["type_offer"], $_POST["value_offer"], $_POST["date_offer"] );

						$offer_product = json_encode($offer_product);

					}else{

							echo '<script>

							fncFormatInputs();

							fncNotie(3, "Error in the syntax of the fields of Offer");

						</script>';

						return;

					}

				}else{

					$offer_product = null;
				}

				/*=============================================
				Validar información de precio venta, precio envío, dias de entrega y stock
				=============================================*/

				if(isset($_POST["price"]) &&
					preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["price"]) &&
					isset($_POST["shipping"]) &&
					preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["shipping"]) &&
					isset($_POST["delivery_time"]) &&
					preg_match('/^[0-9]{1,}$/', $_POST["delivery_time"]) &&
					isset($_POST["stock"]) &&
					preg_match('/^[0-9]{1,}$/', $_POST["stock"])
					){

					/*=============================================
		 			Crear los datos de la tienda
					=============================================*/

					$dataProduct = "description_product=".TemplateController::htmlClean(html_entity_decode(str_replace('+', '%2b', $_POST["descriptionProduct"])))."&summary_product=".json_encode($summaryProduct)."&details_product=".json_encode($detailsProduct)."&specifications_product=".$specificationsProduct."&tags_product=".json_encode(explode(",",$_POST["tagsProduct"]))."&image_product=".$saveImageProduct."&gallery_product=".json_encode($galleryProduct)."&top_banner_product=".json_encode($topBanner)."&default_banner_product=".$saveImageDefaultBanner."&horizontal_slider_product=".json_encode($hSlider)."&vertical_slider_product=".$saveImageVSlider."&video_product=".$video_product."&offer_product=".$offer_product."&price_product=".$_POST["price"]."&shipping_product=".$_POST["shipping"]."&delivery_time_product=".$_POST["delivery_time"]."&stock_product=".$_POST["stock"];

					$url = CurlController::api()."products?id=".$_POST["id_product"]."&nameId=id_product&token=".$_SESSION["user"]->token_user;
					$method = "PUT";
					$fields = $dataProduct;
					$header = array(

					   "Content-Type" =>"application/x-www-form-urlencoded"

					);

					$saveProduct = CurlController::request($url, $method, $fields, $header);

					if($saveProduct->status == 200){

						echo '<script>

							fncFormatInputs();

							fncSweetAlert(
								"success",
								"Your records were edite successfully",
								"'.TemplateController::path().'account&my-store"
							);

						</script>';



					}else{

						echo '<script>

						fncFormatInputs();

						fncNotie(3, "Error saving product");

					</script>';


					}

				}

			}

		}

	}

}
