<?php

namespace DAO;

use DAO\Database\Database as Database;
use DAO\IShowDAO as IShowDAO;
use Models\Show as Show;


class ShowDAO implements IShowDAO
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function GetAll()
  {
    $shows = array();

    $sql = "SELECT 
            f.id as id, m.name as movie, t.name as theater, r.name as room, f.price as price, f.date as date
            FROM functions f 
            inner join theaters t on f.theater_id = t.id 
            inner join movies m on f.movie_id = m.id
            inner join theater_rooms r on f.theater_room_id = r.id";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbShow = $result->fetch_assoc()) {
        array_push(
          $shows,
          new Show(
            $dbShow['id'],
            $dbShow['movie'],
            $dbShow['theater'],
            $dbShow['room'],
            $dbShow['price'],
            $dbShow['date']
          )
        );
      }
    }

    return $shows;
  }

  public function GetByMovie($movie_id) {
    $shows = array();

    $sql = "SELECT
            f.id as id, m.name as movie, t.name as theater, r.name as room, f.price as price, f.date as date
            FROM functions f
            inner join theaters t on f.theater_id = t.id
            inner join movies m on f.movie_id = m.id
            inner join theater_rooms r on f.theater_room_id = r.id
            WHERE f.movie_id = $movie_id";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbShow = $result->fetch_assoc()) {
        array_push(
          $shows,
          new Show(
            $dbShow['id'],
            $dbShow['movie'],
            $dbShow['theater'],
            $dbShow['room'],
            $dbShow['price'],
            $dbShow['date']
          )
        );
      }
    }

    return $shows;
  }

  public function CheckShowHour($theater, $room, $date ,$duration, $show_id = null)
  {
    
    $sql = "SELECT count(*) quantity FROM functions f inner join movies m on f.movie_id = m.id WHERE theater_id = $theater and theater_room_id = $room and 
    ((DATE_ADD(f.date, INTERVAL -15 MINUTE)  between DATE_ADD('$date', INTERVAL -15 MINUTE) AND DATE_ADD('$date', INTERVAL ($duration+15) MINUTE)) 
    or 
    (DATE_ADD(f.date, INTERVAL (m.duration+15) MINUTE) 
    between DATE_ADD('$date', INTERVAL -15 MINUTE) AND DATE_ADD('$date', INTERVAL ($duration+15) MINUTE)))";

    if($show_id != null) {
      $sql = $sql . " and f.id != $show_id";
    }
    
    return $this->db->getConnection()->query($sql)->fetch_assoc()['quantity'];
  }

  public function Add(Show $show)
  {
    $sql = "INSERT INTO functions(movie_id, theater_id, theater_room_id, price, date)
      VALUES ('{$show->getMovie()->getId()}','{$show->getTheater()->getId()}', '{$show->getRoom()->getId()}', '{$show->getPrice()}', '{$show->getDate()}')";

    return $this->db->getConnection()->query($sql);
  }

  public function Edit(Show $show)
  {
    $sql = "UPDATE functions SET movie_id = '{$show->getMovie()->getId()}', theater_id = '{$show->getTheater()->getId()}', 
                                 theater_room_id = '{$show->getRoom()->getId()}', price = '{$show->getPrice()}', date = '{$show->getDate()}'
                                 WHERE id = '{$show->getId()}'";

    return $this->db->getConnection()->query($sql);
  }

  public function GetById($show_id)
  {

    $show = null;
    $dbShow = null;

    $sql = "SELECT * FROM functions WHERE id='{$show_id}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbShow = $result->fetch_assoc();
      $show = new Show(
        $dbShow['id'],
        $dbShow['movie_id'],
        $dbShow['theater_id'],
        $dbShow['theater_room_id'],
        $dbShow['price'],
        $dbShow['date']
      );
    }

    return $show;
  }
}