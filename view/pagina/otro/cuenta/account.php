 <?php

 if (isset($urlParams[0])) {
   if (isset($_SESSION["user"])) {

   if ($urlParams[0]=="perfil") {
     include 'perfil/perfil.php';
   } else if ($urlParams[0]=="heart") {
     include 'favorito/favorito.php';
   } else if ($urlParams[0]=="address") {
     include 'direccion/direccion.php';
   } else if ($urlParams[0]=="orders") {
     include 'ordenes/orden.php';
   } else if ($urlParams[0]=="newstore") {
     include 'store/tienda.php';
   }else if ($urlParams[0]=="cart") {
     include 'cart/cart.php';
   }else if ($urlParams[0]=="checkout") {
     include 'checkout/checkout.php';
   }else if ($urlParams[0]=="method") {
     include 'checkout/medio-pago.php';
   }else if ($urlParams[0]=="logout") {
      include 'logout/logout.php';
   }else{
     echo '<script>
         fncFormatInputs();
         window.location = "'.TemplateController::path().'/err/404";

       </script>
     ';

   }
 }else{
   if($urlParams[0]=="login"){
     include 'login/login.php';
   }else if ($urlParams[0]=="newaccount") {
     include 'login/newaccount.php';
   }else if ($urlParams[0]=="cart") {
     include 'cart/cart.php';
   } else {
     echo '<script>
         fncFormatInputs();
         window.location = "'.TemplateController::path().'/err/404";

       </script>
     ';
   }

 }
}else{
  echo '<script>
      fncFormatInputs();
      window.location = "'.TemplateController::path().'/err/404";

    </script>
  ';
}
?>
