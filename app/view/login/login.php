<?php
  if(Session::getSessionUID() !== null){
    Redirect::to("admin");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
		<title>Login</title>
		<link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="maincss" type="text/css" />
    <link rel="stylesheet" href="fontcss" type="text/css" />
    <link rel="stylesheet" href="logincss" type="text/css" />
    <script type="text/javascript" src="jquery"></script>
    <script type="text/javascript" src="loginjs"></script>
  </head>
  <body>
    <div id="wrapper">
      <form id="form-login" action="login_controller" method="POST">
        <section id="wrap-login">
          <h1>Login</h1>
          <div id="box-error" style="display:none;">
            <P class='error e-0'>The username and password field is empty</P>
            <P class='error e-1'>The username or password is incorrect</P>
          </div>
          <div class='input-login'>
            <input type="text" id="username" placeholder = "username"  name="username"/>
          </div>
          <div class='input-login'>
            <input type="password" id="password" placeholder="password"  name="password"/>
          </div>
          <div class='input-submit'>
             <input id="check-login" type="submit" value="Submit"/>
          </div>
        </section>
      </form>
    </div>
  </body>
</html>