<?php

use Mango\Main\Controller as Controller;

class Logout extends Controller
{

  public function index(){


    session_destroy();

    $this->view('index');
  }

}
