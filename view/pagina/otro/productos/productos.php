<?php


$iParams=0;
$orden=0;
if(!empty(array_filter($urlParams))){
  if (count($urlParams)==2) {
    $iParams=1;
    $orden=2;
  }
  if (count($urlParams)==3) {
    $iParams=2;
    $orden=3;
  }
  if (count($urlParams)==4) {
    $iParams=3;
    $orden=4;
  }
}

if(isset($urlParams[$orden])){
  if(is_numeric($urlParams[$orden])){
    $startAt=($urlParams[$orden]*12)-12;
  }else{
    echo '<script> window.location="'.$path.$urlParams[1].'" </script>';
  }
}else{
  $startAt=0;
}

// validar si hay parametrode orden

if(isset($urlParams[$orden])){

  if(is_string($urlParams[$orden])){
     if($urlParams[$orden]=="new"){
      $orderBy="id_product";
      $orderMode="DESC";
     }else if($urlParams[$orden]=="latest"){
      $orderBy="id_product";
      $orderMode="ASC";
     }else if($urlParams[$orden]=="low"){
      $orderBy="price_product";
      $orderMode="ASC";
     }else if($urlParams[$orden]=="high"){
      $orderBy="price_product";
      $orderMode="DESC";
    }else{
      echo '<script>window.location="'.$path.'" </script>'; //

    }

  }else{
    echo '<script> window.location="'.$path.'"</script>';
  }

}else{
  $orderBy="id_product";
  $orderMode="DESC";
}

// categoria
$url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[$iParams]."&orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$startAt."&endAt=12&select=*";
$method = "GET";
$fields = array();
$header = array();

$showcaseProducts = CurlController::request($url, $method, $fields, $header)->results;

 if ($showcaseProducts=="Not Found") {

            //grupo Home

        $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=title_list_subcategory&equalTo=".$urlParams[$iParams]."&orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$startAt."&endAt=12&select=*";
        $method = "GET";
        $fields = array();
        $header = array();

        $showcaseProducts = CurlController::request($url, $method, $fields, $header)->results;


   if ($showcaseProducts=="Not Found") {

         // subcategoria

         $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[$iParams]."&orderBy=".$orderBy."&orderMode=".$orderMode."&startAt=".$startAt."&endAt=12&select=*";
         $method = "GET";
         $fields = array();
         $header = array();

         $showcaseProducts = CurlController::request($url, $method, $fields, $header)->results;
        if ($showcaseProducts=="Not Found") {
            echo '<script> window.location="'.$path.'err/404"</script>';
         }else{
           // TRAER EL TOTAL DE PRODUCTOS subacategori

             $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[$iParams]."&select=*";
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

            $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_subcategory&equalTo=".$urlParams[$iParams]."&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=".$endAtd."&select=*";
            $method = "GET";
            $fields = array();
            $header = array();

            $productsDefault = CurlController::request($url, $method, $fields, $header)->results;

            $productsDefaultBanner = array_slice($productsDefault, 0, 2);
         }

   }else{
     // TRAER EL TOTAL DE PRODUCTOS grupo

     $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=title_list_subcategory&equalTo=".$urlParams[$iParams]."&select=*";
     $method = "GET";
     $fields = array();
     $header = array();

     $totalProduct= CurlController::request($url, $method, $fields, $header)->total;

     /*$endAtd=1;
     $randomStart= rand(0, ($totalProduct-1));
     if ($totalProduct>1) {
         $endAtd=2;
        $randomStart= rand(0, ($totalProduct-2));
      }*/

      $randomStart= rand(0, ($totalProduct-2));
    // listado para banner default

    $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=title_list_subcategory&equalTo=".$urlParams[$iParams]."&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=2&select=*";
    $method = "GET";
    $fields = array();
    $header = array();

    $productsDefault = CurlController::request($url, $method, $fields, $header)->results;

    $productsDefaultBanner = array_slice($productsDefault, 0, 2);





   }
 }else {
   // TRAER EL TOTAL DE PRODUCTOS

   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[$iParams]."&select=*";
   $method = "GET";
   $fields = array();
   $header = array();

   $totalProduct= CurlController::request($url, $method, $fields, $header)->total;

   $randomStart= rand(0, ($totalProduct-2));
   // listado para slide horizontal


   $url = CurlController::api()."relations?rel=products,categories,subcategories,stores&type=product,category,subcategory,store&linkTo=url_category&equalTo=".$urlParams[$iParams]."&orderBy=id_product&orderMode=ASC&startAt=".$randomStart."&endAt=2&select=*";
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
