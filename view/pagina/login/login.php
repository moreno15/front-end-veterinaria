

      <div class="modal fade show"   aria-modal="true" role="dialog" style="padding-right: 17px; display: block;background-image: url('img/fondo.jpg'); ">
        <div class="modal-dialog" >
          <div class="modal-content" style="width:300px;margin-left:100px">
							<div class="modal-header text-center" style="background:#92027C;color:#fff">
									<a href="/" class="h2"><b>SAN CRISTOBAL</a>

							</div>
							<div class="modal-body">
								<p class="login-box-msg">Iniciar Sesión</p>

								<form   method="post">
									<div class="input-group mb-3">
										<input type="email" class="form-control"  name="loginEmail" placeholder="Email">
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-envelope"></span>
											</div>
										</div>
									</div>
									<div class="input-group mb-3">
										<input type="password" class="form-control" name="loginPassword"  placeholder="Password">
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-lock"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-8">

										</div>
										<?php

												$login = new UsersController();
												$login -> login();

										?>
										<!-- /.col -->
										<div class="col-4">
											<button type="submit"  class="btn btn-success btn-flat">Ingresar</button>
										</div>
										<!-- /.col -->
									</div>
								</form>

							</div>
							<!-- /.card-body -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
