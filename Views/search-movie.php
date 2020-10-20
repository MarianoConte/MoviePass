<?php
    require_once('nav.php');
?>
<main class="py-5">
          <div class="container">
               <h2 class="mb-4">Buscar Pelicula</h2>
               <form action="<?php echo FRONT_ROOT ?>Movie/Search" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre" value="" class="form-control">
                              </div>
                         </div>
                         
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Buscar</button>
               </form>
          </div>
</main>