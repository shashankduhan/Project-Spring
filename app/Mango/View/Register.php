<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <script src="index/repo/library.js" charset="utf-8"></script>
    <script type="text/javascript">
      var form = {};



      form.action = function(){
        var name = x('name').value;
        var email = x('email').value;
        var password = x('password').value;
        var param = "email="+email+"&password="+password+"&name="+name;

        new ajax.request("/register/go", {method: "POST", parameters: param, onSuccess : function(r){
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
      Register
    </p>
    <form class="" action="/register/go" method="post" id="registrationForm" >
      <input type="text" name="name" value="" placeholder="Full Name" id="name"><br><br>
      <input type="text" name="email" value="" placeholder="Email" id="email"><br>
      <input type="text" name="password" value="" placeholder="Password" id="password"><br>
      <input type="submit" name="Register" value="Register" id="register">
      <label id="indicator" style="display:none;">Registering...</label>
    </form>
  </body>
</html>
