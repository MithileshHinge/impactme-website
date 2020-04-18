<?php
ob_start();
define('DISPLAY_ERRORS', true);
define('DISPLAY_EXCEPTIONS', true);

set_time_limit(0);

ini_set('memory_limit',-1);

ini_set('max_execution_time',-1);

ini_set('ignore_user_abort','On');

ini_set('display_errors', (DISPLAY_ERRORS)?(1):(0));

ini_set('display_startup_errors', (DISPLAY_ERRORS)?(1):(0));

error_reporting((DISPLAY_ERRORS)?(1):(0));

ignore_user_abort (true);

	define("LOG_TABLE", "admin_user");

    date_default_timezone_set( 'Asia/kolkata' );



define("DB_HOST", "localhost");	

if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=="::1") 
{
define("DB_USER", "root");	
define("DB_PASSWORD", "");	
define("DB_NAME", "impact_new");
define("BASEPATH","http://localhost/impact_new");
} 
else
{
define("DB_USER", "demo_impact");	
define("DB_PASSWORD", "demo_impact");	
define("DB_NAME", "demo_impact");	
define("BASEPATH","https://impactme.in/demo");
}

$admin_folder_name = "admin";
$admin_path = BASEPATH."/".$admin_folder_name;
define("ADMINPATH",$admin_path);
$image_folder_name = "images";
$image_url = BASEPATH."/".$image_folder_name."/";
define("IMAGEPATH" ,$image_url);
require_once("class/DbHandler.class.php");
$db = new DbHandler();
include("class/query.class.php");
 $db_query = new query;

//include("class/imageresize.class.php");
$sql_web = $db_query->fetch_object("select * from web_settings where web_id=1");
define("PROJECT_TITLE", $sql_web->site_name);
define("PROJECT_LINK", $sql_web->site_url);
define("CURRENCY", '<i class="fa fa-inr" aria-hidden="true"></i> ');
define("CONTACT_LINK", $sql_web->email_id);
define("ID_NUMBER", "10000000");


$fav_icon = $image_url.$sql_web->fav_icon;

define("USER_CREATOR_PATH", BASEPATH.'/user-creator/');  // CREATOR $_SESSION['user_type'] == 1 
define("POST_CREATOR_PATH", BASEPATH.'/post-creator/');  // FAN $_SESSION['user_type'] == 0



// create a session 
if (!isset($_SESSION)) {

  session_start();

}

$now = time();

$limit = $now - 160*60;

if (isset ($_SESSION['last_activity']) && $_SESSION['last_activity'] < $limit) 

{

   $_SESSION = array();

   header('Location:logout.php');

   exit;

} 

else 

{

   $_SESSION['last_activity'] = $now;

}



if (!isset($_COOKIE['uniqueID'])) {
	
 $expire=time()+60*60*24*30;//however long you want
    setcookie('uniqueID', uniqid(), $expire);
	
}



$config =array(
		"base_url" => "https://www.impactme.in/demo/hybridauth/", 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "XXXXXXXXXXXX", "secret" => "XXXXXXXX" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "411121872866105", "secret" => "c8ceb0e9e4be0c27ef5a005819b5cb40" ),
				"scope" => "email",
				
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "XXXXXXXX", "secret" => "XXXXXXX" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,
		"debug_file" => "error.txt",
	);



?>

