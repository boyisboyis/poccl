<?php
  
  if(Session::getSessionUID() === null){
    Redirect::to("login");
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
    <nav id="content-nav">
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
        <li>
          <a href="#add_user" class='sub-menu'><i class="fa fa-user-plus"></i></a>
        </li>
      </ol>
    </nav>
    <div id="content-article">
      <nav id="wrap-nav">
        <ul>
					<li><a href="logout"><i class="fa fa-power-off"></i><a href="logout">Logout</a>
					<li><a href="home"><i class="fa fa-home"></i>Home</a>
          </li>
        </ul>
      </nav>
      <header id="wrap-header">
        <section>
          <h1>
            Purchase Order / Contract Check List
            <span>Manage purchase order / contract check list system</span>
          </h1>
        </section>
      </header>

      <div id="wrap-content">
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
</body>

</html>