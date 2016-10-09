<?php

 use Mango\Main\Controller as Controller;
 use Mango\Main\ErrorException as ErrorException;
 use Mango\Model\Connection as Connection;
 use Mango\Model\FetchUserAccounts as Fetcher;
 use Mango\Model\AddNewAccount as Adder;

class UserAccount extends Controller
{

  public $innerCall = false;

  public function index($extraRequest)
  {
    $this->innerCall = true;
    $valid = $this->validatePathDepth($extraRequest, "index");


    if($valid && $this->loginStatus)
    {
      //fetch user accounts
      $this->fetch_account_details();

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

  public function fetch($extraRequest)
  {
    $this->innerCall = true;
    $valid = $this->validatePathDepth($extraRequest, "fetch");


    if($valid && $this->loginStatus)
    {
      //fetch user accounts

      $this->fetch_account_details();


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

  public function add($extraRequest)
  {
    //Validation
    $valid = $this->validatePathDepth($extraRequest, "secondlevel");
    $valid = $valid && isset($_POST['typeid']) && isset($_POST['initial_amount']) ? true : false;
    $valid = $valid && filter_var($_POST['typeid'], FILTER_VALIDATE_INT) ? true : false;
    $valid = $valid && filter_var($_POST['initial_amount'], FILTER_VALIDATE_INT) === false ? false : true;

    if($valid && $this->loginStatus)
    {

      $this->dbRef = new Connection();
      $adder = new Adder($this->dbRef->dbRef);
      $accountId = $adder->accId;

      if($accountId > 0)
      {
        $result = "{status: 1, accountId : $accountId, typeId: $_POST[typeid]}";

      }else
      {
        $result = "{status: 0}";
      }

      $this->view("raw", $result);

    }else
    {
        header("Location: /");

    }



  }

  public function fetch_account_details()
  {
    if($this->innerCall)
    {

      //-----Fetch our user's accounts
      $this->dbRef = new Connection();
      $userAccInfo = new Fetcher($this->dbRef->dbRef);

      if($userAccInfo->noOfAccounts > 0)
      {
        $result = "{ status: 1, accounts: [";
          $accounts = "";
          foreach($userAccInfo->userAccounts as $acc)
          {
            $balance = $acc['balance'] == "" ? 0 : $acc['balance'];
            $accounts .= "{id: $acc[id], type: '$acc[type]', balance: $acc[balance]},";

          }
          $result .= rtrim($accounts, ",");

        $result .= "]}";

      }else
      {
        //For readability this is defined separately.
        //It means if there is no user account related to this userId
        $result = "{status: 1, accounts: []}";
      }

      $this->view("raw", $result);




    }else
    {

      throw new ErrorException("Page doesn't exist.");
    }


  }


}
