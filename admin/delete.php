<?php
include '../conn.php';

$user_id = $_GET['id'];

if (isset($user_id) && is_numeric($user_id)) {
    // Prepare the DELETE query
    $delete = $conn->query("DELETE FROM users WHERE id = $user_id");
    header('location: schedule.php');

}