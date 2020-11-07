<?php

namespace Models;

Class Movie
{
  private $name;
  private $genre;
  private $description;
  private $id;
  private $duration;

  public function __construct(
    $id = null,
    $name = null,
    $description = null,
    $genre = null,
    $duration = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->genre = $genre;
    $this->duration = $duration;
  }
  
  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
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
 
  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }
}