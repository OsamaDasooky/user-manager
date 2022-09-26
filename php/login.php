<?php
require_once 'connectuon.php';


$email=$_POST['email'];
$password=$_POST['password'];


try {
    $insert = $conn->prepare("SELECT * FROM info WHERE Email='$email'");
    $insert->execute();
    $results=$insert->fetchAll(PDO::FETCH_OBJ);
    if ($results[0]->Email != null) {
        if ($results[0]->Password == $password) {
            session_start();
            $userid = $_SESSION['currentUser'] = $results[0]->Email;
            $_SESSION['FullName'] = $results[0]->FullName;
            $_SESSION['Mobile'] = $results[0]->Mobile;
            $_SESSION['Birthday'] = $results[0]->Birthday;
            $_SESSION['role'] = $results[0]->role;
            $_SESSION['lastLogin'] = $results[0]->lastLogin;
            date_default_timezone_set('Asia/Amman');
            print_r(json_encode($results[0]));
            $data =  date("Y/m/d h:i");
            $login = $conn->prepare("update info set lastLogin='$data' where Email='$userid'");
            $login->execute();
        } else  print_r(json_encode(false)); 
    } else print_r(json_encode(false));
    

} catch (Exception $e) {
    echo $e;
}