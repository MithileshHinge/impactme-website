<?php
require_once ("../admin_path.php");
//print_r($_POST);
$commentId = isset($_POST['comment_id'])? $db_query->filter($_POST['comment_id']) : "0";
$comment = isset($_POST['comment']) ? $db_query->filter($_POST['comment']) : "";
$commentSenderName = isset($_POST['name']) ? $db_query->filter($_POST['name']) : "";
$postId = isset($_POST['post_id']) ? $db_query->filter($_POST['post_id']) : "0";
$userId = isset($_POST['user_id']) ? $db_query->filter($_POST['user_id']) : "0";
$userId = isset($_POST['user_id']) ? $db_query->filter($_POST['user_id']) : "0";
$date = date('Y-m-d H:i:s');
$commentId = ($commentId)?$commentId:"0";

  $sql = "INSERT INTO tbl_comment(parent_comment_id,comment,comment_sender_name,date,post_id,user_id) VALUES ('" . $commentId . "','" . stripslashes($comment) . "','" . $commentSenderName . "','" . $date . "' ,'" . $postId . "' ,'" . $userId . "')";

$result = $db_query->Query($sql);

$db_query->add_notification($userId, $postId, "Comment_add" );
if($commentId>0)
{
 $db_query->add_notification_comment_reply($userId, $commentId, "Comment_add" );
}

echo $result;
?>
