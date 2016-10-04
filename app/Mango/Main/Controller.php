<?php namespace Mango\Main;

class Controller
{

  protected $loginStatus;

  public function __construct()
  {
    session_start();
    if(isset($_SESSION['uid'])) ? $loginStatus = true : $loginStatus = false;

  }


  public function model($model = ""){

    if(file_exists("../Model/$model")){

      use Mango\Model\{$model} as {$model};

      return new {$model};
    }

  }

  public function view($view, $data = []){
    if(file_exists("../view/$view")){

      use Mango\View\{$view} as {$view};

      return new {$model}($data);
    }

  }




  public function __destruct()
  {
    session_destroy();
  }
}
