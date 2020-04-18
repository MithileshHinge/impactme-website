<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
 
 
// Include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';
 
// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
 
$appId = '411121872866105'; //Facebook App ID
$appSecret = 'c8ceb0e9e4be0c27ef5a005819b5cb40'; //Facebook App Secret
$redirectURL = 'https://impactme.in/demo/login-with.php'; //Callback URL
$fbPermissions = array('email');  //Optional permissions
 
$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v3.2',
        ));
 
// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();
 if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
// Try to get access token
try {
    // Already login
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
 
    if (isset($accessToken)) {
        if (isset($_SESSION['facebook_access_token'])) {
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        } else {
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
        if (isset($_GET['code'])) {
 
            // Getting user facebook profile info
            try {
                $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
                $fbUserProfile = $profileRequest->getGraphNode()->asArray();
                // Here you can redirect to your Home Page.
                echo "<pre/>";
                print_r($fbUserProfile);
            } catch (FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                session_destroy();
                // Redirect user back to app login page
                header("Location: ./");
                exit;
            } catch (FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
        }
    } else {
        // Get login url
 
        $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
       // header("Location: " . $loginURL);
        
    }
} catch (FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
 
 
 
 
/*
        session_start();
        include('admin_path.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	$user_type = $_GET['ut'];
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
	        	echo "<b>Name</b> :".$user_profile->displayName."<br>";
	        	echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
	        	echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
	        	echo "<img src='".$user_profile->photoURL."'/><br>";
	        	echo "<b>Email</b> :".$user_profile->email."<br>";	        		        		        	
	        	echo "<br> <a href='logout.php'>Logout</a>";
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : echo "Unspecified error."; break;
                        case 1 : echo "Hybridauth configuration error."; break;
                        case 2 : echo "Provider not properly configured."; break;
                        case 3 : echo "Unknown or disabled provider."; break;
                        case 4 : echo "Missing provider application credentials."; break;
                        case 5 : echo "Authentication failed. "
                                         . "The user has canceled the authentication or the provider refused the connection.";
                                 break;
                        case 6 : echo "User profile request failed. Most likely the user is not connected "
                                         . "to the provider and he should to authenticate again.";
                                 $twitter->logout();
                                 break;
                        case 7 : echo "User not connected to the provider.";
                                 $twitter->logout();
                                 break;
                        case 8 : echo "Provider does not support this feature."; break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }*/
?>