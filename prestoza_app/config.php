<?php
$host = "localhost";
$user = "root";   // default XAMPP MySQL user
$pass = "";       // default has no password
$db   = "user_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
