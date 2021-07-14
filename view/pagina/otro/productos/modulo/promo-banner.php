
<div class="row"> 
  <?php foreach ($productsDefaultBanner as $key => $value): ?>


    <div class="col-lg-6 col-sm-6" style="margin-top:10px;float:left;margin-bottom:50px">
        <a   href="<?php echo $path.$value->url_product ?>">
            <img src="img/products/<?php echo $value->url_category ?>/default/<?php echo $value->default_banner_product ?>" alt="<?php echo $value->name_product ?>">
        </a>
    </div>

<?php endforeach ?>
</div>
