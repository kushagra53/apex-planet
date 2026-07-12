<?php
session_start();
require 'db.php';

$message = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? OR username = ?");
mysqli_stmt_bind_param($stmt, "ss", $email, $username);
mysqli_stmt_execute($stmt);
$check = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check) > 0) {
        $message = "Username or Email already exists!";
    } else {
        $stmt = mysqli_prepare($conn,
    "INSERT INTO users(username, email, password)
     VALUES(?, ?, ?)");

mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

       if (mysqli_stmt_execute($stmt)) {
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