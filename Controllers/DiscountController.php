<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\DiscountDAO as DiscountDAO;
use Models\Discount as Discount;

class DiscountController
{
  private $discountDAO;

  public function __construct()
  {
    $this->discountDAO = new discountDAO();
  }

  public function ShowAddView($responses = [])
  {
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    require_once(VIEWS_PATH . "/Discount/add.php");
  }

  public function ShowEditView($discount_id, $responses = [])
  {
    $discount = null;

    if(!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $discount = $this->discountDAO->GetById($discount_id);
    require_once(VIEWS_PATH . "/Discount/edit.php");
  }


  public function ShowListView($responses = [])
  {
    $discounts = array();

    if($_SESSION['user'] && $_SESSION['user']->getRole() == 'ADMIN') {
      $discounts = $this->discountDAO->GetAll();
      require_once(VIEWS_PATH . "/Discount/list.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  public function Add()
  {
    $responses = [];

    $days = '';

    foreach($_POST['days'] as $day){
        $days = $days.$day.' ';
    }

    $discount = new Discount(null, $_POST['percentaje'], $_POST['amount'], $_POST['maximum'], 
    $_POST['dateFrom'], $_POST['dateTo'], $days, $_POST['minTickets'], $_POST['description'], 1);

    $responses = $this->validateDiscount($discount);

    if(empty($responses)) {
      if ($this->discountDAO->Add($discount))
        array_push($responses, new Response(true, "Descuento registrado exitosamente."));
      else
        array_push($responses, new Response(false, "Error al registrar descuento."));
    }

    $this->ShowAddView($responses);
  }

  public function Edit()
  {
    $responses = [];

    $discount = new Discount(null, $_POST['percentaje'], $_POST['amount'], $_POST['maximum'], 
    $_POST['dateFrom'], $_POST['dateTo'], $_POST['days'], $_POST['minTickets'], $_POST['description'], $_POST['state']);

    $responses = $this->validateDiscount($discount);

    if(empty($responses)) {
      if ($this->discountDAO->Edit($discount)) {
        return $this->ShowListView();
      } else {
        array_push($responses, new Response(false, "Error al editar descuento."));
        return $this->ShowEditView($discount->getId(), $responses);
      }
    }
  }

  public function Desactivate()
  {
    $responses = [];

    if ($this->discountDAO->Desactivate($_POST['discount_id']))
      array_push($responses, new Response(true, "Descuento deshabilitado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al deshabilitar Descuento."));

    $this->ShowListView($responses);
  }

  public function Activate()
  {
    $responses = [];

    if ($this->discountDAO->Activate($_POST['discount_id']))
      array_push($responses, new Response(true, "Descuento habilitado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al habilitar descuento."));

    $this->ShowListView($responses);
  }


  public function validateDiscount($discount){
    $validationResponses = [];

    // Null validators
    if($discount->getDateTo() == NULL)
      array_push($validationResponses, new Response(false, "Fecha hasta requerida."));
    if($discount->getDateFrom() == NULL)
      array_push($validationResponses, new Response(false, "Fecha desde requerida."));
    if($discount->getDays() == NULL)
      array_push($validationResponses, new Response(false, "Dias de descuento requeridos."));
    if($discount->getMinTickets() == NULL)
    array_push($validationResponses, new Response(false, "Cantidad mínima de tickets requerida."));
    //Options validators
    if(!empty($discount->getPercentaje()) && !empty($discount->getAmount())){
        array_push($validationResponses, new Response(false, "No se puede ingresar un monto y un porcentaje a la vez."));
    }

    if(empty($discount->getPercentaje()) && empty($discount->getAmount())){
        array_push($validationResponses, new Response(false, "Debe ingresar un monto o un porcentaje."));
    }



    return $validationResponses;
  }

}

?>