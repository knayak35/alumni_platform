<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS Alumni</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar img {
            height: 50px;
            width: 50px;
        }

        .navbar ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .navbar li a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar li a:hover {
            color: #ff5722;
        }

        /* Welcome Section */
        .welcome-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(0, 0, 0, 0.3)), url('https://cdn-sekolah.annibuku.com/20338722/2.jpg') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .welcome-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
        }

        .welcome-section p {
            font-size: 20px;
            max-width: 800px;
            margin: 10px auto;
        }

        /* About Section */
        .about-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 80px 20px;
            background-color: #fff;
        }

        .about-section img {
            flex: 1;
            max-width: 50%;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .about-content {
            flex: 1;
            padding: 20px;
            max-width: 50%;
        }

        .about-content h1 {
            font-size: 36px;
            color: #ff5722;
            margin-bottom: 20px;
        }

        .about-content p {
            font-size: 18px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 15px;
        }

        /* Features Section */
        .features-section {
            background-color: #f9f9f9;
            padding: 60px 20px;
            text-align: center;
        }

        .features-section h1 {
            font-size: 36px;
            color: #ff5722;
            margin-bottom: 40px;
        }

        .features-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .feature {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 300px;
            transition: transform 0.3s;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature h3 {
            color: #ff5722;
            margin-bottom: 15px;
        }

        .feature p {
            font-size: 16px;
            color: #555;
        }

        /* Universities Section */
        .universities-section {
            padding: 40px;
            text-align: center;
            background-color: #ffffff;
        }

        .universities-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #ff5722;
        }

        .slideshow-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
        }

        .slideshow-container img {
            margin-right: 20px;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .slideshow-container img:hover {
            transform: scale(1.1);
        }

        /* Login Section */
        .login-section {
            padding: 40px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .login-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #ff5722;
        }

        .login-section p {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 15px;
        }

        /* Footer */
        .footer-links {
            background-color: #333;
            padding: 20px;
            text-align: center;
        }

        .footer-links ul {
            display: flex;
            justify-content: center;
            list-style: none;
            gap: 30px;
        }

        .footer-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #ff5722;
        }

        .footer-bottom {
            background-color: #222;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
        }

        .unsdg-section {
            text-align: center;
            margin: 2rem 0;
        }

        .unsdg-section h2 {
            color: #1a7e92;
            font-size: 2rem;
        }

        .unsdg-section p {
            font-weight: 500;
            font-size: 1.2rem;
            color: #444;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .carousel {
            display: flex;
            overflow: hidden;
            max-width: 400px;
        }

        .carousel-item {
            min-width: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .video-embed {
            max-width: 400px;
            width: 100%;
        }

        .carousel-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1rem;
        }

        .carousel-controls .prev,
        .carousel-controls .next {
            cursor: pointer;
            font-size: 1.5rem;
            color: #444;
            margin: 0 1rem;
        }

        .pagination .dot {
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: #888;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
        }

        .pagination .dot.active {
            background-color: #d32f2f;
        }

        .slideshow-container {
            display: flex;
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
            align-items: center;
            position: relative;
        }

        .slideshow-container img {
            height: 200px;
            margin: 0 20px;
            flex-shrink: 0;
        }


        .scrolling-wrapper {
            display: flex;
            animation: scroll 20s linear infinite;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYkSOVeN6PgmTy4PN0fieR5d49Q_BUNpKxaQ&s" alt="Logo">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#universities">Universities</a></li>
            <li><a href="#login">Login</a></li>
        </ul>
    </nav>

    <section class="welcome-section" id="home">
        <h1>Reconnect, Share, and Grow Together</h1>
        <p>Join the SIS Alumni Portal to reconnect with peers, share your story, and explore new opportunities in a supportive community!</p>
    </section>

    <section class="about-section" id="about">
        <img src="https://sisschools.org/wp-content/uploads/2022/08/SIS-KG-Graduation-2022.jpg" alt="Graduation">
        <div class="about-content">
            <h1>About the SIS Alumni Platform</h1>
            <p>The SIS Alumni platform was created with a singular vision: to foster lasting connections between the generations of students who have walked through the halls of SIS schools.</p>
            <p>Our goal is to create a thriving, supportive network where alumni can reconnect, share their achievements, and offer guidance to the next wave of graduates.</p>
        </div>
    </section>

    <section class="features-section" id="features">
        <h1>How We Can Help <strong style="color: rebeccapurple;">You</strong></h1>
        <div class="features-container">
            <div class="feature">
                <h3>Networking Opportunities</h3>
                <p>Connect with alumni worldwide and expand your professional network in meaningful ways.</p>
            </div>
            <div class="feature">
                <h3>Career Support</h3>
                <p>Access mentorship, job opportunities, and career advice from experienced alumni.</p>
            </div>
            <div class="feature">
                <h3>Events and Meetups</h3>
                <p>Stay updated on alumni events, reunions, and online webinars to engage with peers.</p>
            </div>
            <div class="features-container">
                <div class="feature">
                    <h3>Alumni Directory</h3>
                    <p>Utilize the alumni directory to connect and collaborate with fellow graduates.</p>
                </div>
            </div>


        </div>
    </section>


    <section class="universities-section" id="universities">
        <h2>Where Our Alumni Have Studied</h2>


        <div class="slideshow-container">
            <div class="scrolling-wrapper">

                <img src="https://upload.wikimedia.org/wikipedia/commons/0/0b/NITT_logo.png" alt="NIT Trichy" style="width: 200px;">
                <img src="https://nus.edu.sg/images/default-source/identity-images/NUS_logo_full-horizontal.jpg" alt="NUS" style="width: 400px;">
                <img src="https://blog.kobieducation.com/wp-content/uploads/2024/06/Logo-Imperial-College-London.webp" alt="Imperial College" style="width: 450px;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe-Aq_HvIRoHN7bo-e2Bhjuz7NtSk5ac_ArQ&s" alt="Wharton School" style="width: 400px;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4i9Wj9EVUKXhgjDjTuuRTFRL2Gpkeg74Epw&s" alt="Wharton School" style="width: 400px;">
            </div>
        </div>

</body>

</html>

</section>
<br><br>
<div class="unsdg-section" style="display: flex; max-width: 1200px; margin: 0 100px;">
    <div style="flex: 1; padding-right: 5px;">
        <br><br>
        <h2 style="color: #ff5722;">Making A Better World</h2><br><br>
        <p>
            At SIS Schools, we cultivate proactive leaders and change-makers by embedding the values of sustainability, equality, and social responsibility into our curriculum. Our students engage with real-world issues, empowering them to take meaningful action and make a positive impact on the global community.
        </p>
    </div>

    <!-- YouTube Video Embed -->
    <div class="video-embed" style="flex: 1;">
        <iframe width="140%" height="350" src="https://www.youtube.com/embed/ynFNva5DUlk" title="UN Sustainable Development Goals"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>





<br><br>
<section id="login" style="background-color: #ffffff; padding: 40px 0;">
    <br><br><br>
    <h1 style="text-align: center; font-size: 40px; margin-bottom: 30px; color: #ff5722;">Get Started</h1>

    <div class="login-container" style="display: flex; justify-content: center; align-items: flex-start; margin: 0 20px; gap: 40px;">

        <div class="alumni_login" style="flex: 1; background-color: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
            <h2 style="font-size: 30px; color: #ff5722;">For <strong style="color: orange;">Alumni</strong>:</h2><br>
            <ul style="padding-left: 20px; list-style-position: inside;">
                <li style="font-size: 20px; margin-bottom: 10px;">
                    Login <a href="/php/login_alumni.php" style="color: #ff5722; text-decoration: underline;">Here</a>
                </li>
                <li style="font-size: 20px; margin-bottom: 10px;">Fill in your information - university, major, and a brief description about you.</li>
                <li style="font-size: 20px; margin-bottom: 10px;">Upload a recent photo of yourself (preferably smiling!).</li>
                <li style="font-size: 20px; margin-bottom: 10px;">Connect with other alumni and students.</li>
                <li style="font-size: 20px;">This platform is evolving into a networking space for the SIS Group of schools, so stay tuned!</li>
            </ul>
        </div>

        <div class="student_login" style="flex: 1; background-color: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
            <h2 style="font-size: 30px; color: #ff5722;">For <strong style="color: orange;">Current Students</strong>:</h2><br>
            <ul style="padding-left: 20px; list-style-position: inside;">
                <li style="font-size: 20px; margin-bottom: 10px;">
                    Login <a href="/php/login_student.php" style="color: #ff5722; text-decoration: underline;">Here</a> with your school email address.
                </li>
                <li style="font-size: 20px; margin-bottom: 10px;">Provide details about prospective universities and majors, your grade level, and a brief description about you.</li>
                <li style="font-size: 20px; margin-bottom: 10px;">Upload a recent photo of yourself (preferably smiling!).</li>
                <br><br><br><br>

            </ul>
        </div>

    </div>

    </div>
    <br><br><br>
</section>





<footer class="footer-links">
    <ul>
        <li><a href="#about">About Us</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#privacy">Privacy Policy</a></li>
    </ul>
</footer>

<footer class="footer-bottom">
    <p>&copy; 2024 SIS Alumni. All Rights Reserved.</p>
</footer>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const items = document.querySelectorAll(".carousel-item");
        const dots = document.querySelectorAll(".dot");
        let currentIndex = 0;

        // Show the initial item
        function showItem(index) {
            items.forEach((item, i) => {
                item.style.transform = `translateX(${(i - index) * 100}%)`;
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle("active", i === index);
            });
        }

        // Move to the next item
        function nextItem() {
            currentIndex = (currentIndex + 1) % items.length;
            showItem(currentIndex);
        }

        // Move to the previous item
        function prevItem() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showItem(currentIndex);
        }

        // Add event listeners to the buttons
        document.querySelector(".next").addEventListener("click", nextItem);
        document.querySelector(".prev").addEventListener("click", prevItem);

        // Add event listeners to the dots
        dots.forEach((dot, i) => {
            dot.addEventListener("click", () => {
                currentIndex = i;
                showItem(currentIndex);
            });
        });

        // Auto-play the carousel every 5 seconds
        setInterval(nextItem, 5000);

        // Show the first item on load
        showItem(currentIndex);
    });

    // JavaScript to enable continuous scrolling by duplicating logos
    const slideshowContainer = document.querySelector('.scrolling-wrapper');

    // Duplicate all images to create an infinite scroll effect
    const clone = slideshowContainer.cloneNode(true);
    slideshowContainer.parentNode.appendChild(clone);
</script>