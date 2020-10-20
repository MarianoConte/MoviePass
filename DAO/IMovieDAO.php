<?php
    namespace DAO;

    use Models\Movie as Movie;

    interface IMovieDAO
    {
      function getMovie(String $nombre);
    }
?>