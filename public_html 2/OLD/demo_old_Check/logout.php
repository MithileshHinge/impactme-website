<?php
include('admin_path.php');
session_destroy();
unset($_SESSION['is_user_login']);
unset($_SESSION['fb_token']);
header('location:'.BASEPATH);


?>