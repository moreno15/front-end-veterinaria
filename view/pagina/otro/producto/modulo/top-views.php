
<?php
$url = CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=url_category&equalTo=".$producto->url_category."&select=*";
$method = "GET";
$fields = array();
$header = array();

$totalProducRel = CurlController::request($url, $method, $fields, $header)->total;

$randomCategoryProd= rand(0, ($totalProducRel-5));


$url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$producto->url_category."&startAt=".$randomCategoryProd."&endAt=12&select=*";
$method = "GET";
$fields = array();
$header = array();

$productRelacionado = CurlController::request($url, $method, $fields, $header)->results;


 ?>
<section  class="container  "  >
  <h4 class="h4 pb-3  ">Peoducto Relacionado
    <a class=" " href="<?php echo $path.$producto->url_category ?>"> Ver más</a> <hr></h4>
  <div class="regular slider">


        <?php
         foreach ($productRelacionado as $key => $item):

            ?>
              <div class="product-card "    style="border-radius:0px; "  >
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


                  <a class="product-thumb" href="<?php echo $path.$item->url_product ?>">
                    <img src="img/products/<?php echo $item->url_category ?>/<?php echo $item->image_product ?>"
                    alt="<?php echo $item->name_product  ?>" >

                  </a>
                <div class="product-card-body">
                  <!--<div class="product-category"><a href="#">Smart home</a></div>-->
                  <h4 class="product-title">
                    <!--=====================================
                    Nombre del producto
                    ======================================-->
                   <a    href="<?php echo $path.$item->url_product ?>">
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
    $(".regular").slick({
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
