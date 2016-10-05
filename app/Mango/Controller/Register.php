<?php


use Mango\Main\Controller as Controller;
use Mango\Model\Connection as Connection;
use Mango\Model\Register as Registration;

class Register extends Controller
{

  public function __construct(){
    parent::__construct();

  }

  public function index($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");
    if($valid){
      $this->view("Register");

    }else{
      throw new ErrorException("File Not Found");
    }

  }

  public function go($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid){

      $this->dbRef = new Connection();
      $registeration = new Registration($this->dbRef->dbRef);
      $newUserId = $registeration->userId;
      if($newUserId > 0){
        //User registered..
        $_SESSION['userId'] = $newUserId;
        $this->loginStatus = true;
        echo "Welcome ".$_POST['email']." UID: ".$_SESSION['userId'];
        //Only send json data with result_status & userid

      }else{
        throw new ErrorException("Something wrong happened.");
      }

    }else{
      throw new ErrorException("File Not Found");
    }
  }



}
