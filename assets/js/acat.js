
$(document).ready(function () {
    var urlLocation = 'http://localhost/GreedStore/'

    init_search_categoria();

    let add_categoria = document.querySelector('#add-categoria');
    let update_categoria = document.querySelector('#update-categoria');
    let add_detalle_categoria = document.querySelector('#add-detalle-categoria');
    let delete_detalle_categotia = document.querySelector('#delete-detalle-categoria');
    let abrir_categoria_modal = document.querySelector('#abrir_categoria_modal');


    if (abrir_categoria_modal) {
        abrir_categoria_modal.addEventListener('click', () => {
            $("#detalles-categoria").html("");

            $("#form-categoria")[0].reset();
            $(".modal-title").text("Agregar Categoria")
            $('#modaldemo3').modal('show')
            $("#update-categoria").hide();
            $("#add-categoria").show();
        })
    }
    if (delete_detalle_categotia) {
        delete_detalle_categotia.addEventListener('click', () => {
            delete_detalles();
        })
    }
    if (add_detalle_categoria) {
        add_detalle_categoria.addEventListener('click', e => {
            e.preventDefault();

            let detalles_categoria = document.querySelector('#detalles-categoria');

            let div_detalle = document.createElement('DIV');
            div_detalle.className = "input-group mg-b-10";
            let input_detalle = document.createElement('INPUT');
            input_detalle.className = "form-control detalle-categoria-text";
            input_detalle.type = "text";

            let span_checkbox = document.createElement('SPAN');
            span_checkbox.className = "input-group-addon bg-transparent";

            let label_checkbox = document.createElement('LABEL');
            label_checkbox.className = "ckbox wd-16 ckbox-danger";



            let input_checkbox_detalle = document.createElement('INPUT');
            input_checkbox_detalle.type = "checkbox";
            let span = document.createElement('SPAN');


            detalles_categoria.appendChild(div_detalle);
            div_detalle.appendChild(input_detalle);
            div_detalle.appendChild(span_checkbox);
            span_checkbox.appendChild(label_checkbox);
            label_checkbox.appendChild(input_checkbox_detalle);
            label_checkbox.appendChild(span);


            /* div_detalle.appendChild(div_checkbox);
            div_checkbox.appendChild(input_checkbox_detalle); */
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
                Swal.fire(
                    'Algo salio mal!',
                    'Comprueba que todos los campos esten rellenos',
                    'warning'
                )
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
                        Swal.fire(
                            'Agregado!',
                            res.msg,
                            'success'
                        )
                    } else if (res.status == "400") {
                        Swal.fire(
                            'Algo salio mal!',
                            res.msg,
                            'error'
                        )
                    }
                    $("#form-categoria")[0].reset();
                    $('#modaldemo3').modal('hide');
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
                Swal.fire(
                    'Algo salio mal!',
                    'Comprueba que todos los campos esten rellenos',
                    'warning'
                )
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
                        Swal.fire(
                            'Actualizado!',
                            res.msg,
                            'success'
                        )
                    } else if (res.status == "400") {
                        Swal.fire(
                            'Algo salio mal!',
                            res.msg,
                            'Error'
                        )
                    }
                    $("#form-categoria")[0].reset();
                    $('#modaldemo3').modal('hide');
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
    let btn_action_categoria = document.querySelectorAll('.btn-action-categoria');

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
                    div_detalle.className = "input-group mg-b-10";
                    let input_detalle = document.createElement('INPUT');
                    input_detalle.className = "form-control detalle-categoria-text";
                    input_detalle.type = "text";

                    let span_checkbox = document.createElement('SPAN');
                    span_checkbox.className = "input-group-addon bg-transparent";

                    let label_checkbox = document.createElement('LABEL');
                    label_checkbox.className = "ckbox wd-16 ckbox-danger";



                    let input_checkbox_detalle = document.createElement('INPUT');
                    input_checkbox_detalle.type = "checkbox";
                    let span = document.createElement('SPAN');


                    detalles_categoria.appendChild(div_detalle);
                    div_detalle.appendChild(input_detalle);
                    div_detalle.appendChild(span_checkbox);
                    span_checkbox.appendChild(label_checkbox);
                    label_checkbox.appendChild(input_checkbox_detalle);
                    label_checkbox.appendChild(span);
                    input_detalle.value = detalle;
                });

                $('#modaldemo3').modal('show')

                $("#update-categoria").show();

                $("#add-categoria").hide();
            }).fail(function (err) {
            }).always(function () {
                $("#form-categoria").waitMe('hide');
            });

        });

    });
    btn_action_categoria.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let action = $(btn).data('action');
            let categoria = $(btn).data('idcate');

            if (categoria != null) {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cambia el estado!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: urlLocation + "?ruta=Categorias/EstadoCategoria",
                            data: { idcategoria: categoria, action: action },
                            beforeSend: function () {
                                $("#form-categoria").waitMe();
                            }
                        }).done(function (res) {
                            if (res.status == "201") {
                                Swal.fire(
                                    res.data.action,
                                    res.msg,
                                    'success'
                                )
                            } else if (res.status == "400") {
                                Swal.fire(
                                    res.data.action,
                                    res.msg,
                                    'error'
                                )
                            }

                        }).fail(function (err) {

                        }).always(function () {
                            $("#form-categoria").waitMe('hide');
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
        Swal.fire(
            'Algo salio mal!',
            'No hay detalles para eliminar',
            'error'
        )
    }
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            let div_padre = checkbox.parentNode.parentNode.parentNode;
            div_padre.parentNode.removeChild(div_padre);
        }
    });
}

async function buscar_categorias() {
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