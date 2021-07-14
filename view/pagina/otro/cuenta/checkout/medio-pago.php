<?php
use Nullix\CryptoJsAes\CryptoJsAes;
require "extension/vendor/brainfoolong/cryptojs-aes-php/src/CryptoJsAes.php";


if(!isset($_SESSION["user"])){

    echo '<script>

        fncSweetAlert(
                "error",
                "Please login",
                "'.$path.'login"
            );

    </script>';

    return;

}else{

    $time = time();

    if($_SESSION["user"]->token_exp_user < $time){

        echo '<script>

            fncSweetAlert(
                "error",
                "Error: the token has expired, please login again",
                "'.$path.'logout"
            );

        </script>';

        return;

    }else{

      $resta=false;
      $password="22223gfgJHKKKÑ//&";
      if(isset($_COOKIE["listSC"])&&isset($_COOKIE["addcc"]) ){
        if (empty($_COOKIE["listSC"]) ){
          echo '<script>

                window.location = "'.$path.'";

            </script>';

            return;
        }else{
          $encryptado=str_replace(" ","+",$_COOKIE["listSC"]);
          $decrypted = CryptoJsAes::decrypt($encryptado,$password);
          $order = json_decode($decrypted,true);

          if (count($order)<=0) {
            echo '<script>

                  window.location = "'.$path.'";

              </script>';

              return;
          }

          $addressKo=str_replace(" ","+",$_COOKIE["addcc"]);
          $addresDecrypted = CryptoJsAes::decrypt($addressKo,$password);
          $address = json_decode($addresDecrypted,true);
        }



      }else{

        echo '<script>

              window.location = "'.$path.'";

          </script>';

          return;

      }


     if (isset($_REQUEST["token"])&&isset($_REQUEST["payment_method_id"])&&
          isset($_REQUEST["installments"])&&isset($_REQUEST["issuer_id"]) ) {

        MercadoPago\SDK::setAccessToken('TEST-6720976235612202-031922-5f5629352cf5b05eb7b6cdad8e766568-731133353');
        MercadoPago\SDK::setIntegratorId("dev_16df7de451c511ebabb20242ac130004");

        $arrayOrder=CheckoutController::registerOrder($order,$address);

        $token = $_REQUEST["token"];
        $payment_method_id = $_REQUEST["payment_method_id"];
        $installments = $_REQUEST["installments"];
        $issuer_id = $_REQUEST["issuer_id"];

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $arrayOrder[5];
        $payment->token = $token;
        $payment->description =$arrayOrder[4]  ;
        $payment->installments = $installments;
        $payment->payment_method_id = $payment_method_id;
        $payment->issuer_id = $issuer_id;

        $payment->payer = array(
          "email" => $_SESSION["user"]->email_user
        );

        $payment->save();


        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );

         if($payment->status == "approved"){

             $resta=CheckoutController::endCheckout($arrayOrder,$payment->id);

              if ($resta) {
               echo '<script>

                 document.cookie = "listSC=; max-age=0";
                 fncSweetAlert("success", "La compra se ha realizado con éxito", "'.$path.'ordenes");

             </script>';
           }

          }//aproved

       }//token si existe payment
    }//token sesion
}//sesion

?>


<div class="col-lg-12 line-breadcrumbs" style="padding-top:80px;border-bottom: 1px solid #f3f3f3;margin-bottom:10px">
      <div class="container">
        <div class="row"  >
          <div class="col-lg-12"  >
            <ul class="breadcrumbs" >
              <li><a href="index.html">Inicio</a>
              </li>
              <li class="separator">&nbsp;</li>
            </ul>
          </div>
        </div>
      </div>
