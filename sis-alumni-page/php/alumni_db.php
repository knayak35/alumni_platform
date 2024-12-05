<?php
include 'connect_db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM alumni_profiles WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['bio'] = $row['bio'];
        $_SESSION['password'] = $row['password'];
        header("Location: homepage_alumni.php");
        exit();
    } else {
        echo "Invalid Username or Password";
    }
    $stmt->close();
} else {
    echo "Failed to prepare SQL statement: " . $conn->error;
}
?>
