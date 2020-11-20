<?php namespace Models;
  
  Class Discount{
    private $id;
    private $percentaje;
    private $amount;
    private $maximum;
    private $dateFrom;
    private $dateTo;
    private $days;
    private $description;
    private $state;

    public function __construct(
        $id = null,
        $percentaje = null,
        $amount = null,
        $maximum = null,
        $dateFrom = null,
        $dateTo = null,
        $days = null,
        $description = null,
        $state = null
      ) {
        $this->id = $id;
        $this->percentaje = $percentaje;
        $this->amount = $amount;
        $this->maximum = $maximum;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->days = $days;
        $this->description = $description;
        $this->state = $state;
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
     * Get the value of percentaje
     */ 
    public function getPercentaje()
    {
        return $this->percentaje;
    }

    /**
     * Set the value of percentaje
     *
     * @return  self
     */ 
    public function setPercentaje($percentaje)
    {
        $this->percentaje = $percentaje;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of maximum
     */ 
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * Set the value of maximum
     *
     * @return  self
     */ 
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;

        return $this;
    }

    /**
     * Get the value of dateFrom
     */ 
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set the value of dateFrom
     *
     * @return  self
     */ 
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get the value of days
     */ 
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set the value of days
     *
     * @return  self
     */ 
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

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

        /**
         * Get the value of dateTo
         */ 
        public function getDateTo()
        {
                return $this->dateTo;
        }

        /**
         * Set the value of dateTo
         *
         * @return  self
         */ 
        public function setDateTo($dateTo)
        {
                $this->dateTo = $dateTo;

                return $this;
        }
  }

?>