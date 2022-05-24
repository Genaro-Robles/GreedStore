<?php
$producto = CtrProductos::ctrListarItem($idp);
$categoria = CtrCategorias::ctrListar($producto['categoria']);
$relacionados = CtrProductos::ctrListarRelacionados($idp, $producto['categoria']);
?>
<!-- Product section-->
<section class="pt-5">
    <div class="container px-4 px-lg-5 my-5 lista-productos">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img id="FotoP" class="card-img-top mb-5 mb-md-0" width="408px" height="350px" src="<?php echo URL_MAIN.UPLOADS.$producto['foto_producto']; ?>"></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: BST-498</div>
                <h1 class="display-5 fw-bolder" id="Titulo"><?php echo $producto['nombre']; ?></h1>
                <div class="fs-5 mb-5" id="Precio">
                    S/.<span><?php echo $producto['precio']; ?></span>
                </div>
                <p class="lead"><?php echo $producto['descripcion']; ?></p>
                <div class="d-flex">
                    <a class="agregar-carrito btn btn-outline-dark flex-shrink-0 " id="btnid" data-id="<?php echo $producto['idproducto']; ?>">
                        <i class="bi-cart-fill me-1"></i>
                        Añadir al carrito
                    </a>
                </div>
            </div>

        </div>
        <h3 class="fw-bolder">Detalles</h3>
        <dl class="row">
        <?php
        $prodD = rtrim($producto['descripcion'], '/');
        $prodD = filter_var($prodD, FILTER_SANITIZE_URL);
        $prodD = explode('/', $prodD);

        $catD = rtrim($categoria['descripcion_categoria'], '/');
        $catD = filter_var($catD, FILTER_SANITIZE_URL);
        $catD = explode('/', $catD);
        for($i=0;$i<sizeof($catD);$i++){  ?>
            <dt class="col-sm-3"><?= $catD[$i] ?>:</dt>
            <dd class="col-sm-9"><?= $prodD[$i] ?></dd>
        <?php } ?> 
        </dl>
</section>
<!-- Items relacionados -->
<section class="py-1 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Productos relacionados</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($relacionados as $key => $value) { ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a href="<?=URL_MAIN?>item/<?= $value['idproducto']; ?>">
                            <img class="card-img-top" width="254px" height="170px" src="<?php echo URL_MAIN.UPLOADS.$value['foto_producto'];  ?>" />
                        </a>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $value['nombre']; ?></h5>
                                <!-- Product price-->
                                Precio: S/. <?php echo $value['precio']; ?>
                                <br>
                                Stock: <?php echo $value['Stock']; ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="item.php?idp=<?php echo $value['idproducto']; ?>&idcat=<?php echo $fila2['idcategoria']; ?>">Detalles</a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>