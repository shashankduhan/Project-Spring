<?php

use Mango\Main\Controller as Controller;
use Mango\Main\ErrorException as ErrorException;
use Mango\Model\Connection as Connection;
use Mango\Model\FetchAccountTypes as Fetcher;
//use Mango\Model\NewUserAccounts as Adder;

class Account extends Controller
{


 public function types($extraRequest){
   $valid = $this->validatePathDepth($extraRequest, "secondlevel");


   if($valid && $this->loginStatus){

     $this->dbRef = new Connection();
     $accTypes = new Fetcher($this->dbRef->dbRef);

     $result = "{ status: 1, types: [";
       $types = "";
       foreach($accTypes->accountTypes as $type){
         //if($acc['balance'] == NULL){$acc['balance'] = 0;}
         $types .= "{id: $type[id], name: '$type[name]'},";

       }
       $result .= rtrim($types, ",");

     $result .= "]}";

     $this->view('raw', $result);

   }else{
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
