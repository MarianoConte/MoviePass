<?php

namespace DAO;

use DAO\Database\Database as Database;
use DAO\ITicketDAO as ITicketDAO;
use Models\Movie;
use Models\Room;
use Models\User as User;
use Models\Show as Show;
use Models\Theater;
use Models\Ticket;

class TicketDAO implements ITicketDAO
{
  private $db;
  private $showDAO;

  public function __construct()
  {
    $this->db = new Database();
    $this->showDAO = new ShowDAO();
  }

  public function GetByUserId($userId)
  {
    $tickets = array();

    $sql = "SELECT
            ticket.id as id, ticket.token as token, ticket.date as date,
            f.id as function_id, f.price as function_price, f.date as function_date,
            t.name as theater_name, t.address as theater_address,
            r.name as theater_room_name, r.seats as theater_room_seats,
            m.name as movie_name, m.description as movie_description, m.genre as movie_genre, m.duration as movie_duration, m.image as movie_image
            FROM tickets ticket
            INNER JOIN functions f on ticket.function_id = f.id
            INNER JOIN theaters t on f.theater_id = t.id
            INNER JOIN theater_rooms r on f.theater_room_id = r.id
            INNER JOIN movies m on f.movie_id = m.id
            WHERE ticket.user_id = $userId
            ORDER BY ticket.id DESC";

    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      while ($dbTicket = $result->fetch_assoc()) {
        array_push(
          $tickets,
          new Ticket(
            $dbTicket['id'],
            $dbTicket['token'],
            null,
            new Show(
              $dbTicket['function_id'],
              new Movie(null, null, $dbTicket['movie_name'], $dbTicket['movie_description'], $dbTicket['movie_genre'], $dbTicket['movie_duration'], $dbTicket['movie_image']),
              new Theater(null, $dbTicket['theater_name'], $dbTicket['theater_address']),
              new Room(null, null, $dbTicket['theater_room_name'], $dbTicket['theater_room_seats']),
              $dbTicket['function_price'],
              $dbTicket['function_date']
            ),
            $dbTicket['date']
          )
        );
      }
    }

    return $tickets;
  }

  public function Add(Ticket $ticket)
  {
    $sql = "INSERT INTO tickets(token, user_id, function_id)
    SELECT MD5(COALESCE(MAX(id), 0) + 1), '{$ticket->getUser()}', '{$ticket->getShow()}' FROM tickets";

    return $this->db->getConnection()->query($sql);
  }
}
