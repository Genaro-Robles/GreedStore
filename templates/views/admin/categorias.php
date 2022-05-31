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
                    <h3 class="modal-title text-primary" id="exampleModalToggleLabel">Registrar Categoria</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <form id="form-categoria" require>
                        <fieldset>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">ID</label>
                                <input type="number" id="idcategoria" name="idcategoria" class="form-control" placeholder="" readonly="true">
                                <input type="hidden" name="foto_anterior" id="foto_anterior" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Nombre Categoria</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="">
                            </div>
                            <!-- <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Descripción</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="">
                        </div> -->
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Detalles Categoria</label>
                                <div class="d-grid gap-2 d-md-block text-center mb-3">
                                    <button class="btn btn-primary" type="button" id="add-detalle-categoria">Agregar Detalle</button>
                                    <button class="btn btn-danger" type="button" id="delete-detalle-categoria">Eliminar Detalle(s)</button>
                                </div>
                                <div id="detalles-categoria" class="mb-3">
                                    <!-- <div class="input-group mb-3">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                    </div>
                                </div> -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Foto</label>
                                <input class="form-control form-control-sm" name="foto" id="foto" type="file" accept="image/*">
                            </div>
                        </fieldset>
                    </form>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-categoria">Agregar</button>
                    <button type="button" class="btn btn-primary" id="update-categoria">Actualizar</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>


    <section class="home-section">
        <div class="tx-30">Categorias</div>
        <div class="row justify-content-center pd-b-30 align-items-center">
            <div class="text-center">
                <button class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" id="abrir_categoria_modal" type="button" data-toggle="modal" data-target="#modaldemo3">
                    <i class="fa fa-folder"></i>
                    Agregar
                </button>
            </div>

        </div>
        <div class="content">
            <div id="tabla-categorias"></div>
        </div>
    </section>

</div>