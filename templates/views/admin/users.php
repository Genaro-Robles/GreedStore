<?php
require_once 'app/controllers/ctrRoles.php';
$resultado = CtrRoles::ctrListarRoles();
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ver usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <fieldset>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">ID Usuario</label>
              <input type="number" id="id" class="form-control" placeholder="">
            </div>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Nombre Usuario</label>
              <input type="text" id="nombre" class="form-control" placeholder="">
            </div>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Correo Usuario</label>
              <input type="email" id="email" class="form-control" placeholder="">
            </div>
            <div class="mb-3">
              <label for="disabledSelect" class="form-label">Rol Usuario</label>
              <select id="roles" class="form-select">
                <?php foreach ($resultado as $opciones) : ?>
                  <option value="<?php echo $opciones['id'] ?>"><?php echo $opciones['rol'] ?> </option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">Metodo de registro</label>
              <input type="text" id="metodo" class="form-control" placeholder="">
            </div>
            <div class="badge text-wrap" style="width: 6rem;" id="estado">
              
            </div>
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>


<section class="home-section">
  <div class="text">Usuarios</div>
  <div class="row justify-content-between m-0 pe-5 ps-4 ">
    <div class="col-md-2">
    </div>

  </div>
  <div class="content">
    <div id="tabla-usuarios"></div>
  </div>
</section>