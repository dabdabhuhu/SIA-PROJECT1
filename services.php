<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style3.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Services</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<nav>
    <div class="logo">Logo</div>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">
    <div class="services-box">
        <h1>Our Services</h1>
        <div class="services">
            <div class="service-card">
                <h3>Web Development</h3>
                <p>We create modern, responsive, and secure websites using the latest technologies.</p>
            </div>
            <div class="service-card">
                <h3>UI/UX Design</h3>
                <p>Beautiful and user-friendly interfaces with clean, glassmorphism design trends.</p>
            </div>
            <div class="service-card">
                <h3>Database Integration</h3>
                <p>Secure backend systems with PHP and MySQL to manage users and data safely.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>