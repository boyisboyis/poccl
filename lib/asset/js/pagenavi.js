(function ( $ ) {
  
  $.fn.pagenavi = function(options ) {
    var settings = $.extend({
      showPerPage: 10,
			position: "left"
    }, options );
   var t = this;
    $(document).ajaxStop(function(){
       $("#"+t.attr('id')+" .page-list").each(function(){
         var children = $(this).children();
         var per = children.length/settings.showPerPage;
         if(per > 0 && per > 1){
           var nper = Math.ceil(per);
           var children_split = [];
           var tpage = "";
           $(this).html("");
           for (num = 1, i = 0, len = children.length; i < len; i += settings.showPerPage) {
             var str_class = "div-page";
             if(i > 0){
               str_class += " hide";
             }
              var e = $("<div>", {
                "data-num" : num++,
                class: str_class,
                html: children.slice(i, i + settings.showPerPage)
              });
              $(this).append(e);
           }
           var min_height = $(this).find(".div-page").first().height();
           $(this).find(".div-page").css({"min-height":min_height+'px'});
           
           for(i=1;i<=nper;i++){
						 var cl = "";
						 var fbig = "";
						 if(i > settings.showPerPage){
							 cl = "hide";
						 }
						 if(i==1) {
							 fbig = " fbig";
						 }
             tpage += "<li class="+cl+"><a class='switch-page "+fbig+"' href='javascript:void(0)' data-num="+i+" data-maxpage="+nper+">"+i+"</a></li>";
           }
           $(this).append("<div class='navlist "+settings.position+"'><i class='fa fa-chevron-left page-prevent' style='display:none' data-maxpage="+nper+"></i><ol>"+tpage+"</ol><i class='fa fa-chevron-right page-next' data-maxpage="+nper+"></i></div>");
         }
       });
    });
    
    $(this).on("click",".switch-page", function(){
      var p = $(this).data("num");
			manage_nav_page($(this), p);
    });
		$(this).on("click" , ".page-prevent", function(){
			var t = $(this).next().children().find(".fbig");
			var p = t.data('num');
			var pr = p - 1;
			if(pr > 0) {
				manage_nav_page(t.parent().prev().children(),pr);
			}
		});
		$(this).on("click" , ".page-next", function(){
			var t = $(this).siblings().find(".fbig");
			var p = t.data('num');
			var max = $(this).data('maxpage');
			var pr = p + 1;
			if(pr <= max) {
				manage_nav_page(t.parent().next().children(),pr);
			}
		});
		
		function manage_nav_page (ele, p) {
			var parent = ele.parent().parent().parent().siblings(".div-page");
			ele.parent().siblings().find(".switch-page").removeClass("fbig");
			ele.addClass("fbig");
      parent.siblings(".div-page").addClass('hide');
      parent.siblings(".div-page[data-num="+p+"]").removeClass("hide");
			changeNavi(ele);
		}
		
		function changeNavi(ele) {
			var current_page = ele.data("num");
			var max_page = ele.data("maxpage");
			var sib = ele.parent().parent();
			if(current_page > 1) {
				sib.siblings(".page-prevent").show();
				var start = 0;
				var end = 9;
				if(current_page > 6){
					start = (current_page - 5) - 1;
					end = (current_page + 4) - 1;
					if(end + 1  > max_page){
						end = max_page - 1;
						start = max_page - 10;
					}
				}
				ele.parent().siblings().andSelf().each(function(key, value){
					if(key >= start && key <= end){
						$(this).removeClass('hide');
					}
					else{
						$(this).addClass('hide');
					}
				});
			}
			else{
				sib.siblings(".page-prevent").hide();
			}
			if(current_page == max_page){
				sib.siblings(".page-next").hide();
			}
			else{
				sib.siblings(".page-next").show();
			}
		}
    
    
    return this;
  };
  
}( jQuery ));