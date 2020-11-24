<?php

namespace Controllers;

use DAO\Database\Response;
use DAO\TicketDAO as TicketDAO;
use DAO\ShowDAO as ShowDAO;
use DAO\TheaterDAO as TheaterDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\MovieDAO as MovieDAO;

use Models\Ticket as Ticket;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use QRcode;

require 'vendor/phpqrcode/phpqrcode.php';
require 'vendor/PHPMailer/PHPMailer.php';
require 'vendor/PHPMailer/SMTP.php';
require 'vendor/PHPMailer/Exception.php';
require 'vendor/PHPMailer/OAuth.php';

class HomeController
{
  private $ticketDAO;
  private $showDAO;
  private $theaterDAO;
  private $roomDAO;
  private $movieDAO;

  public function __construct()
  {
    $this->ticketDAO = new TicketDAO();
    $this->showDAO = new ShowDAO();
    $this->theaterDAO = new TheaterDAO();
    $this->roomDAO = new RoomDAO();
    $this->movieDAO = new MovieDAO();
  }

  /* VIEW METHODS */

  public function index($message = "")
  {
    $movies = $this->getActiveMovies();
    require_once(VIEWS_PATH . "/Home/index.php");
  }

  public function ShowMovieDetails($movie_id)
  {
    $movie = $this->movieDAO->getMovieOnLocalDBById($movie_id);

    $shows = $this->showDAO->GetByMovie($movie_id);

    require_once(VIEWS_PATH . "/Home/movie_details.php");
  }

  public function ShowBuyTickets($show_id, $responses = [])
  {
    $show = $this->showDAO->GetById($show_id);
    $show->setTheater($this->theaterDAO->GetById($show->getTheater()));
    $show->setRoom($this->roomDAO->GetById($show->getRoom()));
    $show->setMovie($this->movieDAO->getMovieOnLocalDBById($show->getMovie()));

    require_once(VIEWS_PATH . "/Home/buy_tickets.php");
  }

  public function ShowUserTickets($responses = [])
  {
    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'CUSTOMER') {
      $tickets = $this->ticketDAO->GetByUserId($_SESSION['user']->getId());
      require_once(VIEWS_PATH . "/Home/user_tickets.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  public function ShowSalesView()
  {
    $responses = [];
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
      return header('Location: ' . FRONT_ROOT);

    $theaters = $this->theaterDAO->GetAll();
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $tickets = $this->ticketDAO->GetAll();
    require_once(VIEWS_PATH . '/Home/sales.php');
  }

  /* CONTROLLER METHODS */

  public function SearchSales()
  {
    $tickets = $this->ticketDAO->GetByFilters($_POST['theater'], $_POST['movie'], $_POST['dateFrom'], $_POST['dateTo']);
  }

  public function BuyTickets()
  {
    $responses = [];
    $error = false;

    if (isset($_POST['show_id']) && isset($_POST['quantity']) && $_POST['quantity'] > 0) {
      $show = $this->showDAO->GetById($_POST['show_id']);
      $show->setTheater($this->theaterDAO->GetById($show->getTheater()));
      $show->setRoom($this->roomDAO->GetById($show->getRoom()));
      $show->setMovie($this->movieDAO->getMovieOnLocalDBById($show->getMovie()));

      for ($i = 0; $i < $_POST['quantity'] && !$error; $i++) {
        $newTicketId = $this->ticketDAO->Add(new Ticket(null, null, $_SESSION['user']->getId(), $_POST['show_id']));

        if ($newTicketId) {
          $this->SendEmail($_SESSION['user']->getEmail(), md5($newTicketId), $show);
        } else {
          $error = true;
        }
      }

      if (!$error) {
        array_push($responses, new Response(true, "Entradas compradas exitosamente."));
        $this->ShowUserTickets($responses);
      } else {
        array_push($responses, new Response(false, "Error al comprar entradas."));
        $this->ShowBuyTickets($_POST['show_id'], $responses);
      }
    }
  }

  private function SendEmail($email, $token, $show)
  {
    QRcode::png($token, 'Views/Assets/img/qr_temp/' . $token . '.png', QR_ECLEVEL_L, 10);
    $tokenQRCode = 'data:image/png;base64,' . base64_encode(file_get_contents('Views/Assets/img/qr_temp/' . $token . '.png'));
    $mail = new PHPMailer(true);
    try {
      //Server settings
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'usuario@gmail.com';
      $mail->Password = 'password';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      // Recipients
      $mail->setFrom('usuario@gmail.com', "MoviePass");
      $mail->addAddress($email, 'Contacto');
      // Content
      $mail->isHTML(true);
      $mail->Subject = "MoviePass - Reserva de asiento";
      $mail->Body = "<h4>Película: " . $show->getMovie()->getName() . "<h4>
      <h4>Cine: " . $show->getTheater()->getName() . "</h4>
      <h4>Fecha y horario: " . date("d/m/Y H:i", strtotime($show->getDate())) . "</h4>
      <h4>Dirección: " . $show->getTheater()->getAddress() . "</h4>
      <h4>Sala: " . $show->getRoom()->getName() . "</h4>";
      $mail->addAttachment('Views/Assets/img/qr_temp/' . $token . '.png', 'new.png');

      if ($mail->send())
        return true;
      else
        return false;
    } catch (Exception $e) {
      return false;
    }
  }

  /* HELPERS */

  private function getActiveMovies()
  {
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $activeMovies = array();

    foreach ($movies as $movie) {
      if (!empty($this->showDAO->GetByMovie($movie->getId()))) {
        array_push($activeMovies, $movie);
      }
    }

    return array_slice($activeMovies, 0, 4);
  }
}
