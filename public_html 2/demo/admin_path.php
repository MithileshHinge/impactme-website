<?php
$admin_folder_name = "admin";
define("ADMIN",$admin_folder_name);
include($admin_folder_name.'/configure.php');
//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";





$token="";
##### FB App Configuration #####
$fbappid = "411121872866105"; 
$fbappsecret = "c8ceb0e9e4be0c27ef5a005819b5cb40"; 
//$redirectURL = "http://impactme.in/demo/authenticate.php"; 
$redirectURL = BASEPATH."/authenticate.php"; 
$redirectURLGoogle = BASEPATH."/authenticate_google.php"; 
$fbPermissions = ['email']; 



$googleappid = "491092358088-mljc2efpbv1r4fo0soj76hl0t85h1l7i.apps.googleusercontent.com"; 
$googleappsecret = "i6xqSNxJsECySBvhGMwZJObk"; 



?>