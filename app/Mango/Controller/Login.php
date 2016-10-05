<?php

use Mango\Main\Controller as Controller;

class Login extends Controller
{

  public function __construct(){
    parent::__construct();


  }

  public function index($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid){
      $this->view("Login");

    }else{
      throw new ErrorException("File Not Found");
    }
  }

  public function go($extraRequest){

    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid){
      echo "Logging In";

    }else{
      throw new ErrorException("File Not Found");
    }

  }




}
