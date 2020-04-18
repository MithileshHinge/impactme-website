<?php 
include('admin_path.php');
include('social_login_load.php');
if(isset($_REQUEST['code'])){
	
	
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
	
}






############ Set Google access token ############
if (isset($_SESSION['token'])) {
	$googleClient->setAccessToken($_SESSION['token']);
}


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





?>