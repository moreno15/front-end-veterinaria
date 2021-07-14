<?php



if (isset($_SESSION["user"])) {

$productWishlist = array();
foreach ($wishlist as $key => $value) {
  $url = CurlController::api()."relations?rel=products,categories&type=product,category&linkTo=url_product&equalTo=".$value."&select=*";// toda la cartegoria
   $method = "GET";
   $fields = array();
   $header = array();

   array_push($productWishlist ,CurlController::request($url, $method, $fields, $header)->results[0]);


}


}
 ?>



<div class="col-lg-8">
          <div class="padding-top-2x mt-2 hidden-lg-up"></div>
          <!-- Wishlist Table-->
          <div class="table-responsive wishlist-table mb-0">
            <table class="table tb-responsive dt-client" style="width:100%">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Wishlist</a></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($productWishlist  as $key => $value): ?>
                  <tr>
                    <td>
                      <div class="product-item">
                        <a class="product-thumb" href="<?php echo $path.$value->url_product ?>">
                          <img  src="img/products/<?php echo $value->url_category ?>/<?php echo $value->image_product ?>"  alt="Product"></a>
                        <div class="product-info">
                          <h4 class="product-title"><a href="<?php echo $path.$value->url_product ?>"><?php echo $value->name_product ?></a></h4>
                          <div class="text-lg mb-1">$910.00</div>
                          <div class="text-sm">Availability:
                            <div class="d-inline text-success">In Stock</div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <a  class="remove-from-cart" href="#"  onclick="removeWishlist('<?php echo $value->url_product ?>','<?php echo CurlController::api() ?>','<?php echo $path;?>')">
                        <i class="icon-x"></i></a></td>
                  </tr>
                <?php endforeach; ?>


              </tbody>
            </table>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="inform_me" checked="">
            <label class="custom-control-label" for="inform_me">Inform me when item from my wishlist is available</label>
          </div>
        </div>
