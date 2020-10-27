<?php

  namespace DAO\Database;
  
  class Response {
    private $success;
    private $message;

    public function __construct($success, $message) {
      $this->success = $success;
      $this->message = $message;
    }

    public function isSuccess() {
      return $this->success;
    }
    public function getMessage() {
      return $this->message;
    }
  }

?>