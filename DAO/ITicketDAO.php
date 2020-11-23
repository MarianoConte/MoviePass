<?php

namespace DAO;

use Models\Ticket as Ticket;

interface ITicketDAO
{
  function GetAll($from = null, $to = null);
  function GetByUserId($userId);
  function GetByMovie($movie, $from = null, $to = null);
  function GetByTheater($theater, $from = null, $to = null);
  function Add(Ticket $theater);
  function CountTicketsFromFunction($function_id);
}