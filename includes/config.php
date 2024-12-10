<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cars";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}
?>
