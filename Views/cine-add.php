<?php
require_once('nav.php');
?>
<main class="py-5">
  <section id="listado" class="mb-5">
    <div class="container">
      <h2 class="mb-4">Agregar cine</h2>
      <?php
      if ($nameError) {
        echo '
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Cine inválido.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                    ';
        $nameError = null;
      }

      ?>
      <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="post" class="bg-light-alpha p-5">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="">Nombre</label>
              <input type="text" name="nombre" value="" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="">Direccion</label>
              <input type="text" name="direccion" value="" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="">Cantidad de salas</label>
              <input type="number" name="salas" value="" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="">Valor de entrada</label>
              <input type="number" name="valorEntrada" value="" class="form-control">
            </div>
          </div>
        </div>
        <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
      </form>
    </div>
  </section>
</main>