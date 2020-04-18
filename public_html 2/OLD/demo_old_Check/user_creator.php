<?php include('admin_path.php'); 
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
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
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
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />


    <?php include('include/titlebar.php'); ?>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>


 <div class="col-md-12" style="border-bottom: 1px solid #ccc;padding: 0 0 20px 0;position:relative;top:44px;  ">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <?php if($row_user->review_status==0) {?>
      <p class="review">If you're ready for us to review your page, send it our way. If not, we're ready when you are.</p><?php }?>
      <a href="<?=BASEPATH?>/edit/" class="edit-page" style="background-color:  rgb(251, 200, 190);color: red;"><span style=""></span>Edit your page</a>
      
      <?php if($row_user->review_status==0) {?>
       <a href="<?=BASEPATH?>/edit/review/" class="edit-page" style="background-color: rgb(232, 91, 70);"><span style="margin: 0 4px 0 0;"></span> <?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a>
       <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="col-md-2"></div>
  </div>
  
  
  
  <div class="col-md-12 user-photo" style="background-image:url(<?=$cover_image?>); background-size:cover;">
                    
    <div class="creater-photo" style="background-image:url(<?=$user_image?>);  background-size:cover;">
    <div>&nbsp;</div>
    </div>
    <p class="gio"><?=$row_user->tag_line?> </p>
  </div>
  
  
  
  <div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">
    <ul class="nav nav-tabs clearfix">
      <li class="active"><a href="#">Overview</a></li>
      <li><a href="#">Post</a></li>
      <a href="#" class="become" onClick="alert('You cannot join your own tiers')">Become ImpactMe</a>
    </ul>
    
    <div class="tab-content">
     
        <div class="tab-pane active accordion-content">
          <div class="editor-content">
            <div class="home-feature-category">
              <div class="container_12 clearfix">
              
              
                <div class="grid_3 left-lst-category">
               <?php include('include/left_tier.php'); ?>
               </div>
              
                <div class="grid_6 marked-category">
                
                 <?php if(strlen($row_user->about_page) >0) {?>
                  <div class="box-marked-project project-short">
                     
                    <p class="creater-post" style="padding: 0 18px 0 18px;    text-align: justify;"><?=stripslashes($row_user->about_page)?></p>
                  </div>
                  <?php } ?>
                  <div class="box-marked-project project-short" style="margin-top:20px;"> 
                   <?php if(strlen($row_user->intro_video) >0) {?>
                   
                   <iframe width="100%" height="315" src="<?=$db_query->getYoutubeEmbedUrl($row_user->intro_video)?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   
                   
             
 <?php } else {?><img src="<?=BASEPATH?>/images/creater-impact.png" class="impact-post"><?php } ?>

                </div>
            
                </div>
                
                <div class="sidebar grid_3" style="float: right;">
                 <?php include('include/right_profile.php'); 
				 include('include/right_goal.php');?>
                 </div>
               
                <div class="clear"></div>
              </div>
            </div>
          
          </div>
       
        </div>
        
        
        
        
      <div class="tab-pane accordion-content">
        <div class="tab-pane-inside">
          <div class="home-feature-category">
            <div class="container_12 clearfix">
            
            
               <?php include('include/left_filter.php');?>
          
                <div class="sidebar grid_3" style="float: right;">
                   <?php include('include/right_profile.php'); ?>
                    <?php include('include/left_tier.php');?>                 
                </div>
          
              
              <div class="grid_6 marked-category">
              
              <?php 
			  $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id'");
			  if($sql_post_check1->c>0) {?>
              
              <?php $sql_post = $db_query->runQuery("select * from impact_post where user_id='$row_user->user_id'  order by create_date");
			  foreach($sql_post as $row_post) {?>
              
              
              <div class="box-marked-project project-short short">
                  <div class="editor-content"> 
                  <p class="user-posted" style="float:left; margin-left:10px;"> <?=$row_post['create_date']?></p>
                 <?php if($row_post['post_type']=="image"){ ?>
            <div > <img src="<?=IMAGEPATH?><?=$row_post['image_path']?>" class="impact-post"> </div>
                  
             <?php ?>
             <?php }else{ ?>
            <div > <iframe frameborder="0"  width="100%" height="351" src="<?= $db_query->getYoutubeEmbedUrl($row_post['video_link'])?>"></iframe> 
            
            </div>
                  
             <?php }?>
             
            
             
             
                  
                    <h2 class="user-posted" style="float:left; margin-left:10px;"> <?=$row_post['post_title']?></h2>
                    <p class="user-posted" style="float:left; margin-left:10px;"> <?=html_entity_decode(stripslashes($row_post['description']))?></p>
                  </div>
                  
                </div>
              <?php } ?>
              
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
            </div>
         
          </div>
        </div>
 
      </div>
    
  </div>
</div>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
