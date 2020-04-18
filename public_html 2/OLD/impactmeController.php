<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
require_once('config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'phpmailer.php'); // file to sent email
$dbObj = new DBConnection(); // database connection

$mode = $_REQUEST['mode']; // action to perform
$info = $_REQUEST['info']; // data array sent from form
//print_r($info);exit;



$id = sc_mysql_escape($_REQUEST['id']);




if($mode=="profile"){
	 $id = sc_mysql_escape($_SESSION['user_id']);
	if(empty($info['impactname'])){
		$msg = base64_encode("Please Enter Your name is displayed on your profile."); // message about action performed
		header('location:edit.php?&msg='.$msg);
		exit;
	}
	
	
	
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.$_FILES['image']['name']; // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg,png Images.'); // message about action performed
			header('location:edit.php?&msg='.$msg);
			exit;
		}
		
		$info['pimage'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."users where id=".$id;
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(ATTACHMENT_FILE_PATH.$imgRes[0]['pimage']) && !empty($imgRes[0]['pimage'])){
			unlink(ATTACHMENT_FILE_PATH.$imgRes[0]['pimage']); // remove original image form folder
		}
		move_uploaded_file($_FILES['image']['tmp_name'],ATTACHMENT_FILE_PATH.$image_name); // upload original image in original folder
	}
	if(isset($_FILES['coverimage']) && $_FILES['coverimage']['size']>0){
	
		$image_name = time().'_'.$_FILES['coverimage']['name']; // to remane image
		$temp = explode('.',$_FILES['coverimage']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg,png Images.'); // message about action performed
			header('location:edit.php?&msg='.$msg);
			exit;
		}
		
		$info['coverimage'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."users where id=".$id;
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(ATTACHMENT_FILE_PATH.$imgRes[0]['coverimage']) && !empty($imgRes[0]['coverimage'])){
			unlink(ATTACHMENT_FILE_PATH.$imgRes[0]['coverimage']); // remove original image form folder
		}
		move_uploaded_file($_FILES['coverimage']['tmp_name'],ATTACHMENT_FILE_PATH.$image_name); // upload original image in original folder
	}
	//print_r($data);exit;
	
	$info['modifiedon'] = date('Y-m-d');
		
	modify_record($dbObj,PREFIX.'users',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:edit.php?&msg='.$msg);
	exit;
		
	 
}

