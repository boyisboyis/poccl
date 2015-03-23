$(document).ready(function(){
  
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
    html = html.replace(/next_number/g,len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-payment-terms").append(html);
  });
  
  $("#add-bank-guarantee").on("click", function(){
    var len = $("#list-bank-guarantee .table").length;
    var html = $("#clone-bank-guarantee").html();
    html = html.replace(/next_number/g,len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-bank-guarantee").append(html);
  });
  
  $("#show_foreign_currency").on("click", function(){
    $(".foreign_currency").slideToggle()
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
    console.log(formObj);
    for(var elem in formObj) {
      if(formObj[elem] == '') {
        $('input[name=' + elem + ']:not(input[type=checkbox])').first().addClass('input-error');
        $('select[name=' + elem + ']').first().addClass('input-error');
        checkInput = false;
      }
      console.log(elem + ' => ' + formObj[elem]);
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
    if(formObj['bank_guarantee_checkbox'] == 'check') {
      for(var counter in formObj['bank_guarantee']) {
        for(var elemWithin in formObj['bank_guarantee'][counter]) {
          if(formObj['bank_guarantee'][counter][elemWithin] == "") {
            $('input[name*="[' + counter + ']"][name=' + counter + '][name*=' + elemWithin + ']:not(input[type=checkbox])').first().addClass('input-error');
            $('select[name*="[' + counter + ']"][name=' + counter + '][name*=' + elemWithin + ']').first().addClass('input-error');
            checkInput = false;
          }
          console.log(elemWithin + ' => ' + formObj['bank_guarantee'][counter][elemWithin]);
        }
      }
    }
    if(formObj['secrecy_agreement'] == undefined) {
      $('input[name=secrecy_agreement][type=checkbox]').first().addClass('input-error');
      checkInput = false;
    }
    if(formObj['late_payment'] == undefined) {
      $('input[name=late_payment][type=checkbox]').first().addClass('input-error');
      checkInput = false;
    }
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
  })
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