<?php use Nullix\CryptoJsAes\CryptoJsAes;
require "extension/vendor/brainfoolong/cryptojs-aes-php/src/CryptoJsAes.php";
$password="22223gfgJHKKKÑ//&";
/*=============================================
Traer la Lista del carrito de compras
=============================================*/
$productsSC = array();
?>
<?php if (isset($_COOKIE["listSC"]) &&!empty($_COOKIE["listSC"]) ){  ?>
<?php
//$encrypted = CryptoJsAes::encrypt($_COOKIE["listSC"], $password);
//$_COOKIE["listSC"]=$encrypted;
$encryptado=str_replace(" ","+",$_COOKIE["listSC"]);;//"'".$encr."'";
$decrypted = CryptoJsAes::decrypt($encryptado,$password);
$shoppingCart = json_decode($decrypted,true);
$totalPrd=0;
if (!is_array($shoppingCart)) {
  echo '<script>

        window.location = "'.$path.'";

    </script>';

    return;
}else{
  $totalPrd=count($shoppingCart);
}
 //volvemos a encriptar la cookie

    if ($totalPrd>0) {


  $select = "id_category_product,url_product,url_category,name_product,image_product,price_product,offer_product,stock_product,name_store,shipping_product";

  foreach ($shoppingCart as $key => $value) {

      $url = CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_product&equalTo=".$value["product"]."&select=".$select;
      $method = "GET";
      $fields = array();
      $header = array();

      array_push($productsSC, CurlController::request($url, $method, $fields, $header)->results[0]);

  } ?>
  <!-- Alert-->
  <div class="table-responsive  shopping-cart">
    <table class="table tb-responsive  dt-client">
      <thead>
        <tr>
          <th>Product Name</th>
          <th class="text-center">Precio</th>
          <th class="text-center">Envio</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">SubTotal</th>
          <th class="text-center">
            <a onclick="clearSC('<?php echo $_SERVER["REQUEST_URI"] ?>')"
              class="btn btn-sm btn-outline-danger" >Clear Cart</a>
            </th>
        </tr>
      </thead>
      <tbody>

        <?php
        $totalSC =0;
        $i=1;
        foreach ($productsSC as $key => $value):
          ?>
          <tr>
            <td>
              <?php


                  $url = CurlController::api()."categories?linkTo=id_category&equalTo=".$value->id_category_product."&select=url_category";
                  $method = "GET";
                  $fields = array();
                  $header = array();

                  $category = CurlController::request($url, $method, $fields, $header)->results[0];

              ?>
              <div class="product-item">
                <a class="product-thumb"  href="<?php echo $path."product/".$value->url_product ?>">
              <img src="img/products/<?php echo $category->url_category ?>/<?php echo $value->image_product ?>"></a>
                <div class="product-info">
                  <h4 class="product-title">
                    <a href="<?php echo $path."product/".$value->url_product ?>"> <?php echo $value->name_product ?> </a></h4>
                    <div class="small text-secondary listSC"
                         url="<?php echo $value->url_product ?>"
                         details='<?php echo $shoppingCart[$key]["details"]  ?>'>

                        <?php

                            if($shoppingCart[$key]["details"] != ""){

                                foreach (json_decode($shoppingCart[$key]["details"],true)  as $index => $detail) {

                                    foreach (array_keys($detail) as $index => $list) {

                                        echo '<span><em>'.$list.':</em>'.array_values($detail)[$index].'</span>';

                                    }

                                }

                            }

                        ?>
                        <?php echo '<span><em>Envio:</em>s/.'.$value->shipping_product.'</span>'; ?>
                    </div>
                </div>
              </div>
            </td>
            <td class="text-center text-lg product_price" >
              <!--=====================================
              El precio en oferta del producto
              ======================================-->
              <?php if ($value->offer_product != null): ?>



                      <?php
                          $price=TemplateController::offerPrice(

                              $value->price_product,
                              json_decode($value->offer_product,true)[1],
                              json_decode($value->offer_product,true)[0]

                          );
                          echo "S/.<span>".$price."</span>";
                      ?>

                      <del style="color:red"> S/.<?php echo  $value->price_product ?></del>
              <?php else: ?>
                  S/.<span><?php echo $value->price_product;?></span>
               <?php endif ?>
            </td>
            <td class="shipping">
              <span currentShipping="<?php echo $value->shipping_product?>"><?php echo "S/".$value->shipping_product?></span>
            </td>
            <td class="text-center ">
              <div class="count-input form-group--number quantity"  >
                <button style="width:20%;float:left;height:46px;background:#d1d1d1;border:none"
                class="down"
                onclick="changeQuantity($('#quant<?php echo $key ?>').val(),  'down', <?php echo $value->stock_product ?>, <?php echo $key ?>)">-</button>

                <input readonly style="background:#FFFFFF;width:60%;float:left"
                id="quant<?php echo $key ?>"
                class="form-control form-control-square" type="text" placeholder="1" value="<?php echo $shoppingCart[$key]["quantity"] ?>">

                <button style="width:20%;float:left;height:46px;background:#d1d1d1;border:none"
                class="up"
                onclick="changeQuantity($('#quant<?php echo $key ?>').val(), 'up', <?php echo $value->stock_product ?>, <?php echo $key ?>)">+</button>


                </div>
            </td>
            <td class="text-center text-lg ">
              <span>S/.</span>
                  <span class="subtotal">0</span>
              </td>
            <td class="text-center">
              <a onclick="removeSC('<?php echo $i?>','<?php echo $_SERVER["REQUEST_URI"] ?>')" class="remove-from-cart"
               href="#" data-toggle="tooltip" title="quitar produto">
              <i class="icon-x"></i></a>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <div class="shopping-cart-footer">
    <div class="column">
      <form class="coupon-form" method="post">
        <input class="form-control form-control-sm" type="text" placeholder="Código de cupon" required>
        <button class="btn btn-outline-primary btn-sm" type="submit">Aplicar Cupon</button>
      </form>
    </div>
    <div class="column text-lg">
      <div class="totalPrice">
        <span class="text-muted ">Total:&nbsp;S/.</span>
        <span class="text-gray-dark price">0</span>
    </div>


    </div>
  </div>
  <div class="shopping-cart-footer">
    <div class="column"><a class="btn btn-outline-secondary" href="<?php echo $path."categoria" ?>"><i class="icon-arrow-left"></i>&nbsp;Seguir Comprando</a></div>
    <div class="column"><a class="btn btn-secondary" href="#" data-toast data-toast-type="success" data-toast-position="topRight"
      data-toast-icon="icon-check-circle" data-toast-title="Your cart" data-toast-message="is updated successfully!">Actualizar Cesta</a>

      <?php if (isset($_COOKIE["listSC"]) && !empty($_COOKIE["listSC"])): ?>
      <a class="btn btn-primary" href="<?php echo $path."checkout"?>" >Chekout</a>

    <?php endif ?>
    </div>
  </div>

<?php   }else{ ?>
  <div class="justify-content-center alert alert-warning alert-dismissible fade show text-center" style="margin-bottom: 30px;">
    <span class="alert-close" data-dismiss="alert"></span>

    <h1>No tienes productos en tu carrito</h1>
    <a class="btn btn-primary" href="/"> Seguir comprando</a>
  </div>

<?php
        }
}else{?>
  <div class="justify-content-center alert alert-warning alert-dismissible fade show text-center" style="margin-bottom: 30px;">
    <span class="alert-close" data-dismiss="alert"></span>

    <h1>No tienes productos en tu carrito</h1>
    <a class="btn btn-primary" href="/"> Seguir comprando</a>
  </div>


<?php } ?>
