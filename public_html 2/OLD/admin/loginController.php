<?php
ob_start();
session_start();
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php'); // file to access predefine php funtion
if (!function_exists('set_magic_quotes_runtime')){ function set_magic_quotes_runtime($new_setting) { return true; } }
require_once(PHP_FUNCTION_DIR.'phpmailer.php'); // file to sent email

$dbObj = new DBConnection();
$mode = $_REQUEST['mode'];
$info = $_REQUEST['info'];
$id = $_REQUEST['id'];

// LOGOUT MODULE
if($mode=='logout'){
	
	unset($_SESSION['is_admin']); // to unset login session
	unset($_SESSION['admin_name']); // to unset login session
	unset($_SESSION['admin_email']);
	unset($_SESSION['cms_admin_id']);
	unset($_SESSION['admin_as']);
	//unset($_SESSION['current_theme']);
	
	$msg = base64_encode("Logout successfully....");
	header('location:login.php?msg='.$msg);
	exit;
}

// LOGIN MODULE
if($_POST['mode']=="login"){ 
	$name = sc_mysql_escape($_POST['username']);
	$password = sc_mysql_escape($_POST['password']);
	
	$dbObj->dbQuery="select * from ".PREFIX."adminuser where username='".$name."' and password='".md5($password)."'";
    $dbResult = $dbObj->SelectQuery();
	//print_r($dbResult);exit;
	if(count($dbResult)>0){ // if username and password get match with satabase
		
		$_SESSION['is_admin'] = 1;	// ligin session is set
		$_SESSION['cms_admin_id'] = $dbResult[0]['id'];
	
		$_SESSION['admin_name'] = $dbResult[0]['name'];
		$_SESSION['admin_email'] = $dbResult[0]['email'];
		
		if(!empty($_POST["remember"])) {
				setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
		} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
		}
		$info['last_login'] = date('Y-m-d H:i:s');
		modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$_SESSION['cms_admin_id']); // to modify record
	//echo $dbObj->dbQuery ;exit;
	
		
		header('location:index.php?mo=home');
		
		exit;	
	} else { // if user and password does not match with database
		$msg = base64_encode("Invalid Username or Password....");
		header('location:login.php?&msg='.$msg);
		exit;
	}
}

// change Password
if($_REQUEST['mode']=="change_password"){
	
	if(empty($_REQUEST['password'])){
		$msg = base64_encode("Please Enter Password."); // message about action performed
		header('location:index.php?mo=changepasswod&msg='.$msg);
		exit;	
	}
	if(empty($_REQUEST['rpassword'])){
		$msg = base64_encode("Please Re-Type Password."); // message about action performed
		header('location:index.php?mo=changepasswod&msg='.$msg);
		exit;	
	}
	if($_REQUEST['password']!=$_REQUEST['rpassword']){
		$msg = base64_encode("Passwords donot match."); // message about action performed
		header('location:index.php?mo=changepasswod&msg='.$msg);
		exit;	 
	}
	
	$info['password'] = trim(md5($_REQUEST['password'])); // encrypt the passwords
	$id = sc_mysql_escape($_SESSION['id']);
	
	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$_SESSION['cms_admin_id']); // to modify record
	//echo $dbObj->dbQuery ;exit;
	
	$msg = base64_encode("Password Successfully Modified."); // message about action performed
	header('location:index.php?mo=changepasswod&msg='.$msg);
	exit;
}

