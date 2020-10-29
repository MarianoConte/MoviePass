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
    $theater = null;

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

    $responses = $this->validateName($room);

    if(empty($responses)) {
      if ($this->roomDAO->Add($theater_id, $room))
        array_push($responses, new Response(true, "Sala registrada exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar sala."));
    }

    $this->ShowAddView($responses);
  }

  public function Edit()
  {
    $responses = [];

    $room = new Room(null, $_POST['name'], $_POST['seats']);

    $theater_id = $_POST['theater_id'];

    $responses = $this->validateName($room);

    if(empty($responses)) {
      if ($this->theaterDAO->Edit($theater_id, $room)) {
        return $this->ShowListView();
      } else {
        array_push($responses, new Response(false, "Error al editar cine."));
        return $this->ShowEditView($theater->getId(), $responses);
      }
    }
  }

  public function Deactivate()
  {
    $responses = [];

    if ($this->theaterDAO->Deactivate($_POST['theater_id']))
      array_push($responses, new Response(true, "Cine deshabilitado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al deshabilitar cine."));

    $this->ShowListView($responses);
  }

  public function Activate($theater_id)
  {
    $responses = [];

    if ($this->theaterDAO->Activate($_POST['theater_id']))
      array_push($responses, new Response(true, "Cine habilitado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al habilitar cine."));

    $this->ShowListView($responses);
  }

  /* VALIDATORS */

  private function validateName(Theater $theater)
  {
    $validationResponses = [];

    // Null validators
    if($theater->getName() == NULL)
      array_push($validationResponses, new Response(false, "Nombre requerido."));
    if($theater->getCapacity() == NULL)
      array_push($validationResponses, new Response(false, "Capacidad de butacas requerida."));
    if($theater->getAddress() == NULL)
      array_push($validationResponses, new Response(false, "Dirección requerida."));
    if($theater->getTicketPrice() == NULL)
      array_push($validationResponses, new Response(false, "Precio de entradasd requerido."));

    // Name exists
    $dbTheater = $this->theaterDAO->GetByName($theater->getName());
    if($dbTheater && $dbTheater->getId() != $theater->getId())
      array_push($validationResponses, new Response(false, "El nombre ingresado ya se encuentra registrado."));

    return $validationResponses;
  }
}
