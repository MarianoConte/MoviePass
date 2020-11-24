<?php

namespace DAO;

use Models\Ticket as Ticket;

interface ITicketDAO
{
  function GetAll($from = null, $to = null);
  function GetByUserId($userId);
  function GetByFilters($theaterId, $movieId, $dateFrom, $dateTo);
  function Add(Ticket $ticket);
  function CountTicketsFromFunction($function_id);
}