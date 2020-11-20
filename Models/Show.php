<?php namespace Models;

  Class Show{
    private $date;
    private $movie;
    private $theater;
    private $room;
    private $id;
    private $price;
    private $availableTickets;

    public function __construct(
      $id = null,
      $movie = null,
      $theater = null,
      $room = null,
      $price = null,
      $date = null,
      $availableTickets = null
    ) {
      $this->id = $id;
      $this->movie = $movie;
      $this->theater = $theater;
      $this->room = $room;
      $this->price = $price;
      $this->date = $date;
      $this->availableTickets = $availableTickets;
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

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;

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

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;

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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getAvailableTickets()
    {
        return $this->availableTickets;
    }

    public function setAvailableTickets($availableTickets)
    {
        $this->availableTickets = $availableTickets;

        return $this;
    }
  }
?>