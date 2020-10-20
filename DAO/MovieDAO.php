<?php
  namespace DAO;

  use DAO\IMovieDAO as IMovieDAO;
  use Models\Movie as Movie;

  Class MovieDAO implements IMovieDAO{
    

    public function getMovie($name){
      $movie = file_get_contents(API_URL."search/movie?".API_KEY."&language=es-AR&query=".$name);
      $movie = json_decode($movie);
      return $movie;
    }
  } 
