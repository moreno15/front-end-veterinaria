
<section class="widget widget-categories">

  <h3 class="widget-title"><?php echo  $showcaseProducts[0]->url_category ?>

  </h3>
  <ul>

       <?php $title_list=json_decode($showcaseProducts[0]->title_list_category);//grupo [] ?>

       <?php foreach ($title_list as $key2 => $title_value): ?>

             <?php
             $expanded="";
             if (count($urlParams)==4) {
               $url_title=  str_replace("%20", " ",$urlParams[$iParams-1]);
                 if ($url_title==$showcaseProducts[0]->title_list_subcategory) {
                    $color="";
                     if ($url_title==$title_value) {
                        $expanded="expanded " ;
                        $color="#dd4b39";
                      }
                  }
             }else{

               $url_title=  str_replace("%20", " ",$urlParams[$iParams]);
                 if ($url_title==$showcaseProducts[0]->title_list_subcategory) {
                    $color="";
                     if ($url_title==$title_value) {
                        $expanded="expanded " ;
                        $color="#dd4b39";
                      }
                  }
                }
                ?>

            <li class="has-children <?php echo $expanded ?>  ">
              <a href="<?php echo $path."categories/".$showcaseProducts[0]->url_category."/".$title_value ?>" style="color:<?php echo $color ?>"><?php echo $title_value ; ?></a>
              <ul>
                <!--=====================================
                Traer las subcategorías
                ======================================-->

                <?php

                $url = CurlController::api()."subcategories?linkTo=title_list_subcategory&equalTo=".rawurlencode($title_value)."&select=*";
                $method = "GET";
                $fields = array();
                $header = array();

                $menuSubcategories = CurlController::request($url, $method, $fields, $header)->results;

                ?>

                <?php foreach ($menuSubcategories as $key => $value): ?>

                     <?php if (isset($urlParams[0]) ){ ?>
                           <?php if ( $value->url_subcategory==$urlParams[$iParams]) { ?>
                           <li>
                               <a style="color:#dd4b39" href="<?php echo $path."categories/".$showcaseProducts[0]->url_category."/".$title_value."/".$value->url_subcategory ?>"><?php echo $value->name_subcategory ?></a>
                           </li>
                         <?php }else{ ?>
                           <li>
                               <a  href="<?php echo $path."categories/".$showcaseProducts[0]->url_category."/".$title_value."/".$value->url_subcategory ?>"><?php echo $value->name_subcategory ?></a>
                           </li>
                         <?php  } ?>
                     <?php  }else {  ?>
                               <li>
                                   <a  href="<?php echo $path."categories/".$showcaseProducts[0]->url_category."/".$title_value."/".$value->url_subcategory ?>"><?php echo $value->name_subcategory ?></a>
                               </li>
                       <?php } ?>

                <?php endforeach ?>

              </ul>
            </li>
          <?php endforeach;  ?>


  </ul>
</section>
