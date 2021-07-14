
<div class="col-12">
  <ul class="nav nav-tabs justify-content-center"   style="border:none">
      <li class="nav-item  " >
               <a  class="nav-link"  href="<?php echo $path."account&login" ?>"  > Login </a>
      </li>
      <li class="nav-item  " >
               <a class="nav-link " href="<?php echo $path."account&newaccount" ?>" style="color:orange"    >Registrar </a>
       </li>
   </ul>

    <div class="row"  >

            <div  class="col-lg-12" >
              <div class="row justify-content-center">
                <div class="col-lg-4 margin-bottom-1x ">
                   <div class="card text-center">
                     <div class="card-body">
                       <form class=" needs-validation" novalidate method="post">
                         <input type="hidden" value="<?php  echo CurlController::api() ?>" id="urlApi">
                         <div class="row margin-bottom-1x">
                           <div class="col-xl-6 col-md-6 col-sm-4"><a    class="  btn-sm btn-block facebook-btn" href="#"><i class="socicon-facebook"></i>&nbsp;Facebook </a></div>
                           <div class="col-xl-6 col-md-6 col-sm-4"><a  class="  btn-sm btn-block google-btn" href="#"><i class="fa fa-google"></i>&nbsp; Google</a></div>
                         </div>
                         <div class="form-group input-group">
                           <input
                                class="form-control"
                                type="text"
                                placeholder="First name"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                                onchange="validateJS(event, 'text')"
                                name="regFirstName"
                                required>
                           <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill in this field correctly.</div>
                         </div>
                         <div class="form-group input-group">
                           <input
                               class="form-control"
                               type="text"
                               placeholder="Last name"
                               pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                               onchange="validateJS(event, 'text')"
                               name="regLastName"
                               required>
                           <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill in this field correctly.</div>
                         </div>
                           <div class="form-group input-group">
                             <input
                                class="form-control"
                                type="email"
                                placeholder="Email address"
                                pattern="[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                                onchange="validateEmailRepeat(event)"
                                name="regEmail"
                                required> <span class="input-group-addon"><i class="icon-mail"></i></span>
                             <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill in this field correctly.</div>
                           </div>
                           <div class="form-group input-group">
                             <input
                                class="form-control"
                                type="password"
                                placeholder="Password"
                                pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}"
                                onchange="validateJS(event, 'password')"
                                name="regPassword"
                                required>
                             <span class="input-group-addon"><i class="icon-lock"></i></span>
                           </div>
                           <?php

                                $register = new UsersController();
                                $register -> register();

                            ?>
                           <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                             <div class="custom-control custom-checkbox">
                               <input class="custom-control-input" type="checkbox" id="remember_reg" checked>
                               <label class="custom-control-label" for="remember_me">Remember me</label>
                             </div><a class="navi-link" href="account-password-recovery.html">Forgot password?</a>
                           </div>
                         <button type="submit" class="btn btn-outline-primary btn-sm" href="#">Registrar</button>

                         </form>
                     </div>
                   </div>
                 </div>
               </div>
            </div>
      </div>
</div>