///add/edit tier
if($mode=='add_tier'){
	$info['userid'] = sc_mysql_escape($_SESSION['user_id']);

	if(empty($info['tiername'])){
		$msg = base64_encode("Please Enter Tier Name."); // message about action performed
		header('location:tiers.php?id='.$id.'&msg='.$msg);
		exit;
	}
	if(empty($info['tier_price'])){
		$msg = base64_encode("Please Select Tier Price."); // message about action performed
		header('location:tiers.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	if(empty($info['tier_details'])){
		$msg = base64_encode("Please Enter Tier Details."); // message about action performed
		header('location:tiers.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	$info['tier_details'] = stripslashes($info['tier_details']);
	
	
	
	//print_r($data);exit;
	if(!empty($id)){ // check requested id to update record
		$info['modified'] = date('Y-m-d');
	    modify_record($dbObj,PREFIX.'tier',$info,'id='.$id); 
		
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	   
		
	} else { // if id is empty than add new record
	  	$info['createdon'] = date('Y-m-d');
		$id = add_record($dbObj,PREFIX.'tier',$info); 
		
		
		
		
		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    
	} 
	
	
	header('location:tiers.php?msg='.$msg);
	exit;
}

//mode to delete client
if($mode=='delete_tirer'){  // to delete seleted record

	$id = sc_mysql_escape($_REQUEST['id']);  // id of selected record to delete
 	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:tiers.php?msg='.$msg);
	   exit;	
	}	
	
		
	delete_record($dbObj,PREFIX.'tier','id='.$id);
	
	
	
	 //echo $dbObj->dbQuery;exit;	
	 
	 $msg = base64_encode("Record Successfully Deleted."); // message about action performed
	 header('location:tiers.php?mo=tiers&msg1='.$msg);
	 exit;	
}



///add/edit tier
if($mode=='add_goal'){
	$info['userid'] = sc_mysql_escape($_SESSION['user_id']);

	if(empty($info['goal_type'])){
		$msg = base64_encode("Please select goal tyoe."); // message about action performed
		header('location:goals.php?id='.$id.'&msg='.$msg);
		exit;
	}
	if(empty($info['goal_price'])){
		$msg = base64_encode("Please enter Price."); // message about action performed
		header('location:goals.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	if(empty($info['goal_details'])){
		$msg = base64_encode("Please Enter Details."); // message about action performed
		header('location:goals.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	$info['goal_details'] = stripslashes($info['goal_details']);
	 
	
	//print_r($data);exit;
	if(!empty($id)){ // check requested id to update record
		$info['modified'] = date('Y-m-d');
	    modify_record($dbObj,PREFIX.'goals',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;	
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	   
		
	} else { // if id is empty than add new record
	  	$info['createdon'] = date('Y-m-d');
		$id = add_record($dbObj,PREFIX.'goals',$info); 
		
		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    
	} 
	
	
	header('location:goals.php?msg='.$msg);
	exit;
}

//mode to delete client
if($mode=='delete_goal'){  // to delete seleted record

	$id = sc_mysql_escape($_REQUEST['id']);  // id of selected record to delete
 	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:goals.php?msg='.$msg);
	   exit;	
	}	
	 
	delete_record($dbObj,PREFIX.'goals','id='.$id);
	
	
	
	 //echo $dbObj->dbQuery;exit;	
	 
	 $msg = base64_encode("Record Successfully Deleted."); // message about action performed
	 header('location:goals.php?msg='.$msg);
	 exit;	
}

if($mode=="update_msg"){
	if(empty($info['thanksmsg'])){
		$msg = base64_encode("Please Enter Details."); // message about action performed
		header('location:thanks.php?msg='.$msg);
		exit;
	}
	$id = sc_mysql_escape($_SESSION['user_id']);
	$info['thanksmsg'] = htmlentities($info['thanksmsg'],ENT_NOQUOTES);
	
	modify_record($dbObj,PREFIX.'users',$info,'id='.$id); 
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:thanks.php?msg='.$msg);
	 exit;	
}


if($mode=="manage_post"){
	
	$info['userid'] = sc_mysql_escape($_SESSION['user_id']);
$id = sc_mysql_escape($_REQUEST['id']);
	if(empty($info['post_title'])){
		$msg = base64_encode("Please Enter Post Title."); // message about action performed
		header('location:post.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	
	if(empty($info['descri'])){
		$msg = base64_encode("Please Enter Post Details."); // message about action performed
		header('location:post.php?id='.$id.'&msg='.$msg);
		exit;
	}
	
	$info['descri'] = htmlentities($info['descri'],ENT_NOQUOTES);
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.$_FILES['image']['name']; // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg,png Images.'); // message about action performed
			header('location:post.php?id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."post where id=".$id;
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(ATTACHMENT_FILE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(ATTACHMENT_FILE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		move_uploaded_file($_FILES['image']['tmp_name'],ATTACHMENT_FILE_PATH.$image_name); // upload original image in original folder
	}
	
	
	//print_r($data);exit;
	if(!empty($id)){ // check requested id to update record
		$info['modifiedon'] = date('Y-m-d H:i:s');
	    modify_record($dbObj,PREFIX.'post',$info,'id='.$id); 
		
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	   
		
	} else { // if id is empty than add new record
	  	$info['createdon'] = date('Y-m-d H:i:s');
		$id = add_record($dbObj,PREFIX.'post',$info); 
		//echo $dbObj->dbQuery;exit;	
		
		
		
		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    
	} 
	
	
	header('location:post.php?msg='.$msg);
	exit;
}

//mode to delete client
if($mode=='delete_post'){  // to delete seleted record

	$id = sc_mysql_escape($_REQUEST['id']);  // id of selected record to delete
 	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:post.php?msg='.$msg);
	   exit;	
	}	
	// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."post where id=".$id;
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(ATTACHMENT_FILE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(ATTACHMENT_FILE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		
	delete_record($dbObj,PREFIX.'post','id='.$id);
	
	
	
	 //echo $dbObj->dbQuery;exit;	
	 
	 $msg = base64_encode("Record Successfully Deleted."); // message about action performed
	 header('location:post.php?msg='.$msg);
	 exit;	
}

if($mode=="post_status"){
	$id = sc_mysql_escape($_REQUEST['id']);  // id of selected record to delete
	$statusval = sc_mysql_escape($_REQUEST['statusval']);  // id of selected record to delete	
	
	// to update Image status
	$dbObj->dbQuery = "update ".PREFIX."post set status='".$statusval."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("status Successfully Updated."); // message about action performed
	 header('location:post.php?msg='.$msg);
	 exit;	
}

?>