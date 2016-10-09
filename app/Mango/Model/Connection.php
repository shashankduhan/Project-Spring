<?php

namespace Mango\Model;

class Connection
{
  public $dbRef;
  public function __construct()
  {
    $hostname = "localhost";
    $user = "root";
    $pass = "root";
    $db = "a2";
    $port = 3306;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $this->dbRef = new \mysqli($hostname, $user, $pass, $db, $port);

    if ($this->dbRef->connect_errno)
    {
      throw new ErrorException("Problem with Database: ".$this->dbRef->connect_error);
    }else
    {

      /*$data = $this->dbRef->query("show databases;");

      while($row = $data->fetch_assoc())
      {
        echo $row[0];
      }
      return $this->dbRef;*/
    }
  }

  public function __destruct()
  {
    $this->dbRef->close();

  }
}
