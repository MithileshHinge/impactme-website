<?php
include('../admin_path.php');
if(isset($_SESSION['is_user_login'])==1)
{
 if(isset($_SESSION['user_type']) == "1")
 {
 header('location:'.USER_CREATOR_PATH);
 }
 else
 {
 header('location:'.POST_CREATOR_PATH);
 }

 
}
else
{
header('location:'.BASEPATH);
}

?>