<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM students WHERE id=$id");

header("Location: dashboard.php");
exit();