</div>
<div class="container padding-bottom-3x mb-2 chk-input">
  <div class="row">
        <div class="col-xl-12 col-lg-6"  style="float:left" >
              <aside class="sidebar">
                <div class="padding-top-2x hidden-lg-up"></div>
                <!-- Order Summary Widget-->
                <section class="widget widget-order-summary">
                  <h3 class="widget-title">Resumen de la compra</h3>
                      <table class="table ps-block__products">

                          <tbody>
                            <tr>
                              <td class="text-medium">Producto</td>
                              <td class="text-medium">Importe</td>
                              <td class="text-medium">Envio</td>
                              <td class="text-medium">Sub Total</td>
                            </tr>
                            <?php $totalCantida=0;   $totalOrder = 0;$totalenvio=0; ?>
                            <?php foreach ($order as $key => $value): ?>

                              <?php

                                $subTotalOrder = 0;

                                /*=============================================
                                    Traer productos del carrito de compras
                                    =============================================*/

                                    $select = "id_product,name_product,url_product,id_store,name_store,url_store,shipping_product,price_product,offer_product,delivery_time_product,sales_product,stock_product";

                                    $url = CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_product&equalTo=".$value["product"]."&select=".$select;
                                     $method = "GET";
                                    $fields = array();
                                    $header = array();

                                    $pOrder = CurlController::request($url, $method, $fields, $header)->results[0];




                              ?>

                              <tr>

                                  <td class="text-medium">

                                    <!--=====================================
                                    Nombre del producto
                                    ======================================-->

                                      <a href="<?php echo $path.$pOrder->url_product ?>" class="nameProduct"> <?php echo $pOrder->name_product ?></a>

                                      <div class="small text-secondary">

                                        <!--=====================================
                                        Tienda del producto
                                        ======================================-->

                  	                  <div>Sold By: <a href="<?php echo $path.$pOrder->url_store ?>"><strong><?php echo $pOrder->name_store ?></strong></a></div>

                  	               <!--=====================================
                                  Detalles del producto
                                  ======================================-->

                  	                   <div class="detailsOrder">

                  	                    <?php if ($value["details"] != ""): ?>

                  	                     <?php foreach (json_decode($value["details"], true) as $key => $item): ?>

                  	                      <?php foreach (array_keys($item) as $key => $detail): ?>

                  	                        <div><?php echo $detail.": ".array_values($item)[$key] ?></div>

                  	                      <?php endforeach ?>

                  	                     <?php endforeach ?>

                  	                    <?php endif ?>

                  	                   </div>

                          <!--=====================================
                          Cantidad del producto
                          ======================================-->

                          <div>Quantity: <span class="quantityOrder"><?php echo $value["quantity"] ?></span> </div>
                          <!--=====================================
                            Precio de envío del producto
                            ======================================-->

                          <div>Shipping: <?php echo "S/.".$pOrder->shipping_product * $value["quantity"] ?> </div>

                          <?php
                          $totalenvio+=$pOrder->shipping_product * $value["quantity"];
                            $subTotalOrder += $pOrder->shipping_product * $value["quantity"];


                          ?>


                              </div>
                          </td>

                          <?php

                            if ($pOrder->offer_product != null){

                                  $price = TemplateController::offerPrice(

                                      $pOrder->price_product,
                                      json_decode($pOrder->offer_product,true)[1],
                                      json_decode($pOrder->offer_product,true)[0]
                                      );
                                      $subTotalOrder += $price*$value["quantity"];
                                      echo "<td>S/.". $price * $value["quantity"] ."</td>";
                            }else{
                              echo "<td>S/.". $pOrder->price_product * $value["quantity"] ."</td>";
                              $subTotalOrder += $pOrder->price_product*$value["quantity"];

                            }

                            $totalOrder += $subTotalOrder;

                            $totalCantida+= $value["quantity"];
                          ?>
                          <td>S/.<?php echo $pOrder->shipping_product * $value["quantity"] ?></td>

                          <td  class="text-medium text-right">S/.<span class="priceOrder"><?php echo  $subTotalOrder?></span></td>

                    </tr>

                <?php endforeach ?>

                  </tbody>

                  </table>
                  <hr>
                  <h3 class="text-right totalOrder" total="<?php echo $totalOrder ?>">Total <span>S/.<?php echo $totalOrder ?></span></h3>

                </section>
              </aside>
         </div>
         <div class="tokenizer-container">

         </div>

  </div>

</div>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
checkout();
function checkout(){
  const mp = new MercadoPago('TEST-17ff3f9d-3c88-47a8-8f67-24b0e25d0c2e');

  mp.checkout({
  tokenizer: {
    totalAmount: <?php echo $totalOrder ?>,
    backUrl: 'http://proyecto.com/method-pago',
    installments: {
       minInstallments: 1,
       maxInstallments: 1,
    },
    summary: {
         productLabel:'Por <?php echo $totalCantida ?> productos',
         product:Number(<?php echo $totalOrder ?>).toFixed(2)

    },
  },
 render: {
    container: '.tokenizer-container', // Indica dónde se mostrará el botón
    label: 'Pagar compra' // Cambia el texto del botón de pago (opcional)
 }

});

}

</script>
