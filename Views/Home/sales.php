<?php

/* formulario de filtrado de ventas por:
        -pelicula
        -cine
  */


?>

<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Ventas</h1>
        <hr>

        <form action="<?php echo FRONT_ROOT ?>/Home/SearchSales" method="POST" id="searchForm">
          <div class="form-group">
            <label for="cine">Cine</label>
            <select type="text" name="theater" class="form-control" id="theatersSelect">
              <option value="">Todos</option>
              <?php foreach ($theaters as $theater) { ?>
                <option value="<?php echo $theater->getId() ?>"><?php echo $theater->getName() ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="movie">Pelicula</label>
            <select class="form-control" name="movie" id="moviesSelect">
              <option value="">Todos</option>
              <?php foreach ($movies as $movie) { ?>
                <option value="<?php echo $movie->getId() ?>"><?php echo $movie->getName() ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="dateFrom">Fecha desde</label>
            <input type="date" name="dateFrom" class="form-control" id="dateFrom">
          </div>
          <div class="form-group">
            <label for="dateTo">Fecha hasta</label>
            <input type="date" name="dateTo" class="form-control" id="dateTo">
          </div>
          <button type="submit" id="submitButton" class="btn btn-dark w-100 mt-2">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#dateFrom').change(function() {
    $('#dateTo').attr('min', $(this).val());
  });

  $('#dateTo').change(function() {
    $('#dateFrom').attr('max', $(this).val());
  });
</script>