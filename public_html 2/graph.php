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
<div id="wrapper" style="background-color:white">
<?php include('include/header.php'); ?>
<div class="container" style="background-color:white">

 <div class="col-md-12" style="padding: 0 0 20px 0;position:relative;top:44px;  ">
     <h2>Earnings</h2>
     <p>Earnings are the amount of income you take home from the money pledged to you as a creator on Patreon. Earnings correspond to the time that Patreon successfully processed your pledges and refunds, rather than the time when you performed the work or published paid posts</p>
    </div>
    <div class="col-md-12 earning-graph">
        <div class="col-md-12">
           <div class="col-md-6">
                <h2>Earnings before tax</h2>
           </div>
           <div class="col-md-6">
               <a href="" class="earning-monthly">6 Months</a>
                <a href="" class="earning-monthly">1 Year</a>
                 <a href="" class="earning-monthly"> All Time</a>
           </div>
        </div>
        <div class="col-md-12 graph-design">
            <img src="images/graph.png">
        </div>
    </div>
    
    
    <div class="col-md-12 earning-graph">
        
        <h2>Pledge Growth</h2>
          
        <div class="col-md-12 graph-design">
            <img src="images/graph.png">
        </div>
    </div>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>
 </div>
</body>
</html>
