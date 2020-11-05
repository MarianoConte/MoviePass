<?php namespace Models;

  Class Funcion{
    private $fecha;
    private $vendidas;
    private $pelicula;
    private $hour;
    private $tickets;
    private $cine;
    private $id;
    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }
    public function getPelicula($pelicula){
      return $this->pelicula;
    }
    public function setPelicula($pelicula){
      $this->pelicula = $pelicula;
    }
    public function setFecha($date){
      $this->fecha = $date;
    }
    public function getFecha(){
      return $this->fecha;
    }
    public function setVendidas($con){
      $this->vendidas = $con;
    }
    public function getVendidas(){
      return $this->vendidas;
    }

    /**
     * Get the value of cine
     */ 
    public function getCine()
    {
        return $this->cine;
    }

    /**
     * Set the value of cine
     *
     * @return  self
     */ 
    public function setCine($cine)
    {
        $this->cine = $cine;

        return $this;
    }

    /**
     * Get the value of tickets
     */ 
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set the value of tickets
     *
     * @return  self
     */ 
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Get the value of hour
     */ 
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set the value of hour
     *
     * @return  self
     */ 
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

  }
?>