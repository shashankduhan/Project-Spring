<?php

namespace Mango\Model;

class FetchUserAccounts extends Model
{

  public $userAccounts;
  public $noOfAccounts;

  public function __construct($dbRef)
  {

    $uid = $_SESSION['userId'];

    $query = "SELECT user_accounts.id, account_type.name AS type, balance  FROM user_accounts INNER JOIN account_type ON user_accounts.typeid = account_type.id WHERE status = 1 AND
 user_accounts.uid =  '$uid' ORDER BY user_accounts.id ASC;";

    $this->userAccounts = $this->fetch($dbRef, $query);
    $this->noOfAccounts = $this->rowCount;
  }

}
