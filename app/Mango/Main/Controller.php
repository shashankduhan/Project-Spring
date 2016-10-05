<?php namespace Mango\Main;

class Controller
{

  protected $loginStatus;
  protected $dbRef;

  public function __construct()
  {
    session_start();
    $this->loginStatus = isset($_SESSION['userId']) ? true : false;
  }


  public function model($model = ""){

    if(file_exists("../app/Mango/Model/$model")){

      require_once "../app/Mango/Model/".$model.".php";

      $model = new $model();

      return $model;
    }

  }

  public function view($view, $data = []){
    if(file_exists("../app/Mango/View/$view.php")){

      require_once "../app/Mango/View/".$view.".php";


    }else{
      throw new ErrorException("File Not Found");
    }

  }

  public function validatePathDepth($extraPath, $method){
    $maxDepth = ['index' => 1, 'go' => 0];

    $validity = (count($extraPath) <= $maxDepth[$method]) ? true : false;

    return $validity;
  }


  public function __destruct()
  {
    
  }
}
