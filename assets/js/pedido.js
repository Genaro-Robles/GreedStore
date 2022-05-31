const carro = new Carrito();
//const carrito = document.getElementById("carrito");
//const productos = document.getElementById("lista-productos");
const listaProductos = document.querySelector("#lista-carrito tbody");


cargarEventos();

function cargarEventos() {

	//Se ejecuta cuando se presionar agregar carrito
	$('.lista-productos').click(function (e) {
		carro.comprarProducto(e);

	});

	//Cuando se elimina productos del carrito
	$('#carrito').click(function (e) {
		carro.eliminarProducto(e);
		carro.vaciarCompra2(e);
		carro.leerLocalStorageCompra();
	});

	//Al vaciar carrito
	$('.btn-trash').click(function (e) {
		carro.vaciarCarrito(e);
		carro.calcularTotalCarrito();
	});

	//Al cargar documento se muestra lo almacenado en LS
	$(document).ready(function () {
		carro.leerLocalStorage();
		carro.calcularTotalCarrito();
		//fetchProductos();
	});

	//Enviar pedido a otra pagina
	$('.btn-pay').click(function (e) {
		carro.procesarPedido(e);
	});
}