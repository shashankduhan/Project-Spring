<?php

use Mango\Main\Controller as Controller;
use Mango\Model\Connection as Connection;
use Mango\Main\ErrorException as ErrorException;
use Mango\Model\UserInfo as UserInfo;

class DashBoard extends Controller
{

  public function index()
  {
    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid && !$this->loginStatus)
    {
      $model  = $this->model('UserInfo');
      $userData = $model->userData;

      $this->view('DashBoard', $userData);

    }else{
      if($this->loginStatus)
      {
        header("Location: .");
      }else
      {
        throw new ErrorException("File Not Found");
      }
    }

  }
}
