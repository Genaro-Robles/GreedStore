<?php
require_once 'app/controllers/ctrCategorias.php';
$resultado = CtrCategorias::ctrListarCategorias();
?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-primary" id="exampleModalToggleLabel">Registrar producto</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

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
                  <label>Catengoría</label>
                  <select name="cbocategoria" id="cbocategoria" class="form-select">
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
                  <input type="text" name="stock" id="stock" class="form-control" placeholder="Ingrese precio">
                </div>
                <div class="col-md-3">
                  <label>Precio</label>
                  <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingrese precio">
                </div>
                <div class="col-md-6">
                  <label for="formFileSm" class="form-label">Foto</label>
                  <input class="form-control form-control-sm" name="foto" id="foto" type="file">
                </div>
              </div>
              <div id="detalles">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <input type="submit" name="btnagregar" id="add-producto" value="Agregar" class="btn btn-primary">
        <button type="button" class="btn btn-primary" id="update-producto">Actualizar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="home-section">
  <div class="text">Productos</div>
  <div class="row justify-content-between m-0 pe-5 ps-4 ">
    <div class="col-md-2">
      <div class="form-floating">
        <input type="email" class="form-control" id="busquedaProd" placeholder="name@example.com">
        <label for="busquedaProd">Buscar</label>
      </div>
    </div>
    <div class="col-md-2">
      <button class="btn btn-success d-flex" id="abrir_producto_modal" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-cloud-plus"></i>
        Agregar
      </button>
    </div>
    <div class="col-md-2">
      <div class="form-floating">
        <select class="form-select" id="filtroProd" aria-label="Floating label select example">
          <option selected>Sin filtro</option>
          <option value="1">categoria</option>
          <option value="2">precio</option>
          <option value="3">stock</option>
        </select>
        <label for="filtroProd">Ordenar por:</label>
      </div>
    </div>
  </div>
  <div class="content">
    <div id="tabla-productos"></div>
  </div>
</section>