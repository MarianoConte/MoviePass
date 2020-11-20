<div class="dark-background section-container">

  <div class="container-fluid index-listings py-3">
    <div class="container">
      <div class="row listings">
        <?php if (!empty($movies)) { ?>
          <?php foreach ($movies as $movie) { ?>


            <form action="<?php echo FRONT_ROOT ?>/Home/ShowMovieDetails" method="POST" id="form-movie-<?php echo $movie->getId() ?>">
              <input type="hidden" name="movie_id" value="<?php echo $movie->getId() ?>">
            </form>
            <div class="container-fluid movie-details py-3" onclick="document.getElementById('form-movie-<?php echo $movie->getId() ?>').submit()">
              <div class="container table-btn py-3">
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
              </div>
            </div>




          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            Sin estrenos en cartelera.
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>