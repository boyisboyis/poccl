$(document).ready(function(){
  var hash_str = ["#home", "#search", "#report"];
  var g_Month = ["January", "February", "March", "April", "May", "June", "July", "August","September","October","November","December"];
  getHash();
  
  /*
  * event
  */
  
  $(".report-month").on("click", function(e) {
      var checkbox = $(this).find("input");
     if(checkbox.prop("checked")){
       checkbox.prop("checked", false);
       $(this).removeClass("shadow");
       $(this).find(".fa").removeClass("fa-check-circle-o").addClass("fa-circle-o");
     } 
     else{
       checkbox.prop("checked", true);
       $(this).addClass("shadow");
       $(this).find(".fa").removeClass("fa-circle-o").addClass("fa-check-circle-o");
     }
     if($(".report-month.shadow").length == 12){
       $("#report-month-all").hide();
       $("#report-month-unall").show();
     }
     else{
       $("#report-month-all").show();
       $("#report-month-unall").hide();
     }
  });
	
	$("#report-update-years").on("click", ".report-year", function(e){
		 var checkbox = $(this).find("input");
		 console.log($(this));
     if(checkbox.prop("checked")){
       checkbox.prop("checked", false);
       $(this).removeClass("shadow");
       $(this).find(".fa").removeClass("fa-check-circle-o").addClass("fa-circle-o");
     } 
     else{
       checkbox.prop("checked", true);
       $(this).addClass("shadow");
       $(this).find(".fa").removeClass("fa-circle-o").addClass("fa-check-circle-o");
     }
	});
  
  $("#btn-show-hide-report").on("click", function(e) {
     $("#wrap-report-show").slideToggle();
  });
  
  $("#report-month-all").on("click", function(){
      $(".report-month").each(function(){
        $(this).addClass("shadow");
        $(this).find("input").prop("checked", true);
        $(this).find(".fa").removeClass("fa-circle-o").addClass("fa-check-circle-o");
      });
      $("#report-month-all").hide();
      $("#report-month-unall").show();
  });
  $("#report-month-unall").on("click", function(){
      $(".report-month").each(function(){
        $(this).removeClass("shadow");
        $(this).find("input").prop("checked", false);
        $(this).find(".fa").removeClass("fa-check-circle-o").addClass("fa-circle-o");
      });
      $("#report-month-unall").hide();
      $("#report-month-all").show();
  });
  
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
    $(this).focus();
  });
  
  $("#show-and-hide").on("click", function(){
    $(".report-panel").slideToggle();
  });
  
  $("#search-now").on("click", function(){
    var data = {
      "type" : $("#select-search").val(),
      "search" : $("#input-search").val()
    };
    searchResult(data);
  });
	
	$("#content-poidnull-news").pagenavi({showPerPage: 10, position: "center"});
  $("#main-search").pagenavi({showPerPage: 15, position: "center"});
	$("#content-comingsoon-news").pagenavi({showPerPage: 10, position: "center"});
	$("#content-checklistnil-news").pagenavi({showPerPage: 10, position: "center"});
	$("#content-payment-news").pagenavi({showPerPage: 10, position: "center"});
	$("#content-guarantee-news").pagenavi({showPerPage: 10, position: "center"});
	
  $("#content-payment-news, #content-guarantee-news, #content-poidnull-news, #content-comingsoon-news, #content-checklistnil-news").on("click", '.search-from-news', function(){
    document.location.hash = $(this).attr("href");
    var search = $(this).data('jid');
    getHash();
    var data = {
      "type" : "job",
      "search" : search
    };
    $("#select-search").val("job");
    searchResult(data);
  });
  
 
  $(".nano").nanoScroller({ alwaysVisible: true });
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
        if(req['status'] === true){
          $(".report-topics").html("<i class='fa fa-check color-success'></i>Report");
          var obj = req["obj"];
          var reports = [];
          var reports_year = [];
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
          $("#content-payment-news").html("<h2 class='main-topics'>Arrears of payments</h2><div class='page-list'></div>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-payment-news > div").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span class='has-arrears-at'>has arrears at</span>"+
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
        // console.log(req);
        if(req['status'] == true){
          var length = req['obj'].length;
          $("#content-guarantee-news").html("<h2 class='main-topics'>Bank Gurantees is not return</h2><div class='page-list'></div>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-guarantee-news > div").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span class='has-arrears-at'>has until at</span>"+
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
        if(req['status'] === true){
          var length = req['obj'].length;
          $("#content-poidnull-news").html("<h2 class='main-topics'>Purchase Order is nil</h2><div class='page-list'></div>");
          $.each(req['obj'], function(){
            var _obj = $(this)[0];
            $("#content-poidnull-news > div").append(
              "<p class='p-news'>"+
              "<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
              "<span class='has-arrears-at'>purchase order is nil</span>"+
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
  
  function getPaymentNearAlertFeeds(){
		console.log("test");
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "type" : "paymentsNearAlert"
			},
      url : "managenews",
      cache: false,
      success: function(req){

				if(req['status'] === true){
					var length = req['obj'].length;
					$("#content-comingsoon-news").html("<h2 class='main-topics'>Payment is coming soon</h2><div class='page-list'></div>");
					$.each(req['obj'], function(){
						var _obj = $(this)[0];
						$("#content-comingsoon-news > div").append(
							"<p class='p-news'>"+
							"<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
							"<span class='has-arrears-at'>day to payment</span>"+
							"<b class='news-payment'>"+_obj['Invoice_plus_credit_date']+"</b>"+
							"</p>"
						);
					});
				}
				else {
					console.log("false");
				}
      }
    });
  }
  
  function getCheckListsAlertFeeds(){
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
			dataType: "json",
			data : {
			  "type" : "checkListsAlert"
			},
      url : "managenews",
      cache: false,
      success: function(req){
        //console.log(req);
				if(req['status'] === true){
					var length = req['obj'].length;
					$("#content-checklistnil-news").html("<h2 class='main-topics'>Checklist is nil</h2><div class='page-list'></div>");
					$.each(req['obj'], function(){
						var _obj = $(this)[0];
						$("#content-checklistnil-news > div").append(
							"<p class='p-news'>"+
							"<b><a href='#search' class='search-from-news' data-jid='"+_obj['JID']+"'>"+_obj['JID']+"</a></b>"+
							"<span class='has-arrears-at'>checklist is nil</span>"+
							//"<b class='news-payment'>"+_obj['Invoice_plus_credit_date']+"</b>"+
							"</p>"
						);
					});
				}
				else {
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
            if(obj['Job']['Contract_Value_Type'] != "" && obj['Job']['Contract_Value_Type'] != null){
              other_currency = addCommas(parseFloat(obj['Job']['Contract_Value_Other']).toFixed(2));
              tr_currency = "<p class='margin-padding-0 text_underline'>"+other_currency+"<span class='currency'>"+obj['Job']['Contract_Value_Type']+"</span></p><p class='margin-padding-0 text_underline'><span>Rate </span>"+obj['Job']['Contract_Value_Rate']+"</p>";
            }
            thai_bath = addCommas(parseFloat(thai_bath).toFixed(2));
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var g_content = obj['Guarantee'][i];
                 tr += "<tr>"+
                "<td class='text-vertical-top'>Term : "+g_content['Terms']+"</td>"+
                "<td class='td-search-term'>"+
                "<table>"+
                "<tr>"+
                "<td class='text-vertical-top'>Description</td><td class='td-colon'>:</td><td class='text_underline'>"+g_content['Guarantee_Type']+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Amount</td><td class='td-colon'>:</td><td class='text_underline'>"+ addCommas(parseFloat(g_content['Amount_Actual_Price']).toFixed(2)) + ' (' +g_content['Amount_Actual_Percentage']+"%)</td>"+
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
                var complete_date = ""
                if (p_content['Date_Actual'] != null){
                  complete_date = "<tr>"+
                    "<td class='text-vertical-top'>Payment Date Actual</td><td class='td-colon'>:</td><td class='text_underline'>"+p_content['Date_Actual']+"</td>"+
                    "</tr>";
                }
                tr += "<tr>"+
                "<td style='vertical-align: text-top;'>Term : "+p_content['Terms']+"</td>"+
                "<td class='td-search-term'>"+
                "<table>"+
                "<tr>"+
                "<td class='text-vertical-top'>Description</td><td class='td-colon'>:</td><td class='text_underline text-vertical-top'>"+p_content['Payment_Type']+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Amount</td><td class='td-colon'>:</td><td class='text_underline'>"+ addCommas(parseFloat(p_content['Amount_Actual_Price']).toFixed(2)) + ' (' +p_content['Amount_Actual_Percentage']+"%)"+"</td>"+
                "</tr>"+
                "<tr>"+
                "<td class='text-vertical-top'>Payment Date Plan</td><td class='td-colon'>:</td><td class='text_underline'>"+p_content['Payment_date_plan']+"</td>"+
                "</tr>"+
                complete_date+
                "</table>"+
                "</td>"+
                "</tr>";
              }
              table_payment = "<table border=0 style='width: 100%;' class='purchase-each-detail'>"+tr+"</table>";
            }
            
            var keySearch;
            if(search['type'] == "contract") {
              keySearch = "<h2 class='job-id'>"+obj['Contractor_Name']+"</h2>";
            }
            else if(search['type'] == "job") {
              keySearch = "<h2 class='job-id'>"+obj['JID']+"</h2>" 
            }
            else {
              keySearch = "<h2 class='job-id'>"+obj['PO_No']+"</h2>"
            }
            
           // console.log(obj)
            
            $("#content-search").append(
              "<article class='purchase-detail'>" +
              keySearch +
              "<div style='width: 100%;display:none;'>"+
              "<div style='width: 100%'>"+
              "<section class='content-search-left'>"+
              "<h3>Project Summary</h3>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td class='text-vertical-top'>JOB NO</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['JID']==null?'-':obj['Job']['JID'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Contract Name</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Contractor_Name']==null?'-':obj['Contractor_Name'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Name</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Project_Name']==null?'-':obj['Job']['Project_Name'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Location</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Project_Location']==null?'-':obj['Job']['Project_Location'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Project Owner's Name</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Project_Owner']==null?'-':obj['Job']['Project_Owner'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Secrecy Agreement</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Secrecy_Agreement']==null?'-':obj['Job']['Secrecy_Agreement'] == 0?"NO":"YES")+"</td></tr>"+
              "</table>"+
              "<h3>Working Remark</h3>"+
              "<p class='purchase-each-detail'><span>Start Date</span><span> : <span class='t2_desc text_underline'>"+(obj['Job']['Work_Start_Date']==null?'-':obj['Job']['Work_Start_Date'])+"</span></span><span>Complete Date</span><span> : <span class='t2_desc text_underline'>"+(obj['Job']['Work_Complete_Date']==null?'-':obj['Job']['Work_Complete_Date'])+"</span></span></p>"+
              "</section>"+
              "<section class='content-search-right'>"+
              "<h3>PO info</h3>"+
              //"<p class='purchase-each-detail' style='margin-left: 12px'><span>PO no</span><span class='t2_desc text_underline'>"+obj['PO_No']+"</span><span>Date</span><span class='t2_desc text_underline'>"+obj['Job']['PO_Date']+"</span></p>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td class='text-vertical-top'>PO no.</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['PO_No']==null?'-':obj['PO_No'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO Date</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['PO_Date']==null?'-':obj['Job']['PO_Date'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO type</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['PO_Type']==null?'-':obj['Job']['PO_Type'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>PO Amount</td><td class='td-colon'>:</td><td><p class='margin-padding-0 text_underline'>"+thai_bath+"<span class='currency'>THB</span></p>"+tr_currency+"</td></tr>"+
             // tr_currency+
              "<tr><td class='text-vertical-top'>Goveming Law</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Goveming_Law']==null?'-':obj['Job']['Goveming_Law'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Credit Term</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Credit_Term']==null?'-':obj['Job']['Credit_Term'])+"</td></tr>"+
              "<tr><td class='text-vertical-top'>Late Payment Financial Charges</td><td class='td-colon'>:</td><td class='text_underline text-vertical-top'>"+(obj['Job']['Late_Pay_Finan_Charge']==null?'-':obj['Job']['Late_Pay_Finan_Charge'] == 0?"NO":"YES")+"</td></tr>"+
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
          $(".t0, .t2, #wrap-main-menu").hide();
          $("#wrap-main-content, #wrap-header").removeClass("padding-left-300px");
          $("#content-search, .result-topics").html("");
        break;
      case 2:
          get_report_years();
          $(".t2, #wrap-main-menu").show();
          $(".t0, .t1").hide();
          $("#wrap-main-content").addClass("padding-left-300px");
          $("#content-report, .report-topics").html("");
        break;
      default:
          $(".t0").show();
          $(".t1, .t2, #wrap-main-menu").hide();
          $("#wrap-main-content, #wrap-header").removeClass("padding-left-300px");
          getPaymentAlertFeeds();
          getGuaranteeAlertFeeds();
          getPOIDNullAlertFeeds();
          getPaymentNearAlertFeeds();
          getCheckListsAlertFeeds();
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
        if(req['status'] == true){
          var max = parseInt(req['obj']['max']);
          var min = parseInt(req['obj']['min']);
          var diff = max - min;
          if(diff < 0) diff *= -1;
          var str = "";
          for(i=0; i<=diff;i++){
            var checked = i==0?"checked=checked":"";
						var class_check = i==0?"fa-check-circle-o":"fa-circle-o";
            var y = min + i;
            str += "<p class='report-year shadow'>"+
						"<i class='fa "+class_check+"'></i>"+
            "<input id='reports_year_"+y+"' type='checkbox' name='reports_year' class='reports_year' value='"+y+"' "+checked+"  style='display:none' />"+
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
  /*
  * resize
  */
  
  $(window).on("resize",function(){
    var w = $(window).width();
    if(w > 960){
      $("#wrap-report-show").show();
    }
  });
  
  function elementScroll(){
    var scroll = $(window).scrollTop();
    var cheight = $("#main-report-content").height();
    console.log($("#main-report-content").height())
    if(cheight > 800){
      if(scroll >= 135){
        $("#wrap-report").addClass('wrap-fixed');
      }
      else if(scroll <= 100){
        $("#wrap-report").removeClass('wrap-fixed');
      }
    }
    else{
      $("#wrap-report").removeClass('wrap-fixed');
    }
   // console.log(scroll)
    
  }
  
  $( document ).ajaxStart(function() {
   $(".ajax-loading").show();
  }).ajaxComplete(function() {
   $(".ajax-loading").hide();
  });
});