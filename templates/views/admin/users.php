<?php
require_once 'app/controllers/ctrRoles.php';
$resultado = CtrRoles::ctrListarRoles();
?>

<style>
  @media (min-width: 576px) {
    .modal-dialog {
      width: 500px;
      margin: 30px auto;
    }
  }
</style>
<div class="br-mainpanel pd-30">
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h3 class="modal-title text-primary" id="exampleModalToggleLabel">Ver Usuario</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pd-20">
          <form id="form-usuario" require>
            <fieldset>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">ID Usuario</label>
                <input type="number" id="idusuario" name="idusuario" class="form-control" placeholder="" readonly="true">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Nombre Usuario</label>
                <input type="text" id="nombre" class="form-control" placeholder="" readonly="true">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Correo Usuario</label>
                <input type="email" id="email" class="form-control" placeholder="" readonly="true">
              </div>
              <div class="mb-3">
                <label for="disabledSelect" class="form-label">Rol Usuario</label>
                <select id="cborol" name="cborol" class="form-control">
                  <option value="0">Seleccione un rol</option>
                  <?php foreach ($resultado as $opciones) : ?>
                    <option value="<?php echo $opciones['id'] ?>"><?php echo ucfirst($opciones['rol']) ?> </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Metodo de registro</label>
                <input type="text" id="metodo" class="form-control" readonly="true" placeholder="">
              </div>
              <div class="badge text-wrap" style="width: 6rem;" id="estado">

              </div>
            </fieldset>
          </form>
        </div><!-- modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update-usuario">Actualizar</button>
        </div>
      </div>
    </div><!-- modal-dialog -->
  </div>


  <section class="home-section">
    <div class="tx-30">Usuarios</div>
    <div class="row justify-content-between pd-b-30 align-items-center">
      <div class="col-md-2">
      </div>

    </div>
    <div class="content">
      <div id="tabla-usuarios"></div>
    </div>
  </section>
</div>