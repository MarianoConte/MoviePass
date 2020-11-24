<?php

namespace DAO;

use DAO\Database\Database as Database;

use DAO\IDiscountDAO as IDiscountDAO;
use Models\Discount as Discount;

class DiscountDAO implements IDiscountDAO
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function GetAll()
  {
    $discounts = array();

    $sql = "SELECT * FROM discounts";
    $result = $this->db->getConnection()->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($dbDiscount = $result->fetch_assoc()) {
        array_push(
          $discounts,
          new Discount(
            $dbDiscount['id'],
            $dbDiscount['percentaje'],
            $dbDiscount['amount'],
            $dbDiscount['maximum'],
            $dbDiscount['dateFrom'],
            $dbDiscount['dateTo'],
            $dbDiscount['days'],
            $dbDiscount['minTickets'],
            $dbDiscount['description'],
            $dbDiscount['state']
          )
        );
      }
    }

    return $discounts;
  }

  public function GetById($discount_id)
  {
    $discount = null;
    $dbDiscount = null;

    $sql = "SELECT * FROM discounts WHERE id='{$discount_id}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbDiscount = $result->fetch_assoc();
      $discount = new Discount(
        $dbDiscount['id'],
        $dbDiscount['percentaje'],
        $dbDiscount['amount'],
        $dbDiscount['maximum'],
        $dbDiscount['dateFrom'],
        $dbDiscount['dateTo'],
        $dbDiscount['days'],
        $dbDiscount['minTickets'],
        $dbDiscount['description'],
        $dbDiscount['state']
      );
    }

    return $discount;
  }

  public function Add(Discount $discount)
  {
    $sql = "INSERT INTO discounts(percentaje, amount, maximum, dateFrom, dateTo, days, minTickets, description, state)
      VALUES ('{$discount->getPercentaje()}','{$discount->getAmount()}','{$discount->getMaximum()}','{$discount->getDateFrom()}','{$discount->getDateTo()}',
      '{$discount->getDays()}', '{$discount->getMinTickets()}' ,'{$discount->getDescription()}','{$discount->getState()}')";

    return $this->db->getConnection()->query($sql);
  }

  public function Edit(Discount $discount)
  {
    $sql =
      "UPDATE 
      discounts
    SET 
      percentaje='{$discount->getPercentaje()}',
      amount='{$discount->getAmount()}',
      maximum='{$discount->getMaximum()}',
      dateFrom='{$discount->getDateFrom()}',
      dateTo='{$discount->getDateTo()}',
      days='{$discount->getDays()}',
      minTickets='{$discount->getMinTickets()}',
      description='{$discount->getDescription()}',
      state='{$discount->getState()}',
    WHERE 
      id={$discount->getId()}";

    return $this->db->getConnection()->query($sql);
  }
  public function Desactivate($discount_id)
  {
    $sql =
      "UPDATE 
      discounts
    SET 
      state=0
    WHERE 
      id={$discount_id}";

    return $this->db->getConnection()->query($sql);
  }

  public function Activate($discount_id)
  {
    $sql =
      "UPDATE 
      discounts
    SET 
      state=1
    WHERE 
      id={$discount_id}";

    return $this->db->getConnection()->query($sql);
  }

  public function GetTodayDiscounts(){
    $discounts = array();
  
    $sql = "SELECT * FROM discounts WHERE NOW() BETWEEN discounts.dateFrom AND discounts.dateTo AND discounts.days LIKE CONCAT('%',DAYNAME(NOW()),'%')
    AND discounts.state = 1 ";
    $result = $this->db->getConnection()->query($sql);
  
    if ($result && $result->num_rows > 0) {
      while ($dbDiscount = $result->fetch_assoc()) {
        array_push(
          $discounts,
          new Discount(
            $dbDiscount['id'],
            $dbDiscount['percentaje'],
            $dbDiscount['amount'],
            $dbDiscount['maximum'],
            $dbDiscount['dateFrom'],
            $dbDiscount['dateTo'],
            $dbDiscount['days'],
            $dbDiscount['minTickets'],
            $dbDiscount['description'],
            $dbDiscount['state']
          )
        );
      }
    }
  
    return $discounts;
  }
}



?>