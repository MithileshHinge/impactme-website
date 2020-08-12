<?php
include('../admin_path.php'); 
include('./access.php');


if(isset($_POST['user_nameCreator']) && !empty($_POST['user_nameCreator']))
{
$s = trim($_POST['user_nameCreator']);
$user_id = trim($_POST['userID']);
//$sql_query = "select DISTINCT  u.* from impact_payment p, impact_user u where u.user_id=p.creator_id and p.creator_id='".base64_decode($_SESSION['user_id'])."' and p.paid_status='Success'  and  (u.full_name like '%$s%' or u.impact_name  like '%$s%' ) group by p.creator_id order by u.full_name" ;

$ids_sql = $db_query->get_ids_sql($user_id);
$sql_query = "select u.*  from impact_payment p, impact_user u where p.user_id=u.user_id and  p.creator_id in ".$ids_sql." and (p.status='authenticated' or p.status='active') and u.full_name like '$s%' and u.user_type='create' order by u.full_name";
//echo $sql_query;


$sql = $db_query->runQuery($sql_query);

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
if(isset($_POST['user_nameImpact']) && !empty($_POST['user_nameImpact']))
{
$s = trim($_POST['user_nameImpact']);
$user_id = trim($_POST['userID']);
$ids_sql = $db_query->get_ids_sql($user_id);


  $sql_query = "
  select u.* from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id in ".$ids_sql." and (p.status='authenticated' or p.status='active') and u.impact_name like '$s%' and u.user_type='ucreate' group by p.creator_id order by u.impact_name";
 // echo $sql_query;
  
$sql = $db_query->runQuery($sql_query);

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

if(isset($_POST['userid']) && !empty($_POST['userid']))
{
$s = trim($_POST['userid']);
$row_user[] = $db_query->fetch_array("select * from impact_user where user_id='$s'");
echo $json = json_encode($row_user);



}

if(isset($_POST['creator_id']) && isset($_POST['user']) && isset($_POST['subject']) )
{
 $creator_id = $db_query->filter($_POST['creator_id']);
 $user = $db_query->filter($_POST['user']);
 $subject = $db_query->filter(trim($_POST['subject']));
 $date = date('Y-m-d H:i:s');
  if(empty($subject) ||  empty($user) || empty($creator_id) || $creator_id==0 || $user==0)
 {
echo false;
 }
 else
 {
 $sql = "insert into impact_message (message_id, from_id, to_id, message, send_date, status) values(NULL, '".$user."' , '".$creator_id."' , '".$subject."' , '".$date."',0 )";
 $result = $db_query->Query($sql);
 echo $result;
 }
}

if(isset($_POST['impact_id']) && isset($_POST['user']) && isset($_POST['subject']) )
{
 $impact_id = $db_query->filter($_POST['impact_id']);
 $user = $db_query->filter($_POST['user']);
 $subject = $db_query->filter(trim($_POST['subject']));
 $date = date('Y-m-d H:i:s');
 if(empty($subject) ||  empty($user) || empty($impact_id) || $impact_id==0 || $user==0)
 {
echo false;
 }
 else
 {
  $sql = "insert into impact_message (message_id, from_id, to_id, message, send_date, status) values(NULL, '".$user."' , '".$impact_id."' , '".$subject."' , '".$date."',0 )";
 $result = $db_query->Query($sql);
 echo $result;
  
 }
}

if(isset($_POST['deleteId']) && !empty($_POST['deleteId']))
{
 $deleteId = $db_query->filter($_POST['deleteId']);
 $type = $_POST['type'];
 if($type==2) {
 $sql = "update  impact_message set from_delete=1 where message_id='$deleteId'";
 }
 else
 {
 $sql = "update  impact_message set to_delete=1 where message_id='$deleteId'";
 }
 $result = $db_query->Query($sql);
 echo $result;
}


if(isset($_POST['message_id']) && !empty($_POST['message_id']))
{
 $message_id = $db_query->filter($_POST['message_id']);

 $sql = "update impact_message set status=1 where message_id='$message_id'";
 $result = $db_query->Query($sql);
 echo $result;
}

?>