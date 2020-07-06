<?php include('admin_path.php'); 
//include('include/access.php');

$user_id = base64_decode($_SESSION['user_id']);
$row_user = $db_query->fetch_object("select count(*) c , i.* from impact_user i where i.user_id='".$user_id ."'");
 
 
 $slug = trim($_GET['slug']);
$row_post = $db_query->fetch_object("select count(*) c, p.* from impact_post p where p.post_id = '".$slug."' limit 1");




 $row_user1 = $db_query->fetch_object("select count(*) c , i.* from impact_user i where  i.user_id='".$row_post->user_id."'");

 
 if(strlen($row_user1->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user1->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 
 
 
 if(strlen($row_user1->slug)>0) 
					 $path_user = BASEPATH.'/profile/'.$row_user1->slug."/";
					else
					 $path_user = BASEPATH.'/profile/u/'.$row_user1->user_id."/";
					 
					 


if(strlen($row_user->image_path)>0)
				    {
					 $Path_name_image = BASEPATH.'/images/'.$row_user->image_path;
					if (@file_get_contents($Path_name_image, 0, NULL, 0, 1)) 
					 {
					 $user_image1 = IMAGEPATH.$row_user->image_path;
					 }
					 else
					 {
					   $user_image1 = IMAGEPATH.'icon_man.png'; 
					 }
					 }
					else
					 $user_image1 = IMAGEPATH.'icon_man.png'; 

if(strlen($row_user1->tag_line)>0) { 
 $page_title = $row_user1->tag_line." | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "My Profile | ".PROJECT_TITLE;
 }
 
 
 if($row_user->user_id==$row_user1->user_id)
 {
   $become_impact = 0;
   $become_impact_link = '#';
   
 }
 else
 {
   $become_impact = 1;
   $become_impact_link = BASEPATH.'/join/'.$row_user1->user_id.'/';
 }
 
 
 $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . "://" . 
          $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
  
  $profile_link = $link;
   if($_GET[type])
   $type = $_GET[type];
  else
   $type = "overview"; 
   
    $page_title = $row_post->post_title." | ".PROJECT_TITLE;
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="<?=$row_user1->impact_name?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="fb:app_id"                content="<?=$fbappid?>" />

<meta property="og:url"                content="<?=$profile_link?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?=$row_user1->impact_name?>" />
<meta property="og:description"        content="<?=$row_user1->tag_line?>" />
<meta property="og:image"              content="<?=IMAGEPATH.$row_user1->image_path?>" />



<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$row_user1->impact_name?>" />
<meta name="twitter:description" content="<?=$row_user1->tag_line?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user1->image_path?>" />
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


<?php

if(strlen($row_user1->image_path)>0)
 $user_image = IMAGEPATH.$row_user1->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 

?> 
<?php if($row_post->c>0) {?>
  
  
  <div class="col-md-12 user-photo" style="background-image:url(<?=$cover_image?>); background-size:cover;">
    <?php
    if (strlen($row_user1->slug)<=0){
      $user1_path = BASEPATH.'/profile/u/'.$row_user1->user_id.'/';
    }else{
      $user1_path = BASEPATH.'/profile/'.$row_user1->slug.'/';
    }
    ?>
    <div class="creater-photo" style="background-image:url(<?=$user_image?>);  background-size:cover; cursor:pointer;" onclick="location.href='<?=$user1_path?>';">
    <div>&nbsp;</div>
    </div>
    <p class="gio" style="cursor:pointer;" onclick="location.href='<?=$user1_path?>'"><?=$row_user1->tag_line?> </p>
  </div>
  
  
  <!--<div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">-->
  <div class=" col-md-12 project-tab-detail  creater-tabs">
    <ul class="nav nav-tabs clearfix impactme-become" style="padding: 0 0 0px 0;border:0px solid  ">
    
         <!--<li <?php if($type=='overview'){?>class="active"<?php } ?>><a href="<?=$path_user?>overview/">Post</a></li>-->
     <?php /*?> <li  <?php if($type=='post'){?>class="active"<?php } ?>><a href="<?=$path_user?>post/">Post</a></li><?php */?>
      
      
      <!--<a href="<?= $become_impact_link?>" class="become"  <?php if($become_impact==0) {?>onClick="alert('You cannot join your own tiers'); return false;"<?php } ?>>Join the Tide</a>-->
    </ul>
    
    <div class="tab-content">
     
        <div class="tab-pane <?php if($type=='overview'){?>active<?php } ?> accordion-content">
          <div class="editor-content">
            <div class="home-feature-category">
            
             <?php if($type=='overview'){?>
              <div class="container_12 clearfix">
              
              
                <div class="grid_3 left-lst-category">
                <?php
				
				include('include/left_tier_user.php');
				 ?>
                      
               
               
               </div>
              
                <div class="grid_6 marked-category">
                
                <div class="box-marked-project project-short short" style="    margin-bottom: 33px;    padding: 0 0 23px 0;">
              
			   <?=$db_query->getImageUnlockDiv($row_post->post_id, $row_user1->user_id, '', $row_user->user_id )?>
                 <?php list($show, $tier_link) =  $db_query->getImageUnlockDivStatus($row_post->post_id, $row_user1->user_id, '', $row_user->user_id ); ?>
                 
                <?php if($show == 1) { 
				
				 $sql_like_count = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$row_post->post_id'");
				?> 
                <p class="like" style="margin-left:20px;font-weight:bold;"><?=date('M d, Y', strtotime($row_post->create_date))?> at <?=date('h:i a', strtotime($row_post->create_date))?>
				<span class="user-like"></span> <span class="post-like"><a href="javascript:void(0)" id="post_like" onClick="javascript:post_like(<?=$row_post->post_id?>,<?=$row_user->user_id?>)"> <i class="fa fa-heart"></i> </a><span id="postLikeText<?=$row_post->post_id?>"> <?=$sql_like_count->c?></span> Likes </span></p>
                <?php } ?>
             <!--<p style="float: right;margin: 0 10px; 0 0"> Locked</p>-->
             <?php echo $db_query->getPostNameDescription($row_post->post_id,0, $show,$tier_link,'full');?>
         
            <!--<p class="like">1 Like</p>-->
            
            <?php if($show == 1) { ?> 
              <?php if(isset($_SESSION['is_user_login'])==1) { ?> 
			
                <div id="output<?=$row_post->post_id?>" >
			 
			  </div>
             
                  <div class="box_comment_section">
                      <form  id="frm-comment<?=$row_post->post_id?>"  method="post" action="">
                       <div class="media comment-item">
                        <a href="#" class="thumb-left1">
                          <img src="<?=$user_image1?>" alt="" class="comment-image">
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
                          <img src="<?=BASEPATH?>/images/nouser.png" alt="" >
                       </a>
                       <div class="media-body">
                         <p class="rs log-comment-content"><a href="<?=BASEPATH?>/login/">Log In</a> to Comment</p>
                       </div>
                       </div>
                    </div>
               <?php } ?>
               
               <?php } ?>
               
               
               
                
                </div>
            
            
            
                </div>
                
                <div class="sidebar grid_3" style="float: right;">
                 <?php include('include/right_profile_user.php'); 
				 include('include/right_goal_user.php');?>  
                
                
                
                 </div>
               
                <div class="clear"></div>
              </div>
              <?php } ?>
            </div>
          
          </div>
       
        </div>
        
        
        
        
      <div class="tab-pane <?php if($type=='post'){?>active<?php } ?>  accordion-content">
        <div class="tab-pane-inside">
          <div class="home-feature-category">
           <?php if($type=='post'){?>
            <div class="container_12 clearfix">
             <div class="grid_3 left-lst-category">
              <?php include('include/right_profile_user.php'); ?>
               <?php include('include/left_filter.php');?>
               </div>
          
                <div class="sidebar grid_3" style="float: right;">
                 
                    <?php include('include/left_tier_user.php');?>                 
                </div>
          
              
              <div class="grid_6 marked-category">
              
              <?php 
			  $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user1->user_id'");
			  if($sql_post_check1->c>0) {?>
              
             <?php include('include/user_postProfile.php');?>
              
			      <?php }  else {?>
                <div class="box-marked-project project-short short">
                  <div class="editor-content"> <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                    <p class="user-posted"> <?=$row_user1->full_name?> haven't posted anything yet!.</p>
                  </div>
                  <!--<div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="<?=BASEPATH?>/edit/post/" style=" background-color:red;">Make your first post</a> </div>-->
                </div>
                <?php }?>
                
                
                
                
                               
                <div class="clear"></div>
              </div>
            </div>
            <?php } ?>
         
          </div>
        </div>
 
      </div>
    
  </div>
</div>

<?php } else { ?>
<div class="layout-2cols">
        <div class="content grid_12">
            <div class="search-result-page">
                <div class="top-lbl-val" style="    margin-top:150px;">
                    <h3 class="common-title"> <span class="fc-orange">Search</span></h3>
                    <div class="count-result">
                        <span class="fw-b fc-black">Sorry, No</span> Record Found</span>
                        <span style="height:500px;"><br>
<br>
<br>
<br>
</span>
                    </div>
                    <!--<div class="confirm-search">Were you looking for projects in <a href="#" class="fw-b be-fc-orange">Crafts</a>?</div>-->
                </div>
                
                <!--<p class="rs ta-c">
                    <a id="showmoreresults" class="btn btn-black btn-load-more" href="#">Show more projects</a>
                </p>-->
            </div><!--end: .search-result-page -->
        </div><!--end: .content -->
     
    </div>

<?php } ?>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>

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
</div>
</body>
</html>
