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

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');
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
<script type="text/javascript" src="editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="javascript/formValidation.js"></script>
<?php 
	// include editor file
	include_once 'editor/ckeditor/ckeditor.php';
	//include_once EDITOR_DIR.'ckeditor/ckeditor.php';
	include_once 'editor/ckfinder/ckfinder.php';
	
?>
</head>
<body>
<div id="wrapper">
  <?php include('header.php');?>
  <!--end: #header --> 
</div>
<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        <ul class="tbs clearfix">
          <li ><a href="edit.php" class="be-fc-orange">About</a></li>
          <li ><a href="tiers.php" class="be-fc-orange">Tiers</a></li>
          <li ><a href="goals.php" class="be-fc-orange">Goals</a></li>
          <li ><a href="thanks.php" class="be-fc-orange">Thanks</a></li>
          <li class="activet"><a href="payment.php" >Payment</a></li>
          <li ><a href="post.php" class="be-fc-orange">Manage Your Post</a></li>
        </ul>
        <div class="tab-content">
           
           
           
           
          <div>
            <h3 class="rs alternate-tab accordion-label ">Payment</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
                <form action="#">
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Payment Schedule:</label>
                    <div class="val">
                      <div class="month">
                        <p class="monthly">Monthly</p>
                      </div>
                    </div>
                    <br>
                    <div class="row-item clearfix" style="    margin: 11px 0 0 70px;">
                      <label  for="txt_time_zone" style="margin: 18px 0 17px 90px;font-size: 15px;">Mobile Number:</label>
                      <br>
                      <div class="val">
                        <input class="txt" type="text" id="txt_location"  >
                      </div>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <div class="val">
                      <input  type="checkbox"  style="    margin: 0 0 0 94px;">
                      <label style="font-size: 16px;    margin: -18px 0 41px 114px;position: relative;bottom: 20px;">charge impact up front.</label>
                      <br>
                    </div>
                    <div class="val">
                      <input  type="checkbox"  style="       margin: 0 1px 37px 93px;">
                      <label style="font-size: 16px;    margin: -18px 0 41px 23px;position: relative;bottom: 20px;">per Creation.</label>
                      <br>
                    </div>
                    <div class="row-item clearfix" style="    margin: 11px 0 0 70px;">
                      <div class="val">
                        <input class="txt" type="text" id="txt_location"  placeholder="creation" style="    margin: -50px 0 -7px 0;">
                      </div>
                    </div>
                  </div>
                  <p class="wrap-btn-submit rs ta-r">
                    <button class="btn btn-red btn-submit-all newtier">Submit all</button>
                  </p>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
        </div>
      </div>
      <!--end: .project-tab-detail --> 
    </div>
  </div>
  <!--end: .content -->
  
  <div class="clear"></div>
</div></div>
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
<script type="text/javascript">
function chkprofile(){
	if(isEmpty("Name of Imapact page",document.getElementById("impactname").value)){
		document.getElementById("impactname").focus();
		return false;
	}
	if(isEmpty("what are you creating",document.getElementById("wcreator").value)){
		document.getElementById("wcreator").focus();
		return false;
	}
	if(document.getElementById('introvideo').value!='') {
	        var url = document.getElementById("introvideo").value;
        var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if (pattern.test(url)) {
            //alert("Url is valid");
            return true;
        } else {
            alert("Video link is not valid!, Only youtube video link allow here.");
            return false;
		}
	}	
}

function setText(txtval){
	document.getElementById('txt1').innerHTML=txtval;
	document.getElementById('txt2').innerHTML=txtval;	
}
function setWord(wrdval){
	document.getElementById('wrd1').innerHTML=wrdval;
	document.getElementById('wrd2').innerHTML=wrdval;	
	document.getElementById('tagline1').value = document.getElementById('impactname').value+' is creating '+document.getElementById('wcreator').value;
	document.getElementById('tagline2').value = document.getElementById('impactname').value+' are creating '+document.getElementById('wcreator').value;
}
</script>
</body>
</html>
