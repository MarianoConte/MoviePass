<?php

namespace Models;

class Room
{
  private $name;
  private $seats;
  private $id;
  private $theater;

  public function __construct(
    $id = null,
    $name = null,
    $seats = null,
    $theater = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->seats = $seats;
    $this->theater = $theater;
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

  public function getSeats()
  {
    return $this->seats;
  }

  public function setSeats($seats)
  {
    $this->seats = $seats;

    return $this;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  public function getTheater()
  {
    return $this->theater;
  }

  public function setTheater($theater)
  {
    $this->theater = $theater;

    return $this;
  }
}
