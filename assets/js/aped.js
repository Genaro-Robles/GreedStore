$(document).ready(function () {
    init_search_pedidos();
});

async function init_search_pedidos() {
    await buscar_pedidos();
    let btn_view_pedido = document.querySelectorAll('.btn-view-pedido');
    let btn_action_pedido = document.querySelectorAll('.btn-action-pedido');

    btn_view_pedido.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let idpedido = $(btn).data('idped');

            $("#form-pedido")[0].reset();

            $.ajax({
                type: "POST",
                url: urlLocation + "?ruta=Pedidos/ListarPedidoDetallesTabla",
                dataType: "html",
                data: { idpedido },
                success: function (response) {
                    $("#exampleModalToggleLabel").html("Detalles del pedido Nº " + idpedido);
                    $("#form-pedido").html(response);
                    $('#modaldemo3').modal('show');
                }
            });
        

        });
    });
    btn_action_pedido.forEach(function (btn) {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            let action = $(btn).data('action');
            let idpedido = $(btn).data('idped');

            if (idpedido != null || idpedido != undefined ) {

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
                            url: urlLocation + "?ruta=Pedidos/EstadoPedido",
                            data: { idpedido, action },
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
                            init_search_pedidos();
                        });
                    }
                })
            }

        });

    });
}


async function buscar_pedidos() {
    await $.ajax({
        type: "POST",
        url: urlLocation + "?ruta=Pedidos/ListarPedidosTabla",
        dataType: "html",
        success: function (response) {
            $("#tabla-pedidos").html(response);
        }
    });

}