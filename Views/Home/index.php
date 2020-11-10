<div class="dark-background section-container">
  <div class="container-fluid index-carousel-ads py-3">
    <div class="container">
      <div id="carousel-ads" class="carousel slide carousel-ads" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-ads" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-ads" data-slide-to="1"></li>
          <li data-target="#carousel-ads" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h1>Anuncio 1</h1>
          </div>
          <div class="carousel-item">
            <h1>Anuncio 2</h1>
          </div>
          <div class="carousel-item">
            <h1>Anuncio 3</h1>
          </div>
        </div>
        <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div class="container-fluid index-listings py-3">
    <div class="container">
      <h3 class="mb-3">Últimos estrenos</h3>
      <div class="row listings"></div>
      <?php if(!empty($movies)) { ?>
        <?php foreach($movies as $movie) { ?>
          <div class="col-6 col-md-3 mx-auto">
            <div class="card card-movie">
              <img class="card-img-top"
                src="<?php echo $movie->getImage(); ?>"
                alt="<?php echo IMG_PATH . '/movie-image.png'; ?>"
                onerror="this.onerror=null;this.src=this.alt;">
              <div class="card-body">
                <h5 class="card-title mt-0">
                  <?php echo $movie->getName(); ?>
                </h5>
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