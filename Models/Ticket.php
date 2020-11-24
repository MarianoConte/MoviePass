<?php

namespace Models;

class Ticket
{
  private $id;
  private $token;
  private $user;
  private $show;
  private $date;
  private $price;
  private $discount;

  public function __construct(
    $id = null,
    $token = null,
    $user = null,
    $show = null,
    $date = null,
    $price = null,
    $discount = null
  ) {
    $this->id = $id;
    $this->token = $token;
    $this->user = $user;
    $this->show = $show;
    $this->date = $date;
    $this->price = $price;
    $this->discount = $discount;
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

  public function getToken()
  {
    return $this->token;
  }

  public function setToken($token)
  {
    $this->token = $token;

    return $this;
  }

  public function getUser()
  {
    return $this->user;
  }

  public function setUser($user)
  {
    $this->user = $user;

    return $this;
  }

  public function getShow()
  {
    return $this->show;
  }

  public function setShow($show)
  {
    $this->show = $show;

    return $this;
  }
  
  public function getDate()
  {
    return $this->date;
  }

  public function setDate($date)
  {
    $this->date = $date;

    return $this;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  public function getDiscount()
  {
    return $this->discount;
  }

  public function setDiscount($discount)
  {
    $this->discount = $discount;

    return $this;
  }
}