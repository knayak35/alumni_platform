<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Ubuntu', sans-serif;
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        .image-section {
            flex: 1;
            background-image: url('https://www.teacherhorizons.com/static/mediav2/schools/5130/images/495844_main.jpg');
            background-size: cover;
            background-position: center;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #fff;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            color: #ff5722;
            font-weight: 600;
        }

        .notice {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            color: #ff5722;
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 8px 0;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
            background: none;
            color: #333;
        }

        .input-group input:focus {
            border-color: #ff5722;
            outline: none;
        }

        .input-group label {
            position: absolute;
            left: 0;
            top: -20px;
            font-size: 14px;
            color: #ff5722;
            font-weight: 500;
        }

        .btn {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 10px 0;
            width: 100px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: #e64a19;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 15px;
        }

        a {
            color: #ff5722;
            text-decoration: underline;
        }

        a:hover {
            color: #e64a19;
        }
    </style>
</head>

<body>

    <div class="image-section"></div>
    <div class="form-section" id="signin">
        <center><img src="https://sisschools.org/wp-content/uploads/2018/03/SIS-Logo-Website-200x200.png" style="width: 100px;"></center>
        <br><br>
        <h1 class="notice">ALUMNI SIGN IN</h1>
        <h1 class="form-title">Sign In</h1>
        <br><br><br>
        <form method="post" action="alumni_db.php">
            <div class="input-group">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <br><br>
            <div class="input-group">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <br><br>
            <center>
            <input type="submit" class="btn" value="SIGN IN" name="signin">
            </center>
        </form>
    </div>

</body>

</html>
