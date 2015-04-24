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
  <script type="text/javascript" src="match-height"></script>
  <script type="text/javascript" src="nanojs"></script>
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
            <a href="#config_type" class='sub-menu'><i class="fa fa-wrench"></i></i></a>
            <!--<a class='sub-menu'><i class="fa fa-wrench"></i></i></a>-->
          </li>
          <?php if(Session::getSessionAuth() == 0){ ?>
            <li>
              <a href="#add_user" class='sub-menu'><i class="fa fa-user-plus"></i></a>
            </li>
            <li>
              <a href="#backup-db" class='sub-menu' id="backup-db-btn"><i class="fa fa-cloud-download"></i></a>  
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
  
	<div id='alert-backup-db' style='display: none;'>
		<section id="alert-backup-db-complete">
			<h3>Save Complete</h3>
			<button id="alert-btn-backup-yes">Yes</button>
			<button id="alert-btn-backup-no">No</button>
		</section>
	</div>
</body>

</html>