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
  <link rel="stylesheet" href="fontcss" type="text/css" />
  <link rel="stylesheet" href="admincss" type="text/css" />
  <script type="text/javascript" src="jquery"></script>
  <script type="text/javascript" src="adminjs"></script>
</head>

<body>
  <div id="wrapper-admin">
    <nav id="content-nav">
      <ol>
        <li><a href="#add" class='sub-menu'><i class="fa fa-plus"></i>Add</a>
        </li>
        <li><a href="#search" class='sub-menu'><i class="fa fa-search"></i>Search</a>
        </li>
        <li><a href="#payment" class='sub-menu'>Payment Status</a>
        </li>
        <li><a href="#guarantee" class='sub-menu'>Guarantee Status</a>
        </li>
      </ol>
    </nav>
    <div id="content-article">
      <nav id="wrap-nav">
        <ul>
          <li><i class="fa fa-power-off"></i><a href="logout">Logout</a>
          </li>
        </ul>
      </nav>
      <header id="wrap-header">
        <section>
          <h1>Purchase Order Admin Controller</h1>
        </section>
      </header>

      <div id="wrap-content">
        <?php include('_add.php'); ?>
        <?php include('_search.php'); ?>
      </div>
    </div>
  </div>
</body>

</html>