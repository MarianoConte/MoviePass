<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-9">
        <h2 class="m-0">Administración de películas</h2>
      </div>
      <div class="col-md-3 text-right position-relative">
        <a class="btn btn-success btn-add" href="<?php echo FRONT_ROOT . '/Movie/ShowSearchView'; ?>">Agregar</a>
      </div>
    </div>

    <div class="table-container">
      <table id="theaters-list" class="w-100">
        <thead>
          <th>Nombre</th>
          <th>Género</th>
          <th>Duración</th>
        </thead>
        <tbody>
          <?php foreach ($movies as $movie) { ?>
            <tr>
              <td><?php echo $movie->getName(); ?></td>
              <td><?php echo $movie->getGenre(); ?></td>
              <td><?php echo $movie->getDuration(); ?> minutos</td>
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