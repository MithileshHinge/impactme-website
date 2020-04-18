<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
$dbObj = new DBConnection(); // database connection

$mode = $_REQUEST['mode']; // action to perform
$info = $_REQUEST['info']; // data array sent from form
//print_r($info);exit;


$id = sc_mysql_escape($_REQUEST['id']);

///add/edit tier
if($mode=='add_tier'){
	$qdescri = $_REQUEST['qdescri'];

	if(empty($info['tiername'])){
		$msg = base64_encode("Please Enter Tier Name."); // message about action performed
		header('location:index.php?mo=add-new-tier&id='.$id.'&msg='.$msg);
		exit;
	}
	if(empty($info['tier_price'])){
		$msg = base64_encode("Please Select Tier Price."); // message about action performed
		header('location:index.php?mo=add-new-tier&id='.$id.'&msg='.$msg);
		exit;
	}
	if(empty($info['tier_type'])){
		$msg = base64_encode("Please Enter Tier Type."); // message about action performed
		header('location:index.php?mo=add-new-tier&id='.$id.'&msg='.$msg);
		exit;
	}
	
	if(empty($info['tier_details'])){
		$msg = base64_encode("Please Enter Tier Details."); // message about action performed
		header('location:index.php?mo=add-new-tier&id='.$id.'&msg='.$msg);
		exit;
	}
	
	$info['tier_details'] = htmlentities($info['tier_details'],ENT_NOQUOTES);
	
	
	
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
	
	
	header('location:index.php?mo=tiers&msg1='.$msg);
	exit;
}

//mode to delete client
if($mode=='delete_tirer'){  // to delete seleted record

	$id = sc_mysql_escape($_REQUEST['id']);  // id of selected record to delete
 	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=tiers&msg1='.$msg);
	   exit;	
	}	
		
	delete_record($dbObj,PREFIX.'tier','id='.$id);
	
	
	
	 //echo $dbObj->dbQuery;exit;	
	 
	 $msg = base64_encode("Record Successfully Deleted."); // message about action performed
	 header('location:index.php?mo=tiers&msg1='.$msg);
	 exit;	
}

if($mode=="changeStatus"){
	$id = sc_mysql_escape($_REQUEST['id']);
	$status = sc_mysql_escape($_REQUEST['setval']);
	
		// to update Image status
		$dbObj->dbQuery = "update ".PREFIX."tier set status='".$status."' where id=".$id;
		$dbObj->ExecuteQuery();	
	echo $status;
	exit;
}



?>