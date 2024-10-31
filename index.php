<?php
session_start(); // Start the session
include "conn.php"; // Ensure this is correct

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php"); // Redirect to home page if logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Prepare a statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    // Check if statement preparation failed
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user was found
    if ($result->num_rows === 0) {
        echo "No user found with that username.";
    } else {
        $acc = $result->fetch_assoc();

        // Verify the password
        if (password_verify($pass, $acc['password'])) {
            // Set session variables upon successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $acc['username'];
            $_SESSION['fname'] = $acc['fname'];
            $_SESSION['lname'] = $acc['lname'];

            // Redirect to the home page
            header("Location: home.php");
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
