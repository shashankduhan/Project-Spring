<?php

use Toolshed\Main\Router as Application;
use Toolshed\Main\ErrorException as ErrorException;

//This is our autoloader file path | psr-4
require_once '../app/start.php';


try{
  $app = new Application();
}catch(ErrorException $e){
  echo $e->showError();
}
