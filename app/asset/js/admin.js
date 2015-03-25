$(document).ready(function(){
  var hash_str = ["#add", "#search", "#payment", "#guarantee"];
  getHash();
  
  $(".sub-menu").on("click", function(){
    document.location.hash = $(this).attr("href");
    getHash();
  });
  
  $("#search-now").on("click", function(){
    var data = {
      "type" : $("#select-search").val(),
      "search" : $("#input-search").val()
    }
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
    payment_terms_delete()
  });

  $("#list-bank-guarantee").on("click", ".delete-guarantee", function() {
    if($("#list-bank-guarantee .table").length > 1){
      $(this).parent(".table").remove();
      $("#list-bank-guarantee .delete-guarantee").show();
    }
    if($("#list-bank-guarantee .table").length <= 1){
      $("#list-bank-guarantee .delete-guarantee").hide();
    }
    payment_terms_delete()
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
  
  $("#form_add").submit(function(e){
    var checkInput = true;
    $(this).find('input').removeClass('input-error');
    $(this).find('select').removeClass('input-error');
    var formObj = $( this ).serializeObject();
    for(var elem in formObj) {
      if(formObj[elem] == '' && elem != 'foreign_currency_value' && elem != 'foreign_currency_type' && elem != 'foreign_currency_rate') {
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
  
  function searchResult(data){
    $.ajax({
        method: "POST",
        url: "adminsController",
        dataType: "json",
        data: {
          action: "search",
          params: data
        },
        success: function(response) {
          if(response['status'] == true){//admin-search-box-result
            var data = response['obj'];
            var str = "";
            $(data).each(function(){
              str += "<tr>" +
                "<td>"+this.JID+"</td>"+
                "<td>"+this.Contractor_Name+"</td>"+
                "<td>"+(this.PO_No==null?'-':this.PO_No)+"</td>"+
                "<td><a>Edit</a></td>"+
                "<td><a>Delete</a></td>"+
              "</tr>;"
            });
            if(str != "") {
              $("#admin-search-box-result tbody").html("");
              $("#admin-search-box-result tbody").append(str);
            }
            console.log(str)
          }
          else{
            
          }
          console.log(response);
        }
      });
  }
});




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