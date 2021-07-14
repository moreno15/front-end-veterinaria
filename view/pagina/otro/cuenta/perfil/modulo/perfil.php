<div class="col-lg-8">

  <div class="padding-top-2x mt-2 hidden-lg-up"></div>
  <form class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-fn">First Name</label>
        <input class="form-control form-control-square form-control-sm" type="text" id="account-fn" value="<?php echo $_SESSION["user"]->displayname_user ?>" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="account-email">E-mail Address</label>
        <input class="form-control form-control-square form-control-sm " type="email" id="account-email" value="<?php echo $_SESSION["user"]->email_user ?>" disabled>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="account-phone">Phone Number</label>
        <input class="form-control form-control-square form-control-sm " type="text" id="account-phone" value="<?php echo $_SESSION["user"]->phone_user ?>" required>
      </div>
    </div>
    <div class="col-12">

      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <button class="btn btn-primary margin-right-none  btn-sm" type="button" data-toast data-toast-position="topRight"
        data-toast-type="success" data-toast-icon="icon-check-circle" data-toast-title="Success!"
         data-toast-message="Your profile updated successfuly.">Guardar cambios</button>
      </div>
      <hr class="mt-2 mb-3">
    </div>
  </form>
  <form   method="post" class="row ps-form--account ps-tab-root needs-validation mt-3" novalidate>
    <div class="col-lg-12">
      <h4> <strong>Cambiar Contraseña</strong> </h4>
    </div>
    <div class="col-md-4">
      <div class="form-group input-group">
        <input
           class="form-control form-control-square form-control-sm"
           type="password"
           placeholder="Password"
           pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}"
           onchange="validateJS(event, 'password')"
           name="regPassword"
           required>
        <span class="input-group-addon"><i class="icon-lock"></i></span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group input-group">
        <input
           class="form-control form-control-square form-control-sm"
           type="password"
           placeholder="Password"
           pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}"
           onchange="validateJS(event, 'password')"
           name="changePassword"
           required>
        <span class="input-group-addon"><i class="icon-lock"></i></span>
      </div>

    </div>
    <?php

        $reset = new UsersController();
        $reset -> changePassword();

    ?>

    <div class="col-md-4">
        <button class="btn btn-primary  btn-sm" type="button" data-toast data-toast-position="topRight"
        data-toast-type="success" data-toast-icon="icon-check-circle" data-toast-title="Success!"
        data-toast-message="Your profile updated successfuly.">Actualizar contraseña</button>
   
    </div>
  </form>

</div>
