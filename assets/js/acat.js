
$(document).ready(function () {
    var urlLocation = 'http://localhost/GreedStore/'

    init_search_categoria();

    let add_categoria = document.querySelector('#add-categoria');
    let update_categoria = document.querySelector('#update-categoria');
<<<<<<< HEAD
    let detalleCat = document.getElementById('detalleCat');
    let btnAgregarDetalle = document.getElementById('btnAgregarDet');
    let btnEliminarUltDet = document.getElementById('btnEliminarUltDet');
    let btncloseCat = document.querySelector('.btncloseCat');
=======
    let add_detalle_categoria = document.querySelector('#add-detalle-categoria');
    let delete_detalle_categotia = document.querySelector('#delete-detalle-categoria');
>>>>>>> 0ab2aa8d4f3154f757c799814f53a2d448cd7024
    let abrir_categoria_modal = document.querySelector('#abrir_categoria_modal');


    if (abrir_categoria_modal) {
        abrir_categoria_modal.addEventListener('click', () => {
            $("#detalles-categoria").html("");

            $("#form-categoria")[0].reset();
            $(".modal-title").text("Agregar Categoria")
            $('#exampleModal').modal('show')
            $("#update-categoria").hide();
            $("#add-categoria").show();
        })
    }
<<<<<<< HEAD
    
    if (btnEliminarUltDet) {
        btnEliminarUltDet.addEventListener('click', e => {
            e.preventDefault();
            detalleCat.removeChild(detalleCat.lastChild);
        })
    }

    if (btnAgregarDetalle) {
        btnAgregarDetalle.addEventListener('click', e => {
            e.preventDefault();
            let input = document.createElement('input');
            input.type = "text";
            input.className = "form-control";
            detalleCat.appendChild(input);
        })
    }

    if (btncloseCat) {
        btncloseCat.addEventListener('click', e => {
            e.preventDefault();
            detalleCat.innerHTML = '<label for="disabledTextInput" class="form-label">Descripción</label><br><button class="btn btn-primary" id="btnAgregarDet">Agregar Detalle</button><button class="btn btn-danger" id="btnEliminarUltDet">Eliminar Ultimo Detalle</button>';
            
        })
    }
=======
    if (delete_detalle_categotia) {
        delete_detalle_categotia.addEventListener('click', () => {
            delete_detalles();
        })
    }
    if (add_detalle_categoria) {
        add_detalle_categoria.addEventListener('click', e => {
            e.preventDefault();
>>>>>>> 0ab2aa8d4f3154f757c799814f53a2d448cd7024

            let detalles_categoria = document.querySelector('#detalles-categoria');

            let div_detalle = document.createElement('DIV');
            div_detalle.className = "input-group mb-3";
            let input_detalle = document.createElement('INPUT');
            input_detalle.className = "form-control detalle-categoria-text";
            input_detalle.type = "text";
            let div_checkbox = document.createElement('DIV');
            div_checkbox.className = "input-group-text";
            let input_checkbox_detalle = document.createElement('INPUT');
            input_checkbox_detalle.className = "form-check-input mt-0";
            input_checkbox_detalle.type = "checkbox";

            detalles_categoria.appendChild(div_detalle);
            div_detalle.appendChild(input_detalle);
            div_detalle.appendChild(div_checkbox);
            div_checkbox.appendChild(input_checkbox_detalle);
        })
    }
    if (add_categoria) {

        add_categoria.addEventListener('click', function (e) {
            e.preventDefault();

            let detalles_categoria_inputs = document.querySelectorAll('#detalles-categoria input[type=text]');

            let cadena = "";
            detalles_categoria_inputs.forEach(function (campo) {
                cadena += campo.value + "/";
            })

            let detallesCategoria = cadena.substring(0, cadena.length - 1);

            if (validar_campos_detalles(detalles_categoria_inputs) == false || $(".detalle-categoria-text").length == 0 || $("#form-categoria #nombre").val().trim().length == 0 || $("#form-categoria #foto")[0].files.length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Complete los campos',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                const data = new FormData($("#form-categoria").get(0));
                data.append('detalles', detallesCategoria);
                $.ajax({
                    type: "POST",
                    url: urlLocation + "?ruta=Categorias/AgregarCategoria",
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    beforeSend: function () {
                        $("#form-categoria").waitMe();
                    }
                }).done(function (res) {
                    if (res.status == "201") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (res.status == "400") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    $("#form-categoria")[0].reset();
                    $('#exampleModal').modal('hide');
                }).fail(function (err) {

                }).always(function () {
                    $("#form-categoria").waitMe('hide');
                    init_search_categoria();
                });
            }

        });
    }
    if (update_categoria) {

        update_categoria.addEventListener('click', function (e) {

            e.preventDefault();
            let detalles_categoria_inputs = document.querySelectorAll('#detalles-categoria input[type=text]');

            let cadena = "";
            detalles_categoria_inputs.forEach(function (campo) {
                cadena += campo.value + "/";
            })

            let detallesCategoria = cadena.substring(0, cadena.length - 1);

            if (validar_campos_detalles(detalles_categoria_inputs) == false || $(".detalle-categoria-text").length == 0 || $("#form-categoria #nombre").val().trim().length == 0 || $("#form-categoria #idcategoria").val().trim().length == 0 || $("#form-categoria #foto_anterior").val().trim().length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Complete los campos',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                const data = new FormData($("#form-categoria").get(0));
                data.append('detalles', detallesCategoria);
                $.ajax({
                    type: "POST",
                    url: urlLocation + "?ruta=Categorias/ActualizarCategoria",
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    beforeSend: function () {
                        $("#form-categoria").waitMe();
                    }
                }).done(function (res) {
                    if (res.status == "200") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (res.status == "400") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    $("#form-categoria")[0].reset();
                    $('#exampleModal').modal('hide');
                }).fail(function (err) {

                }).always(function () {
                    $("#form-categoria").waitMe('hide');
                    init_search_categoria();
                });
            }
        })
    }

});

