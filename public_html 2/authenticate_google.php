<?php 
include('admin_path.php');
//include('social_login_load.php');

// Google part from social_login_load.php
include_once 'src/Google/Google_Client.php';
include_once 'src/Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('ImpactMe');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURLGoogle);

$google_oauthV2 = new Google_Oauth2Service($googleClient);



if(isset($_REQUEST['code'])){
	
	
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . filter_var($redirectURLGoogle, FILTER_SANITIZE_URL));
	
}






############ Set Google access token ############
if (isset($_SESSION['token'])) {
	$googleClient->setAccessToken($_SESSION['token']);
}else {
	$_SESSION['token'] = $googleClient->getAccessToken();
}

if (isset($_SESSION['log_type']) and !empty($_SESSION['log_type']) and !empty($_SESSION['token'])) {
	############ Fetch data from graph api  ############
	try {
		$gpUserProfile = $google_oauthV2->userinfo->get();
	}
	catch (\Exception $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		header("Location: ./");
		exit;
	}
	############ Store data in database  ############
	$oauthpro = "google";
	$oauthid = $gpUserProfile['id'] ;
	$f_name = $gpUserProfile['given_name'];
	$l_name = $gpUserProfile['family_name'];
	$full_name = $f_name." ".$l_name;
	$gender = $gpUserProfile['gender'] ;
	$email_id = $gpUserProfile['email'];
	$locale = $gpUserProfile['locale'];
	$cover = '';
	$picture = $gpUserProfile['picture'];
	$url = $gpUserProfile['link'];
	var_dump($gpUserProfile);

	if (empty($email_id)){
		header("Location".BASEPATH);
	}

	$sql_check = $db_query->fetch_object("SELECT count(*) c, i.* from impact_user i where i.email_id='$email_id' and i.user_type='create'");

	if ($sql_check->c > 0){
		$_SESSION['is_user_login'] = 1;
		$_SESSION['username'] = $sql_check->email_id;
		$_SESSION['user_id'] = base64_encode($sql_check->user_id);

		$Cretor_Check = $db_query->creator_check($sql_check->email_id);
	    if($Cretor_Check->c>0)
	    {
	    	$_SESSION['is_user_login'] = 1;
			$_SESSION['user_id'] = base64_encode( $Cretor_Check->user_id );
			$_SESSION['user_type'] = 1;
			$sql_check->review_status = $Cretor_Check->review_status;
	  	}

		$sql_update = $db_query->runQuery("update impact_user set last_log_in_date = '".date('Y-m-d h:i:s A')."' where email_id='".$sql_check->email_id."'");

		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 1)
		{
		
		if($sql_check->review_status==0)
		   {
			header('location:'.USER_CREATOR_PATH);
			}
			else
			{
			  header('location:'.BASEPATH.'/user-creator/');
			}
			
			//header('location:'.USER_CREATOR_PATH);
		}
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 0)
		{
	
			header('location:'.POST_CREATOR_PATH);
		}
	}else{
		$id_number = $db_query->id_number_generate("impact_user","id_number",ID_NUMBER);
		$pwd = rand(10000,99999);
		$registration_date = date('Y-m-d H:i:s');
		$hash=md5($email_id);
		$hash_active='Y';
		$status=1;
		$user_type='create';
		$reg_type="google";
		$register_ip=$_SERVER['REMOTE_ADDR'];

		
		if (!$db_query->endsWith($picture, "photo.jpg")){
			$image = file_get_contents($picture);
			$dir = dirname(__file__).'/images/user/google/'.$oauthid.'.jpg';
			file_put_contents($dir, $image);

     		$file_name = 'user/google/'.$oauthid.'.jpg';
     	}else {
     		$file_name = "";
     	}

     	$sql_insert = "INSERT INTO `impact_user` (`user_id`, `id_number`, `first_name`, `last_name`, `full_name`, `email_id`, `password`, `registration_date`, `last_log_in_date`, `hash`, `hash_active`, `status`, `user_type`, `reg_type`, `oauth_provider`, `oauth_id`, `image_path`, `register_ip`, `cover_image_path` , `impact_name`) VALUES 
			(NULL, '".$id_number."', '".$f_name."', '".$l_name."', '".$full_name."',  '".$email_id."','".$pwd."', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '".$hash."', '".$hash_active."', '".$status."', '".$user_type."', '".$reg_type."', '".$oauthpro."', '".$oauthid."', '".$file_name."', '".$register_ip."', '".$cover."', '".$full_name."');";
		$insert_query = $db_query->runQuery($sql_insert);

		$last_id = mysql_insert_id();
		$_SESSION['is_user_login'] = 1;
		$_SESSION['username'] = $email_id;
		$_SESSION['user_id'] = base64_encode( $last_id );
		  //$db_query->welcome_email($fbuserData['email'], EMAIL_FROM, $mail);
		if($_SESSION['log_type']=="ucreate") $_SESSION['user_type'] = 1; else $_SESSION['user_type'] = 0;
		
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 1)
		{
			header('location:'.USER_CREATOR_PATH);
		}
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 0)
		{
	
			header('location:'.POST_CREATOR_PATH);
		}
	}

	unset($_SESSION['log_type']);
	unset($_SESSION['fb_token']);
}
else {
	header('Location: '.BASEPATH);
}
/*

if ($googleClient->getAccessToken()) {
	############ Fetch data from graph api  ############
	try {
		$gpUserProfile = $google_oauthV2->userinfo->get();
	}
	catch (\Exception $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		header("Location: ./");
		exit;
	}
	############ Store data in database  ############
	$oauthpro = "google";
	$oauthid = $gpUserProfile['id'] ;
	$f_name = $gpUserProfile['given_name'];
	$l_name = $gpUserProfile['family_name'];
	$gender = $gpUserProfile['gender'] ;
	$email_id = $gpUserProfile['email'];
	$locale = $gpUserProfile['locale'];
	$cover = '';
	$picture = $gpUserProfile['picture'];
	$url = $gpUserProfile['link'];
	var_dump($gpUserProfile);
	$user_id = base64_decode($_SESSION['user_id']);
	 if($_SESSION['youtube_connect_type']=="google")
	 {
		  echo $sql_insert = "INSERT INTO `social_users` (`id`, `user_id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES (NULL, '".$user_id."', 'google', '".$oauthid."', '".$f_name."', '".$l_name."', '".$email_id."', '".$gender."', '".$locale."', '".$picture."', '".$url."', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');";
		 $insert_query = $db_query->runQuery($sql_insert);
		 header('location:'.BASEPATH.'/edit/about/');
	 }
	 else
	 {
	  header('Location: '.BASEPATH.'/edit/about/?uid=56');
	 }
 

} else {
	header('Location: '.BASEPATH);
}
*/

?>