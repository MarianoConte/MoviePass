<?php

namespace DAO;

use DAO\Database\Database as Database;

use DAO\IRoomDAO as IRoomDAO;
use Models\Room as Room;

class RoomDAO implements IRoomDAO
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  function GetAll()
  {
    $rooms = array();

    $sql = "SELECT * FROM theaters_rooms";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbRoom = $result->fetch_assoc()) {
        array_push(
          $rooms,
          new Room(
            $dbRoom['id'],
            $dbRoom['name'],
            $dbRoom['seats']
          )
        );
      }
    }

    return $rooms;
  }

  public function GetById($room_id)
  {
    $room = null;
    $dbRoom = null;

    $sql = "SELECT * FROM theaters_rooms WHERE id='{$room_id}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbRoom = $result->fetch_assoc();
      $room = new Room(
        $dbRoom['id'],
        $dbRoom['name'],
        $dbRoom['seats']
      );
    }

    return $room;
  }
  public function GetByTheaterId($theater_id)
  {
    $rooms = array();

    $sql = "SELECT * FROM theaters_rooms WHERE theater_id='{$theater_id}'";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbRoom = $result->fetch_assoc()) {
        array_push(
          $rooms,
          new Room(
            $dbRoom['id'],
            $dbRoom['name'],
            $dbRoom['seats']
          )
        );
      }
    }

    return $rooms;
  }

  function Add(Room $room)
  {
    $sql = "INSERT INTO theater_rooms(theater_id, name, seats)
      VALUES ('{$room->getTheater()->getId()}','{$room->getName()}', '{$room->getSeats()}')";

    return $this->db->getConnection()->query($sql);
  }

  function Edit(Room $room)
  {
    $sql =
      "UPDATE 
      theater_rooms
    SET 
      name='{$room->getName()}',
      seats='{$room->getSeats()}',
    WHERE 
      id={$room->getId()}";

    return $this->db->getConnection()->query($sql);
  }
  public function Desactivate($room_id)
  {
    $sql =
      "UPDATE 
      theater_rooms
    SET 
      state=0
    WHERE 
      id={$room_id}";

    return $this->db->getConnection()->query($sql);
  }

  public function Activate($room_id)
  {
    $sql =
      "UPDATE 
      theater_rooms
    SET 
      state=1
    WHERE 
      id={$room_id}";

    return $this->db->getConnection()->query($sql);
  }
}
