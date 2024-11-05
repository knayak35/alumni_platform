<?php
session_start();
include("connect_db.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$interests = $_SESSION['interests'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = substr($_POST['password'], 0, 20);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $interests = $_POST['interests'];
    $class = $_POST['class'];
    $targeted_universities = $_POST['targeted_universities'];
    $bio = $_POST['bio'];
    $curriculum = $_POST['curriculum'];

    $sql = "INSERT INTO student_profiles (username, password, interests, class, targeted_universities, bio, curriculum, created_at, updated_at)
            VALUES ('$username', '$hashedPassword', '$interests', '$class', '$targeted_universities', '$bio', '$curriculum', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Profile created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Main Container Layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
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

        /* Main Content Area */
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
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fafafa;
            transition: border-color 0.3s ease;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
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

        /* Right Sidebar (Notifications or Suggestions) */
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

        /* Responsive Design */
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

    <!-- Main Dashboard Layout -->
    <div class="dashboard">

        <!-- Sidebar Section -->
        <div class="sidebar">
            <h2>Student Dashboard</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">My Profile</a></li>
                <li><a href="#">Connections</a></li>
                <li><a href="#">Opportunities</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="content">
            <h1>Update Your Profile</h1>
            <div class="profile-card">
                <form action="update_profile_student.php" method="POST"> <!-- Change form action to 'update_profile.php' -->
                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                    </div>

                    <!-- Interests Field -->
                    <div class="form-group">
                        <label for="interests">Interests</label>
                        <input type="text" id="interests" name="interests" value="<?php echo htmlspecialchars($interests); ?>" required>
                    </div>

                    <!-- Class Dropdown -->
                    <div class="form-group">
                        <label for="class">Class</label>
                        <select id="class" name="class" required>
                            <option value="">Select Class</option>
                            <option value="sec 1">Sec 1</option>
                            <option value="sec 2">Sec 2</option>
                            <option value="sec 3">Sec 3</option>
                            <option value="sec 4">Sec 4</option>
                            <option value="jc 1">JC 1</option>
                            <option value="jc 2">JC 2</option>
                        </select>
                    </div>

                    <!-- Targeted Universities Field -->
                    <div class="form-group">
                        <label for="targeted_universities">Targeted Universities</label>
                        <input type="text" id="targeted_universities" name="targeted_universities" required>
                    </div>

                    <!-- Curriculum Dropdown -->
                    <div class="form-group">
                        <label for="curriculum">Curriculum</label>
                        <select id="curriculum" name="curriculum" required>
                            <option value="">Select Curriculum</option>
                            <option value="Cambridge">Cambridge</option>
                            <option value="IB">IB</option>
                        </select>
                    </div>

                    <!-- Bio Field -->
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" required></textarea>
                    </div>

                    <!-- Save and Update Buttons -->
                    <div class="button-container">
                        <button type="submit" class="save-button" name="action" value="create">Save Profile</button> <!-- Use 'name' and 'value' attributes for the action -->
                        <button type="submit" class="save-button" name="action" value="update">Update Profile</button> <!-- New update button -->
                    </div>
                </form>

                <!-- Right Sidebar Section -->
                <div class="right-sidebar">
                    <h3>Notifications</h3>
                    <div class="notification">
                        <p>Check out new opportunities available in your area!</p>
                        <time datetime="2024-10-06">October 6, 2024</time>
                    </div>
                    <div class="notification">
                        <p>Your profile has been updated successfully!</p>
                        <time datetime="2024-10-06">October 6, 2024</time>
                    </div>
                    <div class="notification">
                        <p>New events coming up this month. Don't miss out!</p>
                        <time datetime="2024-10-06">October 6, 2024</time>
                    </div>
                </div>
            </div>

</body>

</html>