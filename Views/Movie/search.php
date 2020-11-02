<div class="container-fluid dark-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Buscar película</h1>
        <hr>
        <?php foreach($responses as $response) { ?>
          <?php if($response->isSuccess()) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo $response->getMessage(); ?>
            </div>
          <?php } else { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $response->getMessage(); ?>
            </div>
          <?php } ?>
        <?php } ?>
        <form action="<?php echo FRONT_ROOT ?>/Movie/Search" method="POST">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Ingrese el nombre de la película" maxlength="100" required>
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
          <button type="submit" class="btn btn-dark w-100 mt-2">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</div>