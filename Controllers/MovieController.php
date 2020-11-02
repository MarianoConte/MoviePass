<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\MovieDAO as MovieDAO;

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
    $responses = [];

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
      array_push($responses, new Response(false, "No se encontraron películas con los filtros deseados."));
      $this->ShowSearchView($responses);
    }
  }
}
