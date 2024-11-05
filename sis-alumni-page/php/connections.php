<?php
session_start();
include("/Applications/XAMPP/sis-alumni-page/php/connect_db.php");

$username = $_SESSION['username'];

// Fetch full name of the logged-in user
$sql = "SELECT full_name FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($full_name);
$stmt->fetch();
$stmt->close();

// Fetch all alumni profiles from the database, including university and major
$sql = "SELECT username, full_name, bio, university, major FROM alumni_profiles";
$result = $conn->query($sql);

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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #fff;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 40px;
            color: #0073b1;
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
            color: #333;
            font-size: 16px;
            transition: color 0.3s ease;
            padding: 8px 0;
            display: block;
        }

        .sidebar ul li a:hover {
            color: #0073b1;
            font-weight: 500;
        }

        .content {
            flex: 1;
            margin-left: 270px;
            padding: 40px;
            background-color: #f4f4f4;
            overflow-y: auto;
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
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: calc(33% - 20px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .profile-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .profile-name {
            font-size: 20px;
            margin: 0 0 10px;
            color: #0073b1;
        }

        .profile-university,
        .profile-major {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .profile-bio {
            font-size: 14px;
            color: #555;
            margin: 0 0 10px;
            line-height: 1.5;
        }

        .connect-button {
            background-color: #0073b1;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .connect-button:hover {
            background-color: #005f8c;
        }
    </style>
    <script>
        function connectNow(username) {
            // Send a connection request to the server using AJAX
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
    </script>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Alumni Dashboard</h2>
            <ul>
                <li><a href="main_alumni.php">Home</a></li>
                <li><a href="homepage_alumni.php">My Profile</a></li>
                <li><a href="connections.php">Connections</a></li>
                <li><a href="blog.php">Blogs</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Connections</h1>

            <div class="card-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="profile-card">
                            <h2 class="profile-name"><?php echo htmlspecialchars($row['full_name']); ?></h2>
                            <div class="profile-university">University: <?php echo htmlspecialchars($row['university']); ?></div>
                            <div class="profile-major">Major: <?php echo htmlspecialchars($row['major']); ?></div>
                            <div class="profile-bio">Bio: <?php echo nl2br(htmlspecialchars($row['bio'])); ?></div>
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