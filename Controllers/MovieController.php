<?php
  namespace Controllers;

  use DAO\MovieDAO as MovieDAO;
  use Models\Pelicula as Pelicula;

  Class MovieController{

    private $movieDAO;

    public function __construct()
    {
      $this->movieDAO = new MovieDAO();
    }

    public function ShowMovieView($results){
      require_once(VIEWS_PATH."movie.php");
    }

    public function Search($name){
      $results = $this->movieDAO->getMovie($name);
      $this->ShowMovieView($results->results);
    }
  }
?>