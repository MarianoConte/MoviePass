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
    $this->theaterDAO = new TheaterDAO;
  }

  /* VIEW METHODS */

  public function ShowAddView($responses = [])
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    require_once(VIEWS_PATH . "/Room/add.php");
  }

  public function ShowEditView($room_id, $responses = [])
  {
    $room = null;

    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $room = $this->roomDAO->GetById($room_id);
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

  public function ShowListViewByTheater($theaterId, $responses = [])
  {
    $rooms = array();

    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $rooms = $this->roomDAO->GetByTheaterId($theaterId);
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

  public function Edit()
  {
    $responses = [];

    $theater = $this->theaterDAO->GetById($_POST['theater_id']);

    $room = new Room($_POST['id'], $_POST['name'], $_POST['seats'], $theater);

    $responses = $this->validateRoom($room);

    if (empty($responses)) {
      if ($this->roomDAO->Edit($room)) {
        return $this->ShowListView();
      } else {
        array_push($responses, new Response(false, "Error al editar sala."));
        return $this->ShowEditView($room->getId(), $responses);
      }
    }
  }

  public function Desactivate()
  {
    $responses = [];

    if ($this->roomDAO->Desactivate($_POST['room_id']))
      array_push($responses, new Response(true, "Sala deshabilitada exitosamente."));
    else
      array_push($responses, new Response(false, "Error al deshabilitar sala."));

    $this->ShowListView($responses);
  }

  public function Activate($room_id)
  {
    $responses = [];

    if ($this->roomDAO->Activate($_POST['room_id']))
      array_push($responses, new Response(true, "Sala habilitada exitosamente."));
    else
      array_push($responses, new Response(false, "Error al habilitar sala."));

    $this->ShowListView($responses);
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
      if ($nameRoom)
        array_push($validationResponses, new Response(false, "El nombre ingresado ya se encuentra registrado en este cine."));
    }
    return $validationResponses;
  }
  private function searchByName($array, $name)
  {
    $res = false;
    foreach ($array as $room) {
      if ($room->getName() == $name) {
        $res = true;
      }
    }
    return $res;
  }
}
