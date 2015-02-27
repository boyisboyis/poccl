$(document).ready(function(){
  var hash_str = ["#home", "#search"];
  getHash();
  
  /*
  * event
  */
  
  $(".back-home").on("click", function(){
    document.location.hash = $(this).attr("href");
    getHash();
  });
  
  $("#content-payment-news").on("click", '.search-from-news', function(){
    document.location.hash = $(this).attr("href");
    var search = $(this).data('jid');
    getHash();
    var data = {
      "type" : "job",
      "search" : search
    }
    searchResult(data);
  });
  
  $("#content-guarantee-news").on("click", '.search-from-news', function(){
    document.location.hash = $(this).attr("href");
    var search = $(this).data('jid');
    getHash();
    var data = {
      "type" : "job",
      "search" : search
    }
    searchResult(data);
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
  
  function searchResult(search){
    console.log(search);
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
      dataType: "json",
      data: search,
      url : "search_options",
      cache: false,
      success: function(req){
        console.log(req);
        console.log(req['status']);
        $("#content-search").html("");
        if(req['status'] == true){
          console.log(req);
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
               tr_currency = "<tr><td></td><td></td><td>Rate <span class='t2_desc text_underline'>"+obj['Job']['Contract_Value_Rate']+"</span><span class='t2_desc text_underline' style='margin-right: 0;'>"+obj['Job']['Contract_Value_Other']+"</span>  "+obj['Job']['Contract_Value_Type']+"</td></tr>"
            }
            thai_bath = addCommas(parseFloat(thai_bath).toFixed(2));
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var g_content = obj['Guarantee'][i];
                var g_amount = (g_content['Amount_Actual_Percentage'] == "" || g_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(g_content['Amount_Actual_Price']).toFixed(2)):g_content['Amount_Actual_Percentage']+"%";
                tr += "<tr>"+
                "<td>"+g_content['Guarantee_Type']+"</td><td class='text-center'>"+g_content['Terms']+"</td><td class='text-center>"+g_amount+"</td><td>"+g_content['Start_Plan']+"</td><td>"+g_content['Until_Plan']+"</td>"+
                "</tr>";
              }
              table_guarantee = "<table border=1 style='width: 70%;' class='purchase-each-detail'><tr><th>Description</th><th>Terms</th><th>Amount</th><th>Start Plan</th><th>Until Plan</th></tr>"+tr+"</table>";
            }
            n = obj['Payment'].length; 
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var p_content = obj['Payment'][i];
                var p_amount = (p_content['Amount_Actual_Percentage'] == "" || p_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(p_content['Amount_Actual_Price']).toFixed(2)):p_content['Amount_Actual_Percentage']+"%";
                tr += "<tr>"+
                "<td>"+p_content['Payment_Type']+"</td><td class='text-center'>"+p_content['Terms']+"</td><td class='text-center>"+p_amount+"</td><td>"+p_content['Payment_date_plan']+"</td>"+
                "</tr>";
              }
              table_payment = "<table border=1 style='width: 70%;' class='purchase-each-detail'><tr><th>Description</th><th>Terms</th><th>Amount</th><th>Payment Date Plan</th></tr>"+tr+"</table>";
            }
            $("#content-search").append(
              "<section class='purchase-detail'>"+
              "<h2 class='job-id'>"+obj['JID']+"</h2>"+
              "<div>"+
              "<h3>Project Summary</h3>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td>Contract Name</td><td>:</td><td class='text_underline'>"+obj['Contactor_Name']+"</td></tr>"+
              "<tr><td>Project Name</td><td>:</td><td class='text_underline'>"+obj['Job']['Project_Name']+"</td></tr>"+
              "<tr><td>Project Location</td><td>:</td><td class='text_underline'>"+obj['Job']['Project_Location']+"</td></tr>"+
              "<tr><td>Project Owner's Name</td><td>:</td><td class='text_underline'>"+obj['Job']['Project_Owner']+"</td></tr>"+
              "<tr><td>Secrecy Agreement</td><td>:</td><td class='text_underline'>"+obj['Job']['Secrecy_Agreement']+"</td></tr>"+
              "</table>"+
              "<h3>Working Remark</h3>"+
              "<p class='purchase-each-detail'><span>Start Date</span><span class='t2_desc text_underline'>"+obj['Job']['Work_Start_Date']+"</span><span>Complete Date</span><span class='t2_desc text_underline'>"+obj['Job']['Work_Complete_Date']+"</span></p>"+
              "<h3>PO info</h3>"+
              "<p class='purchase-each-detail'><span>SPO no</span><span class='t2_desc text_underline'>"+obj['PO_No']+"</span><span>Date</span><span class='t2_desc text_underline'>"+obj['Job']['PO_Date']+"</span></p>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td>PO type</td><td>:</td><td class='text_underline'>"+obj['Job']['PO_Type']+"</td></tr>"+
              "<tr><td>PO Amount</td><td>:</td><td><span class='text_underline'>"+thai_bath+"</span> THB</td></tr>"+
              tr_currency+
              "<tr><td>Goveming Law</td><td>:</td><td class='text_underline'>"+obj['Job']['Project_Location']+"</td></tr>"+
              "</table>"+
              "<h3>Payment Terms</h3>"+
              table_payment+
              "<table class='purchase-each-detail'>"+
              "<tr><td>Credit Term</td><td class='text_underline'>"+obj['Job']['Credit_Term']+"</td></tr>"+
              "<tr><td>Late Payment Financial Charges</td><td class='text_underline'>"+obj['Job']['Late_Pay_Finan_Chage']+"</td></tr>"+
              "</table>"+
              "<h3>Bank Guarantee</h3>"+
              table_guarantee+
              "</div>"+
              "</section>"
            );
          });
        }
        else{
          console.log("false");
        }
      }
    });
  }
  
  function addCommas(nStr)
	{
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
          $(".t1, #wrap-back-home").show();
          $(".t0").hide();
        break;
      
      default:
          $(".t0").show();
          $(".t1, #wrap-back-home").hide();
          getPaymentAlertFeeds();
          getGuaranteeAlertFeeds();
        break;
    }
  }
});