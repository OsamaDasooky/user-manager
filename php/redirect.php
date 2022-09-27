<?php
	require_once "config.php";

	$loginURL = $google_client->createAuthUrl();

	echo $loginURL;
?>