<?php

namespace Mango\Model;

class FetchAccountTypes extends Model
{

  public $accountTypes;
  public $noOfTypes;

  public function __construct($dbRef)
  {

    $uid = $_SESSION['userId'];

    $query = "SELECT *  FROM account_type ;";

    $this->accountTypes = $this->fetch($dbRef, $query);
    $this->noOftypes = $this->rowCount;
  }

}
