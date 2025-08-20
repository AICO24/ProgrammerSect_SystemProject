<?php
$servername = "127.0.0.1:3307";
$user = "root";
$pass = "";
$dbname = "jailmanagement_system";

$conn = new mysqli($servername, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>