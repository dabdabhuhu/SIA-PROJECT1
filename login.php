<?php
include "config.php";
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, fullname FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $fullname);
    if($stmt->num_rows > 0){
        $stmt->fetch();
        if(password_verify($password, $hashed_password)){
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $fullname;
            header("Location: dashboard.php");
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">
            <div class="input-group"><input type="email" name="email" placeholder="Email" required></div>
            <div class="input-group"><input type="password" name="password" placeholder="Password" required></div>
            <button class="submit-btn" type="submit">Login</button>
        </form>
        <div class="register">
            Don’t have an account? <a href="signup.php">Sign Up</a>
        </div>
        <p style="color:red; text-align:center;"><?php echo $message; ?></p>
    </div>
</div>
</body>
</html>