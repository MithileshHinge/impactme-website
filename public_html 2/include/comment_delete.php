<?php
require_once ("../admin_path.php");
//include('./include/access.php');
if(isset($_POST['comment_id']) && !empty($_POST['comment_id']))
{
$comment_id = $_POST['comment_id'];
$sql_check = $db_query->fetch_object("select count(*) c from tbl_comment where parent_comment_id='$comment_id'");
if($sql_check->c==0) {
$db_query->Query("delete from tbl_comment where comment_id='$comment_id'");
}
else
{
 $db_query->Query("Update  tbl_comment set comment='Deleted' where comment_id='$comment_id'");
}
return true;
}

if(isset($_POST['comment_like_id']) && !empty($_POST['comment_like_id']))
{
$comment_id = $_POST['comment_like_id'];
$user_id = base64_decode($_SESSION['user_id']);
$sql_check = $db_query->fetch_object("select count(*) c from tbl_comment_like where comment_id='$comment_id'  and user_id='$user_id'");
$sql_post = $db_query->fetch_object("select post_id from tbl_comment where comment_id='$comment_id'");
if($sql_check->c==0) {
$db_query->Query("INSERT INTO tbl_comment_like (`like_id`, `comment_id`, `user_id`) VALUES (NULL, '$comment_id', '$user_id');");
/* Notification */
$db_query->add_notification($user_id, $sql_post->post_id, "comment_like"  );
/* Notification */

}
else
{
 $db_query->Query("delete from  tbl_comment_like where  comment_id='$comment_id' and user_id='$user_id'");
}
return true;
}


if(isset($_POST['post_like_id']) && !empty($_POST['post_like_id']))
{
$post_id = $_POST['post_like_id'];
$user_id = base64_decode($_SESSION['user_id']);
$sql_check = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$post_id'  and user_id='$user_id'");
if($sql_check->c==0) {
$db_query->Query("INSERT INTO tbl_post_like (`like_id`, `post_id`, `user_id`) VALUES (NULL, '$post_id', '$user_id');");



/* Notification */
$db_query->add_notification($user_id, $post_id, "like"  );
/* Notification */


}
else
{
 $db_query->Query("delete from  tbl_post_like where  post_id='$post_id' and user_id='$user_id'");
}


$sql_check_new = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$post_id' ");
echo json_encode( $sql_check_new->c);
}




?>