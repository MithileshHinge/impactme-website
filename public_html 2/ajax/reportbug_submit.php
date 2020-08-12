<?php
include("../include/access.php");

if (isset($_SESSION['is_user_login']) and $_SESSION['is_user_login']){
	$_POST['user_id'] = $row_user->user_id;
	$_POST['user_type'] = $row_user->user_type;
	$_POST['email_id'] = $row_user->email_id;
	$_POST['token'] = substr(md5(rand()), 0, 6);
	if (!empty($_FILES['sup_attachment']['tmp_name'])){
        $image_save_folder = "query_images";
        $main_path = "../".$image_folder_name."/".$image_save_folder."/";
        
        $file_name = $_POST['token'];
        $upload_img = $db_query->cwUpload('sup_attachment',$main_path, $file_name);
        $_POST['filepath'] =  $image_save_folder."/".$upload_img;
	}

	if ($db->insertDataArray('user_queries', $_POST)){
		$output['status'] = 'success';
		$output['token'] = $_POST['token'];
	}else {
		$output['status'] = 'failed';
		$output['error'] = 'could not insert data: '.mysql_error();
	}
}
else{
	$output['status'] = 'failed';
	$output['error'] = 'not logged in';
}

echo json_encode($output);

?>