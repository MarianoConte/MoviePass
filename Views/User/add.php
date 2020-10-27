<div class="container-fluid dark-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Registro</h1>
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
        <form action="<?php echo FRONT_ROOT ?>/User/Add" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ingrese su email">
            <small id="emailHelp" class="form-text text-muted">Utilizado para iniciar sesión.</small>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese una contraseña">
          </div>
          <div class="row">
            <div class="col-md-6 pr-1">
              <div class="form-group">
                <label for="first-name">Nombre</label>
                <input type="text" name="first_name" class="form-control" id="first-name" placeholder="Ingrese su nombre">
              </div>
            </div>
            <div class="col-md-6 pl-1">
              <div class="form-group">
                <label for="last-name">Apellido</label>
                <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Ingrese su apellido">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-dark w-100">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>