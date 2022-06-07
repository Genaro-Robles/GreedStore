<?php
require_once 'app/controllers/ctrCategorias.php';
$resultado = CtrCategorias::ctrListarCategorias();
?>

<div class="br-mainpanel pd-30">
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h3 class="modal-title text-primary" id="exampleModalToggleLabel">Registrar producto</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pd-20">
          <form action="" method="POST" id="form-producto">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-md-2">
                    <label>ID</label>
                    <input type="text" name="idproducto" id="idproducto" class="form-control" readonly="true">
                    <input type="hidden" name="foto_anterior" id="foto_anterior" readonly>
                  </div>
                  <div class="col-md-4">
                    <label>Categoría</label>
                    <select name="cbocategoria" id="cbocategoria" class="form-control">
                      <option value="0">Seleccione una categoria</option>
                      <?php foreach ($resultado as $opciones) : ?>
                        <option value="<?php echo $opciones['idcategoria'] ?>"><?php echo $opciones['nombre_categoria'] ?> </option>
                      <?php endforeach ?>

                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del Producto">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3">
                    <label>Stock</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Ingrese Stock">
                  </div>
                  <div class="col-md-3">
                    <label>Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingrese Precio">
                  </div>
                  <div class="col-md-6">
                    <label for="formFileSm" class="form-label">Foto</label>
                    <input class="form-control form-control-sm" name="foto" id="foto" type="file" accept="image/*">
                  </div>
                </div>
                <div id="detalles">
                </div>
              </div>
            </div>
          </form>
        </div><!-- modal-body -->
        <div class="modal-footer">
          <input type="submit" name="btnagregar" id="add-producto" value="Agregar" class="btn btn-primary tx-size-xs">
          <button type="button" class="btn btn-primary" id="update-producto">Actualizar</button>
          <button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div><!-- modal-dialog -->
  </div>
  <section class="home-section">
    <div class="tx-30">Productos</div>
    <div class="row justify-content-between pd-b-30 align-items-center">

      <div class="col-lg-4">
        <div class="form-group mg-b-10-force">
          <!--      <label class="form-control-label">Buscar: <span class="tx-danger">*</span></label> -->
          <input class="form-control" type="text" name="busquedaProd" placeholder="Buscar....." id="busquedaProd">
        </div>
      </div>
      <div class="col-md-4 mg-b-10">
        <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#modaldemo3" id="abrir_producto_modal" type="button">
          <i class="fa fa-folder"></i>
          Agregar
        </button>
      </div>
      <div class="col-md-2">
        <div class="form-floating">
          <label for="filtroProd">Ordenar por:</label>
          <select class="form-control select2" id="filtroProd" aria-label="Floating label select example">
            <option selected>Sin filtro</option>
            <option value="1">categoria</option>
            <option value="2">precio</option>
            <option value="3">stock</option>
          </select>
        </div>
      </div>
    </div>
    <div class="content">
      <div id="tabla-productos"></div>
    </div>
  </section>

</div>