<?php
  if($GLOBALS['IPCLIENT'] != FIXEDIP) {
    if(Session::getSessionUID() == null){
      Redirect::to("login");
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> 
		<title>Purchase Order Contract Check Lists</title>
		<link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="maincss" type="text/css" />
    <link rel="stylesheet" href="fontcss" type="text/css" />
    <!--<link rel="stylesheet" href="bootstrapcss" type="text/css" />-->
    <link rel="stylesheet" href="applicationcss" type="text/css" />
    <script type="text/javascript" src="jquery"></script>
		<script type="text/javascript" src="pagenavi"></script>
    <script type="text/javascript" src="nanojs"></script>
    <!--<script type="text/javascript" src="bootstrapjs"></script>-->
    <script type="text/javascript" src="applicationjs"></script>
  </head>
  <body>
    <div id="wrapper">
      
      <?php include_once(__DIR__.'/../layout/nav_top.php'); ?>
      
      <!-- Block header -->
      
      <header id="wrap-header" class="clearfix">
        <h1>Purchase Order / Contract Check Lists <span>Checking the purchase order</span></h1>
      </header>
      
      <!-- Block search -->
      
      <div id="wrap-search" class="t1 clearfix" style="display:none;">
        <div id="search-content">
          <div id="front-message">Search By : </div>
          <select id="select-search">
            <option value="contract">Contract Name</option>
            <option value="job">Job No</option>
            <option value="poid">PO No</option>
          </select>
          <input type="search" id="input-search" name="input-search"/>
          <button id="search-now">search</button>
        </div>
      </div>
      
      <!-- Block report -->
      
      
     <!--     <section id="main-news" class="t0">-->
     <!--     <div id="content-payment-news"></div>-->
     <!--     <div id="content-guarantee-news"></div>-->
     <!--     <div id="content-poidnull-news"></div>-->
					<!--<div id="content-comingsoon-news"></div>-->
					<!--<div id="content-checklistnil-news"></div>-->
     <!--   </section>-->
     <!-- Block content main-->
    
      
      <div id="wrap-main" class="clearfix pagenavi">
        <?php include_once(__DIR__.'/_sidebar.php'); ?>
        <section id="main-search" class="t1" style="display: none;">
          <h2 class="result-topics"></h2>
          <div id="content-search" class='page-list'></div>
        </section>
        <div id="main-report" class="t2" style="display: none;">
            <?php include("_month.php"); ?>
            <section id="main-report-content">
              <h2 class="report-topics">Report</h2>
            <div id="content-report"></div>
            <div class="clearfix" style="height: 100px;width: 100%;"></div>
            </section>
        </div>
      </div>
      
      <!--Loading-->
      
      <div class='ajax-loading' style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
      
      <!-- Block Footer -->
      <div class='clearfix'></div>
      <footer id="wrap-footer" class="clearfix">
				<div></div>
      </footer>
    </div>
  </body>
</html>