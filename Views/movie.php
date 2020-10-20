<?php
require_once('nav.php');
foreach($results as $movie){
  echo '<div class="container col-2">';
  echo $movie->title;
  echo '<img class="img-fluid" src="https://image.tmdb.org/t/p/w500/'.$movie->poster_path.'" alt="" ></div>';
}
?>


