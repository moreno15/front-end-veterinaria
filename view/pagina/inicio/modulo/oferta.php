
<?php

/*=============================================
Traer 2 productos aleatoriamente
=============================================*/

$productsDefaultBanner = array_slice($productsHSlider, 0, 2);


?>

<!--=====================================
Preload
======================================-->

<div class="container-fluid preloadTrue">

   <!--  <div class="spinner-border text-muted my-5"></div> -->

   <div class="container">

       <div class="ph-item border-0">

            <div class="ph-col-4">

                <div class="ph-row">

                    <div class="ph-col-10"></div>

                    <div class="ph-col-10 big"></div>

                    <div class="ph-col-6 big"></div>

                    <div class="ph-col-6 empty"></div>

                    <div class="ph-col-6 big"></div>

                </div>

            </div>

            <div class="ph-col-8">

               <div class="ph-picture"></div>

            </div>

        </div>

    </div>

</div>

<!--=====================================
Load
======================================-->

<section  class="container   padding-bottom-2x preloadFalse">

  <div class="row">
    <div class="col-lg-12">
      <h4 class="h4 pb-3  ">Ofertas de Hoy <a class=" " href="shop-grid-ls.html">Ver más</a> </h4>
    </div>

        <?php foreach ($productsDefaultBanner as $key => $value): ?>

            <div class="col-lg-6 col-sm-6" style="margin-top:10px">
                <a   href="<?php echo $path."product/".$value->url_product ?>">
                    <img src="img/products/<?php echo $value->url_category ?>/default/<?php echo $value->default_banner_product ?>" alt="<?php echo $value->name_product ?>">
                </a>
            </div>

        <?php endforeach ?>
      </div>
</section>
