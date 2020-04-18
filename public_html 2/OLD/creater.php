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

<!-- Mirrored from envato.megadrupal.com/html/kickstars/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 May 2019 05:16:24 GMT -->
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
  <div class="col-md-12 " style="    top: 57px;    position: relative;"> <img src="images/gio.png">
    <div class="creater-photo"></div>
    <p class="gio">GioPizzi is creating doppiaggio, vlog, spettacoli, podcast</p>
  </div>
  <div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">
    <ul class="nav nav-tabs clearfix" style="margin: 44px 0 0 0;">
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
                  <div class="wrap-lst-category">
                    <h3 class="tier">TIERS</h3>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 1 (4€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $1 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 2 (4€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $5 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 3 (8€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $10 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 4 (17€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $20 Tier</a> </div>
                    <div >
                      <h4 class="livello">Campione Livello 5 (44€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $50 Tier</a> </div>
                  </div>
                  <div class="project-author">
                    <div class="box-gray">
                      <h4 class="tier">SUPPORTED BY GIOPIZZI</h4>
                      <div> <img src="images/sun.jpg" style="margin: auto;display: block;">
                        <p class="purld">The purld<br>
                          <span style="color: #0000008c">Creating 3D animated vedio</span></p>
                      </div>
                    </div>
                  </div>
                  <!--end: .project-author --> 
                  
                </div>
                <!--end: .left-lst-category --> 
                
                <!-- <div class="grid_3 left-lst-category" style="float: right;"> -->
                <div class="sidebar grid_3" style="float: right;">
                  <div class="project-runtime">
                    <div class="box-gray">
                      <p class="creater-count"><span class="creater-125">125</span><br>
                        Impact</p>
                      <a href="#" class="share">+ Follow</a> <a href="#" class="share"><span style="margin: 0 4px 0 0;"><i class="fa fa-share-alt-square"></i></span>Share</a> <a href="#" class="share">... More</a>
                      <div class="clr"></div>
                    </div>
                  </div>
                  <!--end: .project-runtime -->
                  <div class="project-author">
                    <div class="box-gray"> <a href="#" class="share" style="color: white;background-color:rgb(66, 103, 178); "><span style="margin: 0 4px 0 0;"><i class="fa fa-facebook-square"></i></span>Share</a> <a href="#" class="share" style="color: white;background-color:rgb(62, 161, 236); "><span style="margin: 0 4px 0 0;"><i class="fa fa-twitter"></i></span>Tweet</a>
                      <div class="clr"></div>
                    </div>
                  </div>
                  <!--end: .project-author -->
                  
                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier">Goals</h3>
                      <div>
                        <h4 class="livello">100% Completed</h4>
                        <p style="padding: 0px 21px 15px 20px;text-align: justify;color: black">Lorem ipsum dolor sit amet </p>
                      </div>
                      <div>
                        <h4 class="livello">100% Completed</h4>
                        <p style="padding: 0px 21px 15px 20px;text-align: justify;color: black">Lorem ipsum dolor sit amet </p>
                      </div>
                      <div>
                        <h4 class="livello">82% Completed</h4>
                        <p style="padding: 0px 21px 15px 20px;text-align: justify;color: black">Lorem ipsum dolor sit amet </p>
                      </div>
                    </div>
                  </div>
                  <!--end: .project-author -->
                  
                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier">FEATURED TAGS</h3>
                      <div class="vedio">
                        <p class="vedio-you">you tube<br>
                          93 Post</p>
                      </div>
                      <div class="vedio">
                        <p class="vedio-you">you tube<br>
                          93 Post</p>
                      </div>
                      <div class="vedio">
                        <p class="vedio-you">you tube<br>
                          93 Post</p>
                      </div>
                    </div>
                  </div>
                  <!--end: .project-author --> 
                  
                </div>
                <!--end: .sidebar -->
                
                <div class="grid_6 marked-category">
                  <div class="box-marked-project project-short">
                    <h2 class="creater-post">CHI SONO?</h2>
                    <p class="creater-post" style="padding: 0 18px 0 18px;    text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  </div>
                </div>
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
                    <a href="#" class="all-post"><span style="margin: 0 4px 0 0;"></span>Tweet</a>
                    <div class="clr"></div>
                  </div>
                  <div>
                    <p class="tag">FEATURED TAGS</p>
                    <div class="vedio">
                      <p class="vedio-you">you tube<br>
                        93 Post</p>
                    </div>
                    <div class="vedio">
                      <p class="vedio-you">you tube<br>
                        93 Post</p>
                    </div>
                    <div class="vedio">
                      <p class="vedio-you">you tube<br>
                        93 Post</p>
                    </div>
                  </div>
                  <div style="    padding: 0 0 41px 0;">
                    <p class="tag">Tags</p>
                    <a href="#" class="pizza">Pizzatalk 51</a> <a href="#" class="pizza" ><span style="margin: 0 4px 0 0;"></span>volg 27</a> <a href="#" class="pizza" >low pizzi 21</a>
                    <div class="clr"></div>
                  </div>
                  <div>
                    <div class="wrap-nav-pledge">
                      <ul class="rs nav nav-pledge accordion">
                        <li>
                          <div class=" pledge-label accordion-label clearfix"> <i class="icon iPlugGray"></i> <span class="pledge-amount">Filter by tier</span> </div>
                          <div class=" pledge-content accordion-content">
                            <div class="pledge-detail">
                              <p class="rs pledge-description">Public (15)</p>
                              <p class="rs pledge-description">All impact (3)</p>
                              <p class="rs pledge-description">$5 (120)</p>
                              <p class="rs pledge-description">$10 (2)</p>
                              <p class="rs pledge-description">$20 (5)</p>
                              <p class="rs pledge-description">Campione Livello 1 (0.85€) (1)</p>
                              <p class="rs pledge-description">Campione Livello 2 (4€)  (57)</p>
                              <p class="rs pledge-description">Campione Livello 3 (8€) (63)</p>
                              <p class="rs pledge-description">Campione Livello 4 (17€) (64)</p>
                              <p class="rs pledge-description">Campione Livello 5 (44€) (68)</p>
                            </div>
                          </div>
                        </li>
                        <!--end: pledge-item -->
                        <li>
                          <div class=" pledge-label accordion-label clearfix"> <i class="icon iPlugGray"></i> <span class="pledge-amount">Filter by month</span> </div>
                          <div class=" pledge-content accordion-content">
                            <div class="pledge-detail">
                              <p class="calender">2019</p>
                              <p class="jan">January<span class="month">13</span></p>
                              <p class="jan">Febury<span class="month">13</span></p>
                              <p class="jan">March<span class="month">13</span></p>
                              <p class="jan">April<span class="month">13</span></p>
                              <p class="jan">May<span class="month">13</span></p>
                            </div>
                          </div>
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
                <div class="project-runtime">
                  <div class="box-gray"> <a href="#" class="share" style="color: white;background-color:rgb(66, 103, 178); "><span style="margin: 0 4px 0 0;"><i class="fa fa-facebook-square"></i></span>Share</a> <a href="#" class="share" style="color: white;background-color:rgb(62, 161, 236); "><span style="margin: 0 4px 0 0;"><i class="fa fa-twitter"></i></span>Tweet</a>
                    <div class="clr"></div>
                  </div>
                </div>
                <!--end: .project-runtime -->
                <div class="project-author">
                  <div class="box-gray">
                    <h3 class="tier">TIERS</h3>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 1 (4€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $1 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 2 (4€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $5 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 3 (8€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $10 Tier</a> </div>
                    <div class="tier1">
                      <h4 class="livello">Campione Livello 4 (17€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $20 Tier</a> </div>
                    <div >
                      <h4 class="livello">Campione Livello 5 (44€)</h4>
                      <p style="padding: 10px 21px 15px 14px;text-align: justify;color: black">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                      <a href="#" class="join">Join $50 Tier</a> </div>
                  </div>
                </div>
                <!--end: .project-author --> 
                
              </div>
              <!--end: .sidebar -->
              
              <div class="grid_6 marked-category">
                <div class="wrap-title clearfix" style="border:1px solid #ccc;">
                  <p class="guess">Guess what? If you <a href="#" style="color: red;">become a patron</a> to GioPizzi, you’ll immediately get access to as many as 383 patron-only posts.</p>
                </div>
                <div class="box-marked-project project-short short">
                  <div class="project-vedio"> <a href="#" class="join creater-point">Join $50 Tier</a> </div>
                  <p class="like">Jun 4 at 12:10am</p>
                  <p style="float: right;margin: 0 10px; 0 0"> Locked</p>
                  <h4 class="like">UN NEBRO PER DUE</h4>
                  <p class="like">Anteprima, Un Nebro per 2</p>
                  <p class="like">1 Like</p>
                </div>
                <div class="box-marked-project project-short short">
                  <div class="project-vedio"> <a href="#" class="join creater-point">Join $50 Tier</a> </div>
                  <p class="like">Jun 4 at 12:10am</p>
                  <p style="float: right;margin: 0 10px; 0 0"> Locked</p>
                  <h4 class="like">UN NEBRO PER DUE</h4>
                  <p class="like">Anteprima, Un Nebro per 2</p>
                  <p class="like">1 Like</p>
                </div>
                <div class="box-marked-project project-short short">
                  <div class="project-vedio"> <a href="#" class="join creater-point">Join $50 Tier</a> </div>
                  <p class="like">Jun 4 at 12:10am</p>
                  <p style="float: right;margin: 0 10px; 0 0"> Locked</p>
                  <h4 class="like">UN NEBRO PER DUE</h4>
                  <p class="like">Anteprima, Un Nebro per 2</p>
                  <p class="like">1 Like</p>
                </div>
              </div>
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