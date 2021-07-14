
<?php
$randomStart= rand(0, ($totalProducts-5));
// listado para slide horizontal


$url = CurlController::api()."relations?rel=products,categories&type=product,category&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=5&select=*";
$method = "GET";
$fields = array();
$header = array();

$productsHSlider = CurlController::request($url, $method, $fields, $header)->results;


 ?>
<!-- Page Content-->


<!--=====================================
Preload
======================================-->

<div class="container-fluid preloadTrue"  >

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

<!-- Main Slider   hero-slider-->

  <section class=" preloadFalse  "   style="  margin-top:80px;width: 100%;"  >

    <div class=" slide-h">
      <div class="row">
        <div class="col-lg-12">

          <div class="owl-carousel large-controls dots-inside"
          data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;loop&quot;: true,
            &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 3000 ,&quot; responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
            &quot;500&quot;:{&quot;items&quot;:1},&quot;630&quot;:{&quot;items&quot;:1},&quot;991&quot;:{&quot;items&quot;:1},&quot;1200&quot;:{&quot;items&quot;:1}} }" >


            <?php foreach ($productsHSlider as $key => $value):

            ?>
            <div class="item"  >
                <img class="img-item" src="img/products/<?php echo $value->url_category ?>/horizontal/<?php echo $value->horizontal_slider_product ?>"
                alt="<?php echo $value->name_product?>">
              <div class="col-lg-12   padding-bottom-2x text-md-left "  >
                <div class="from-bottom"  >
                  <?php if ($value->offer_product!=""): ?>
                    <h4 class="h2"><?php echo  $value->offer_product?> </h4>
                  <?php endif; ?>

                  <h3 class="h2"> <?php echo $value->name_product ?> </h3>
                </div>
                <a class="btn btn-primary scale-up delay-1" href="<?php echo $path."product/".$value->url_product ?>"> Comprar
                  <i class="icon-arrow-right"></i></a>
              </div>
            </div><!-- item -->
              <?php endforeach; ?>

          </div>
        </div>

      </div>
    </div>
  </section>
  <br>
