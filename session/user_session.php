<?php 
session_start();
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'user'){
    header("location: ../index.php");
    exit();
}
?>