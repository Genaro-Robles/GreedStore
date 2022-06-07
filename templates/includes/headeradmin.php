<?php
$user = new mdlUsuarios();
if (!$user::auth() || !$user::isAdmin()) {
  header('Location: ' . URL_MAIN);
}
$perfil = $user::getSessionUser();

?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>GreedStore Admin</title>

  <link href="<?= URL_MAIN ?>assets/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= URL_MAIN ?>assets/admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">


  <link href="<?= URL_MAIN ?>assets/admin/lib/select2/css/select2.min.css" rel="stylesheet">

  <link href="<?= URL_MAIN ?>assets/admin/css/bracket.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= URL_MAIN ?>assets/css/waitme.css">
</head>

<body>
  <div class="br-header">
    <div class="br-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div>
    <div class="br-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down"><?php echo $perfil["nombre"] ?></span>
            <img src="<?= URL_MAIN.UPLOADS.$perfil["perfil"] ?>" class="wd-32 rounded-circle" alt="foto de perfil">
            <span class="square-10 bg-success"></span>
          </a>

          <input type="hidden" id="usu_idx"><!-- Usu_id del usuario -->
          <input type="hidden" id="rol_idx"><!-- Rol_id del usuario -->

          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="<?= URL_MAIN ?>login/logout"><i class="icon ion-power"></i> Cerrar Sesion</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <div class="br-logo"><a href="<?= URL_MAIN ?>"><span>[</span>GreedStore<span>]</span></a></div>

  <div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
    <div class="br-sideleft-menu">

      <a href="<?= URL_MAIN ?>admin/dashboard" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Dashboard</span>
        </div>
      </a>


      <a href="<?= URL_MAIN ?>admin/users" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-person-stalker tx-24"></i>
          <span class="menu-item-label">Usuarios</span>
        </div>
      </a>

      <a href="<?= URL_MAIN ?>admin/productos" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-cube tx-24"></i>
          <span class="menu-item-label">Productos</span>
        </div>
      </a>

      <a href="<?= URL_MAIN ?>admin/anuncios" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-bell-o tx-24"></i>
          <span class="menu-item-label">Anuncios</span>
        </div>
      </a>

      <a href="<?= URL_MAIN ?>admin/categorias" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-bars tx-24"></i>
          <span class="menu-item-label">Categorias</span>
        </div>
      </a>

      <a href="<?= URL_MAIN ?>admin/pedidos" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-calendar tx-24"></i>
          <span class="menu-item-label">Pedidos</span>
        </div>
      </a>


      <a href="<?= URL_MAIN ?>" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
          <span class="menu-item-label">ír a la página</span>
        </div>
      </a>

      <a href="<?= URL_MAIN ?>login/logout" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-power tx-20"></i>
          <span class="menu-item-label">Cerrar Sesion</span>
        </div>
      </a>

    </div>
  </div>