<?php
// Purpose: to add records into table

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$data		array with field names as keys, and values rep. those field values
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

//echo "function.database";exit;

function add_record($dbObj, $table, $data){
	
	// fix characters that MySQL doesn't like
	foreach(array_keys($data) as $field_name) {

		$data[$field_name] = sc_mysql_escape($data[$field_name]);
		
		if (!isset($field_string)) {
			$field_string = "`".strtolower($field_name)."`"; 
			$value_string = "'$data[$field_name]'";
		} else {
			$field_string .= ",`".strtolower($field_name)."`";
			$value_string .= ",'$data[$field_name]'";
		}
	}

	$dbObj->dbQuery = "INSERT INTO $table ($field_string) VALUES ($value_string)";
//echo $dbObj->dbQuery;exit;
	
	// grab rn# that was just added
	$insert_id = $dbObj->InsertQuery("function.database.php", "add_record()");

	// return record number of the record just added, in case we need it
	return $insert_id;
}

//Purpose:
//	To modify a record

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$data		array with field names as keys, and values rep. those field values
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

function modify_record($dbObj, $table, $data, $where){
  //print_r($data);exit;
	// $data must be an array...if it's not...bail
	if (!is_array($data)) return;

	foreach(array_keys($data) as $field_name) { 
		//$data[$field_name] = sc_mysql_escape($data[$field_name]);

		// if set string isn't set, set it....else append with a comma in between
		if (!isset($set_string)) {
			$set_string = "`".strtolower($field_name)."` = '$data[$field_name]'";
		} else {
			$set_string = "$set_string, `".strtolower($field_name)."` = '$data[$field_name]'";
		}
	}
	
	$dbObj->dbQuery = "UPDATE $table SET $set_string WHERE $where";
	//echo $dbObj->dbQuery;exit;
	//echo $dbObj->dbQuery;exit;
	return $dbObj->ExecuteQuery("function.database.php", "modify_record()");
}

//Purpose:
//	To delete a record

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

function delete_record($dbObj, $table, $where){

	$dbObj->dbQuery = "DELETE FROM $table WHERE $where";
	//echo $dbObj->dbQuery;exit;
	return $dbObj->ExecuteQuery("function.database.php", "delete_record()");
}

