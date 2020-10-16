<?php namespace Models;
  Class Cine{
    private $nombre;
    private $id;
    private $direccion;
    private $valorEntrada;
    private $salas; // array salas
    private $state;
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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
  }
?>