<?php namespace Models;
  Class Client extends User{
    private $tickets;

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
  }
?>