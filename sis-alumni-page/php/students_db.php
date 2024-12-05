<?php
include '/Applications/XAMPP/sis-alumni-page/php/connect_db.php';

if (isset($_POST['signup'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $checkEmail = "SELECT * FROM alumni_accounts where email = '$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Email Address already exists";
    } else {
        $insertQuery = "INSERT INTO alumni_accounts(firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) == TRUE) {
            header("location: homepage");
        } else {
            echo "Error" . $conn->error;
        }
    }
}

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM student_profiles where username = '$username' and password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['bio'] = $row['bio'];
        header("Location: homepage_students.php");
        exit();
    } else {
        echo "Invalid Email or Password";
    }
}
