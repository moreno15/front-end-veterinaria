<?php

 class CheckoutController{

    	public function registerOrder($order,$address){
        $timezone = 'America/Lima';
        date_default_timezone_set($timezone);

        $time=time();
        $url = CurlController::api()."users?id=".$_SESSION["user"]->id_user."&nameId=id_user&token=".$_SESSION["user"]->token_user;
        $method = "PUT";
        $fields =json_encode(array(
          'department_user'=>$address[0]["departmentOrder"],
          'province_user'=>$address[0]["provinceOrder"],
          'district_user'=>$address[0]["districtOrder"],
          'phone_user'=>$address[0]["phoneOrder"],
          'address_user'=>$address[0]["addressOrder"]
         ));
        $header = array("Content-Type:application/json");//x-www-form-urlencoded

        $saveAddress=$address[0]["saveAddress"];

        if ($saveAddress) {
          $save = CurlController::request($url, $method, $fields, $header);

           if($save->status == 200){
            $_SESSION["user"]->department_user=$address[0]["departmentOrder"];
            $_SESSION["user"]->province_user=$address[0]["provinceOrder"];
            $_SESSION["user"]->district_user=$address[0]["districtOrder"];
            $_SESSION["user"]->phone_user=$address[0]["phoneOrder"];
            $_SESSION["user"]->address_user=$address[0]["addressOrder"];

           }
        }


        $descripcion="";

        $rpta=array();
        $idSale= array();
        $idOrden= array();
        $idProduct= array();
        $quantityOrder= array();
        $totalOrderFinal=0;
        $totalCantidad=0;
        foreach ($order as $key => $value) {
          $totalOrder=0;
          $cantidad=$value["quantity"];
          $select = "id_product,name_product,url_product,id_store,name_store,url_store,shipping_product,price_product,offer_product,delivery_time_product,sales_product,stock_product";

          $url = CurlController::api()."relations?rel=products,categories,stores&type=product,category,store&linkTo=url_product&equalTo=".$value["product"]."&select=".$select;
           $method = "GET";
          $fields = array();
          $header = array();

          $pOrder = CurlController::request($url, $method, $fields, $header)->results[0];


          $moment = round(($pOrder->delivery_time_product)/2);

          $timeenvio=$time+ ($moment * 24 * 60 * 60);
          $sendDate=date('Y-m-d', $timeenvio);

          $envio=$time+ ($pOrder->delivery_time_product * 24 * 60 * 60);
          $deliveredDate=date('Y-m-d', $envio);

          $processOrder =json_encode(array(
            array("stage"=>"reviewed","status"=>"ok","comment"=>"We have received your order, we start delivery process","date"=>date("Y-m-d") ),
            array("stage"=>"reviewed","status"=>"pending","comment"=>"","date"=>$sendDate ),
            array("stage"=>"reviewed","status"=>"pending","comment"=>"","date"=>$deliveredDate)
          ));

          //precio envio
          $totalOrder += $pOrder->shipping_product * $value["quantity"];

          if ($pOrder->offer_product != null){

                $price = TemplateController::offerPrice(

                    $pOrder->price_product,
                    json_decode($pOrder->offer_product,true)[1],
                    json_decode($pOrder->offer_product,true)[0]
                    );
                    $totalOrder += $price*$value["quantity"];
          }else{

            $totalOrder += $pOrder->price_product*$value["quantity"];

          }
          $totalOrder=number_format($totalOrder, 2, '.', '');

          $totalOrderFinal+=$totalOrder;
          //$descripcion.=$pOrder->name_product."x".$value["quantity"].",";
          $totalCantidad+=$value["quantity"];

          $details=$value["details"];
          $details=json_decode($details,true);
          $details= $details[0];
          $detalle="";
          foreach ($details as $key => $value) {
           $detalle.= "<div>".$key.":".$value.":</div>";
          }


          $url = CurlController::api()."orders?token=".$_SESSION["user"]->token_user;
          $method = "POST";
          $fields =json_encode(array(
            'id_store_order'=>$pOrder->id_store,
            'id_user_order'=> $_SESSION["user"]->id_user,
            'id_product_order'=> $pOrder->id_product,
            'details_order'=>$detalle,
            'quantity_order'=>$cantidad,//$value["quantity"],
            'price_order'=>  $totalOrder,//number_format($totalOrder, 2, '.', ''),
            'email_order'=> $_SESSION["user"]->email_user,
            'department_order'=> $address[0]["departmentOrder"],
            'province_order'=> $address[0]["provinceOrder"],
            'district_order'=> $address[0]["districtOrder"],
            'phone_order'=> $address[0]["phoneOrder"],
            'address_order'=> $address[0]["addressOrder"],
            'notes_order'=> $address[0]["infoOrder"],
            'process_order'=> $processOrder,
            'status_order'=> "test",
            'date_created_order'=>date('Y-m-d')
          ));
          $header = array("Content-Type:application/json");//x-www-form-urlencoded
          $registerOrder = CurlController::request($url, $method, $fields, $header);


          if($registerOrder->status == 200){
            array_push($idOrden,$registerOrder->id);
            array_push($idProduct, $pOrder->id_product);
            array_push($quantityOrder,$cantidad);

            $unitPrice = number_format(($totalOrder*0.75), 2, '.', '');
            $commissionPrice = number_format(($totalOrder*0.25), 2, '.', '');

            $url = CurlController::api()."sales?token=".$_SESSION["user"]->token_user;
            $method = "POST";
            $fields =json_encode(array(
              'id_order_sale'=>$registerOrder->id,
              'unit_price_sale'=>$unitPrice,
              'commision_sale'=>$commissionPrice,
              'payment_method_sale'=>"mercado-pago",
              'id_payment_sale'=>null,
              'status_sale'=> "test",
              'date_created_sale'=>date('Y-m-d')
            ));
            $header = array("Content-Type:application/json");//x-www-form-urlencoded
            $registerSales = CurlController::request($url, $method, $fields, $header);
            if($registerSales->status == 200){
              array_push($idSale,$registerSales->id);
            }

          }

        }//for register orden
        $descripcion.="Compra de ". $totalCantidad ." productos";
        array_push($rpta,$idOrden,$idProduct,$quantityOrder,$idSale,$descripcion,$totalOrderFinal);

         return $rpta;

      }


      function endCheckout($arrayOrder,$idPayment){

          $totalProcess = 0;
          /*=============================================
          Actualizamos las ventas y disminuir el stock de los productos
          =============================================*/
          if(count($arrayOrder[1])>0 &&count($arrayOrder[2])>0 ){

              $idProduct = $arrayOrder[1];//json_decode($_COOKIE['idProduct'], true);
              $quantityOrder =$arrayOrder[2];// json_decode($_COOKIE['quantityOrder'], true);

              foreach ($idProduct as $key => $value) {

                  $url = CurlController::api()."products?linkTo=id_product&equalTo=".$value."&select=stock_product,sales_product";
                  $method = "GET";
                  $fields = array();
                  $header = array();

                  $products = CurlController::request($url, $method, $fields, $header)->results[0];

                  /*=============================================
                  Actualizamos las ventas y disminuimos el stock de los productos
                  =============================================*/

                  $stock = $products->stock_product-$quantityOrder[$key];
                  $sales = $products->sales_product+$quantityOrder[$key];

                  /*=============================================
                  Actualizar el stock y las ventas de cada producto
                  =============================================*/

                  $url = CurlController::api()."products?id=".$value."&nameId=id_product&token=".$_SESSION["user"]->token_user;
                  $method = "PUT";
                  $fields =  "sales_product=".$sales."&stock_product=".$stock;
                  $header = array();

                  $updateProducts = CurlController::request($url, $method, $fields, $header);

                  if($updateProducts->status == 200){

                      $totalProcess++;
                  }
              }

          }

          /*=============================================
          Actualizamos el estado de la orden
          =============================================*/
          if( count($arrayOrder[0])>0 ){

              $idOrder= $arrayOrder[0];//json_decode($_COOKIE['idOrder'], true);

              foreach ($idOrder as $key => $value) {

                  $url = CurlController::api()."orders?id=".$value."&nameId=id_order&token=".$_SESSION["user"]->token_user;
                  $method = "PUT";
                  $fields =  "status_order=pending";
                  $header = array();

                  $updateOrders = CurlController::request($url, $method, $fields, $header);

                  if($updateOrders->status == 200){

                      $totalProcess++;
                  }

              }

          }

          /*=============================================
          Actualizamos el estado de la venta
          =============================================*/

          if(count($arrayOrder[3])>0 ){

              $idSale =$arrayOrder[3];// json_decode($_COOKIE['idSale'], true);

              foreach ($idSale as $key => $value) {

                  $url = CurlController::api()."sales?id=".$value."&nameId=id_sale&token=".$_SESSION["user"]->token_user;
                  $method = "PUT";
                  $fields =  "status_sale=pending&id_payment_sale=".$idPayment;
                  $header = array();

                  $updateSales = CurlController::request($url, $method, $fields, $header);

                  if($updateSales->status == 200){

                      $totalProcess++;
                  }

              }

          }
            /*=============================================
          Cerramos el proceso de venta
          =============================================*/

          if($totalProcess == (count($idProduct)+count($idOrder)+count($idSale))){

               return true;

          }
      }

 }


 ?>
