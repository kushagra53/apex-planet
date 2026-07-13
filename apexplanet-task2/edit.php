<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn,
    "SELECT * FROM students WHERE id = ?");

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

   $stmt = mysqli_prepare($conn,
    "UPDATE students
     SET name=?, email=?, course=?
     WHERE id=?");

mysqli_stmt_bind_param($stmt, "sssi",
    $name,
    $email,
    $course,
    $id
);

mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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