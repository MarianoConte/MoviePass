<?php namespace Models;
  class Sala{
    private $lugares;
    private $id;
    private $cine;
    public function setCine($cine){
      $this->cine = $cine;
    }
    public function getCine(){
      return $this->cine;
    }
    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }
    public function getLugares(){
      return $this->lugares;
    }
    public function setLugares($lugares){
      $this->lugares = $lugares;
    }

  }

?>