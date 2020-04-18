<?php
ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject

?>
<!DOCTYPE html>
<html>

<!-- Mirrored from envato.megadrupal.com/html/kickstars/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 May 2019 05:16:24 GMT -->
<head>
    <title>Welcome to Kickstars</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <header id="header">
        <div class="wrap-top-menu hidden-lg">
            <div class="container_12 clearfix">
                <div class="grid_12">
                    <div class="top-message clearfix">
                        <i class="icon iFolder"></i>
                        <span class="txt-message">Nulla egestas nulla ac diam ultricies id viverra nisi adipiscing.</span>
                        <i class="icon iX"></i>
                        <div class="clear"></div>
                    </div>
                    <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i>
                </div>
            </div>
        </div> <!-- end: .wrap-top-menu -->
        <div class="container_12 clearfix">
            <div class="grid_12 header-content">
                <div id="sys_header_right" class="header-right">
                    <div class="account-panel">
                        
                        <a href="login.php"  class="login">Login</a>
                        <a href="sign.php" class="sign">Sign Up</a>
                       
                    </div>
                    <div class="form-search">
                        <a href="#" class="login">Start My Page</a>
                        <span class="creater" style="color: black;">Explore Creater</span>
                    </div>
                </div>
                <div class="header-left">
                    <h1 id="logo">
                        <a href="index.php"><img src="images/logo-3.png" alt="$SITE_NAME"/></a>
                    </h1>
                    <div class="main-nav clearfix">
                        <div class="form-search">
                        <form action="#">
                            <label for="sys_txt_keyword" style="border-bottom: 1px solid;">
                                <input id="sys_txt_keyword" class="active" type="text" placeholder="Search Creators... "/ style="    margin: 6px 0 0 40px;">
                            </label>
                            <button class="btn-search" type="reset"><i class="icon iMagnifier"></i></button>
                            <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!--end: #header -->
    <div class="col-md-12" style="padding: 0 0 100px 0">
       <div class="col-md-4"></div>

        <div class="col-md-5 imapct-sign impact-forgot">

            <div class="col-md-5 forgot-pass">
                <p>FORGOT PASSWORD</p>
            </div>
            <p class="reset">Please enter your e-mail address and we’ll send you an e-mail where you can reset your password.</p>
 <span style="color:#F00;">
                <?=$_SESSION['loginerror']?>
                </span>
                <form class="login-form" action="<?=HTACCESS_URL?>loginController.php" onsubmit="return chkformlogin()">
                  <input type="hidden" name="mode" value="forgot_password"  />
            <label class="pass" style="margin: 31px 0 0 46px;color: #6161ff; ">Email</label><br>
            <input type="text" name="username" id="username" class="col-md-10 email"><br> <span class="error" id="usererror"></span>

            <button type="submit" class=" reset-pass">Reset Password</button>
</form>
        </div>

    </div>
</div>

    <footer id="footer" class=col-md-12>
        <div class="container_12 main-footer">
            <div class="grid_3 about-us">
                <h3 class="rs title">About</h3>
                <p class="rs description">Donec rutrum elit ac arcu bibendum rhoncus in vitae turpis. Quisque fermentum gravida eros non faucibus. Curabitur fermentum, arcu sed cursus commodo.</p>
                <p class="rs "><a class="fc-default  be-fc-orange" href="http://envato.megadrupal.com/cdn-cgi/l/email-protection#b2dbdcd4ddf2dfd7d5d3d6c0c7c2d3de9cd1dddf"><span class="__cf_email__" data-cfemail="bbd2d5ddd4fbd6dedcdadfc9cecbdad795d8d4d6">[email&#160;protected]</span></a></p>
                <p class="rs">+1 (555) 555 - 55 - 55</p>
            </div><!--end: .contact-info -->
            <div class="grid_3 recent-tweets">
                <h3 class="rs title">Recent Tweets</h3>
                <div class="lst-tweets" id="sys_lst_tweets">
                    
                </div>
            </div><!--end: .recent-tweets -->
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
            </div><!--end: .email-newsletter -->
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
                <div class="grid_12">
                    <a class="logo-footer" href="index.html"><img src="images/logo-3.png" alt="$SITE_NAME"/></a>
                    <!-- <p class="rs term-privacy">
                        <a class="fw-b be-fc-orange" href="single.html">Terms & Conditions</a>
                        <span class="sep">/</span>
                        <a class="fw-b be-fc-orange" href="single.html">Privacy Policy</a>
                        <span class="sep">/</span>
                        <a class="fw-b be-fc-orange" href="#">FAQ</a>
                    </p> -->
                    <!-- <p class="rs ta-c fc-gray-dark site-copyright">HTML by <a href="http://megadrupal.com/" title="Drupal Developers" target="_blank">MegaDrupal</a>. Designed by <a href="http://bestwebsoft.com/" title="Web development company" target="_blank">BestWebSoft</a>.</p> -->
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </footer><!--end: #footer -->
    <script>
function chkformlogin(){
	if(document.getElementById("username").value==''){
		document.getElementById("usererror").innerHTML="Please Enter UserName.";
		document.getElementById("username").focus();
		return false;
	}
	
}
</script> 
</body>
</html>