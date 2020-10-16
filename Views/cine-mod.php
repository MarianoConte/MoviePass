<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificar cine</h2>
               <form action="<?php echo FRONT_ROOT ?>Cine/Mod" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Nombre</label>
                                   <input type="text" name="nombre" value="<?php echo $cine->getNombre()?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Direccion</label>
                                   <input type="text" name="direccion" value="<?php echo $cine->getDireccion()?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Cantidad de salas</label>
                                   <input type="number" name="salas" value="<?php echo $cine->getSalas()?>" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Valor de entrada</label>
                                   <input type="number" name="valorEntrada" value="<?php echo $cine->getValorEntrada()?>" class="form-control">
                              </div>
                         </div>

                         <input type="hidden" name="id" value=<?php echo $cine->getId()?>>

                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Estado</label>
                                   <input type="checkbox" name="state" <?php echo ($cine->getState())?("checked"):"";?>>
                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Modificar</button>
               </form>
          </div>
     </section>
</main>