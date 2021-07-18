<?php
class UsersController{

	/*=============================================
	Registro de usuarios
	=============================================*/

	public function register(){

		if(isset($_POST["regEmail"])){

			/*=============================================
			Validamos la sintaxis de los campos
			=============================================*/

			if(preg_match( '/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["regFirstName"] ) &&
			   preg_match( '/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["regLastName"] ) &&
			   preg_match( '/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"] ) &&
			     preg_match( '/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["regPassword"] )
			){

				$displayname = TemplateController::capitalize(strtolower($_POST["regFirstName"]))." ".TemplateController::capitalize(strtolower($_POST["regLastName"]));
				$username = strtolower(explode("@",$_POST["regEmail"])[0]);
				$email =  strtolower($_POST["regEmail"]);

				$url = CurlController::api()."users?register=true&token=no";
				$method = "POST";
				$fields = json_encode(array(

					"rol_user" => "default",
					"displayname_user" => $displayname,
					"username_user" => $username,
					"email_user" => $email,
					"password_user" => $_POST["regPassword"],
					"method_user" => "direct",
					"date_created_user" => date("Y-m-d")

				)
			);

				$header = array(

				   'Content-Type: application/json' //x-www-form-urlencoded
				);


				$register = CurlController::request($url, $method, $fields, $header);

				if($register->status == 200){

					$name = $displayname;
					$subject = "Verify your account";
					$email = $email;
					$message = "We must verify your account so that you can enter our Marketplace";
					$url = TemplateController::path()."login&".base64_encode($email);

					$sendEmail = TemplateController::sendEmail($name, $subject, $email, $message, $url);

					if($sendEmail == "ok"){

						echo '<div class="alert alert-success">Registered user successfully, confirm your account in your email (check spam)</div>

						<script>

							fncFormatInputs()

						</script>

						';

					}else{

						echo '<div class="alert alert-danger">'.$sendEmail.'</div>

						<script>

							fncFormatInputs()

						</script>

						';

					}

				}


			}else{

				echo '<div class="alert alert-danger">Error in the syntax of the fields</div>

				<script>

					fncFormatInputs()

				</script>

				';

			}



		}

	}

	/*=============================================
	Login de usuarios
	=============================================*/

	public function login(){

		if(isset($_POST["loginEmail"])){

			/*=============================================
			Validamos la sintaxis de los campos
			=============================================*/

			/*if(preg_match( '/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginEmail"] ) &&
			     preg_match( '/^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/', $_POST["loginPassword"] )
			){*/

				echo '<script>

					fncSweetAlert("loading", "", "");

				</script>';
				$crypt_pwd = crypt($_POST["loginPassword"], '$2a$07$azybxcags23425sdg23sdfhsd$');
				$url = CurlController::api()."usuario?login=true&token=no";
				$method = "POST";
				$fields = json_encode(array(
					"email_usuario" => $_POST["loginEmail"],
					"password_usuario" => $_POST["loginPassword"]//$crypt_pwd
						)
					);

				$header = array(

				   'Content-Type: application/json' //x-www-form-urlencoded
				);

				$login = CurlController::request($url, $method, $fields, $header);

				if($login->status == 200){

					if($login->results[0]->verificacion_usuario == 1){

						$_SESSION["user"] = $login->results[0];

						echo '<script>
								fncFormatInputs();
								localStorage.setItem("token_user","'.$_SESSION["user"]->token_usuario.'")
								window.location = "'.TemplateController::path().'";

							</script>
						';

					}else{

						echo '<div class="alert alert-danger">Your account has not been verified yet, please check your email inbox.</div>


							<script>

								fncSweetAlert("error", "La cuenta no esta Verificado", "");
								fncFormatInputs()
							</script>
						';

					}

				}else{

					echo '<div class="alert alert-danger">'.$login->results.'</div>

						<script>
							fncSweetAlert("error", "'.$login->results.'", "");
							fncFormatInputs()

						</script>

					';

				}

			/*}else{

				echo '<div class="alert alert-danger">Error in the syntax of the fields</div>

					<script>

						fncSweetAlert("error", "en el sintaxis ", "");
						fncFormatInputs()

					</script>
				';

			}*/

		}
	}


}
