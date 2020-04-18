<?php
ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject
if(!isset($_SESSION['is_user_login']) && !isset($_SESSION['user_id'])){
	$_SESSION['loginerror'] = 'Please Login...';
	header('Location:login.php');
	exit();
}

// for user information
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');

if(!empty($dbUser[0]['coverimage'])){
	$css = "background-image:url(cms_images/user/original/".$dbUser[0]['coverimage'].")";
}
// for tiers
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."tier WHERE userid='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbTiers = $dbObj->SelectQuery('edithome.php','aboutEdit()');

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."goals WHERE userid='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbGoals = $dbObj->SelectQuery('edithome.php','aboutEdit()');


$dbObj->dbQuery = "SELECT * FROM ".PREFIX."post WHERE status='1' and userid='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbPost = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome to Impactme</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/normalize.css"/>
<link rel="stylesheet" href="css/jquery.sidr.light.css"/>
<link rel="stylesheet" href="css/animate.min.css"/>
<link rel="stylesheet" href="css/md-slider.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/responsive.css"/>
<script type="text/javascript" src="js/raphael-min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="js/md_slider.min.js"></script>
<script type="text/javascript" src="js/jquery.sidr.min.js"></script>
<!-- <script type="text/javascript" src="js/jquery.tweet.min.js"></script> -->
<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div id="wrapper">
  <?php include('header.php');?>
  <!--end: #header -->
  <div class="col-md-12" style="border-bottom: 1px solid #ccc;padding: 0 0 20px 0;position:relative;top:44px; ">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <p class="review">If you're ready for us to review your page, send it our way. If not, we're ready when you are.</p>
      <a href="edit.php" class="edit-page" style="background-color:  rgb(251, 200, 190);color: red;"><span style="margin: 0 4px 0 0;"></span>Edit your page</a> <a href="#" class="edit-page" style="background-color: rgb(232, 91, 70);"><span style="margin: 0 4px 0 0;"></span>Submit for review</a>
      <div class="clr"></div>
    </div>
    <div class="col-md-2"></div>
  </div>
  <div class="col-md-12 user-photo" style="<?=$css?>">
  <? if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){ 
  		$url = "background-image:url(cms_images/user/original/".$dbUser[0]['pimage'].")";
	} else if($dbUserProfileImage[0]['oauth_provider']=='facebook'){
		if(!empty($dbUserProfileImage[0]['pimage']))
		$url = "background-image:url(cms_images/user/original/".$dbUserProfileImage[0]['pimage'].")";
		else
		$url = 	"background-image:url(".$dbUserProfileImage[0]['fbimage'].")";
	} else {
		$url = "";
	}
  ?>
                  
    <div class="creater-photo" style="<?=$url?>; background-size:cover;">
    <div>&nbsp;</div>
    </div>
    <p class="gio"> <?=$dbUser[0]['tagline']?></p>
  </div>
  <div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">
    <ul class="nav nav-tabs clearfix">
      <li class="active"><a href="#">Overview</a></li>
      <li><a href="#" class="be-fc-orange">Post</a></li>
      <a href="becomeimpact.php" class="become">Become ImpactMe</a>
    </ul>
    <div class="tab-content">
      <div>
        <div class="tab-pane active accordion-content">
          <div class="editor-content">
            <div class="home-feature-category">
              <div class="container_12 clearfix">
               <div class="grid_3 left-lst-category">
               <? if(count($dbTiers)>0){?>
                <? for($i=0;$i<count($dbTiers);$i++){?>
               
                  <div class="wrap-lst-category" style="margin-bottom:20px; padding:10px;">
                    <h3 class="tier add-tiers" style="margin:0 auto;">
                      <?=$dbTiers[$i]['tiername']?>
                    </h3>
                    <p class="faccio-become" style="text-align:center;">
                      <? if(!empty($dbTiers[$i]['image'])){ ?>
                      <img src="cms_images/user/original/<?=$dbTiers[$i]['image']?>" width="200px">
                      <? } ?>
                    </p>
                    <h2 class="doller-become" style="font-size:22px">
                      <?=$dbTiers[$i]['tier_price']?>
                      INR</h2>
                    <p class="doller-permonth">PER MONTH</p>
                    <p class="faccio-become">
                      <?=stripslashes(nl2br($dbTiers[$i]['tier_details']))?>
                    </p>
                  </div>
                
               
               <? } } else {?>
                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers">+ Add Tiers</h3>
                    </div>
                  </div>
                  <? }?>
               </div>
                <!--end: .left-lst-category -->
                <div class="grid_6 marked-category">
                  <div class="box-marked-project project-short">
                     
                    <p class="creater-post" style="padding: 0 18px 0 18px;    text-align: justify;"><?=html_entity_decode($dbUser[0]['aboutt'])?></p>
                  </div>
                  
                  <div class="box-marked-project project-short" style="margin-top:20px;">  <iframe width="100%" height="315"
