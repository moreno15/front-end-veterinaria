<?php

if(isset($urlParams[1])){
  if(is_numeric($urlParams[1])){
    $startAt=($urlParams[1]*12)-12;
  }else{
    //echo '<script> window.location="'.$path.$urlParams[0].'" </script>';
  }
}else{
  $startAt=0;
}

// validar si hay parametrode orden

if(isset($urlParams[2])){

  if(is_string($urlParams[2])){
     if($urlParams[2]=="new"){
      $orderBy="id_product";
      $orderMode="DESC";
     }else if($urlParams[2]=="latest"){
      $orderBy="id_product";
      $orderMode="ASC";
     }else if($urlParams[2]=="low"){
      $orderBy="price_product";
      $orderMode="ASC";
     }else if($urlParams[2]=="high"){
      $orderBy="price_product";
      $orderMode="DESC";
    }else{
      echo '<script> window.location="'.$path.$urlParams[0].'" </script>';

    }

  }else{
    echo '<script> window.location="'.$path.$urlParams[0].'" </script>';
  }

}else{
  $orderBy="id_product";
  $orderMode="DESC";
}

$url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$startAt."&endAt=12&select=*";
$method = "GET";
$fields = array();
$header = array();

$showcaseProducts = CurlController::request($url, $method, $fields, $header)->results;

 if ($showcaseProducts=="Not Found") {

   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$startAt."&endAt=12&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $showcaseProducts = CurlController::request($url, $method, $fields, $header)->results;

   // TRAER EL TOTAL DE PRODUCTOS

   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $totalProduct= CurlController::request($url, $method, $fields, $header)->total;

   $endAtd=1;
   $randomStart= rand(0, ($totalProduct-1));
   if ($totalProduct>1) {
     $endAtd=2;
    $randomStart= rand(0, ($totalProduct-2));
  }



   // listado para banner default

   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[0]."&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=".$endAtd."&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $productsDefault = CurlController::request($url, $method, $fields, $header)->results;

   $productsDefaultBanner = array_slice($productsDefault, 0, 2);



 }else {
   // TRAER EL TOTAL DE PRODUCTOS

  $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[0]."&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $totalProduct= CurlController::request($url, $method, $fields, $header)->total;

   $randomStart= rand(0, ($totalProduct-2));
   // listado para slide horizontal


   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[0]."&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=2&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $productsDefault = CurlController::request($url, $method, $fields, $header)->results;

   $productsDefaultBanner = array_slice($productsDefault, 0, 2);

   //actualizamos las vistas de categorias
/*
   $url = CurlController::api()."";
   $method = "PUT";
   $fields = array();
   $header = array();

   $totalProduct= CurlController::request($url, $method, $fields, $header);

*/

 }


 ?>
<style media="screen">
  body{
    background:#f9f9f9 !important;
  }
</style>

    <!-- Page Title-->
<?php include 'modulo/breacum.php'; ?>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1  "    >
      <div class="row"  >
        <!-- Products-->
        <div class="col-lg-9 order-lg-2">
          <!-- Promo banner-->
          <?php include 'modulo/promo-banner.php'; ?>
          <!-- Shop Toolbar-->
          <?php include 'modulo/shop-toolbar.php'; ?>
          <!-- Products Grid-->
          <?php include 'modulo/productos.php'; ?>

        </div>
        <!-- Sidebar          -->
        <div class="col-lg-3 order-lg-1">
          <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
          <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
            <!-- Widget Categories-->
            <?php include 'modulo/widget-categoria.php'; ?>
            <!-- Widget Price Range-->
            <?php include 'modulo/range-precio.php'; ?>
            <!-- Widget Size Filter-->
             <?php //include 'modulo/filtro-precio.php'; ?>
            <!-- Widget Brand Filter-->
           <?php include 'modulo/filtro-marca.php'; ?>
          </aside>
        </div>
      </div>
    </div>
