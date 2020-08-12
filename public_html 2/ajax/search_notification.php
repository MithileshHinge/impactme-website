<?php
include('../admin_path.php'); 
include('./access.php');


if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
$s = trim($_POST['user_id']);
$ids = $db_query->get_ids_sql($s);
$sq = "update  impact_notification set notification_status=1 where notification_status= 0 and user_id in $ids";
$sql = $db_query->runQuery($sq);
$search_arr = 1;
echo json_encode($search_arr);
}

if(isset($_POST['notify_id']) && !empty($_POST['notify_id']))
{
$s = trim($_POST['notify_id']);
$sq = "update  impact_notification set read_status=1 where read_status= 0 and notification_id='".$s."'";
$sql = $db_query->runQuery($sq);
$search_arr = 1;
echo json_encode($search_arr);
}





?>