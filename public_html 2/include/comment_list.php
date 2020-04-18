<?php
require_once ("../admin_path.php");
//include('include/access.php');
$user_id = base64_decode($_SESSION['user_id']);
$row_user1 = $db_query->fetch_object("select full_name from impact_user where user_id='$user_id'");
$post_id = $_GET[post_id];
$sql = $db_query->runQuery("SELECT * FROM tbl_comment where post_id='$post_id' ORDER BY  parent_comment_id asc, comment_id asc limit 10");
$search_arr = array();
foreach($sql as $row)
{

$sql_count_like = $db_query->fetch_object("select count(*) c from tbl_comment_like where comment_id='$row[comment_id]'");
$sql_mycount_like = $db_query->fetch_object("select count(*) c from tbl_comment_like tl where tl.user_id='$user_id' and tl.comment_id='$row[comment_id]'");

$row_user = $db_query->fetch_object("select image_path from impact_user where user_id='$row[user_id]' ");


                    if(strlen($row_user->image_path)>0)
				    {
					 $Path_name_image = BASEPATH.'/images/'.$row_user->image_path;
					if (@file_get_contents($Path_name_image, 0, NULL, 0, 1)) 
					 {
					 $user_image = IMAGEPATH.$row_user->image_path;
					 }
					 else
					 {
					   $user_image = IMAGEPATH.'nouser.png'; 
					 }
					 }
					else
					 $user_image = IMAGEPATH.'nouser.png'; 
	if($user_id ==$row[user_id])	
	{
	 $delete = 1;
	}			 
	else
	{
	 $delete = 0;
	}
					 
 $search_arr[]  = array('comment_id'=> $row['comment_id'],'parent_comment_id'=>$row['parent_comment_id'] ,'comment'=>$db_query->filter($row['comment']) ,'comment_sender_name'=>$row['comment_sender_name'] ,'date'=>$db_query->facebook_time_ago($row['date']), 'image'=>$user_image ,'delete'=>$delete, 'no_of_like'=>$sql_count_like->c , 'my_like'=>$sql_mycount_like->c ,'user_id' => $user_id , 'user_name' => $row_user1->full_name );
}

echo json_encode($search_arr);
?>