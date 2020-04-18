<?php
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
require_once(PHP_FUNCTION_DIR.'phpmailer.php');// to send mail 

$dbObj = new DBConnection(); // database connection object

$mode = $_REQUEST['mode'];
$info = $_REQUEST['info'];

// for admin email address


if($mode == "signup"){ //mode to add enquiry detail
		
		
		
		
		if(empty($info['email'])){
			$_SESSION['error'] = "Please Enter Your Email."; // message about action performed
			header('location:sign.php');
			exit;
		}
		if(empty($info['fname'])){
			$_SESSION['error'] = "Please Enter Your Name."; // message about action performed
			header('location:sign.php');
			exit;
		}
		
		if(empty($_REQUEST['password'])){
			$_SESSION['error'] = "Please Enter Password."; // message about action performed
			header('location:sign.php');
			exit;
		}
		if(empty($_REQUEST['cpassword'])){
			$_SESSION['error'] = "Please Enter Confirm Password."; // message about action performed
			header('location:sign.php');
			exit;
		}
		if(trim($_REQUEST['password'])!=trim($_REQUEST['cpassword'])){
			$_SESSION['error'] = "Your Password doesn't match."; // message about action performed
			header('location:sign.php');
			exit;
		}
		$info['password'] = md5($_REQUEST['password']);
		
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE email='".sc_mysql_escape($info['email'])."'";
		$dbRes = $dbObj->SelectQuery('edithome.php','aboutEdit()');
		
		
		
		if(isset($dbRes) && !empty($dbRes)){
			$_SESSION['error'] = "This Email Id already registered...";
			header('location:sign.php');
			exit;
		}
		
		$info['rdate'] = date("Y-m-d H:i:s");
		$info['user_type'] = 'web';
		$id = add_record($dbObj,PREFIX.'users',$info); // to add new record
		//echo $dbObj->dbQuery;exit;
		
		
		//print_r($dbEmail);
		if(!empty($id)){
		/********* Mail to admin ********/
		$mail = new PHPMailer();	
		$mail->Priority = 3;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
		$mail->Subject = "User Registration Detail";
		$mail->AddAddress("ksamayrananda@gmail.com","Administrator");
		//$mail->AddBcc("ksamayrananda@gmail.com");
		$mail->Body = "";
		$mail->AltBody = "";
		
		$body .= '<table align="left"  width="600px" border="0	px">
  <tr>
    <td align="left"><table cellpadding="5" cellspacing="0" width="600px" align="left">
      
        <tr>
          <td><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
        </tr>
        <tr>
          <td><font face="Verdana" style="font-size:12px">A new user is registered. Check the detail.</font></td>
        </tr>
		<tr>
          <td><font face="Verdana" style="font-size:12px">Name&nbsp;:&nbsp;'.ucwords($info['fname']).'</font></td>
        </tr>
		<tr>
          <td><font face="Verdana" style="font-size:12px">Email&nbsp;:&nbsp;'.$info['email'].'</font></td>
        </tr>
	 <tr>
          <td><font face="Verdana" style="font-size:12px">Rest Of the details You can see in admin panel.</font></td>
        </tr>
	
        <tr>
          <td><font face="Verdana" style="font-size:12px"></font></td>
        </tr>
        
		
        <tr>
          <td><br />
            <font face="Verdana" style="font-size:12px" color="#666666"><b>Thanks,<br />
            <font color="#333333">'.strtoupper(SITE_NAME).'</font></b></font></td>
        </tr>
      </table></td>
  </tr>
</table>';
		   
		$mail->Body .= $body;
		$mail->Send();
		$mail->ClearAllRecipients(); 
		
		
		/********* Mail to user ********/
		$mail = new PHPMailer();	
		$mail->Priority = 3;
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;
		$mail->Subject = "Thank you for your registration with ImpactMe  ";
		$mail->AddAddress($info['email'],"ImpactMe");
		$mail->AddBcc("ksamayrananda@gmail.com");
		$mail->Body = "";
		$mail->AltBody = "";
		$body = "";
					
		$body .= '<table align="left"  width="600px" border="0	px">
  <tr>
    <td align="left"><table cellpadding="5" cellspacing="0" width="600px" align="left">
       
        <tr>
          <td><font face="Verdana" style="font-size:12px"><b>Dear '.ucwords($info['fname']).',</b></font></td>
        </tr>
        <tr>
          <td><font face="Verdana" style="font-size:12px">Thank you for your registration. Your login details mention below.</font></td>
        </tr>
        <tr>
          <td><font face="Verdana" style="font-size:12px">User Name:'.$info['email'].'</font></td>
        </tr>
	<tr>
          <td><font face="Verdana" style="font-size:12px">Password:'.$_REQUEST['password'].'</font></td>
        </tr>
		 <tr>
          <td><font face="Verdana" style="font-size:12px"><a href="'.HTACCESS_URL.'login.php">Click here to login!</a></font></td>
        </tr>
		<tr>
          <td><font face="Verdana" style="font-size:12px"></font></td>
        </tr>
        
		
        <tr>
          <td><br />
            <font face="Verdana" style="font-size:12px" color="#666666"><b>Thanks,<br />
            <font color="#333333">'.strtoupper(SITE_NAME).'</font></b></font></td>
        </tr>
      </table></td>
  </tr>
</table>';
		   
		$mail->Body .= $body;
		$mail->Send();
		$mail->ClearAllRecipients(); 
		unset($_SESSION['reg_data']);
		unset($_SESSION['user_data']);
		}
		$_SESSION['error'] = "Thank You..";
		header('location:login.php');
		exit;
		
	
}

 

if($mode=="searchFomr"){
	$searchbox = sc_mysql_escape($_REQUEST['searchbox']); 
	header('location:search-result/'.str_replace(' ','-',trim($searchbox)).'/');
	exit();	
}

if($mode=="update-profile"){
	 modify_record($dbObj,PREFIX.'users',$info,'id='.$_SESSION['user_id']); 
	//echo $dbObj->dbQuery;exit;
	$_SESSION['error'] = "Thank You for updating your profile";
	header('location:client-profile/');
	exit();
}

if($mode=="update-passwrd"){
	$password = $_REQUEST['password'];
	$cpassword = $_REQUEST['cpassword'];
	if(trim($_REQUEST['password'])!=trim($_REQUEST['cpassword'])){
			$_SESSION['error'] = "Your Password doesn't match."; // message about action performed
			header('location:change-password/');
			exit;
	}
	$info['upass'] = md5($password);
	 modify_record($dbObj,PREFIX.'users',$info,'id='.$_SESSION['user_id']); 
	//echo $dbObj->dbQuery;exit;
	$_SESSION['error'] = "Passsword updated!";
	header('location:change-password/');
	exit();
}
?>
