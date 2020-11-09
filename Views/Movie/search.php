<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Agregar película</h1>
        <hr>
        <?php foreach ($responses as $response) { ?>
          <?php if ($response->isSuccess()) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo $response->getMessage(); ?>
            </div>
          <?php } else { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $response->getMessage(); ?>
            </div>
          <?php } ?>
        <?php } ?>
        <form action="<?php echo FRONT_ROOT ?>/Movie/Search" method="POST" id="searchForm">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Ingrese el nombre de la película" maxlength="100">
          </div>
          <div class="form-group">
            <label for="address">Genero</label>
            <select class="form-control" name="genre" id="genre">
              <option value="">Todos</option>
              <?php foreach ($genres as $genre) { ?>
                <option value="<?php echo $genre->id ?>"><?php echo $genre->name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="dateFrom">Año desde</label>
            <input type="number" name="dateFrom" class="form-control" id="dateFrom" placeholder="1900" max="9999" min="1900">
          </div>
          <div class="form-group">
            <label for="dateTo">Año hasta</label>
            <input type="number" name="dateTo" class="form-control" id="dateTo" placeholder="2020" max="9999" min="1900">
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