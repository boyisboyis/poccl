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
    html = html.replace("($number)",len + 1);
    html = html.replace(/numbers/g,len);
    $("#list-payment-terms").append(html);
  });
  
  $("#test-payment-terms").on('click', function(){
    console.log($("input[name^=new]"))
  });
  
  $("#form_add").submit(function(e){
    return ;
  })
});