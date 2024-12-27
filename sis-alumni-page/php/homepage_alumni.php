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

$sql = "SELECT full_name, bio, university, major, house_team, entry_year, exit_year FROM alumni_profiles WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($full_name, $bio, $university, $major, $house_team, $entry_year, $exit_year);
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
    $house_team = $_POST['house_team'];
    $entry_year = $_POST['sis_entry_year'];
    $exit_year = $_POST['sis_graduation_year'];

    if(isset($_FILES['file_name']) && $_FILES['file_name']['error'] == 0){
        $allowed = array('jpg', 'jpeg', 'gif', 'png');
        $image = $_FILES['file_name']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'_'.$username.'.'.$ext;
    
        if(in_array($ext, $allowed)){
            // Set the target directory with proper permissions
            $target_dir = "uploads/";
          //  chmod($target_dir, 0755); // Ensure the directory is writable
    
            $target_file = $target_dir . $filename;
    
            if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
                // Set the file permissions after successful upload
                chmod($target_file, 0644); // Adjust permissions as needed
    
                // echo "The file ". basename( $_FILES["file_name"]["name"]). " has been uploaded.";
            }
        }
    } 

    $update_sql = "UPDATE alumni_profiles SET full_name = ?, bio = ?, university = ?, major = ?, file_name = ?, house_team = ?, entry_year = ?, exit_year = ?, updated_at = NOW() WHERE username = ?";
    $update_stmt = $conn->prepare($update_sql);

    if ($update_stmt) {
        $update_stmt->bind_param('sssssssss', $full_name, $bio, $university, $major, $filename, $house_team, $entry_year, $exit_year, $username);
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
      body {
    font-family: 'Roboto', sans-serif;
    background-color: #ffd1b3;
    margin: 0;
    padding: 0;
    color: #555; /* Softer gray */
    display: flex;
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




.form-group input,
.form-group textarea {
    font-family: 'Roboto', sans-serif;
    font-weight: 300; /* Light weight for soft text */
    font-size: 15px; /* Slightly smaller for delicacy */
    color: #666; /* Softer text color */
    background-color: #fafafa;
    border: 20px solid #ccc;
    border-radius: 5px;
    width: 20%;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #0099FF; /* Subtle blue for focus */
    box-shadow: 0 0 4px rgba(0, 153, 255, 0.5);
}

.save-button {
    background-color: #FF6F61; /* Soft coral */
    color: white;
    font-weight: 400; /* Softer weight */
    border-radius: 5px;
    padding: 12px 25px;
    border: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.save-button:hover {
    background-color: #D95A50; /* Slightly darker coral */
}


        .dashboard {
            display: flex;
            min-height: 100vh;
            width: 100%;
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

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .toggle-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #0073b1;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1100;
        }

        .content {
            flex: 1;
            margin-left: 270px;
            padding: 40px;
            background-color: #ffd1b3;
            transition: margin-left 0.3s ease;
        }

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
        .dashboard {
            display: flex;
            min-height: 100vh;
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
            width: 80%;
            padding: 12px;
            padding-right: 20px;
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

        .form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Two columns */
    gap: 30px; /* Space between columns */
}

.form-column {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Styling the file input container */
.file-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.file-input {
    display: none; /* Hide the default file input */
}

/* Custom File Upload Button */
.file-upload-btn {
    background-color: #007BFF;
    color: white;
    padding: 12px 25px;
    border-radius: 50px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    text-align: center;
    width: 100%;
    max-width: 180px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.file-upload-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.upload-text {
    text-transform: uppercase;
    font-weight: 600;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
    color: #333;
}

/* File Upload Container */
.file-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

/* File Input (Hidden) */
.file-input {
    display: none; /* Hide default file input */
}

/* Custom Upload Button */
.custom-file-upload {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
    text-align: center;
    display: inline-block;
}

.custom-file-upload:hover {
    background-color: #45a049;
}

/* Image Preview Container */
.image-preview {
    width: 150px; /* Adjust width */
    height: 150px; /* Adjust height */
    border-radius: 50%; /* Make it circular */
    overflow: hidden;
    border: 2px dashed #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f9f9f9;
    background-size: cover; /* Ensures image fills container */
    background-position: center;
    transition: border-color 0.3s ease-in-out;
}

.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview:hover {
    border-color: #4CAF50; /* Highlight border on hover */
}

/* General dropdown styles */
.house-dropdown {
  font-size: 16px;
  padding: 8px 12px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 200px;
  outline: none;
  transition: border-color 0.3s, box-shadow 0.3s;
}

.house-dropdown:focus {
  border-color: #888;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

/* Team-specific styles */
.blue-team {
  background-color: #d4e4ff; /* Light blue */
  color: #0044cc;
}

.red-team {
  background-color: #ffdddd; /* Light red */
  color: #cc0000;
}

.green-team {
  background-color: #d4ffd4; /* Light green */
  color: #007f00;
}

.yellow-team {
  background-color: #fff9d4; /* Light yellow */
  color: #cc9900;
}

/* Style for the selected option */
.house-dropdown option:checked {
  font-weight: bold;
  border: 2px solid currentColor;
}



    </style>
</head>

<body>
    <div class="dashboard">
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

        <div class="content" id="content">
    <strong><b><h1>Update Your Profile</h1></b></strong>
    <div class="profile-card">
        <form action="homepage_alumni.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <!-- Left Column -->
                <div class="form-column">
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
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="sis_entry_year">SIS Entry Year</label>
                        <input type="text" id="sis_entry_year" name="sis_entry_year" value="<?= $entry_year; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sis_graduation_year">Graduation Year</label>
                        <input type="text" id="sis_graduation_year" name="sis_graduation_year" value="<?= $exit_year; ?>" required>
                    </div>
                    <div class="form-group">
                    <label for="house-team">Select Your House Team:</label>
                    <select id="house-team" name="house_team" class="house-dropdown">
                        <option value="default" <?= !isset($house_team) ? 'selected' : '' ?> selected disabled>Choose a team</option>
                        <option value="no-assigned-team" <?= isset($house_team) && $house_team == 'no-assigned-team' ? 'selected' : '' ?> data-bg="#d4e4ff" style="background-color: white">No Assigned Team</option>
                        <option value="blue" <?= isset($house_team) && $house_team == 'blue' ? 'selected' : '' ?> data-bg="#d4e4ff" style="background-color: #ADD8E6">Blue Team</option>
                        <option value="red" <?= isset($house_team) && $house_team == 'red' ? 'selected' : '' ?> data-bg="#ffdddd" style="background-color: #FF474C">Red Team</option>
                        <option value="green" <?= isset($house_team) && $house_team == 'green' ? 'selected' : '' ?> data-bg="#d4ffd4" style="background-color: #90EE90">Green Team</option>
                        <option value="yellow" <?= isset($house_team) && $house_team == 'yellow' ? 'selected' : '' ?> data-bg="#fff9d4" style="background-color: #FDFD96">Yellow Team</option>
                    </select>

</div>

                    <div class="form-group">
                        <label for="file_name">Upload Profile Picture</label>
                        <div class="file-upload-container">
                            <input type="file" name="file_name" id="file_name" accept="image/*" onchange="previewImage(event)" class="file-input">
                            <label for="file_name" class="custom-file-upload">Choose File</label>
                            <div id="image-preview" class="image-preview">
                                <!-- The selected image will be displayed here -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="button-container">
                <button type="submit" class="save-button" onclick="saveChanges()">Save Changes</button>
            </div>
        </form>
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

function saveChanges() {
    alert("Profile saved successfully!")
}

function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    const preview = document.getElementById('image-preview');
    
    reader.onload = function () {
        preview.innerHTML = `<img src="${reader.result}" alt="Profile Picture Preview">`;
    }
    
    if (file) {
        reader.readAsDataURL(file);
    }
}

const dropdown = document.getElementById('house-team');

dropdown.addEventListener('change', function () {
  const selectedOption = dropdown.options[dropdown.selectedIndex];
  dropdown.style.backgroundColor = selectedOption.style.backgroundColor;
  dropdown.style.color = selectedOption.style.color;
});


    </script>
</body>

</html>
