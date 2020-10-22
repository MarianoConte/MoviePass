<?php
require_once('nav.php');
?>
<main class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mx-auto">

        <h2 class="text-white mb-4">Buscar Pelicula</h2>

        <?php
        if ($error) {
          echo '
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  No hay resultados para esa búsqueda.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
               </div>
          ';
        }
        ?>

        <form action="<?php echo FRONT_ROOT ?>Movie/Search" method="post" class="bg-light-alpha">

          <div class="form-group p-4 mb-0">
            <label class="text-white" for="">Nombre</label>
            <input type="text" name="nombre" placeholder="The Avengers" class="form-control">

            <label class="text-white" for="genre">Genero:</label>
            <select class="form-control" name="genre" id="genre">
              <?php
              foreach ($genres as $genre) {
                echo '<option value="' . $genre->id . '">' . $genre->name . '</option>';
              }
              ?>
            </select>
          </div>


          <button type="submit" name="button" class="btn btn-secondary index-search-btn w-100">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</main>