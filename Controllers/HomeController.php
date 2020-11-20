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
    $shows = $this->showDAO->GetByMovie($movie_id);
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

  /* CONTROLLER METHODS */

  public function BuyTickets() {
    $responses = [];
    $error = false;

    if(isset($_POST['show_id']) && isset($_POST['quantity']) && $_POST['quantity'] > 0) {
      $show = $this->showDAO->GetById($_POST['show_id']);
      $show->setTheater($this->theaterDAO->GetById($show->getTheater()));
      $show->setRoom($this->roomDAO->GetById($show->getRoom()));
      $show->setMovie($this->movieDAO->getMovieOnLocalDBById($show->getMovie()));

      for($i = 0; $i < $_POST['quantity'] && !$error; $i++) {
        if(!$this->ticketDAO->Add(new Ticket(null, null, $_SESSION['user']->getId(), $_POST['show_id'])))
          $error = true;
      }

      if(!$error) {
        array_push($responses, new Response(true, "Entradas compradas exitosamente."));
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
}
