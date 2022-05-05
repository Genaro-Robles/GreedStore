$(document).ready(function () {
    buscar_productos();
});

$("#filtroProd").change(function (e) { 
    buscar_productos();    
    //alert ($("#filtroProd option:selected").text());
});
$("#busquedaProd").keyup(function (e) { 
    buscar_productos();
    //alert($("#busquedaProd").val());
});

function buscar_productos(){
    nom=$("#busquedaProd").val();
    ord=$("#filtroProd option:selected").text();
$.ajax({
    type: "POST",
    url: urlLocation+"?ruta=Productos/ListarPor",
    data: {nombre: nom, orden: ord},
    dataType: "html",
    success: function (response) {
        $("#tabla-productos").html(response);
    }
});
}