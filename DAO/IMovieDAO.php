<?php
    namespace DAO;

    use Models\Pelicula as Pelicula;

    interface IMovieDAO
    {
      function getMovie(String $nombre);
    }
?>