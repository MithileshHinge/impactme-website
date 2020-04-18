<?php
##### Required Library #####
require_once __DIR__ . '/src/Facebook/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

$facebook = new Facebook(array('app_id' => $fbappid, 'app_secret' => $fbappsecret, 'default_graph_version' => 'v2.10', ));
$helper = $facebook->getRedirectLoginHelper();


if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}


##### Check facebook token stored or get new access token #####
try {
	if(isset($_SESSION['fb_token'])){
		$accessToken = $_SESSION['fb_token'];
	}else{
  		$accessToken = $helper->getAccessToken();
	}
} catch(FacebookResponseException $e) {
 	echo 'Facebook Responser error: ' . $e->getMessage();
  	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK error: ' . $e->getMessage();
  	exit;
}


//###########################Google ###########################

include_once 'src/Google/Google_Client.php';
include_once 'src/Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('ImpactMe');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURLGoogle);

$google_oauthV2 = new Google_Oauth2Service($googleClient);



?>