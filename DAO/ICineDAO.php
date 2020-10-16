<?php
    namespace DAO;

    use Models\Cine as Cine;

    interface ICineDAO
    {
        function Add(Cine $cine);
        function Mod(Cine $cine);
        function getById(int $id);
        function GetAll();
        function lastId();
    }
?>