<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\RoomDAO as RoomDAO;
use Models\Room as Room;

class RoomController
{
  private $roomDAO;

  public function __construct()
  {
    $this->roomDAO = new RoomDAO();
  }

  /* VIEW METHODS */

  public function ShowAddView($responses = [])
  {
    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    require_once(VIEWS_PATH . "/Room/add.php");
  }

  public function ShowEditView($room_id, $responses = [])
  {
    $room = null;

    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $room = $this->roomDAO->GetById($room_id);
    require_once(VIEWS_PATH . "/Room/edit.php");
  }

  public function ShowListView($responses = [])
  {
    $rooms = array();

    if($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $rooms = $this->roomDAO->GetAll();
      require_once(VIEWS_PATH . "/Room/list.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  /* CONTROLLER METHODS */

  public function Add()
  {
    $responses = [];

    $room = new Room(null, $_POST['name'], $_POST['seats']);

    $theater_id = $_POST['theater_id'];

    //$responses = //validatecineid()
    $responses += $this->validateName($room);

    if(empty($responses)) {
      if ($this->roomDAO->Add($theater_id, $room))
        array_push($responses, new Response(true, "Sala registrado exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar sala."));
    }

    $this->ShowAddView($responses);
  }

  public function Edit()
  {
    $responses = [];

    $room = new Room($_POST['id'], $_POST['name'], $_POST['seats']);

    $responses = $this->validateName($room);

    if(empty($responses)) {
      if ($this->roomDAO->Edit($room)) {
        return $this->ShowListView();
      } else {
        array_push($responses, new Response(false, "Error al editar sala."));
        return $this->ShowEditView($room->getId(), $responses);
      }
    }
  }

  public function Deactivate()
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

  private function validateName($theater_id, Room $room)
  {
    $validationResponses = [];

    // Null validators
    if($room->getName() == NULL)
      array_push($validationResponses, new Response(false, "Nombre requerido."));
    if($room->getSeats() == NULL)
      array_push($validationResponses, new Response(false, "Cantidad de espacios requerida."));

    // Name exists
    $dbRoom = $this->roomDAO->GetByName($room->getName());
    if($dbRoom && $dbRoom->getId() != $room->getId() &&  )
      array_push($validationResponses, new Response(false, "El nombre ingresado ya se encuentra registrado."));

    return $validationResponses;
  }
}
