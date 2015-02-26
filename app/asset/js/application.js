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
  
  function init(type){
    switch (parseInt(type)) {
      case 1:
          $(".t1, #wrap-back-home").show();
          $(".t0").hide();
        break;
      
      default:
          $(".t0").show();
          $(".t1, #wrap-back-home").hide();
        break;
    }
  }
});