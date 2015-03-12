$(document).ready(function(){
  var hash_str = ["#home", "#search", "#report"];
  var g_Month = ["January", "February", "March", "April", "May", "June", "July", "August","September","October","November","December"];
  getHash();
  
  /*
  * event
  */
  $("#input-search").on("keyup", function(e){
    if ( e.which == 13 ) {
      $("#search-now").click();
    }
  });
  
  $("#select-search").on("change", function(){
    $("#input-search").val("");
  });
  
  $(".sub-menu").on("click", function(){
    document.location.hash = $(this).attr("href");
    getHash();
  });
  
  $("#content-search").on("click", ".job-id", function(){
    $(this).next().slideToggle();
  });
  
  $("#content-report").on("click", ".reports-details-years, .reports-details-toggle, .reports-details-jid-detail", function(){
    $(this).next().slideToggle();
  })
  
  $("#search-now").on("click", function(){
    var data = {
      "type" : $("#select-search").val(),
      "search" : $("#input-search").val()
    }
    searchResult(data);
  });
  
  $("#content-payment-news, #content-guarantee-news, #content-poidnull-news").on("click", '.search-from-news', function(){
    document.location.hash = $(this).attr("href");
    var search = $(this).data('jid');
    getHash();
    var data = {
      "type" : "job",
      "search" : search
    }
    $("#select-search").val("job");
    searchResult(data);
  });
  
  $("#submit-report").on("click", function(){
    var months = $(".reports_month").map(function(){
      var m = $($(this)[0]);
      if(m.prop('checked')){
        return m.val();
      }
    }).get();
    var years = $(".reports_year").map(function(){
      var m = $($(this)[0]);
      if(m.prop('checked')){
        return m.val();
      }
    }).get();
    
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "month" : months,
			  "year" : years
			},
      url : "report_options",
      cache: false,
      success: function(req){
        if(req['status'] == true){
          $(".report-topics").html("<i class='fa fa-check color-success'></i>Report");
          var obj = req['obj'];
          var reports = new Array();
          var reports_year = new Array();
          var str = "";
          var save_years = 0, save_month = 0;
          var i = -1, j =-1;
          $(obj).each(function(){
            var date = get_date_to_array(this['Invoice_Date']);
            var years = date[0];
            var month = g_Month[parseInt(date[1]) -1 ];
            
            if(save_years != years){
              save_years = years;
              reports_year.push(years);
              i++;
              j=0;
              reports[i] = new Array();
              save_month = month;
            }
            if(save_month != month){
              save_month = month;
              j++;
            }
            if(typeof reports[i][j] == "undefined"){
              reports[i][j] = new Array();
              reports[i][j]['month'] = month;
              reports[i][j]['str'] = "";
              reports[i][j]['sum'] = 0;
            }
            var currency = this['Amount_Actual_Price'];
            reports[i][j]['sum'] += parseFloat(currency);
            reports[i][j]['str'] += "<div><p class='reports-details-jid-detail'>"+
            this['JID']+
            "<span class='reports-show-currency'>"+addCommas(parseFloat(currency).toFixed(2))+"</span></p>"+
            "<div class='reports-details-each-details'>"+
            "<p>Terms "+this['Terms']+"<span class='td-colon'>:</span>"+this['Payment_Type']+"</p>"+
            "</div>"+
            "</div>";
            
          });
          
          var currency = 0;
          for(i=0;i<reports_year.length;i++){
            var currency_each_years = 0;
            var year = reports_year[i];
            var str_list = "";
            for(j=0;j<reports[i].length;j++){
              currency_each_years += reports[i][j]['sum'];
              str_list += "<div class='reports-details-toggle'><p>"+reports[i][j]['month']+"<span class='reports-show-currency'>"+addCommas(parseFloat(reports[i][j]['sum']).toFixed(2))+"</span></p></div>";
              str_list += "<div class='reports-details-jid'>"+reports[i][j]['str']+"</div>";
            }
            str += "<h4 class='reports-details-years'>"+year+"<span class='reports-show-currency'>"+addCommas(parseFloat(currency_each_years).toFixed(2))+"</span></h4><div class='reports-details-month'>" + str_list + "</div>";
            currency += currency_each_years;
          }
          str = "<h3>SUMMARY ALL <span class='reports-show-currency'>"+addCommas(parseFloat(currency).toFixed(2))+"</span></h3>" + str
          $("#content-report").html(str);
        }
        else{
          $(".report-topics").html("<i class='fa fa-times color-danger'></i>Report");
          var monthText = "";
          for(var m in months) {
            if(m == months.length - 1) {
              monthText += g_Month[parseInt(months[m] - 1)];
            }
            else {
              monthText += g_Month[parseInt(months[m] - 1)] + ", ";
            }
          }
          $("#content-report").html(
            "Invoice at " +
            "<span class='highlight-text'>" +
            monthText +
            "</span>" +
            " not found !! Please, Select again."
          );
          console.log("false");
        }
      }
    });
  });
  
  /*
  * Function
  */
  function getHash(){
    var hash = location.hash;
    hashManagement(hash);
  }
  function hashManagement(hash){
    if(hash == ""){
      init(0);
    }
    else{
      var index = hash_str.indexOf(hash);
      if(index >= 0){
        init(index);
      }
    }
  }
  
  function getPaymentAlertFeeds(){
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "type" : "paymentsAlert"
			},
      url : "managenews",
      cache: false,
      success: function(req){
        if(req['status'] == true){
          var length = req['obj'].length;
          $("#content-payment-news").html("<h2 class='main-topics'>Payments</h2>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-payment-news").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span>has arrears at</span>"+
              "<b class='news-payment'>"+_obj['Payment']+"</b>"+
              "</p>"
            );
          });
        }
        else{
          console.log("false");
        }
      }
    });
  }
  
  function getGuaranteeAlertFeeds() {
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "type" : "guaranteesAlert"
			},
      url : "managenews",
      cache: false,
      success: function(req){
        if(req['status'] == true){
          var length = req['obj'].length;
          $("#content-guarantee-news").html("<h2 class='main-topics'>Gurantees</h2>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-guarantee-news").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span>has until at</span>"+
              "<b class='news-payment'>"+_obj['Guarantee']+"</b>"+
              "</p>"
            );
          });
        }
        else{
          console.log("false");
        }
      }
    });
  }
  
  function getPOIDNullAlertFeeds() {
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "type" : "poidnullAlert"
			},
      url : "managenews",
      cache: false,
      success: function(req){
        if(req['status'] == true){
          var length = req['obj'].length;
          $("#content-poidnull-news").html("<h2 class='main-topics'>Purchase Order none</h2>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-poidnull-news").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span>purchase order none</span>"+
              // "<b class='news-payment'>"+_obj['Guarantee']+"</b>"+
              "</p>"
            );
          });
        }
        else{
          console.log("false");
        }
      }
    });
  }
  
  function searchResult(search){
    //console.log(search);
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
      dataType: "json",
      data: search,
      url : "search_options",
      cache: false,
      success: function(req){
        $("#content-search").html("");
        if(req['status'] == true){
          $(".result-topics").html("<i class='fa fa-check color-success'></i>Result");
          $.each(req['obj'], function(){
            var obj = $(this)[0];
            var table_guarantee = "<p class='p-warning'>Guarantee is not set</p>";
            var table_payment = "<p class='p-warning'>Payment is not set</p>";
            var n = obj['Guarantee'].length;
            var thai_bath = obj['Job']['Contract_Value_THB'];
            var tr_currency = "";
            if(thai_bath == "" || thai_bath == null){
              thai_bath = obj['job']['Contract_Value_Rate'] * obj['job']['Contract_Value_Other'];
            }
            if(obj['Job']['Contract_Value_Type'] != ""){
              other_currency = addCommas(parseFloat(obj['Job']['Contract_Value_Other']).toFixed(2));
              tr_currency = "<p class='margin-padding-0 text_underline'>"+other_currency+"<span class='currency'>"+obj['Job']['Contract_Value_Type']+"</span></p><p class='margin-padding-0 text_underline'><span>Rate </span>"+obj['Job']['Contract_Value_Rate']+"</p>";
             // tr_currency = "<br>"+obj['Job']['Contract_Value_Rate']+"<br><span class='t2_desc text_underline' style='margin-right: 0;'>"+obj['Job']['Contract_Value_Other']+"</span>  "+obj['Job']['Contract_Value_Type'];
               //tr_currency = "<tr><td></td><td></td><td>Rate <span class='t2_desc text_underline'>"+obj['Job']['Contract_Value_Rate']+"</span><span class='t2_desc text_underline' style='margin-right: 0;'>"+obj['Job']['Contract_Value_Other']+"</span>  "+obj['Job']['Contract_Value_Type']+"</td></tr>"
            }
            thai_bath = addCommas(parseFloat(thai_bath).toFixed(2));
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var g_content = obj['Guarantee'][i];
                var g_amount = (g_content['Amount_Actual_Percentage'] == "" || g_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(g_content['Amount_Actual_Price']).toFixed(2)):g_content['Amount_Actual_Percentage']+"%";
                 tr += "<tr>"+
                "<td class='text-vertical-top'>Term : "+g_content['Terms']+"</td>"+
                "<td class='td-search-term'>"+
                "<table>"+
                "<tr>"+
                "<td class='text-vertical-top'>Description</td><td class='td-colon'>:</td><td class='text_underline'>"+g_content['Guarantee_Type']+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Amount</td><td class='td-colon'>:</td><td class='text_underline'>"+g_amount+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Start Plan</td><td class='td-colon'>:</td><td><span class='text_underline' style='margin-right: 10px;'>"+g_content['Start_Plan']+"</span>Until Plan : <span class='text_underline'>"+g_content['Until_Plan']+"</span></td>"+
                "</tr>"+
                "</table>"+
                "</td>"+
                "</tr>";
              }
              table_guarantee = "<table border=0 style='width: 100%;' class='purchase-each-detail'>"+tr+"</table>";
            }
            n = obj['Payment'].length; 
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var p_content = obj['Payment'][i];
                var p_amount = (p_content['Amount_Actual_Percentage'] == "" || p_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(p_content['Amount_Actual_Price']).toFixed(2)):p_content['Amount_Actual_Percentage']+"%";
                tr += "<tr>"+
                "<td style='vertical-align: text-top;'>Term : "+p_content['Terms']+"</td>"+
                "<td class='td-search-term'>"+
                "<table>"+
                "<tr>"+
                "<td class='text-vertical-top'>Description</td><td class='td-colon'>:</td><td class='text_underline'>"+p_content['Payment_Type']+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Amount</td><td class='td-colon'>:</td><td class='text_underline'>"+p_amount+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Payment Date Plan</td><td class='td-colon'>:</td><td class='text_underline'>"+p_content['Payment_date_plan']+"</td>"+
                "</tr>"+
                "</table>"+
                "</td>"+
                "</tr>";
              }
              table_payment = "<table border=0 style='width: 100%;' class='purchase-each-detail'>"+tr+"</table>";
            }
            
            var keySearch;
            if(search['type'] == "contract") {
              keySearch = "<h2 class='job-id'>"+obj['Contactor_Name']+"</h2>";
            }
            else if(search['type'] == "job") {
              keySearch = "<h2 class='job-id'>"+obj['JID']+"</h2>" 
            }
            else {
              keySearch = "<h2 class='job-id'>"+obj['PO_No']+"</h2>"
            }
            
            $("#content-search").append(
              "<article class='purchase-detail'>" +
              keySearch +
              "<div style='width: 100%;display:none;'>"+
              "<div style='width: 100%'>"+
              "<section class='content-search-left'>"+
              "<h3>Project Summary</h3>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td class='text-vertical-top'>Contract Name</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Contactor_Name']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Name</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Project_Name']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Location</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Project_Location']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Owner's Name</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Project_Owner']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Secrecy Agreement</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Secrecy_Agreement']+"</td></tr>"+
              "</table>"+
              "<h3>Working Remark</h3>"+
              "<p class='purchase-each-detail'><span>Start Date</span><span class='t2_desc text_underline'>"+obj['Job']['Work_Start_Date']+"</span><span>Complete Date</span><span class='t2_desc text_underline'>"+obj['Job']['Work_Complete_Date']+"</span></p>"+
              "</section>"+
              "<section class='content-search-right'>"+
              "<h3>PO info</h3>"+
              //"<p class='purchase-each-detail' style='margin-left: 12px'><span>PO no</span><span class='t2_desc text_underline'>"+obj['PO_No']+"</span><span>Date</span><span class='t2_desc text_underline'>"+obj['Job']['PO_Date']+"</span></p>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td class='text-vertical-top'>PO no.</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['PO_No']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO Date</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['PO_Date']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO type</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['PO_Type']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO Amount</td><td class='td-colon'>:</td><td><p class='margin-padding-0 text_underline'>"+thai_bath+"<span class='currency'>THB</span></p>"+tr_currency+"</td></tr>"+
             // tr_currency+
              "<tr><td class='text-vertical-top'>Goveming Law</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Project_Location']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Credit Term</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Credit_Term']+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Late Payment Financial Charges</td><td class='td-colon'>:</td><td class='text_underline'>"+obj['Job']['Late_Pay_Finan_Chage']+"</td></tr>"+
              "</table>"+
              "</section>"+
              "</div>"+
              "<div class='clearfix'></div>"+
              "<hr>"+
              "<div style='width:100%'>"+
              "<section class='content-search-left'>"+
              "<h3>Payment Terms</h3>"+
              table_payment+
              "</section>"+
              "<section class='content-search-right'>"+
              "<h3>Bank Guarantee</h3>"+
              table_guarantee+
              "</section>"+
              "</div>"+
              "<div class='clearfix' style='height: 10px'></div>"+
              "<hr style='border-color:#ed8151; margin-bottom: 40px;'>"+
              "</article>"+
              "</div>"
            );
          });
        }
        else{
          $(".result-topics").html("<i class='fa fa-times color-danger'></i>Result");
          var searchType = "";
          if(search['type'] == 'contract') {
            searchType = "Contract Name ";
          }
          else if(search['type'] == 'job') {
            searchType = "Job ID ";
          }
          else {
            searchType = "PO ID ";
          }
          $("#content-search").html(
            searchType +
            "<span class='highlight-text'>" +
            search['search'] +
            "</span>" +
            " not found !! Please, Input again."
          );
          console.log("false");
        }
      }
    });
  }
  
  function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
  
  function init(type){
    switch (parseInt(type)) {
      case 1:
          $(".t1").show();
          $(".t0, .t2").hide();
          $("#content-search, .result-topics").html("");
        break;
      case 2:
        get_report_years();
        $(".t2").show();
        $(".t0, .t1").hide();
        $("#content-report, .report-topics").html("");
        break;
      default:
          $(".t0").show();
          $(".t1, .t2").hide();
          getPaymentAlertFeeds();
          getGuaranteeAlertFeeds();
          getPOIDNullAlertFeeds();
        break;
    }
  }
  
  function get_report_years(){
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "get_years" : "get_years"
			},
      url : "report_options",
      cache: false,
      success: function(req){
        console.log(req);
        if(req['status'] == true){
          var max = parseInt(req['obj']['max']);
          var min = parseInt(req['obj']['min']);
          var diff = max - min;
          if(diff < 0) diff *= -1;
          var str = "";
          for(i=0; i<=diff;i++){
            var checked = i==0?"checked=checked":"";
            var y = min + i;
            str += "<p>"+
            "<input id='reports_year_"+y+"' type='checkbox' name='reports_year' class='reports_year' value='"+y+"' "+checked+"  />"+
            "<label for='reports_year_"+y+"'>"+y+"</label>"
            "</p>"
          }
          $("#report-update-years").html(str);
        }
        else{
          
        }
      }
    });
  }
  
  function get_date_to_array(invoice_date){
     var s = invoice_date.split('-');
     return s;
  }
  
});