<?php
include "config.php";
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $message = "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users(fullname,email,password) VALUES(?,?,?)");
        $stmt->bind_param("sss", $fullname, $email, $password);
        if($stmt->execute()){
            header("Location: login.php");
        } else {
            $message = "Error creating account!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="login-box">
        <h2>Create Account</h2>
        <form method="POST">
            <div class="input-group"><input type="text" name="fullname" placeholder="Full Name" required></div>
            <div class="input-group"><input type="email" name="email" placeholder="Email" required></div>
            <div class="input-group"><input type="password" name="password" placeholder="Password" required></div>
            <button class="submit-btn" type="submit">Sign Up</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
        <p style="color:red; text-align:center;"><?php echo $message; ?></p>
    </div>
</div>
</body>
</html>