<?php

use Mango\Main\Router as Application;
use Mango\Main\ErrorException as ErrorException;

//This is our autoloader file path | psr-4
require_once '../app/start.php';


try{
  $app = new Application();
}catch(ErrorException $e){
  echo $e->showError();
}
