<?php

namespace Models;

class User {
  private $id;
  private $email;
  private $password;
  private $first_name;
  private $last_name;
  private $role;

  public function __construct(
    $id = null,
    $email = null,
    $password = null,
    $first_name = null,
    $last_name = null,
    $role = null
  ) {
    $this->id = $id;
    $this->email = $email;
    $this->password = $password;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->role = $role;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function setFirstName($first_name) {
    $this->first_name = $first_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function setLastName($last_name) {
    $this->last_name = $last_name;
  }

  public function getRole() {
    return $this->role;
  }

  public function setRole($role) {
    $this->role = $role;
  }
}
