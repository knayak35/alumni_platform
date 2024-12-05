<?php
session_start();

session_unset();
session_destroy();
header("Location: login_alumni.php"); // Replace with the correct login page
exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .logout-container h2 {
            color: #0073b1;
            margin-bottom: 20px;
        }

        .logout-container p {
            font-size: 18px;
            color: #333;
        }

        .logout-container .button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
        }

        .logout-container .button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="logout-container">
        <h2>Logging Out...</h2>
        <p>You are being logged out. Please wait...</p>
        <a href="login.php" class="button">Go to Login</a>
    </div>
</body>

</html>
