<?php


use Mango\Main\Controller as Controller;
use Mango\Model\Connection as Connection;
use Mango\Model\Register as Registration;
use Mango\Main\ErrorException as ErrorException;

class Register extends Controller
{

  public function __construct(){
    parent::__construct();

  }

  public function index($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");
    if($valid && !$this->loginStatus){
      $this->view("Register");

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
      $registeration = new Registration($this->dbRef->dbRef);
      $newUserId = $registeration->userId;
      if($newUserId > 0){
        //User registered..
        $_SESSION['userId'] = $newUserId;
        $this->loginStatus = true;
        $result = "{status : 1, userId : $_SESSION[userId]}";
        $this->view("raw", $result);

      }else{
        throw new ErrorException("Something wrong happened.");
      }

    }else{
      throw new ErrorException("File Not Found");
    }
  }



}
