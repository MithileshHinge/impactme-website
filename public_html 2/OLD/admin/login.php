<?php
ob_start();
session_start();
require_once("../config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
//include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
//include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title>
<?=SITE_NAME?>
</title>
<!-- Bootstrap Core CSS -->
<link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- page css -->
<link href="css/pages/login-register-lock.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/master-stylesheet.css" rel="stylesheet">

<!-- You can change the theme colors from here -->
<link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- ============================================================== --> 
<!-- Preloader - style you can find in spinners.css --> 
<!-- ============================================================== -->

<!-- ============================================================== --> 
<!-- Main wrapper - style you can find in pages.scss --> 
<!-- ============================================================== -->
<section id="wrapper">
  <div class="card-no-border login-register">
    <div class="login-box card">
      <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" action="loginController.php" method="post" onsubmit="return chkform();">
         <input type="hidden" name="mode" value="login" />
          <h3 class="box-title mb-20 text-center text-uppercase text-blue">ADMIN LOGIN</h3>
          <? if(!empty($_REQUEST['msg'])){?>
          <h3 class="box-title mb-20 text-center text-uppercase " style="color:#F00;">
            <?=base64_decode($_REQUEST['msg'])?>
          </h3>
          <? }?>
          <div class="form-group mb-30">
            <div class="col-xs-12">
              <input class="form-control text-center" id="uname" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" name="username" type="text" required="" placeholder="Username">
            </div>
          </div>
          <div class="form-group mb-30">
            <div class="col-xs-12">
              <input class="form-control text-center" id="pwd" name="password" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required="" placeholder="Password">
            </div>
          </div>
          <div class="form-group row mb-30">
            <div class="col-md-12">
              <div class="checkbox checkbox-info pull-left pt-0">
                <input id="checkbox-signup" name="remember"  value="Remember Me" type="checkbox" class="filled-in chk-col-light-blue">
                <label for="checkbox-signup"> Remember me </label>
              </div>
              <a href="password-recovery.php" class="text-danger pull-right">forgot password?</a> </div>
          </div>
          <div class="form-group text-center">
            <div class="col-xs-12">
              <button class="  btn-block btn-rounded2 waves-effect waves-light" type="submit">LogIn</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ============================================================== --> 
<!-- End Wrapper --> 
<!-- ============================================================== --> 
<!-- ============================================================== --> 
<!-- All Jquery --> 
<!-- ============================================================== --> 
<script src="assets/vendors/jquery/jquery.min.js"></script> 
<!-- Bootstrap tether Core JavaScript --> 
<script src="assets/vendors/bootstrap/js/popper.min.js"></script> 
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<script>
<script type="text/javascript"> // form validation script
function chkform(){ 
	
	if(document.getElementById("uname").value==''){
		alert("Username cannot be blank.");
		document.getElementById("uname").focus();
		return false;
	}
	if(document.getElementById("pwd").value==''){
		alert("Password cannot be blank.");
		document.getElementById("pwd").focus();
		return false;
	}
}
</script>
$(function() {
$(".preloader").fadeOut();
});
</script>
</body>

<!-- Mirrored from creativethemes.co.in/demo/minion-admin/main/lockscreen.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:44:28 GMT -->
</html>