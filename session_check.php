<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Check cookie for "Remember Me"
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
    } else {
        header('Location: login.html');
        exit;
    }
}
?>