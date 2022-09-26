<?php
require_once 'connectuon.php';


// print_r($_POST);

$email=$_POST['email'];
$password=$_POST['password'];
$fullName=$_POST['fullName'];
$mobile=$_POST['mobile'];
$birthday=$_POST['birthday'];
date_default_timezone_set('Asia/Amman');
$data =  date("Y/m/d h:i");
    try {
        $insert = $conn->prepare("INSERT INTO info VALUES ('member','$fullName','$email','$mobile','$password','$birthday',CURRENT_TIMESTAMP,'$data')");
        $insert->execute();
        $insert1 = $conn->prepare("SELECT * FROM info WHERE Email='$email'");
        $insert1->execute();
        $results=$insert1->fetch(PDO::FETCH_OBJ);
        print_r(json_encode($results) );
        session_start();
        $_SESSION['currentUser'] = $results->Email;
        $_SESSION['FullName'] = $results->FullName;
        $_SESSION['Mobile'] = $results->Mobile;
        $_SESSION['Birthday'] = $results->Birthday;
        $_SESSION['role'] = $results->role;
        $_SESSION['lastLogin'] = $results->lastLogin;


    } catch (Exception $e) {
        echo $e;
    }