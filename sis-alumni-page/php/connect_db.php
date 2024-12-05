<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "alumni-platform";

// Establish the connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check the connection
if (!$conn) {
    echo "Failed to connect DB: " . mysqli_connect_error();
    exit();
}
?>
