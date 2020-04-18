<?php
ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject

include('header_log_in.php');



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
     <?php include('header.php');?><!--end: #header -->
    <div class="col-md-12" style="padding: 0 0 20px 0">
       
        <h2 class="up">Login in</h2>
         <div class="col-md-4"></div>
        <div class="col-md-5 imapct-sign">
 <span style="color:#F00;">
                <?=$_SESSION['loginerror']?>
                </span>
                <form class="login-form" action="<?=HTACCESS_URL?>loginController.php" onSubmit="return chkformlogin()">
                <input type="hidden" name="mode" value="user_login"  />
            <label class="pass">Email</label><br>
            <input name="username" id="username"  class="col-md-10 email"> <span class="error" id="usererror"></span> <br>

            <label class="pass">Password</label><br>
            <input type="password"  name="password" id="Password" class="col-md-10 email"><span class="error" id="passworderror"></span><br>
            
            <a href="forgot.php" class="forgot"> Forgot Password ?</a>
            
            <button class="sign-button " type="submit">Login in</button>
            </form><? unset($_SESSION['loginerror']);?>
            <p class="with-sign">or Login in with Facebook</p>

            <a href="<?=htmlspecialchars($_SESSION['loginURL'])?>" class="sign-facebook"><span style="margin: 0 10px 0 0"><i class="fa fa-facebook-square"></i></span>Continue with Facebook</a>

            <p class="ready">Already have an account? <a href="sign.php" style="color: red"> Sign Up</a></p>
        </div>
    </div>
    <script>
function chkformlogin(){
	if(document.getElementById("username").value==''){
		document.getElementById("usererror").innerHTML="Please Enter UserName.";
		document.getElementById("username").focus();
		return false;
	}
	if(document.getElementById("password").value==''){
		document.getElementById("passworderror").innerHTML="Please Enter Password.";
		document.getElementById("password").focus();
		return false;
	}
}
</script> 
</div>
</body>
</html>