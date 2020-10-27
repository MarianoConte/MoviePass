<div class="container-fluid dark-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Iniciar sesión</h1>
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
        <form action="<?php echo FRONT_ROOT ?>/User/Login" method="POST">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Ingrese su email">
            <small id="emailHelp" class="form-text text-muted">Utilizado para iniciar sesión.</small>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese una contraseña">
          </div>

          <button type="submit" class="btn btn-dark w-100">Confirmar</button>

          <p class="text-muted text-center mb-0 mt-4">¿Aún no te registraste? <a href="<?php echo FRONT_ROOT ?>/User/ShowAddView">Registrarse</a></p>
        </form>
      </div>
    </div>
  </div>
</div>