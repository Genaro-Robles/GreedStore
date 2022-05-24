
$(document).ready(function () {
    var urlLocation = 'http://localhost/GreedStore/'

    init_search_categoria();

    let add_categoria = document.querySelector('#add-categoria');
    let update_categoria = document.querySelector('#update-categoria');

    let abrir_categoria_modal = document.querySelector('#abrir_categoria_modal');

    if (abrir_categoria_modal) {
        abrir_categoria_modal.addEventListener('click', () => {
            $(".modal-title").text("Agregar Categoria")
            $('#exampleModal').modal('show')
            $("#update-categoria").hide();
            $("#add-categoria").show();
        })
    }

    if (add_categoria) {

        add_categoria.addEventListener('click', function (e) {
            e.preventDefault();
            if ($("#form-categoria #nombre").val().trim().length == 0 || $("#form-categoria #descripcion").val().trim().length == 0 || $("#form-categoria #foto")[0].files.length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Complete los campos',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                const data = new FormData($("#form-categoria").get(0));
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
            if ($("#form-categoria #nombre").val().trim().length == 0 || $("#form-categoria #descripcion").val().trim().length == 0 || $("#form-categoria #idcategoria").val().trim().length == 0 || $("#form-categoria #foto_anterior").val().trim().length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Complete los campos',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                const data = new FormData($("#form-categoria").get(0));
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
                $("#form-categoria #nombre").val(res.nombre_categoria);
                $("#form-categoria #descripcion").val(res.descripcion_categoria);
                $("#form-categoria #idcategoria").val(res.idcategoria);
                $("#form-categoria #foto_anterior").val(res.foto_categoria);
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