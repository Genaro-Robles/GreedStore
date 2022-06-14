<?php

$contadorPedidosMes = CtrPedidos::ctrContadorPedidos("mensual");
$contadorPedidosTotales = CtrPedidos::ctrContadorPedidos("totales");
$ingresoPedidosTotales = CtrPedidos::ctrIngresosPedidos("totales");
$ingresoPedidosMes = CtrPedidos::ctrIngresosPedidos("mensual");
$ultimosPedidos =  CtrPedidos::ctrPedidosDashboard(5);
$usuario = CtrUsuarios::ObtenerSession();
$rol = ['Usuario', 'Vendedor', 'Administrador'];
$ultimoProductoRegistrado = CtrPedidos::ctrUltimoProdCat("productos");
$ultimaCategoriaRegistrada = CtrPedidos::ctrUltimoProdCat("categorias");

?>

<div class="br-mainpanel pd-30">
  <section class="home-section">
    <div class="tx-30">Dashboard</div>

    <div class="row row-sm pd-lg-t-30 pd-t-0">
      <div class="col-sm-6 mg-t-30 mg-lg-t-0">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-center">
            <i class="fa fa-money tx-80 lh-0 tx-primary op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Ingresos del Mes</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1">s/. <?php echo ($ingresoPedidosMes); ?></p>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#0866C6"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->
      <div class="col-sm-6  mg-t-30 mg-lg-t-0">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-center">
            <i class="fa fa-money tx-80 lh-0 tx-primary op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Ingresos totales</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1">s/. <?php echo ($ingresoPedidosTotales); ?></p>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#0866C6"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->
      <div class="col-sm-6 mg-t-30">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-center">
            <i class="ion ion-bag tx-80 lh-0 tx-purple op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Pedidos del Mes</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1 text-center"><?php echo ($contadorPedidosMes); ?></p>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#6F42C1"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->
      <div class="col-sm-6 mg-t-30">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-center">
            <i class="ion ion-bag tx-80 lh-0 tx-purple op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Pedidos Totales</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1 text-center"><?php echo ($contadorPedidosTotales); ?></p>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#6F42C1"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->

      <div class="col-lg-6 mg-t-30">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center">
            <i class="fa fa-tasks tx-80 lh-0 tx-teal op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Ultimo producto Registrado</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1"><?php echo ($ultimoProductoRegistrado["nombre"]); ?></p>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#20C997"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->
      <div class="col-sm-6 mg-t-30">
        <div class="bg-white rounded shadow-base overflow-hidden">
          <div class="pd-x-20 pd-t-20 d-flex align-items-center">
            <i class="fa fa-tasks tx-80 lh-0 tx-teal op-5"></i>
            <div class="mg-l-20">
              <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Ultimo categoria Registrada</p>
              <p class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1"><?php echo ($ultimaCategoriaRegistrada["nombre_categoria"]); ?></p>
              <span class="tx-14 tx-roboto tx-gray-600"><?php echo ($ultimaCategoriaRegistrada["descripcion_categoria"]); ?></span>
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-100 rickshaw_graph"><svg width="496" height="60">
              <g>
                <path d="M0,29.999999999999993Q33.06666666666667,2.6000000000000023,38.15384615384615,3.0000000000000027C45.78461538461538,3.600000000000003,68.67692307692307,30.3,76.3076923076923,36S106.83076923076923,58.2,114.46153846153847,60S144.98461538461538,57,152.6153846153846,54S183.13846153846154,26.399999999999995,190.76923076923077,29.999999999999993S221.2923076923077,81,228.92307692307693,90S259.44615384615383,120,267.07692307692304,120S297.6,94.5,305.2307692307692,90S335.75384615384615,79.5,343.38461538461536,75S373.90769230769234,43.50000000000001,381.53846153846155,45.00000000000001S412.0615384615385,91.5,419.6923076923077,90S450.21538461538466,31.499999999999993,457.84615384615387,29.999999999999993Q462.93333333333334,28.999999999999993,496,75L496,150Q462.93333333333334,150,457.84615384615387,150C450.21538461538466,150,427.3230769230769,150,419.6923076923077,150S389.16923076923075,150,381.53846153846155,150S351.01538461538456,150,343.38461538461536,150S312.86153846153843,150,305.2307692307692,150S274.70769230769224,150,267.07692307692304,150S236.55384615384617,150,228.92307692307693,150S198.4,150,190.76923076923077,150S160.24615384615385,150,152.6153846153846,150S122.0923076923077,150,114.46153846153847,150S83.93846153846154,150,76.3076923076923,150S45.78461538461538,150,38.15384615384615,150Q33.06666666666667,150,0,150Z" class="area" fill="#20C997"></path>
              </g>
            </svg></div>
        </div>
      </div><!-- col-4 -->
    </div>
    <div class="row row-sm mg-t-20">
      <div class="col-lg-8 mg-t-20 mg-lg-t-0">
        <div class="card shadow-base bd-0">
          <div class="card-header pd-20 bg-transparent">
            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Ultimos 5 Pedidos</h6>
          </div><!-- card-header -->
          <table class="table table-responsive mg-b-0 tx-12">
            <thead>
              <tr class="tx-10">
                <th class="pd-y-5 tx-center">ID</th>
                <th class="pd-y-5 tx-right">Fecha de Pedido</th>
                <th class="pd-y-5 tx-right">Fecha de Entrega</th>
                <th class="pd-y-5 tx-center">Total</th>
                <th class="pd-y-5">Tipo Entrega</th>
                <th class="pd-y-5 tx-center">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($ultimosPedidos as $pedido) :
              ?>
                <tr>
                  <td class="valign-middle tx-center"><?php echo $pedido["idpedido"] ?></td>
                  <td class="valign-middle tx-center"><?php echo $pedido["fechaPedido"] ?></td>
                  <td class="valign-middle tx-center"><?php echo $pedido["fechaEntrega"] ?></td>
                  <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>s/.<?php echo $pedido["total"] ?></span></td>
                  <td class="valign-middle tx-center tx-12"><?php echo $pedido["tipoEntrega"] ?></td>
                  <td class="tx-12">
                    <span class="square-8 <?php echo ($pedido['estado'] == 1 ? "bg-success" : "bg-danger") ?> mg-r-5 rounded-circle"></span> Pedido <?php echo ($pedido['estado'] == 1 ? "En proceso" : "Concluido") ?>
                  </td>
                </tr>
              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div><!-- card -->
      </div><!-- col-6 -->
      <div class="col-lg-4 mg-t-30 mg-lg-t-0">
        <div class="card shadow-base card-body pd-25 bd-0">
          <div class="row">
            <div class="col-lg-12 mg-t-20 mg-sm-t-0 tx-center">
              <h6 class="card-title tx-uppercase tx-12">Usuario Actual</h6>
              <img src="<?php echo URL_MAIN . UPLOADS . $usuario["perfil"]; ?>" alt="foto del usuario actual">
            </div><!-- col-6 -->
            <div class="col-lg-12 tx-center">
              <div class="card shadow-base bd-0">
                <div class="card-body">
                  <div class="row align-items-center mg-t-5">
                    <div class="col-6 tx-12 tx-bold">Rol</div><!-- col-3 -->
                    <div class="col-6 tx-12">
                      <?php echo $rol[$usuario["rol"] - 1]; ?>
                    </div><!-- col-9 -->
                  </div><!-- row -->
                  <div class="row align-items-center mg-t-5">
                    <div class="col-6 tx-12 tx-bold">Nombre</div><!-- col-3 -->
                    <div class="col-6 tx-12">
                      <?php echo $usuario["nombre"] ?>
                    </div><!-- col-9 -->
                  </div><!-- row -->
                </div><!-- card-body -->
              </div>
            </div><!-- col-6 -->
          </div><!-- row -->
        </div><!-- card -->
      </div>
    </div>

  </section>

</div>