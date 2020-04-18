<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image1 = IMAGEPATH.$row_user->image_path;
else
 $user_image1 = IMAGEPATH.'nouser.png'; 
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
?>

<?php

 
$title = "Home | ".PROJECT_TITLE; 

 $sql_check_impact = $db_query->creator_check($row_user->email_id);
 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$title?></title>
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
    <style>
	.home-feature-category {
    padding-top: 101px;
}
	</style>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="home-feature-category">
        <div class="container_12 clearfix">
            

<div class="sidebar grid_3  left-lst-category" >
            <div class="project-runtime">
                <div class="box-gray">
                    

                    <div class="clearfix">
                        
                        <div class="photo" style="background-image:url(<?=$user_image1?>);  background-size:cover;">
                            
                        </div>
                        <hr class="line-image">
                    <p class="creater-name"><?=$row_user->full_name?></p>
                    </div>
                </div>
                
                <div class="wrap-lst-category" style="padding:0 0 40px 0">
                   <h3 class="become-box">Your Pacts</h3>
                   <?php if($sql_check_impact->c==0) {?>
                    <p class="page-live">You do not belong to any pact</p>
                    <a href="<?=BASEPATH?>/create/" class="find">Get Started</a>
                    <?php } else { ?>
                    <p class="page-live">You do not belong to any pact.</p>
                    
                    <p class="page-live">Your favourite creators may already have a page with exclusive content. Follow and support them to never miss out on any of their content.</p>
                    <a href="<?=BASEPATH?>/edit/about/" class="slider-page find">Find Creators</a>
                    <?php } ?>
                </div>
            </div><!--end: .project-runtime -->
            
            
        </div>

<div class="grid_6 marked-category">
                <div class="project-tab-detail tabbable accordion">
                    <ul class="nav nav-tabs clearfix">
                      <li class="active"><a href="#" class="be-fc-orange">All Post</a></li>
                      <li><a href="#" class="be-fc-orange">Pact-Only</a></li>
                      <!-- <li><a href="#" class="be-fc-orange">Backers (270)</a></li>
                      <li><a href="#" class="be-fc-orange">Comments (2)</a></li> -->
                      <!--<input type="text" name="text" placeholder="Showing:All Creater" class="allcreater">-->
                    </ul>
                    <div class="tab-content" style="border: 1px solid #dddddd;">
                        <div>
                            <!-- <h3 class="rs alternate-tab accordion-label">About</h3> -->
                            <div class="tab-pane active accordion-content">
                                <div class="editor-content">
                                    
                                    
                                        <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                                        
                                    
                                    <p class="follow">Support or follow creators to see posts in your feed.</p>
                                    
                                </div>
                                <div style="    padding: 0 0 40px 0">
                                    <a  href="<?=BASEPATH?>/explore/" class="slider-page creater-love">Find Creators You Love</a>
                                   
                                </div>
                            </div><!--end: .tab-pane(About) -->
                        </div>
                        <div>
                           <!--  <h3 class="rs alternate-tab accordion-label">Updates (0)</h3> -->
                            <div class="tab-pane accordion-content">
                                <div class="tab-pane-inside">
                                    <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                                        
                                    
                                    <p class="follow">Support or follow creators to see posts in your feed.</p>
                                    
                                </div>
                                <div style="    padding: 0 0 40px 0">
                                    <a  href="<?=BASEPATH?>/explore/" class="slider-page creater-love">Find Creater you love</a>
                                   
                                </div>
                                </div>
                            </div><!--end: .tab-pane(Updates) -->
                        </div>
                        
                       
                                </div>
                            </div>
            
           <div class="grid_3" style="float: right;">
                <div class="wrap-lst-category" style="    margin-bottom: 8%;padding-bottom: 40px;">
                   <h3 class="become-box">BECOME A CREATOR</h3>
                   <?php if($sql_check_impact->c==0) {?>
                    <p class="page-live">Build a membership for your fans and get paid to create on your own terms.</p>
                    <a href="<?=BASEPATH?>/create/" class="find">Get Started</a>
                    <?php } else { ?>
                    <p class="page-live">Starting a membership page is the best way to ensure a stable income while improving your connection with your fans.<br>Create your page now!</p>
                    <a href="<?=BASEPATH?>/edit/about/" class="find" style="position:relative;">Finish Page</a>
                    <?php } ?>
                </div>
                <!--<div class="project-author">-->
                <!--    <div class="box-gray">-->
                <!--        <h3 class="become-box">FIND CREATORS YOU LOVE</h3>-->
                <!--        <div>-->
                <!--            <p class="page-live">Find your creators you love.</p>-->
                <!--            <a href="<?=BASEPATH?>/explore/" class="find">Find Creators</a>-->
                <!--        </div>-->
                        
                <!--    </div>-->

                <!--</div><!--end: .project-author -->
            </div>
               
        
          
        
            
                        </div>
                      </div>

<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
