<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Registrar cine</h1>
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
        <form action="<?php echo FRONT_ROOT ?>/Theater/Add" method="POST">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Ingrese el nombre" maxlength="100" required>
          </div>
          <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Ingrese la dirección" maxlength="150" required>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="capacity">Capacidad de butacas</label>
                <input type="number" name="capacity" class="form-control" id="capacity" placeholder="Ingrese las butacas" min="0" max="99999999" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="ticket-price">Precio de entrada</label>
                <input type="number" name="ticket_price" class="form-control" id="ticket-price" placeholder="Ingrese el precio de entrada" min="0" max="99999999" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-dark w-100 mt-2">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>