<?php

use Mango\Main\Controller as Controller;
use Mango\Main\ErrorException as ErrorException;
use Mango\Model\Connection as Connection;
use Mango\Model\FetchAccountTypes as Fetcher;


class Account extends Controller
{


 public function types($extraRequest)
 {//Basic Validation of url path depth
   $valid = $this->validatePathDepth($extraRequest, "secondlevel");


   if($valid && $this->loginStatus)
   {

     $this->dbRef = new Connection();
     $accTypes = new Fetcher($this->dbRef->dbRef);

     $result = "{ status: 1, types: [";
       $types = "";
       foreach($accTypes->accountTypes as $type)
       {
         $types .= "{id: $type[id], name: '$type[name]'},";

       }
       $result .= rtrim($types, ",");

     $result .= "]}";

     $this->view('raw', $result);

   }else
   {
     if(!$this->loginStatus)
     {
       header("Location: /");
     }else
     {
       throw new ErrorException("File Not Found");
     }

   }
  }
 }
