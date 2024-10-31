<?php include "html_struc/html_head.php"; ?>
<?php include "conn.php"; ?>

<form action="" method="post">
    <div>
        <h3><u>Registration Form</u></h3>
        <label for="">First Name</label><br>
        <input type="text" name="fname" required><br><br>
        <label for="">Last Name</label><br>
        <input type="text" name="lname" required><br><br>
        <label for="">Contact</label><br>
        <input type="text" name="contact" required><br><br>
        <hr>
        <label for="">User Type</label><br>
        <input type="text" name="usertype" required><br><br>
        <label for="">Username</label><br>
        <input type="text" name="user" required><br><br>
        <label for="">Password</label><br>
        <input type="password" name="pass" required><br><br>
        <label for="">Confirm Password</label><br>
        <input type="password" name="confirm_pass" required><br><br>
        <input type="submit" value="Register">
    </div>
</form>
<p>Already have an account? Please click <a href="index.php">here</a> to login.</p>
<?php include "html_struc/html_footer.php"; ?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $usertype = $_POST['usertype'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $confirm_pass = $_POST['confirm_pass'];

    // Check if passwords match
    if ($pass !== $confirm_pass) {
        echo "Passwords do not match.";
        exit();
    }

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another one.";
        $stmt->close();
        exit();
    }

    // Hash the password and insert the new user
    $hash_password = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, user_type, fname, lname, contact) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $user, $hash_password, $usertype,  $fname, $lname, $contact);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
