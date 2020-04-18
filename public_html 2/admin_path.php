<?php
$admin_folder_name = "admin";
define("ADMIN",$admin_folder_name);
include($admin_folder_name.'/configure.php');
//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

define("PAGINATION",5);



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
$atom_active = 0;

if($atom_active ==0)
{
$atom_payment_mode = "test"; 
$atom_payment_login = 197; // 103377
$atom_payment_password = "Test@123"; // User@123
$atom_payment_response_path = BASEPATH."/response/";
$atom_payment_response_path_one_time = BASEPATH."/response_one_time/";
$atom_payment_product_id = "NSE"; //ARTIBUNO
$atom_payment_hash_request_key = "KEY123657234"; // f594716d32a09f3a1b
$atom_payment_hash_response_key = "KEY123657234"; // 3cca0d08d9e7ab503c
}

if($atom_active ==1)
{
$atom_payment_mode = "live"; 
$atom_payment_login = 103377; // 103377
$atom_payment_password = "45b10059"; // User@123
$atom_payment_response_path = BASEPATH."/response/";
$atom_payment_response_path_one_time = BASEPATH."/response_one_time/";
$atom_payment_product_id = "ARTIBUNO"; //ARTIBUNO
$atom_payment_hash_request_key = "f594716d32a09f3a1b"; // f594716d32a09f3a1b
$atom_payment_hash_response_key = "3cca0d08d9e7ab503c"; // 3cca0d08d9e7ab503c
}





?>