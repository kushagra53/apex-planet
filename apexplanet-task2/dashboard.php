<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $result = mysqli_query($conn,
        "SELECT * FROM students
        WHERE name LIKE '%$search%'
        OR email LIKE '%$search%'
        OR course LIKE '%$search%'
        ORDER BY id DESC");
} else {
    $result = mysqli_query($conn,
        "SELECT * FROM students ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

        <div>
            <a href="create.php" class="btn btn-success">Add Student</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

   <form method="GET" style="margin-bottom:20px;">
    <input
        type="text"
        name="search"
        placeholder="Search by name, email or course"
        value="<?php echo htmlspecialchars($search); ?>">

    <button type="submit">Search</button>

    <a href="dashboard.php">Clear</a>
</form>

    <table class="table table-bordered table-striped table-hover mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="delete.php?id=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete this record?');">
    Delete
</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>