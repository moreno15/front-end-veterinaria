<div class="content-wrapper" style="height:3000px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuario  <button type="button" class="btn btn-success btn-flat" name="button" data-toggle="modal" data-target="#md-reg-usuario"  >Nuevo Cliente</button>
             </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buttons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <input type="hidden" id="urlapiruc" value="<?php CurlController::apidni() ?>">
      <input type="hidden" id="path" value="<?= TemplateController::path() ?>">
      <input type="hidden" id="tipo" value="usuario" >
      <div class="container-fluid">


        <?php include "modelo/lista-usuario.php" ?>


      </div><!-- /.container-fluid -->
    </section>

      <?php include 'modelo/md-usuario.php'; ?>
    <!-- /.content -->
  </div>
