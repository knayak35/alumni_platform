<?php
session_start();
include "connect_db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$success_message = "";
$error_message = "";
$username = $_SESSION['username'];

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve alumni profile details
$sql = "SELECT full_name, bio, university, major FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($full_name, $bio, $university, $major);
$stmt->fetch();
$stmt->close();

$author = $full_name; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];


    $sql = "INSERT INTO blog_posts (title, author, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $author, $content);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $success_message = "Blog post created successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();

    // Output JavaScript alert based on success or error
    echo "<script>
        window.onload = function() {
            " . (!empty($success_message) ? "alert('$success_message'); window.location.href = 'homepage_alumni.php';" : "") . "
            " . (!empty($error_message) ? "alert('$error_message');" : "") . "
        };
    </script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* Your existing CSS here */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        form {
            margin: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>


</html>