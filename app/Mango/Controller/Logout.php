<?php

use Mango\Main\Controller as Controller;

class Logout extends Controller
{

  public function index()
  {
    if(isset($_SESSION['userId'])){
      setcookie("userid", $_SESSION['userId'], time()-3600, "/");
      session_destroy();
      $this->loginStatus = false;
   }

    $this->view('index');
  }

}
