<?php

namespace Toolshed\Model;

class Register extends Model
{

  public $userId;
  public $dbRef;

  public function __construct($dbRef)
  {
    $this->dbRef = $dbRef;
    $email = $_POST['email'];
    $name = $_POST['name'];
    $time = time();
    //Hash password to make it secure
    $password = $_POST['password'];
    $options = [ 'cost' => 10];
    $password = password_hash($password, PASSWORD_BCRYPT, $options);

    $query = "INSERT INTO `customers` VALUES (NULL, '$name', '$password', '$email', '$time')";

    $result = $this->set($dbRef, $query);
    if($result)
    {
      $this->userId = $dbRef->insert_id;
    }else
    {
      $this->userId = 0;
    }

  }


}
