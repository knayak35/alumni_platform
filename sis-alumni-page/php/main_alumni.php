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
$sql = "SELECT full_name, bio, university, major, file_name FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($full_name, $bio, $university, $major, $file_name);
$stmt->fetch();
$stmt->close();

// Retrieve all blog posts
$sql_blog = "SELECT title, author, content, alumni_profiles.full_name, alumni_profiles.file_name, blog_posts.thumbnail, blog_posts.created_at FROM blog_posts LEFT JOIN alumni_profiles on blog_posts.author = alumni_profiles.id";
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
            background-color: #ffd1b3;
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
            background-color: #03c2fc;
            transition: margin-left 0.3s ease;
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

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
<button class="toggle-button" id="toggleButton">☰</button>
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
    <h2>Featured</h2>
    <div class="featured-blog-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="featured-blog-card">
                    <img class="featured-blog-image" src="uploads/<?= $row['thumbnail'] ?>" alt="Blog Image">
                    <div class="featured-blog-text">
                        <h3 class="featured-blog-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="featured-blog-description"><?php echo nl2br(substr($row['content'], 0, 120)); ?>...</p>
                        <div class="featured-blog-meta">
                            <img class="author-avatar" src="uploads/<?= $row['file_name'] ?>" alt="Author">
                            <span class="blog-author"><?php echo htmlspecialchars($row['full_name']); ?></span>
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


<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #ffd1b3;
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
            transition: margin-left 0.3s ease;
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
    const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full-width');
        });

    </script>
