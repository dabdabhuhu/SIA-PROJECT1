<?php
include "config.php";

if(!isset($_SESSION['user_id'])) exit;

if(isset($_POST['score'])){
    $score = $_POST['score'];
    $correct = $_POST['correct'];
    $wrong = $_POST['wrong'];
    $percentage = $_POST['percentage'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO scores(user_id, score, correct, wrong, percentage) VALUES(?,?,?,?,?)");
    $stmt->bind_param("iiidd", $user_id, $score, $correct, $wrong, $percentage);
    $stmt->execute();
}