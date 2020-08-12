<?php include('admin_path.php'); 

//include('login-with.php');
if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 1)
		{
		
			header('location:'.USER_CREATOR_PATH);
		}
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 0)
		{
	
			header('location:'.POST_CREATOR_PATH);
		}
 $title = "Log In - ". PROJECT_TITLE;
 ?>
<?php
if(isset($_REQUEST['mode'])=="login")
{
  $user_type = $_GET['ut'];
  if(empty($_GET['ut']))
  {
   $user_type = $_GET['ut'] = "create";
  }
  else
  {
   $user_type = $_GET['ut'];
  }
  $email_id = $db_query->filter($_REQUEST['email_id']); 
  $password = $db_query->filter($_REQUEST['password']); 
  if(!empty($email_id) && !empty($password))
  {

  $sql_check = $db_query->fetch_object("select count(*) c, u.*  from impact_user u where u.email_id='$email_id' and u.user_type='$user_type'");

	  if($sql_check->c>0 and password_verify($password, $sql_check->password))
	  {
	   if($sql_check->status==1)
	   {
	    if($sql_check->hash_active=='Y')
		{
		  $_SESSION['is_user_login'] = 1;
		  $_SESSION['username'] = $sql_check->email_id;
		  $_SESSION['user_id'] = base64_encode($sql_check->user_id);
		  $ids = $db_query->get_ids_sql($sql_check->user_id);
		  if($user_type=="ucreate") $_SESSION['user_type'] = 1; else $_SESSION['user_type'] = 0;
		  $sql_update = $db_query->runQuery("update impact_user set last_log_in_date = '".date('Y-m-d h:i:s A')."' where user_id in $ids");

		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 1)
		{
		   if($sql_check->review_status==0)
		   {
			header('location:'.USER_CREATOR_PATH);
			}
			else
			{
			  header('location:'.BASEPATH.'/user-creator/');
			}
		}
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 0)
		{
	
			header('location:'.POST_CREATOR_PATH);
		}
		 // header('location:'.BASEPATH.'/user-creator/');
		
		}
		else
		{
		 $msg = '<span style="color:red">Please Activate your account</span>';
		}
	   }
	   else
	   {
	     $msg = '<span style="color:red">Your Account Is Currently Blocked By Administrator.</span>';
	   }
	  }
	  else
	  {
	    $msg = '<span style="color:red">Invalid Email ID & Password.</span>';
	  }
  
  }
  else
  {
   $msg = '<span style="color:red">Email ID & Password Can not Be Blank.</span>';
  }
}

if(empty($_SESSION['is_user_login']))
{
// Generate session for user log type

	$_SESSION['log_type'] =$_GET['ut'];
	include('social_login_load.php');

	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	$authUrl = $googleClient->createAuthUrl();
	$googleURL = filter_var($authUrl, FILTER_SANITIZE_URL);
}
else
{
$loginURL = "#";
}

?>
<!DOCTYPE html>
<html>
<head>
 <title><?=$title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    <?php include('include/titlebar.php'); ?>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="f1" id="f1">
<div class="col-md-12 impact-login" style="padding: 0 0 20px 0">
       
        <h2 class="up">Log in</h2>
      <?php if(isset($msg)) {?>  <div class="up" id="msgErr" style="margin-top:0px;"><?php echo $msg;?></div><?php } ?>
        
         <div class="col-md-4"></div>
          <div class="col-md-5 imapct-sign">
             <div class="form-group">
                <label class="pass">Email</label><br>
                <input type="email" name="email_id" id="email_id"  class="col-md-10 email" value="<?php if(isset($_REQUEST['email_id'])) { echo $_REQUEST['email_id']; }?>"><br>
                <p class="err" id="email_err"></p>
                </div>
                
            <div class="clear"></div>
            <div class="form-group">
           <label class="pass">Password</label><br>
            <input type="password" name="password" id="password"  class="col-md-10 email" value="" ><br>
            <div class="err" id="password_err"></div>
            </div>
        <div class="form-group">
            <a href="<?=BASEPATH?>/forgot-password/" class="forgot"> Forgot Password?</a>
            </div>
            <input type="hidden" name="mode" value="login">
            <div style="width:100%; text-align:center; display: inline-block;">
            	<button class="sign-button " id="login" type="submit">Log in</button>
        	</div>
         
            <p class="with-sign">OR</p>

            <!--a href="<?=htmlspecialchars( $loginURL )?>" class="sign-facebook" ><span style="margin: 0 10px 0 0"><i class="fa fa-facebook-square"></i></span>Continue with Facebook</a-->
            <a href="<?=htmlspecialchars( $googleURL )?>" class="sign-google" ><div class="abcRioButtonIcon" style="display:inline-block;"><div style="width:18px;height:18px;" class="abcRioButtonSvgImageWithFallback abcRioButtonIconImage abcRioButtonIconImage18"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg></div></div><span style="margin: 0 10px 0 0"></span>Continue with Google</a>

            <p class="ready">New to ImpactMe? <a href="<?=BASEPATH?>/sign-up/?ut=<?=$_REQUEST['ut']?>&type=<?=md5(rand())?>" style="color: red"> Sign Up</a></p>
        </div>
    </div>
</form>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>

<script>
 $(document).ready(function() {
 setTimeout(function(){ $("#msgErr").fadeOut(); }, 3000);
  $("#login").click(function(){

    var email = $("#email_id").val();
	var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	var password = $("#password").val();
	if(email=="")
	{ 
	    $("#email_err").fadeIn().html("Email Id Required");
	    setTimeout(function(){ $("#email_err").fadeOut(); }, 3000);
	    $("#email_id").focus();
	    return false; 
	} 
	else if(!email_pattern.test(email))
    { 
	    $("#email_err").fadeIn().html("Invalid Email Id");
	    setTimeout(function(){ $("#email_err").fadeOut(); }, 3000);
	    $("#email_id").focus();
	    return false;      
    } 
	if(password=="")
	{ 
	    $("#password_err").fadeIn().html("Password Required");
	    setTimeout(function(){ $("#password_err").fadeOut(); }, 5000);
	    $("#password").focus();
	    return false; 
	} 
});

});


</script>
</body>
</html>
