<?php namespace Models;
  Class Ticket{
    private $funcion;
    private $client;
    private $id;

    /**
     * Get the value of funcion
     */ 
    public function getFuncion()
    {
        return $this->funcion;
    }

    /**
     * Set the value of funcion
     *
     * @return  self
     */ 
    public function setFuncion($funcion)
    {
        $this->funcion = $funcion;

        return $this;
    }

    /**
     * Get the value of client
     */ 
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @return  self
     */ 
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
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
  }

?>