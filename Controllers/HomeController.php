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

  public function index($message = "")
  {
    $movies = $this->getActiveMovies();
    require_once(VIEWS_PATH."/Home/index.php");
  }    
  
  private function getActiveMovies() {
    $movies = array_slice($this->movieDAO->getMoviesOnLocalDB(), 0, 4);
    $activeMovies = array();

    foreach($movies as $movie) {
      if(!empty($this->showDAO->GetByMovie($movie->getId()))) {
        array_push($activeMovies, $movie);
      }
    }

    return $activeMovies;
  }
}
