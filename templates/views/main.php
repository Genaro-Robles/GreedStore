<?php
if(isset($cat)){$productos = CtrProductos::ctrListar($cat);}
else{ $productos = CtrProductos::ctrListar('');}
?>
<!-- Header-->
<header class="bg-dark py-1">
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="templates/views/slider1.png" style="height: 300px;" class="d-block w-100">
      </div>
      <?php
      for ($i = 2; $i <= 6; $i++) {
      ?>
        <div class="carousel-item">
          <img src="templates/views/slider2.png" style="height: 300px;" class="d-block w-100">
        </div>
      <?php } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </div>
</header>
<!-- Section-->
<section class="py-5">
  <div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
      <?php foreach ($productos as $key => $value){ ?>
      <div class="col mb-5 lista-productos">
        <div class="card h-100">
          <!-- Product image-->
          <a href="<?= URL_MAIN?>item/<?= $value['idproducto']; ?>">
            <img class="card-img-top" width="254px" id="FotoP" height="170px" src="data:image/png;base64,<?php echo base64_encode( $value['imagen']); ?>"/>
          </a>
          <!-- Product details-->
          <div class="card-body p-4">
            <div class="text-center">
              <!-- Product name-->
              <h5 class="fw-bolder" id="Titulo"><?= $value['nombre']; ?></h5>
              <!-- Product price-->
              <div id="Precio">
                Precio: S/. <span><?= $value['precio']; ?></span>
              </div>
              Stock: <?= $value['stock']; ?>
            </div>
          </div>
          <!-- Product actions-->
          <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center pb-2"><a class="btn btn-outline-dark mt-auto" href="item.php?idp=<?php //echo $fila['idproducto']; ?>&idcat=<?php //echo $fila['idcategoria']; ?>">Detalles</a></div>
            <div class="text-center "><a id="btnid" class="btn btn-outline-dark mt-auto agregar-carrito" data-id="<?php //echo $fila['idproducto']; ?>" href="#">Añadir al Carrito</a></div>
          </div>
        </div>
      </div>
      <?php } ?>
      <!-- Sale badge
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>-->
      <!-- Product reviews
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    -->
    </div>
  </div>
</section>