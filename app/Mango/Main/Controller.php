<?php namespace Mango\Main;

use Mango\Model\Connection as Connection;
use Mango\Main\ErrorException as ErrorException;

class Controller
{

  protected $loginStatus;
  protected $dbRef;

  public function __construct()
  {
    session_start();
    $this->loginStatus = isset($_SESSION['userId']) ? true : false;
  }


  public function view($view, $data = []){
    if(file_exists("../app/Mango/View/$view.php")){

      require_once "../app/Mango/View/".$view.".php";


    }else{
      throw new ErrorException("File Not Found");
    }

  }

  public function validatePathDepth($extraPath, $method){
    $maxDepth = ['index' => 1, 'go' => 0, 'fetch' => 0, 'secondlevel' => 0];

    $validity = (count($extraPath) <= $maxDepth[$method]) ? 1 : 0;

    return $validity;
  }


  public function __destruct()
  {

  }
}
