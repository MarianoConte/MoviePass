<?php
require_once('nav.php');
echo '<div class="m-3 row">';
foreach($results as $movie){
  echo '<div class="col-2 mb-3 mt-3">';
  echo '<div class="card bg-dark">';
  echo '<img class="img-fluid card-img-top" src="https://image.tmdb.org/t/p/w500/'.$movie->poster_path.'" alt="No hay imagen">';
  echo '<div class="card-body">';
  echo '<h5 class ="card-title text-light"/>'.$movie->title.'</h5>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}
echo '</div>';
?>


