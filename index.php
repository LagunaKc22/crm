<?php
session_start(); 
include "conn.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if($_SESSION['usertype'] === 'admin'){
        header("Location: admin/dashboard.php"); 
    }else{
        header("Location: user/dashboard.php");
    }
    
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
   
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows === 0) {
        echo "No user found with that username.";
    } else {
        $acc = $result->fetch_assoc();


        if (password_verify($pass, $acc['password'])) {
          
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $acc['username'];
            // $_SESSION['id'] = $acc['id'];
            $_SESSION['fname'] = $acc['fname'];
            $_SESSION['lname'] = $acc['lname'];
            $_SESSION['usertype'] = $acc['user_type'];

           
            if($acc['user_type'] === 'admin'){
                header('location: admin/dashboard.php');
            }else{
                header("Location: user/dashboard.php");
            }
             exit();
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <h3><u>Login Form</u></h3>
            <label for="">Username</label><br>
            <input type="text" name="user" required><br><br>
            <label for="">Password</label><br>
            <input type="password" name="pass" required><br><br>
            <input type="submit" value="Login">
        </div>
    </form>
    <p>Don't have an account? Please click <a href="registration.php">here</a> to register.</p>
</body>
</html>
