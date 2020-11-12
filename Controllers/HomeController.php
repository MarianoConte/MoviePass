<?php
namespace Controllers;

use DAO\MovieDAO as MovieDAO;
use DAO\ShowDAO;

class HomeController {
  private $movieDAO;
  private $showDAO;

  public function __construct()
  {
    $this->movieDAO = new MovieDAO();
    $this->showDAO = new ShowDAO();
  }

  /* VIEW METHODS */

  public function index($message = "")
  {
    $movies = $this->getActiveMovies();
    require_once(VIEWS_PATH."/Home/index.php");
  }

  public function ShowMovieDetails($movie_id) {
    $movie = $this->movieDAO->getMovieOnLocalDBById($movie_id);
    $shows = $this->showDAO->GetByMovie($movie_id);
    require_once(VIEWS_PATH."/Home/movie_details.php");
  }

  /* CONTROLLER METHODS */

  /* HELPERS */
  
  private function getActiveMovies() {
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $activeMovies = array();

    foreach($movies as $movie) {
      if(!empty($this->showDAO->GetByMovie($movie->getId()))) {
        array_push($activeMovies, $movie);
      }
    }

    return array_slice($activeMovies, 0, 4);
  }
}
