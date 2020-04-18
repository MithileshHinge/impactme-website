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
 
 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$sql_web->page_title?></title>
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

<div class="home-feature-category">
        <div class="container_12 clearfix">
            <div class="grid_3 left-lst-category">
                <div class="wrap-lst-category">
                   <h3 class="become-box">BECOME A CREATOR</h3>
                    <p class="page-live">You're almost there! Complete your page and take it live.</p>
                    <a href="#" class="find">Find my page</a>
                </div>
                <div class="project-author">
                    <div class="box-gray">
                        <h3 class="become-box">BECOME A CREATOR</h3>
                        <div>
                            <p class="page-live">You're almost there! Complete your page and take it live.</p>
                            <a href="#" class="find">Find my page</a>
                        </div>
                        
                    </div>

                </div><!--end: .project-author -->
            </div><!--end: .left-lst-category -->




            
            <!-- <div class="grid_3 left-lst-category" style="float: right;"> -->
               <div class="sidebar grid_3" style="float: right;">
            <div class="project-runtime">
                <div class="box-gray">
                    

                    <div class="project-date clearfix">
                        <div class="photo" style="background-image:url(<?=$user_image?>);  background-size:cover;"></div>
                    <p class="creater-name"><?=$row_user->first_name.''.$row_user->last_name?></p>
                    </div>
                    <div class="support"><p>SUPPORTING</p></div>
                    <p class="yet-impact">You are not supporting any creators yet..</p>
                </div>
            </div><!--end: .project-runtime -->
            
            
        </div><!--end: .sidebar -->
        
          
        
            <div class="grid_6 marked-category">
                <div class="project-tab-detail tabbable accordion">
                    <ul class="nav nav-tabs clearfix">
                      <li class=""><a href="#">All Post</a></li>
                      <li><a href="#" class="be-fc-orange">Impact-OnlyPost</a></li>
                      <!-- <li><a href="#" class="be-fc-orange">Backers (270)</a></li>
                      <li><a href="#" class="be-fc-orange">Comments (2)</a></li> -->
                      <input type="text" name="text" placeholder="Showing:All Creater" class="allcreater">
                    </ul>
                    <div class="tab-content">
                        <div>
                            <!-- <h3 class="rs alternate-tab accordion-label">About</h3> -->
                            <div class="tab-pane active accordion-content">
                                <div class="editor-content">
                                    
                                    
                                        <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                                        
                                    
                                    <p class="follow">Support or follow creators to see posts in your feed.</p>
                                    
                                </div>
                                <div class="project-btn-action" style="    padding: 0 0 40px 0">
                                    <a class="ask" href="#">Find Creater you love</a>
                                   
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
                                <div class="project-btn-action" style="    padding: 0 0 40px 0">
                                    <a class="ask" href="#">Find Creater you love</a>
                                   
                                </div>
                                </div>
                            </div><!--end: .tab-pane(Updates) -->
                        </div>
                        
                       
                                </div>
                            </div><!--end: .tab-pane(Comments) -->
                        </div>
                      </div>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
