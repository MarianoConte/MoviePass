<?php

namespace Controllers;

require_once  'vendor/autoload.php';

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

    $fb = new \Facebook\Facebook([
      'app_id' => '1527822080721365',
      'app_secret' => '88d94ac2e21ad7b3a0853b0d13165d03',
      'default_graph_version' => 'v9.0'
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Permisos opcionales
    $loginUrl = $helper->getLoginUrl(DOMAIN . FRONT_ROOT . '/User/FacebookLogin', $permissions);

    require_once(VIEWS_PATH . "/User/login.php");
  }

  public function FacebookLogin()
  {

    //Config de Facebook
    $fb = new \Facebook\Facebook([
      'app_id' => '1527822080721365',
      'app_secret' => '88d94ac2e21ad7b3a0853b0d13165d03',
      'default_graph_version' => 'v9.0'
    ]);


    //Helper para obtener token
    $helper = $fb->getRedirectLoginHelper();

    //Intento obtener el token
    try {
      $accessToken = $helper->getAccessToken();
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
      // Cuando Graph devuelve un error 
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      // Cuando la validación falla  
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    if (!isset($accessToken)) {
      if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
      } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
      }
      exit;
    }

    //Pido los datos
    $graph_response = $fb->get("/me?fields=first_name, last_name, email", $accessToken);

    $facebook_user_info = $graph_response->getGraphUser();

    //Si tengo el email
    if (!empty($facebook_user_info['email'])) {
      //Busca si ya está registrado
      $user = $this->getUserByEmail($facebook_user_info['email']);

      //Si está registrado lo hace session
      if (!empty($user)) {
        $user->setPassword(null);
        $_SESSION["user"] = $user;
        array_push($responses, new Response(true, "Sesión iniciada exitosamente."));
      } else {

        //Si no está registrado le genera una password aleatoria y lo registra.
        $length = 30;

        $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);

        $user = new User(null, $facebook_user_info['email'], sha1($password), $facebook_user_info['first_name'], $facebook_user_info['last_name'], "CUSTOMER");

        if ($this->userDAO->Add($user)) {
          $user->setPassword(null);
          $_SESSION["user"] = $user;
          array_push($responses, new Response(true, "Usuario registrado exitosamente."));
        } else {
          array_push($responses, new Response(false, "Error al registrar usuario."));
        }
      }
      header('Location: ' . FRONT_ROOT);
    } else {
      echo 'Error al solicitar email a la API de Facebook';
    }
    exit;
  }

  public function ShowAddView($responses = [])
  {
    require_once(VIEWS_PATH . "/User/add.php");
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

  private function getUserByEmail($email)
  {
    $user = $this->userDAO->Get($email);
    return $user;
  }
}
