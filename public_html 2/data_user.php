<?php
 include('admin_path.php'); 
 header('Content-Type: application/json');
include('include/access.php');

$ids = $db_query->get_ids_sql($row_user->user_id);
/*$sql = "select DATE_FORMAT( paid_date, '%M %Y') paid_date, sum(paid_amount) paid_amount  from impact_payment 
where user_id='".$user_id."' and paid_status='Success' group by DATE_FORMAT( paid_date, '%M %Y') 
order by DATE_FORMAT( paid_date, '%M %Y')   desc";*/


/* $sql = "select DATE_FORMAT( paid_date, '%M %Y') paid_date, count(*) paid_amount  from impact_payment 
where creator_id='".$user_id."' and paid_status='Success' group by DATE_FORMAT( paid_date, '%M %Y') 
order by DATE_FORMAT( paid_date, '%M %Y')   desc";*/

//$sql = "select  DATE_FORMAT( a.paid_timestamp, '%M %Y') paid_date, count(*) paid_amount from ( select p.paid_timestamp ,p.user_id from impact_payment p, impact_user u where u.user_id=p.user_id and p.creator_id in ".$ids." and p.status in ('authenticated', 'active') group by p.user_id order by p.paid_timestamp desc) a ";
//$sql = "select DATE_FORMAT(a.join_date, '%M %Y') paid_date, count(*) paid_amount from (select join_date from impact_join where creator_id in ".$ids." and user_id in (select user_id from impact_user where user_type='create') group by user_id) a";
$sql = "select DATE_FORMAT(a.paid_timestamp, '%M %Y') paid_date, count(*) paid_amount from (select p.paid_timestamp from impact_payment p where p.creator_id in ".$ids." and (p.status='authenticated' or p.status='active') group by p.subscription_id) a ";
$sql = $db_query->runQuery($sql);

$data = array();
foreach($sql as $row)
{
$data[] = $row;	
}

print json_encode($data);

?>



