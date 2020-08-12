<?php
$admin_folder_name = "admin";
define("ADMIN",$admin_folder_name);
include($admin_folder_name.'/configure.php');
//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

define("PAGINATION",5);



$token="";
##### FB App Configuration #####
$fbappid = "291559185478909"; 
$fbappsecret = "e723bef674d985a98b2d3dff0129d0ee"; 
//$redirectURL = "http://impactme.in/demo/authenticate.php"; 
$redirectURL = BASEPATH."/authenticate.php"; 
$redirectURLGoogle = BASEPATH."/authenticate_google.php"; 
$fbPermissions = ['email']; 



$googleappid = "138901300177-b1mnjf3cg1n4j1nnec9ddq78cb693nam.apps.googleusercontent.com"; 
$googleappsecret = "4Ly1yN2or6Exezddr-tHMKkW"; 
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

$razorpay_live = 1;

if($razorpay_live == 1){
	$razorpay_id = "rzp_live_2Q0Lnuw3Zqk6xL";
	$razorpay_secret = "24W4ErCk0mrPm5n3CBog6qaQ";
}else {
	$razorpay_id = "rzp_test_5ywxjtGTzegjUB";
	$razorpay_secret = "JwBYcayJ12WR1sXekIB0VyK6";
}


?>