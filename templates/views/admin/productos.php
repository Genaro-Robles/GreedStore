<section class="home-section">
  <div class="text">Productos</div>
  <div class="row justify-content-between m-0 pe-5 ps-4 ">
    <div class="col-md-2">
      <div class="form-floating">
        <input type="email" class="form-control" id="busquedaProd" placeholder="name@example.com">
        <label for="busquedaProd">Buscar</label>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-floating">
        <select class="form-select" id="filtroProd" aria-label="Floating label select example">
          <option selected>Sin filtro</option>
          <option value="1">categoria</option>
          <option value="2">precio</option>
          <option value="3">stock</option>
        </select>
        <label for="filtroProd">Ordenar por:</label>
      </div>
    </div>
  </div>
  <div class="content">
    <div id="tabla-productos"></div>
  </div>
</section>