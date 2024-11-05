<?php
session_start();
include("/Applications/XAMPP/sis-alumni-page/php/connect_db.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = substr($_POST['password'], 0, 20);
    $interests = $_POST['interests'];
    $class = $_POST['class'];
    $targeted_universities = $_POST['targeted_universities'];
    $bio = $_POST['bio'];
    $curriculum = $_POST['curriculum'];

    $sql = "UPDATE student_profiles SET 
                password = '$password', 
                interests = '$interests', 
                class = '$class', 
                targeted_universities = '$targeted_universities', 
                bio = '$bio', 
                curriculum = '$curriculum',
                updated_at = NOW()
            WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
