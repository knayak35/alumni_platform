<?php
session_start();
include "connect_db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$success_message = "";
$error_message = "";

// Check if the session variable is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If not set, redirect to login page
    header("Location: login_alumni.php"); // Replace with the correct login page
    exit();
}

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

// Retrieve all blog posts
$sql_blog = "SELECT title, author, content, created_at FROM blog_posts";
$result = $conn->query($sql_blog);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Blog Posts</title>
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
            color: white;
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

        .post-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .post-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .post-title {
            font-size: 20px;
            margin: 0;
            color: #0073b1;
        }

        .post-author {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .post-content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            margin: 10px 0;
        }

        .post-date {
            font-size: 12px;
            color: #aaa;
            margin-top: 10px;
            text-align: right;
        }
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
            background-color: orange;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: width 0.3s ease;
            color: white
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
            color: white;
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

        .collapse-btn {
            background-color: #0073b1;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        .collapse-btn:hover {
            background-color: #005f8d;
        }

    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
            <img src="https://sisschools.org/wp-content/uploads/2018/03/SIS-Logo-Website-200x200.png" style="width: 100px; height: 100px; margin-left: 60px;">
            <h2 style="color: black; margin-left: 20px;">Alumni Dashboard</h2>
            <ul>
                <li><a href="main_alumni.php">Home</a></li>
                <li><a href="homepage_alumni.php" >My Profile</a></li>
                <li><a href="connections.php">Connections</a></li>
                <li><a href="blog.php">Blogs</a></li>
            </ul>
        </div>

        <div class="content">
    <h2 style="color: white; font-size: 2em; margin-bottom: 20px;">Featured</h2>
    <div class="featured-blog-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; justify-items: center;">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="featured-blog-card" style="display: flex; width: 100%; max-width: 600px; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                    <!-- Image on the left -->
                    <img class="featured-blog-image" src="https://sisschools.org/wp-content/uploads/2018/03/SIS-Logo-Website-200x200.png" alt="Blog Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px 0 0 8px;">
                    
                    <!-- Text on the right -->
                    <div class="featured-blog-text" style="padding: 15px; display: flex; flex-direction: column; justify-content: space-between; width: calc(100% - 150px);">
                        <h3 class="featured-blog-title" style="font-size: 1.4em; font-weight: bold; color: #333; margin-bottom: 10px;"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="featured-blog-description" style="color: #555; font-size: 1em; margin-bottom: 10px;"><?php echo nl2br(substr($row['content'], 0, 120)); ?>...</p>
                        <div class="featured-blog-meta" style="font-size: 0.9em; color: #888; display: flex; align-items: center; gap: 10px;">
                            <img class="author-avatar" src="https://via.placeholder.com/40" alt="Author" style="border-radius: 50%; width: 40px; height: 40px;">
                            <span class="blog-author"><?php echo htmlspecialchars($row['author']); ?></span>
                            <span class="blog-date"><?php echo date("d M Y", strtotime($row['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No featured blogs available.</p>
        <?php endif; ?>
    </div>
</div>

<script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.querySelector(".content");

            if (sidebar.style.width === "0px") {
                sidebar.style.width = "250px";
                content.style.marginLeft = "270px"; // Adjust content when sidebar expands
            } else {
                sidebar.style.width = "0px";
                content.style.marginLeft = "80px"; // Adjust content when sidebar collapses
            }
        }
    </script>

        </body>


<style>
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
        margin-left: 270px; /* Adjust margin to ensure it clears the sidebar */
        padding: 40px;
        background-color: #90c8f0;
        overflow-y: auto;
    }

    .content h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
    }

    .featured-blog-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .featured-blog-card {
        width: calc(33.33% - 20px); /* Ensures 3 columns */
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        overflow: hidden;
    }

    .featured-blog-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .featured-blog-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .featured-blog-text {
        padding: 20px;
    }

    .featured-blog-title {
        font-size: 20px;
        margin: 0 0 10px;
        color: #0073b1;
    }

    .featured-blog-description {
        font-size: 14px;
        color: #555;
        margin: 0 0 10px;
    }

    .featured-blog-meta {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #999;
    }

    .author-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .blog-author {
        margin-right: 10px;
        font-weight: bold;
    }

    .blog-date {
        margin-left: auto;
    }

    @media (max-width: 768px) {
        .content {
            margin-left: 0;
        }

        .featured-blog-card {
            width: calc(50% - 10px); /* Switch to 2 columns on smaller screens */
        }
    }

    @media (max-width: 576px) {
        .featured-blog-card {
            width: 100%; /* Full width on very small screens */
        }
    }
</style>
