$(document).ready(function () {
    init_search_usuarios();

    let update_usuario = document.querySelector('#update-usuario');
    let select = document.getElementById('cborol');

    if (update_usuario) {

        update_usuario.addEventListener('click', function (e) {

            e.preventDefault();


            if (select.selectedIndex == 0 || $("#idusuario").val().trim().length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Error en el formulario',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {
                const data = new FormData($("#form-usuario").get(0));

                $.ajax({
                    type: "POST",
                    url: urlLocation + "?ruta=Usuarios/ActualizarUsuario",
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: data,
                    beforeSend: function () {
                        $("#form-usuario").waitMe();
                    }
                }).done(function (res) {
                    if (res.status == "201") {
                        Swal.fire(
                            'Actualizado!',
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
                    $("#form-usuario")[0].reset();
                    $('#modaldemo3').modal('hide');
                }).fail(function (err) {

                }).always(function () {
                    $("#form-usuario").waitMe('hide');
                    init_search_usuarios();
                });
            }
        })
    }
});
var urlLocation = 'http://localhost/GreedStore/'

async function init_search_usuarios() {
    await buscar_usuarios();

    let btn_view = document.querySelectorAll('.btn-view');

    let btn_action_user = document.querySelectorAll('.btn-action-user');

    btn_action_user.forEach(function (btn) {
        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let action = $(btn).data('action');
            let usuario = $(btn).data('iduser');

            $("#form-usuario")[0].reset();

            if (usuario != undefined || usuario != null) {

                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Cambia el estado!'

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: urlLocation + "?ruta=Usuarios/EstadoUsuario",
                            data: { action, usuario },
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
                            init_search_usuarios();
                        });
                    }
                })
            }

        });
    });

    btn_view.forEach(function (btn) {
        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let usuario = $(btn).data('iduser');
            $("#form-usuario")[0].reset();

            $.ajax({
                type: "POST",
                url: urlLocation + "?ruta=Productos/ListarUsuario",
                data: { usuario },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#nombre").val(data.nombre_apellido);
                    $("#email").val(data.correo);
                    $("#idusuario").val(data.id);
                    $("#metodo").val(data.metodo)
                    $(`#cborol option[value=${data.id_rol}]`).attr("selected", true);
                    $("#estado").text((data.estado) ? 'Activo' : 'Baneado');
                    $("#estado").addClass((data.estado) ? 'bg-success' : 'bg-danger');
                }
            }).then(function () {
                $('#modaldemo3').modal('show')
            })

        });
    });
}

/* $("#filtroProd").change(function (e) {
    buscar_usuarios();
    //alert ($("#filtroProd option:selected").text());
});
$("#busquedaProd").keyup(function (e) {
    buscar_usuarios();
    //alert($("#busquedaProd").val());
}); */

async function buscar_usuarios() {
    await $.ajax({
        type: "POST",
        url: urlLocation + "?ruta=Productos/ListarUsuarios",
        dataType: "html",
        success: function (response) {
            $("#tabla-usuarios").html(response);
        }
    });

}