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
$betime =  date( 'Y-m-d H:i:s');
$outtime =  date( 'Y-m-d H:i:s');
$fullname = $fname . " " . $lname;

$shiftDuration = new DateTime($intime);
$shiftDuration->modify('+9 hours');

$breakDuration = new DateTime($bstime);
$breakDuration->modify('+1 hour');


$finalShift = $shiftDuration->format('h:i A');
$finalBreak = $breakDuration->format('h:i A');

echo "End of Break Time " . $finalBreak. "<br><br>"; 
echo "End of the shift " . $finalShift. "<br><br>"; 
//IT CAN NOW GET THE EXACT END TIME OF SHIFT AND BREAK







// Display current date and user information (optional)
// echo "Date: ". $ftoday;
// echo "<br>";
// echo "Now ".$fnow;
// echo "<br><br>";
// echo "User ID: " .$id;
// echo "<br>";

// echo "User Full Name: " .$fullname;
// echo "<br><br>";




?>