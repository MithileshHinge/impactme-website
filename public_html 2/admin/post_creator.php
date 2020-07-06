<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php

$user_id = base64_decode($_SESSION['user_id']);
$row_user = $db_query->fetch_object("select count(*) c , i.* from impact_user i where i.user_id='".$user_id ."'");
 
 
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
  <?php     
  echo $row_user->user_id;             
 $row_impact2    =$db_query->impact($row_user->email_id); 
		  
		  
		 // print_r($row_impact);
					if(strlen($row_impact2->image_path)>0) 
					{
						
				       $profile_image_impact = IMAGEPATH.$row_impact2->image_path;
					   if (@file_get_contents($profile_image_impact, 0, NULL, 0, 1)) 
					   {
					      $profile_image_impact = $profile_image_impact;
					   }
					   else
					   {
					     $profile_image_impact ='';
					   }
					}
					 else
					   $profile_image_impact ='';
                       ?>
                    <div class="clearfix">
                        
                        <div class="photo" style="background-image:url(<?=$profile_image_impact?>);  background-size:cover;">
                            
                            <div class="halfCircleBottom">
                                <a href="<?=BASEPATH?>/settings/"<i class="material-icons edit-creater-image">edit</i></a>
                            </div>
                            
                        </div>
                        <hr class="line-image">
                    <p class="creater-name"><?=$row_user->full_name?> 
                    <!--<span ><i class="material-icons">edit</i></span>-->
                    <a href="<?=BASEPATH?>/settings/"><i class="material-icons " style="font-size: 13px;color: #0000008f;">edit</i></a>
                    </p>
                    </div>
                </div>
                
                <div class="wrap-lst-category" style="padding:0 0 20px 0">
                   <h3 class="tier">Your Pacts</h3>
                   <?php if($sql_check_impact->c==0) {?>
                    <p class="page-live">You do not belong to any pact. Your favourite creators may already have a page with exclusive content. Follow and support them to never miss out on any of their content.</p>
                    <a href="<?=BASEPATH?>/explore/" class="find">Explore creators</a>
                    <?php } else { ?>
                    <?php $sql_check_join = $db_query->fetch_object("select count(*) c from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id='$row_user->user_id' and (p.status='authenticated' or p.status='active')");
					if($sql_check_join->c>0) { ?>
                    <ul style="list-style:none;padding:0 0 0 0;">
                    <?php
			  $sql_c = "select u.* from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id='$row_user->user_id' and (p.status='authenticated' or p.status='active') group by p.creator_id";

					 $sql_check_join_user = $db_query->runQuery($sql_c);
					 foreach( $sql_check_join_user as $row_join) {
					 $userImag = IMAGEPATH.$row_join['image_path'];
					 
					 if(strlen($row_join['slug'])>0) 
					 $path2 = BASEPATH.'/profile/'.$row_join['slug']."/";
					else
					 $path2 = BASEPATH.'/profile/u/'.$row_join['user_id']."/";
					 
					 $path2='#';
					 ?>
                        <li class="supporter-impact"> 
                            <a href="<?=$path2?>" class="suppt-list">
                                <div class="small-creater-support" style="background-image:url(<?=$userImag?>);  background-size:cover;"></div>
                                <div class="small_support">
                                    <span class="creator_title"><?=html_entity_decode($row_join['impact_name'])?></span>
                                <p class="sup-me"><?php if(strlen($row_join['tag_line'])>0){?><?=html_entity_decode($row_join['tag_line'])?><?php } else{?>&nbsp;<?php }?></p>
                                </div>
                            </a>
                        </li>
                        <?php } ?>
                    
                    </ul>
                    
                    <?php } ?>
                    <div class="clr"></div>
                    <!--<p class="page-live">You do not belong to any pact.</p>-->
                    
                    <!--<p class="page-live">Your favourite creators may already have a page with exclusive content. Follow and support them to never miss out on any of their content.</p>-->
                    <a href="<?=BASEPATH?>/explore/" class="slider-page find">Explore creators</a>
                    <?php } ?>
                </div>
            </div><!--end: .project-runtime -->
            
            
        </div>

