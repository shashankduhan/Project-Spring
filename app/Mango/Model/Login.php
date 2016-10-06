<?php

namespace Mango\Model;

class Login extends Model{

  public $userId;

  public function __construct($dbRef){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT `id` FROM users WHERE `email` = '$email' AND `password` = '$password' ;";

    $result = $this->fetch($dbRef, $query);

    if($this->rowCount == 1) $this->userId = $result[0]['id'];
    else $this->userId = 0;
  }
}
