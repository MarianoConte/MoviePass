<?php

namespace DAO;

use Models\Ticket as Ticket;

interface ITicketDAO
{
  function GetByUserId($userId);
  function Add(Ticket $theater);
  function CountTicketsFromFunction($function_id);
}