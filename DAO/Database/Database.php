<?php

  namespace DAO\Database;
  
  class DataBase {
    private $connection;

    public function __construct() {
      $this->connection = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE_NAME);
      if ($this->connection->connect_error) {
        die("Error de conexión: " . $this->connection->connect_error);
      }
    }

    public function getConnection() {
      return $this->connection;
    }
  }

?>