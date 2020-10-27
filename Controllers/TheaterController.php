<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\TheaterDAO as TheaterDAO;
use Models\Theater as Theater;

class TheaterController
{
  private $theaterDAO;

  public function __construct()
  {
    $this->theaterDAO = new TheaterDAO();
  }

  /* VIEW METHODS */

  public function ShowAddView($responses = [])
  {
    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    require_once(VIEWS_PATH . "/Theater/add.php");
  }

  public function ShowEditView($theater_id, $responses = [])
  {
    $theater = null;

    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $theater = $this->theaterDAO->GetById($theater_id);
    require_once(VIEWS_PATH . "/Theater/edit.php");
  }

  public function ShowListView($responses = [])
  {
    $theaters = array();

    if($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $theaters = $this->theaterDAO->GetAll();
      require_once(VIEWS_PATH . "/Theater/list.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  /* CONTROLLER METHODS */

  public function Add()
  {
    $responses = [];

    $theater = new Theater(null, $_POST['name'], $_POST['capacity'], $_POST['address'], $_POST['ticket_price']);

    $responses = $this->validateName($theater);

    if(empty($responses)) {
      if ($this->theaterDAO->Add($theater))
        array_push($responses, new Response(true, "Cine registrado exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar cine."));
    }

    $this->ShowAddView($responses);
  }

  public function Edit()
  {
    $responses = [];

    $theater = new Theater($_POST['id'], $_POST['name'], $_POST['capacity'], $_POST['address'], $_POST['ticket_price']);

    $responses = $this->validateName($theater);

    if(empty($responses)) {
      if ($this->theaterDAO->Edit($theater)) {
        return header('Location: ' . FRONT_ROOT."/Theater/ShowListView");
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
