<?php

namespace Models;

class Theater
{
  private $id;
  private $name;
  private $address;
  private $state;
  private $rooms;

  public function __construct(
    $id = null,
    $name = null,
    $address = null,
    $state = null,
    $rooms = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->address = $address;
    $this->state = $state;
    $this->$rooms = $rooms;
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
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function setAddress($address)
  {
    $this->address = $address;
  }

  public function getState()
  {
    return $this->state;
  }

  public function setState($state)
  {
    $this->state = $state;
  }

  public function getRooms()
  {
    return $this->rooms;
  }

  public function setRooms($rooms)
  {
    $this->rooms = $rooms;
  }
}
