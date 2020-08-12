<?php include('admin_path.php'); 
 $user_id = base64_decode($_SESSION['user_id']);
 $row_user = $db_query->fetch_object("select i.*, count(*) c from impact_user i where i.user_id='".$user_id ."'");
 ?>
<?php
if(isset($_REQUEST['mode'])=="forgot_password")
{
  $user_type = $_GET['ut'];
  $email_id = $db_query->filter($_REQUEST['email_id']); 
  if(!empty($email_id) )
  {
  $sql_check = $db_query->fetch_object("select count(*) c, u.*  from impact_user u where u.email_id='$email_id'");
	  if($sql_check->c>0)
	  {
		  $_SESSION['emailId'] = $email_id;
      
      if($db_query->send_password_reset_link($email_id, $mail))
        $msg = '<span style="color:green">A link has been sent to your email account. It is valid for one hour.</span>';
      else
        $msg = '<span style="color:red">Could not send mail. Please try later.</span>';
      //header("location:".BASEPATH.'/password-change/');
	  }
	  else
	  {
	    $msg = '<span style="color:red">Invalid Email ID.</span>';
	  }
  
  }
  else
  {
   $msg = '<span style="color:red">Email ID Can not Be Blank.</span>';
  }
}




?>
<!DOCTYPE html>
<html>
<head>
 <title>Forget Password | <?=$sql_web->page_title?></title>
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
<div class="col-md-12" style="padding: 0 0 100px 0">
       <div class="col-md-4"></div>

        <div class="col-md-5 imapct-sign impact-forgot">

            <div class="col-md-5 forgot-pass">
                <p>FORGOT PASSWORD</p>
            </div>
            <p class="reset">Please enter your e-mail address and we’ll send you an e-mail where you can reset your password.</p>
 <span style="color:#F00;">
                                </span>
              <p class="reset"> <?php if($msg){?><span style="color:red"><?=$msg?></span><?php } ?></p>
                  <input type="hidden" name="mode" value="forgot_password">
            <label class="pass" style="margin: 31px 0 0 46px;color: #6161ff; ">Email ID</label><br>
            <input type="text" name="email_id" id="email_id" class="col-md-10 email">
            <label class="pass" style="margin: 2px 0 0 46px;"><span class="error" id="email_err"></span></label>

            <button type="submit" class=" reset-pass" id="login">Reset Password</button>

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
	
});

});


</script>
</body>
</html>