async function init_search_categoria() {

    await buscar_categorias();

    let btn_view_categoria = document.querySelectorAll('.btn-view-categoria');
    let btn_delete = document.querySelectorAll('.btn-delete-categoria');

    btn_view_categoria.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            $(".modal-title").text("Editar Categoria");

            let categoria = Number(e.target.dataset.idcate);

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: urlLocation + "?ruta=Categorias/ListarAJAX",
                data: { categoria },
                beforeSend: function () {
                    $("#form-categoria").waitMe();

                }
            }).done(function (res) {

                let detalles_categoria = document.querySelector('#detalles-categoria');

                $("#form-categoria #nombre").val(res.nombre_categoria);

                $("#form-categoria #idcategoria").val(res.idcategoria);

                $("#form-categoria #foto_anterior").val(res.foto_categoria);

                let detalles = res.descripcion_categoria.split('/');

                $("#detalles-categoria").html("");

                detalles.forEach(function (detalle) {

                    let div_detalle = document.createElement('DIV');
                    div_detalle.className = "input-group mb-3";
                    let input_detalle = document.createElement('INPUT');
                    input_detalle.className = "form-control detalle-categoria-text";
                    input_detalle.type = "text";
                    let div_checkbox = document.createElement('DIV');
                    div_checkbox.className = "input-group-text";
                    let input_checkbox_detalle = document.createElement('INPUT');
                    input_checkbox_detalle.className = "form-check-input mt-0";
                    input_checkbox_detalle.type = "checkbox";

                    detalles_categoria.appendChild(div_detalle);
                    div_detalle.appendChild(input_detalle);
                    div_detalle.appendChild(div_checkbox);
                    div_checkbox.appendChild(input_checkbox_detalle);
                    input_detalle.value = detalle;
                });

                $('#exampleModal').modal('show')

                $("#update-categoria").show();

                $("#add-categoria").hide();
            }).fail(function (err) {
            }).always(function () {
                $("#form-categoria").waitMe('hide');
            });

        });

    });
    btn_delete.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let categoria = Number(e.target.dataset.idcate);
            console.log(categoria);

            if (categoria != null) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, bórralo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: urlLocation + "?ruta=Categorias/EliminarCategoria",
                            data: { idcategoria: categoria },
                        }).done(function (res) {
                            if (res.status == "200") {
                                Swal.fire(
                                    'Eliminado!',
                                    res.msg,
                                    'success'
                                )
                            } else if (res.status == "400") {
                                Swal.fire(
                                    'Error!',
                                    res.msg,
                                    'error'
                                )
                            }

                        }).fail(function (err) {

                        }).always(function () {
                            init_search_categoria();
                        });
                    }
                })
            }

        });

    });

}

function delete_detalles() {
    let checkboxes = document.querySelectorAll('#detalles-categoria input[type=checkbox]');
    if (checkboxes.length <= 0) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'No hay campos a eliminar',
            showConfirmButton: false,
            timer: 2500
        })
    }
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            let div_padre = checkbox.parentNode.parentNode;
            div_padre.parentNode.removeChild(div_padre);
        }
    });
}

async function buscar_categorias() {
    nom = $("#busquedaProd").val();
    await $.ajax({
        type: "POST",
        url: urlLocation + "?ruta=Categorias/ListarCategoriasTabla",
        dataType: "html",
        success: function (response) {
            $("#tabla-categorias").html(response);
        }
    });

}

//Función para comprobar los campos de texto
function validar_campos_detalles(campos) {

    let camposRellenados = true;
    campos.forEach(campo => {
        if (campo.value.length <= 0) {
            camposRellenados = false;
            return false;
        }
    }
    );
    if (camposRellenados == false) {
        return false;
    }
    else {
        return true;
    }
}