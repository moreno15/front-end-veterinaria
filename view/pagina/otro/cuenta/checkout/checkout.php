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

    }


        if(isset($_COOKIE["listSC"])&&!empty($_COOKIE["listSC"]) ){

                $password="22223gfgJHKKKÑ//&";
                $encryptado=str_replace(" ","+",$_COOKIE["listSC"]);
                $decrypted = CryptoJsAes::decrypt($encryptado,$password);
                $order = json_decode($decrypted,true);
                if (count($order)<=0) {
                  echo '<script>

                        window.location = "'.$path.'";

                    </script>';

                    return;
                }
              }else{

                echo '<script>

                      window.location = "'.$path.'";

                  </script>';

                  return;

              }
}

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
    <!-- Checkout Adress-->

    <form  class="needs-validation was-validated"  novalidate  method="post" onsubmit="return continuar()"  ><!-- action="http://proyecto.com/method-pago" -->

          <input type="hidden" id="idUser" value="<?php echo $_SESSION["user"]->id_user ?>">
          <input type="hidden" id="urlApi" value="<?php echo CurlController::api() ?>">
          <input type="hidden" id="url" value="<?php echo $path ?>">

    <div class="col-xl-6 col-lg-6" style="float:left">

       <h4>Dirección de Envío(Solo Perú)</h4>
      <hr class="padding-bottom-1x">
      <div class="row">

        <div class="col-sm-12">
          <div class="form-group">
            <label for="checkout-fn">Nombre Completo</label>
            <input class="form-control " value="<?php echo $_SESSION["user"]->displayname_user ?>"  type="text" readonly required id="checkout-nombre">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="checkout-fn">Correo</label>
            <input id="emailOrder" class="form-control"
            type="email" value="<?php echo $_SESSION["user"]->email_user ?>" readonly required>

            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

        </div>
      </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="checkout-phone">Teléfono Celular</label>

            <input
            id="phoneOrder"
            class="form-control"
            type="text"
            pattern="[-\\(\\)\\0-9 ]{1,}"
            onchange="validateJS(event, 'phone')"
            value="<?php echo $_SESSION["user"]->phone_user?>"
            required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="checkout-city">Departamento</label>
            <?php

              $data = file_get_contents("view/json/ubigeo.json");
              $ubigeo = json_decode($data, true);
              $coddep=explode("-",$_SESSION["user"]->department_user)[0];
              $codpro=explode("-",$_SESSION["user"]->province_user)[0];
              $coddis=explode("-",$_SESSION["user"]->district_user)[0];
            ?>
            <select
            id="departmentOrder"
            class="form-control  "
            onchange="provincia()"
            required>

              <option value >Select Department</option>
            <?php foreach ($ubigeo as $key => $value): ?>

              <?php if ($value["codi_pro"]==0&&$value["codi_dis"]==0): ?>
                  <?php if ($value["description"]=== explode("-",$_SESSION["user"]->department_user)[1] ): ?>
                        <option selected="true" value="<?php echo $value["codi_dep"].'-'.$value["description"] ?>"><?php echo $value["description"] ?></option>
                  <?php else: ?>
                      <option value="<?php echo $value["codi_dep"].'-'.$value["description"] ?>"><?php echo $value["description"] ?></option>
                  <?php endif; ?>
              <?php endif; ?>
            <?php endforeach ?>

            </select>

            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="checkout-city">Provincia</label>

            <select
            id="provinceOrder"
            class="form-control  "
            onchange="distrito()"
             >
            <option value="">-</option>
            <?php foreach ($ubigeo as $key => $value): ?>
              <?php if ($value["codi_dep"]==$coddep&&$value["codi_pro"]!==0&&$value["codi_dis"]==0): ?>
                  <?php if ($value["description"]=== explode("-",$_SESSION["user"]->province_user)[1] ): ?>
                        <option selected="true" value="<?php echo $value["codi_pro"].'-'.$value["description"] ?>"><?php echo $value["description"] ?></option>
                  <?php else: ?>
                      <option value="<?php echo $value["codi_pro"].'-'.$value["description"] ?>"><?php echo $value["description"] ?></option>
                  <?php endif; ?>
              <?php endif; ?>
            <?php endforeach ?>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="checkout-city">Distrito</label>
            <select
            id="districtOrder"
            class="form-control  "
             >
            <option value="">-</option>
            <?php foreach ($ubigeo as $key => $value): ?>
              <?php if ($value["codi_dep"]==$coddep&&$value["codi_pro"]==$codpro&&$value["codi_dis"]!==0): ?>
                  <?php if ($value["description"]=== explode("-",$_SESSION["user"]->district_user)[1] ): ?>
                    <?php $nombreUbi=$value['codi_dis'].'-'.$value['description']; ?>
                      <option selected="true" value="<?php echo $nombreUbi  ?>"><?php echo $value["description"] ?></option>
                  <?php else: ?>
                    <?php $nombreUbi=$value['codi_dis'].'-'.$value['description'];  ?>
                       <option value="<?php echo $nombreUbi ?>"><?php echo $value["description"] ?></option>
                  <?php endif; ?>
              <?php endif; ?>
            <?php endforeach ?>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="checkout-address">Direccion</label>
            <input
            id="addressOrder"
            class="form-control"
            type="text"
            pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
            onchange="validateJS(event, 'paragraphs')"
            value="<?php echo $_SESSION["user"]->address_user ?>"
             >
          </div>
        </div>

        <div class="col-sm-12">
          <h3 class="mt-40"> Addition information</h3>

          <div class="form-group">

              <label>Order Notes</label>

              <textarea
              id="infoOrder"
              class="form-control"
              rows="7"
              pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
              onchange="validateJS(event, 'paragraphs')"
              placeholder="Notes about your order, e.g. special notes for delivery."></textarea>

              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill in this field correctly.</div>


          </div>
        </div>

      </div>

      <h4>Dirección de Envío</h4>
      <hr class="padding-bottom-1x">
      <div class="form-group">
          <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox"  id="create-account"  >

            <label class="custom-control-label" for="create-account">Usar como dirección predeterminada </label>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill in this field correctly.</div>

          </div>
      </div>

    </div>
    <!-- Sidebar          -->
    <div class="col-xl-6 col-lg-6" style="float:left">
      <aside class="sidebar">
        <div class="padding-top-2x hidden-lg-up"></div>
        <!-- Order Summary Widget-->
        <section class="widget widget-order-summary">
          <?php

          $totalOrder = 0;


          ?>
          <h3 class="widget-title">Resumen de Orden</h3>

              <table class="table ps-block__products">

                  <tbody>
                    <tr>
                      <td class="text-medium">Producto</td>
                      <td class="text-medium">Importe</td>
                      <td class="text-medium">Envio</td>
                      <td class="text-medium">Sub Total</td>
                    </tr>

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

                  <div>Shipping:S/. <?php echo $pOrder->shipping_product * $value["quantity"] ?> </div>

                  <?php

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

                  ?>


                  <td><?php echo "S/".$pOrder->shipping_product * $value["quantity"] ?></td>
                  <td  class="text-medium text-right">S/.<span class="priceOrder"><?php echo  $subTotalOrder?></span></td>

            </tr>

        <?php endforeach ?>

          </tbody>

      </table>
      <div class="tb-product">

      </div>
      <h3 class="text-right totalOrder" total="<?php echo $totalOrder ?>">Total <span>S/.<?php echo $totalOrder ?></span></h3>


          <hr>
          <div class="col-sm-12">
            <h3>Medios de pago</h3>
          </div>

          <div class="col-sm-12 form-group">
             <div class="custom-control custom-radio">

               <input
               class="custom-control-input form-control"
               type="radio"
               id="pay-mercadopago"
               name="payment-method"
               value="mercado-pago"
               onchange="changeMethodPaid(event)" checked>

               <label class="custom-control-label" for="ex-radio-1">Mercado Pago</label>
               <img src="img/payment-method/mp_logo.jpg" class="w-50">
             </div>
           </div>

          <div class="d-flex justify-content-between paddin-top-1x mt-4">
              <a class="btn btn-outline-secondary" href="/"><i class="icon-arrow-left"></i>
                <span class="hidden-xs-down">&nbsp;Seguir Comprando</span>
              </a>
                <button type="submit"    name="button" class="btn btn-primary" >
                  <span class="hidden-xs-down">Continuar</span>
                  <i class="icon-arrow-right"></i>
                </button>
            </div>
        </section>
      </aside>
    </div>

  </form>

  </div>
</div>
