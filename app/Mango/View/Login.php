<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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
          alert("Sorry something went wrong!!");
          hidde('indicator');
          showw('register');
        }

      }, onCreate : function(){
        hidee('register');
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
  <body>
  <p>
    Login
  </p>
  <form class="" action="/login/go" method="post" id="registrationForm">
    <input type="email" name="email" value="" placeholder="Email" id="email"><br>
    <input type="password" name="password" value="" placeholder="Password" id="password"><br>
    <input type="submit" name="login" value="Login">
  </form>
  </body>
</html>
