<?php

use Mango\Main\Router as Application;

//This is our autoloader file path | psr-4
require_once '../app/start.php';


try{
  $app = new Application();
}catch(ErrorException $e){
  echo $e->getMessage();
}
