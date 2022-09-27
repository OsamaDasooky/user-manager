<?php
//Include Google Client Library for PHP autoload file
require_once '../vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('657265103418-lk5hula2jncmq97nrjsofsi6gdduqskb.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

$google_client->setApplicationName("user-manager");
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/user-manager/php/g-callback.php');
 
$google_client->addScope('email');
$google_client->addScope('profile');
 
//start session on web page
session_start();

?>