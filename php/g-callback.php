<?php
	require_once 'connectuon.php';
	require_once "config.php";

	if (isset($_SESSION['access_token']))
		$google_client->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($google_client);
	$userData = $oAuth->userinfo_v2_me->get();
	$email= $_SESSION['currentUser'] = $userData['email'];

	
	$insert = $conn->prepare("SELECT * FROM info WHERE Email='$email'");
    $insert->execute();
    $results=$insert->fetch(PDO::FETCH_OBJ);

if ($email == $results->Email) 
{
	$_SESSION['currentUser'] = $results->Email;
	$_SESSION['FullName'] = $results->FullName;
	$_SESSION['Mobile'] = $results->Mobile;
	$_SESSION['Birthday'] = $results->Birthday;
	$_SESSION['role'] = $results->role;
	$_SESSION['lastLogin'] = $results->lastLogin;

} 
else {
	$fullName= $_SESSION['FullName'] = $userData['givenName'] . " " . $userData['familyName'];
	$mobile= $_SESSION['Mobile'] = 'Unknown';
	$birthday= $_SESSION['Birthday'] = 'Unknown';
	$password = 'google user';
	date_default_timezone_set('Asia/Amman');
	$data =  date("Y/m/d h:i");
	$_SESSION['lastLogin']= $data;
	$_SESSION['role']= 'member';
	
	$insert = $conn->prepare("INSERT INTO info VALUES ('member','$fullName','$email','$mobile','$password','$birthday',CURRENT_TIMESTAMP,'$data')");
	$insert->execute();
}




	header('Location: http://localhost/user-manager/php/profile.php');
	exit();
?>