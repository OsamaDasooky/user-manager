<?php
// DB credentials.
$dns = "mysql:host=localhost;dbname=curdtask3";
$user = "root";
$pass = "osama123456";

try {
    $conn = new PDO($dns,$user,$pass);
    // echo "you are connected";
} catch (PDOException $th) {
    echo "not connected" . $th->getMessage();
}