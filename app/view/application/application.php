<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Purchase Order Contract Check Lists</title>
		<link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="maincss" type="text/css" />
    <link rel="stylesheet" href="fontcss" type="text/css" />
    <link rel="stylesheet" href="applicationcss" type="text/css" />
    <script type="text/javascript" src="jquery"></script>
    <script type="text/javascript" src="applicationjs"></script>
  </head>
  <body>
    <div id="wrapper">
      
      <!-- button link to menu -->
      
      <nav id="wrap-nav" class="clearfix">
        <a class="sub-menu" href="#home"><i class="fa fa-home"></i>Home</a>
        <a class="sub-menu" href="#search"><i class="fa fa-search"></i>Search</a>
        <a class="sub-menu" href="#report"><i class="fa fa-file-text-o"></i>Report</a>
      </nav>
      
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
      
      <div id="wrap-report" class="t2 clearfix" style="display:none;">
        <div class="report-panel">
          
        </div>
        <div class="report-result">
          <section id="main-report" class="t2" style="display: none;">
            <h2 class="report-topics">Report</h2>
            <div id="content-report"></div>
          </section>
        </div>
      </div>
      
     <!-- Block content main-->
      
      <div id="wrap-main" class="clearfix">
        <section id="main-news" class="t0">
          <div id="content-payment-news"></div>
          <div id="content-guarantee-news"></div>
        </section>
        <section id="main-search" class="t1" style="display: none;">
          <h2 class="result-topics"></h2>
          <div id="content-search"></div>
        </section>
      </div>
      
      <!-- Block Footer -->
      
      <footer id="wrap-footer" class="clearfix">
        
      </footer>
    </div>
  </body>
</html>