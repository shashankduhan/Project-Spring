<?php

namespace Mango\Main;

class ErrorException extends \Exception
{
  protected $message;

  public function __construct($message, $code = 0, Exception $previous = null)
  {
    $this->message = $message;
    parent::__construct($message, $code, $previous);
  }

  // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function showError()
    {

      require_once "../app/Mango/View/Error.php";
    }
}
