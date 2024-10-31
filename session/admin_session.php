<?php


session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header("location: ../index.php");
    exit();
}
?>