<?php
session_start();
include("/Applications/XAMPP/sis-alumni-page/php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentUsername = $_SESSION['username'];
    $targetUsername = $_POST['username'];

    $sql = "INSERT INTO connections (from_user, to_user) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $currentUsername, $targetUsername);

    if ($stmt->execute()) {
        echo "Connection request sent successfully!";
    } else {
        echo "Error sending connection request: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
