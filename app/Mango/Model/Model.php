<?php

namespace Mango\Model;

class Model
{

  public $rowCount;

  public function fetch($dbRef, $query)
  {

    if($result = $dbRef->query($query))
    {
      $this->rowCount = $result->num_rows;
    }else
    {
      throw new ErrorException('Something wrong happened.');
    }

    $table = Array();
    $n = 0;
    while($row = $result->fetch_assoc())
    {
      $table[$n] = $row;
      ++$n;
    }
    return $table;

  }

  public function set($dbRef, $query)
  {
    if($dbRef->query($query))
    {
      $result = true;
    }else
    {
      $result = false;
    }

    return $result;

  }
}
