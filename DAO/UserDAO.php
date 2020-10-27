<?php

namespace DAO;

use DAO\Database\Database as Database;

use DAO\IUserDAO as IUserDAO;
use Models\User as User;

class UserDAO implements IUserDAO
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function Get($value = null)
  {
    $user = null;
    $dbUser = null;

    $sql = "SELECT * FROM users WHERE id='{$value}' OR email='{$value}' LIMIT 1";
    $result = $this->db->getConnection()->query($sql);

    if ($result->num_rows > 0) {
      $dbUser = $result->fetch_assoc();
      $user = new User(
        $dbUser['id'],
        $dbUser['email'],
        $dbUser['password'],
        $dbUser['first_name'],
        $dbUser['last_name'],
        $dbUser['role']
      );
    }

    return $user;
  }

  public function Add(User $user)
  {
    $sql = "INSERT INTO users(email, password, first_name, last_name, role)
    VALUES ('{$user->getEmail()}', '{$user->getPassword()}', '{$user->getFirstName()}', '{$user->getLastName()}', '{$user->getRole()}')";

    return $this->db->getConnection()->query($sql);
  }

  public function Edit(User $user)
  {
    $sql = "UPDATE users
    SET email='{$user->getEmail()}',
      password='{$user->getPassword()}',
      first_name='{$user->getFirstName()}',
      last_name='{$user->getLastName()}',
      role='{$user->getRole()}'
    WHERE id={$user->getId()}";

    return $this->db->getConnection()->query($sql);
  }
}
