<?php
  namespace DAO;

  use DAO\IMovieDAO as IMovieDAO;
  use Models\Pelicula as Pelicula;

  Class MovieDAO implements IMovieDAO{
    

    public function getMovieByName($name){
      $movie = file_get_contents(API_URL."search/movie?".API_KEY."&sort_by=popularity.desc&language=es-AR&query=".str_replace(' ', '+', $name));
      $movie = json_decode($movie);
      return $movie->results;
    }

    public function getMovieByGenre($genre)
    {
      $movie = file_get_contents(API_URL."discover/movie?".API_KEY."&sort_by=popularity.desc&language=es-AR&with_genres=".$genre);
      $movie = json_decode($movie);
      return $movie->results;
    }

    public function getAllGenres()
    {
      $genres = file_get_contents(API_URL . "genre/movie/list?".API_KEY."&language=es-AR");
      $genres = json_decode($genres);
      return $genres->genres;
    }
  } 
