<?php namespace Models;
  class Cine{
    private $nombre;
    private $direccion;
    private $valorEntrada;
    private $salas; // array salas
    public function getSalas(){
      return $this->salas;
    }
    public function setSalas($salas){
      $this->salas = $salas;
    }
    public function getValorEntrada(){
      return $this->valorEntrada;
    }
    public function setValorEntrada($valorEntrada){
      $this->valorEntrada = $valorEntrada;
    }
    public function getNombre(){
      return $this->nombre;
    }
    public function setNombre($nombre){
      $this->nombre = $nombre;
    }
    public function getDireccion(){
      return $this->direccion;
    }
    public function setDireccion($dir){
      $this->direccion = $dir;
    }
  }
?>