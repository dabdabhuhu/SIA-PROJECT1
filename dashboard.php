<?php
include "config.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="style4.css">
<style>
/* Adjust iframe to fill content area */
.content iframe {
    width: 100%;
    height: 80vh;
    border: none;
    border-radius: 10px;
}
</style>
</head>
<body>
<div class="dashboard">
    <div class="sidebar">
        <h2 style="color:white;"><?php echo $_SESSION['user_name']; ?></h2>
        <a href="quiz.php" target="contentFrame">Play Quiz</a>
        <a href="home.php" target="contentFrame">Home</a>
        <a href="about.php" target="contentFrame">About</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <iframe name="contentFrame" src="home.php"></iframe>
    </div>
</div>
</body>
</html>