<?php
include('admin_path.php'); 
include('./include/access.php');
 
	$image_save_folder = "video";
	
	 if($_FILES['video_upload_file']['tmp_name']!="")
    {
	
     $filename_err = explode(".",$_FILES['video_upload_file']['name']);
	 $filename_err_count = count($filename_err);
	 $file_ext = $filename_err[$filename_err_count-1]; 
	 $fileName = rand().time();
	  
	  $baseimg = $image_folder_name."/";	
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('video_upload_file',$main_path,$fileName,TRUE,$thumb,'100','75',$fileName);
 
	   $output['status'] = TRUE;
	   $output['video_medium']= $image_save_folder.'/'.$fileName.'.'.$file_ext;
  
	   
  }	
  
  
   if($_FILES['cover_image_upload_file']['tmp_name']!="")
    {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->cover_image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('cover_image_upload_file',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[cover_image_path] =  $image_save_folder."/".$upload_img; 	
	  
	   $output['status_cover'] = TRUE;
	   $output['image_cover']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[cover_image_path];
	   $db_query->Query("update impact_user set cover_image_path='".$_REQUEST[cover_image_path]."' where user_id='$row_user->user_id'");
	  // echo json_encode($output);
  }	
  
      
// USER CREATOR PAGE	  
	   if($_FILES['cover_image']['tmp_name']!="")
    {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->cover_image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('cover_image',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[cover_image_path] =  $image_save_folder."/".$upload_img; 	
	  
	   $output['status_cover'] = TRUE;
	   $output['image_cover_image']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[cover_image_path];
	   $db_query->Query("update impact_user set cover_image_path='".$_REQUEST[cover_image_path]."' where user_id='$row_user->user_id'");
	  // echo json_encode($output);
  }
  
  if($_FILES['profile_image']['tmp_name']!="")
    {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('profile_image',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[profile_image_path] =  $image_save_folder."/".$upload_img; 	
	  
	   $output['status_profile'] = TRUE;
	   $output['image_profile']=BASEPATH.'/'.$baseimg.'/'.$_REQUEST[profile_image_path];
	   $db_query->Query("update impact_user set image_path='".$_REQUEST[profile_image_path]."' where user_id='$row_user->user_id'");
	  // echo json_encode($output);
  }
  
  
 echo json_encode($output);
  
  
  
	

?>