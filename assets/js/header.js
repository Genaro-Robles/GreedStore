'use strict';

// Language: javascript
// Path: assets\js\index.js

const btn_category = document.querySelector('#btn-category');
const btn_navbar_toggler = document.querySelector('button.navbar-toggler');
const menu = document.querySelector('.categories');
const aside_cart = document.querySelector('.aside-cart');
const close_cart = document.querySelector('.close--cart');
const btn_cart = document.querySelector('#btn-cart');
const btn_delete_product_cart = document.querySelectorAll('#btn-delete-product-cart');
const urlLocation = "http://localhost/GreedStore/";
const uploads = "assets/uploads/";
const modal_usuario_update = document.querySelector('#modal-usuario-update');
const img_avatar = document.querySelector('#img-avatar');
const user_id = document.getElementsByName('user')[0].getAttribute('content');
const perfil = document.querySelector('#perfil');
const update_usuario_perfil = document.querySelector('#update-usuario-perfil');

img_avatar.addEventListener('click', () => perfil.click());
perfil.addEventListener('change', (e) => {
    e.preventDefault();

    const data = new FormData($("#form-usuario-update-perfil").get(0));
    data.append("id", user_id);

    $.ajax({
        type: "POST",
        url: urlLocation + "?ruta=Usuarios/ActualizarUsuarioFotoPerfil",
        dataType: "JSON",
        contentType: false,
        cache: false,
        processData: false,
        data: data,
        beforeSend: function () {
            $("#form-usuario-update-perfil").waitMe();
        }
    }).done(function (res) {
        let data = res.data;
        $("#img-avatar").attr("src", urlLocation + uploads + data.perfil);
        $("#img-circle").attr("src", urlLocation + uploads + data.perfil);

    }).fail(function (err) {

    }).always(function () {
        setTimeout(() => {
            $("#form-usuario-update-perfil").waitMe('hide');
        }, 1000);
    });

});
update_usuario_perfil.addEventListener('click', (e) => {
    e.preventDefault();
    if ($("#nombre_apellido").val().trim().length == 0 || $("#correo").val().trim().length == 0) {
        Swal.fire(
            'Algo salio mal!',
            'Comprueba que todos los campos esten rellenos',
            'warning'
        )
    } else {
        const data = new FormData($("#form-usuario-update").get(0));
        data.append("id", user_id);
        $.ajax({
            type: "POST",
            url: urlLocation + "?ruta=Usuarios/ActualizarUsuarioPerfil",
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            beforeSend: function () {
                $(".modal-body").waitMe();
            }
        }).done(function (res) {
            let data = res.data;
            $("#dropdownMenuLink").html(`<img src='${urlLocation + uploads + data.perfil}' alt='mdo' width='32' height='32' class='rounded-circle' id='img-circle'> ${data.nombre_apellido}`);
        }).fail(function (err) {

        }).always(function () {
            setTimeout(() => {
                $(".modal-body").waitMe('hide');
            }, 1000);
            setTimeout(() => {
                $("#staticBackdrop").modal('hide');
            }, 1000);
        });
    }

})
modal_usuario_update.addEventListener('click', (e) => {
    e.preventDefault();

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: urlLocation + "?ruta=Usuarios/ListarUsuario",
        data: { usuario: user_id },
        beforeSend: function () {
            $("#staticBackdrop").modal('show');
            $("#staticBackdrop").waitMe();
        }
    }).done(function (res) {
        $("#nombre_apellido").val(res.nombre_apellido);
        $("#correo").val(res.correo);
        (res.celular == null || res.celular == "") ? $("#celular").val("") : $("#celular").val(res.celular);
        (res.direccion == null || res.direccion == "") ? $("#direccion").val("") : $("#direccion").val(res.direccion);
        (res.dni == null || res.dni == "") ? $("#dni").val("") : $("#dni").val(res.dni);
        (res.edad == null || res.edad == "") ? $("#edad").val("") : $("#edad").val(res.edad);
        $("#img-avatar").attr("src", urlLocation + uploads + res.perfil);
        $("#perfil_anterior").val(res.perfil);

    }).fail(function (err) {

    }).always(function () {
        $("#staticBackdrop").waitMe('hide');
    });
});

btn_delete_product_cart.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        alert("Eliminado del carrito");
    });
})
close_cart.addEventListener('click', () => aside_cart.classList.toggle('aside-cart--active'));

btn_cart.addEventListener('click', (e) => {
    e.preventDefault();
    aside_cart.classList.toggle('aside-cart--active')
})

const menuToggle = () => menu.classList.toggle('menu--active');

btn_category.addEventListener('click', e => {
    e.preventDefault();
    menuToggle();
});


btn_navbar_toggler.addEventListener('click', () => menu.classList.remove('menu--active'));
