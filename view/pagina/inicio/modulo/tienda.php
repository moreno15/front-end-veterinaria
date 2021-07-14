<?php


/*TRAEMOS nuestras tiendas oficiales*/
$url = CurlController::api()."stores?startAt=".$randomStarStore."&endAt=12&select=*";
$method = "GET";
$fields = array();
$header = array();

$stores = CurlController::request($url, $method, $fields, $header)->results;



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

<section class="container preloadFalse" >

  <h4 class="h4  pb3 ">Tiendas Oficiales <a class=" " href="shop-grid-ls.html"> Ver más</a>
<hr>
   </h4>

  <?php
  $loop="false";
      if(count($stores)>4){
        $loop="true";
      }
   ?>
  <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true,
    &quot;dots&quot;: false, &quot;loop&quot;: <?php echo $loop; ?>, &quot;margin&quot;: 30,
    &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 5000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
    &quot;450&quot;:{&quot;items&quot;:2},&quot;630&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">

    <?php foreach ($stores as $key => $value): ?>


      <a  href="<?php echo $path.$value->url_store ?>"  onMouseOver="this.style.opacity='.6'"
       onMouseOut="this.style.opacity='1'"  class="d-block navi-link text-center " href="shop-grid-ls.html">
       <img class="d-block" src="img/vendor/<?php echo $value->logo_store ?>">
     </a>
    <?php endforeach; ?>
  </div>
</section>
