<?php
include('../admin_path.php'); 
include('./access.php');

if(isset($_POST['Slug']) && !empty($_POST['Slug']))
{
$val = $_POST['Slug'];
$sql_search[] = $db_query->fetch_array("select count(*) c from impact_user where slug='$val' and user_id!='$row_user->user_id'");
echo $json = json_encode($sql_search);
}


if(isset($_POST['user_name']) && !empty($_POST['user_name']))
{
$s = trim($_POST['user_name']);
$self_id = $_POST['self_id'];

if (!empty($s)){
if (!empty($self_id)){
	$sql = $db_query->runQuery("select * from impact_user where status= 1 and active_status=1 and review_status=1 and user_type='ucreate' and impact_name like '%$s%' and not user_id='".$self_id."' order by impact_name limit 5");
}
else{
	$sql = $db_query->runQuery("select * from impact_user where status= 1 and active_status=1 and review_status=1 and user_type='ucreate' and impact_name like '%$s%' order by impact_name limit 5");
}

$search_arr = array();
foreach($sql as $row)
{

                    $image_post = IMAGEPATH.$row['image_path'];
					if(strlen($row['slug'])>0) 
					 $path = BASEPATH.'/profile/'.$row['slug']."/";
					else
					 $path = BASEPATH.'/profile/u/'.$row['user_id']."/";
					 
					 
					if(strlen($row['image_path'])>0)
				    {
					if (@file_get_contents($image_post, 0, NULL, 0, 1)) 
					 {
					 $image_post = IMAGEPATH.$row['image_path'];
					 }
					 else
					 {
					   $image_post = IMAGEPATH.'nouser.png'; 
					 }
					 }
					else
					 $image_post = IMAGEPATH.'nouser.png'; 
					 
					 
$search_arr[]  = array('id'=> $row['user_id'],'name'=>$row['impact_name'] , 'image'=>$image_post, 'profile_link' => $path, 'tag_line' => $row['tag_line'] );

}
echo json_encode($search_arr);
}
}



if(isset($_POST['UserId']) && isset($_POST['Password']))
{
$user = trim($_POST['UserId']);
$pass = trim($_POST['Password']);

$sql_search = $db_query->fetch_object("select count(*) c from impact_user where user_id='$user' and password='$pass'");
if($sql_search->c==1)
{
  echo 1; 
 }
 else
 {
  echo 0;
 }
 

}

?>