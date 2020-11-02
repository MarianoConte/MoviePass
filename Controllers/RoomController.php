<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\RoomDAO as RoomDAO;
use Models\Room as Room;
use DAO\TheaterDAO as TheaterDAO;
use Models\Theater as Theater;

class RoomController
{
  private $roomDAO;
  private $theaterDAO;

  public function __construct()
  {
    $this->roomDAO = new RoomDAO();
    $this->theaterDAO = new TheaterDAO();
  }

  /* VIEW METHODS */

  public function ShowAddView($theater_id, $responses = [])
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);
    $theater = $this->theaterDAO->GetById($theater_id);
    require_once(VIEWS_PATH . "/Room/add.php");
  }

  public function ShowEditView($theater_id, $room_id, $responses = [])
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $room = $this->roomDAO->GetById($room_id);
    $theater = $this->theaterDAO->GetById($theater_id);
    require_once(VIEWS_PATH . "/Room/edit.php");
  }

  public function ShowListView($responses = [])
  {
    $rooms = array();

    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $rooms = $this->roomDAO->GetAll();
      require_once(VIEWS_PATH . "/Room/list.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  public function ShowListViewByTheater($theater_id, $responses = [])
  {
    $rooms = array();
    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $rooms = $this->roomDAO->GetByTheaterId($theater_id);
      $theater = $this->theaterDAO->GetById($theater_id);
      require_once(VIEWS_PATH . "/Room/list.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  /* CONTROLLER METHODS */

  public function Add()
  {
    $responses = [];
    $theater = $this->theaterDAO->GetById($_POST['theater_id']);
    $room = new Room(null, $_POST['name'], $_POST['seats'], $theater);

    $responses = $this->validateRoom($room);

    if (empty($responses)) {
      if ($this->roomDAO->Add($room))
        array_push($responses, new Response(true, "Sala registrado exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar sala."));
    }

    $this->ShowAddView($responses);
  }

  public function Edit($theater_id, $room_id, $name, $seats)
  {
    $responses = [];

    $theater = $this->theaterDAO->GetById($theater_id);

    $room = $this->roomDAO->GetById($room_id);
    
    $room->setTheater($theater);
    $room->setName($name);
    $room->setSeats($seats);

    $responses = $this->validateRoom($room);

    if (empty($responses)) {
      if ($this->roomDAO->Edit($room)) {
        return $this->ShowListViewByTheater($theater_id);
      } else {
        array_push($responses, new Response(false, "Error al editar sala."));
        return $this->ShowEditView($theater_id, $room_id, $responses);
      }
    }
  }

  public function Desactivate($theater_id, $room_id)
  {
    $responses = [];

    if ($this->roomDAO->Desactivate($room_id))
      array_push($responses, new Response(true, "Sala deshabilitada exitosamente."));
    else
      array_push($responses, new Response(false, "Error al deshabilitar sala."));

    $this->ShowListViewByTheater($theater_id, $responses);
  }

  public function Activate($theater_id, $room_id)
  {
    $responses = [];

    if ($this->roomDAO->Activate($room_id))
      array_push($responses, new Response(true, "Sala habilitada exitosamente."));
    else
      array_push($responses, new Response(false, "Error al habilitar sala."));

    $this->ShowListViewByTheater($theater_id, $responses);
  }

  /* VALIDATORS */

  private function validateRoom(Room $room)
  {
    $validationResponses = [];

    // Null validators
    if ($room->getName() == NULL)
      array_push($validationResponses, new Response(false, "Nombre requerido."));
    if ($room->getSeats() == NULL)
      array_push($validationResponses, new Response(false, "Cantidad de espacios requerida."));

    // Busco las salas del teatro
    $dbRooms = $this->roomDAO->GetByTheaterId($room->getTheater()->getId());

    // Filtro por nombre si el cine tiene salas
    if ($dbRooms) {
      $nameRoom = $this->searchByName($dbRooms, $room->getName());
      if ($nameRoom && $nameRoom->getId()!=$room->getId())
        array_push($validationResponses, new Response(false, "El nombre ingresado ya se encuentra registrado en este cine."));
    }
    return $validationResponses;
  }
  private function searchByName($array, $name)
  {
    $res = null;
    foreach ($array as $room) {
      if ($room->getName() == $name) {
        $res = $room;
      }
    }
    return $res;
  }
}
