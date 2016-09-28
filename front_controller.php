<?php
  require("arguments.php");
  //Our front controller to handle all types of requests by parsing the url string.

  //*************
  //****Parse url
  //************

  if($hostname == $_SERVER["HTTP_HOST"]){//If hostname doesn't match --- Don't allow

    $url = "http://$hostname".$_SERVER["REQUEST_URI"];
    var_dump(rtrim($_SERVER["REQUEST_URI"]));
    var_dump($_SERVER["REQUEST_URI"]);
    $url = parse_url($url);
    $path = $url["path"];
    if(isset($url["query"])){
      $query = $url["query"];
    }
    $pathDepth = explode("/", $path);
    var_dump($pathDepth);
    var_dump(array_map(" ",$pathDepth));
    if(count($pathDepth) == 1){
      //Display the index.........................
      ////-------------
      echo "This is Index";
    }else if(count($pathDepth)  == 2){
      //Our immidiate actions
      echo "Asking for $pathDepth[1]";
    }else if(count($pathDepth) == 3){
      echo "Asking for $pathDepth[2] in $pathDepth[1]";
    }else{
      //-----------------404 Not fann_num_output_train_data
      //Make an 404 Exception View
      echo 404;
    }
  }
