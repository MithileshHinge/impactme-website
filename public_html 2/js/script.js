$(function(){var a=$(".sys_show_popup_login"),b=$("#sys_popup_common");$("#md-slider-1").length&&$("#md-slider-1").mdSlider({fullwidth:!0,transitions:"fade",width:980,height:365,responsive:!0,slideShowDelay:6e3,slideShow:!0,loop:!0,showLoading:!1,showArrow:1,showBullet:1,posBullet:2,showThumb:!1,enableDrag:!0}),$("#slider1").length>0&&$("#slider1").responsiveSlides({auto:!1,pager:!0,nav:!0,speed:500,maxwidth:800,namespace:"centered-btns"}),$(".tabbable").on("click",".nav-tabs > li",function(){if($(this).hasClass("disable"))return!1;var a=$(this).index();return $(this).siblings().removeClass("active").end().addClass("active"),$(this).parents(".tabbable").find(".tab-content .tab-pane").removeClass("active").eq(a).addClass("active"),!1}),$(".accordion").on("click",".accordion-label",function(){return $(this).hasClass("active")?$(this).removeClass("active").siblings(".accordion-content").slideUp(400,function(){$(this).removeClass("active").removeAttr("style")}):($(this).parents(".accordion").find(".accordion-label").removeClass("active"),$(this).addClass("active").siblings(".accordion-content").slideDown(400,function(){$(this).addClass("active").removeAttr("style")}),$(this).parent().siblings().find(".accordion-content").slideUp(400,function(){$(this).removeClass("active").removeAttr("style")})),!1}),a.on("click",function(){return b.fadeIn(),$("body").on("keydown.closePopup",function(a){var c=a.keyCode?a.keyCode:a.which;27==c&&b.find(".closePopup").trigger("click")}),!1}),b.on("click.closePopup",".closePopup,.overlay-bl-bg",function(){b.fadeOut(function(){$("body").off("keydown.closePopup")})}),b.on("click",".main-content",function(a){a.stopPropagation()}),$("#showmoreproject").bind("click",function(a){return _self=$(this),_self.text("Loading..."),$.ajax({url:"ajax/category.php"}).done(function(a){$("#list-project-ajax").append(a),_self.text("Show more projects")}),!1}),$("#showmorepost").bind("click",function(a){return _self=$(this),_self.text("Loading..."),$.ajax({url:"ajax/blog.php"}).done(function(a){$("#list-blog-ajax").append(a),_self.text("Show more posts")}),!1}),$("#showmoreresults").bind("click",function(a){return _self=$(this),_self.text("Loading..."),$.ajax({url:"ajax/search-results.php"}).done(function(a){$("#list-search-ajax").append(a),_self.text("Show more projects")}),!1}),jQuery("#contact-form").length>0&&jQuery("#contact-form").validate({rules:{name:{required:!0,minlength:2},email:{required:!0,email:!0},message:{required:!0,minlength:10}},messages:{name:{required:"Please enter your name.",minlength:jQuery.format("At least {0} characters required.")},email:{required:"Please enter your email.",email:"Please enter a valid email."},message:{required:"Please enter a message.",minlength:jQuery.format("At least {0} characters required.")}},submitHandler:function(a){return jQuery("#submit-contact").attr("value","Sending..."),jQuery(a).ajaxSubmit({success:function(b,c,d,e){jQuery("#response").html(b).hide().slideDown("fast"),jQuery("#submit-contact").attr("value","Submit"),jQuery(a).find("input[type=text]").val(""),jQuery(a).find("input[type=email]").val(""),jQuery(a).find("input[type=url]").val(""),jQuery(a).find("textarea").val("")}}),!1}});var c=$("#sys_btn_toggle_search"),d=$("#sys_header_right");c.on("click",function(){d.slideToggle(function(){$(this).is(":visible")?$(this).addClass("active"):$(this).removeClass("active")/*,$(this).removeAttr("style")*/}),c.toggleClass("active")}),$("#btn-toogle-menu").sidr({side:"left",name:"alternate-menu",source:"#right-menu"}),$("#sys-nav-menu-blog").length>0&&selectnav("sys-nav-menu-blog")});