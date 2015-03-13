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
          <div>
            
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
    <div>
      <?php
        $options = [
          'cost' => 11,
          'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
          ];
          $p =  password_hash("123261129", PASSWORD_BCRYPT, $options);
         /* echo "<br/>";
          echo strlen($p);
          echo "<br/>";
          echo $p;
          echo "<br/>";*/
         /* if(password_verify('123261129', $p)){
            echo "ok";
          }
          else{
            echo "no";
          }*/
          $objDateTime = new DateTime('NOW');
          $str = "boyisboyis@".$objDateTime->format('Y-m-d/H:i');;
         /* echo $str."<br/>";
          echo md5($str);*/
      ?>
    </div>
  </body>
</html>