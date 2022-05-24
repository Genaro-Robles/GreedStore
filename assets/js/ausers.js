$(document).ready(function () {
    init_search_usuarios();
});
var  urlLocation= 'http://localhost/GreedStore/'

async function init_search_usuarios(){
    await buscar_usuarios();
    let btn_view = document.querySelectorAll('.btn-view');
    btn_view.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            let usuario  = e.target.dataset.iduser;
            $.ajax({
                type: "POST",
                url: urlLocation + "?ruta=Productos/ListarUsuario",
                data: { usuario },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#nombre").val(data.nombre_apellido);
                    $("#email").val(data.correo);
                    $("#id").val(data.id);
                    $("#metodo").val(data.metodo)
                    $(`#roles option[value=${data.id_rol}]`).attr("selected", true);
                    $("#estado").text((data.estado) ? 'Activo' : 'Baneado');
                    $("#estado").addClass((data.estado) ? 'bg-success' : 'bg-danger');
                }
            }).then(function () {
                $('#exampleModal').modal('show')
            })
            
        });
    });
}

$("#filtroProd").change(function (e) {
    buscar_usuarios();
    //alert ($("#filtroProd option:selected").text());
});
$("#busquedaProd").keyup(function (e) {
    buscar_usuarios();
    //alert($("#busquedaProd").val());
});

async function buscar_usuarios() {
    nom = $("#busquedaProd").val();
    await $.ajax({
        type: "POST",
        url: urlLocation + "?ruta=Productos/ListarUsuarios",
        dataType: "html",
        success: function (response) {
            $("#tabla-usuarios").html(response);
        }
    });

}