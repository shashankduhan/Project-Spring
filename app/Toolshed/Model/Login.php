<?php

namespace Toolshed\Model;

class Login extends Model
{

  public $userId;

  public function __construct($dbRef)
  {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT `id`, `password` FROM customers WHERE `email` = '$email';";

    $result = $this->fetch($dbRef, $query);

    if($this->rowCount == 1)
      $this->userId = password_verify($password, $result[0]['password']) ? $result[0]['id'] : -1;
    else $this->userId = 0;
  }
}
