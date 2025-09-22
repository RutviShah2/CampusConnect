<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    $entry = "Name: $name | Email: $email | Message: $message" . PHP_EOL;

    file_put_contents("feedback.txt", $entry, FILE_APPEND);
    echo "Thank you for your feedback!";
}
?>