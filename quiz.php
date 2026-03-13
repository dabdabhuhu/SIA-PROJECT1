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
    <title>Math Quiz</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
<div class="quiz-container">

    <!-- HEADER -->
    <div class="header">
        <div class="score">Score: 0</div>
        <div class="timer">Time: 15s</div>
    </div>

    <!-- QUESTION PROGRESS -->
    <div class="progress">
        Question 1 of 10
    </div>

    <!-- QUESTION TEXT -->
    <div class="question"></div>

    <!-- ANSWER BUTTONS -->
    <div class="answers"></div>

    <!-- FEEDBACK -->
    <div class="feedback">Select an answer</div>

    <!-- STATS -->
    <div class="stats">
        <div>Correct: 0</div>
        <div>Wrong: 0</div>
    </div>

    <!-- RESTART BUTTON -->
    <div class="restart-container" style="display:none; text-align:center; margin-top:15px;">
        <button class="restart-btn">Restart Quiz</button>
    </div>

</div>

<script src="script.js" defer></script>
</body>
</html>