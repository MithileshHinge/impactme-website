<?php
// Include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-graph-sdk/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Call Facebook API
$fb = new Facebook(array(
	'app_id' => FB_APP_ID,
	'app_secret' => FB_APP_SECRET,
	'default_graph_version' => 'v3.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
	if(isset($_SESSION['facebook_access_token'])){
		$accessToken = $_SESSION['facebook_access_token'];
	}else{
  		$accessToken = $helper->getAccessToken();
	}
} catch(FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
}


// Include User class
require_once 'User.class.php';

if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		// Put short-lived access token in session
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
	  	// OAuth 2.0 client handler helps to manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		
		// Set default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	
	// Getting user's profile info from Facebook
	try {
		$graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture');
		$fbUser = $graphResponse->getGraphUser();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	// Initialize User class
	$user = new User();
	
	// Getting user's profile data
    $fbUserData = array();
    $fbUserData['oauth_uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
    $fbUserData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
    $fbUserData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
    $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:'';
    $fbUserData['gender']     = !empty($fbUser['gender'])?$fbUser['gender']:'';
    $fbUserData['picture']    = !empty($fbUser['picture']['url'])?$fbUser['picture']['url']:'';
    $fbUserData['link']       = !empty($fbUser['link'])?$fbUser['link']:'';
    
    // Insert or update user data to the database
    $fbUserData['oauth_provider'] = 'facebook';
	
    $userData = $user->checkUser($fbUserData);
    
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE oauth_uid='".sc_mysql_escape($userData['oauth_uid'])."' and oauth_provider = '".$userData['oauth_provider']."' "; 
	$dbfblogin = $dbObj->SelectQuery('edithome.php','aboutEdit()');
	
	$_SESSION['is_user_login'] = 1;
	$_SESSION['site_username'] = $dbfblogin[0]['fname'];
	$_SESSION['user_id'] = $dbfblogin[0]['id'];
	$_SESSION['fbimage'] = $dbfblogin[0]['fbimage'];
	
    // Storing user data in the session
    $_SESSION['userData'] = $userData;
	
	// Get logout url
	$_SESSION['logoutURL'] = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL.'logout.php');
	
	// Render Facebook profile data
	if(!empty($userData)){
		$output  = '<h2>Facebook Profile Details</h2>';
		$output .= '<div class="ac-data">';
		$output .= '<img src="'.$userData['picture'].'"/>';
        $output .= '<p><b>Facebook ID:</b> '.$userData['oauth_uid'].'</p>';
        $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>';
        $output .= '<p><b>Email:</b> '.$userData['email'].'</p>';
        $output .= '<p><b>Gender:</b> '.$userData['gender'].'</p>';
        $output .= '<p><b>Logged in with:</b> Facebook'.'</p>';
		$output .= '<p><b>Profile Link:</b> <a href="'.$userData['link'].'" target="_blank">Click to visit Facebook page</a></p>';
        $output .= '<p><b>Logout from <a href="'.$logoutURL.'">Facebook</a></p>';
		$output .= '</div>';
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}else{
	// Get login url
	$permissions = ['email']; // Optional permissions
	$_SESSION['loginURL'] = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);
	$loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permissions);
	// Render Facebook login button
	$output = '<a href="'.htmlspecialchars($loginURL).'"><img src="images/fb-login-btn.png"></a>';
}
?>