src="<?=getYoutubeEmbedUrl($dbUser[0]['introvideo'])?>" frameborder="0" allowtransparency></iframe>  

 
</div>
                </div>
                <!-- <div class="grid_3 left-lst-category" style="float: right;"> -->
                <div class="sidebar grid_3" style="float: right;">
                  <div class="project-runtime" >
                  <div class="project-date clearfix" style="border:1px solid #ccc; border-radius:4px;">
                  <? if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){ ?>
                  <img src="cms_images/user/original/<?=$dbUser[0]['pimage']?>" style="text-align:center;" width="200px">
                  <? } else if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){?>
                  <img src="<?=$dbUser[0]['pimage']?>" width="200px">
                  <? } else { echo '<div class="photo"></div>';}?>
              
              <p class="creater-name" style="text-align:center"><span class="creater-125"><?=$dbUser[0]['impactname']?></span></p>
              <p class="creater-count" style="text-align:center; left:0;"><?=$dbUser[0]['tagline']?></p>
              <p class="creater-count" style="text-align:center; left:0;"><span class="creater-125">0</span><br>
                        Impact</p>
                      <p class="creater-count" style="text-align:center; left:0;"><span class="creater-125">$0</span><br>
                        Per month</p>
                        <a href="#" class="share" style="color: white;background-color:rgb(66, 103, 178); "><span style="margin: 0 4px 0 0;"><i class="fa fa-facebook-square"></i></span>facebook</a> <a href="#" class="share" style="color: white;background-color:rgb(62, 161, 236); "><span style="margin: 0 4px 0 0;"><i class="fa fa-twitter"></i></span>Tweet</a>
                      <div class="clr"></div>
            </div>
                    
                  </div>
                  <!--end: .project-runtime -->
                    
                  <!--end: .project-author -->
                  <? if(count($dbGoals)>0){?>
                   <? for($i=0;$i<count($dbGoals);$i++){?>
                  <div class="project-author" >
                    <div class="box-gray" style="margin-bottom:20px; padding:10px;">
                      <h3 class="tier add-tiers" style="margin:0 auto;">
                      <?=($dbGoals[$i]['goal_type']=='earning')?'Earnings-based goals':'Community-based goals'?>
                    </h3>
                    <h2 class="doller-become">
                      <?=$dbGoals[$i]['goal_price']?>
                      INR</h2>
                    <p class="faccio-become">
                      <?=stripslashes(nl2br($dbGoals[$i]['goal_details']))?>
                    </p>
                    </div>
                  </div>
                  <? } } else {?>
                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers">+ Add Goals</h3>
                    </div>
                  </div>
                  <? }?>
                  <!--end: .project-author --> 
                  
                </div>
                <!--end: .sidebar --> 
                
                <!--end: .marked-category -->
                <div class="clear"></div>
              </div>
            </div>
            <!--end: .home-feature-category --> 
          </div>
        </div>
        <!--end: .tab-pane(About) --> 
      </div>
      <div class="tab-pane accordion-content">
        <div class="tab-pane-inside">
          <div class="home-feature-category">
            <div class="container_12 clearfix">
              <div class="grid_3 left-lst-category">
                <div class="wrap-lst-category">
                  <div class="feature">
                    <p class="filter">Filter</p>
                    <a href="#" class="all-post"><span style="margin: 0 4px 0 0;"></span>All post</a>
                    <div class="clr"></div>
                  </div>
                  <div>
                    <p class="tag">FEATURED TAGS</p>
                    <p class="user-tag">Only you can see this<br>
                      You haven’t featured any tags.</p>
                    <a href="#" class="user-tag" style="color: red;">Learn how to feature tag</a> </div>
                  <div style="    padding: 0 0 41px 0;">
                    <p class="tag">Tags</p>
                    <p class="user-tag">Only you can see this<br>
                      You haven’t featured any tags.</p>
                    <a href="#" class="user-tag" style="color: red;">Learn how to feature tag</a> </div>
                  <div>
                    <div class="wrap-nav-pledge">
                      <ul class="rs nav nav-pledge accordion">
                        <li>
                          <div class=" pledge-label accordion-label clearfix"> <i class="icon iPlugGray"></i> <span class="pledge-amount">Filter by tier</span> </div>
                          <div class=" pledge-content accordion-content">
                            <div class="pledge-detail">
                              <p class="rs pledge-description">Public (0)</p>
                              <p class="rs pledge-description">All impact (0)</p>
                            </div>
                          </div>
                        </li>
                        <!--end: pledge-item -->
                        
                        </li>
                        <!--end: pledge-item -->
                        <li>
                          <div class="active pledge-label accordion-label clearfix"> <i class="icon iPlugGray"></i> <span class="pledge-amount">Sort by date,newest first</span> </div>
                          <div class="active pledge-content accordion-content">
                            <div class="pledge-detail">
                              <p class="rs pledge-description">Newest First</p>
                              <p class="rs pledge-description">oldest First</p>
                            </div>
                          </div>
                        </li>
                        <!--end: pledge-item -->
                      </ul>
                    </div>
                    <!--end: .wrap-nav-pledge --> 
                    
                  </div>
                </div>
              </div>
              <!--end: .left-lst-category --> 
              
              <!-- <div class="grid_3 left-lst-category" style="float: right;"> -->
              <div class="sidebar grid_3" style="float: right;">
                  <div class="project-runtime" >
                  <div class="project-date clearfix" style="border:1px solid #ccc; border-radius:4px;">
                  <? if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){ ?>
                  <img src="cms_images/user/original/<?=$dbUser[0]['pimage']?>" style="text-align:center;" width="200px">
                  <? } else if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){?>
                  <img src="<?=$dbUser[0]['pimage']?>" width="200px">
                  <? } else { echo '<div class="photo"></div>';}?>
              
              <p class="creater-name" style="text-align:center"><span class="creater-125"><?=$dbUser[0]['impactname']?></span></p>
              <p class="creater-count" style="text-align:center; left:0;"><?=$dbUser[0]['tagline']?></p>
              <p class="creater-count" style="text-align:center; left:0;"><span class="creater-125">0</span><br>
                        Impact</p>
                      <p class="creater-count" style="text-align:center; left:0;"><span class="creater-125">$0</span><br>
                        Per month</p>
                        <a href="#" class="share" style="color: white;background-color:rgb(66, 103, 178); "><span style="margin: 0 4px 0 0;"><i class="fa fa-facebook-square"></i></span>facebook</a> <a href="#" class="share" style="color: white;background-color:rgb(62, 161, 236); "><span style="margin: 0 4px 0 0;"><i class="fa fa-twitter"></i></span>Tweet</a>
                      <div class="clr"></div>
            </div>
                    
                  </div>
                  <!--end: .project-runtime -->
                    
