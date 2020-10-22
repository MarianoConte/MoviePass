<?php
    namespace DAO;

    use Models\Pelicula as Pelicula;

    interface IMovieDAO
    {
      function getMovieByName(String $nombre);
      function getMovieByGenre(String $genre);
      function getAllGenres();
    }
?>