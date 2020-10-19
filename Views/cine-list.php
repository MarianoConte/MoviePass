<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Direccion</th>
                         <th>Salas</th>
                         <th>Valor de entrada</th>
                         <th>Estado</th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cineList as $cine)
                              {
                                   $status = ($cine->getState()==true)?"Activo":"Inactivo";
                                   ?>
                                        <tr>
                                             <td><?php echo $cine->getNombre() ?></td>
                                             <td><?php echo $cine->getDireccion() ?></td>
                                             <td><?php echo $cine->getSalas() ?></td>
                                             <td><?php echo "$ " . $cine->getValorEntrada() ?></td>
                                             <td><?php echo $status?></td>
                                             <form action="<?php echo FRONT_ROOT ?>Cine/ShowModView" method="post">
                                                  <input type="hidden" name="id" value=<?php echo $cine->getId()?>>
                                                  <td><button type="submit" class="btn btn-dark ml-auto d-block">Modificar</button></td>
                                             </form>
                                             <?php
                                                  if($status=="Activo"){
                                             ?>
                                                  <form action="<?php echo FRONT_ROOT ?>Cine/Delete" method="post">
                                                       <input type="hidden" name="id" value=<?php echo $cine->getId()?>>
                                                       <td><button type="submit" class="btn btn-danger ml-auto d-block">Desactivar</button></td>
                                                  </form>
                                                  <?php }?>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>