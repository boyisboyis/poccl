$(document).ready(function (){
  $( document ).ajaxStart(function() {
   $(".ajax-loading").show();
  }).ajaxComplete(function() {
   $(".ajax-loading").hide();
  });
});

$(document).on("submit", "#form-login", function (e) {
    var u = $(this).find("#username").val();
    var p = $(this).find("#password").val();
    console.log(u,p);
    if(u == "" || p == ""){
      openError(1);
    }
    else{
       $.ajax({
        url: "login_controller",
        method: "POST",
        dataType: "json",
        data: {
          "user" : {
            "username" : u,
            "password" : p
          }
        },
        success: function(req){
          if(req['status'] == true){
            window.location = "home";
          }
          else{
            openError(req['error'])
          }
        }
      });
    }
   
    return false;
});


function openError(t){
  if(t==1){
     $("#box-error .e-1").hide();
     $("#box-error, #box-error .e-0").show();
  }
  else{
     $("#box-error .e-0").hide();
     $("#box-error, #box-error .e-1").show();
  }
}
