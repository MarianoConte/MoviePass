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
                    </thead>
                    <tbody>
                         <?php
                              foreach($cineList as $cine)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cine->getNombre() ?></td>
                                             <td><?php echo $cine->getDireccion() ?></td>
                                             <td><?php echo $cine->getSalas() ?></td>
                                             <td><?php echo "$ " . $cine->getValorEntrada() ?></td>
                                             <td><?php echo $cine->getState()?></td>
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