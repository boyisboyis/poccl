$(document).on("submit", "#form-login", function (e) {
    var u = $(this).find("#username").val();
    var p = $(this).find("#password").val();
    if(u == "" || p == ""){
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
          console.log(req)
        }
      });
    }
   
    return false;
})