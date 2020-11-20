<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\MovieDAO as MovieDAO;
use Models\Movie as Movie;
use DAO\ShowDAO as ShowDAO;
use Models\Show as Show;

class MovieController
{
  private $movieDAO;
  private $showDAO;

  public function __construct()
  {
    $this->movieDAO = new MovieDAO();
    $this->showDAO = new ShowDAO();
  }

  /* VIEW METHODS */

  public function ShowMovieView($results)
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);
    require_once(VIEWS_PATH . "/Movie/movie.php");
  }

  public function ShowSearchView($responses = [])
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);
    $genres = $this->movieDAO->getAllGenres();
    require_once(VIEWS_PATH . "/Movie/search.php");
  }

  public function ShowListView($responses = [])
  {
    $movies = array();

    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $movies = $this->movieDAO->getMoviesOnLocalDB();
      require_once(VIEWS_PATH . "/Movie/list.php");
    } else {
      $movies = $this->getActiveMovies();
      require_once(VIEWS_PATH . "/Movie/userList.php");
    }
    
  }

  /* CONTROLLER METHODS */

  public function getMovieData()
  {
    $movie = file_get_contents(API_URL . "movie/" . $_POST['movie_id'] . "?" . API_KEY . "&language=es-MX");
    $movie = json_decode($movie);
    $newMovie = new Movie(null, $movie->id, $movie->title, $movie->overview, $movie->genres[0]->name, $movie->runtime, 'https://image.tmdb.org/t/p/w500'.$movie->poster_path);

    $responses = [];

    $responses = $this->validateMovie($newMovie);

    if (empty($responses)) {
      if ($this->movieDAO->addMovie($newMovie))
        array_push($responses, new Response(true, "Película registrada exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar película."));
    }

    $this->ShowSearchView($responses);
  }


  public function validateMovie(Movie $movie)
  {
    $validationResponses = [];

    if ($movie->getName() == NULL)
      array_push($validationResponses, new Response(false, "Título no encontrado."));
    if ($movie->getGenre() == NULL)
      array_push($validationResponses, new Response(false, "Genero no encontrado."));
    if ($movie->getDescription() == NULL)
      array_push($validationResponses, new Response(false, "Descripción no encontrada."));
    if ($movie->getDuration() == NULL)
      array_push($validationResponses, new Response(false, "Duración no encontrada."));

    $dbMovie = $this->movieDAO->getMovieOnLocalDBById($movie->getApiMovieId());
    if ($dbMovie)
      array_push($validationResponses, new Response(false, "La película ingresada ya se encuentra registrada."));

    return $validationResponses;
  }

  public function Search($name = null, $genre = null, $dateFrom = null, $dateTo = null)
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

    if ($dateFrom || $dateTo) {
      $movies = array();
      foreach ($res as $movie) {
        $yearMovie = date_format(date_create($movie->release_date), 'Y');

        if($dateFrom && $dateTo) {
          if ($yearMovie >= $dateFrom && $yearMovie <= $dateTo)
            array_push($movies, $movie);
        } else if($dateFrom) {
          if ($yearMovie >= $dateFrom)
            array_push($movies, $movie);
        } else if($dateTo) {
          if ($yearMovie <= $dateTo)
            array_push($movies, $movie);
        }
      }

      $res = $movies;
    }
    if ($res) {
      $this->ShowMovieView($res);
    } else {
      array_push($responses, new Response(false, "No se encontraron películas con los filtros deseados."));
      $this->ShowSearchView($responses);
    }
  }

  private function getActiveMovies() {
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $activeMovies = array();

    foreach($movies as $movie) {
      if(!empty($this->showDAO->GetByMovie($movie->getId()))) {
        array_push($activeMovies, $movie);
      }
    }

    return $activeMovies;
  }
}
