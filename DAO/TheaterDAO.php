<?php

namespace DAO;

use DAO\Database\Database as Database;

use DAO\ITheaterDAO as ITheaterDAO;
use Models\Theater as Theater;

class TheaterDAO implements ITheaterDAO
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function GetAll()
  {
    $theaters = array();

    $sql = "SELECT * FROM theaters";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($theater = $result->fetch_assoc()) {
        array_push(
          $theaters,
          new Theater(
            $theater['id'],
            $theater['name'],
            $theater['address'],
            $theater['state']
          )
        );
      }
    }

    return $theaters;
  }

  public function GetById($theater_id)
  {
    $theater = null;
    $dbTheater = null;

    $sql = "SELECT * FROM theaters WHERE id='{$theater_id}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbTheater = $result->fetch_assoc();
      $theater = new Theater(
        $dbTheater['id'],
        $dbTheater['name'],
        $dbTheater['address'],
        $dbTheater['state']
      );
    }

    return $theater;
  }

  public function GetByName($theater_name)
  {
    $theater = null;
    $dbTheater = null;

    $sql = "SELECT * FROM theaters WHERE name='{$theater_name}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbTheater = $result->fetch_assoc();
      $theater = new Theater(
        $dbTheater['id'],
        $dbTheater['name'],
        $dbTheater['address'],
        $dbTheater['state']
      );
    }

    return $theater;
  }

  public function Add(Theater $theater)
  {
    $sql = "INSERT INTO theaters(name, address)
    VALUES ('{$theater->getName()}', '{$theater->getAddress()}')";

    return $this->db->getConnection()->query($sql);
  }

  public function Edit(Theater $theater)
  {
    $sql =
      "UPDATE 
      theaters
    SET 
      name='{$theater->getName()}',
      address='{$theater->getAddress()}'
    WHERE 
      id={$theater->getId()}";

    return $this->db->getConnection()->query($sql);
  }

  public function Deactivate($theater_id)
  {
    $sql =
      "UPDATE 
      theaters
    SET 
      state=0
    WHERE 
      id={$theater_id}";

    return $this->db->getConnection()->query($sql);
  }

  public function Activate($theater_id)
  {
    $sql =
      "UPDATE 
      theaters
    SET 
      state=1
    WHERE 
      id={$theater_id}";

    return $this->db->getConnection()->query($sql);
  }
}
