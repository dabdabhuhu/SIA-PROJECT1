<?php
session_start();

$host = "localhost";
$user = "root"; // your DB username
$pass = "";     // your DB password
$db   = "quiz_game";

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>