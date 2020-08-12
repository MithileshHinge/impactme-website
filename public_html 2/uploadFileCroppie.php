<?php
include('admin_path.php'); 
include('./include/access.php');
    //$uploadfile = $_FILES["image_upload_file"]["tmp_name"];
    //$folderPath = "images/user/";
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
   $baseimg = $image_folder_name."/";
   $main_path = $image_folder_name."/".$image_save_folder."/";

   if (!empty($_POST['type']) and !empty($_POST['image'])){
    $type = $_POST['type'];

    $data = $_POST['image'];

    list($filetype, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);

  	if($type=='fan_profile'){
        
        $impact_id=$db_query->impact($row_user->email_id); 
        unlink($baseimg.$impact_id->image_path);

        $upload_img = $db_query->croppie_upload($data, $main_path);
        $_REQUEST[image_path] =  $image_save_folder."/".$upload_img;
  	  
  	    $output['status'] = TRUE;
  	    $output['image_medium']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[image_path];
  	    $db_query->Query("update impact_user set image_path='".$_REQUEST[image_path]."' where user_id='$impact_id->user_id'");

        // send whether user is only fan to determine whether to change header dp without refreshing page
        $creator_id = $db_query->creator($row_user->email_id);
        if ($creator_id)
          $output['only_fan'] = FALSE;
        else
          $output['only_fan'] = TRUE;

    }
    else if ($type == 'creator_profile'){
        
        //$creator_id=$db_query->creator($row_user->email_id);
        unlink($baseimg.$row_user->image_path);
        
        $upload_img = $db_query->croppie_upload($data,$main_path);
        $_REQUEST[image_path] =  $image_save_folder."/".$upload_img;  
      
        $output['status'] = TRUE;
        $output['image_medium']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[image_path];
        $db_query->Query("update impact_user set image_path='".$_REQUEST[image_path]."' where user_id='$row_user->user_id'");
    }
    else if ($type == 'creator_cover'){

        //$creator_id=$db_query->creator($row_user->email_id);
        unlink($baseimg.$row_user->cover_image_path);
        
        $upload_img = $db_query->croppie_upload($data,$main_path);
        $_REQUEST[cover_image_path] =  $image_save_folder."/".$upload_img;  
      
        $output['status'] = TRUE;
        $output['image_medium']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[cover_image_path];
        $db_query->Query("update impact_user set cover_image_path='".$_REQUEST[cover_image_path]."' where user_id='$row_user->user_id'");
    }
  }
  
  
  
  
 echo json_encode($output);
  
  
  
	

?>