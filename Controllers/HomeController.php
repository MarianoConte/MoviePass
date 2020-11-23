<?php
namespace Controllers;

use DAO\Database\Response;
use DAO\TicketDAO as TicketDAO;
use DAO\ShowDAO as ShowDAO;
use DAO\TheaterDAO as TheaterDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\MovieDAO as MovieDAO;

use Models\Ticket as Ticket;

class HomeController {
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
    require_once(VIEWS_PATH."/Home/index.php");
  }

  public function ShowMovieDetails($movie_id) {
    $movie = $this->movieDAO->getMovieOnLocalDBById($movie_id);

    $data = $this->showDAO->GetByMovie($movie_id);

    $shows = array_filter($data, function($show){
      date_default_timezone_set(TIME_ZONE);
      $showDate = date("d/m/Y H:i", strtotime($show->getDate()));
      $currentDate = date("d/m/Y H:i",time());
      return ($currentDate > $showDate) ? false : true; 
    });
    require_once(VIEWS_PATH."/Home/movie_details.php");
  }

  public function ShowBuyTickets($show_id, $responses = []) {
    $show = $this->showDAO->GetById($show_id);
    $show->setTheater($this->theaterDAO->GetById($show->getTheater()));
    $show->setRoom($this->roomDAO->GetById($show->getRoom()));
    $show->setMovie($this->movieDAO->getMovieOnLocalDBById($show->getMovie()));

    require_once(VIEWS_PATH."/Home/buy_tickets.php");
  }

  public function ShowUserTickets($responses = []) {
    if ($_SESSION['user'] && $_SESSION['user']->getRole() == 'CUSTOMER') {
      $tickets = $this->ticketDAO->GetByUserId($_SESSION['user']->getId());
      require_once(VIEWS_PATH."/Home/user_tickets.php");
    } else {
      return header('Location: ' . FRONT_ROOT);
    }
  }

  public function ShowSalesView(){
    $responses = [];
    if (!$_SESSION['user'] || $_SESSION['user']->getRole() != 'ADMIN')
    return header('Location: ' . FRONT_ROOT);

    $theaters = $this->theaterDAO->GetAll();
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $tickets = $this->ticketDAO->GetAll();
    require_once(VIEWS_PATH . '/Home/sales.php');
  }

  /* CONTROLLER METHODS */

  public function SearchSales(){
    $movie = ($_POST['movie']) ? $_POST['movie'] : '';
    $theater = ($_POST['theater']) ? $_POST['theater'] : '';
    $desde = ($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
    $hasta = ($_POST['dateTo']) ? $_POST['dateTo'] : null;
    
    $tickets = array();

    if($movie != ''){
      if($theater!=''){
        $tickets = $this->ticketDAO->GetByTheater($theater, $desde, $hasta);
      }else{
        $tickets = $this->ticketDAO->GetByMovie($movie, $desde, $hasta);
      }
    }else if($theater != ''){
      $tickets = $this->ticketDAO->GetByTheater($theater, $desde, $hasta);
    }else{
      $tickets = $this->ticketDAO->GetAll($desde, $hasta);
    }
  }

  public function BuyTickets() {
    $responses = [];
    $error = false;

    if(isset($_POST['show_id']) && isset($_POST['quantity']) && $_POST['quantity'] > 0) {
      $show = $this->showDAO->GetById($_POST['show_id']);
      $show->setTheater($this->theaterDAO->GetById($show->getTheater()));
      $show->setRoom($this->roomDAO->GetById($show->getRoom()));
      $show->setMovie($this->movieDAO->getMovieOnLocalDBById($show->getMovie()));

      for($i = 0; $i < $_POST['quantity'] && !$error; $i++) {
        $ticket = new Ticket(null, null, $_SESSION['user']->getId(), $_POST['show_id']);
        if(!$this->ticketDAO->Add($ticket))
          $error = true;
      }

      if(!$error) {
        array_push($responses, new Response(true, "Entradas compradas exitosamente."));
        
        // enviar al mail
        $this->sendMail($_SESSION['user']->getEmail(), $ticket);

        $this->ShowUserTickets($responses);
      }
      else {
        array_push($responses, new Response(false, "Error al comprar entradas."));
        $this->ShowBuyTickets($_POST['show_id'], $responses);
      }
    }
  }

  /* HELPERS */
  
  private function getActiveMovies() {
    $movies = $this->movieDAO->getMoviesOnLocalDB();
    $activeMovies = array();

    foreach($movies as $movie) {
      if(!empty($this->showDAO->GetByMovie($movie->getId()))) {
        array_push($activeMovies, $movie);
      }
    }

    return array_slice($activeMovies, 0, 4);
  }

  private function sendMail($email, $ticket){
    //mail($email, 'titulo', 'holamundo');
  }
}
