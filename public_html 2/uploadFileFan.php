<?php
include('admin_path.php'); 
include('./include/access.php');
    $uploadfile = $_FILES["image_upload_file"]["tmp_name"];
    $folderPath = "images/user/";
	//echo $_POST['impact_name'];
   // echo $_FILES["image_upload_file"]["tmp_name"];
   /* if (! is_writable($folderPath) || ! is_dir($folderPath)) {
        echo "error";
        exit();
    }*/
  //  if (move_uploaded_file($_FILES["image_upload_file"]["tmp_name"], $folderPath . $_FILES["image_upload_file"]["name"])) {
      //  echo '<img src="' . $folderPath . "" . $_FILES["image_upload_file"]["name"] . '">';
		//$output['status'] = TRUE;
	//   $output['image_medium']=BASEPATH.'/'.$folderPath.$_FILES["image_upload_file"]["name"];
     //  exit();
  //  }
	
	
	$image_save_folder = "user";
	 if($_FILES['image_upload_file']['tmp_name']!="")
    {
      $impact_id    =$db_query->impact($row_user->email_id); 
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$impact_id->image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('image_upload_file',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 	
	  
	   $output['status'] = TRUE;
	   $output['image_medium']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[image_path];
	   $db_query->Query("update impact_user set image_path='".$_REQUEST[image_path]."' where user_id='$impact_id->user_id'");
	   
  }	
  
  
  
  
  
 echo json_encode($output);
  
  
  
	

?>