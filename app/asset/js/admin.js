$(document).ready(function(){
  var hash_str = ["#add", "#search", "#payment", "#guarantee"];
	var delete_jid = "";
	var delete_index = "";
	
	var update_jid = "";
	var update_readonly = false;
	var update_type = "";
	var update = "";
  getHash();
  
  $(".sub-menu").on("click", function(){
    document.location.hash = $(this).attr("href");
    getHash();
  });
	
	 $("#admin-search-box-content").on("click", ".job-id-toggle", function(){
    $(this).parent().next().slideToggle();
  });
  
  $("#search-now").on("click", function(){
    var data = {
      "type" : $("#select-search").val(),
      "search" : $("#input-search").val()
    };
    searchResult(data);
  });
  
  $("#list-payment-terms").on("click", ".delete-payment", function() {
    if($("#list-payment-terms .table").length > 1){
      //console.log($(this).parent(".table"));
      $(this).parent(".table").remove();
      $("#list-payment-terms .delete-payment").show();
    }
    if($("#list-payment-terms .table").length <= 1){
      $("#list-payment-terms .delete-payment").hide();
    }
    payment_terms_delete();
  });

  $("#list-bank-guarantee").on("click", ".delete-guarantee", function() {
    if($("#list-bank-guarantee .table").length > 1){
      $(this).parent(".table").remove();
      $("#list-bank-guarantee .delete-guarantee").show();
    }
    if($("#list-bank-guarantee .table").length <= 1){
      $("#list-bank-guarantee .delete-guarantee").hide();
    }
    payment_terms_delete();
  });
  
  $("#check-payment-terms").on('click', function(){
    if($(this).prop('checked')){
      $("#show-payment-terms").slideDown();
    }
    else{
      $("#show-payment-terms").slideUp();
    }
    payment_terms_delete();
  });
  
  $("#check-bank-guarantee").on('click', function(){
    if($(this).prop('checked')){
      $("#show-bank-guarantee").slideDown();
    }
    else{
      $("#show-bank-guarantee").slideUp();
    }
    bank_guarantee_delete();
  });
  
  $("#add-payment-terms").on('click', function(){
    var len = $("#list-payment-terms .table").length;
    var html = $("#clone-payment-terms").html();
    html = html.replace(/next_number/g,len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-payment-terms").append(html);
    payment_terms_delete();
  });
  
  $("#add-bank-guarantee").on("click", function(){
    var len = $("#list-bank-guarantee .table").length;
    var html = $("#clone-bank-guarantee").html();
    html = html.replace(/next_number/g,len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-bank-guarantee").append(html);
    bank_guarantee_delete();
  });
  
  $("#show_foreign_currency").on("click", function(){
    if($(".foreign_currency").is(":visible")){
      $(this).find(".fa").removeClass("fa-minus").addClass("fa-plus");
      $("#add_foreign_currency_checkbox").val("hide");
    }
    else{
      $(this).find(".fa").removeClass("fa-plus").addClass("fa-minus");
      $("#add_foreign_currency_checkbox").val("show");
    }
    $(".foreign_currency").toggle();
  });
  
  $("#show-payment-terms").on("click", ".payment_amount", function(){
    $(this).parent().parent().parent().find('.payment_amount_value').prop('disabled', true).val('');
    $(this).parent().parent().find('input[type=text]').prop('disabled', false);
  });
  
  $("#show-bank-guarantee").on("click", ".bank_guarantee", function(){
    $(this).parent().parent().siblings().find('.bank_guarantee_value').prop('disabled', true).val('');
    $(this).parent().parent().find('input[type=text]').prop('disabled', false);
  });
	
	$("#admin-search-box-content").on('click', '.input-readonly', function(){
		if($(this).prop("readonly") && update === ""){
			$(this).prop("readonly", false);
			update = $(this);
/* 			$(this).prop("readonly",false);
			update_jid = $(this).data('jid');
			update_readonly = true;
			update_type = $(this).data('type'); */
		}
	});
	
	$(window).on('click', function(e) {
		if(update){
			if(e.target.localName === 'input' && e.target.className === 'input-readonly'){
				if(update.data('jid') == $(e.target).data('jid')){
					if(update.data('type') != $(e.target).data('type')){
						save_element();
					}
				}
				else {
					save_element();
				}
				$(e.target).prop("readonly", false);
				update = $(e.target);
			}
			else{
				save_element();
				update = "";
			}
		}
	}).on("keyup", function(e){
		var key_code = e.which || e.keyCode;
		if(key_code == 13 && update !== "") {
			save_element();
			update = "";
		}
	});
	
	function save_element(){
		var jid = update.data('jid');
		var type = update.data('type');
		var value = update.val();
		$(".input-readonly").prop("readonly", true);
		console.log(jid, type, value);
		console.log("save");
		$("#show-save p").html("Saving").show();
		$("#show-save").show();
		setTimeout(function(){
			$("#show-save p").html("Save");
			setTimeout(function(){
				$("#show-save").hide();
				}, 2000);
		}, 5000);
		
	}
  
  $("#form_add").submit(function(e){
    var checkInput = true;
    $(this).find('input').removeClass('input-error');
    $(this).find('select').removeClass('input-error');
    var formObj = $( this ).serializeObject();
    for(var elem in formObj) {
      if(formObj[elem] === '' && elem != 'foreign_currency_value' && elem != 'foreign_currency_type' && elem != 'foreign_currency_rate') {
        $('input[name=' + elem + ']:not(input[type=checkbox])').first().addClass('input-error');
        $('select[name=' + elem + ']').first().addClass('input-error');
        checkInput = false;
        console.log(elem + ' => ' + formObj[elem]);
      }
    }
    if(formObj['add_foreign_currency_checkbox'] != 'hide') {
      if(formObj['foreign_currency_value'] == '') {
        $('input[name=foreign_currency_value]:not(input[type=checkbox])').first().addClass('input-error');
        checkInput = false;
        console.log('foreign_currency_value => ' + formObj['foreign_currency_value']);
      }
      if(formObj['foreign_currency_type'] == '') {
        $('input[name=foreign_currency_type]:not(input[type=checkbox])').first().addClass('input-error');
        checkInput = false;
        console.log('foreign_currency_type => ' + formObj['foreign_currency_type']);
      }
      if(formObj['foreign_currency_rate'] == '') {
        $('input[name=foreign_currency_rate]:not(input[type=checkbox])').first().addClass('input-error');
        checkInput = false;
        console.log('foreign_currency_rate => ' + formObj['foreign_currency_rate']);
      }
    }
    if(formObj['payment_terms_checkbox'] == 'check') {
      for(var counter in formObj['payment_terms']) {
        for(var elemWithin in formObj['payment_terms'][counter]) {
          if(formObj['payment_terms'][counter][elemWithin] == "") {
            $('input[name*="[' + counter + ']"][name*=' + elemWithin + ']:not(input[type=checkbox])').first().addClass('input-error');
            $('select[name*="[' + counter + ']"][name*=' + elemWithin + ']').first().addClass('input-error');
            checkInput = false;
          }
          console.log(elemWithin + ' => ' + formObj['payment_terms'][counter][elemWithin]);
        }
      }
    }
    else {
      formObj['payment_terms'] = "";
    }
    if(formObj['bank_guarantee_checkbox'] == 'check') {
      for(var counter in formObj['bank_guarantee']) {
        for(var elemWithin in formObj['bank_guarantee'][counter]) {
          if(formObj['bank_guarantee'][counter][elemWithin] == "") {
            $('input[name*="[' + counter + ']"][name*=' + elemWithin + ']:not(input[type=checkbox])').first().addClass('input-error');
            $('select[name*="[' + counter + ']"][name*=' + elemWithin + ']').first().addClass('input-error');
            checkInput = false;
          }
          console.log(elemWithin + ' => ' + formObj['bank_guarantee'][counter][elemWithin]);
        }
      }
    }
    else {
      formObj['bank_guarantee'] = "";
    }
    if(formObj['secrecy_agreement'] == undefined) {
      $('input[name=secrecy_agreement][type=checkbox]').first().addClass('input-error');
      checkInput = false;
    }
    if(formObj['late_payment'] == undefined) {
      $('input[name=late_payment][type=checkbox]').first().addClass('input-error');
      checkInput = false;
    }
    console.log(formObj);
    console.log('====================================');
    if(checkInput) {
      $.ajax({
        method: "POST",
        url: "adminsController",
        data: {
          action: "new",
          params: formObj
        },
        success: function(data) {
          console.log(data);
        }
      });
    }
    return false;
  });
	
 	$('#admin-search-box-content').on('click', '.admin-search-delete', function() { 
		delete_jid = $(this).data('jid');
		delete_index = $(this).data("index");
		$("#admin-search-box-alert").show();
	});
	
	$("#confirm-yes").on("click", function() {
			$.ajax({
				method: "POST",
				url: "adminsController",
				dataType: "json",
				data: {
					action: "delete",
					params: delete_jid
			},
			success: function(data) {
				if(data['status']){
					$("#"+delete_index).remove();
				}
				$("#confirm-no").click();
				console.log(data);
			},
			error: function (error){
				$("#confirm-no").click();
			}
		});
			
	});
	
	$("#confirm-no").on("click", function() {
		delete_jid = "";
		delete_index = "";
		$("#admin-search-box-alert").hide();
	});
  
  function getHash(){
    var hash = location.hash;
    hashManagement(hash);
  }
  
  function payment_terms_delete(){
    $("#show-payment-terms .delete-payment").hide();
    if($("#show-payment-terms .delete-payment").length > 1){
      $("#show-payment-terms .delete-payment").last().show();
    }
  }
  
  function bank_guarantee_delete(){
    $("#show-bank-guarantee .delete-guarantee").hide();
    if($("#show-bank-guarantee .delete-guarantee").length > 1){
      $("#show-bank-guarantee .delete-guarantee").last().show();
    }
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
  
  function init(index){
    switch (index) {
      case 0:
        $(".t1").hide();
        $(".t0").show();
        break;
      case 1:
        $(".t0").hide();
        $(".t1").show();
        break;
      default:
        // code
    }
  }
  
  function searchResult(search){
    $.ajaxSetup({ cache: false });
    $.ajax({
      type: "POST",
      dataType: "json",
      data: search,
      url : "search_options",
      cache: false,
      success: function(req){
        $("#admin-search-box-content").html("");
        if(req['status'] == true){
          $(".result-topics").html("<i class='fa fa-check color-success'></i>Result");
					var index = -1;
          $.each(req['obj'], function(){
            var obj = $(this)[0];
            var table_guarantee = "<p class='p-warning'>Guarantee is not set</p>";
            var table_payment = "<p class='p-warning'>Payment is not set</p>";
            var n = obj['Guarantee'].length;
            var thai_bath = obj['Job']['Contract_Value_THB'];
            var tr_currency = "";
            if(thai_bath === "" || thai_bath === null){
              thai_bath = obj['job']['Contract_Value_Rate'] * obj['job']['Contract_Value_Other'];
            }
            if(obj['Job']['Contract_Value_Type'] !== "" && obj['Job']['Contract_Value_Type'] !== null){
              other_currency = addCommas(parseFloat(obj['Job']['Contract_Value_Other']).toFixed(2));
              tr_currency = "<p class='margin-padding-0 text_underline'>"+other_currency+"<span class='currency'>"+obj['Job']['Contract_Value_Type']+"</span></p><p class='margin-padding-0 text_underline'><span>Rate </span>"+obj['Job']['Contract_Value_Rate']+"</p>";
            }
            thai_bath = addCommas(parseFloat(thai_bath).toFixed(2));
            if(n > 0){
              var tr = "";
              for(var i=0;i<n;i++){
                var g_content = obj['Guarantee'][i];
                if(g_content['Amount_Actual_Percentage'] != null && g_content['Amount_Actual_Price'] != null){
                  var g_amount = (g_content['Amount_Actual_Percentage'] == "" || g_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(g_content['Amount_Actual_Price']).toFixed(2)):g_content['Amount_Actual_Percentage']+"%";
                }
                else{
                  var g_amount = '-';
                }
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
               // var p_amount = (p_content['Amount_Actual_Percentage'] == "" || p_content['Amount_Actual_Percentage'] == null)?addCommas(parseFloat(p_content['Amount_Actual_Price']).toFixed(2)):p_content['Amount_Actual_Percentage']+"%";
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
                "</table>"+
                "</td>"+
                "</tr>";
              }
              table_payment = "<table border=0 style='width: 100%;' class='purchase-each-detail'>"+tr+"</table>";
            }
            
            var keySearch;
            if(search['type'] == "contract") {
              keySearch = obj['Contractor_Name'];
            }
            else if(search['type'] == "job") {
              keySearch = obj['JID'];
            }
            else {
              keySearch = obj['PO_No'];
            }
            
           // console.log(obj)
						
            index++;
            $("#admin-search-box-content").append(
              "<article class='purchase-detail' id='serach-"+index+"'>" +
              "<h2 class='job-id'><span class='job-id-toggle'>"+keySearch+"</span>"+
							"<i class='fa fa-trash-o admin-search-delete' data-jid='"+obj['Job']['JID']+"' data-index='serach-"+index+"'></i>"+
							"</h2>"+
              "<div style='width: 100%;display:none;'>"+
              "<div style='width: 100%'>"+
              "<section class='content-search-left'>"+
              "<h3>Project Summary</h3>"+
              "<table class='purchase-each-detail'>"+
              "<tr><td class='text-vertical-top'>JOB NO</td><td class='td-colon'>:</td><td><input name='job_no-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='jid' class='input-readonly' type='text' value='"+(obj['Job']['JID']==null?'':obj['Job']['JID'])+"' readonly='readonly'></td></tr>"+
              "<tr><td class='text-vertical-top'>Contract Name</td><td class='td-colon'>:</td><td><input name='contractor_name-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='contractor_name'  class='input-readonly' type='text' value='"+(obj['Job']['Contractor_Name']==null?'':obj['Job']['Contractor_Name'])+"' readonly='true'></td></tr>"+
              "<tr><td class='text-vertical-top'>Project Name</td><td class='td-colon'>:</td><td><input name='project_name-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='project_name' class='input-readonly' type='text' value='"+(obj['Job']['Project_Name']==null?'':obj['Job']['Project_Name'])+"' readonly='true'></td></tr>"+
              "<tr><td class='text-vertical-top'>Project Location</td><td class='td-colon'>:</td><td><input name='project_location-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='project_location' class='input-readonly' type='text' value='"+(obj['Job']['Project_Location']==null?'':obj['Job']['Project_Location'])+"' readonly='true'></td></tr>"+
              "<tr><td class='text-vertical-top'>Project Owner's Name</td><td class='td-colon'>:</td><td><input name='project_owner_name-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='project_owner_name' class='input-readonly' type='text' value='"+(obj['Job']['Project_Owner']==null?'':obj['Job']['Project_Owner'])+"' readonly='true'></td></tr>"+
              "<tr><td class='text-vertical-top'>Secrecy Agreement</td><td class='td-colon'>:</td><td>"+
              "<input name='secrecy_agreement-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='secrecy_agreement' class='input-readonly' type='radio' value='true' "+(obj['Job']['Secrecy_Agreement'] == 1?"checked":"")+" />"+
							"<label for='' class='fa fa-check'></label>"+
							"<input name='secrecy_agreement-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='secrecy_agreement' class='input-readonly' type='radio' value='false' "+(obj['Job']['Secrecy_Agreement'] == 0?"checked":"")+" />"+
							"<label for='' class='fa fa-times'></label>"+
							"</td><td>"+
							"<input name='secrecy_agreement-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='secrecy_agreement' class='input-readonly' type='checkbox' value='none' "+(obj['Job']['Secrecy_Agreement'] == null?"checked":"")+"><label for=''>None</label>"+
							"</td></tr>"+
							"</table>"+
              "<h3>Working Remark</h3>"+
							"<table>"+
							"<tr>"+
							"<td class='text-vertical-top'>Start Date</td><td class='td-colon'>:</td><td><input name='start_date-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='start_date' class='input-readonly' type='date' value='"+(obj['Job']['Work_Start_Date']==null?'':obj['Job']['Work_Start_Date'])+"' readonly='true'></td>"+
							"</tr>"+
							"<tr>"+
							"<td class='text-vertical-top'>Complete Date</td><td class='td-colon'>:</td><td><input name='complete_date-"+index+"' data-id='serach-"+index+"' data-jid='"+obj['Job']['JID']+"' data-type='complete_date' class='input-readonly' type='date' value='"+(obj['Job']['Work_Complete_Date']==null?'':obj['Job']['Work_Complete_Date'])+"' readonly='true'></td>"+
							"</tr>"+
							"</table>"+
              //"<p class='purchase-each-detail'><span>Start Date</span><span> : <span class='t2_desc text_underline'>"+(obj['Job']['Work_Start_Date']==null?'-':obj['Job']['Work_Start_Date'])+"</span></span><span>Complete Date</span><span> : <span class='t2_desc text_underline'>"+(obj['Job']['Work_Complete_Date']==null?'-':obj['Job']['Work_Complete_Date'])+"</span></span></p>"+
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
              "<tr><td class='text-vertical-top'>Goveming Law</td><td class='td-colon'>:</td><td class='text_underline'>"+(obj['Job']['Project_Location']==null?'-':obj['Job']['Project_Location'])+"</td></tr>"+
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
	$( document ).ajaxStart(function() {
   $(".ajax-loading").show();
  }).ajaxComplete(function() {
   $(".ajax-loading").hide();
  });
});

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


(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);