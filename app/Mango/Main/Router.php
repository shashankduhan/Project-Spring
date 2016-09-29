<?php

namespace Mango\Main;

//This is our main Application function that handles all front controller routing
class Router{

  private $url;
  private $hostname = "dev339.local";

  private $controller = "index";
  private $method = "index";

  public function __construct(){

    $url = "http://$this->hostname".$_SERVER["REQUEST_URI"];
    $url = parse_url($url);
    $path = $url["path"];
    if(isset($url["query"])){
      $query = $url["query"];
    }
    $pathDepth = explode("/", $path);
    $pathDepth = array_filter($pathDepth);
    if(count($pathDepth) == 0){
      //Display the index.........................
      ////-------------
      echo "This is Index";
    }else if(count($pathDepth)  == 1){
      //Our immidiate actions
      echo "Asking for $pathDepth[1]";
    }else if(count($pathDepth) == 2){
      echo "Asking for $pathDepth[2] in $pathDepth[1]";
    }else{
      //-----------------404 Handling
      //Make an 404 Exception View
      echo 404;
    }
  }
}
