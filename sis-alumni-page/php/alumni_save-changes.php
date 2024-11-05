<?php
session_start();
include("/Applications/XAMPP/sis-alumni-page/php/connect_db.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = substr($_POST['password'], 0, 20);
    $bio = $_POST['bio'];
    $university = $_POST['university'];
    $major = $_POST['major'];

    $user_id = $_SESSION['id'];

    $sql = "UPDATE alumni_profiles 
            SET full_name = ?, username = ?, password = ?, bio = ?, university = ?, major = ?, updated_at = NOW() 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $full_name, $username, $password, $bio, $university, $major, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
