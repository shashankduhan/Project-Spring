<?php


use Mango\Main\Controller as Controller;
use Mango\Model\Connection as Connection;
use Mango\Model\Register as Registration;
use Mango\Main\ErrorException as ErrorException;

class Register extends Controller
{

  public function __construct()
  {
    parent::__construct();

  }

  public function index($extraRequest)
  {
    $valid = $this->validatePathDepth($extraRequest, "index");
    if($valid && !$this->loginStatus)
    {
      $this->view("Register");

    }else
    {
      if($this->loginStatus)
      {
        header("Location: /");
      }else
      {
        throw new ErrorException("File Not Found");
      }
    }

  }

  public function go($extraRequest)
  {
    //Validation of Path requested
    $valid = $this->validatePathDepth($extraRequest, "go");

    //Dividing the conditions to improve readability
    $gotParameters = isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) ? true : false;
    //Email Validation
    if($gotParameters)
    {
      $validEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? true : false;
    }else
    {
      $validEmail  false;
    }
    //***********************
    //Sanitizing the input...
    //***********************


    if($valid && !$this->loginStatus && $gotParameters && $validEmail)
    {
      //Input Sanitization......
      $_POST['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);
      $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $_POST['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES);

      $this->dbRef = new Connection();
      $registeration = new Registration($this->dbRef->dbRef);
      $newUserId = $registeration->userId;
      if($newUserId > 0)
      {
        //User registered..
        $_SESSION['userId'] = $newUserId;
        $this->loginStatus = true;
        $result = "{status : 1, userId : $_SESSION[userId]}";
        $this->view("raw", $result);

      }else
      {
        throw new ErrorException("Something wrong happened.");
      }

    }else
    {
      if($this->loginStatus)
      {
        header("Location: /");
      }else if(!$validEmail)
      {
        $result = "{status : -1, userId : 0, error: 'Invalid Email Id'}";
        $this->view("raw", $result);
      }else
      {
        throw new ErrorException("File Not Found");
      }
    }
  }



}
