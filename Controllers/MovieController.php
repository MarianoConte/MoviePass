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

    public function ShowMovieSearch($error = null){
      $genres = $this->movieDAO->getAllGenres();
      require_once(VIEWS_PATH."search-movie.php");
    }

    public function Search($name = null, $genre = null){
      $res = null;
      if($name){
        if($genre){ //busco por nombre y genero
          $results = $this->movieDAO->getMovieByName($name);
          $movies = array();
          if($results){
            foreach($results as $movie){
              foreach($movie->genre_ids as $id){
                if($id == $genre) array_push($movies, $movie);
              }
            }
            $res = $movies;
          }
        }else{  //busco por nombre
          $results = $this->movieDAO->getMovieByName($name);
          $res = $results;
        }
        
      }else if($genre){ //busco solo por genero
        $results = $this->movieDAO->getMovieByGenre($genre);
        $res = $results;
        
      }
      if($res){
        $this->ShowMovieView($res);
      }else{
        $this->ShowMovieSearch("noMovie");
      }
    }
  }
