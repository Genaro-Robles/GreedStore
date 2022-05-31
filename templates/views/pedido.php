
<div class="container">
            <div class="row mt-3">
                <div class="col">
                    <h2 class="d-flex justify-content-center mb-3">Realizar Compra</h2>
                    <form id="procesar-pago" method="POST" action="">
                        <div class="form-group row my-3">
                            <label for="cliente" class="col-12 col-md-2 col-form-label h2">Cliente :</label>
                            <div class="col-12 col-md-10">
                                <input type="text" class="form-control" id="cliente"
                                    placeholder="Ingresa nombre cliente" name="cliente" readonly value="<?php echo (!isset($perfil["nombre"])) ? "" : $perfil["nombre"] ?>">
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="email" class="col-12 col-md-2 col-form-label h2">Correo :</label>
                            <div class="col-12 col-md-10">
                                <input type="text" class="form-control" id="correo" placeholder="Ingresa tu correo" name="correo" readonly value="<?php echo (!isset($perfil["correo"])) ? "" : $perfil["correo"] ?>">
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="input" class="col-12 col-md-2 col-form-label h2">Fecha de Entrega:</label>
                            <div class="col-12 col-md-10">
                                <input type="date" class="form-control-sm" id="FechaE" name="FechaE">
                            </div>
                        </div>

                        <div id="carrito-tabla" class="form-group table-responsive" >
                            <table class="form-group table" id="lista-compra" >
                                <thead>
                                    <tr>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>

                                </thead>
                                <tbody >

                                </tbody>
                                <tr>
                                    <th colspan="4" scope="col" class="text-end">SUB TOTAL (S/.): </th>
                                    <th scope="col">
                                        <input id="subtotal" name="subtotal" class="border-0 fw-bold" readonly style="background-color: white;"></input>                                    
                                    </th>
                                    
                                </tr>
                                <tr>
                                    <th colspan="4" scope="col" class="text-end">IGV (S/.): </th>
                                    <th scope="col">
                                        <input id="igv" name="igv" class="border-0 fw-bold" readonly style="background-color: white;"></input>
                                    </th>
                                    
                                </tr>
                                <tr>
                                    <th colspan="4" scope="col" class="text-end">TOTAL (S/.): </th>
                                    <th scope="col">
                                        <input id="total" name="total" class="border-0 fw-bold" readonly style="background-color: white;"></input>
                                    </th>
                                    
                                </tr>

                            </table>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="index" class="btn btn-info btn-block">Seguir comprando</a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <input type="submit" class="btn btn-success btn-block" id="procesar-compra" value="Realizar compra">
                            </div>
                        </div>
                    </form>


                </div>


            </div>

        </div>