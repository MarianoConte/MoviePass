<?php
  namespace DAO;

  use DAO\IMovieDAO as IMovieDAO;
  use Models\Movie as Movie;
  use DAO\Database\Database as Database;
use mysqli;

Class MovieDAO implements IMovieDAO{
    
    private $db;

    public function __construct()
    {
      $this->db = new Database();
    }

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

    public function addMovie(Movie $movie){
      $movieName = $this->db->getConnection()->real_escape_string($movie->getName());
      $movieDescription = $this->db->getConnection()->real_escape_string($movie->getDescription());

      $sql = "INSERT INTO movies(id, name, description, genre, duration, image)
        VALUES ('{$movie->getId()}','{$movieName}','{$movieDescription}', '{$movie->getGenre()}', '{$movie->getDuration()}', '{$movie->getImage()}')";
        
      return $this->db->getConnection()->query($sql);
    }

    public function getMoviesOnLocalDB(){
    $movies = array();

    $sql = "SELECT * FROM movies ORDER BY id DESC";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbMovie = $result->fetch_assoc()) {
        array_push(
          $movies,
          new Movie(
            $dbMovie['id'],
            $dbMovie['name'],
            $dbMovie['description'],
            $dbMovie['genre'],
            $dbMovie['duration'],
            $dbMovie['image']
          )
        );
      }
    }

    return $movies;
    }

    public function getMovieOnLocalDBById($movie_id){
    $movie = null;
    $dbMovie = null;

    $sql = "SELECT * FROM movies where id = ".$movie_id." LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbMovie = $result->fetch_assoc();
      $movie = new Movie(
        $dbMovie['id'],
        $dbMovie['name'],
        $dbMovie['description'],
        $dbMovie['genre'],
        $dbMovie['duration'],
        $dbMovie['image']
      );
    }

    return $movie;
  }
}