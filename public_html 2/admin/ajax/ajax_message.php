<?php
include('../admin_path.php');
include('../class/class.message.php');
$message = new Message();

if($_GET['get_type'] == 'load_user_message_list'){
	
	echo $message->load_user_message_list($_GET['from_id'], $_GET['to_id']);
	exit();
}

if($_GET['get_type'] == 'load_user_message_list_impact'){
	
	echo $message->load_user_message_list_impact($_GET['from_id'], $_GET['to_id']);
	exit();
}

if($_GET['get_type'] == 'message_add'){
	
	echo $message->message_add($_GET['from_id'], $_GET['to_id'] ,  $_GET['msg']);
	exit();
}

?>

