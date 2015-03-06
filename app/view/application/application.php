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
          <secton>
            <h3>Month</h3>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_january" type="checkbox" name="reports_month" class='reports_month' value="01" checked='checked' />
                <label for="reports_month_january">January</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_february" type="checkbox" name="reports_month" class='reports_month' value="02"/>
                <label for="reports_month_february">February</label>
              </p>
            </div>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_march" type="checkbox" name="reports_month" class='reports_month' value="03"/>
                <label for="reports_month_march">March</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_april" type="checkbox" name="reports_month" class='reports_month' value="04"/>
                <label for="reports_month_april">April</label>
              </p>
            </div>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_may" type="checkbox" name="reports_month" class='reports_month' value="05"/>
                <label for="reports_month_may">May</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_june" type="checkbox" name="reports_month" class='reports_month' value="06"/>
                <label for="reports_month_june">June</label>
              </p>
            </div>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_july" type="checkbox" name="reports_month" class='reports_month' value="07"/>
                <label for="reports_month_july">July</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_august" type="checkbox" name="reports_month" class='reports_month' value="08"/>
                <label for="reports_month_august">August</label>
              </p>
            </div>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_september" type="checkbox" name="reports_month" class='reports_month' value="09"/>
                <label for="reports_month_september">September</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_october" type="checkbox" name="reports_month" class='reports_month' value="10"/>
                <label for="reports_month_october">October</label>
              </p>
            </div>
            <div>
              <p class='report-month-left'>
                <input id="reports_month_november" type="checkbox" name="reports_month" class='reports_month' value="11"/>
                <label for="reports_month_november">November</label>
              </p>
              <p class='report-month-right'>
                <input id="reports_month_december" type="checkbox" name="reports_month" class='reports_month' value="12"/>
                <label for="reports_month_december">December</label>
              </p>
            </div>
          </secton>
          <div class='clearfix'></div>
          <secton>
            <h3>Year</h3>
            <div id="report-update-years">
              <p class=''>
                You don't have set any data
              </p>
              <!--<p>
                <input id="reports_year_2015" type="checkbox" name="reports_year" class='reports_year' value="2015"/>
                <label for="reports_year_2015">2015</label>
              </p>-->
            </div>
          </secton>
          <div>
            <button id="submit-report">SUBMIT</button>
          </div>
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
        <section id="main-report" class="t2" style="display: none;">
            <h2 class="report-topics">Report</h2>
            <div id="content-report"></div>
          </section>
      </div>
      
      <!-- Block Footer -->
      
      <footer id="wrap-footer" class="clearfix">
        
      </footer>
    </div>
  </body>
</html>