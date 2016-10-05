<?php

use Mango\Main\Controller as Controller;

class Welcome extends Controller
{

  public function __construct(){
    parent::__construct();

  }

  public function accounts(){

  }

  public function index(){

    if($this->loginStatus){
      $mName = 'dashboard';
      $model = $this->model($nName);
      $dataModel = $model->getData();
    }else{
      $mName = 'index';
      $dataModel = [];
    }

    $this->view($mName, $dataModel);
    var_dump($this->loginStatus);
  }

}
