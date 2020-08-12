<?php
 include('admin_path.php'); 
include('include/access.php');
?>
<?php
if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
if(strlen($row_user->tag_line)>0) { 
 $page_title = $row_user->tag_line." | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "My Profile | ".PROJECT_TITLE;
 }
 
 $become_impact = 0;
 
 $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . "://" . 
          $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
  
  $profile_link = $link;
  
  
  
  if($_GET[type])
   $type = $_GET[type];
  else
   $type = "overview"; 
   
    $slug = trim($_GET['slug']);
$row_post = $db_query->fetch_object("select count(*) c, p.* from impact_post p where p.slug = '".$slug."' limit 1");



$page_title = $row_post->post_title." | ".PROJECT_TITLE;
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    
    
    
    <meta name="keywords" content="<?=$sql_web->meta_keyword?>" />

<meta name="author" content="<?=PROJECT_TITLE?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="og:title" content="<?=$sql_web->meta_title?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<meta property="og:url" content="<?=$profile_link?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<link rel="stylesheet" href="<?=BASEPATH?>/css/goal.css"/>

    <?php include('include/titlebar.php'); ?>
    <style>
	.comment-item .thumb-left1 img {
    max-height: 50px !important;
	}
	
	</style>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>


 <div class="col-md-12 impact-usercover" style="border-bottom: 1px solid #ccc;position:relative;top:44px;  ">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <?php if($row_user->review_status==0) {?>
      <p class="review">If you're ready for us to review your page, send it our way. If not, we're ready when you are.</p>
      <a href="<?=BASEPATH?>/edit/" class="edit-page" style="background-color:  rgb(251, 200, 190);color: red;"><span style=""></span>Edit your page</a>
       <a href="<?=BASEPATH?>/edit/review/" class="edit-page" style="background-color: rgb(232, 91, 70);"><span style="margin: 0 4px 0 0;"></span> <?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a>
       <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="col-md-2"></div>
  </div>
  
  
  
  <div class="col-md-12 user-photo" style="background-image:url(<?=$cover_image?>); background-size:cover;" id="imgAreaCover2">
     <!-- <div class="user-overlay"></div>-->
      <div class="progressBar">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                          </div>             
        <form id="bgimageform" method="post" enctype="multipart/form-data" action="#">
            <div class="uploadFile timelineUploadBG" >
                <i class="material-icons " style="color:white;margin: 10px 0 0 0;text-shadow: 2px 2px #00000030;">photo_camera</i>
            <input type="file" name="cover_image" id="cover_image" class=" custom-file-input" original-title="Change Cover Picture" accept="image/*" >
            </div>
        </form>
    <div class="creater-photo" style="background-image:url(<?=$user_image?>);  background-size:cover;" id="imgArea2">
    <div>&nbsp;</div>
     <div class="progressBar2">
                    <div class="bar2"></div>
                    <div class="percent2">0%</div>
                  </div>
    <!--<span style="color: white;" id="small-edit"><i class="fa fa-edit"></i></span>-->
    <div></div>
    <form id="small_bgimageform" method="post" enctype="multipart/form-data" action="#">
        <div>
            <div class="uploadFile  time-profile">
                <!--<i class="material-icons time-editcreate">edit</i>-->
                <i class="material-icons time-editcreate">photo_camera</i>
            <input type="file" name="profile_image" id="profile_image" class=" custom-file-input" original-title="Change Cover Picture"  accept="image/*">
            </div>
        </div>
</form>
    </div>
    <p class="gio"><?=$row_user->tag_line?> </p>
  </div>
  
  
   <!-- <div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">-->
  <div class=" col-md-12 project-tab-detail creater-tabs">
    <ul class="nav nav-tabs clearfix impactme-become" style="padding: 0 0 0px 0;border:0px solid  ">
      <!--<li <?php if($type=='overview'){?>class="active"<?php } ?>><a href="<?=$url_slug?>overview/">Post</a></li>-->
     <?php /*?> <li  <?php if($type=='post'){?>class="active"<?php } ?>><a href="<?=$url_slug?>post/">Post</a></li><?php */?>
      <!--<a href="#" class="become" onClick="alert('You cannot join your own tiers')">Become ImpactMe</a>-->
    </ul>
    
    <div class="tab-content">
     
        <div class="tab-pane  <?php if($type=='overview'){?>active<?php } ?> accordion-content">
          <div class="editor-content">
            <div class="home-feature-category">
             <?php if($type=='overview'){?>
              <div class="container_12 clearfix">
              
              
                <div class="grid_3 left-lst-category">
               <?php 
			   
			   include('include/left_tier.php'); 
			    ?>
               </div>
              
                <div class="grid_6 marked-category">
                
               <div class="box-marked-project project-short short" style="    margin-bottom: 18px;    padding: 0 0 0px 0;">
                
                  <div class="editor-content"> 
                   <?=$db_query->getPostImageDiv($row_post->post_id, 350)?>
                   
                 </div>
            
               <p class="like" style="margin-left:20px; font-weight:bold;"><?=$row_post->create_date?><span class="user-like"></span> <span class="post-like">
               <?php include('include/like_button.php');?><span id="postLikeText<?=$row_post->post_id?>"><?=$sql_like_count->c?></span> Likes </span></p>
               
             <!--<p style="float: right;margin: 0 10px; 0 0"> Locked</p>-->
              <?php echo $db_query->getPostNameDescription($row_post->post_id, $row_user->user_id, 1,'', 'full');?>
            <!--<p class="like">1 Like</p>-->
            
            
            
             <?php if(isset($_SESSION['is_user_login'])==1) { ?> 
			
              <div id="output<?=$row_post->post_id?>" >
			 
			  </div>
             
                  <div class="box_comment_section">
                      <form  id="frm-comment<?=$row_post->post_id?>"  method="post" action="" >
                       <div class="media comment-item">
                        <a href="#" class="thumb-left1">
                          <img src="<?=$user_image?>" alt="" class="comment-image">
                       </a>
                           <div class="media-body">
                         <div class="input-row">
                      <textarea class="comment input-field com<?=$row_post->post_id?>" type="text" name="comment" id="comment[<?=$row_post->post_id?>]" placeholder="Add a Comment">  </textarea> 
                 </div>
                       </div>
                                <input  type="hidden" name="name" id="name<?=$row_post->post_id?>" value="<?=$row_user->full_name?>" />
                           <input  type="hidden" name="user_id" id="user_id<?=$row_post->post_id?>" value="<?=$row_user->user_id?>" />
                           <input  type="hidden" name="post_id" id="post_id<?=$row_post->post_id?>" value="<?=$row_post->post_id?>" class="post_id" /> 
                           <input type="hidden" name="comment_id" id="commentId<?=$row_post->post_id?>" placeholder="Name" value="0" /> 
                           <div id="comment-message<?=$row_post->post_id?>" class="comment-message">Comments Added Successfully!</div>
                       </div>
                       </form>
                    </div>
                    
                   
                    
            
               
               <?php } else { ?>
               
               <div class="box_comment">
                       <div class="media comment-item">
                        <a href="#" class="thumb-left">
                          <img src="<?=BASEPATH?>/images/nouser.png" alt="">
                       </a>
                       <div class="media-body">
                         <p class="rs log-comment-content"><a href="<?=BASEPATH?>/login/">Log In</a> to Comment</p>
                       </div>
                       </div>
                    </div>
               <?php } ?>
               
               
               
               
                </div>
                
                
            
                </div>
                
                <div class="sidebar grid_3" style="float: right;">
                 <?php
				 
				 include('include/right_profile.php');
			   
			    include('include/right_goal.php'); 
				?>
                 </div>
               
                <div class="clear"></div>
              </div>
              
              <?php } ?>
            </div>
          
          </div>
       
        </div>
        
        
        
        <style>
		.project-date p {
    padding: 10px 0;
    margin: 0;
}
		
		</style>
      <div class="tab-pane <?php if($type=='post'){?>active<?php } ?>  accordion-content">
        <div class="tab-pane-inside ">
          <div class="home-feature-category">
          <?php if($type=='post'){?>
            <div class="container_12 clearfix">
             <div class="grid_3 left-lst-category">
            
               <?php include('include/right_profile.php');
			   include('include/left_filter.php');?>
               
               </div>
          <div class="grid_6 marked-category">
              
              <?php 
			  $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id'");
			  if($sql_post_check1->c>0) {?>
              
                          <?php include('include/user_post.php');?>
              
			      <?php }  else {?>
                <div class="box-marked-project project-short short">
                  <div class="editor-content"> <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                    <p class="user-posted"> You haven't posted anything yet!.</p>
                  </div>
                  <div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="<?=BASEPATH?>/edit/post/" style=" background-color:red;">Make your first post</a> </div>
                </div>
                <?php }?>
                
                
                
                
                               
                <div class="clear"></div>
              </div>
                <div class="sidebar grid_3" style="float: right;">
                   <?php  ?>
                    <?php include('include/left_tier.php');?>                 
                </div>
          
              
              
            </div>
         <?php } ?>
          </div>
        </div>
 
      </div>
    
  </div>
</div>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>
 <script type="application/javascript">
			 
			//  listComment(4);
			  
			  </script>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

</script>



<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<script>
$(document).on('change', '#cover_image', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

$('#bgimageform').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status_cover){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			//$("#imgArea>img").prop('src',obj.image_cover_image);
			$("#imgAreaCover2").css("background-image", "url(" + obj.image_cover_image + ")");			
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});


$(document).on('change', '#profile_image', function () {
var progressBar = $('.progressBar2'), bar = $('.progressBar2 .bar2'), percent = $('.progressBar2 .percent2');

$('#small_bgimageform').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status_profile){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			//$("#imgAreaCover>img").prop('src',obj.image_cover);			
			$("#imgArea2").css("background-image", "url(" + obj.image_profile + ")");	
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});


</script>



</div>
</body>
</html>
