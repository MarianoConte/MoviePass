<?php

namespace DAO;

use Models\Theater as Theater;

interface ITheaterDAO
{
  function GetAll();
  function GetById($theater_id);
  function GetByName($theater_name);
  function Add(Theater $theater);
  function Edit(Theater $theater);
  function Desactivate($theater_id);
  function Activate($theater_id);
}
