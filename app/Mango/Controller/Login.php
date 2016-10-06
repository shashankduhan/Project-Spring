<?php

use Mango\Main\Controller as Controller;
use Mango\Model\Connection as Connection;
use Mango\Model\Login as Logger;
use Mango\Main\ErrorException as ErrorException;

class Login extends Controller
{

  public function __construct(){
    parent::__construct();


  }

  public function index($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid && !$this->loginStatus){
      $this->view("Login");

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

  public function go($extraRequest){

    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid && !$this->loginStatus){

      $this->dbRef = new Connection();
      $login = new Logger($this->dbRef->dbRef);
      $userId = $login->userId;
      if($userId > 0){
        $_SESSION['userId'] = $userId;
        $this->loginStatus = true;
        $result = "{ status : 1 , userId : $userId}";
      }else{
        $result = "{ status: 0, userId : 0}";
      }

      $this->view('raw', $result);

    }else{

      if($this->loginStatus)
      {
        header("Location: /");
      }else
      {
        throw new ErrorException("File Not Found");
      }
    }

  }




}
