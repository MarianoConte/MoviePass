<?php

namespace Controllers;

use DAO\MovieDAO as MovieDAO;
use Models\Pelicula as Pelicula;

class MovieController
{

  private $movieDAO;

  public function __construct()
  {
    $this->movieDAO = new MovieDAO();
  }

  public function ShowMovieView($results)
  {
    require_once(VIEWS_PATH . "/Movie/movie.php");
  }

  public function ShowSearchView($responses = [])
  {
    $genres = $this->movieDAO->getAllGenres();
    require_once(VIEWS_PATH . "/Movie/search.php");
  }

  public function Search($name = null, $genre = null)
  {
    $res = null;
    if ($name) {
      if ($genre) {
        $results = $this->movieDAO->getMovieByName($name);
        $movies = array();
        if ($results) {
          foreach ($results as $movie) {
            foreach ($movie->genre_ids as $id) {
              if ($id == $genre) array_push($movies, $movie);
            }
          }
          $res = $movies;
        }
      } else {
        $results = $this->movieDAO->getMovieByName($name);
        $res = $results;
      }
    } else if ($genre) {
      $results = $this->movieDAO->getMovieByGenre($genre);
      $res = $results;
    }
    if ($res) {
      $this->ShowMovieView($res);
    } else {
      $this->ShowSearchView("noMovie");
    }
  }
}
