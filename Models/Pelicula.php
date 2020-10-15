<?php

namespace Models;

Class Pelicula
{
  private $nombre;
  private $genero;
  private $id;
  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getNombre()
  {
    return $this->nombre;
  }
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }
  public function getGenero()
  {
    return $this->genero;
  }
  public function setGenero($genero)
  {
    $this->genero = $genero;
  }
}
