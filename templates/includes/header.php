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
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?= URL_MAIN ?>">GreedStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= URL_MAIN ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= URL_MAIN ?>about">About</a></li>

                        <li class="nav-item dropdown" id="drop-menu1">
                            <a class="nav-link dropdown-toggle active" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false" >Catalogo</a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="drop1">
                                <li><a class="dropdown-item" href="<?= URL_MAIN ?>">All</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <?php 
                                foreach ($ListCat as $key => $value) { ?>
                                <li><a class="dropdown-item" href="<?=URL_MAIN?><?=str_replace(' ','-',$value['nombre_categoria'])?>"><?=$value['nombre_categoria'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" href="tsoporte">Enviar Ticket de Soporte</a></li>
                    </ul>
                    <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item" id="drop-menu3">
                            <a class="btn btn-outline-dark dropdown-toggle" data-bs-display="static" id="navbarDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-cart-fill me-1"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill" id="carrito-cant">0</span>
                            </a>
                        
                        <div id="carrito" class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <table id="lista-carrito" class="table">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                    <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
                                    <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar
                                        Compra</a>
                                </div>
                            
                            </li>
                            </ul>
                            </div>
                    

                     <!-- Nav Item - User Information -->
                       <ul class="navbar-nav me-0 mb-2 mb-lg-0 ms-lg-1">
                        <?php // if(!$estado) { ?>
                        <li class="nav-item"><a class="nav-link active" href="<?php echo $location ?>">Login</a></li>
                        <?php // } ?>
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
                        <?php } */?>
                    </ul>
                </div>
            </div>
        </nav>
        
