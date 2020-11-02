<div class="container-fluid dark-background py-4">
  <div class="container">
    <div class="row">
      <?php foreach ($results as $movie) { ?>
        <div class="col-3">
          <div class="card">
            <img class="card-img-top" src="<?php echo 'https://image.tmdb.org/t/p/w500/' . $movie->poster_path; ?>" alt="Sin carátula">
            <div class="card-body">
              <h5 class="card-title mt-0">
                <?php echo $movie->title; ?>
              </h5>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>