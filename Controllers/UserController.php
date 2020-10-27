<?php

namespace Controllers;

use DAO\Database\Response as Response;
use DAO\UserDAO as UserDAO;
use Models\User as User;

class UserController
{
  private $userDAO;

  public function __construct()
  {
    $this->userDAO = new UserDAO();
  }

  /* VIEW METHODS */

  public function ShowLoginView($responses = [])
  {
    require_once(VIEWS_PATH."/User/login.php");
  }

  public function ShowAddView($responses = [])
  {
    require_once(VIEWS_PATH."/User/add.php");
  }

  /* CONTROLLER METHODS */

  public function Login($email, $password)
  {
    $responses = [];

    $user = new User();
    $user = $this->userDAO->Get($email);

    if ($user && $user->getPassword() == sha1($password)) {
      $user->setPassword(null);
      $_SESSION["user"] = $user;

      array_push($responses, new Response(true, "Sesión iniciada exitosamente."));
      header('Location: ' . FRONT_ROOT);
    } else {
      array_push($responses, new Response(false, "Usuario y/o contraseña incorrectos. Por favor, intente nuevamente."));
      $this->ShowLoginView($responses);
    }
  }

  public function Logout()
  {
    $responses = [];
    $_SESSION['user'] = null;
    header('Location: ' . FRONT_ROOT);
  }

  public function Add($email, $password, $first_name, $last_name)
  {
    $responses = [];

    $user = new User(null, $email, sha1($password), $first_name, $last_name, "CUSTOMER");

    if ($this->userDAO->Add($user))
      array_push($responses, new Response(true, "Usuario registrado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al registrar usuario."));

    $this->ShowAddView($responses);
  }

  public function Edit($id, $email, $password, $first_name, $last_name)
  {
    $responses = [];

    $user = new User($id, $email, sha1($password), $first_name, $last_name, "CUSTOMER");

    if ($this->userDAO->Edit($user))
      array_push($responses, new Response(true, "Usuario editado exitosamente."));
    else
      array_push($responses, new Response(false, "Error al editar usuario."));

    $this->ShowAddView($responses);
  }
}
