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
<script type="text/javascript" src="javascript/formValidation.js"></script>
</head>
<body>
<div id="wrapper">
     <?php include('header.php');?><!--end: #header -->
    <div class="col-md-12" style="padding: 0 0 20px 0"> 
       
        <h2 class="up">Sign UP</h2>
         <div class="col-md-4"></div>
        <div class="col-md-5 imapct-sign">
<form method="post" action="<?=HTACCESS_URL?>signupController.php" onSubmit="return chkform()">
 <input type="hidden" name="mode" value="signup"  />
 
  <span style="color:#F00;"><?=$_SESSION['error']?></span>
            <label class="pass">Your Name</label><br>
            <input type="text" name="info[fname]" id="fname"  class="col-md-10 email"><br/><span class="error" id="ferror"></span><br>

            <label class="pass">Email</label><br>
            <input type="email" name="info[email]" id="pemail"  class="col-md-10 email"><br> <span class="error" id="perror"></span><br>

            <label class="pass">Password</label><br>
            <input type="password" name="password" id="password"  class="col-md-10 email"> <br><span class="error" id="passerror"></span><br>

            <label class="pass">Confirm Password</label><br>
            <input type="password" name="cpassword" id="cpassword"  class="col-md-10 email"> <br><span class="error" id="cpasserror"></span><br>

            <!--<input type="checkbox" name="checkbox" ><br><span >You agree to our Terms of Use and Privacy Policy</span><br>-->
<?  unset($_SESSION['error']);?>
            <button type="submit"  class="sign-button" style="left:0px;">Sign Up</button>
</form>
            <p class="with-sign">or Sign up with Facebook</p>

            <a href="#" class="sign-facebook"><span style="margin: 0 10px 0 0"><i class="fa fa-facebook-square"></i></span>Sign Up Facebook</a>

            <p class="ready">Already have an account? <a href="login.php" style="color: red"> Log in</a></p>
        </div>
    </div>
    <footer class="col-md-12 landing-footer">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <p class="copy-right">Contact us: care@impactme.in</p>
      <hr style="color: black;">
      <p class="address">205,Vedant Diamond Apt, New Sneh Nagar Nagpur<br>
        <span class="copy-right">&copy; 2018 Industrio.</span></p>
    </div>
    <div class="col-md-4"></div>
  </footer>
    </div>
    <script>
function chkform(){
	if(document.getElementById("fname").value==''){
		document.getElementById("ferror").innerHTML="Please Enter Your First Name.";
		document.getElementById("fname").focus();
		return false;
	}
	
	if(document.getElementById("pemail").value==''){
		document.getElementById("perror").innerHTML="Please Enter Your Email.";
		document.getElementById("pemail").focus();
		return false;
	}
	
	
	if(document.getElementById("password").value==''){
		document.getElementById("passerror").innerHTML="Please Enter Password.";
		document.getElementById("password").focus();
		return false;
	}
	if(document.getElementById("cpassword").value==''){
		document.getElementById("cpasserror").innerHTML="Please Enter Confirm Password.";
		document.getElementById("cpassword").focus();
		return false;
	}
	
	if((document.getElementById("password").value!='') && (document.getElementById("cpassword").value!='')){
		if(document.getElementById("password").value!=document.getElementById("cpassword").value){
			document.getElementById("passerror").innerHTML="Passwords donot match.";
			document.getElementById("password").focus();
			return false;
		}
	}

	return true;
}
</script>

</body>
</html>