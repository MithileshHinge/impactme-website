<?php include('admin_path.php'); 
 
 ?>
<?php
if(isset($_REQUEST['mode'])=="login")
{
  $user_type = $_GET['ut'];
  $email_id = $db_query->filter($_REQUEST['email_id']); 
  $password = $db_query->filter($_REQUEST['password']); 
  if(!empty($email_id) && !empty($password))
  {
  $sql_check = $db_query->fetch_object("select count(*) c, u.*  from impact_user u where u.email_id='$email_id' and u.password = '$password' and u.user_type='$user_type'");
	  if($sql_check->c>0)
	  {
	   if($sql_check->status==1)
	   {
	    if($sql_check->hash_active=='Y')
		{
		  $_SESSION['is_user_login'] = 1;
		  $_SESSION['username'] = $sql_check->email_id;
		  $_SESSION['user_id'] = base64_encode($sql_check->user_id);
		  $_SESSION['user_type'] = base64_encode('ucreate');
		  $sql_update = $db_query->runQuery("update impact_user set last_log_in_date = '".date('Y-m-d h:i:s A')."' where user_id='".$sql_check->user_id."'");
		
		  header('location:'.BASEPATH.'/user-creator/');
		
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




?>
<!DOCTYPE html>
<html>
<head>
 <title>Log In | <?=$sql_web->page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    <?php include('include/titlebar.php'); ?>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="post" name="f1" id="f1">
<div class="col-md-12" style="padding: 0 0 100px 0">
       <div class="col-md-4"></div>

        <div class="col-md-5 imapct-sign impact-forgot">

            <div class="col-md-5 forgot-pass">
                <p>FORGOT PASSWORD</p>
            </div>
            <p class="reset">Please enter your e-mail address and we’ll send you an e-mail where you can reset your password.</p>
 <span style="color:#F00;">
                                </span>
               
                  <input type="hidden" name="mode" value="forgot_password">
            <label class="pass" style="margin: 31px 0 0 46px;color: #6161ff; ">Email ID</label><br>
            <input type="text" name="username" id="username" class="col-md-10 email"><br> <span class="error" id="usererror"></span>

            <button type="submit" class=" reset-pass">Reset Password</button>

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
