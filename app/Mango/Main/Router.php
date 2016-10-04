<?php

namespace Mango\Main;


//This is our main Application function that handles all front controller routing
class Router
{

  private $url;
  private $hostname = "dev339.local";
  private $controller = "welcome";
  private $method = "index";
  private $params = [];
  private $result = "No Data Recieved";

  public function __construct()
  {
    $url = $this->parseUrl();
    $this->forwardController($url);

  }



  //*****************************
  //   URL Parser
  //*****************************


  public function parseUrl(){

    //Parse our url and split the requests
    $url = filter_var("http://$this->hostname".$_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);
    $url = parse_url($url);
    $path = $url["path"];
    if(isset($url["query"]))
    {
      $this->params = explode("&", $url["query"]);
    }
    $pathDepth = explode("/", $path);
    $pathDepth = array_filter($pathDepth);


    return $pathDepth;
  }

  //*****************************
  //   Forward Controller
  //*****************************


  public function forwardController($pathDepth = [])
  {

    $indexCall = (count($pathDepth) > 0 ? false : true);
    $indexExists = file_exists("../app/Mango/Controller/welcome.php") ? true : false;

    //Lets make requests case resistant
    $this->controller = ucfirst(strtolower($this->controller));

    if(!$indexCall){
      $this->controller = $pathDepth[1];
    }

    //Check if file ans class exists
    $controllerExists = file_exists("../app/Mango/Controller/".$this->controller.".php") ? true : false;
    //$ctrlClassExist = class_exists($this->controller) ? true : false;
    //echo "-".$controllerExists." - ".$ctrlClassExist."-";

    if($controllerExists){
      if(!$indexCall){
        unset($pathDepth[1]);
      }
    }else{
      switch($indexCall){
          case true:
                if($indexExists){
                  echo "include(welcome.php)";
                }else{
                  //Exception.......
                  echo "Exception: Something went wrong, File not found!";
                  exit();
                }
                break;
          case false:
                //Exception.......
                echo "Exception: Something went wrong, files not found!";
                exit();
                break;

      }
    }


    //Add our required controller class
    require_once "../app/Mango/Controller/".$this->controller.".php";

    $this->controller = new $this->controller();

    if(count($pathDepth) > 0){
      $method = $pathDepth[2];
    }

    //Check if method exists:
    if(method_exists($this->controller, $method)){

    }




  }
  //*****************************
  //   Result Callback
  //*****************************

  public function getResult(){
    return $this->result;
  }



}
