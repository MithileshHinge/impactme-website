<?php
include('../include/access.php');

if(isset($_POST['Slug']) && !empty($_POST['Slug']))
{
$val = $_POST['Slug'];
$sql_search[] = $db_query->fetch_array("select count(*) c from impact_user where slug='$val' and user_id!='$row_user->user_id'");
echo $json = json_encode($sql_search);
}

?>