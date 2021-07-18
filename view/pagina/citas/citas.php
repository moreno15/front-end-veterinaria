
<div class="content-wrapper" style="min-height: 1071.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Citas
             </h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="col-lg-12">
          <input type="hidden" id="path" value="<?= TemplateController::path() ?>">


        <?php
        if (isset($urlParams[1])) {

        if ($urlParams[1]=="reg-citas") {
            include 'reg-citas.php';
        }else if ($urlParams[1]=="lista-citas") {
            include 'lista-citas.php';
        }
      }else{
        include 'lista-citas.php';
      }

         ?>
        <!-- /.row -->
      </div>

      </div><!-- /.container-fluid -->


    </section>

    <!-- /.content -->
  </div>
