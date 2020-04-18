<?php 
include('admin_path.php');
include('social_login_load.php');
if(isset($_REQUEST['code'])){
	
	 if($_SESSION['youtube_connect_type']=="google")
	 {
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
	}
	else
	{
	header('Location: authenticate.php');
	}
}




############ Set Fb access token ############

if(isset($_SESSION['fb_token'])){
		$facebook->setDefaultAccessToken($_SESSION['fb_token']);
}
else{
	$_SESSION['fb_token'] = (string) $accessToken;
	$oAuth2Client = $facebook->getOAuth2Client();
	$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_token']);
	$_SESSION['fb_token'] = (string) $longLivedAccessToken;
	$facebook->setDefaultAccessToken($_SESSION['fb_token']);
}
############ Fetch data from graph api  ############
try {
	$profileRequest = $facebook->get('/me?fields=name,first_name,last_name,email,link,gender,locale,birthday,cover,picture.type(large)');
	$fbuserData = $profileRequest->getGraphNode()->asArray();
} catch(FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	session_destroy();
	header("Location: ./");
	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	session_destroy();
	header("Location: ./");
	exit;
}


    $oauthpro = "facebook";
	$oauthid = $fbuserData['id'] ;
	$full_name = $fbuserData['name'] ;
	$f_name = $fbuserData['first_name'] ;
	$l_name = $fbuserData['last_name'] ;
	$gender = $fbuserData['gender'] ;
	$email_id = $fbuserData['email'];
	$locale = $fbuserData['locale'] ;
	$cover = $fbuserData['cover']['source'] ;
	$picture = $fbuserData['picture']['url'];
	$url = $fbuserData['link'];




############ Store data in database  ############

if(isset($_SESSION['log_type']) && !empty($_SESSION['log_type']))
{

   $sql_check = $db_query->fetch_object("select count(*) c , i.* from  impact_user i where i.email_id='".$fbuserData['email']."' and i.user_type='".$_SESSION['log_type']."' limit 1");
if($sql_check->c>0 )
{
  
		  $_SESSION['is_user_login'] = 1;
		  $_SESSION['username'] = $sql_check->email_id;
		  $_SESSION['user_id'] = base64_encode($sql_check->user_id);
		  if($_SESSION['log_type']=="ucreate") $_SESSION['user_type'] = 1; else $_SESSION['user_type'] = 0;
		  $sql_update = $db_query->runQuery("update impact_user set last_log_in_date = '".date('Y-m-d h:i:s A')."' where user_id='".$sql_check->user_id."'");

		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 1)
		{
		
			header('location:'.USER_CREATOR_PATH);
		}
		if(isset($_SESSION['is_user_login'])==1 && $_SESSION['user_type'] == 0)
		{
	
			header('location:'.POST_CREATOR_PATH);
		}

}
else
{
    

    $id_number = $db_query->id_number_generate("impact_user","id_number",ID_NUMBER);
	$pwd = rand(10000,99999);
	$registration_date = date('Y-m-d H:i:s');
	$hash=md5($fbuserData['email']);
	$hash_active='Y';
	$status=1;
	$user_type=$_SESSION['log_type'];
	$reg_type="facebook";
	$register_ip=$_SERVER['REMOTE_ADDR'];
	
	/*$url = "https://graph.facebook.com/v2.2/".$fbuserData['id']."/picture?type=large";

	$image = file_get_contents($url);
	$file_name = 'user/facebook'.$fbuserData['id'].'.jpg';
	$dir =  dirname(__file__).'/'.$file_name;
	file_put_contents($dir, $image);*/
	
	
	$image = file_get_contents('https://graph.facebook.com/'.$fbuserData['id'].'/picture?type=large');
$dir = dirname(__file__).'/images/user/fb/'.$fbuserData['id'].'.jpg';
file_put_contents($dir, $image);

     $file_name = "user/fb/".$fbuserData['id'].'.jpg';



      $sql_insert = "INSERT INTO `impact_user` (`user_id`, `id_number`, `first_name`, `last_name`, `full_name`, `email_id`, `password`, `registration_date`, `last_log_in_date`, `hash`, `hash_active`, `status`, `user_type`, `reg_type`, `oauth_provider`, `oauth_id`, `image_path`, `register_ip`, `cover_image_path`) VALUES 
	 (NULL, '".$id_number."', '".$f_name."', '".$l_name."', '".$full_name."',  '".$fbuserData['email']."','', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '".$hash."', '".$hash_active."', '".$status."', '".$user_type."', '".$reg_type."', '".$oauthpro."', '".$oauthid."', '".$file_name."', '".$register_ip."', '".$cover."');";
	 $insert_query = $db_query->runQuery($sql_insert);
	  $last_id = mysql_insert_id();
	  $_SESSION['is_user_login'] = 1;
	  $_SESSION['username'] = $fbuserData['email'];
	  $_SESSION['user_id'] = base64_encode( $last_id );
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
else
{
$user_id = base64_decode($_SESSION['user_id']);
 if($_SESSION['connect_type']=="facebook")
 {
      echo $sql_insert = "INSERT INTO `social_users` (`id`, `user_id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES (NULL, '".$user_id."', 'facebook', '".$oauthid."', '".$f_name."', '".$l_name."', '".$email_id."', '".$gender."', '".$locale."', '".$picture."', '".$url."', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');";
	 $insert_query = $db_query->runQuery($sql_insert);
	 header('location:'.BASEPATH.'/edit/about/');
 }
 else
 {
  header('Location: '.BASEPATH);
 }
}



//header("Location: view.php");



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