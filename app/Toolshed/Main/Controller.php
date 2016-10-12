<?php namespace Toolshed\Main;

use Toolshed\Model\Connection as Connection;
use Toolshed\Main\ErrorException as ErrorException;

class Controller
{

  protected $loginStatus = false;
  protected $dbRef;
  protected $cookieLifetime = 8000*3600;

  public function __construct()
  {
    session_start();
    $this->loginStatus = isset($_SESSION['userId']) ? true : false;


    if(isset($_COOKIE['userid']) && !$this->loginStatus){
      //This functionality seems correct but not working properly..
      //Please give me review what wrong I am doing.
      //Uncomment it to see persistence

      $_SESSION['userId'] == $_COOKIE['userid'];
      $this->loginStatus = true;


      //
    }




  }


  public function view($view, $data = [])
  {
    if(file_exists("../app/Toolshed/View/$view.php"))
    {

      require_once "../app/Toolshed/View/".$view.".php";


    }else
    {
      throw new ErrorException("File Not Found");
    }

  }

  public function validatePathDepth($extraPath, $method)
  {
    $maxDepth = ['index' => 1, 'go' => 0, 'fetch' => 0, 'secondlevel' => 0];

    $validity = (count($extraPath) <= $maxDepth[$method]) ? 1 : 0;

    return $validity;
  }


  public function __destruct()
  {
    //if($this->dbRef != null) $this->dbRef->close();
  }
}
