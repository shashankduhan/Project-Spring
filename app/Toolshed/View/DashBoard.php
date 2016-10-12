<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>First National Bank</title>
    <link rel="stylesheet" href="/index/repo/master.css" type="text/css">
    <style type="text/css">
    #logout{
      padding:12px 12px;
      background:#eee;
      border-radius: 8px;
      display:inline-block;
      margin:4px;
      float:right;
      margin:25px;}
      

    .newButton{
      background:#336699;
      padding:4px 12px;
      display:inline-block;
      border-radius:6px;
      color:#fff;
      cursor:pointer;
      text-decoration:none;
    }
    input{
      margin:12px;
    }
    .formHeader{
      margin:0 0 25px;
      border-bottom:1px solid #ccc;
      padding:12px;
    }
    .formBox{
      background:#fff;
      padding:0;
      border:1px solid #ddd;
      position:fixed;
      top:120px;
      margin:0 auto;
      left:0;
      right:0;
      width:400px;
      z-index:1000;
      display:none;
    }
    .curtain{
      background:rgba(1, 1, 1, 0.6);
      position:fixed;
      left:0;
      right:0;
      top:0;
      bottom: 0;
      z-index:2;
      display:none;
      author:shashank duhan;
    }
    .notice{
      background:#fff;
      color:#bb7e7e;
    }

    </style>
    <script src="index/repo/library.js" charset="utf-8"></script>
    <script type="text/javascript">
      var dash = {};
      dash.activePopUp;

      dash.fetcher = function(request){

        new ajax.request(request.url, {method: "POST", parameters: request.params, onSuccess : function(r){
          if(typeof request.log != 'undefined'){
            console.log(r);
          }
          try{
            r = eval("("+r+")");
          }catch(e){
            r = {status : 0};
          }

          if(r.status){
            new request.onSuccess(r);
          }else{
            new request.onFailure();
          }

        }, onCreate : function(){
          new request.onCreate();
        }});


      }

      //************
      //Account Loader Configuration
      //************
      dash.accountLoader = {};
      //dash.accountLoader.log = true;
      dash.accountLoader.url = "/useraccount/fetch";
      dash.accountLoader.params = "";
      dash.accountLoader.onSuccess = function(result){
        empty('account_table_indicator');
        var r = result;
        if(r.accounts.length == 0){
          x('account_table_indicator').innerHTML = "You don't have any accounts yet.";

        }else{
          for(i=0; i< r.accounts.length ; i++){
            var row = document.createElement('tr');
            var idCol = document.createElement('td');
            var typeCol = document.createElement('td');
            var balCol = document.createElement('td');
            var statCol = document.createElement('td');

            idCol.innerHTML = r.accounts[i].id;
            typeCol.innerHTML = r.accounts[i].type;
            balCol.innerHTML = r.accounts[i].balance;
            statCol.innerHTML = "Active";

            row.appendChild(idCol);
            row.appendChild(typeCol);
            row.appendChild(balCol);
            row.appendChild(statCol);
            x('accounts_table').appendChild(row);

          }
        }

      }
      dash.accountLoader.onFailure = function(){
        x('account_table_indicator').innerHTML = "Oops something went wrong";
      }
      dash.accountLoader.onCreate = function(){

      }
      //****************
      //Account Type Loader Configuration
      //****************

      dash.atl = {};
      dash.atl.url = "/account/types";
      dash.atl.params = "";
      dash.atl.onSuccess = function(result){
        for(i = 0; i < result.types.length; i++){
          var option = document.createElement('option');
          option.setAttribute('value', result.types[i].id);
          option.innerHTML = result.types[i].name;
          option.id = "accountType"+result.types[i].id;
          x('account_type_selector').appendChild(option);
        }
      }
      dash.atl.onFailure = function(){
        alert("No account-types in database.");
      }
      dash.atl.onCreate = function(){};
      dash.accountTypeLoader = dash.atl;

      //******************
      //New Account Application
      //******************
      dash.newAccountApplication = function(){
        //Validate
        var selection = x('account_type_selector');
        var initVal = x('intitial_amount');
        selection.style.border = "0px";
        if(selection.selectedIndex > 0){


        //Configuration
        var config = {};
        config.url = "/useraccount/add";
        config.log = true;
        initVal = initVal.value > 0 ? initVal.value : 0;
        config.params = "typeid="+selection.options[selection.selectedIndex].value;
        config.params += "&initial_amount="+initVal;
        config.onSuccess = function(result){
          empty('account_table_indicator');
          var accountType = x('accountType'+result.typeId);
          accountType = accountType != null ? accountType.innerHTML : "FreeStyle";
          var balance = x('intitial_amount').value > 0 ? x('intitial_amount').value : 0;

          var row = document.createElement('tr');
          var idCol = document.createElement('td');
          var typeCol = document.createElement('td');
          var balCol = document.createElement('td');
          var statCol = document.createElement('td');

          idCol.innerHTML = result.accountId;
          typeCol.innerHTML = accountType;
          balCol.innerHTML = balance;
          statCol.innerHTML = "Active";

          row.appendChild(idCol);
          row.appendChild(typeCol);
          row.appendChild(balCol);
          row.appendChild(statCol);
          x('accounts_table').appendChild(row);
          new dash.clearForm();
        }
        config.onFailure = function(){
          x('account_table_indicator').innerHTML = "Oops some error occured.";
        }
        config.onCreate = function(){
          new dash.curtainDown();
          x('account_table_indicator').innerHTML = "Creating new Account....";

        }

        new dash.fetcher(config);

        }else{
          selection.style.border = "1px solid red";
        }


      }

      dash.clearForm = function(){
        x('intitial_amount').value = '';
        x('account_type_selector').selectedIndex = 0;
      }


      //******************
      //Curtain functions
      //******************

      dash.curtainDown = function(){
        hidee('curtain');
        hidee(dash.activePopUp);
      }
      dash.curtainUp = function(formBox){
        showw('curtain');
        showw(formBox);
        dash.activePopUp = formBox;

      }


      window.onload = function(){

        //Load and apply changes to accounts table.
        //Give it a sleep time first.
        //sleep(1000).then(() => {
          //new dash.fetcher(dash.accountLoader);
        //});

        //populate account types available in this bank.
        //new dash.fetcher(dash.accountTypeLoader);

        //New account form on submission event handler
        x('newAccountForm').onsubmit = function(){
          new dash.newAccountApplication();
          return false;
        }

      }
    </script>
  </head>
  <body align="center">
    <div class="curtain" id="curtain" onclick="new dash.curtainDown();"></div>
    <a href="\logout" id="logout">Logout</a>
    <p>
      Hello <?= $data[0]['name']; ?>
    </p>
<br>
    <a  id="newAccountCaller" class="newButton" onselectstart="return false;" onclick="new dash.curtainUp('newAccountForm');">Add New Account</a>
    <div id="newAccountForm" class="formBox">
      <p class="formHeader">
        New Account Application:
      </p>
      <form class="" action="/useraccount/add" method="post" id="newAccountForm">
        <select class="selector" name="account_type" id="account_type_selector" >
          <option value="0" disabled selected>Account Type</option>
        </select><br>
        <input type="number" name="initial amount" value="" placeholder="Initial Amount" id="intitial_amount"><br>
        <input type="submit"  name="newAccount" value="Add Account" id="newAccountOpener" class="newButton">

      </form>
    </div>
  </body>
</html>
