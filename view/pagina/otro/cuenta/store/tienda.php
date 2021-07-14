
 <?php

 $select = "id_store,id_user_store,name_store,razon_store,ruc_store,state_store,url_store,logo_store,cover_store,email_store,deparment_store,province_store,district_store,address_store,phone_store,socialnetwork_store,product_store,document_adjunt,banca_store";
$url = CurlController::api()."stores?linkTo=id_user_store&equalTo=".$_SESSION["user"]->id_user."&select=".$select;
 $method = "GET";
 $fields = array();
 $header = array();

 $userStore = CurlController::request($url, $method, $fields, $header)->results;

 ?>

 <?php if ($userStore=="Not Found"): ?>
   <!-- Page Title-->
   <!-- Page Content-->
   <div class="container padding-bottom-3x mb-2 padding-top-5x">
     <?php print_r($userStore) ?>
     <?php echo $_SESSION["user"]->id_user ?>
     <div class="row " >
       <div class="col-lg-12 ">
           <?php include "new-store/new-store.php" ?>
       </div>
     </div>
   </div>
<?php else: ?> 
  <?php

  echo '<script>
      fncFormatInputs();
      window.location = "'.TemplateController::path().'store/inicio";

    </script>
  ';
  return;
   ?>
 <?php endif; ?>
