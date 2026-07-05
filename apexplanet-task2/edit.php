<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    mysqli_query($conn,"UPDATE students
    SET name='$name', email='$email', course='$course'
    WHERE id=$id");

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<h2>Edit Student</h2>

<form method="POST">
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

    <input type="text" name="course" value="<?php echo $row['course']; ?>" required>

    <button type="submit" name="update">Update</button>
</form>

</div>

</body>
</html>