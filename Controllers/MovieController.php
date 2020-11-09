<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\MovieDAO as MovieDAO;
use Models\Movie as Movie;

class MovieController
{
  private $movieDAO;

  public function __construct()
  {
    $this->movieDAO = new MovieDAO();
  }

  public function ShowMovieView($results)
  {
    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);
    require_once(VIEWS_PATH . "/Movie/movie.php");
  }

  public function ShowSearchView($responses = [])
  {
    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);
    $genres = $this->movieDAO->getAllGenres();
    require_once(VIEWS_PATH . "/Movie/search.php");
  }

  public function getMovieData(){
    $movie = file_get_contents(API_URL."movie/".$_POST['movie_id']."?".API_KEY."&language=es-AR");
    $movie = json_decode($movie);
    $new_movie = new Movie($movie->id, $movie->title, $movie->overview, $movie->genres[0]->name, $movie->runtime);

    $responses = [];

    $responses = $this->valiDateMovie($new_movie);

    if(empty($responses)) {
      if ($this->movieDAO->addMovie($new_movie))
        array_push($responses, new Response(true, "Película registrado exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar película."));
    }

    $this->ShowSearchView($responses);
  }


  public function validateMovie(Movie $movie){

    $validationResponses = [];

    if($movie->getName() == NULL)
    array_push($validationResponses, new Response(false, "Título no encontrado."));
    if($movie->getGenre() == NULL)
    array_push($validationResponses, new Response(false, "Genero no encontrado."));
    if($movie->getDescription() == NULL)
    array_push($validationResponses, new Response(false, "Descripción no encontrada."));
    if($movie->getDuration() == NULL)
    array_push($validationResponses, new Response(false, "Duración no encontrada."));

    $dbMovie = $this->movieDAO->getMovieOnLocalDBById($movie->getId());
    if($dbMovie)
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

    if($dateFrom && $dateTo){
      $movies = array();
      foreach($res as $movie){

        $yearMovie = date_format(date_create($movie->release_date), 'Y');

        if($yearMovie >= $dateFrom && $yearMovie <= $dateTo) array_push($movies, $movie);
      
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
}