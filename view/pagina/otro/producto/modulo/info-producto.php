<?php
$url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_product&equalTo=".$urlParams[1]."&select=*";
$method = "GET";
$fields = array();
$header = array();

$producto = CurlController::request($url, $method, $fields, $header)->results[0];
 $galeria=json_decode($producto->gallery_product);



 ?>

<!-- Page Content-->
<div class="container ">
  <div class="row">
    <!-- Poduct Gallery-->
    <div class="col-md-6" >


      <div class="  product-gallery mb-3"  style="border:none;">


        <div class="product-carousel owl-carousel gallery-wrapper"    data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: false, &quot;loop&quot;: true,
            &quot;autoplay&quot;: false, &quot;autoplayTimeout&quot;: 3000 ,&quot; responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
            &quot;500&quot;:{&quot;items&quot;:1},&quot;630&quot;:{&quot;items&quot;:1},&quot;991&quot;:{&quot;items&quot;:1},&quot;1200&quot;:{&quot;items&quot;:1}} }" >

            <?php
            $numephoto=0;
            $numero="";

             foreach ($galeria as $key => $value): ?>
              <?php
                $numephoto++;
            if ($numephoto<6) {
               ?>
            <div class="gallery-item" data-hash="<?php echo $numephoto ?>" style="height:300px">
              <a   href="<?php echo  "img/products/".$producto->url_category.'/gallery'.'/'.$value ?>"   data-size="1000x667">
                <img  src="<?php echo  "img/products/".$producto->url_category.'/gallery'.'/'.$value ?>"   alt="Product">
              </a>
            </div>
            <?php  } ?>
      <?php endforeach; ?>

          </div>



          <ul class="product-thumbnails select-img"  >

            <?php

            $numephoto=0;
            $numero="";
             foreach ($galeria as $key => $value): ?>
              <?php
                $numephoto++;
                $active="";
                if ($numephoto==1) {
                  $active="active";
                }
                if ($numephoto<6) {



               ?>
            <li class="<?php echo $active ?>" id="cl-<?php echo $numephoto ?>"    >
                <a href="<?php echo $path."prodcut/".$producto->url_product ?>#<?php echo $numephoto ?>" onclick=" activegallery(<?php echo $numephoto ?>) ">
                  <img   src="<?php echo  "img/products/".$producto->url_category.'/gallery'.'/'.$value ?>" alt="Product">
                </a>
              </li>
              <?php  } ?>
            <?php endforeach; ?>
          </ul>

      </div>
    </div>
    <!-- Product Info-->
    <div class="col-md-6">
      <div class="padding-top-2x mt-2 hidden-md-up"></div>


      <span class="h3 d-block">
        <h3 class="" style="margin-bottom: 0px;"> <strong><?php echo $producto->name_product ?></strong> </h3>
        <div class="rating-stars"  >

          <?php

              $reviews = TemplateController::averageReviews(
                  json_decode($producto->reviews_product,true)
              );
              if ($producto->reviews_product!=null) {
                  $allViews= json_decode($producto->reviews_product,true);
              }else{
                $allViews=array();
              }

              if( $reviews > 0){

                  for($i = 0; $i < 5; $i++){

                      if($reviews < ($i+1)){

                          echo '<i class="icon-star "  ></i>';

                      }else{

                           echo '<i class="icon-star  " style="color:orange"   ></i>';

                      }

                  }

              }else{

                  for($i = 0; $i < 5; $i++){

                      echo '<i class="icon-star "    ></i>';

                  }

              }

          ?>
        <span style="font-size:12px"> <br>(<?php echo count($allViews) ?>) vistas</span>

        </div>

        <hr>
        <br>
        <!--=====================================
        El precio en oferta del producto
        ======================================-->

        <?php if ($producto->offer_product != null): ?>



                <?php
                    echo "S/".TemplateController::offerPrice(

                        $producto->price_product,
                        json_decode($producto->offer_product,true)[1],
                        json_decode($producto->offer_product,true)[0]

                    );

                ?>

                <del style="color:red"> S/.<?php echo  $producto->price_product ?></del>


        <?php else: ?>

             <?php echo "S/.".$producto->price_product  ?>

         <?php endif ?>
         <?php if ($producto->offer_product != null): ?>

             <span  style="font-size:15px;color:red">
             (-

               <?php

               echo  TemplateController::offerDiscount(

                   $producto->price_product,
                   json_decode($producto->offer_product,true)[1],
                   json_decode($producto->offer_product,true)[0]

               );

               ?>
               %)
           </span>

         <?php endif ?>
         <br>
         <div class="sp-categories pb-3">
           <i class="icon-tag"></i>
           <a href="#">Tienda: </a>
           <a href="#" style="color:blue"> <strong><?php echo $producto->name_store ?></strong> </a>

             <?php if ($producto->stock_product >1): ?>

                <a> Estado:  <strong><span  style="color:green">En estock(<?php echo $producto->stock_product ?>)</span></strong> </a>

             <?php else: ?>
                    <a> Estado: <strong><span  style="color:red">Out Of Stock</span> </strong> </a>
            <?php endif ?>

         </div>
         </span>

    <div class="row">
      <div class="col-lg-12">
         <?php $summary=json_decode($producto->summary_product); ?>
        <ul>
          <?php foreach ($summary as $key => $value): ?>
            <li><?php echo $value ?></li>
          <?php endforeach; ?>

        </ul>

      </div>
    </div>

      <div class="row margin-top-1x">
        <?php if ($producto->specifications_product!==null): ?>

            <?php
            $specification_prod=json_decode($producto->specifications_product,true);
            ?>
            <?php foreach ($specification_prod as $key => $val):  ?>
                <?php foreach ($val as $key => $i): ?>
                  <div class="col-sm-6">

                          <div class="form-group">
                            <label><?php echo array_keys($val)[0]; ?></label>
                            <select  class="form-control  details <?php echo array_keys($val)[0] ?>"
                                 detailType="<?php echo array_keys($val)[0] ?>"
                                  style="font-weight:bold" >
                              <?php foreach ($i as $key => $v): ?>
                                <option value="<?php echo $v; ?>"><?php echo $v; ?> </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                   </div>
                  <?php endforeach; ?>
          <?php endforeach; ?>

    <?php endif;?>

      </div>
      <div class="row align-items-end pb-4">
        <div class="col-sm-4">
          <div class="form-group mb-0">
            <label for="quantity">Quantity</label>
            <select class="form-control "
                  id="quantity" style="font-weight:bold">
              <option> <strong>1</strong>  </option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="pt-4 hidden-sm-up"></div><!-- $_SERVER["REQUEST_URI"] -->
          <button onclick="addShoppingCart('<?php echo $producto->url_product ?>','<?php echo CurlController::api() ?>', '<?php echo  "/".$urlParams[0]."/".$urlParams[1]  ?>', this)"
          detailsSC
          quantitySC
          class="btn btn-primary btn-block m-0" >
          <i class="fa fa-cart-plus"></i> Añadir al Carrito</button>
        </div>
      </div>
      <hr class="mb-2">
      <div class="d-flex flex-wrap justify-content-between">
        <div class="mt-2 mb-2">
          <button onclick="addWishlist('<?php echo $producto->url_product ?>','<?php echo CurlController::api() ?>')"
              class="btn btn-outline-secondary btn-sm  "><i class="icon-heart"></i>&nbsp;Favorito</button>
        </div>
        <div class="mt-2 mb-2"><span class="text-muted">Share:&nbsp;&nbsp;</span>
          <div class="d-inline-block"><a class="social-button shape-rounded sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-rounded sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-rounded sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-rounded sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
        </div>
      </div>
    </div>


    <!-- Product Details-->
  <div class="col-lg-12">

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 order-md-2">
          <div class="accordion" id="accordion1" role="tablist">
            <div class="">
              <div class="card-header" role="tab">
                <h6><a class="collapsed" href="#collapseTwo" data-toggle="collapse">Descripción</a></h6>
              </div>
              <div class="collapse" id="collapseTwo" data-parent="#accordion1" role="tabpanel">
                <div class="card-body">
                   <?php echo   html_entity_decode(urldecode( $producto->description_product)) ; ?>

                </div>
              </div>
            </div>
            <div class="">
              <div class="card-header" role="tab">
                <h6><a href="#collapseOne" data-toggle="collapse" class="collapsed" aria-expanded="false">Dealle</a></h6>
              </div>
              <div class="collapse" id="collapseOne" data-parent="#accordion1" role="tabpanel" style="">
                <div class="card-body">

                <table class="table table-bordered">
                   <?php $detalles= json_decode($producto->details_product,true) ?>

                      <tbody>
                        <?php foreach ($detalles as $key => $value): ?>
                          <tr>
                            <th style="background:#f2f2f2"><?php echo $value["title"];  ?> </th>
                            <td><?php echo $value["value"] ; ?> </td>
                          </tr>
                        <?php endforeach; ?>

                      </tbody>
                </table>

                </div>
              </div>
            </div>

            <div class="">
              <div class="card-header" role="tab">
                <h6><a class="collapsed" href="#collapseThree" data-toggle="collapse">Vendedor</a></h6>
              </div>
              <div class="collapse" id="collapseThree" data-parent="#accordion1" role="tabpanel">
                <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus.</div>
              </div>
            </div>
            <div class="">
              <div class="card-header" role="tab">
                <h6><a class="collapsed" href="#collapseFor" data-toggle="collapse">Reseñas del Producto</a></h6>
              </div>
              <div class="collapse show" id="collapseFor" data-parent="#accordion1" role="tabpanel">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <div class="card border-default"  style="border:none;">
                        <div class="card-body">
                          <div class="col-lg-3  "  style="float:left">

                            <div class="d-inline align-baseline display-3 mr-1"><?php echo $reviews; ?></div>
                            <br>
                            <div class="d-inline align-baseline text-sm text-warning mr-1">
                              <div class="rating-stars"  >

                                <?php

                                   
                                    if($reviews > 0){

                                        for($i = 0; $i < 5; $i++){

                                            if($reviews < ($i+1)){

                                                echo '<i class="icon-star "  ></i>';

                                            }else{

                                                 echo '<i class="icon-star  " style="color:orange"   ></i>';

                                            }

                                        }

                                    }else{

                                        for($i = 0; $i < 5; $i++){

                                            echo '<i class="icon-star "    ></i>';

                                        }

                                    }

                                ?>
                              <span style="font-size:12px;color:#000"><br>(<?php echo count($allViews) ?>) Vistas</span>
                                <br>
                              </div>

                            </div>
                          </div>
                          <div class="col-lg-9 "  style="float:left">

                            <?php
                              if (count($allViews)>0) {
                                $blockStart= array(
                                  '1' => 0,
                                  '2' => 0,
                                  '3' => 0,
                                  '4' => 0,
                                  '5' => 0,
                                );

                                $repStart=array();
                                foreach ($allViews as $key => $value) {
                                  array_push($repStart,$value["review"]);
                                }

                                foreach ($blockStart as $key => $value) {
                                   if (!empty(array_count_values($repStart)[$key])) {
                                      $blockStart[$key]=array_count_values($repStart)[$key];
                                   }
                                }

                                for ($i=5; $i >0 ; $i--) {

                             ?>
                            <div>
                              <div class="col-lg-2"  style="float:left" >
                                <label class="text-medium text-sm"><?php echo $i ?>
                                  <span class='text-muted'></span></label>
                                <div class="rating-stars">
                                  <i class="icon-star filled"></i>
                                </div>
                              </div>
                              <div class="col-md-10" style="float:left">
                                <div class="progress margin-bottom-1x">
                                  <div class="progress-bar  bg-warning"
                                  role="progressbar" style="width:  <?php echo round(($blockStart[$i]*100)/count($allViews)).'%'; ?>;height: 10px;"
                                  aria-valuenow="100" aria-valuemin="0"
                                   aria-valuemax="100">
                                   <?php echo round(($blockStart[$i]*100)/count($allViews))."%"; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php }
                             }else{
                           ?>
                           <?php for ($i=5; $i >0 ; $i--) { ?>
                             <div>
                               <div class="col-lg-2"  style="float:left" >
                                 <label class="text-medium text-sm"><?php echo $i ?>
                                   <span class='text-muted'></span></label>
                                 <div class="rating-stars">
                                   <i class="icon-star filled"></i>
                                 </div>
                               </div>
                               <div class="col-md-10" style="float:left">
                                 <div class="progress margin-bottom-1x">
                                   <div class="progress-bar  bg-warning"
                                   role="progressbar" style="width:'0%';height: 10px;"
                                   aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?php echo "0%"; ?>
                                   </div>
                                 </div>
                               </div>
                             </div>
                           <?php } ?>


                          <?php } ?>

                          </div><!-- col 12 -->
                          <div class="pt-2"><a href="#" data-toggle="modal" data-target="#leaveReview">Escribir Reseña</a></div>
                          <br><br>
                          <div class="col-lg-12">
                            <!-- Review-->
                              <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                  <div class="mb-2">
                                      <div class="rating-stars">
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star"></i>
                                      </div>
                                  </div>
                                  <h5 class="comment-title"> </h5>

                                </div>
                                <div class="comment-footer"><span class="comment-meta"> Por Heli el 01/12/20 </span></div>
                                <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...</p>
                              </div>
                              <br>
                              <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                  <div class="mb-2">
                                      <div class="rating-stars">
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star filled"></i>
                                        <i class="icon-star"></i>
                                      </div>
                                  </div>
                                  <h5 class="comment-title"> </h5>

                                </div>
                                <div class="comment-footer"><span class="comment-meta">
                                Por Heli el 01/12/20 </span></div>
                                <p class="comment-text">Lorem ipsum dolor s
                                it amet, consectetur adipiscing elit, sed do eiusmod tempor...</p>
                              </div>
                              <br>
                              <a class="  " href="#">Ver Más</a>
                          </div>
                        </div><!-- card body -->
                      </div>
                    </div>
                  </div>
                </div><!--card-body reseña-->
              </div>
            </div>
          </div><!--acordion-->
        </div><!-- col-6 -->
      </div><!--row-->
    </div><!--end product detalles-->
  </div><!-- row -->
</div>

<script type="text/javascript">


var tabshowfoto = ["cl-1"];

$( ".owl-next" ).click(function() {

});
function activegallery(num) {

  tabshowfoto.forEach(function(elemento, indice, array) {
      var id = document.getElementById(elemento);
       id.classList.remove('active');

  });



  tabshowfoto = [];
  var clasLifoto="cl-"+num;
  var id = document.getElementById("cl-"+num);
   id.classList.add('active');


   tabshowfoto.push(clasLifoto);

}


</script>
