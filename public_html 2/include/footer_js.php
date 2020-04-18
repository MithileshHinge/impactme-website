    <script type="text/javascript" src="<?=BASEPATH?>/js/raphael-min.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/jquery.touchwipe.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/md_slider.min.js"></script>
	<script type="text/javascript" src="<?=BASEPATH?>/js/jquery.sidr.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.tweet.min.js"></script> -->
    <script type="text/javascript" src="<?=BASEPATH?>/js/pie.js"></script>
    <script type="text/javascript" src="<?=BASEPATH?>/js/script.js"></script>
    
    <script>
	function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
	</script>
    <?php if(basename($_SERVER[PHP_SELF]) == "post_details.php") { ?>
    <script type="text/javascript" src="<?=BASEPATH?>/js/comment1.js"></script>
    <?php } else { ?>
    <script type="text/javascript" src="<?=BASEPATH?>/js/comment.js"></script>
    <?php } ?>
    <script>
    
     $(document).ready(function() {
	 
	  $("#reset_search").click(function(){
	 
	  //  $("#searchResult").empty();
	    $("#sys_txt_keyword").val("");
	    $(".search-div").css("display", "none");
		 $("#searchResult").empty();
	  });
	  
$('input, :input').attr('autocomplete', 'off');
  $("#sys_txt_keyword").keyup(function(){

        var search = $(this).val();
		search=  $.trim(search);
      
        if(search != "" ){

            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_user.php',
                type: 'post',
                data: {user_name:search},
                dataType: 'json',
                success:function(response){
               

                    var len = response.length;
                   $(".search-div").css("display", "block");
                    $("#searchResult").empty();
					
                    for( var i = 0; i<len; i++){

                        var id = response[i]['id'];
                        var uname = response[i]['name'];
						var image = response[i]['image'];
						var path = response[i]['profile_link'];
						var tag_line = response[i]['tag_line'];
						if(tag_line== null)
						 tag_line = '&nbsp;';
						if(uname== null)
						 uname = '&nbsp;'; 
                       

                        $("#searchResult").append("<li> <a href='"+path+"' class='search_anchor'><div class='small-creater' style='background-image:url("+image+");  background-size:cover;'></div><div class='small_div'><span class='creator_title'>"+uname+"</span><p class='gray2'>"+tag_line+"</p></div></a></li>");
                    }
					if(len==5)
					{
					  $("#searchResult").append("<li><a href='<?=BASEPATH?>/search/?s="+search+"'><div class='see-result'>See all Result</div></li>");
					  }

                }
            });
        }
		else
		{
		 $(".search-div").css("display", "none");
		 $("#searchResult").empty();
		}
    });

 });
 
 </script>
 <script>
    
     $(document).ready(function() {
	 
	  $("#reset_search").click(function(){
	 
	  //  $("#searchResult").empty();
	    $("#sys_txt_keyword").val("");
	    $(".search-div").css("display", "none");
		 $("#searchResult").empty();
	  });
	  
$('input, :input').attr('autocomplete', 'off');
  $("#sys_txt_keyword").keyup(function(){

        var search = $(this).val();
		search=  $.trim(search);
      
        if(search != "" ){

            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_user.php',
                type: 'post',
                data: {user_name:search},
                dataType: 'json',
                success:function(response){
               

                    var len = response.length;
                   $(".search-div").css("display", "block");
                    $("#searchResult").empty();
					
                    for( var i = 0; i<len; i++){

                        var id = response[i]['id'];
                        var uname = response[i]['name'];
						var image = response[i]['image'];
						var path = response[i]['profile_link'];
						var tag_line = response[i]['tag_line'];
						if(tag_line== null)
						 tag_line = '&nbsp;';
						if(uname== null)
						 uname = '&nbsp;'; 
                       

                        $("#searchResult").append("<li> <a href='"+path+"' class='search_anchor'><div class='small-creater' style='background-image:url("+image+");  background-size:cover;'></div><div class='small_div'><span class='creator_title'>"+uname+"</span><p class='gray2'>"+tag_line+"</p></div></a></li>");
                    }
					if(len==5)
					{
					  $("#searchResult").append("<li><a href='<?=BASEPATH?>/search/?s="+search+"'><div class='see-result'>See all Result</div></li>");
					  }

                }
            });
        }
		else
		{
		 $(".search-div").css("display", "none");
		 $("#searchResult").empty();
		}
    });

 });
 
 </script>
 
 <script>
    
     $(document).ready(function() {
	 
	  $("#imp_notification").mouseover(function(){
	 
	  $.ajax({
                url: '<?=BASEPATH?>/ajax/search_notification.php',
                type: 'post',
                data: {user_id:<?=$row_user->user_id?>},
                dataType: 'json',
                success:function(response){
				
                  $('#notify_count').fadeIn().html('');
                }
            });
	  
	  
	  });
 });
 
 </script>
 
 
 <script>
 var path_name = '<?=BASEPATH?>/';
 </script>