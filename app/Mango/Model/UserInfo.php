<?php

namespace Mango\Model;

class UserInfo extends Model
{

  public $userId;
  public $dbRef;
  public $userData;

  public function __construct($dbRef)
  {
    $this->dbRef = $dbRef;
    $this->userId = $_SESSION['userId'];
    $query  = "SELECT `name` FROM users where `id` = $this->userId ;";

    $this->userData = $this->fetch($this->dbRef, $query);
  }


}
