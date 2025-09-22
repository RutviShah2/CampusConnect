<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']); // Or use password_hash for better security

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Registration successful!</h2><a href='login.php'>Login here</a>";
    } else {
        echo "<h2>Error: " . $conn->error . "</h2>";
    }
    exit;
}
?>
<!-- Your registration form HTML here -->
