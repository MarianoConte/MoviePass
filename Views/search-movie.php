<?php
    require_once('nav.php');
?>
<main class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <h2 class="text-white mb-4">Buscar Pelicula</h2>
        <form action="<?php echo FRONT_ROOT ?>Movie/Search" method="post" class="bg-light-alpha">
          <div class="form-group p-4 mb-0">
            <label class="text-white" for="">Nombre</label>
            <input type="text" name="nombre" placeholder="The Avengers" class="form-control">
          </div>
          <button type="submit" name="button" class="btn btn-secondary index-search-btn w-100">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</main>