
<div  id="showcase" class="shop-toolbar padding-bottom-1x mb-2">
  <div class="column">
    <div class="shop-sorting">
      <label for="sorting">Sort by:</label>
      <select class="form-control" id="sorting" onchange="sortProduct(event)">

                        <?php
                        if (isset($urlParams[2])) { ?>

                            <?php if ($urlParams[2] == "new") { ?>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+new">Ordenar lo mas Nuevo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+latest">Ordenanar por lo mas antiguo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+low">Ordenar por Precio: Bajo a Alto</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+high"> Sort by price: Alto a Bajo</option>
                            <?php } ?>
                            <?php if ($urlParams[2] == "latest") { ?>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+latest">Ordenanar por lo mas antiguo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+new">Ordenar lo mas Nuevo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+low">Ordenar por Precio: Bajo a Alto</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+high"> Sort by price: Alto a Bajo</option>
                            <?php } ?>

                            <?php if ($urlParams[2] == "low") { ?>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+low">Ordenar por Precio: Bajo a Alto</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+high"> Sort by price: Alto a Bajo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+new">Ordenar lo mas Nuevo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+latest">Ordenanar por lo mas antiguo</option>

                            <?php } ?>
                            <?php if ($urlParams[2] == "high") { ?>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+high"> Sort by price: Alto a Bajo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+low">Ordenar por Precio: Bajo a Alto</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+new">Ordenar lo mas Nuevo</option>
                                <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+latest">Ordenanar por lo mas antiguo</option>


                            <?php } ?>

                        <?php } else { ?>

                            <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+new">Ordenar lo mas Nuevo</option>
                            <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+latest">Ordenanar por lo mas antiguo</option>
                            <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+low">Ordenar por Precio: Bajo a Alto</option>
                            <option value="<?php echo $_SERVER["REQUEST_URI"] ?>+high"> Sort by price: Alto a Bajo</option>
                        <?php } ?>
      </select>
     </div>
  </div>
  <div class="column">
    <?php
    $activeGrid="show active";
    $activeList="";
    if(isset($_COOKIE["tab"])){
    if($_COOKIE["tab"]=="grid"){
        $activeGrid="show active";
        $activeList="";
    }else{
       if($_COOKIE["tab"]=="list"){
             $activeGrid="";
            $activeList="show active";
        }
    }
    }else{
    $activeGrid="show active";
    $activeList="";
    }

     ?>
    <div class="shop-view">
      <ul class="nav nav-tabs tab-list" role="tablist">
                  <li class="nav-item" type="grid">
                    <a class="nav-link <?php echo $activeGrid; ?> " href="#tabOne" data-toggle="tab" role="tab" >
                      <span class="fa fa-th"></span> </a>
                  </li>
                  <li class="nav-item" type="list">
                    <a class="nav-link <?php echo $activeList; ?>" href="#tabThow" data-toggle="tab" role="tab" >
                      <span class="fa  fa-list-ul"></span> </a>
                  </li>

       </ul>
    </div>


  </div>
</div>

