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

btn_delete_product_cart.forEach( btn =>{
    btn.addEventListener('click', (e) =>{
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
