<?php

  if(Session::getSessionUID() === null){
    Redirect::to("login");
  }
  else if(Session::getSessionAuth() > 1 ) {
    Redirect::to("home");
  }

?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <link rel="stylesheet" href="maincss" type="text/css" />
  <link rel="stylesheet" href="jquery-ui-css" type="text/css" />
  <link rel="stylesheet" href="fontcss" type="text/css" />
  <link rel="stylesheet" href="admincss" type="text/css" />
  <script type="text/javascript" src="jquery"></script>
  <script type="text/javascript" src="jquery-ui"></script>
  <script type="text/javascript" src="adminjs"></script>
</head>

<body>
  <div id="wrapper-admin">

    <nav id="wrap-nav">
      <ul>
				<li><a href="logout"><i class="fa fa-power-off"></i><a href="logout">Logout</a></li>
				<li><a href="home"><i class="fa fa-home"></i>Home</a></li>
      </ul>
    </nav>    
    <div id="content-article" >
      <nav id="content-nav" >
        <ol>
          <li>
            <a href="#add" class='sub-menu'><i class="fa fa-plus"></i></a>
          </li>
          <li>
            <a href="#search" class='sub-menu'><i class="fa fa-search"></i></a>

          </li>
          <li>
            <!--<a href="#config_type" class='sub-menu'><i class="fa fa-wrench"></i></i></a>-->
            <a class='sub-menu'><i class="fa fa-wrench"></i></i></a>
          </li>
          <?php if(Session::getSessionAuth() == 0){ ?>
            <li>
              <a href="#add_user" class='sub-menu'><i class="fa fa-user-plus"></i></a>
            </li>
          <?php } ?>
        </ol>
      </nav>
      
      <div id="wrap-content">
        <header id="wrap-header">
          <section>
            <h1>
              Purchase Order / Contract Check List
              <span>Manage purchase order / contract check list system</span>
            </h1>
          </section>
        </header>
        <?php include('_add.php'); ?>
        <?php include('_search.php'); ?>
        <?php include('_config_type.php'); ?>
        <?php include('_add_user.php'); ?>
      </div>
			
			<!--Loading-->
      
      <div class='ajax-loading' style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
			
			<!---Save--->
			<div id="show-save" style="display: none;">
				<p>Save</p>
			</div>
			
    </div>
  </div>
  <?php
/* function get_ip() {

		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {

			$headers = apache_request_headers();

		} else {

			$headers = $_SERVER;

		}

		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

			$the_ip = $headers['X-Forwarded-For'];

		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {

			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];

		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

		}

		return $the_ip;

	}
	echo get_ip();*/
  
  ?>
</body>

</html>