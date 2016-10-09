<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/index/repo/master.css" type="text/css">
    <script src="/index/repo/library.js" charset="utf-8"></script>
    <script type="text/javascript">

    var form = {};



    form.action = function(){
      var email = x('email').value;
      var password = x('password').value;
      var param = "email="+email+"&password="+password;

      new ajax.request("/login/go", {method: "POST", parameters: param, onSuccess : function(r){
        console.log(r);
        try{
           r = eval("("+r+")");
        }catch(e){
          r = {status : 0, userId : 0}
        }

        if(r.status && r.userId){
          window.location  = ".";
        }else{
          alert("Invalid Credentials");
          hidee('indicator');
          showw('login');
        }

      }, onCreate : function(){
        hidee('login');
        showw('indicator');
      }});
    }

    window.onload = function(){
      var formPad = x('registrationForm');
      formPad.onsubmit = function(){
        new form.action();
        return false;
      }

  }

    </script>
  </head>
  <body align="center">
  <p>
    Login
  </p>
  <form class="" action="/login/go" method="post" id="registrationForm">
    <input type="email" name="email" value="" placeholder="Email" id="email"><br>
    <input type="password" name="password" value="" placeholder="Password" id="password"><br>
    <input type="submit" name="login" value="Login" id="login">
    <label id="indicator" style="display:none;">Login you in.....</label>
  </form>
  </body>
</html>
