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

        /* Dropdown styling */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color:rgb(251, 251, 251);
        }
/* Welcome Section with Parallax Effect */
.welcome-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://www.teacherhorizons.com/static/mediav2/schools/3986/images/494968_main.jpg') center/cover no-repeat;
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

   /* Features Section Styling */
.features-section {
    background-color: #f9f9f9;
    padding: 60px 20px;
    text-align: center;
}

.features-title {
    font-size: 36px;
    color: #ff5722;
    margin-bottom: 40px;
}

.features-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.feature {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    color: #ff5722;
}

.feature:hover {
    transform: translateY(-5px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    margin-bottom: 20px;
}

.feature h3 {
    font-size: 24px;
    color: #ff5722;
    margin-bottom: 15px;
}

.feature p {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .features-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }
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


.universities-description {
    font-size: 18px;
    color: #333;
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
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

/* General Section Styling */
.login-section {
    padding: 60px 20px;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.login-title {
    font-size: 48px;
    color: #333;
    margin-bottom: 40px;
    font-weight: bold;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Login Container and Boxes */
.login-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px;
}

.login-box {
    background: #fff;
    border-radius: 12px;
    padding: 35px 30px;
    width: 100%;
    max-width: 450px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-box:hover {
    transform: translateY(-8px);
}

.login-box h2 {
    font-size: 30px;
    color: #ff5722;
    margin-bottom: 25px;
}

/* List Styling */
.login-box ul {
    list-style-type: none;
    padding: 0;
    text-align: left;
}

.login-box li {
    font-size: 18px;
    margin-bottom: 15px;
    color: #555;
}

/* Button Styling */
.login-button {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 24px;
    background-color: #ff5722;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    border-radius: 8px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.login-button:hover {
    background-color: #ff784e;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-decoration: none;
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



/* UNSDG Section Styling */
.unsdg-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.unsdg-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 30px;
}

.unsdg-title {
    font-size: 32px;
    color: #ff5722;;
    margin-bottom: 20px;
}

.unsdg-description {
    font-size: 18px;
    color: #555;
    max-width: 600px;
    line-height: 1.6;
}

.video-wrapper {
    flex: 1;
    width: 600px;
    height: 350px; /* Adjust to desired height */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
<nav class="navbar" style="margin-right: 50px;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYkSOVeN6PgmTy4PN0fieR5d49Q_BUNpKxaQ&s" alt="Logo">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#universities">Universities</a></li>

            <!-- Dropdown for Login -->
            <li class="dropdown">
                <a href="#" class="dropbtn" style="margin-right: 70px;">Login</a>
                <div class="dropdown-content">
                    <a href="php/login_alumni.php">Login as Alumni</a>
                    <a href="php/login_student.php">Login as Current Students</a>
                    <a href="#">Login as Staff</a>
                </div>
            </li>
        </ul>
    </nav>

    <section class="welcome-section" id="home">
        <h1>Stay Connected, Inspire, and Achieve</h1>
        <p>Welcome to the SIS Alumni Portal - your gateway to rekindle connections, celebrate achievements, and build a thriving network for the future.</p>
    </section>
    <section class="about-section" id="about" style="display: flex; align-items: center; justify-content: space-between; padding: 60px 20px;">
    <!-- About Content on the Left -->
    <div class="about-content" style="flex: 1; max-width: 50%;">
        <h1 style="font-size: 36px; font-weight: 600; margin-bottom: 20px;">About the SIS Alumni Platform</h1>
        <p style="font-size: 18px; line-height: 1.6; color: #333;">The SIS Alumni platform was created with a singular vision: to foster lasting connections between the generations of students who have walked through the halls of SIS schools.</p>
        <p style="font-size: 18px; line-height: 1.6; color: #333;">Our goal is to create a thriving, supportive network where alumni can reconnect, share their achievements, and offer guidance to the next wave of graduates.</p>
    </div>
    
    <!-- Image on the Far Right -->
    <div style="flex: 1; display: flex; justify-content: flex-end;">
        <img src="https://sisschools.org/wp-content/uploads/2022/08/SIS-KG-Graduation-2022.jpg" alt="Graduation" style="width: 100%; max-width: 800px; height: auto; border-radius: 2px;">
    </div>
</section>




<section class="features-section" id="features" style="padding: 60px 20px; background-color: #f9f9f9;">
    <h1 class="features-title" style="text-align: center; font-size: 36px; font-weight: 700; margin-bottom: 40px; color: #333;">
        Explore Our Benefits
    </h1>

    <div class="features-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; justify-items: center;">
        <div class="feature" style="text-align: center; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
            <img src="https://img.icons8.com/color/96/conference-call.png" alt="Networking Icon" class="feature-icon" style="width: 80px; height: 80px; margin-bottom: 20px; transition: transform 0.3s ease-in-out;">
            <h3 style="font-size: 24px; font-weight: 600; color: #333;">Networking Opportunities</h3>
            <p style="font-size: 16px; color: #555;">Connect with alumni worldwide and expand your professional network in meaningful ways.</p>
        </div>
        <div class="feature" style="text-align: center; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
            <img src="https://img.icons8.com/color/96/event-accepted-tentatively.png" alt="Events Icon" class="feature-icon" style="width: 80px; height: 80px; margin-bottom: 20px; transition: transform 0.3s ease-in-out;">
            <h3 style="font-size: 24px; font-weight: 600; color: #333;">Events and Meetups</h3>
            <p style="font-size: 16px; color: #555;">Stay updated on alumni events, reunions, and online webinars to engage with peers.</p>
        </div>
        <div class="feature" style="text-align: center; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
            <img src="https://img.icons8.com/color/96/address-book.png" alt="Directory Icon" class="feature-icon" style="width: 80px; height: 80px; margin-bottom: 20px; transition: transform 0.3s ease-in-out;">
            <h3 style="font-size: 24px; font-weight: 600; color: #333;">Alumni Directory</h3>
            <p style="font-size: 16px; color: #555;">Utilize the alumni directory to connect and collaborate with fellow graduates.</p>
        </div>
    </div>
</section>

<style>
    /* Hover Effect for Features */
    .feature:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* Hover Effect for Icons */
    .feature-icon:hover {
        transform: scale(1.1);
    }

    /* Responsive Styling for smaller screens */
    @media (max-width: 768px) {
        .features-container {
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    }
</style>




    <section class="universities-section" id="universities">
    <br><br><br>
    <h2 class="universities-title">Where Our Alumni Have Studied</h2>

    <!-- Intro Text -->
    <p class="universities-description">
        Our alumni have pursued higher education at some of the most prestigious institutions across the globe. From leading engineering schools to renowned business programs, SIS graduates continue to excel and make their mark in various fields.
    </p>

    <!-- University Image -->
    <div class="universities-image">
        <img src="https://saigonsouth.sis.edu.vn/wp-content/uploads/sites/2/student_des.png" alt="SIS Graduates">
    </div>

    <!-- Scrolling University Logos -->
    <div class="slideshow-container">
        <div class="scrolling-wrapper">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvQlIT9i0bJ_HQsYT2-vecde02H8AiSNJzmA&s" alt="NIT Trichy" class="university-logo">
            <img src="https://nus.edu.sg/images/default-source/identity-images/NUS_logo_full-horizontal.jpg" alt="NUS" class="university-logo">
            <img src="https://blog.kobieducation.com/wp-content/uploads/2024/06/Logo-Imperial-College-London.webp" alt="Imperial College" class="university-logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe-Aq_HvIRoHN7bo-e2Bhjuz7NtSk5ac_ArQ&s" alt="Wharton School 1" class="university-logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4i9Wj9EVUKXhgjDjTuuRTFRL2Gpkeg74Epw&s" alt="Wharton School 2" class="university-logo">
        </div>
    </div>
</section>


</section>

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
