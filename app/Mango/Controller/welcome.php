<?php

use Mango\Main\Controller as Controller;
use Mango\Model\UserInfo as UserInfo;
use Mango\Model\Connection as Connection;
use Mango\Main\ErrorException as ErrorException;

class Welcome extends Controller
{

  public function __construct()
  {
    parent::__construct();

  }

  public function accounts()
  {

  }

  public function index()
  {

    if($this->loginStatus)
    {
      $mName = 'dashboard';
      $this->dbRef = new Connection();
      $model  = new UserInfo($this->dbRef->dbRef);
      $dataModel = $model->userData;
    }else
    {
      $mName = 'index';
      $dataModel = [];
    }

    $this->view($mName, $dataModel);
  }

}
