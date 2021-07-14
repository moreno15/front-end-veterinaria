
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

<section class="container preloadFalse" >
  <h4 class="h4 pb-3  ">Categorias Principal<a class=" " href="shop-grid-ls.html"> Ver más</a> <hr></h4>
<div class="row" style="padding:10px">

  <?php
     foreach ($menuCategories as $key => $item):

  ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-430 mb-30 "   >
          <a style="border: 1px solid #E8E8E8;height:220px"    class="d-block navi-link text-center "
            href="<?php echo $path."categories/".$item->url_category ?>">
           <img src="img/categories/<?php echo $item->image_category ?>"
           alt="<?php echo $item->name_category  ?>" >
           <span class="text-gray-dark txt-category"><?php echo $item->name_category  ?></span>


         </a>
        </div>

  <?php endforeach; ?>

</div>


</section>
