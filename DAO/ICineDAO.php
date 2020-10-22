<?php

namespace DAO;

use Models\Cine as Cine;

interface ICineDAO
{
  function Add(Cine $cine);
  function Mod(Cine $cine);
  function Delete(int $id);
  function Activate(int $id);
  function getById(int $id);
  function getByName(string $name);
  function GetAll();
  function lastId();
}
