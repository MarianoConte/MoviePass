<?php

namespace Models;

class Room
{
  private $name;
  private $seats;
  private $id;
  private $theater;
  private $state;

  public function __construct(
    $id = null,
    $name = null,
    $seats = null,
    $theater = null,
    $state = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->seats = $seats;
    $this->theater = $theater;
    $this->state = $state;
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

  public function getState()
  {
    return $this->state;
  }

  public function setState($state)
  {
    $this->state = $state;

    return $this;
  }
}
