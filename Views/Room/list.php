<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-9">
        <h2 class="m-0">Administración de salas de cine: <?php echo $theater->getName(); ?></h2>
      </div>

      <form class="col-md-3 text-right position-relative" action="<?php echo FRONT_ROOT . '/Room/ShowAddView'; ?>" method="post">
        <input type="hidden" name="theater_id" value="<?php echo $theater->getId(); ?>">
        <button type="submit" class="btn btn-sm btn-success">Agregar</button>
      </form>


    </div>

    <div class="table-container">
      <table id="rooms-list" class="w-100">
        <thead>
          <th>Nombre</th>
          <th>Capacidad</th>
          <th>Estado</th>
          <th class="text-right">Acciones</th>
        </thead>
        <tbody>

          <?php
          foreach ($rooms as $room) {
          ?>

            <tr class="">
              <td><?php echo $room->getName(); ?></td>
              <td><?php echo $room->getSeats(); ?></td>
              <td><?php echo $room->getState() ? "Habilitado" : "Deshabilitado"; ?></td>
              <td class="text-right">
                <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Function/ShowAddView'; ?>" method="post">
                  <input type="hidden" name="theater_room_id" value=<?php echo $room->getId(); ?>>
                  <button type="submit" class="btn btn-sm btn-success">Agregar función</button>
                </form>

                <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Room/ShowEditView'; ?>" method="post">
                  <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                  <input type="hidden" name="room_id" value=<?php echo $room->getId(); ?>>
                  <button type="submit" class="btn btn-sm btn-dark">Editar</button>
                </form>

                <?php if ($room->getState()) { ?>
                  <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Room/Desactivate'; ?>" method="post">
                    <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                    <input type="hidden" name="room_id" value=<?php echo $room->getId(); ?>>
                    <button type="submit" class="btn btn-sm btn-danger">Deshabilitar</button>
                  </form>
                <?php } else { ?>
                  <form class="d-inline-block" action="<?php echo FRONT_ROOT . '/Room/Activate'; ?>" method="post">
                    <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                    <input type="hidden" name="room_id" value=<?php echo $room->getId(); ?>>
                    <button type="submit" class="btn btn-sm btn-success">Activar</button>
                  </form>
                <?php } ?>

              </td>
            </tr>
          <?php
          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#rooms-list').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });
  });
</script>