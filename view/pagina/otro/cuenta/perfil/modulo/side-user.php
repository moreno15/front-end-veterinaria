
<div class="col-lg-4  side-hidden-user">
  <aside class="user-info-wrapper">

    <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
      
    </div>
    <div class="user-info">
      <div class="user-avatar">
        <a class="edit-avatar" href="#"></a>

        <?php if ($_SESSION["user"]->method_user == "direct"): ?>

                   <?php if ($_SESSION["user"]->picture_user == ""): ?>

                       <img  style="height:auto" src="img/users/default/default.png">

                   <?php else: ?>

                       <img  style="height:auto" src="img/users/<?php echo $_SESSION["user"]->id_user ?>/<?php echo $_SESSION["user"]->picture_user ?>">

                   <?php endif ?>

               <?php else: ?>

                   <?php if (explode("/", $_SESSION["user"]->picture_user)[0] == "https:"): ?>

                       <img  style="height:auto" src="<?php echo $_SESSION["user"]->picture_user ?>">

                   <?php else: ?>

                       <img  style="height:auto" src="img/users/<?php echo $_SESSION["user"]->id_user ?>/<?php echo $_SESSION["user"]->picture_user ?>">

                   <?php endif ?>


               <?php endif ?>
      </div>
      <div class="user-data">
        <h4 class="h5"><?php echo $_SESSION["user"]->displayname_user ?></h4><span><?php echo "creado el ". explode("T",$_SESSION["user"]->date_created_user )[0] ?></span>
      </div>
    </div>
  </aside>
  <nav class="list-group">
      <a class="list-group-item with-badge   " href="<?php echo $path."orders" ?>"> <i class="icon-shopping-bag"></i>Mis Ordenes<span class="badge badge-default badge-pill">6</span></a>
      <a class="list-group-item  active " href="<?php echo $path."perfil" ?>"><i class="icon-user"></i>Datos Personales</a>
      <a class="list-group-item   " href="<?php echo $path."address" ?>"><i class="icon-map-pin"></i>Mis Direccion</a>
      <a class="list-group-item   " href="<?php echo $path."heart" ?>"><i class="icon-heart"></i>Favoritos<span class="badge badge-default badge-pill">3</span></a>
      <a class="list-group-item   " href="<?php echo $path."store" ?>"><i class="icon-home"></i>Mi Tienda<span class="badge badge-default badge-pill">3</span></a>
  </nav>
</div>