<div class="row  row-card">
  <div class="tab-content" style="border:none;">
    <div class="tab-pane fade  <?php echo $activeGrid; ?>" id="tabOne" role="tabpanel" >

       <div class="row">

        <?php foreach ($showcaseProducts as $key => $value): ?>

               <div class="col-lg-3 col-md-4 col-sm-6" >
                 <div class="product-card mb-3" style="border-radius:0px;"   >

                   <!--=====================================
                   Descuento de oferta o fuera de stock
                   ======================================-->

                   <?php if ($value->stock_product == 0): ?>

                       <div class="product-badge bg-secondary border-default text-body">Out Of Stock</div>

                   <?php else: ?>

                       <?php if ($value->offer_product != null): ?>

                           <div  class="product-badge bg-danger" style="left:60%">
                           -

                             <?php

                             echo  TemplateController::offerDiscount(

                                 $value->price_product,
                                 json_decode($value->offer_product,true)[1],
                                 json_decode($value->offer_product,true)[0]

                             );

                             ?>
                             %
                         </div>

                       <?php endif ?>

                   <?php endif ?>

                   <a class="product-thumb"  href="<?php echo $path.$value->url_product ?>" style="padding:50px; padding-bottom:5px">
                     <img src="img/products/<?php echo $value->url_category ?>/<?php echo $value->image_product ?>" alt="<?php echo $value->name_product ?>"  >
                   </a>
                   <div class="product-card-body" >
                     <div class="product-category">Marca </div>
                       <h3 class="product-title" >
                         <a href="<?php echo $path.$value->url_product ?>"   ><?php echo  $value->name_product ?></a>
                       </h3>
                       <div class="raiting-product"  >
                         <?php

                             $reviews = TemplateController::averageReviews(
                                 json_decode($value->reviews_product,true)
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

                           <?php if ($value->offer_product != null): ?>



                                   <?php
                                       echo "S/".TemplateController::offerPrice(

                                           $value->price_product,
                                           json_decode($value->offer_product,true)[1],
                                           json_decode($value->offer_product,true)[0]

                                       );

                                   ?>

                                   <del style="color:red"> S/.<?php echo  $value->price_product ?></del>


                           <?php else: ?>

                                <?php echo "S/.".$value->price_product  ?>

                            <?php endif ?>
                         </h4>


                   </div>


                    <div class="product-button-group  "  >
                     <!--<a onclick="addWishlist('<?php echo $value->url_product ?>','<?php echo CurlController::api() ?>')" class="product-button " id="icon-color"       style="border:none"  href="#">
                       <i class="icon-heart"></i><span>Favorito</span>
                     </a>
                       <a  href="<?php echo $path.$value->url_product ?>"
                         class="product-button " id="icon-color"    style="border:none"  >
                         <i class="icon-eye"></i><span>Ver</span>
                       </a>
                       <a  style="border-radius: none" class="product-button" id="icon-color"    href="#" >
                       <i class="icon-shopping-cart"></i><span>Agregar</span></a> -->
                     </div>


                 </div>
               </div>


        <?php endforeach; ?>

      </div>

    </div><!-- end tabOne-->
    <div class="tab-pane fade <?php echo $activeList; ?>" id="tabThow" role="tabpanel">

        <?php foreach ($showcaseProducts as $key => $value): ?>
          <div class="row" style="margin-bottom:20px;background:#fff" >
            <div class="col-lg-4 col-md-4 col-sm-6"    >
              <a   href="<?php echo $path.$value->url_product ?>" >
                <img src="img/products/<?php echo $value->url_category ?>/<?php echo $value->image_product ?>" alt="<?php echo $value->name_product ?>"  >
              </a>
            </div>
            <div class="col-lg-8 col-md-4 col-sm-6" >
              <h5 class="product-title" style="padding-top:10px">
                <a  style="color:#000 " href="<?php echo $path.$value->url_product ?>"   ><?php echo  $value->name_product ?></a></h5>
                <div class="raiting-product"  >
                  <?php

                      $reviews = TemplateController::averageReviews(
                          json_decode($value->reviews_product,true)
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

                    <?php if ($value->offer_product != null): ?>



                            <?php
                                echo "S/".TemplateController::offerPrice(

                                    $value->price_product,
                                    json_decode($value->offer_product,true)[1],
                                    json_decode($value->offer_product,true)[0]

                                );

                            ?>

                            <del style="color:red"> S/.<?php echo  $value->price_product ?></del>


                    <?php else: ?>

                         <?php echo "S/.".$value->price_product  ?>

                     <?php endif ?>
                  </h4>

            </div>
        </div>
          <?php endforeach; ?>

    </div>
  </div>



</div><!-- row -->

<!-- Pagination-->

<nav class="pagination "  >
  <div class="column"  >

    <?php
    if (isset($urlParams[1])) {
        $currentPage = $urlParams[1];
    } else {
        $currentPage = 1;
    }

    ?>

    <ul class="pages pagina"
     data-total-pages=" <?php echo ceil($totalProduct / 12) ?>"
    data-current-page="<?php echo $currentPage ?>"
     data-url-page="<?php echo $_SERVER["REQUEST_URI"] ?>">

    </ul>
</div>
</nav>
