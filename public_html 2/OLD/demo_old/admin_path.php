<?php
$admin_folder_name = "admin";
define("ADMIN",$admin_folder_name);
include($admin_folder_name.'/configure.php');
//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$host = "mail.carellocart.com"; // SMTP host
$username = "test@carellocart.com"; //SMTP username
$password = "test@2359"; // SMTP password


?>