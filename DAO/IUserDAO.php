<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function Add(User $user);
        function Edit(User $user);
        function Get($value = null);
    }
?>