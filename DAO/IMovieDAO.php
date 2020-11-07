<?php

namespace DAO;

use Models\Movie as Movie;

interface IMovieDAO
{
  function getMovieByName(String $nombre);
  function getMovieByGenre(String $genre);
  function getAllGenres();
  function addMovie(Movie $movie);
  function getMoviesOnLocalDB();
  function getMovieOnLocalDBById($movie_id);
}