//Purpose: to call mysql_real_escape_string(), stripping slashes before only if necessary
function sc_mysql_escape($value) {
$dbUsername = MYSQL_DB_USER;
$dbPassword = MYSQL_DB_PWD;
$dbServer = MYSQL_DB_SERVER;
$dbName = MYSQL_DB_NAME;
$connection = mysqli_connect($dbServer, $dbUsername, $dbPassword,$dbName);

	if (is_string($value));

	// strip out slashes IF they exist AND magic_quotes is on
	if (get_magic_quotes_gpc() && (strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);
	
	// escape string to make it safe for mysql
	return mysqli_real_escape_string($connection,$value);

}





//Purpose: to call addslashes(), stripping slashes before only if necessary
function sc_php_escape($value) {

	if (is_string($value));

	// strip out slashes IF they exist AND magic_quotes is on
	if (get_magic_quotes_gpc() && (strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);
	
	// escape string to make it safe for mysql
	return addslashes($value);
}

function Randon_Number(){

	$stringlength = 10;
	$string = "1234567890abcdefghijklmnopqrstuvwxyz!]@[#$)%&(ABCDEFGHIJKLMNOPQRSTUVWYZ";
	$max = strlen($string)-1;
	
	$random_string="";
	for ($i=0; $i<$stringlength; $i++){
		$number = mt_rand(0,$max);
		$random_string.= substr($string,$number,1);
	}
	return $random_string;
}

function login_check(){

	if(!isset($_SESSION['is_admin'])){
		$msg = base64_encode("Please Login");
		header("Location:index.php?mo=login&msg=".$msg);
		exit;
	}
}
function user_login_check()
{
	if(!isset($_SESSION['is_user_login']) && empty($_SESSION['is_user_login'])){
		$msg = base64_encode("Please Login.");
		header('Location:index.php?mo=login&m=login&msg='.$msg);
		exit;
	}
}
function replace_string($string){
	$str_val = str_replace(' ','-',str_replace('-','_',str_replace('&','$',trim($string))));
	return($str_val);
}

function string_rep($string){
	$str_val = str_replace('$','&',str_replace('_','-',str_replace('-',' ',trim($string))));
	return($str_val);
}

function just_clean($string){
	// Replace other special chars
	$specialCharacters = array('#' => '','$' => '','%' => '','&' => '','@' => '','.' => '','€' => '','+' => '','=' => '','§' => '','\\' => '','/' => '','?'=>'','('=>'',')'=>'','<'=>'','<'=>'',','=>'','*'=>'','_'=>'','-'=>'',' '=>'','\\'=>'',':'=>'','http://'=>'','www.'=>'','|'=>'','||'=>'',"'"=>'');
	
	while (list($character, $replacement) = each($specialCharacters)) {
		$string = str_replace($character, '-' . $replacement . '-', $string);
	}
	
	$string = strtr($string,"ÀÁÂÃÄÅáâãäåà?ÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
	"AAAAAAaaaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
	
	// Remove all remaining other unknown characters
	$string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
	
	$string = preg_replace('/^[\-]+/', ' ', $string);
	
	$string = preg_replace('/[\-]+$/', ' ', $string);
	
	$string = preg_replace('/[\-]{2,}/', ' ', $string);
		
	$string = str_replace(' ', '-', trim($string));
	
	return strtolower($string);
}

// used in csv export
function cleanData(&$str){
	if($str == 't') 
		$str = 'TRUE'; 
	
	if($str == 'f') 
		$str = 'FALSE'; 
	
	if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)){
		$str = "'$str"; 
	} 
	
	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}


function checksearchdata($word){
	//echo $word;exit;
	if(trim($word)=='the')
		return false;
	else if(trim($word)=='for')
		return false;
	else if(trim($word)=='are')
		return false;
	else if(trim($word)=='has')
		return false;
	else if(trim($word)=='you')
		return false;
	else if(trim($word)=='should')
		return false;
	else if(trim($word)=='how')
		return false;
	else if(trim($word)=='shall')
		return false;
	else if(trim($word)=='can')
		return false;
	else if(trim($word)=='one')
		return false;
	else if(trim($word)=='two')
		return false;
	else
		return true;
}

/* redirect($msg,$location_with_parameter)- To redirect to a location with its parameter and msg with index.php page and mode value
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/

function redirect_session($location_with_parameter)
{
	//echo "Location:index.php?mo=$location_with_parameter&msg=".$msg;exit;
	
	header("Location:".LINK."$location_with_parameter/");
	exit();
}

/* redirect_page($msg,$location_with_parameter)- To redirect to a particlar page location with its parameter and msg
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/
function redirect_page($msg,$location_with_parameter)
{
	$msg =base64_encode($msg);
	header("Location:$location_with_parameter&msg=".$msg);
	exit();
}


/* redirect_page($msg,$location_with_parameter)- To redirect to a particlar page location with its parameter and msg
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/
function redirect_page_sesssion($location_with_parameter)
{
	header("Location:$location_with_parameter");
	exit();
}

function access_check($page_name){
	
	$plist = array("change_password","change_email");

	if($_SESSION['access']['pages']=='Y'){
	
		$plist = array_merge($plist,array("pages","add_page","subpages","slider"));
	}
	if($_SESSION['access']['banner']=='Y'){
	
		$plist = array_merge($plist,array("banner"));
	}
	if($_SESSION['access']['services']=='Y'){
	
		$plist = array_merge($plist,array("services"));
	}
	if($_SESSION['access']['team']=='Y'){
	
		$plist = array_merge($plist,array("team"));
	}
	if($_SESSION['access']['testimonials']=='Y'){
	
		$plist = array_merge($plist,array("testimonials"));
	}
	if($_SESSION['access']['blogs']=='Y'){
	
		$plist = array_merge($plist,array("add_blog","blog","blog_images","blog_cat"));
	}
	if($_SESSION['access']['portfolio']=='Y'){
	
		$plist = array_merge($plist,array("gallery"));
	}
	if($_SESSION['access']['social']=='Y'){
	
		$plist = array_merge($plist,array("social_links"));
	}
	if($_SESSION['access']['seo']=='Y'){
	
		$plist = array_merge($plist,array("seo_content","subpage_seo"));
	}
	
	if($_SESSION['admin_as']=="super_admin"){
		$plist = array("change_password","change_email","change_logo","admin_user","add_admin","pages","add_page","subpages","slider","services","team","testimonials","add_blog","blog","blog_images","blog_cat","gallery","social_links","seo_content","subpage_seo");
	}
	//print_r($plist);exit;
	if(!in_array($page_name,$plist)){
		header("Location:index.php?mo=dashboard");
		exit;
	}
}

function getYoutubeImage($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];  
        //DISPLAY THE IMAGE
		//$thumb1 = file_get_contents("http://img.youtube.com/vi/$vidID/0.jpg");
//$thumb2 = file_get_contents("http://img.youtube.com/vi/$vidID/1.jpg");
//$thumb3 = file_get_contents("http://img.youtube.com/vi/$vidID/2.jpg");
//$thumb4 = file_get_contents("http://img.youtube.com/vi/$vidID/3.jpg");
//http://img.youtube.com/vi/VideoID/default.jpg
//http://img.youtube.com/vi/VideoID/hqdefault.jpg
//http://img.youtube.com/vi/VideoID/mqdefault.jpg
//http://img.youtube.com/vi/VideoID/sddefault.jpg
        if(strlen($v)>0){
            echo "http://img.youtube.com/vi/$v/mqdefault.jpg";
        }
    }
	
function getYoutubeEmbedUrl($url)
{
     $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
?>