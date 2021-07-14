<div class="col-lg-12" id="content-store">
  <div class="padding-top-2x mt-2 hidden-lg-up"></div>
  <div class="row margin-bottom-2x"   >

      <h1>¿Nuevo en MarketPlace?</h1>

      <h4  >Únase a un mercado donde cerca de 50 millones de compradores
      la tienda mundial de artículos únicos</h4>



  </div>

  <div class="row">

     <div class="col-lg-12 margin-bottom-1x">

          <div class="container card text-center card-store">
            <div class="row">
              <div class="col-lg-8"   >
                <div class="row">
                  <div class="col-lg-4">
                    <img src="img/shop-2.jpg" class="img-fluid">
                  </div>
                  <div class="col-lg-8">
                      <h4 class="margin-top-2x">Registrese nos pondremos en contacto en menos de 24 horas</h4>
                  </div>
                </div>
              </div>
              <div class="col-lg-4" >
                <button style="font-size:12px; "
               class="btn btn-primary mt-5 "
               role="tab"
                data-toggle="tab"
                href="#terms"
                >
                     Acepta terminos y condiciones
                </button>
              </div>

            </div>
          </div>
      </div>
  </div>


  <div class="container card-form "   style="box-shadow: 2px 2px 5px 0px ;">
      <div class="row justify-content-center ">
        <div class="col-lg-9 ">
            <form    method="post" enctype="multipart/form-data"   >

                <input type="hidden" value="<?php echo CurlController::api() ?>" id="urlApi">

                      <div class="tab-content" id="tabContent" style="border:none">
                        <?php include 'modulo/terms.php' ?>
                        <?php include 'modulo/form-store.php' ?>
                        <?php //include 'modulo/product.php' ?>
                      </div>
            </form>
        </div>
      </div>
    </div>

</div>
