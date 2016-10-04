<?php


use Mango\Main\Controller as Controller;

class Register extends Controller
{

  public function __construct(){
    parent::__construct();

  }

  public function index($extraRequest){
    $valid = $this->validatePathDepth($extraRequest, "index");

    if($valid){
      echo "View not set";
      $this->view("Register");

    }else{
      //echo 404
      echo 404;
    }

  }

  public function newOne(){
    echo "oops";
  }


  public function validatePathDepth($extraPath, $method){
    $maxDepth = ['index' => 1, 'new' => 0];

    $validity = (count($extraPath) <= $maxDepth[$method]) ? true : false;

    return $validity;
  }
}
