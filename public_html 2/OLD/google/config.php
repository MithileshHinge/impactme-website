<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'impactme');
define('DB_PASSWORD', '+G3,[B&d@X](');
define('DB_NAME', 'asfewtaW');
define('DB_USER_TBL', 'users');

// Google API configuration
define('GOOGLE_CLIENT_ID', '108189500471-ogsiv7qc4f5nlo2uic9pqlds93ou4pkl.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'coYyIuw_4Dvj63Ee6kiQZqz9');
define('GOOGLE_REDIRECT_URL', 'https://www.impactme.in/google/index.php');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Youtube Connect');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);