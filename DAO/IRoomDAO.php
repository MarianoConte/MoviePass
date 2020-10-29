<?php

namespace DAO;

use Models\Room as Room;

interface IRoomDAO
{
    function GetAll();
    function GetById($room_id);
    function GetByTheaterId($theater_id);
    function Add(Room $room);
    function Edit(Room $room);
    function Desactivate($room_id);
    function Activate($room_id);
}
