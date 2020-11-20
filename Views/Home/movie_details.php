<div class="dark-background section-container">
  <div class="container-fluid movie-details py-3">
    <div class="container table">
      <div class="row">
        <div class="col-md-3 movie-details-image">
          <img src="<?php echo $movie->getImage(); ?>" alt="">
        </div>
        <div class="col-md-9 movie-details-data">
          <h1 class="movie-details-data-title">
            <strong><?php echo $movie->getName(); ?></strong>
          </h1>
          <p class="movie-details-data-desc">
            <?php echo $movie->getDescription(); ?>
          </p>
          <p class="movie-details-data-desc">
            Género: <?php echo $movie->getGenre(); ?>.
          </p>
          <p class="movie-details-data-desc">
            Duración: <?php echo $movie->getDuration(); ?> minútos.
          </p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12 movie-details-shows">
          <h2 class="text-center">Proximas funciones</h2>
          <hr>
          <div class="row px-2 pb-2">
            <?php foreach($shows as $show) { ?>
              <div class="col-md-6 p-2 mx-auto">
                <div class="movie-details-show">
                  <div class="row">
                    <div class="col-md-9 py-2 px-4">
                      <h3 class="movie-details-show-theater">
                        Cine: <?php echo $show->getTheater()->getName(); ?>
                      </h3>
                      <h5 class="movie-details-show-desc">
                        Fecha y horario: <?php echo date("d/m/Y H:i", strtotime($show->getDate())); ?>
                      </h5>
                      <h5 class="movie-details-show-desc">
                        Dirección: <?php echo $show->getTheater()->getAddress(); ?>
                      </h5>
                      <h5 class="movie-details-show-desc">
                        Sala: <?php echo $show->getRoom()->getName(); ?>
                      </h5>
                      <h5 class="movie-details-show-desc">
                        Asientos: <?php echo $show->getRoom()->getSeats (); ?>
                      </h5>
                    </div>
                    <div class="col-md-3 movie-details-show-buy" onclick="document.getElementById('form-show-<?php echo $show->getId() ?>').submit()">
                      <div class="movie-details-show-buy-text text-center">
                        <form action="<?php echo FRONT_ROOT ?>/Home/ShowBuyTickets" method="POST" id="form-show-<?php echo $show->getId() ?>">
                          <input type="hidden" name="show_id" value="<?php echo $show->getId() ?>">
                        </form>
                        Reservar<br>asiento
                        <hr class="my-2">
                        <span>$<?php echo $show->getPrice(); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>