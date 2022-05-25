<style>
    .form-check-input:checked {
        background-color: #fd0d0d;
        border-color: #fd0d0d;
    }

    .form-check-input:focus {
        border-color: #fe8686;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(253 13 13 / 25%);
    }
</style>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-categoria">Agregar</button>
                <button type="button" class="btn btn-primary" id="update-categoria">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<section class="home-section">
    <div class="text">Categorias</div>
    <div class="row justify-content-between m-0 pe-5 ps-4 ">
        <div class="text-center">
            <button class="btn btn-success d-flex" id="abrir_categoria_modal" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-cloud-plus"></i>
                Agregar
            </button>
        </div>

    </div>
    <div class="content">
        <div id="tabla-categorias"></div>
    </div>
</section>