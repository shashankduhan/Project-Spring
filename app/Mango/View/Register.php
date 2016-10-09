<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="/index/repo/master.css" type="text/css">
    <script src="index/repo/library.js" charset="utf-8"></script>
    <script type="text/javascript">
      var form = {};



      form.action = function(){
        var name = x('name').value;
        var email = x('email').value;
        var password = x('password').value;
        var param = "email="+email+"&password="+password+"&name="+name;

        new ajax.request("/register/go", {method: "POST", parameters: param, onSuccess : function(r){
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
            hidee('indicator');
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
  <body align="center">
    <p>
      Register
    </p>
    <form class="" action="/register/go" method="post" id="registrationForm" >
      <input type="text" name="name" value="" placeholder="Full Name" id="name"><br><br>
      <input type="email" name="email" value="" placeholder="Email" id="email"><br>
      <input type="password" name="password" value="" placeholder="Password" id="password"><br>
      <input type="submit" name="Register" value="Register" id="register">
      <label id="indicator" style="display:none;">Registering...</label>
    </form>
  </body>
</html>