<? if(count($dbTiers)>0){?>
                <? for($i=0;$i<count($dbTiers);$i++){?>
               
                  <div class="wrap-lst-category" style="margin-bottom:20px; padding:10px;">
                    <h3 class="tier add-tiers" style="margin:0 auto;">
                      <?=$dbTiers[$i]['tiername']?>
                    </h3>
                    <p class="faccio-become" style="text-align:center;">
                      <? if(!empty($dbTiers[$i]['image'])){ ?>
                      <img src="cms_images/user/original/<?=$dbTiers[$i]['image']?>" width="200px">
                      <? } ?>
                    </p>
                    <h2 class="doller-become" style="font-size:22px">
                      <?=$dbTiers[$i]['tier_price']?>
                      INR</h2>
                    <p class="doller-permonth">PER MONTH</p>
                    <p class="faccio-become">
                      <?=stripslashes(nl2br($dbTiers[$i]['tier_details']))?>
                    </p>
                  </div>
                
               
               <? } } else {?>
                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers">+ Add Tiers</h3>
                    </div>
                  </div>
                  <? }?>                  
                </div>
              <!--end: .sidebar -->
              
              <div class="grid_6 marked-category">
              <? if(count($dbPost)>0){?>
              <? for($i=0;$i<count($dbPost);$i++){?>
              <div class="box-marked-project project-short short">
                  <div class="editor-content"> 
                  <? if(!empty($dbPost[$i]['image'])){ ?>
            <div > <img src="cms_images/user/original/<?=$dbPost[$i]['image']?>" class="impact-post"> </div>
                  
             <? }?>
             <? if(!empty($dbPost[$i]['videolink'])){ ?>
            <div > <iframe frameborder="0"  width="100%" height="351" src="<?=getYoutubeEmbedUrl($dbPost[$i]['videolink'])?>"></iframe> 
            
            </div>
                  
             <? }?>
                  
                    <p class="user-posted"> <?=$dbPost[$i]['post_title']?></p>
                    <p class="user-posted"> <?=html_entity_decode(stripslashes($dbPost[$i]['descri']))?></p>
                  </div>
                  
                </div>
              <? } } else {?>
                <div class="box-marked-project project-short short">
                  <div class="editor-content"> <img  src="images/creater-impact.png" alt="$DESCRIPTION"/ class="impact-post">
                    <p class="user-posted"> You haven't posted anything yet!.</p>
                  </div>
                  <div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="#" style=" background-color:red;">Make your first post</a> </div>
                </div>
                <? }?>
                <!--end: .marked-category -->
                <div class="clear"></div>
              </div>
            </div>
            <!--end: .home-feature-category --> 
          </div>
        </div>
        <!--end: .tab-pane(Updates) --> 
      </div>
    </div>
  </div>
