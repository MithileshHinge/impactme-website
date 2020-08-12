<?php
 include('admin_path.php'); 
 header('Content-Type: application/json');
include('include/access.php');

$ids = $db_query->get_ids_sql($row_user->user_id);

//$sql = "select DATE_FORMAT( paid_timestamp, '%M %Y') paid_date, sum(paid_amount) paid_amount from impact_payment where creator_id in ".$ids." and (status='authenticated' or status='active') group by DATE_FORMAT( paid_date, '%M %Y') order by DATE_FORMAT( paid_date, '%M %Y')   desc";

$sql = "select DATE_FORMAT( paid_timestamp, '%M %Y') paid_date, ifnull(sum(a.b),0) paid_amount from (select p.paid_timestamp, p.paid_amount b from impact_payment p where p.creator_id in ".$ids." and (p.status='authenticated' or p.status='active') group by p.subscription_id) a";

$sql = $db_query->runQuery($sql);

$data = array();
foreach($sql as $row)
{
$data[] = $row;	
}

echo json_encode($data);
 
?>



