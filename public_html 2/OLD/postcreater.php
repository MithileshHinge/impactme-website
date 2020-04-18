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
?>
<!DOCTYPE html>
<html>


<head>
<title>Welcome to Impactme</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/normalize.css"/>
<link rel="stylesheet" href="css/jquery.sidr.light.css"/>
<link rel="stylesheet" href="css/animate.min.css"/>
<link rel="stylesheet" href="css/md-slider.css"/>
<link rel="stylesheet" href="css/style.css"/>
<!--[if lte IE 7]>
    <link rel="stylesheet" href="css/ie7.css"/>
    <![endif]-->
<!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie8.css"/>
    <![endif]-->
<link rel="stylesheet" href="css/responsive.css"/>
<!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5.js"></script>
    <![endif]-->
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
  <div class="home-feature-category">
    <div class="container_12 clearfix">
      <div class="grid_3 left-lst-category">
        <div class="wrap-lst-category">
          <h3 class="become-box">BECOME A CREATOR</h3>
          <p class="page-live">You're almost there! Complete your page and take it live.</p>
          <a href="#" class="find">Find my page</a> </div>
        <div class="project-author">
          <div class="box-gray">
            <h3 class="become-box">Find creators you love</h3>
            <div>
              <p class="page-live">The creators you already love may be on Patreon – connect your social media to find them.</p>
              <a href="#" class="find">Find Creator</a> </div>
          </div>
        </div>
        <!--end: .project-author --> 
      </div>
      <!--end: .left-lst-category --> 
      
      <!-- <div class="grid_3 left-lst-category" style="float: right;"> -->
      <div class="sidebar grid_3" style="float: right;">
        <div class="project-runtime">
          <div class="box-gray">
            <div class="project-date clearfix">
              <div class="photo"></div>
              <p class="creater-name">Akshay Bhoyar</p>
            </div>
            <div class="support">
              <p>SUPPORTING</p>
            </div>
            <p class="yet-impact">You are not supporting any creators yet..</p>
          </div>
        </div>
        <!--end: .project-runtime --> 
        
      </div>
      <!--end: .sidebar -->
      
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
                <div class="editor-content"> <img  src="images/creater-impact.png" alt="$DESCRIPTION"/ class="impact-post">
                  <p class="follow">Support or follow creators to see posts in your feed.</p>
                </div>
                <div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="#">Find Creater you love</a> </div>
              </div>
              <!--end: .tab-pane(About) --> 
            </div>
            <div> 
              <!--  <h3 class="rs alternate-tab accordion-label">Updates (0)</h3> -->
              <div class="tab-pane accordion-content">
                <div class="tab-pane-inside"> <img  src="images/creater-impact.png" alt="$DESCRIPTION"/ class="impact-post">
                  <p class="follow">Support or follow creators to see posts in your feed.</p>
                </div>
                <div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="#">Find Creater you love</a> </div>
              </div>
            </div>
            <!--end: .tab-pane(Updates) --> 
          </div>
        </div>
      </div>
      <!--end: .tab-pane(Comments) --> 
    </div>
  </div>
</div>
<!--end: .project-tab-detail -->
</div>
<!--end: .marked-category -->
<div class="clear"></div>
</div>
</div>
<!--end: .home-feature-category -->

<footer id="footer">
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
    
    <div class="clear"></div>
  </div>
  <div class="copyright">
    <div class="container_12">
      <div class="grid_12"> <a class="logo-footer" href="index.php"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </div>
      <div class="clear"></div>
    </div>
  </div>
</footer>
</div>

</body>

</html>