const compra = new Carrito();

const listaCompra = document.querySelector("#lista-compra tbody");

//const carrito = document.getElementById('carrito');
//const procesarCompraBtn = document.getElementById('procesar-compra');

cargarEventosCompra();

function cargarEventosCompra() {

    $(document).ready(function() {
        if(window.location.href == urlLocation+"pedido"){
        compra.leerLocalStorageCompra();
        }
        
    });

    //Cuando se elimina productos del carrito
    $('#carrito-tabla').click( function(e){
        compra.eliminarProducto(e);
        compra.vaciarCarrito2(e);
        compra.leerLocalStorage();
    });

    
    $('#procesar-compra').click( function(e){
        procesarCompra(e);
        
    });

    compra.calcularTotal();

    //cuando se selecciona procesar Compra

    $("#carrito-tabla").keyup(function(e) {
      
        compra.obtenerEvento(e);
        compra.calcularTotal();
        compra.calcularTotalCarrito();
    });

    $("#carrito-tabla").change(function(e) {
      
      compra.obtenerEvento(e);
      compra.calcularTotal();
      compra.calcularTotalCarrito();
    });
}



function procesarCompra(e) {
    e.preventDefault();
    if (compra.obtenerProductosLocalStorage().length === 0) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No hay productos, selecciona alguno',
            showConfirmButton: false,
            timer: 2000
        }).then(function () {
            window.location.href = urlLocation;
        })
    }
    else if ($('#cliente').val() == '') {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe iniciar sesion para proseguir con la compra',
            showConfirmButton: false,
            timer: 2000
        })
    }
    else if ($('#FechaE').val() == '') {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe Ingresar la Fecha de entrega',
            showConfirmButton: false,
            timer: 2000
        })
    }
    else {
        e.preventDefault();
        Swal.fire({
          title: '¿CONFIRMAR COMPRA?',
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Comprar',
          denyButtonText: `Cancelar`,
        }).then((result) => {
          if (result.isConfirmed) {
            compra.EnviarLocalStorageCompra();
          } else if (result.isDenied) {
            Swal.fire('Compra cancelada', '', 'info')
          }
        })
    }
}
