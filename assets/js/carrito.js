class Carrito {

    actualiza_precio_carrito(precio, ope){
        if(ope=='agregar'){
            $('.pay-title-text-price').html(nFilas);
        }else if (ope=='eliminar'){
            $('.pay-title-text-price').html(nFilas);
        }
    }


    //Añadir producto al carrito
    comprarProducto(e) {

        //Para agregar al carrito
        if ($(e.target).hasClass('agregar-carrito')) {
            const producto = e.target.parentElement.parentElement.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            this.leerDatosProducto(producto);
            //console.log(producto);
            
            this.calcularTotalCarrito();
            //animacion carrito
            $(".aside-cart").addClass("aside-cart--active");
            setTimeout(function () {
                $(".aside-cart").removeClass("aside-cart--active");
            }, 3000);

        }
    }

    //Leer datos del producto

    leerDatosProducto(producto) {
        const infoProducto = {
            imagen: producto.querySelector('#FotoP').src,
            titulo: producto.querySelector('#Titulo').textContent,
            precio: producto.querySelector('#Precio span').textContent,
            id: producto.querySelector('#btnid').getAttribute('data-id'),
            cantidad: 1
        }
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (productoLS) {
            if (productoLS.id === infoProducto.id) {
                productosLS = productoLS.id;
            }
        });

        if (productosLS === infoProducto.id) {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'El producto ya se encuentra registrado',
                showConfirmButton: false,
                timer: 1000
            })
        }
        else {
            this.insertarCarrito(infoProducto);
            //console.log(infoProducto);
        }

    }


    //muestra producto seleccionado en carrito
    insertarCarrito(producto) {
        const row = document.createElement('tr');
        row.innerHTML = `
        <a href="#" class="text-decoration-none text-dark">
                        <div class="aside-body p-3 border-bottom">
                            <div class="pay-product">
                                <div class="img-product d-flex">
                                    <img src="${producto.imagen}" alt="">
                                    <div class="content-product d-flex flex-column ms-3">
                                        <p class="name-product mb-1">${producto.titulo}</p>
                                        <span class="units-product">Unidades: ${producto.cantidad}</span>
                                        <span class="price-product">S/.<strong>${producto.precio}</strong></span>
                                    </div>
                                    <i class="uil uil-multiply borrar-producto" id="btn-delete-product-cart" data-id="${producto.id}"></i>
                                </div>
                            </div>
                        </div>
                    </a>
        `;
        listaProductos.appendChild(row);
        this.guardarProductosLocalStorage(producto);
    }

    //Eliminar el producto del carrito en el DOM
    eliminarProducto(e) {
        e.preventDefault();
        let producto, productoID;
        if ($(e.target).hasClass('borrar-producto')) {
            e.target.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
            producto = e.target.parentElement.parentElement;
            productoID = producto.querySelector('i').getAttribute('data-id');

            this.eliminarProductoLocalStorage(productoID);
            this.calcularTotalCarrito();
        }

        //this.calcularTotal();


    }
    
        //Elimina todos los productos
        vaciarCarrito(e){
            e.preventDefault();
    
            if(this.obtenerProductosLocalStorage().length === 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El carrito ya se encuentra vacío',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            else {
                while(listaProductos.firstChild){
                listaProductos.removeChild(listaProductos.firstChild);
                }
                this.vaciarLocalStorage();
            }
            
    
            return false;
        }
        /*
        // Eliminar productos de manera superficial
        vaciarCarrito2(e){
            e.preventDefault();
    
                while(listaProductos.firstChild){
                listaProductos.removeChild(listaProductos.firstChild);
                }
            return false;
        }
    */
    //Almacenar en el LS
    guardarProductosLocalStorage(producto) {
        let productos;
        //Toma valor de un arreglo con datos del LS
        productos = this.obtenerProductosLocalStorage();
        //Agregar el producto al carrito
        productos.push(producto);
        //Agregamos al LS
        localStorage.setItem('productos', JSON.stringify(productos));
    }

    //Comprobar que hay elementos en el LS
    obtenerProductosLocalStorage() {
        let productoLS;

        //Comprobar si hay algo en LS
        if (localStorage.getItem('productos') === null) {
            productoLS = [];
        }
        else {
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }

    //Mostrar los productos guardados en el LS
    leerLocalStorage() {
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto) {
            //Construir plantilla
            const row = document.createElement('tr');
            row.innerHTML = `
            <a href="#" class="text-decoration-none text-dark">
                        <div class="aside-body p-3 border-bottom item-from-cart">
                            <div class="pay-product">
                                <div class="img-product d-flex">
                                    <img src="${producto.imagen}" alt="">
                                    <div class="content-product d-flex flex-column ms-3">
                                        <p class="name-product mb-1">${producto.titulo}</p>
                                        <span class="units-product">Unidades: ${producto.cantidad}</span>
                                        <span class="price-product"><strong>S/. ${producto.precio}</strong></span>
                                    </div>
                                    <i class="uil uil-multiply borrar-producto" id="btn-delete-product-cart" data-id="${producto.id}"></i>
                                </div>
                            </div>
                        </div>
                    </a>
            `;
            listaProductos.appendChild(row);
        });
    }
    /*
        //Mostrar los productos guardados en el LS en compra.html
        leerLocalStorageCompra(){
            let productosLS;
            productosLS = this.obtenerProductosLocalStorage();
            productosLS.forEach(function (producto){    
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <img src="${producto.imagen}" width=100>
                    </td>
                    <td>${producto.titulo}</td>
                    <td id='precio'>${producto.precio}</td>
                    <td>
                        <input id='cant' type="number" class="form-control cantidad" min="1" value=${producto.cantidad}>
                    </td>
                    <td id='subtotales'>${producto.precio * producto.cantidad}</td>
                    <td>
                        <a href="#" class="borrar-producto fas fa-times-circle" style="font-size:30px" data-id="${producto.id}"></a>
                    </td>
                `;
                listaCompra.appendChild(row);
            });
        }
    
        //Enviar los productos a la base de datos en php
        
        EnviarLocalStorageCompra(){
            var formdatos = $('#procesar-pago').serialize();
    
            $.ajax({
                  url: 'IngresarPedido.php',
                  type: 'POST',
                  data: formdatos,
                  success:function(r){
                    if(r==1){
                        //alert("Agregado con exito");
                    }
                  }
              });
            
            let productosLS2;
            productosLS2 = this.obtenerProductosLocalStorage();
            productosLS2.forEach(function (producto){    
            
              var id = producto.id
              var precio = producto.precio
              var cantidad = producto.cantidad
              var importe = (precio * cantidad)
              
    
              var datos = {"id":id,"precio":precio,"importe":importe,"cantidad":cantidad};
              //var datos = "id="+id+"&precio="+precio+"&importe="+importe+"&cantidad="+cantidad;
              
              //alert("id: "+id+", precio: "+precio);
              $.ajax({
                  url: 'Dpedido.php',
                  type: 'POST',
                  data: datos,
                  success:function(r){
                    if(r==1){
                        //alert("Agregado con exito");
                    }
                }
            });
            });
        }
    */
    //Eliminar producto por ID del LS
    eliminarProductoLocalStorage(productoID) {
        let productosLS;
        //Obtenemos el arreglo de productos
        productosLS = this.obtenerProductosLocalStorage();
        //Comparar el id del producto borrado con LS
        productosLS.forEach(function (productoLS, index) {
            if (productoLS.id === productoID) {
                productosLS.splice(index, 1);
            }
        });

        //Añadimos el arreglo actual al LS
        localStorage.setItem('productos', JSON.stringify(productosLS));
    }
    
        //Eliminar todos los datos del LS
        vaciarLocalStorage(){
            localStorage.clear();
        }
    /*
        //Procesar pedido
        procesarPedido(e){
            e.preventDefault();
    
            if(this.obtenerProductosLocalStorage().length === 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El carrito está vacío, agrega algún producto',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            else {
                location.href = "compra";
            }
        }
    */
        //Calcular montos
        calcularTotal(){
            let productosLS;
            let total = 0, igv = 0, subtotal = 0;
            productosLS = this.obtenerProductosLocalStorage();
            for(let i = 0; i < productosLS.length; i++){
                let element = Number(productosLS[i].precio * productosLS[i].cantidad);
                total = total + element;
                
            }
            
            igv = parseFloat(total * 0.18).toFixed(2);
            subtotal = parseFloat(total-igv).toFixed(2);
    
            $('#subtotal').val("" + subtotal);
            $('#igv').val("" + igv);
            $('#total').val("" + total.toFixed(2));
        }

        //Calcular montos carritos
        calcularTotalCarrito(){
            let productosLS;
            let total = 0;
            let Cantidad = 0;
            productosLS = this.obtenerProductosLocalStorage();
            for(let i = 0; i < productosLS.length; i++){
                let PreTotal = Number(productosLS[i].precio * productosLS[i].cantidad);
                total = total + PreTotal;
                Cantidad += Number(productosLS[i].cantidad);
                
            }
    
            $('.carrito-unidades').html("" + Cantidad);
            $('.pay-title-text-price').html("S/." + total);
            
        }
    
        obtenerEvento(e){
            let id, cantidad, producto, productosLS;
            if($(e.target).hasClass('cantidad')){
                producto = e.target.parentElement.parentElement;
                id = producto.querySelector('a').getAttribute('data-id');
                cantidad = producto.querySelector('input').value;
                let actualizarMontos = document.querySelectorAll('#subtotales');
                productosLS = this.obtenerProductosLocalStorage();
                productosLS.forEach(function (productoLS, index) {
                    if (productoLS.id === id) {
                        productoLS.cantidad = cantidad;                    
                        actualizarMontos[index].innerHTML = Number(cantidad * productosLS[index].precio).toFixed(2);
                    }    
                });
                localStorage.setItem('productos', JSON.stringify(productosLS));
                
            }
            else {
                console.log("click afuera");
            }
        }
}