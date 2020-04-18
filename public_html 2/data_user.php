<?php
 include('admin_path.php'); 
 header('Content-Type: application/json');
include('include/access.php');
$user_id =$row_user->user_id;
/*$sql = "select DATE_FORMAT( paid_date, '%M %Y') paid_date, sum(paid_amount) paid_amount  from impact_payment 
where user_id='".$user_id."' and paid_status='Success' group by DATE_FORMAT( paid_date, '%M %Y') 
order by DATE_FORMAT( paid_date, '%M %Y')   desc";*/


/* $sql = "select DATE_FORMAT( paid_date, '%M %Y') paid_date, count(*) paid_amount  from impact_payment 
where creator_id='".$user_id."' and paid_status='Success' group by DATE_FORMAT( paid_date, '%M %Y') 
order by DATE_FORMAT( paid_date, '%M %Y')   desc";*/

$sql = "select  DATE_FORMAT( a.paid_date, '%M %Y') paid_date, count(*) paid_amount from ( select p.paid_date ,p.user_id from impact_payment p, impact_user u where u.user_id=p.user_id and p.creator_id='".$user_id."' and p.paid_status='Success' group by p.user_id order by p.paid_date desc) a ";
$sql = $db_query->runQuery($sql);

$data = array();
foreach($sql as $row)
{
$data[] = $row;	
}

print json_encode($data);

?>



