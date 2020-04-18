<?php
ob_start();
session_start();
require_once('config.php');
require_once(MYSQL_CLASS_DIR.'DBConnection.php');
require_once(PHP_FUNCTION_DIR.'function.database.php');
require_once(PHP_FUNCTION_DIR.'phpmailer.php');
$dbObj = new DBConnection();

$info = $_REQUEST['info'];
//print_r($info);exit;
$mode = $_REQUEST['mode'];
$id = $_REQUEST['id'];
$user_id = $_REQUEST['user_id'];

if($mode == 'user_login'){
	$email = sc_mysql_escape($_REQUEST['username']); 
	$password = sc_mysql_escape($_REQUEST['password']);
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE email='".sc_mysql_escape($email)."' and password='".md5($password)."' "; 
	$dbResult = $dbObj->SelectQuery('edithome.php','aboutEdit()');

	
	
	if(count($dbResult)>0){
		$_SESSION['is_user_login'] = 1;
		$_SESSION['site_username'] = $dbResult[0]['name'];
		$_SESSION['user_id'] = $dbResult[0]['id'];
		$_SESSION['image'] = $dbResult[0]['image'];
		$dbObj->dbQuery = "update ".PREFIX."users set llogin='".date('Y-m-d h:i:s A')."' where id=".$dbResult[0]['id'];
		$dbObj->ExecuteQuery();
		
		header("location:usercreater.php");
		exit;
		
		 
	} else { // if user and password does not match with database
		$_SESSION['loginerror'] = "Invalid User Name or Password.";
		header("location:login.php");
		exit;
	}
}

//mode to logout
if($mode == 'logout'){
	
	unset($_SESSION['is_user_login']);
	unset($_SESSION['site_username']); // to unset login session
	unset($_SESSION['user_id']);
	
	
	$_SESSION['loginerror'] = "You Have Logout Successfully.";
	header("location:login.php");
	exit;
	
}
if($mode=="fblogout"){
	unset($_SESSION['is_user_login']);
	unset($_SESSION['site_username']); // to unset login session
	unset($_SESSION['user_id']);
	// Remove access token from session
unset($_SESSION['facebook_access_token']);

// Remove user data from session
unset($_SESSION['userData']);

	
	$_SESSION['loginerror'] = "You Have Logout Successfully.";
	header("location:login.php");
	exit;
}

//mode for forgot password
if($mode == 'forgot_password'){

	$username = sc_mysql_escape($_REQUEST['username']);
	
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE email='".$username."'"; 
	$dbResult = $dbObj->SelectQuery('edithome.php','aboutEdit()');
//	print_r($dbUser);exit;
	
     
	if(count($dbResult)>0){
	
		$password = Randon_Number(); // Randon_Number() return random password 
				
		$info['password'] = md5($password); // to encrypt password
		
		modify_record($dbObj,PREFIX.'users',$info,'id='.$dbResult[0]['id']); // to modify record
		//echo $dbObj->dbQuery ;exit;
		
		$mail = new PHPMailer();
		$mail->Priority = 3;
		$mail->From = FROM_EMAIL; //already set in config.php
		$mail->FromName = FROM_NAME; //already set in config.php
		$mail->Subject = "ImpactMe send you new password.";
		$mail->AddAddress($dbResult[0]['email'],"ImpactMe");
		$mail->Body = "";
		$mail->AltBody = "";

		$body .= '<table align="left"  width="600px" border="0	px">
  <tr>
    <td align="left"><table cellpadding="5" cellspacing="0" width="600px" align="left">
   
        <tr>
          <td><font face="Verdana" style="font-size:12px"><b>Dear '.$dbResult[0]['name'].', </b></font></td>
        </tr>
        <tr>
          <td><font face="Verdana" style="font-size:12px">ImpactMe Has Send You New Password.</font></td>
        </tr>
       <tr>
          <td><font face="Verdana" style="font-size:12px">User Name:&nbsp;&nbsp;'.$dbResult[0]['email'].'</font></td>
        </tr>
        <tr>
          <td><font face="Verdana" style="font-size:12px">New Password:&nbsp;&nbsp;'.$password.'</font></td>
        </tr>
		
        <tr>
          <td><br />
            <font face="Verdana" style="font-size:12px" color="#666666"><b>Thanks,<br />
            
			<font color="#333333">Sincerely, ImpactMe Web Admin</font></b></font></td>
        </tr>
      </table></td>
  </tr>
</table>';

$mail->Body .= $body; //to view the body of mail

$mail->Send();
$mail->ClearAllRecipients();

$_SESSION['loginerror'] = "Account password details emailed to you."; 
}
	else{
	$_SESSION['loginerror'] = "Invalid Email-Id/username."; 
    }
	
	header("location:".HTACCESS_URL."forgot.php");
	exit;
}

?>
