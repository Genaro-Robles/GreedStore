<?php

$perfil = CtrUsuarios::ObtenerSession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="user" content="<?php echo (isset($perfil['id'])) ? $perfil["id"] : "null" ?>">
    <title>GreedStore Homepage</title>
    <!-- Favicon-->
    <link href="<?= URL_MAIN ?>assets/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= URL_MAIN ?>assets/admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">


    <link href="<?= URL_MAIN ?>assets/admin/lib/select2/css/select2.min.css" rel="stylesheet">

    <link href="<?= URL_MAIN ?>assets/admin/css/bracket.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL_MAIN ?>assets/css/waitme.css">
    <link rel="shortcut icon" href="<?= URL_MAIN ?>assets/img/logo-bg-min.png">
    <!-- iconscout-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= URL_MAIN ?>assets/css/normalize.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= URL_MAIN ?>assets/css/header.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= URL_MAIN ?>assets/css/footer.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= URL_MAIN ?>assets/css/waitme.css">
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

                        <li class="d-flex justify-content-evenly">
                            <a class="btn btn-header" id="btn-cart" href="#">
                                <i class="bi bi-basket icon-header"></i>
                                <span>Mi Carrito</span>
                                <span class="c-units js-units carrito-unidades">0</span>
                            </a>
                        </li>
                        <?php
                        if (CtrUsuarios::VerificarSession()) :
                        ?>
                            <li class="d-flex justify-content-evenly align-items-center">

                                <div class="dropdown">
                                    <a class="btn dropdown-toggle btn btn-header" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?= URL_MAIN . UPLOADS . $perfil["perfil"] ?>" alt="" width="32" height="32" class="rounded-circle" id="img-circle">
                                        <?php echo $perfil["nombre"] ?>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?= URL_MAIN ?>" id="modal-usuario-update">Perfil</a></li>
                                        <?php if ($perfil['rol'] >= 2) : ?>
                                            <li><a class="dropdown-item" href="<?= URL_MAIN ?>admin/dashboard">Admin</a></li>
                                        <?php endif; ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="<?= URL_MAIN ?>login/logout">Cerrar sesión</a></li>
                                    </ul>
                                </div>
                            </li>

                        <?php
                        else :
                        ?>
                            <li class="d-flex justify-content-evenly"><a class="btn btn-header" href="<?= URL_MAIN ?>login/iniciar-session"><i class="bi bi-person icon-header"></i><span>Mi cuenta</span></a></li>
                        <?php
                        endif;
                        ?>
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
            <table id="lista-carrito">
                <tbody>
                    <!-- 
                    <a href="" class="text-decoration-none text-dark">
                        <div class="aside-body p-3 border-bottom">
                            <div class="pay-product">
                                <div class="img-product d-flex">
                                    <img src="https://thumb.pccomponentes.com/w-85-85/articles/83/837263/1416-forgeon-adaptador-para-ventilador-de-cpu-socket-lga-1700.jpg" alt="">
                                    <div class="content-product d-flex flex-column ms-3">
                                        <p class="name-product mb-1">Adaptador para ventilador de CPU Socket LGA-1700</p>
                                        <span class="units-product">Unidades: 1</span>
                                        <span class="price-product">S/.<strong>1.000</strong></span>
                                    </div>
                                    <i class="uil uil-multiply" id="btn-delete-product-cart"></i>
                                </div>
                            </div>
                        </div>
                    </a> -->
                </tbody>
            </table>
            <div class="aside-footer p-3 mt-2">
                <div class="pay-title flex-wrap flex-column">
                    <div class="d-flex justify-content-between pay-units-text mb-2">
                        <span class="pay-title-text-title">Unidades</span>
                        <span class="pay-title-text-units carrito-unidades">0</span>
                    </div>
                    <div class="d-flex justify-content-between pay-title-text">
                        <span class="pay-title-text-title">Total a pagar</span>
                        <span class="pay-title-text-price">S/.0.00</span>
                    </div>
                </div>
                <div class="pay-button my-4 d-flex gap-2 flex-column">
                    <a class="btn btn-trash" href="#">
                        Vaciar carrito
                    </a>
                    <a class="btn btn-pay" href="<?= URL_MAIN ?>pedido">
                        Realizar pedido
                    </a>
                </div>
            </div>
        </aside>
        <ul class="bg-white container-xxl px-md-5 d-flex flex-row justify-content-sm-between navbar-nav fsize-13 flex-wrap-reverse">
            <li class="fw-bold">
                <a id="btn-category" class="fw-bold btn d-flex align-items-center fsize-13">
                    <i class="bi bi-list icon-header"></i>
                    Categorias
                </a>
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


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="staticBackdropLabel">Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="p-3 border bg-light">
                                <div class="mb-3">
                                    <form id="form-usuario-update-perfil">
                                        <p for="img-avatar" class="form-label text-center fw-bold">Cambiar foto de perfil</p>
                                        <img class="img-thumbnail rounded mx-auto d-block border-0" style="cursor: pointer;" src="" alt="perfil de usuario" id="img-avatar">
                                        <input class="form-control d-none" type="file" id="perfil" name="perfil" accept="image/*">
                                        <input type="hidden" name="perfil_anterior" id="perfil_anterior">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <form id="form-usuario-update">
                                <div class="mb-3">
                                    <label for="nombre_apellido" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_apellido" name="nombre_apellido" placeholder="Nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular">
                                </div>
                                <div class="mb-3">
                                    <label for="edad" class="form-label">Edad</label>
                                    <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad">
                                </div>
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Email</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Email" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="number" class="form-control" id="dni" name="dni" placeholder="DNI">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-black" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange" id="update-usuario-perfil">Actualizar</button>
                </div>
            </div>
        </div>
    </div>