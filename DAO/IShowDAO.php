<?php

namespace DAO;

use Models\Show as Show;

interface IShowDAO
{
    function GetAll();
   // function GetByTheaterAndRoom($theater, $room);
    function CheckShowHour($theater, $room, $date ,$duration, $show_id);
    function GetById($show_id);
    function Add(Show $show);
    function Edit(Show $show);
}