</div>
<!--end: .project-tab-detail -->
</div>
</div>
<!--end: .content -->
<footer id="footer" class="col-md-12">
  <div class="container_12 main-footer">
    <div class="grid_3 about-us">
      <h3 class="rs title">About</h3>
      <p class="rs description">Donec rutrum elit ac arcu bibendum rhoncus in vitae turpis. Quisque fermentum gravida eros non faucibus. Curabitur fermentum, arcu sed cursus commodo.</p>
      <p class="rs email"><a class="fc-default  be-fc-orange" href="http://envato.megadrupal.com/cdn-cgi/l/email-protection#b2dbdcd4ddf2dfd7d5d3d6c0c7c2d3de9cd1dddf"><span class="__cf_email__" data-cfemail="bbd2d5ddd4fbd6dedcdadfc9cecbdad795d8d4d6">[email&#160;protected]</span></a></p>
      <p class="rs">+1 (555) 555 - 55 - 55</p>
    </div>
    <!--end: .contact-info -->
    <div class="grid_3 recent-tweets">
      <h3 class="rs title">Recent Tweets</h3>
      <div class="lst-tweets" id="sys_lst_tweets"> </div>
    </div>
    <!--end: .recent-tweets -->
    <div class="clear clear-2col"></div>
    <div class="grid_3 email-newsletter">
      <h3 class="rs title">Newsletter Signup</h3>
      <div class="inner">
        <p class="rs description">Nam aliquet, velit quis consequat interdum, odio dolor elementum.</p>
        <form action="#">
          <div class="form form-email">
            <label class="lbl" for="txt-email">
              <input id="txt-email" type="text" class="txt fill-width" placeholder="Enter your e-mail address"/>
            </label>
            <button class="btn btn-green" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!--end: .email-newsletter -->
    <div class="grid_3">
      <h3 class="rs title">Discover &amp; Create</h3>
      <div class="footer-menu">
        <ul class="rs">
          <li><a class="be-fc-orange" href="#">What is Kickstars</a></li>
          <li><a class="be-fc-orange" href="#">Start a project</a></li>
          <li><a class="be-fc-orange" href="#">Project Guidlines</a></li>
          <li><a class="be-fc-orange" href="#">Press</a></li>
          <li><a class="be-fc-orange" href="#">Stats</a></li>
        </ul>
        <ul class="rs">
          <li><a class="be-fc-orange" href="#">Staff Picks</a></li>
          <li><a class="be-fc-orange" href="#">Popular</a></li>
          <li><a class="be-fc-orange" href="#">Recent</a></li>
          <li><a class="be-fc-orange" href="#">Small Projects</a></li>
          <li><a class="be-fc-orange" href="#">Most Funded</a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="copyright">
    <div class="container_12">
      <div class="grid_12"> <a class="logo-footer" href="index.html"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </div>
      <div class="clear"></div>
    </div>
  </div>
</footer>
</body>
</html>