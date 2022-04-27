const carro = new Carrito();
//const carrito = document.getElementById("carrito");
//const productos = document.getElementById("lista-productos");
const listaProductos = document.querySelector("#lista-carrito tbody");


cargarEventos();

function cargarEventos() {
	/*
	let CantP;
      //Comprobar si hay algo en LS
      if(localStorage.getItem('cantP') == null){
          CantP = 0;
      }
      else {
          CantP = localStorage.getItem('cantP');
          $('#carrito-cant').html("" + CantP);
    }*/
	//Se ejecuta cuando se presionar agregar carrito
	$('.lista-productos').click( function(e){
		carro.comprarProducto(e);
		//var nFilas = $("#lista-carrito tr").length - 1;
		//localStorage.setItem('cantP', nFilas);
		//$('#carrito-cant').html("" + nFilas);

	});

	//Cuando se elimina productos del carrito
	$('#carrito').click( function(e){
		carro.eliminarProducto(e);
		/*var nFilas = $("#lista-carrito tr").length;
		nFilas-=1;
		localStorage.setItem('cantP', nFilas);
		$('#carrito-cant').html("" + nFilas);*/
	});

	//Al vaciar carrito
	$('#vaciar-carrito').click( function(e){
		carro.vaciarCarrito(e);		
		$('#carrito-cant').html("" + 0);
	});

	//Al cargar documento se muestra lo almacenado en LS
	$(document).ready(function() {
		carro.leerLocalStorage();
		//fetchProductos();
	});

	//Enviar pedido a otra pagina
	$('#procesar-pedido').click( function(e){
		carro.procesarPedido(e);
	});
}