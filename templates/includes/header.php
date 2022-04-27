<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GreedStore Homepage</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- iconscout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= URL_MAIN ?>assets/css/header.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/footer.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/normalize.css" rel="stylesheet" />
</head>

<body>

    <!-- Navigation-->
    <header class="">
        <div class="alert alert-dark alert-dismissible fade show text-center" role="alert">
            <div class="d-flex justify-content-evenly">
                <div class="fw-bolder alert-title">
                    Aprovecha nuestras ofertas del #Cyber Wow!
                </div>
                <div class="fw-bolder alert-title">
                    Envíos gratuitos a partir de $50.00
                </div>
                <button type="button" class="btn-closed" data-bs-dismiss="alert" aria-label="Close"><i class="uil uil-multiply"></i></button>
            </div>
        </div>
        <nav class="container-fluid navbar navbar-expand-lg navbar-light bg-white border">
            <div class="container-xxl px-4 px-xxl-5">
                <a class="navbar-brand" href="<?= URL_MAIN ?>">
                    <img src="<?= URL_MAIN ?>assets/img/logo-bg-max.png" class="logo-max" alt="">
                    <img src="<?= URL_MAIN ?>assets/img/logo-bg-min.png" class="logo-min" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                        <!--<li class="nav-item"><a class="nav-link active" href="<?= URL_MAIN ?>about">About</a></li>-->


                        <!--<li class="nav-item"><a class="nav-link active" href="tsoporte">Enviar Ticket de Soporte</a></li>-->
                    </ul>



                    <!-- Nav Item - User Information -->
                    <ul class="navbar-nav me-0 mb-2 mb-lg-0 ms-lg-1">
                        <li class="d-flex justify-content-evenly"><a class="btn btn-header"><i class="bi bi-person icon-header"></i><span>Mi cuenta</span></a></li>
                        <li class="d-flex justify-content-evenly">
                            <a class="btn btn-header" id="btn-cart" href="<?= URL_MAIN ?>login">
                                <i class="bi bi-basket icon-header"></i>
                                <span>Mi Carrito</span>
                                <span class="c-units js-units">0</span>
                            </a>
                        </li>
                        <?php /* if($estado) { ?>
                            <li class="nav-item dropdown" id="drop-menu2">
                                <a class="nav-link dropdown-toggle active" id="navbarDropdown2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="drop2">
                                    <li><a class="dropdown-item" href="usuario?id=<?php echo $id ?>">Profile</a></li>
                                    <li><a class="dropdown-item" href="mispedidos?id=<?php echo $id ?>">Mis Pedidos</a></li>
                                    <li><a class="dropdown-item" href="mistickets?id=<?php echo $id ?>">Mis Tickets</a></li>
                                    <?php if($rol=="1") { ?>
                                    <li><a class="dropdown-item" href="Admin/sb-admin-2/">Admin</a></li>
                                    <?php } ?>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="modulosphp/logout">Logout</a></li>
                                </ul>
                            </li>
                            <?php } */ ?>
                    </ul>
                </div>
            </div>
        </nav>
        <aside class="aside-cart" id="carrito">
            <div class="aside-header border-bottom">
                <div class="title--cart">Mi carrito</div>
                <span class="close--cart"><i class="uil uil-multiply"></i></span>
            </div>
            <table id="lista-carrito" class="table">
                <tbody><!--
                    <a href="" class="text-decoration-none text-dark">
                        <div class="aside-body p-3 border-bottom">
                            <div class="pay-product">
                                <div class="img-product d-flex">
                                    <img src="https://thumb.pccomponentes.com/w-85-85/articles/83/837263/1416-forgeon-adaptador-para-ventilador-de-cpu-socket-lga-1700.jpg" alt="">
                                    <div class="content-product d-flex flex-column ms-3">
                                        <p class="name-product mb-1">Adaptador para ventilador de CPU Socket LGA-1700</p>
                                        <span class="units-product">Unidades: 1</span>
                                        <span class="price-product"><strong>$1.000</strong></span>
                                    </div>
                                    <i class="uil uil-multiply" id="btn-delete-product-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a>-->
                </tbody>
            </table>
            <div class="aside-footer p-3 mt-2">
                <div class="pay-title flex-wrap flex-column">
                    <div class="d-flex justify-content-between pay-units-text mb-2">
                        <span class="pay-title-text-title">Unidades</span>
                        <span class="pay-title-text-units">0</span>
                    </div>
                    <div class="d-flex justify-content-between pay-title-text">
                        <span class="pay-title-text-title">Total a pagar</span>
                        <span class="pay-title-text-price">$0.00</span>
                    </div>
                </div>
                <div class="pay-button my-4">
                    <a class="btn btn-pay" href="<?= URL_MAIN ?>login">
                        Realizar pedido
                    </a>
                </div>
            </div>
        </aside>
        <ul class="bg-white container-xxl px-md-5 d-flex flex-row justify-content-sm-between navbar-nav fsize-13 flex-wrap-reverse">
            <li class="fw-bold"><a href="" id="btn-category" class="fw-bold btn d-flex align-items-center fsize-13">
                    <i class="bi bi-list icon-header"></i> Categorias</a>
                <div class="categories">
                    <ul class="navbar-nav">
                        <li><a class="dropdown-item" href="<?= URL_MAIN ?>">Todas las categorias</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <?php
                        foreach ($ListCat as $key => $value) : ?>
                            <li><a class="dropdown-item" href="<?= URL_MAIN ?><?= str_replace(' ', '-', $value['nombre_categoria']) ?>"><?= $value['nombre_categoria'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <li class="d-flex align-items-center"><a href="" class="btn fsize-13">Tu <strong style="color: #ff6000;">tienda online experta en tecnología</strong> con un servicio 5 estrellas</a></li>
        </ul>
    </header>