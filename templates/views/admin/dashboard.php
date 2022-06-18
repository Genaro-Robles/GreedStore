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
          <div id="ch5" class="ht-60 tr-y-1 rickshaw_graph"><svg width="1625" height="60">
              <g>
                <path d="M0,30Q117.36111111111111,25.75,135.41666666666666,26.25C162.49999999999997,27,243.74999999999997,37.125,270.8333333333333,37.5S379.1666666666667,31.5,406.25,30S514.5833333333333,22.5,541.6666666666666,22.5S650,27.75,677.0833333333334,30S785.4166666666666,42.75,812.5,45S920.8333333333334,52.5,947.9166666666667,52.5S1056.25,46.125,1083.3333333333333,45S1191.6666666666667,42.375,1218.75,41.25S1327.0833333333335,33.375,1354.1666666666667,33.75S1462.5,45.375,1489.5833333333333,45Q1507.638888888889,44.75,1625,30L1625,60Q1507.638888888889,60,1489.5833333333333,60C1462.5,60,1381.25,60,1354.1666666666667,60S1245.8333333333333,60,1218.75,60S1110.4166666666665,60,1083.3333333333333,60S975.0000000000001,60,947.9166666666667,60S839.5833333333334,60,812.5,60S704.1666666666667,60,677.0833333333334,60S568.75,60,541.6666666666666,60S433.3333333333333,60,406.25,60S297.91666666666663,60,270.8333333333333,60S162.49999999999997,60,135.41666666666666,60Q117.36111111111111,60,0,60Z" class="area" fill="#0866C6"></path>
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
          <div id="ch5" class="ht-60 tr-y-1 rickshaw_graph"><svg width="1625" height="60">
              <g>
                <path d="M0,30Q117.36111111111111,25.75,135.41666666666666,26.25C162.49999999999997,27,243.74999999999997,37.125,270.8333333333333,37.5S379.1666666666667,31.5,406.25,30S514.5833333333333,22.5,541.6666666666666,22.5S650,27.75,677.0833333333334,30S785.4166666666666,42.75,812.5,45S920.8333333333334,52.5,947.9166666666667,52.5S1056.25,46.125,1083.3333333333333,45S1191.6666666666667,42.375,1218.75,41.25S1327.0833333333335,33.375,1354.1666666666667,33.75S1462.5,45.375,1489.5833333333333,45Q1507.638888888889,44.75,1625,30L1625,60Q1507.638888888889,60,1489.5833333333333,60C1462.5,60,1381.25,60,1354.1666666666667,60S1245.8333333333333,60,1218.75,60S1110.4166666666665,60,1083.3333333333333,60S975.0000000000001,60,947.9166666666667,60S839.5833333333334,60,812.5,60S704.1666666666667,60,677.0833333333334,60S568.75,60,541.6666666666666,60S433.3333333333333,60,406.25,60S297.91666666666663,60,270.8333333333333,60S162.49999999999997,60,135.41666666666666,60Q117.36111111111111,60,0,60Z" class="area" fill="#0866C6"></path>
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
          <div id="ch5" class="ht-60 tr-y-1 rickshaw_graph"><svg width="1625" height="60">
              <g>
                <path d="M0,30Q117.36111111111111,25.75,135.41666666666666,26.25C162.49999999999997,27,243.74999999999997,37.125,270.8333333333333,37.5S379.1666666666667,31.5,406.25,30S514.5833333333333,22.5,541.6666666666666,22.5S650,27.75,677.0833333333334,30S785.4166666666666,42.75,812.5,45S920.8333333333334,52.5,947.9166666666667,52.5S1056.25,46.125,1083.3333333333333,45S1191.6666666666667,42.375,1218.75,41.25S1327.0833333333335,33.375,1354.1666666666667,33.75S1462.5,45.375,1489.5833333333333,45Q1507.638888888889,44.75,1625,30L1625,60Q1507.638888888889,60,1489.5833333333333,60C1462.5,60,1381.25,60,1354.1666666666667,60S1245.8333333333333,60,1218.75,60S1110.4166666666665,60,1083.3333333333333,60S975.0000000000001,60,947.9166666666667,60S839.5833333333334,60,812.5,60S704.1666666666667,60,677.0833333333334,60S568.75,60,541.6666666666666,60S433.3333333333333,60,406.25,60S297.91666666666663,60,270.8333333333333,60S162.49999999999997,60,135.41666666666666,60Q117.36111111111111,60,0,60Z" class="area" fill="#6F42C1"></path>
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
          <div id="ch5" class="ht-60 tr-y-1 rickshaw_graph"><svg width="1625" height="60">
              <g>
                <path d="M0,30Q117.36111111111111,25.75,135.41666666666666,26.25C162.49999999999997,27,243.74999999999997,37.125,270.8333333333333,37.5S379.1666666666667,31.5,406.25,30S514.5833333333333,22.5,541.6666666666666,22.5S650,27.75,677.0833333333334,30S785.4166666666666,42.75,812.5,45S920.8333333333334,52.5,947.9166666666667,52.5S1056.25,46.125,1083.3333333333333,45S1191.6666666666667,42.375,1218.75,41.25S1327.0833333333335,33.375,1354.1666666666667,33.75S1462.5,45.375,1489.5833333333333,45Q1507.638888888889,44.75,1625,30L1625,60Q1507.638888888889,60,1489.5833333333333,60C1462.5,60,1381.25,60,1354.1666666666667,60S1245.8333333333333,60,1218.75,60S1110.4166666666665,60,1083.3333333333333,60S975.0000000000001,60,947.9166666666667,60S839.5833333333334,60,812.5,60S704.1666666666667,60,677.0833333333334,60S568.75,60,541.6666666666666,60S433.3333333333333,60,406.25,60S297.91666666666663,60,270.8333333333333,60S162.49999999999997,60,135.41666666666666,60Q117.36111111111111,60,0,60Z" class="area" fill="#6F42C1"></path>
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
          <div id="rickshaw2" class="wd-100p ht-90 rickshaw_graph"><svg width="2447" height="150">
              <g>
                <path d="M0,29.999999999999993Q163.13333333333335,2.6000000000000023,188.23076923076925,3.0000000000000027C225.8769230769231,3.600000000000003,338.8153846153847,30.3,376.4615384615385,36S527.0461538461539,58.2,564.6923076923077,60S715.2769230769231,57,752.923076923077,54S903.5076923076923,26.399999999999995,941.1538461538462,29.999999999999993S1091.7384615384617,81,1129.3846153846155,90S1279.9692307692308,120,1317.6153846153845,120S1468.2000000000003,94.5,1505.846153846154,90S1656.4307692307693,79.5,1694.076923076923,75S1844.6615384615386,43.50000000000001,1882.3076923076924,45.00000000000001S2032.8923076923077,91.5,2070.5384615384614,90S2221.123076923077,31.499999999999993,2258.769230769231,29.999999999999993Q2283.866666666667,28.999999999999993,2447,75L2447,150Q2283.866666666667,150,2258.769230769231,150C2221.123076923077,150,2108.1846153846154,150,2070.5384615384614,150S1919.9538461538461,150,1882.3076923076924,150S1731.7230769230769,150,1694.076923076923,150S1543.4923076923078,150,1505.846153846154,150S1355.2615384615383,150,1317.6153846153845,150S1167.0307692307692,150,1129.3846153846155,150S978.8000000000001,150,941.1538461538462,150S790.5692307692309,150,752.923076923077,150S602.3384615384616,150,564.6923076923077,150S414.10769230769233,150,376.4615384615385,150S225.8769230769231,150,188.23076923076925,150Q163.13333333333335,150,0,150Z" class="area" fill="#01CB99"></path>
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
            </div>
          </div>
          <div id="rickshaw2" class="wd-100p ht-90 rickshaw_graph"><svg width="2447" height="150">
              <g>
                <path d="M0,29.999999999999993Q163.13333333333335,2.6000000000000023,188.23076923076925,3.0000000000000027C225.8769230769231,3.600000000000003,338.8153846153847,30.3,376.4615384615385,36S527.0461538461539,58.2,564.6923076923077,60S715.2769230769231,57,752.923076923077,54S903.5076923076923,26.399999999999995,941.1538461538462,29.999999999999993S1091.7384615384617,81,1129.3846153846155,90S1279.9692307692308,120,1317.6153846153845,120S1468.2000000000003,94.5,1505.846153846154,90S1656.4307692307693,79.5,1694.076923076923,75S1844.6615384615386,43.50000000000001,1882.3076923076924,45.00000000000001S2032.8923076923077,91.5,2070.5384615384614,90S2221.123076923077,31.499999999999993,2258.769230769231,29.999999999999993Q2283.866666666667,28.999999999999993,2447,75L2447,150Q2283.866666666667,150,2258.769230769231,150C2221.123076923077,150,2108.1846153846154,150,2070.5384615384614,150S1919.9538461538461,150,1882.3076923076924,150S1731.7230769230769,150,1694.076923076923,150S1543.4923076923078,150,1505.846153846154,150S1355.2615384615383,150,1317.6153846153845,150S1167.0307692307692,150,1129.3846153846155,150S978.8000000000001,150,941.1538461538462,150S790.5692307692309,150,752.923076923077,150S602.3384615384616,150,564.6923076923077,150S414.10769230769233,150,376.4615384615385,150S225.8769230769231,150,188.23076923076925,150Q163.13333333333335,150,0,150Z" class="area" fill="#01CB99"></path>
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
              <img src="<?php echo URL_MAIN . UPLOADS . $usuario["perfil"]; ?>" class="img-thumbnail" alt="foto del usuario actual">
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