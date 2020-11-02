<div class="container-fluid white-background section-container py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-9 form-container mx-auto">
        <h1>Editar sala: <?php echo $room->getTheater()->getName();?> - <?php echo $room->getName();?></h1>
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
        <form action="<?php echo FRONT_ROOT ?>/Room/Edit" method="POST">
          <input type="hidden" name="theater_id" id="theater_id" value="<?php echo $room->getTheater()->getId();?>">
          <input type="hidden" name="room_id" id="room_id" value="<?php echo $room->getId();?>">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo $room->getName();?>" maxlength="100" required>
          </div>

          <div class="form-group">
            <label for="address">Cantidad de lugares</label>
            <input type="number" name="seats" class="form-control" id="seats" value="<?php echo $room->getSeats();?>" maxlength="150" required>
          </div>

          <button type="submit" class="btn btn-dark w-100 mt-2">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>