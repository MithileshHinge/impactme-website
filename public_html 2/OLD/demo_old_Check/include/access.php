<?php
include('../admin_path.php');
if(isset($_SESSION['is_user_login'])==1)
{
 $user_id = base64_decode($_SESSION['user_id']);
 $row_user = $db_query->fetch_object("select * from impact_user where user_id='".$user_id ."'");
}
else
{
header('location:'.BASEPATH);
}

?>