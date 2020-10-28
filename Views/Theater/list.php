<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-9">
        <h2 class="m-0">Administración de cines</h2>
      </div>
      <div class="col-md-3 text-right position-relative">
        <a class="btn btn-success btn-add" href="<?php echo FRONT_ROOT.'/Theater/ShowAddView'; ?>">Agregar</a>
      </div>
    </div>
    
    <div class="table-container">
      <table id="theaters-list" class="w-100">
        <thead>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Estado</th>
          <th class="text-right">Acciones</th>
        </thead>
        <tbody>
          <?php foreach($theaters as $theater) { ?>
            <tr class="<?php if(!$theater->getState()) echo 'disabled-row'; ?>">
              <td><?php echo $theater->getName(); ?></td>
              <td><?php echo $theater->getAddress(); ?></td>
              <td><?php echo $theater->getState() ? "Habilitado" : "Deshabilitado"; ?></td>
              <td class="text-right">
                <form class="d-inline-block" action="<?php echo FRONT_ROOT.'/Theater/ShowEditView'; ?>" method="post">
                  <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                  <button type="submit" class="btn btn-sm btn-dark">Editar</button>
                </form>
                  
                <?php if ($theater->getState()) { ?>
                  <form class="d-inline-block" action="<?php echo FRONT_ROOT.'/Theater/Deactivate'; ?>" method="post">
                    <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                    <button type="submit" class="btn btn-sm btn-danger">Deshabilitar</button>
                  </form>
                <?php } else { ?>
                  <form class="d-inline-block" action="<?php echo FRONT_ROOT.'/Theater/Activate'; ?>" method="post">
                    <input type="hidden" name="theater_id" value=<?php echo $theater->getId(); ?>>
                    <button type="submit" class="btn btn-sm btn-success">Activar</button>
                  </form>
                <?php } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#theaters-list').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      }
    });
  });
</script>