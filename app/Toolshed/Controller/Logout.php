<?php

use Toolshed\Main\Controller as Controller;

class Logout extends Controller
{

  public function index()
  {
    if(isset($_SESSION['userId'])){
      
      session_destroy();
      $this->loginStatus = false;
   }

    $this->view('index');
  }

}