// forgot password
if($_POST['mode']=="forgot_password"){
	$username = sc_mysql_escape($_POST['username']);

	$dbResult = get_data($dbObj,"adminuser","username='$username'","*");
	//print_r($dbResult);exit;
	if(count($dbResult)>0){ // username get match with database
	
	$password = Randon_Number(); // Randon_Number() return random password 
	//$info['username'] = $username;		
	$info['password'] = md5($password); // to encrypt password
	
	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$dbResult[0]['id']); // to modify record
				
		$mail = new PHPMailer();
		$mail->Priority = 3; // COPY
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;			
		$mail->Subject = "Password Recovery";
		$mail->AddAddress($dbResult[0]['email'], "Administrator");	
		$mail->Body = "";
		$mail->AltBody = "";	
	
		$body .= ' 
		<table cellpadding="5" cellspacing="0" width="500px">
		<tr>
			<td><font face="Verdana" style="font-size:12px"><b>Hello Administrator,</b></font></td>
		</tr>
		<tr>
			<td><font face="Verdana" style="font-size:12px">Access For Admin Panel.</font></td>
		</tr>
		<tr>
			<td><font face="Verdana" style="font-size:12px">Admin User Name - <strong>'.$dbResult[0]['username'].'</strong></font></td>
		</tr>
		<tr>
			<td><font face="Verdana" style="font-size:12px">New Password - <strong>'.$password.'</strong></font></td>
		</tr>
		<tr>
			<td><br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24"><b>Regards,<br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24" >
			CMS</font></b>	
			</font>
			</td>
		</tr>
		</table> ';
			
		$mail->Body .= $body;
		$mail->Send();
		$mail->ClearAllRecipients(); 
	
		$msg ="A New Password Is Sent To Your Email Address";
	} else { // if username did not match with database
		$msg ="Invalid User Name.";
	}
	redirect($msg,"login&m=1");
}

// change email
if($_REQUEST['mode']=="update_email"){          
	
	/*if(empty($info['full_name'])){
		$msg = base64_encode("Please Enter Name."); // message about action performed
		header('location:index.php?mo=change_email&msg='.$msg);
		exit;	
	}*/
	if(empty($info['email'])){
		$msg = base64_encode("Please Enter Email."); // message about action performed
		header('location:index.php?mo=change_email&msg='.$msg);
		exit;	
	}
	
	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$_SESSION['cms_admin_id']); // to modify record
	//echo $dbObj->dbQuery ;exit;
	
	$msg = base64_encode("Record Successfully Modified."); // message about action performed
	header('location:index.php?mo=change_email&msg='.$msg);
	exit;
}


if($mode == 'add_admin'){ 
  /*validation for form field*/
	if(empty($info['name'])){ // check for empty record
		$msg = base64_encode("Please Enter Admin Name");
		header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
		exit;
	}
	if(empty($info['username'])){ // check for empty record
		$msg = base64_encode("Please Enter Admin user Name");
		header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
		exit;
	}
	if(empty($info['email'])){ // check for empty record
		$msg =base64_encode("Please Enter admin email");
		header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
		exit;
	}
	if(empty($id)){ 
		if(empty($_REQUEST['password'])){ // check for empty record
			$msg = base64_encode("Please Enter password");
			header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;
		}
		if(empty($_REQUEST['rpassword'])){ // check for empty record
			$msg = base64_encode("Please Enter Re-type Password");
			header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;
		}
	}
	/*validation compelete*/
	
	
	
	if(empty($id)){
		$info['password'] = md5(sc_mysql_escape($_REQUEST['password']));
	} else {
		if(!empty($_REQUEST['password'])){
			$info['password'] = md5(sc_mysql_escape($_REQUEST['password']));
		} else {
			//to get admin's password
			$dbObj->dbQuery = "SELECT password FROM ".PREFIX."adminuser WHERE id='".$id."'";
			$dbPwd = $dbObj->SelectQuery('edithome.php','aboutEdit()');
			
			$info['password'] = $dbPwd[0]['password'];
		}
	}
	
	//print_r($info);exit;
	if(empty($id)){
	
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser WHERE username='".sc_mysql_escape($info['username'])."'";
		$dbRes = $dbObj->SelectQuery('edithome.php','aboutEdit()');
		if(isset($dbRes) && !empty($dbRes)){
			$msg = base64_encode("UserName already registered, Try Another...");
			header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;
		} else {
			$info['created'] = date('Y-m-d');
			$info['admin_type'] = (!empty($info['admin_type']))?$info['admin_type']:'sub_admin';
		    $id = add_record($dbObj,PREFIX.'adminuser',$info); 
			
			if($info['admin_type']=='super_admin'){
				$userId = 'SUP-'.$id;
			} else {
				$userId = 'STAFF-'.$id;
			}
			// to update Image status
			$dbObj->dbQuery = "update ".PREFIX."adminuser set userId='".$userId."' where id=".$id;
			$dbObj->ExecuteQuery();
			//echo $dbObj->dbQuery;exit;	
			//echo $dbObj->dbQuery;exit;		
		}
		//echo $dbObj->dbQuery;exit;		
	} else {
	
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser WHERE username='".sc_mysql_escape($info['username'])."' and id!='".$id."'";
		$dbRes = $dbObj->SelectQuery('edithome.php','aboutEdit()');
		if(isset($dbRes) && !empty($dbRes)){
			$msg = base64_encode("UserName already registered, Try Another...");
			header('location:index.php?mo=adminusers&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;
		}
		
		modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$id); // to modify record
		//echo $dbObj->dbQuery;exit;		
	}
	
	$msg = base64_encode("Records successfully saved");
	header('location:index.php?mo=adminusers&msg1='.$msg);
	exit;
}

