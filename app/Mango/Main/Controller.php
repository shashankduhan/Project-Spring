<?php namespace Mango\Main;

class Controller
{

  protected $loginStatus;

  public function __construct()
  {
    session_start();
    $loginStatus = isset($_SESSION['uid']) ? true : false;
  }


  public function model($model = ""){

    if(file_exists("../app/Mango/Model/$model")){

      require_once "../app/Mango/Controller/".$model.".php";

      $model = new $model();

      return $model;
    }

  }

  public function view($view, $data = []){
    if(file_exists("../app/Mango/View/$view")){

      require_once "../app/Mango/Controller/".$view.".php";

      $view = new $view();

    }

  }




  public function __destruct()
  {
    session_destroy();
  }
}
