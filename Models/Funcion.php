<?php namespace Models;

  Class Funcion{
    private $fecha;
    private $vendidas;
    private $pelicula;
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
  }
?>