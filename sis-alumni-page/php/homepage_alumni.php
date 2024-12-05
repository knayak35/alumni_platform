<?php
session_start();
include "connect_db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$success_message = "";
$error_message = "";
$username = $_SESSION['username'];
$password = $_SESSION['password'];

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT full_name, bio, university, major FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($full_name, $bio, $university, $major);
    $stmt->fetch();
    $stmt->close();
} else {
    $error_message = "Error preparing statement: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $bio = $_POST['bio'];
    $university = $_POST['university'];
    $major = $_POST['major'];

    $update_sql = "UPDATE alumni_profiles SET full_name = ?, bio = ?, university = ?, major = ?, updated_at = NOW() WHERE username = ?";
    $update_stmt = $conn->prepare($update_sql);

    if ($update_stmt) {
        $update_stmt->bind_param("sssss", $full_name, $bio, $university, $major, $username);
        if ($update_stmt->execute()) {
            $success_message = "Profile updated successfully!";
        } else {
            $error_message = "Error updating profile: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        $error_message = "Error preparing update statement: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
   
        .content.full-width {
            margin-left: 0;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .button-container {
            text-align: right;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #90c8f0;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
        background-color: white;
        width: 250px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        bottom: 0;
        overflow-y: auto;
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
            width: 1000px;
            background-color: #90c8f0;
            overflow-y: auto;
        }

        .content h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .profile-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fafafa;
            transition: border-color 0.3s ease;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0073b1;
        }

        .form-group textarea {
            resize: vertical;
            height: 120px;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }

        .save-button {
            background-color: red;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .save-button:hover {
            background-color: #005f8d;
        }

        .right-sidebar {
            width: 250px;
            padding: 20px;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .right-sidebar h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #0073b1;
        }

        .notification {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .notification:last-child {
            border-bottom: none;
        }

        .notification:hover {
            background-color: #f0f8ff;
        }

        .notification p {
            margin: 0;
            font-size: 14px;
        }

        .notification time {
            font-size: 12px;
            color: #999;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 220px;
            }

            .right-sidebar {
                width: 200px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

            .right-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
    <div class="sidebar" id="sidebar">
<img src="https://sisschools.org/wp-content/uploads/2018/03/SIS-Logo-Website-200x200.png" style="width: 100px; height: 100px; margin-left: 60px;">
            <h2 style="color: black; margin-left: 20px;">Alumni Dashboard</h2>
             <ul>
                <li><a href="main_alumni.php">Home</a></li>
                <li><a href="homepage_alumni.php">My Profile</a></li>
                <li><a href="connections.php">Connections</a></li>
                <li><a href="blog.php">Blogs</a></li>
            </ul>
        </div>

        <div class="content" id="content">
            <h1 style="color: white;">Update Your Profile</h1>
            <div class="profile-card">
                <form action="homepage_alumni.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($full_name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" required><?= htmlspecialchars($bio); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="university">University</label>
                        <input type="text" id="university" name="university" value="<?= htmlspecialchars($university); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="major">Major</label>
                        <input type="text" id="major" name="major" value="<?= htmlspecialchars($major); ?>" required>
                    </div>
                    <div class="form-group">
                      <div>
    <label for="profile_picture">Upload Profile Picture:</label>
    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
</div>
<div>
    <img id="preview" src="#" alt="Profile Picture Preview" style="display: none; max-width: 150px;">
</div>
<div class="button-container">
    <button type="submit" class="save-button">Save Changes</button>
</div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleIcon = document.getElementById('toggle-icon');

    sidebar.classList.toggle('hidden');
    content.classList.toggle('full-width');

    if (sidebar.classList.contains('hidden')) {
        toggleIcon.textContent = '>';
    } else {
        toggleIcon.textContent = '<';
    }
}

    </script>
</body>

</html>
