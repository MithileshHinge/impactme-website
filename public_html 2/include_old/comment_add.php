<?php
require_once ("../admin_path.php");
$commentId = isset($_POST['comment_id']) ? $db_query->filter($_POST['comment_id']) : "";
$comment = isset($_POST['comment']) ? $db_query->filter($_POST['comment']) : "";
$commentSenderName = isset($_POST['name']) ? $db_query->filter($_POST['name']) : "";
$postId = isset($_POST['post_id']) ? $db_query->filter($_POST['post_id']) : "0";
$userId = isset($_POST['user_id']) ? $db_query->filter($_POST['user_id']) : "0";
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO tbl_comment(parent_comment_id,comment,comment_sender_name,date,post_id,user_id) VALUES ('" . $commentId . "','" . stripslashes($comment) . "','" . $commentSenderName . "','" . $date . "' ,'" . $postId . "' ,'" . $userId . "')";

$result = $db_query->Query($sql);


echo $result;
?>
