<?php
@date_default_timezone_set( "Asia/Kolkata");

// Set url constant
define('SITE_URL', 'https://www.impactme.in');
define('SITE_NAME', 'ImpactMe');  
define('LINK', SITE_URL.'/');
define('HTACCESS_URL', SITE_URL.'/');//For htaccess

// Set folder constant
define('ROOT_DIR', '/home/ffke7qkibpol/public_html/');
define('CLASS_DIR', ROOT_DIR.'classes/');
define('MYSQL_CLASS_DIR', CLASS_DIR.'mysql/');
define('PHP_FUNCTION_DIR', CLASS_DIR.'php_functions/');
define('OUTPUT_DIR', ROOT_DIR.'output/');
define('ERROR_LOG', OUTPUT_DIR.'errorlog/');
define('IMAGE_FOLDER_PATH', ROOT_DIR.'cms_images/');
define('MODULE_DIR',ROOT_DIR.'module/');
define('INCLUDE_DIR',ROOT_DIR.'include/');

//For mailing purpose
define('FROM_EMAIL', 'info@impactme.in');
define('FROM_NAME', 'ImpactMe');

define('ADMIN_ROOT_DIR',ROOT_DIR.'admin/');
define('ADMIN_MODULE_DIR',ADMIN_ROOT_DIR.'module/');
define('ADMIN_INCLUDE_DIR',ADMIN_ROOT_DIR.'include/');

//Prefix for database
define('PREFIX', 'impact_');

// MYSQL Database Related
define('MYSQL_DB_SERVER','localhost');
define('MYSQL_DB_NAME', 'asfewtaW');
define('MYSQL_DB_USER','impactme');
define('MYSQL_DB_PWD','+G3,[B&d@X](');

// Facebook API configuration
define('FB_APP_ID', '404182863531332'); // Replace {app-id} with your app id
define('FB_APP_SECRET', 'ee146f6d31ebd88de0fa9b4fb0e514db'); // Replace {app-secret} with your app secret
define('FB_REDIRECT_URL', 'https://www.impactme.in/');


if(isset($_SESSION['view_all']) && !empty($_SESSION['view_all'])){
	define("RECORD_PER_PAGE",$_SESSION['view_all']); // records per page for admin
} else {
	define("RECORD_PER_PAGE",20); // records per page for admin
}
define("RECORD_PER_PAGE_ORDER",20);
define("RECORD_PER_PAGE_PRODUCTS",12);
define("PAGE_LINKS_PER_PAGE", 10); // links per page

//slider module
define("SLIDER_IMAGE_PATH", IMAGE_FOLDER_PATH.'slider/original/');  // slider image folder path
define("SLIDER_THUMBS_IMAGE_PATH", IMAGE_FOLDER_PATH.'slider/thumb/'); // slider image folder path

//projects  module
define("ATTACHMENT_FILE_PATH", IMAGE_FOLDER_PATH.'user/original/');  // slider image folder path


$config =array(
		"base_url" => "https://www.impactme.in/hybridauth/", 
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "491092358088-mljc2efpbv1r4fo0soj76hl0t85h1l7i.apps.googleusercontent.com", "secret" =>"i6xqSNxJsECySBvhGMwZJObk" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "2471457966245213", "secret" => "19477595015eedf490ddeaef7f8c9f7e" ), 
				'scope'   => "email",
                'trustForwarded' => false
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "XXXXXXXX", "secret" => "XXXXXXX" ) 
			),
		),
		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
			"debug_mode" => false,
		"debug_file" => "",
	);

?>