<?php
date_default_timezone_set("Asia/Manila");
$id = $_SESSION['id'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$today = date('Y-m-d');
$now =  date('Y-m-d H:i:s');

$ftoday = date('m/d/Y');
$fnow =  date('m/d/Y, g:i:A');

$intime =  date('Y-m-d H:i:s');
$bstime =  date('Y-m-d H:i:s');
$betime =  date('Y-m-d H:i:s');
$outtime =  date('Y-m-d H:i:s');

// Display current date and user information (optional)
echo "Date: ". $ftoday;
echo "<br>";
echo "Now ".$fnow;
echo "<br><br>";
echo "User ID: " .$id;
echo "<br>";
$fullname = $fname . " " . $lname;
echo "User Full Name: " .$fullname;
echo "<br><br>";?>