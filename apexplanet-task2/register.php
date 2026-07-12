<?php
session_start();
require 'db.php';

$message = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username='$username'");

    if (mysqli_num_rows($check) > 0) {
        $message = "Username or Email already exists!";
    } else {
        $sql = "INSERT INTO users(username, email, password)
                VALUES('$username', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            $message = "Registration failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <?php if ($message) echo "<p>$message</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>