if($mode=="delete_admin"){
	$id = $_REQUEST['id']; // selected record id to delete
    if(empty($id)){
		$msg = base64_encode("Please Select record to delete");
		header('location:index.php?mo=adminusers&id='.$id.'&msg1='.$msg);
		exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
		
		delete_record($dbObj,PREFIX.'adminuser','id='.$id[$i]);	
		//echo $dbObj->dbQuery;exit;
	}
	
	$msg = base64_encode("Record deleted successfully");
	header('location:index.php?mo=adminusers&msg1='.$msg);
	exit;
}

// mode to change blog category status
if($mode=="changeStatus"){
	$id = sc_mysql_escape($_REQUEST['id']);
	$set_val = sc_mysql_escape($_REQUEST['setval']);
	
	// to update Image status
	$dbObj->dbQuery = "update ".PREFIX."adminuser set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

if($mode == 'update-status'){ 
 
	
	$info['senton'] = date('Y-m-d H:i:s');
	$id = add_record($dbObj,PREFIX.'reminder',$info); 
	//echo $dbObj->dbQuery ;exit;
	if(!empty($id)){
	// client email id 
	$dbObj->dbQuery="select * from ".PREFIX."quotaion where id='".$info['qid']."'"; // for listing of records
	$dbClientData = $dbObj->SelectQuery('slider.php','slider_images()');
	
	// company detail
	$dbObj->dbQuery="select * from ".PREFIX."company where id='".$dbClientData[0]['cname']."'"; // for listing of records
	$dbCompanyData = $dbObj->SelectQuery('slider.php','slider_images()');

	
	$mail = new PHPMailer();
		$mail->Priority = 3; // COPY
		$mail->From = FROM_EMAIL;
		$mail->FromName = FROM_NAME;			
		$mail->Subject = $info['remindersub'];
		$mail->AddAddress($dbClientData[0]['email'], $dbClientData[0]['kname']);	
		$file_to_attach = 'cms_images/pdf_file/'.$dbCycle[0]['pdfname'];
		$mail->AddAttachment($file_to_attach );
		$mail->Body = "";
		$mail->AltBody = "";	
	
		$body .= ' 
		<table cellpadding="5" cellspacing="0" width="500px">
		<tr>
			<td><font face="Verdana" style="font-size:12px"><b>Dear '.$dbClientData[0]['kname'].',</b></font></td>
		</tr>
		<tr>
			<td><font face="Verdana" style="font-size:12px">'.nl2br(stripslashes($info['reminder'])).'</font></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
	<td align="left" valign="top">'.html_entity_decode(stripslashes($dbClientData[0]['emailmsg'])).'</td>
</tr>
		<tr>
			<td><br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24"><b>Regards,<br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24" >
			'.$dbCompanyData[0]['compname'].'</font></b>	
			</font>
			</td>
		</tr>
		</table> ';
			
		$mail->Body .= $body;
		$mail->Send();
		$mail->ClearAllRecipients();
	
	
	
	echo "Reminder sent to client";
	} else{
		echo "Something went wrong please try again later!";	
	}
	exit();
}

$dbObj->CloseConnection(); // to close the connection

?>