<div class="grid_6 marked-category">
                <div class="project-tab-detail tabbable accordion">
                    <ul class="nav nav-tabs clearfix" style="border:0px solid">
                      <li class="active"><a href="#" class="be-fc-orange">All Post</a></li>
                      <li><a href="#" class="be-fc-orange">Pact-Only</a></li>
                      <!-- <li><a href="#" class="be-fc-orange">Backers (270)</a></li>
                      <li><a href="#" class="be-fc-orange">Comments (2)</a></li> -->
                      <!--<input type="text" name="text" placeholder="Showing:All Creater" class="allcreater">-->
                    </ul>
                    <div class="tab-content" style="border: 1px solid #dddddd;">
                         <div>
                           <!--  <h3 class="rs alternate-tab accordion-label">Updates (0)</h3> -->
                            <div class="tab-pane active accordion-content">
                             <?php 
                              $sq = "select count(*) c from impact_post where user_id in ( SELECT creator_id FROM impact_join WHERE user_id = '$row_user->user_id' group by creator_id)";
                              $row_post_count = $db_query->fetch_object($sq);
                  if($sql_check_join->c==0) { ?>

                                <div class="tab-pane-inside">
                                    <img  src="<?=BASEPATH?>/images/octupas-impact.png" alt="" class="impact-post">
                                        
                                    
                                    <p class="follow">Support or follow creators to see posts in your feed.</p>
                                    
                                </div>
                                <div style="    padding: 0 0 40px 0">
                                    <a  href="<?=BASEPATH?>/explore/" class="slider-page creater-love">Find creators you love</a>
                                   
                                </div>

                                <?php } else { ?>

                                            <?php include('include/user_CreatorProfile.php');?>

                                    <?php } ?>
                                </div>
                            </div> <div>
                            <!-- <h3 class="rs alternate-tab accordion-label">About</h3> -->
                            
                           
                            <div class="tab-pane  accordion-content">
                              <?php 
							  $sq = "select count(*) c from impact_post where user_id in ( SELECT creator_id FROM impact_join WHERE user_id = '$row_user->user_id' group by creator_id)";
							  $row_post_count = $db_query->fetch_object($sq);
				  if($sql_check_join->c==0) { ?>
                                <div class="editor-content">
                                    
                                    
                                        <img  src="<?=BASEPATH?>/images/octupas-impact.png" alt="" class="impact-post">
                                        
                                    
                                    <p class="follow">Support or follow creators to see posts in your feed.</p>
                                    
                                </div>
                                <div style="    padding: 0 0 40px 0">
                                    <a  href="<?=BASEPATH?>/explore/" class="slider-page creater-love">Find Creators You Love</a>
                                   
                                </div>
                                
                                <?php } else {?>  <?php include('include/user_CreatorProfile_pact.php');?>
								
								<?php } ?>
                            </div><!--end: .tab-pane(About) -->
                        </div>
                        
                        
                        
                      <!--end: .tab-pane(Updates) -->
                        </div>
                        
                       
                                </div>
                            </div>
           
           <div class="grid_3" style="float: right;">
             <?php if($row_user->review_submit_status==0) {?>  
               <div class="wrap-lst-category" style="    margin-bottom: 8%;padding-bottom: 20px;">
                   <h3 class="tier">Become a creator</h3>
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

                <!--</div><!--end: .project-author --> <?php } ?>
                 <?php if(strlen($row_user->about_you)>0) {?>
            <div class="wrap-lst-category" style="    margin-bottom: 8%;padding-bottom: 20px;padding:5%">
                   <!--<h3 class="tier">Become a creator</h3>-->
                   
                    <p class="page-live" style=""><?=stripslashes(html_entity_decode($row_user->about_you))?></p>
                   
                
                </div>
              <?php } ?> 
            </div>
           
            
           
        
          
        
            
                        </div>
                      </div>

<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
