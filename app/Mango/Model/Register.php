<?php

namespace Mango\Model;

class Register extends Model{

  public $userId;
  public $dbRef;

  public function __construct($dbRef){
    $this->dbRef = $dbRef;
    $email = $_POST['email'];
    //Hash password to make it secure
    $password = $_POST['password'];

    $query = "INSERT INTO `users` VALUES (NULL, NULL,'$password', '$email')";

    $result = $this->set($dbRef, $query);
    if($result){
      $this->userId = $dbRef->insert_id;
    }else{
      $this->userId = 0;
    }

  }


}
