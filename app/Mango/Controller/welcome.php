<?php

namespace Mango\Controller;

class Welcome extends Controller
{

  public function __construct(){


  }

  public function accounts(){

  }

  public function index(){

    if(loginStatus){
      $mName = 'dashboard';
      $model = $this->model($nName);
      $dataModel = $model->getData();
    }else{
      $nName = 'index';
      $dataModel = [];
    }

    $this->view(mName, $dataModel);

  }

}
