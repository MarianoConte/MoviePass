<?php

namespace Models;

Class Movie
{
  private $id;
  private $api_movie_id;
  private $name;
  private $description;
  private $genre;
  private $duration;
  private $image;

  public function __construct(
    $id = null,
    $api_movie_id = null,
    $name = null,
    $description = null,
    $genre = null,
    $duration = null,
    $image = null
  ) {
    $this->id = $id;
    $this->api_movie_id = $api_movie_id;
    $this->name = $name;
    $this->description = $description;
    $this->genre = $genre;
    $this->duration = $duration;
    $this->image = $image;
  }
  
  public function getId()
  {
    return $this->id;
  }
  
  public function setId($id)
  {
    $this->id = $id;
  }

  public function getApiMovieId()
  {
    return $this->api_movie_id;
  }

  public function setApiMovieId($api_movie_id)
  {
    $this->api_movie_id = $api_movie_id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  public function getGenre()
  {
    return $this->genre;
  }

  public function setGenre($genre)
  {
    $this->genre = $genre;

    return $this;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function setDuration($duration)
  {
    $this->duration = $duration;

    return $this;
  }
  
  public function getImage()
  {
    return $this->image;
  }

  public function setImage($image)
  {
    $this->image = $image;

    return $this;
  }
}