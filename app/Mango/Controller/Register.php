<?php


use Mango\Main\Controller as Controller;

class Register extends Controller
{

  public function __construct(){
    parent::__construct();

  }

  public function index($extraRequest){
    $valid = validatePathDepth($extraRequest);

    if($valid){
      echo "data";


    }else{
      //echo 404
      echo 404;
    }

  }


  public validatePathDepth($extraPath, $method){
    $maxDepth = ['index' => 1, 'new' => 0];

    $validity = (count($extraPath) <= $maxDepth[$method]) ? true : false;

    return $validity;
  }
}
