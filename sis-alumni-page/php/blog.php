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

$sql = "SELECT full_name, bio, university, major FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($full_name, $bio, $university, $major);
$stmt->fetch();
$stmt->close();

$author = $full_name; // Automatically filled from the alumni_profiles table

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author']; // This will already be filled from the session
    $content = $_POST['content'];

    $sql = "INSERT INTO blog_posts (title, author, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $author, $content);

    if ($stmt->execute()) {
        $success_message = "Blog post created successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
        overflow-y: auto;
    }

    .content h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
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
            background-color: #0073b1;
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

        <div class="content">
            <h1 style="color: white;">Create a New Blog Post</h1>
            <div class="profile-card">
                <?php if (!empty($success_message)) : ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <?php if (!empty($error_message)) : ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form action="create_blog.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($author); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <div id="editor" class="quill-editor"></div>
                        <textarea name="content" id="content" style="display: none;"></textarea>
                    </div>

                    
                    <div class="button-container">
                        <button class="save-button" type="submit">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </html>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image']
                ]
            }
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            var content = document.querySelector('#content');
            content.value = JSON.stringify(quill.getContents());
        });
    </script>
</body>

</html>
