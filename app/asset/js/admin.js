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
  
  $("#check-payment-terms").on('click', function(){
    if($(this).prop('checked')){
      $("#show-payment-terms").slideDown();
    }
    else{
      $("#show-payment-terms").slideUp();
    }
  });
  
  $("#check-bank-guarantee").on('click', function(){
    if($(this).prop('checked')){
      $("#show-bank-guarantee").slideDown();
    }
    else{
      $("#show-bank-guarantee").slideUp();
    }
  });
  
  $("#add-payment-terms").on('click', function(){
    var len = $("#list-payment-terms .table").length;
    var html = $("#clone-payment-terms").html();
    html = html.replace("($number)",len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-payment-terms").append(html);
  });
  
  $("#add-bank-guarantee").on("click", function(){
    var len = $("#list-bank-guarantee .table").length;
    var html = $("#clone-bank-guarantee").html();
    html = html.replace("($number)",len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-bank-guarantee").append(html);
  });
  
  $("#show_foreign_currency").on("click", function(){
    $(".foreign_currency").slideToggle();
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
    var formObj = $( this ).serializeObject();
    for(var elem in formObj) {
      if(formObj[elem] == "") {
        $('input[name=' + elem + ']').first().addClass('input-error');
        checkInput = false;
      }
    }
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
                "<td>"+this.Contactor_Name+"</td>"+
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