<?php
$host = "localhost";
$user = "root";
$password = "kusu9247";
$database = "crud_app";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>