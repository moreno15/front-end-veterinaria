<?php
class UsersController{


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

				$url = CurlController::api()."usuario?login=true&token=no";
				$method = "POST";
				$fields = json_encode(array(
					"email_usuario" =>"testuser@gmail.com",// $_POST["loginEmail"],
					"password_usuario" => "1234"//$_POST["loginPassword"]
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

					echo '<div class="alert alert-danger">'.$login.'</div>

						<script>
							fncSweetAlert("error", "'.$login.'", "");
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
