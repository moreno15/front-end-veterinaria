<?php
/*TRAEMOS PRODUCTOS MAS vendido de la categoria sales_product getdataProductCategorySales*/

$url = CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&orderBy=sales_product&orderMode=DESC&startAt=".$randomStart."&endAt=12&select=*";
$method = "GET";
$fields = array();
$header = array();


$bestsalesItems = CurlController::request($url, $method, $fields, $header)->results;

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

<section  class="container padding-bottom-2x mb-2 preloadFalse">
  <h4 class="h4 pb-3  "> Productos más vendidos
    <a class=" " href="shop-grid-ls.html"> Ver más</a> <hr></h4>
    <div class="regular_prod slider">

          <?php
           foreach ($bestsalesItems as $key => $item):

              ?>
                <div class="product-card preloadFalse"    style="border-radius:0px; "  >
                  <!--=====================================
                  Descuento de oferta o fuera de stock
                  ======================================-->

                  <?php if ($item->stock_product == 0): ?>

                      <div class="product-badge bg-secondary border-default text-body">Agotado</div>

                  <?php else: ?>

                      <?php if ($item->offer_product != null): ?>

                          <div  class="product-badge bg-danger" style="left:60%">
                          -

                            <?php

                            echo  TemplateController::offerDiscount(

                                $item->price_product,
                                json_decode($item->offer_product,true)[1],
                                json_decode($item->offer_product,true)[0]

                            );

                            ?>
                            %
                        </div>

                      <?php endif ?>

                  <?php endif ?>


                    <a class="product-thumb" href="<?php echo $path."product/".$item->url_category."/".$item->url_product ?>">
                      <img src="img/products/<?php echo $item->url_category ?>/<?php echo $item->image_product ?>"
                      alt="<?php echo $item->name_product  ?>" >

                    </a>
                  <div class="product-card-body">
                    <div class="product-category">MARCA</div>

                    <h4 class="product-title  ">

                      <!--=====================================
                      Nombre del producto
                      ======================================-->
                     <a    href="<?php echo $path."product/".$item->url_product ?>">
                       <?php echo $item->name_product?></a>

                   </h4>
                    <div class="raiting-product"  >
                      <?php

                          $reviews = TemplateController::averageReviews(
                              json_decode($item->reviews_product,true)
                          );

                          if($reviews > 0){

                              for($i = 0; $i < 5; $i++){

                                  if($reviews < ($i+1)){

                                      echo '<i class="icon-star "  ></i>';

                                  }else{

                                       echo '<i class="icon-star " style="color:orange"   ></i>';

                                  }

                              }

                          }else{

                              for($i = 0; $i < 5; $i++){

                                  echo '<i class="icon-star "    ></i>';

                              }

                          }

                      ?>


                    </div>
                    <h4 class="product-price">

                      <!--=====================================
                      El precio en oferta del producto
                      ======================================-->

                      <?php if ($item->offer_product != null): ?>



                              <?php
                                  echo "S/".TemplateController::offerPrice(

                                      $item->price_product,
                                      json_decode($item->offer_product,true)[1],
                                      json_decode($item->offer_product,true)[0]

                                  );

                              ?>

                              <del style="color:red"> S/.<?php echo  $item->price_product ?></del>


                      <?php else: ?>

                           <?php echo "S/.".$item->price_product  ?>

                       <?php endif ?>
                    </h4>
                  </div>
                </div>



          <?php endforeach; ?>
    </div>
</section>

<script type="text/javascript">
  $(document).on('ready', function() {
    $(".regular_prod").slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 5,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: false
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false
          }
        }
      ]

     });
    });

</script>
