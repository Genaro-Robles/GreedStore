const carro = new Carrito();
//const carrito = document.getElementById("carrito");
//const productos = document.getElementById("lista-productos");
const listaProductos = document.querySelector("#lista-carrito tbody");


cargarEventos();

function cargarEventos() {

	let CantP;
	//Comprobar si hay algo en LS
	if (localStorage.getItem('cantP') == null) {
		CantP = 0;
	}
	else {
		CantP = localStorage.getItem('cantP');
		$('.carrito-unidades').html("" + CantP);
	}
	//Se ejecuta cuando se presionar agregar carrito
	$('.lista-productos').click(function (e) {
		carro.comprarProducto(e);

	});

	//Cuando se elimina productos del carrito
	$('#carrito').click(function (e) {
		carro.eliminarProducto(e);
	});

	//Al vaciar carrito
	$('#vaciar-carrito').click(function (e) {
		carro.vaciarCarrito(e);
		$('.carrito-unidades').html("" + 0);
	});

	//Al cargar documento se muestra lo almacenado en LS
	$(document).ready(function () {
		carro.leerLocalStorage();
		//fetchProductos();
	});

	//Enviar pedido a otra pagina
	$('#procesar-pedido').click(function (e) {
		carro.procesarPedido(e);
	});
}