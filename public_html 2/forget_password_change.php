<?php include('admin_path.php'); 
 $user_id = base64_decode($_SESSION['user_id']);
 $row_user = $db_query->fetch_object("select i.*, count(*) c from impact_user i where i.user_id='".$user_id ."'");
 ?>
<?php

if(isset($_REQUEST['mode'])=="forgot_password")
{
  $user_type = $_GET['ut'];
  $password = $db_query->filter($_REQUEST['npassword']); 
   $cpassword = $db_query->filter($_REQUEST['cpassword']); 
  if(!empty($password) || !empty($cpassword) )
  {
	  if($password==$cpassword)
	  {
		  if(!empty($_SESSION['emailId']))
		  {
		  $sql_check = $db_query->Query("update impact_user set password='".$password."' where email_id='".$_SESSION['emailId']."'");
		  if($sql_check)
		  {
			 unset( $_SESSION['emailId']);
			 $success_msg = "Password Changed Successfully";
		  }
		  }
		  else
		  {
			$msg = "Email ID Not Found";  
		  }
	  }
	  else
	  {
		  $msg = '<span style="color:red">Both Password Not Matched</span>';
	  }
  
  }
  else
  {
   $msg = '<span style="color:red">Password Can not Be Blank.</span>';
  }
}




?>
<!DOCTYPE html>
<html>
<head>
 <title>CHANGE PASSWORD | <?=$sql_web->page_title?></title>
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
                <p>CHANGE PASSWORD</p>
            </div>
           <?php if($msg){?> <p class="reset"> <span style="color:red"><?=$msg?></span></p><?php } ?>
           <?php if($success_msg){?> <p class="reset"> <span style="color:green"><?=$success_msg?></span></p><?php } ?>    
                  <input type="hidden" name="mode" value="forgot_password">
            <label class="pass" style="margin: 31px 0 0 46px;color: #6161ff; ">New Password</label><br>
            <input type="password" name="npassword" id="npassword" class="col-md-10 email">
            <label class="pass" style="margin: 2px 0 0 46px;"><span class="error" id="email_err"></span></label>
            
            <label class="pass" style="margin: 31px 0 0 46px;color: #6161ff; ">Confirm Password</label><br>
            <input type="password" name="cpassword" id="cpassword" class="col-md-10 email">
            <label class="pass" style="margin: 2px 0 0 46px;"><span class="error" id="email_err1"></span></label>

            <button type="submit" class=" reset-pass" id="login">Change Password</button>

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

    var npassword = $("#npassword").val();
	 var cpassword = $("#cpassword").val();
	var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	
	if(npassword=="")
	{ 
	    $("#email_err").fadeIn().html("Password Required");
	    setTimeout(function(){ $("#email_err").fadeOut(); }, 3000);
	    $("#npassword").focus();
	    return false; 
	} 
	
	if(cpassword=="")
	{ 
	    $("#email_err1").fadeIn().html("Confirm Password Required");
	    setTimeout(function(){ $("#email_err1").fadeOut(); }, 3000);
	    $("#cpassword").focus();
	    return false; 
	} 
	if(npassword!=cpassword)
	{ 
	    $("#email_err").fadeIn().html("Password Not matched");
	    setTimeout(function(){ $("#email_err").fadeOut(); }, 3000);
	    $("#npassword").focus();
	    return false; 
	} 
	
});

});


</script>
</body>
</html>
