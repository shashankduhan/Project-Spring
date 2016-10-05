<?php

namespace Mango\Model;

class Model
{


  public function fetch($query){

    $result = $this->dbRef->query($query);

    $table = Array();
    $n = 0;
    while($row = $result->fetch_assoc()){
      $table[$n] = $row;
      ++$n;
    }
    return $table;

  }

  public function set($dbRef, $query){
    if($dbRef->query($query)){
      $result = true;
    }else{
      $result = false;
    }

    return $result;

  }
}
