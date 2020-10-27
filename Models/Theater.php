<?php

namespace Models;

class Theater
{
  private $id;
  private $name;
  private $capacity;
  private $address;
  private $ticket_price;
  private $state;

  public function __construct(
    $id = null,
    $name = null,
    $capacity = null,
    $address = null,
    $ticket_price = null,
    $state = null
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->capacity = $capacity;
    $this->address = $address;
    $this->ticket_price = $ticket_price;
    $this->state = $state;
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

  public function getCapacity()
  {
    return $this->capacity;
  }

  public function setCapacity($capacity)
  {
    $this->capacity = $capacity;
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function setAddress($address)
  {
    $this->address = $address;
  }

  public function getTicketPrice()
  {
    return $this->ticket_price;
  }

  public function setTicketPrice($ticket_price)
  {
    $this->ticket_price = $ticket_price;
  }

  public function getState()
  {
    return $this->state;
  }

  public function setState($state)
  {
    $this->state = $state;
  }
}
