<!--=====================================
 Validar veracidad del correo electrónico
======================================-->

<?php


if(isset($urlParams[2])){

    $verify = base64_decode($urlParams[2]);

    /*=============================================
    Validamos que el usuario si exista
    =============================================*/

    $url = CurlController::api()."users?linkTo=email_user&equalTo=".$verify."&select=id_user";
    $method = "GET";
    $fields = array();
    $header = array();

    $item = CurlController::request($url, $method, $fields, $header);

    if(!empty($item)){

        if($item->status == 200){

            /*=============================================
           Actualizar el campo de verificación
            =============================================*/

            $url = CurlController::api()."users?id=".$item->results[0]->id_user."&nameId=id_user&token=no";
            $method = "PUT";
            $fields =  "verification_user=1";
            $header = array();

            $verificationUser = CurlController::request($url, $method, $fields, $header);

            if($verificationUser->status == 200){

                echo '<div class="alert alert-success text-center">Your account has been verified successfully, you can now login</div>';
            }
        }

    }else{

        echo '<div class="alert alert-danger text-center">Failed to verify account, email does not exist</div>';

    }


}


?>

<div class="col-12">
  <ul class="nav nav-tabs justify-content-center"   style="border:none">
    <li class="nav-item " >
             <a  class="nav-link "  href="<?php echo $path."account&login" ?>" style="color:orange" > Login </a>
    </li>
    <li class="nav-item  " >
             <a class="nav-link" href="<?php echo $path."account&newaccount" ?>"    >Registrar </a>
     </li>
   </ul>

    <div class="row" style="border:none">
            <div  class="col-lg-12"  >
              <div class="row justify-content-center">
                <div class="col-lg-4 margin-bottom-1x ">
                   <div class="card text-center"  >
                     <div class="card-body">
                       <form class="needs-validation" novalidate method="post">
                           <div class="" id="sign-in">
                             <div class="row margin-bottom-1x">
                               <div class="col-xl-6 col-md-6 col-sm-4"><a    class="  btn-sm btn-block facebook-btn" href="#"><i class="socicon-facebook"></i>&nbsp;Facebook </a></div>
                               <div class="col-xl-6 col-md-6 col-sm-4"><a  class="  btn-sm btn-block google-btn" href="#"><i class="fa fa-google"></i>&nbsp; Google</a></div>
                             </div>
                             <h4 class="margin-bottom-1x">o ingrese un correo personalizado</h4>
                             <div class="form-group input-group">
                               <input
                               class="form-control"
                               type="email"
                               placeholder="Email address"
                               pattern="[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                               onchange="validateJS(event,'email')"
                               name="loginEmail"
                               required>

                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">Please fill in this field correctly.</div>
                               <span class="input-group-addon"><i class="icon-mail"></i></span>
                             </div>
                             <div class="form-group input-group">
                               <input
                               class="form-control"
                               type="password"
                               placeholder="Password"
                               pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}"
                               onchange="validateJS(event, 'password')"
                               name="loginPassword"
                               required>

                               <div class="valid-feedback">Valid.</div>
                               <div class="invalid-feedback">Please fill in this field correctly.</div>
                               <span class="input-group-addon"><i class="icon-lock"></i></span>
                             </div>
                             <?php

                                 $login = new UsersController();
                                 $login -> login();

                             ?>
                             <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">

                               <div class="custom-control custom-checkbox">
                                 <input  type="checkbox" id="remember-me" name="remember-me" onchange="remember(event)">

                                <label for="remember-me">Remember me</label>
                               </div>
                               <a class="navi-link" href="#"  data-toggle="modal" data-target="#modalCentered" >Forgot password?</a>
                             </div>
                           <button class="btn btn-outline-primary btn-sm" href="#">Iniciar Sesión</button>
                           </div>
                         </form>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

      </div>
</div>

<div class="modal fade" id="modalCentered" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Recuperar contraseña</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate method="post">
                <div class="" id="sign-in">

                  <div class="form-group input-group">
                    <input
                    class="form-control"
                    type="email"
                    placeholder="Email address"
                    pattern="[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                    onchange="validateJS(event,'email')"
                    name="resetPassword"
                    required>

                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill in this field correctly.</div>
                    <span class="input-group-addon"><i class="icon-mail"></i></span>
                  </div>
                  <?php

                      $reset = new UsersController();
                      $reset -> resetPassword();

                  ?>
                <button class="btn btn-outline-secondary btn-sm"  type="submit">Enviar</button>
                <br>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
