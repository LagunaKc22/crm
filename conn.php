<?php

$hostname = "localhost";
$user = "root";
$pass = "";
$dbname = "office";

$conn = mysqli_connect($hostname, $user, $pass, $dbname);

    if($conn->connect_error){
        echo "No connection";
    }