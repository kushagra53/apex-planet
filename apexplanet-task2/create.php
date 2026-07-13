<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

   $stmt = mysqli_prepare($conn,
    "INSERT INTO students(name, email, course) VALUES (?, ?, ?)");

mysqli_stmt_bind_param($stmt, "sss", $name, $email, $course);
mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
<h2>Add Student</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="course" placeholder="Course" required>
    <button type="submit" name="save">Save</button>
</form>

</div>

</body>
</html>