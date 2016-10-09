<?php

namespace Mango\Model;

class AddNewAccount extends Model
{

  public $accId;
  public $dbRef;

  public function __construct($dbRef)
  {
    $this->dbRef = $dbRef;
    $typeid = $_POST['typeid'];
    $initial_amount = $_POST['initial_amount'];
    $uid = $_SESSION['userId'];
    $time= time();

    $query = "INSERT INTO `user_accounts` VALUES (NULL, '$uid', '$typeid', '$initial_amount', 1, '$time')";

    $result = $this->set($dbRef, $query);
    if($result)
    {
      $this->accId = $dbRef->insert_id;
    }else
    {
      $this->accId = 0;
    }

  }


}
