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

// Query to retrieve all alumni profiles except the currently logged-in user
$sql = "SELECT full_name, bio, university, major, username, file_name FROM alumni_profiles WHERE username != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connections</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #e6eaeb;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            transform: translateX(0);
            z-index: 1000;
            color: white;
        }
        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
            padding: 8px 0;
            display: block;
        }

        .sidebar ul li a:hover {
            color: orange;
            font-weight: 500;
        }

        .content {
            flex: 1;
            margin-left: 270px;
            padding: 40px;
            background-color: #ffd1b3;
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-evenly;
        }

        .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-evenly;
    }

    .profile-card {
        background: linear-gradient(145deg, #ffffff, #f0f3f9);
        border-radius: 12px;
        padding: 20px;
        width: calc(33% - 20px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-card:hover {
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        transform: translateY(-8px);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #0073b1;
        box-shadow: 0 4px 10px rgba(0, 115, 177, 0.2);
    }

    .profile-name {
        font-size: 20px;
        margin: 8px 0;
        color: #0073b1;
        font-weight: bold;
    }

    .profile-university,
    .profile-major {
        font-size: 14px;
        margin: 4px 0;
        color: #666;
    }

    .profile-bio {
        font-size: 13px;
        color: #555;
        margin-top: 10px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limit to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .connect-button {
        background: orange;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
        box-shadow: 0 4px 10px rgba(0, 115, 177, 0.3);

    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-card {
            width: 100%;
        }
    }

        .connect-button {
            background-color: #0073b1;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .connect-button:hover {
            background-color: #005f8c;
        }

        /* Responsive design for mobile */
        @media (max-width: 768px) {
            .profile-card {
                width: 100%;
                margin-bottom: 20px;
            }

            .sidebar {
            background-color: #e6eaeb;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            transform: translateX(0);
            z-index: 1000;
            color: white;
        }

            .content {
                margin-left: 0;
            }
        }

        .toggle-button {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color:rgb(131, 162, 233);
    color: white;
    border: none;
    width: 40px; /* Set equal width and height */
    height: 40px;
    border-radius: 50%; /* Makes the button circular */
    cursor: pointer;
    z-index: 1100;
    display: flex;
    align-items: center;
    justify-content: center; /* Center the content inside the button */
}
    </style>
    <script>
        function connectNow(username) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "connect_request.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Show response from server
                }
            };
            xhr.send("username=" + encodeURIComponent(username));
        }

        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full-width');
        });
    </script>
</head>

<body>
<div class="dashboard">
    <button class="toggle-button" id="toggleButton">☰</button>
    <div class="sidebar" id="sidebar">
            <img src="https://sisschools.org/wp-content/uploads/2018/03/SIS-Logo-Website-200x200.png" style="width: 100px; height: 100px; margin-left: 60px;">
            <h2 style="color: black; margin-left: 15px;">Alumni Dashboard</h2>
            <ul>
                <li><a href="main_alumni.php">Home Page</a></li>
                <li><a href="homepage_alumni.php">Update My Profile</a></li>
                <li><a href="connections.php">My Connections</a></li>
                <li><a href="blog.php">Blogs</a></li>
                <li><a href="forum.php">Student Forum</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Connections</h1>

            <div class="card-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="profile-card">
                            <img class="profile-avatar" src="uploads/<?= $row['file_name'] ?>" alt="Profile Picture">
                            <h2 class="profile-name"><?php echo htmlspecialchars($row['full_name']); ?></h2>
                            <div class="profile-university"><strong>University:</strong> <?php echo htmlspecialchars($row['university']); ?></div>
                            <div class="profile-major"><strong>Major:</strong> <?php echo htmlspecialchars($row['major']); ?></div>
                            <div class="profile-bio"><?php echo nl2br(htmlspecialchars($row['bio'])); ?></div>
                            <button class="connect-button" onclick="connectNow('<?php echo htmlspecialchars($row['username']); ?>')">Connect Now!</button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div>No connections available.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
